<?php
/**
 * Plugin Name: WooCommerce Excel Connection
 * Description: Plugin to connect Google Sheets with WooCommerce and fetch prices.
 * Version: 1.0
 * Author: Данила маркин
 */

if (!defined('ABSPATH')) {
    exit; // Запретить прямой доступ к файлу
}

// Добавляем пункт меню в админ-панель
add_action('admin_menu', 'wcec_add_admin_menu');
function wcec_add_admin_menu() {
    add_menu_page(
        'Обновить цены',            // Название страницы
        'Обновить цены',            // Название пункта меню
        'manage_options',           // Разрешение
        'wcec_update_prices',       // Уникальный идентификатор страницы
        'wcec_update_prices_page'   // Функция для отображения страницы
    );
}

// Страница админ-панели для обновления цен
function wcec_update_prices_page() {
    ?>
    <div class="wrap">
        <h1>Обновить цены из Google Sheets</h1>
        <form method="post">
            <input type="submit" name="wcec_update_prices" class="button button-primary" value="Обновить цены">
        </form>
    </div>
    <?php

    // Обработка кнопки "Обновить цены"
    if (isset($_POST['wcec_update_prices'])) {
        wcec_update_prices();
    }
}

// Функция для обновления цен из Google Sheets
function wcec_update_prices() {
    // Подключение библиотеки Google API
    require_once __DIR__ . '/vendor/autoload.php';

    $spreadsheetId = '1W03plBCuSmVMT3JR--uYiB2XAqCYK1Ok_c8NKv5aj2U';
    $range = 'Макбуки прайс европа кю!A1:H1000'; // Укажите диапазон, включающий всю таблицу

    $client = new Google_Client();
    $client->setAuthConfig(__DIR__ . '/credentials.json');
    $client->addScope(Google_Service_Sheets::SPREADSHEETS_READONLY);

    $service = new Google_Service_Sheets($client);
    $response = $service->spreadsheets_values->get($spreadsheetId, $range);
    $values = $response->getValues();

    if (empty($values)) {
        echo '<div class="notice notice-error"><p>Данные не найдены.</p></div>';
        return;
    }

    $products = wc_get_products(['limit' => -1]);

    foreach ($products as $product) {
        $product_id = $product->get_id();
        $code_excel = get_post_meta($product_id, '_code_excel', true);
        $column_excel = get_post_meta($product_id, '_column_excel', true);

        if (!$code_excel || !$column_excel) {
            continue;
        }

        // Преобразуем колонку в индекс
        $columnIndex = ord(strtoupper($column_excel)) - ord('A');

        foreach ($values as $row) {
            if (isset($row[7]) && $row[7] == $code_excel) { // "7" - индекс колонки "Код"
                $price = isset($row[$columnIndex]) ? $row[$columnIndex] : null;
                if ($price !== null) {
                    $product->set_regular_price($price);
                    $product->save();
                }
                break;
            }
        }
    }

    foreach ($products as $product) {
        $product_id = $product->get_id();
    
        // Получаем кастомные поля группы
        $custom_fields_group = get_post_meta($product_id, '_custom_fields_group', true);
    
        if (is_array($custom_fields_group) && !empty($custom_fields_group)) {
            foreach ($custom_fields_group as $key => $custom_field) {
                // Извлекаем код и колонку из кастомного поля
                $code_excel = isset($custom_field["code_excel"]) ? sanitize_text_field($custom_field["code_excel"]) : null;
                $column_excel = isset($custom_field["column_excel"]) ? sanitize_text_field($custom_field["column_excel"]) : null;
    
                if (!$code_excel || !$column_excel) {
                    continue; // Пропускаем, если код или колонка отсутствуют
                }
    
                // Преобразуем колонку в индекс
                $columnIndex = ord(strtoupper($column_excel)) - ord('A');
    
                foreach ($values as $row) {
                    // Проверяем, совпадает ли код из Google Sheets
                    if (isset($row[7]) && $row[7] == $code_excel) { // "7" - колонка "Код" в Google Sheets
                        $price_from_excel = isset($row[$columnIndex]) ? sanitize_text_field($row[$columnIndex]) : null;
    
                        if ($price_from_excel !== null) {
                            // Обновляем значение в кастомном поле
                            $custom_fields_group[$key]["price"] = $price_from_excel;
                        }
                        break;
                    }
                }
            }
    
            // Сохраняем обновлённые кастомные поля
            update_post_meta($product_id, '_custom_fields_group', $custom_fields_group);
        }
    }
    

    echo '<div class="notice notice-success"><p>Цены успешно обновлены!</p></div>';
}
