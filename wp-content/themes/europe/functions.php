<?php
// Подключаем стили темы
function europe_enqueue_styles()
{
    $theme_version = wp_get_theme()->get('Version'); // Берем версию темы

    wp_enqueue_style('europe-style', get_stylesheet_uri(), array(), filemtime(get_stylesheet_directory() . '/style.css'));
    wp_enqueue_style('europe-reset', get_template_directory_uri() . '/assets/css/reset.css', array(), filemtime(get_template_directory() . '/assets/css/reset.css'));
    wp_enqueue_style('europe-global', get_template_directory_uri() . '/assets/css/global.css', array(), filemtime(get_template_directory() . '/assets/css/global.css'));
    wp_enqueue_style('europe-header', get_template_directory_uri() . '/assets/css/header.css', array(), filemtime(get_template_directory() . '/assets/css/header.css'));
    wp_enqueue_style('europe-footer', get_template_directory_uri() . '/assets/css/footer.css', array(), filemtime(get_template_directory() . '/assets/css/footer.css'));
    wp_enqueue_style('europe-pages', get_template_directory_uri() . '/assets/css/pages.css', array(), filemtime(get_template_directory() . '/assets/css/pages.css'));
    wp_enqueue_style('europe-order', get_template_directory_uri() . '/assets/css/order.css', array(), filemtime(get_template_directory() . '/assets/css/order.css'));
    // Стили для отображение уведомлений
    wp_enqueue_style('notyf-css', 'https://cdn.jsdelivr.net/npm/notyf/notyf.min.css', array(), null);
}
add_action('wp_enqueue_scripts', 'europe_enqueue_styles');

//  Стили для guttenberga
function mytheme_enqueue_block_editor_assets()
{
    wp_enqueue_style(
        'mytheme-editor-styles',
        get_template_directory_uri() . '/style.css',
        array(),
        wp_get_theme()->get('Version')
    );
}
add_action('enqueue_block_editor_assets', 'mytheme_enqueue_block_editor_assets');

// Подключаем скрипты темы
function enqueue_custom_scripts()
{
    $theme_version = wp_get_theme()->get('Version'); // Берем версию темы

    // Основные скрипты
    wp_enqueue_script(
        'main-script',
        get_template_directory_uri() . '/assets/js/main.js',
        ['jquery'],
        filemtime(get_template_directory() . '/assets/js/main.js'), // Кэш обновляется при изменении файла
        true
    );

    wp_enqueue_script(
        'store-script',
        get_template_directory_uri() . '/assets/js/store.js',
        ['jquery'],
        filemtime(get_template_directory() . '/assets/js/store.js'),
        true
    );

    // Отображение уведомлений
    wp_enqueue_script('notyf-js', 'https://cdn.jsdelivr.net/npm/notyf/notyf.min.js', array(), null, true);
    
    // Cтили для отображение форм
    wp_enqueue_script('swettalert-js', 'https://cdn.jsdelivr.net/npm/sweetalert2@11', array(), null, true);

    wp_localize_script('store-script', 'ajaxObject', [
        'ajaxurl' => admin_url('admin-ajax.php'),
    ]);

    // Подключаем cart.js на определенных страницах
    if (is_page([258, 262])) {
        wp_enqueue_script(
            'cart-script',
            get_template_directory_uri() . '/assets/js/cart.js',
            ['jquery'],
            filemtime(get_template_directory() . '/assets/js/cart.js'),
            true
        );

        wp_localize_script('cart-script', 'ajaxObject', [
            'ajaxurl' => admin_url('admin-ajax.php'),
            'pageTitle' => get_the_title(),
        ]);
    }

    // Подключаем mainPageForms.js только на главной и блоге
    if (is_front_page() || is_home()) {
        wp_enqueue_script(
            'main-page-script',
            get_template_directory_uri() . '/assets/js/mainPageForms.js',
            ['jquery'],
            filemtime(get_template_directory() . '/assets/js/mainPageForms.js'),
            true
        );

        wp_localize_script('main-page-script', 'ajaxObject', [
            'ajaxurl' => admin_url('admin-ajax.php'),
        ]);
    }
}
add_action('wp_enqueue_scripts', 'enqueue_custom_scripts');

function enqueue_search_script()
{
    wp_enqueue_script('custom-search', get_template_directory_uri() . '/assets/js/search.js', ['jquery'], null, true);

    wp_localize_script('custom-search', 'ajaxObject', [
        'ajaxurl' => admin_url('admin-ajax.php'),
    ]);
}

add_action('wp_enqueue_scripts', 'enqueue_search_script');

// Поддержка WooCommerce в теме
function europe_woocommerce_setup()
{
    add_theme_support('woocommerce');
}
add_action('after_setup_theme', 'europe_woocommerce_setup');

// Подключаем шапки сайта
function europe_get_header()
{
    get_template_part('templates/partials/header');
}

// Подключаем подвала сайта
function europe_get_footer()
{
    get_template_part('templates/partials/footer');
}

// Автозагрузка классов
function include_custom_walkers()
{
    require_once get_template_directory() . '/includes/walkers/custom-walker-side-menu.php';
    require_once get_template_directory() . '/includes/walkers/custom-walker-nav-menu.php';
    require_once get_template_directory() . '/includes/walkers/custom-walker-nav-menu-pages.php';
    require_once get_template_directory() . '/includes/walkers/custom-walker-brands.php';
}

add_action('after_setup_theme', 'include_custom_walkers');

// Регистрация меню в теме
function register_my_menus()
{
    register_nav_menus(
        array(
            'side-menu-categories' => __('Categories Menu'),
            'side-menu-brands' => __('Brands Menu'),
            'nav-general-pages' => __('Menu General Pages'),
        )
    );
}
add_action("init", "register_my_menus");

function custom_breadcrumbs()
{
    if (is_front_page()) {
        return;
    }

    $home = 'Home';
    $separator = ' | ';
    echo '<nav class="container bread-crumbs" aria-label="Breadcrumb" itemscope itemtype="https://schema.org/BreadcrumbList"><ol>';

    // Главная страница
    echo '<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';
    echo '<a href="' . home_url() . '" itemprop="item"><span itemprop="name">' . $home . '</span></a>';
    echo '<meta itemprop="position" content="1" /></li>';

    $position = 2;

    // Хлебные крошки для категории продукта WooCommerce
    if (is_product_category()) {
        $category = get_queried_object();
        if ($category) {
            // Выводим родительскую категорию (если есть)
            if ($category->parent != 0) {
                $parent_category = get_term($category->parent, 'product_cat');
                echo '<li class="bread-crumbs-separator">' . $separator . '</li>';
                echo '<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';
                echo '<a href="' . get_term_link($parent_category) . '" itemprop="item">';
                echo '<span itemprop="name">' . esc_html($parent_category->name) . '</span></a>';
                echo '<meta itemprop="position" content="' . $position++ . '" />';
                echo '</li>';
            }

            // Выводим текущую категорию (например, Dell)
            echo '<li class="bread-crumbs-separator">' . $separator . '</li>';
            echo '<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';
            echo '<a href="' . get_term_link($category) . '" itemprop="item">';
            echo '<span itemprop="name" class="bread-crumbs-active">' . esc_html($category->name) . '</span></a>';
            echo '<meta itemprop="position" content="' . $position++ . '" />';
            echo '</li>';
        }
    }

    if (is_product()) {
        $categories = wc_get_product_terms(get_the_ID(), 'product_cat');
        if (!empty($categories)) {

            // Первая категория
            $category = reset($categories);
            $parent_category = get_term($category->parent, 'product_cat');

            // Проверка на WP_Error для родительской категории
            if (!is_wp_error($parent_category) && $parent_category->parent == 0) {
                echo '<li class="bread-crumbs-separator">' . $separator . '</li>';
                echo '<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';
                echo '<a href="' . esc_url(get_term_link($parent_category)) . '" itemprop="item">';
                echo '<span itemprop="name">' . esc_html($parent_category->name) . '</span></a>';
                echo '<meta itemprop="position" content="' . esc_attr($position++) . '" />';
                echo '</li>';
            }

            // Проверка на WP_Error для текущей категории
            if (!is_wp_error($category)) {
                echo '<li class="bread-crumbs-separator">' . $separator . '</li>';
                echo '<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';
                echo '<a href="' . esc_url(get_term_link($category)) . '" itemprop="item">';
                echo '<span itemprop="name">' . esc_html($category->name) . '</span></a>';
                echo '<meta itemprop="position" content="' . esc_attr($position++) . '" />';
                echo '</li>';
            }
        }
    }

    if (is_single()) {
        echo '<li class="bread-crumbs-separator">' . $separator . '</li>';
        echo '<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';
        echo '<span itemprop="name">' . get_the_title() . '</span>';
        echo '<meta itemprop="position" content="' . $position++ . '" />';
        echo '</li>';
    }

    if (is_page() && !is_front_page()) {
        echo '<li class="bread-crumbs-separator">' . $separator . '</li>';
        echo '<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';
        echo '<span itemprop="name" class="bread-crumbs-active">' . get_the_title() . '</span>';
        echo '<meta itemprop="position" content="' . $position++ . '" />';
        echo '</li>';
    }

    if (is_search()) {
        echo '<li class="bread-crumbs-separator">' . $separator . '</li>';
        echo '<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';
        echo '<span itemprop="name">Search results for: ' . get_search_query() . '</span>';
        echo '<meta itemprop="position" content="' . $position++ . '" />';
        echo '</li>';
    }

    if (is_404()) {
        echo '<li class="bread-crumbs-separator">' . $separator . '</li>';
        echo '<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';
        echo '<span itemprop="name">404 - Page not found</span>';
        echo '<meta itemprop="position" content="' . $position++ . '" />';
        echo '</li>';
    }
    echo '</ol></nav>';
}

function get_global_settings($page_id)
{
    return [
        'phone' => get_field('contact_info_phone', $page_id),
        'phone_desc' => get_field('contact_info_phone_down_descr', $page_id),
        'email' => get_field('contact_info_email', $page_id),
        'email_desc' => get_field('contact_info_email_down_descr', $page_id),
        'address' => get_field('contact_info_address', $page_id),
        'address_desc' => get_field('contact_info_address_down_descr', $page_id),
    ];
}

add_action('wp_ajax_filter_products_sort', 'filter_products_sort');
add_action('wp_ajax_nopriv_filter_products_sort', 'filter_products_sort');

function filter_products_sort()
{
    if (isset($_GET['sort'])) {
        $sort = sanitize_text_field($_GET['sort']);
        $category = isset($_GET['category_id']) ? intval($_GET['category_id']) : 0;
        $paged = isset($_GET['paged']) ? intval($_GET['paged']) : 1;

        // Global data all site
        $global_settings = get_global_settings(190);

        $phone_number = preg_replace('/\s+/', '', $global_settings['phone']);

        // Параметры запроса для продуктов
        $args = array(
            'paged' => $paged,
            'post_type' => 'product',
            'posts_per_page' => 12, // Количество товаров (можно задать ограничение)
            'post_status' => 'publish',
        );

        // Инициализация запроса
        $tax_queries = array();
        // Чтение параметров фильтрации из запроса
        foreach ($_GET as $key => $value) {
            if (strpos($key, 'filter_') === 0) { // Если параметр фильтра начинается с "filter_"
                $attribute_name = substr($key, 7); // Убираем префикс "filter_"
                $terms = explode(',', sanitize_text_field($value)); // Разделяем значения фильтра на термины

                // Добавляем к запросу фильтрацию по таксономии
                $tax_queries[] = array(
                    'taxonomy' => 'pa_' . $attribute_name, // Пример: pa_brand или pa_color
                    'field'    => 'slug',
                    'terms'    => $terms,
                    'operator' => 'IN',
                );
            }
        }

        // Фильтр по категории, если передан ID
        if ($category > 0) {
            $args['tax_query'][] = [
                'taxonomy' => 'product_cat', // Таксономия WooCommerce для категорий товаров
                'field'    => 'id',
                'terms'    => $category,
            ];
        }

        // Добавляем таксономические запросы, если они есть
        if (!empty($tax_queries)) {
            $args['tax_query'] = $tax_queries;
        }

        // Проверяем, передана ли категория
        if (!empty($_POST['category_slug'])) {
            $tax_queries[] = [
                'taxonomy' => 'product_cat', // Таксономия категорий товаров
                'field'    => 'slug',
                'terms'    => sanitize_text_field($_POST['category_slug']),
            ];
        }

        // Изменение параметров сортировки в зависимости от выбранного варианта
        if ($sort == 'price_asc') {
            $args['orderby'] = 'meta_value_num';
            $args['meta_key'] = '_price';
            $args['order'] = 'ASC';
        } elseif ($sort == 'price_desc') {
            $args['orderby'] = 'meta_value_num';
            $args['meta_key'] = '_price';
            $args['order'] = 'DESC';
        } elseif ($sort == 'popularity') {
            $args['orderby'] = 'meta_value_num';
            $args['meta_key'] = 'total_sales';
            $args['order'] = 'DESC';
        }
        // Получаем товары по заданным параметрам
        $query = new WP_Query($args);

        ob_start();

        if ($query->have_posts()) :
            while ($query->have_posts()) : $query->the_post();
                global $product;
                // Выводим карточку товара
?>
                <!-- product cart -->
                <?php get_template_part('templates/partials/product-card'); ?>
                <!-- product cart -->
            <?php
            endwhile;
        else :
            echo '<p>No products found</p>';
        endif;

        wp_reset_postdata();
    }

    $products_html = ob_get_clean();
    // Генерация HTML для пагинации
    $pagination_html = generate_custom_pagination($query->max_num_pages, $paged);

    // Возвращаем JSON с товарами и кастомной пагинацией
    wp_send_json_success([
        'products'   => $products_html,
        'pagination' => $pagination_html,
    ]);

    die();
}

// start function filter_products_by_attributes
function load_filtered_products()
{
    $tax_queries = array();
    $paged = isset($_GET['paged']) ? intval($_GET['paged']) : 1;
    $category = isset($_POST['category_id']) ? intval($_POST['category_id']) : 0;

    // Считываем параметры фильтров из AJAX-запроса
    foreach ($_POST as $key => $value) {
        if (strpos($key, 'filter_') === 0) {
            $attribute_name = substr($key, 7);
            $terms = explode(',', $value);

            $tax_queries[] = array(
                'taxonomy' => 'pa_' . $attribute_name,
                'field'    => 'slug',
                'terms'    => $terms,
                'operator' => 'IN',
            );
        }
    }
    // Global data all site
    $global_settings = get_global_settings(190);

    $phone_number = preg_replace('/\s+/', '', $global_settings['phone']);

    $query_args = array(
        'post_type' => 'product',
        'post_status' => 'publish',
        'posts_per_page' => 12,
        'paged' => $paged,
    );

    // Фильтр по категории, если передан ID
    if ($category > 0) {
        $query_args['tax_query'][] = [
            'taxonomy' => 'product_cat', // Таксономия WooCommerce для категорий товаров
            'field'    => 'id',
            'terms'    => $category,
        ];
    }

    if (!empty($tax_queries)) {
        $query_args['tax_query'] = $tax_queries;
    }



    $query = new WP_Query($query_args);

    ob_start();

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            global $product;

            // Генерация вашей вёрстки для товара
            ?>
            <!-- product cart -->
            <?php get_template_part('templates/partials/product-card'); ?>
            <!-- product cart -->
        <?php
        }
    } else {
        echo '<p class="category-blocks-cards-empty">No products</p>';
    }

    wp_reset_postdata();

    $products_html = ob_get_clean();
    // Генерация HTML для пагинации
    $pagination_html = generate_custom_pagination($query->max_num_pages, $paged);

    // Возвращаем JSON с товарами и кастомной пагинацией
    wp_send_json_success([
        'products'   => $products_html,
        'pagination' => $pagination_html,
    ]);

    wp_die(); // Завершаем выполнение для AJAX
}
add_action('wp_ajax_load_filtered_products', 'load_filtered_products');
add_action('wp_ajax_nopriv_load_filtered_products', 'load_filtered_products');

// end function filter_products_by_attributes

add_action('wp_ajax_send_cart_to_woocommerce', 'send_cart_to_woocommerce');
add_action('wp_ajax_nopriv_send_cart_to_woocommerce', 'send_cart_to_woocommerce');

function send_cart_to_woocommerce()
{
    if (!isset($_POST['cart']) || !isset($_POST['contactInfo'])) {
        wp_send_json_error(['message' => 'Данные не переданы']);
        return;
    }

    $cart = $_POST['cart'];
    $contactInfo = $_POST['contactInfo'];

    // Проверка и вывод ошибок
    if (empty($cart)) {
        wp_send_json_error(['message' => 'Корзина пуста']);
        return;
    }

    if (empty($contactInfo)) {
        wp_send_json_error(['message' => 'Контактные данные не переданы']);
        return;
    }

    // Ваши действия с данными (например, создание заказа в WooCommerce)
    try {
        // Создаем заказ
        $order = wc_create_order();

        // Добавляем товары в заказ
        foreach ($cart as $item) {
            $order->add_product(wc_get_product($item['id']), $item['quantity']); // Добавление товара
        }

        // Устанавливаем адрес и контактные данные
        $order->set_address([
            'first_name' => $contactInfo['name'],  // Устанавливаем имя
            'last_name'  => '',  // Установите фамилию, если есть
            'email'      => $contactInfo['email'],
            'phone'      => $contactInfo['phone'],
            'country'    => $contactInfo['country'],
        ], 'billing');

        // Устанавливаем способ оплаты
        $order->set_payment_method($contactInfo['paymentMethod']);
        $order->calculate_totals();

        // Сохраняем заказ
        $order->save();

        // E-mail
        // Отправка email на несколько почтовых адресов
        $to = ['gtsv.market@gmail.com', 'info@osodoso-store.com']; // Укажите здесь почтовые адреса
        $subject = 'osodoso-store.com - Корзина';

        // Подсчитываем итоговое количество товаров и общую сумму
        $total_quantity = 0;
        $total_price = 0;

        foreach ($cart as $item) {
            $total_quantity += $item['quantity'];
            $total_price += $item['quantity'] * $item['price'];
        }

        // Формирование HTML-сообщения
        $message = "
        <html>
        <head>
        <title>Новый заказ на сайте</title>
        <style>
            body {
            font-family: Arial, sans-serif;
            color: #333;
            line-height: 1.6;
            }
            .order-details {
            margin-top: 20px;
            border: 1px solid #ccc;
            padding: 15px;
            border-radius: 5px;
            background-color: #f9f9f9;
            }
            .order-details th, .order-details td {
            padding: 8px 12px;
            border-bottom: 1px solid #ddd;
            }
            .order-details th {
            text-align: left;
            background-color: #f1f1f1;
            }
            .order-details tr:last-child td {
            border-bottom: none;
            }
            .order-contact th {
            text-align: left;
            }
        </style>
        </head>
        <body>
        <h2>Заказ:</h2>
        <p><strong>Данные заказчика:</strong></p>
        <table class='order-contact'>
            <tr>
            <th>Имя:</th>
            <td>{$contactInfo['name']}</td>
            </tr>
            <tr>
            <th>Телефон:</th>
            <td>{$contactInfo['phone']}</td>
            </tr>
            <tr>
            <th>Электронная почта:</th>
            <td>{$contactInfo['email']}</td>
            </tr>
            <tr>
            <th>Страна:</th>
            <td>{$contactInfo['country']}</td>
            </tr>
            <tr>    
            <th>Способ оплаты:</th>
            <td>{$contactInfo['paymentMethod']}</td>
            </tr>
        </table>

        <p><strong>Товары в заказе:</strong></p>
        <table class='order-details'>
            <thead>
            <tr>
                <th>Товар</th>
                <th>Количество</th>
                <th>Цена</th>
            </tr>
            </thead>
            <tbody>";

        foreach ($cart as $item) {
            $message .= "
            <tr>
            <td>{$item['name']}</td>
            <td>{$item['quantity']}</td>
            <td>{$item['price']} $.</td>
            </tr>";
        }

        $message .= "
            </tbody>
        </table>

        <p><strong>Итого:</strong></p>
        <p>Общее количество товаров: {$total_quantity}</p>
        <p>Общая сумма: {$total_price} $.</p>
        </body>
        </html>";

        // Указываем, что сообщение будет в формате HTML
        $headers = [
            'Content-Type: text/html; charset=UTF-8',
        ];

        // Отправка email
        wp_mail($to, $subject, $message, $headers);
        // E-mail

        // Ответ с успешным статусом и URL для редиректа
        $redirect_url = home_url('/shopping-cart-successful'); // Путь к странице успешного оформления заказа
        wp_send_json_success([
            'message' => 'Заказ успешно создан!',
            'redirect_url' => $redirect_url,
        ]);
    } catch (Exception $e) {
        wp_send_json_error(['message' => 'Ошибка при создании заказа: ' . $e->getMessage()]);
    }
}

// START sent_offer_price_mail
function send_offer_price_mail()
{
    if (!isset($_POST['offerForm'])) {
        wp_send_json_error(['message' => 'Данные не переданы']);
        return;
    }

    $offerForm = $_POST['offerForm'];

    if (empty($offerForm)) {
        wp_send_json_error(['message' => 'Контактные данные не переданы']);
        return;
    }

    // Поля из формы
    $price = sanitize_text_field($offerForm['price']);
    $quantity = sanitize_text_field($offerForm['quantity']);
    $name = sanitize_text_field($offerForm['name']);
    $phone = sanitize_text_field($offerForm['phone']);
    $address = sanitize_textarea_field($offerForm['address']);

    // Получатели
    $to = ['gtsv.market@gmail.com', 'info@osodoso-store.com'];

    // Тема письма
    $subject = 'osodoso-store.com - Предложение цены';

    // HTML-шаблон письма
    $message = "
    <html>
    <head>
        <style>
            body {
                font-family: Arial, sans-serif;
                color: #333;
                line-height: 1.6;
            }
            table {
                width: 100%;
                border-collapse: collapse;
                margin: 20px 0;
            }
            th, td {
                padding: 10px;
                border: 1px solid #ddd;
                text-align: left;
            }
            th {
                background-color: #f4f4f4;
            }
            h2 {
                color: #0056b3;
            }
        </style>
    </head>
    <body>
        <h2>Новое предложение цены</h2>
        <table>
            <tr>
                <th>Поле</th>
                <th>Значение</th>
            </tr>
            <tr>
                <td>Цена</td>
                <td>{$price}</td>
            </tr>
            <tr>
                <td>Количество</td>
                <td>{$quantity}</td>
            </tr>
            <tr>
                <td>Имя</td>
                <td>{$name}</td>
            </tr>
            <tr>
                <td>Телефон</td>
                <td>{$phone}</td>
            </tr>
            <tr>
                <td>Адрес</td>
                <td>{$address}</td>
            </tr>
        </table>
    </body>
    </html>";

    // Заголовки письма
    $headers = [
        'Content-Type: text/html; charset=UTF-8',
        'From: osodoso-store.com <no-reply@gtsv-market.com>'
    ];

    // Отправка письма
    if (wp_mail($to, $subject, $message, $headers)) {
        wp_send_json_success(['message' => 'Письмо успешно отправлено']);
    } else {
        wp_send_json_error(['message' => 'Ошибка при отправке письма']);
    }
}

add_action('wp_ajax_send_offer_price_mail', 'send_offer_price_mail');
add_action('wp_ajax_nopriv_send_offer_price_mail', 'send_offer_price_mail');
// END sent_offer_price_mail

add_action('wp_ajax_woocommerce_product_search', 'handle_product_search');
add_action('wp_ajax_nopriv_woocommerce_product_search', 'handle_product_search');


function handle_product_search()
{
    $query = sanitize_text_field($_GET['query']);  // Получение и очистка запроса
    $args = [
        'post_type' => 'product',
        'posts_per_page' => 4,  // Вы можете изменить количество результатов, например, на 10
        's' => $query,
    ];

    $products = new WP_Query($args);
    $results = [];

    if ($products->have_posts()) {
        while ($products->have_posts()) {
            $products->the_post();
            global $product;
            $results[] = [
                'title' => get_the_title(),
                'price' => $product->get_price_html(),
                'image' => get_the_post_thumbnail_url(get_the_ID(), 'thumbnail'),
                'url' => get_permalink(),
            ];
        }
    }

    wp_send_json($results);  // Возвращаем JSON-ответ
    wp_die();
}

add_action('wp_ajax_get_cart_details', 'get_cart_details');
add_action('wp_ajax_nopriv_get_cart_details', 'get_cart_details');

function get_cart_details()
{
    if (!isset($_POST['product_ids']) || empty($_POST['product_ids'])) {
        wp_send_json_error(['message' => 'Нет ID товаров.']);
    }

    $product_ids = array_map('intval', $_POST['product_ids']);
    $products = [];

    foreach ($product_ids as $id) {
        $product = wc_get_product($id); // Получение информации о товаре
        if ($product) {
            $products[] = [
                'id' => $product->get_id(),
                'name' => $product->get_name(),
                'price' => $product->get_price(),
                'image' => wp_get_attachment_image_url($product->get_image_id(), 'thumbnail'),
                'link' => $product->get_permalink()
            ];
        }
    }

    wp_send_json_success($products);
}

// Отправка с модального окна контакты на почты
function send_form_contact_to_mail()
{
    $site = $_SERVER['HTTP_HOST'];

    // Получаем данные из формы и очищаем их
    $phone = sanitize_text_field($_POST["form"]["phone"]);
    $name = sanitize_text_field($_POST["form"]["name"]);

    // Почтовые адреса для отправки
    $to = ['gtsv.market@gmail.com', 'info@osodoso-store.com'];
    $subject = 'osodoso-store.com - Заявка с контактной формы';

    // Шаблон HTML письма
    $message = "
        <html>
        <head>
            <title>osodoso-store.com - Заявка с контактной формы</title>
            <style>
                body {
                    font-family: Arial, sans-serif;
                    line-height: 1.6;
                    color: #333;
                    background-color: #f9f9f9;
                }
                .container {
                    max-width: 600px;
                    margin: 0 auto;
                    background-color: #ffffff;
                    border: 1px solid #ddd;
                    border-radius: 8px;
                    padding: 20px;
                    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
                }
                .header {
                    text-align: center;
                    background-color:rgb(0, 0, 0);
                    color: #ffffff;
                    padding: 15px 0;
                    border-radius: 8px 8px 0 0;
                }
                .header h1 {
                    margin: 0;
                    font-size: 24px;
                }
                .content {
                    padding: 15px;
                }
                .content p {
                    margin: 10px 0;
                }
                .footer {
                    text-align: center;
                    margin-top: 20px;
                    font-size: 12px;
                    color: #777;
                }
            </style>
        </head>
        <body>
            <div class='container'>
                <div class='header'>
                    <h1>{$site}</h1>
                </div>
                <div class='content'>
                    <p><strong>Имя:</strong> {$name}</p>
                    <p><strong>Телефон:</strong> {$phone}</p>
                </div>
                <div class='footer'>
                    Это сообщение было отправлено с контактной формы на сайте {$site}.
                </div>
            </div>
        </body>
        </html>
    ";

    // Заголовки для отправки email в формате HTML
    $headers = [
        'Content-Type: text/html; charset=UTF-8',
    ];

    // Отправка email
    wp_mail($to, $subject, $message, $headers);

    wp_send_json_success([
        'message' => 'Заказ успешно создан!',
    ]);
    // Завершение обработки для AJAX
    wp_die();
}

add_action('wp_ajax_send_form_contact_to_mail', 'send_form_contact_to_mail');
add_action('wp_ajax_nopriv_send_form_contact_to_mail', 'send_form_contact_to_mail');
// Отправка с модального окна контакты на почты

// pagination
function custom_shop_query($query)
{
    if (!is_admin() && $query->is_main_query() && (is_shop() || is_product_category() || is_product_tag())) {
        $query->set('posts_per_page', 12); // Укажите количество продуктов на странице
    }
}
add_action('pre_get_posts', 'custom_shop_query');
// pagination

add_filter('theme_page_templates', function ($templates) {
    // Добавляем новые шаблоны
    $templates['templates/pages/payment.php'] = 'Payment and Delivery';
    $templates['templates/pages/about.php'] = 'About Us';
    $templates['templates/pages/contacts.php'] = 'Contacts';
    $templates['templates/pages/search-results.php'] = 'Search Results';
    $templates['templates/pages/404.php'] = '404';
    $templates['templates/orders/cart.php'] = 'Cart';
    $templates['templates/orders/success.php'] = 'Cart Success';
    return $templates;
});

add_filter('template_include', function ($template) {
    // Обработка шаблона "Payment and Delivery"
    if (get_page_template_slug() === 'templates/pages/payment.php') {
        return get_stylesheet_directory() . '/templates/pages/payment.php';
    }

    // Обработка шаблона "About Us"
    if (get_page_template_slug() === 'templates/pages/about.php') {
        return get_stylesheet_directory() . '/templates/pages/about.php';
    }

    // Обработка шаблона "Contacts"
    if (get_page_template_slug() === 'templates/pages/contacts.php') {
        return get_stylesheet_directory() . '/templates/pages/contacts.php';
    }

    return $template;
});

// Включение редактора Gutenberg для товаров
add_filter('use_block_editor_for_post_type', 'art_enable_rest_for_product', 10, 2);
add_filter('woocommerce_taxonomy_args_product_cat', 'art_show_in_rest_for_product', 10, 1);
add_filter('woocommerce_taxonomy_args_product_tag', 'art_show_in_rest_for_product', 10, 1);
add_filter('woocommerce_register_post_type_product', 'art_show_in_rest_for_product', 10, 1);

/**
 * Включение редактора Gutenberg для товаров
 *
 * @sourcecode https://wpruse.ru/?p=4150
 *
 * @param  bool   $can_edit
 * @param  string $post_type
 *
 * @return bool
 *
 * @author        Artem Abramovich
 * @testedwith    WC 3.9
 */
function art_enable_rest_for_product($can_edit, $post_type)
{

    if ('product' === $post_type) {
        $can_edit = true;
    }

    return $can_edit;
}

/**
 * Включение поддержки REST для товаров
 *
 * @sourcecode https://wpruse.ru/?p=4150
 *
 * @param  array $args
 *
 * @return mixed
 *
 * @author        Artem Abramovich
 * @testedwith    WC 3.9
 */
function art_show_in_rest_for_product($args)
{

    $args['show_in_rest'] = true;

    return $args;
}

// START additional price in page product
// Добавляем дополнительные поля на страницу редактирования продукта
add_action('woocommerce_product_options_pricing', function () {
    echo '<div class="options_group">';

    // Поле "Name Price"
    woocommerce_wp_text_input([
        'id'          => '_name_price',
        'label'       => __('Name Price', 'woocommerce'),
        'desc_tip'    => true,
        'description' => __('Введите название цены.', 'woocommerce'),
    ]);

    // Поле "Code Excel"
    woocommerce_wp_text_input([
        'id'          => '_code_excel',
        'label'       => __('Code Excel', 'woocommerce'),
        'desc_tip'    => true,
        'description' => __('Введите код Excel.', 'woocommerce'),
    ]);

    // Поле "Column Excel"
    woocommerce_wp_text_input([
        'id'          => '_column_excel',
        'label'       => __('Column Excel', 'woocommerce'),
        'desc_tip'    => true,
        'description' => __('Введите колонка Excel.', 'woocommerce'),
    ]);

    // Поле "Price Message"
    woocommerce_wp_text_input([
        'id'          => '_price_message',
        'label'       => __('Price Message', 'woocommerce'),
        'desc_tip'    => true,
        'description' => __('Введите сообщение для цены.', 'woocommerce'),
    ]);

    echo '</div>';
});

// Сохраняем данные дополнительных полей
add_action('woocommerce_process_product_meta', function ($post_id) {
    if (isset($_POST['_name_price'])) {
        update_post_meta($post_id, '_name_price', sanitize_text_field($_POST['_name_price']));
    }

    if (isset($_POST['_code_excel'])) {
        update_post_meta($post_id, '_code_excel', sanitize_text_field($_POST['_code_excel']));
    }

    if (isset($_POST['_column_excel'])) {
        update_post_meta($post_id, '_column_excel', sanitize_text_field($_POST['_column_excel']));
    }

    if (isset($_POST['_price_message'])) {
        update_post_meta($post_id, '_price_message', sanitize_text_field($_POST['_price_message']));
    }
});

// Отображение дополнительных полей на странице продукта
add_action('woocommerce_before_add_to_cart_form', function () {
    global $product;

    $name_price    = get_post_meta($product->get_id(), '_name_price', true);
    $code_excel    = get_post_meta($product->get_id(), '_code_excel', true);
    $column_excel    = get_post_meta($product->get_id(), '_column_excel', true);
    $price_message = get_post_meta($product->get_id(), '_price_message', true);

    if ($name_price) {
        echo '<p><strong>' . __('Name Price:', 'woocommerce') . '</strong> ' . esc_html($name_price) . '</p>';
    }

    if ($code_excel) {
        echo '<p><strong>' . __('Code Excel:', 'woocommerce') . '</strong> ' . esc_html($code_excel) . '</p>';
    }

    if ($column_excel) {
        echo '<p><strong>' . __('Column Excel:', 'woocommerce') . '</strong> ' . esc_html($column_excel) . '</p>';
    }

    if ($price_message) {
        echo '<p><strong>' . __('Price Message:', 'woocommerce') . '</strong> ' . esc_html($price_message) . '</p>';
    }
});
// END additional price in page product

// START ajax pagination page
function load_more_products()
{
    // Global data all site
    $global_settings = get_global_settings(190);
    $phone_number = preg_replace('/\s+/', '', $global_settings['phone']);

    // Получаем текущую страницу
    $paged = isset($_POST['paged']) ? intval($_POST['paged']) : 1;

    // ID категории
    $category = isset($_POST['category_id']) ? intval($_POST['category_id']) : 0;

    // Получаем сортировку (если есть, если пусто - оставляем без сортировки)
    $sort = isset($_POST['sort']) ? sanitize_text_field($_POST['sort']) : '';

    // Получаем фильтры (если есть)
    $filters = [];
    $tax_queries = [];
    $meta_queries = [];

    foreach ($_POST as $key => $value) {
        if (strpos($key, 'filter_') === 0) {
            $attribute = str_replace('filter_', '', $key);
            $values = explode(',', sanitize_text_field($value));

            // Проверяем, является ли атрибут таксономией или мета-данными
            if (taxonomy_exists('pa_' . $attribute)) {
                // Если это таксономия, добавляем в tax_query
                $tax_queries[] = [
                    'taxonomy' => 'pa_' . $attribute,  // Пример: 'pa_brand'
                    'field'    => 'slug',
                    'terms'    => $values,
                    'operator' => 'IN',
                ];
            } else {
                // Если это мета-данные, добавляем в meta_query
                $meta_key = '_' . $attribute; // Пример: '_brand', '_category' и т.д.
                $meta_queries[] = [
                    'key'     => $meta_key,
                    'value'   => $values,
                    'compare' => 'IN',
                ];
            }
        }
    }

    // Создаем базовый массив аргументов для запроса
    $query_args = [
        'paged' => $paged,
        'posts_per_page' => 12, // Количество товаров на странице
        'post_type' => 'product',
        'post_status' => 'publish',
    ];

    // Фильтр по категории, если передан ID
    if ($category > 0) {
        $query_args['tax_query'][] = [
            'taxonomy' => 'product_cat', // Таксономия WooCommerce для категорий товаров
            'field'    => 'id',
            'terms'    => $category,
        ];
    }

    // Добавление tax_query (если есть фильтры по таксономиям)
    if (!empty($tax_queries)) {
        $query_args['tax_query'] = $tax_queries;
    }

    // Добавление meta_query (если есть фильтры по мета-данным)
    if (!empty($meta_queries)) {
        $query_args['meta_query'] = $meta_queries;
    }

    // Сортировка (если передана)
    if ($sort) {
        if ($sort == 'price_asc') {
            $query_args['orderby'] = 'meta_value_num';
            $query_args['meta_key'] = '_price';
            $query_args['order'] = 'ASC';
        } elseif ($sort == 'price_desc') {
            $query_args['orderby'] = 'meta_value_num';
            $query_args['meta_key'] = '_price';
            $query_args['order'] = 'DESC';
        } elseif ($sort == 'popularity') {
            $query_args['orderby'] = 'meta_value_num';
            $query_args['meta_key'] = 'total_sales';
            $query_args['order'] = 'DESC';
        }
    }

    // Получаем товары
    $query = new WP_Query($query_args);

    ob_start();

    if ($query->have_posts()) :
        while ($query->have_posts()) : $query->the_post();
            global $product;
        ?>
            <!-- product cart -->
            <?php get_template_part('templates/partials/product-card'); ?>
            <!-- product cart -->
    <?php
        endwhile;
    else :
        echo '<p>No products found</p>';
    endif;

    $products_html = ob_get_clean();

    // Генерация новой пагинации
    // Генерация HTML для пагинации
    $pagination_html = generate_custom_pagination($query->max_num_pages, $paged);

    // Возвращаем JSON с товарами и кастомной пагинацией
    wp_send_json_success([
        'products'   => $products_html,
        'pagination' => $pagination_html,
    ]);

    wp_die(); // Останавливает выполнение
}
add_action('wp_ajax_load_more_products', 'load_more_products');
add_action('wp_ajax_nopriv_load_more_products', 'load_more_products');
// END ajax pagination page

// START custom pagination
function generate_custom_pagination($total_pages, $current_page)
{
    // Проверяем, есть ли больше одной страницы
    if ($total_pages <= 1) {
        return '';
    }

    // Начинаем формировать HTML для пагинации
    $pagination_html = '<ul>';

    // Добавляем кнопку "назад", если это не первая страница
    if ($current_page > 1) {
        $prev_link = get_pagenum_link($current_page - 1);
        $pagination_html .= '<li class="pagination-item" data-page="' . ($current_page - 1) . '">';
        $pagination_html .= '<a class="prev page-numbers" href="' . esc_url($prev_link) . '">&lt;</a>';
        $pagination_html .= '</li>';
    }

    // Генерация ссылок на страницы
    for ($i = 1; $i <= $total_pages; $i++) {
        $is_active = $i == $current_page ? ' active' : '';
        $aria_current = $i == $current_page ? ' aria-current="page"' : '';
        $link = get_pagenum_link($i);

        if ($i == $current_page) {
            $pagination_html .= '<li class="pagination-item' . $is_active . '" data-page="' . $i . '">';
            $pagination_html .= '<span class="page-numbers current"' . $aria_current . '>' . $i . '</span>';
            $pagination_html .= '</li>';
        } else {
            $pagination_html .= '<li class="pagination-item' . $is_active . '" data-page="' . $i . '">';
            $pagination_html .= '<a class="page-numbers" href="' . esc_url($link) . '">' . $i . '</a>';
            $pagination_html .= '</li>';
        }
    }

    // Добавляем кнопку "вперед", если это не последняя страница
    if ($current_page < $total_pages) {
        $next_link = get_pagenum_link($current_page + 1);
        $pagination_html .= '<li class="pagination-item" data-page="' . ($current_page + 1) . '">';
        $pagination_html .= '<a class="next page-numbers" href="' . esc_url($next_link) . '">&gt;</a>';
        $pagination_html .= '</li>';
    }

    $pagination_html .= '</ul>';

    return $pagination_html;
}
// END custom pagination

// START show in main page is categories WooCommerce
// Добавляем поле "Выводить на главной" и "Порядок" в админке при создании категории
function add_category_fields()
{
    ?>
    <div class="form-field">
        <label for="show_on_homepage"><?php _e('Выводить на главной', 'textdomain'); ?></label>
        <input type="checkbox" name="show_on_homepage" id="show_on_homepage" value="1">
        <p><?php _e('Отметьте, если категория должна отображаться на главной странице.', 'textdomain'); ?></p>
    </div>
    <div class="form-field">
        <label for="display_order"><?php _e('Порядок вывода', 'textdomain'); ?></label>
        <input type="number" name="display_order" id="display_order" value="0">
        <p><?php _e('Чем меньше значение, тем выше категория.', 'textdomain'); ?></p>
    </div>
<?php
}
add_action('product_cat_add_form_fields', 'add_category_fields');

// Добавляем поля для редактирования категории
function edit_category_fields($term)
{
    $show_on_homepage = get_term_meta($term->term_id, 'show_on_homepage', true);
    $display_order = get_term_meta($term->term_id, 'display_order', true);
?>
    <tr class="form-field">
        <th scope="row"><label for="show_on_homepage"><?php _e('Выводить на главной', 'textdomain'); ?></label></th>
        <td>
            <input type="checkbox" name="show_on_homepage" id="show_on_homepage" value="1" <?php checked($show_on_homepage, '1'); ?>>
            <p class="description"><?php _e('Отметьте, если категория должна отображаться на главной странице.', 'textdomain'); ?></p>
        </td>
    </tr>
    <tr class="form-field">
        <th scope="row"><label for="display_order"><?php _e('Порядок вывода', 'textdomain'); ?></label></th>
        <td>
            <input type="number" name="display_order" id="display_order" value="<?php echo esc_attr($display_order); ?>">
            <p class="description"><?php _e('Чем меньше значение, тем выше категория.', 'textdomain'); ?></p>
        </td>
    </tr>
<?php
}
add_action('product_cat_edit_form_fields', 'edit_category_fields');

// Сохраняем данные мета-полей
function save_category_fields($term_id)
{
    if (isset($_POST['show_on_homepage'])) {
        update_term_meta($term_id, 'show_on_homepage', '1');
    } else {
        update_term_meta($term_id, 'show_on_homepage', '');
    }
    if (isset($_POST['display_order'])) {
        update_term_meta($term_id, 'display_order', sanitize_text_field($_POST['display_order']));
    }
}
add_action('edited_product_cat', 'save_category_fields');
add_action('create_product_cat', 'save_category_fields');
// END show in main page is categories WooCommerce

// START 404 page
function custom_404_page()
{
    if (is_404()) { // Проверяем, что это страница 404
        include(get_template_directory() . '/templates/pages/404.php'); // Подключаем ваш файл 404.php
        exit; // Останавливаем дальнейшую загрузку WordPress
    }
}
add_action('template_redirect', 'custom_404_page');
// END 404 page

// START pattern block description
function my_custom_block_patterns()
{
    if (function_exists('register_block_pattern')) {
        $domain = get_site_url();
        register_block_pattern(
            'mytheme/product-info',
            array(
                'title'       => __('Product Info', 'mytheme'),
                'description' => _x('Блок информации о продукте', 'Block pattern description', 'mytheme'),
                'content'     => '
<div class="product-info">
    <div class="product-info__section">
        <div class="product-info__text">
            <h2>Why Buy the Lenovo Legion Pro 7 from Us?</h2>
            <p>
                When you purchase the Intel Xeon 6710E from us, you’re choosing reliability, value, and quality service. As a trusted supplier, we ensure direct imports from official sources, guaranteeing the authenticity of every processor. With our competitive pricing, you’ll find this high-performance CPU available for less than the recommended price on the official website. Enjoy fast shipping, expert customer support, and a hassle-free purchasing experience tailored to your needs.
            </p>
        </div>
        <div class="product-info__image">
            <img src="' . esc_url($domain . '/wp-content/uploads/2024/12/macbook-air-m3-16gb-512gb-5.webp') . '" alt="" width="200" height="200"/>
        </div>
    </div>

    <div class="product-info__section product-info__section--reverse">
        <div class="product-info__image">щы
            <img src="' . esc_url($domain . '/wp-content/uploads/2024/12/macbook-air-m3-16gb-512gb-5.webp') . '" alt="" width="200" height="200"/>
        </div>
        <div class="product-info__text">
            <h3>Boost your gaming experience with <strong>Lenovo Legion Pro 7</strong></h3>
            <p>
                The Intel Xeon 6710E is a cutting-edge processor designed for enterprise workloads and advanced computing environments. Featuring up to <strong>32 cores</strong> and <strong>64 threads</strong>, it delivers unparalleled multitasking capabilities, ensuring optimal performance for demanding applications. Built on Intel’s <strong>advanced 10nm technology</strong>, it supports <strong>DDR5 memory</strong> and <strong>PCIe 5.0</strong>, enabling faster data transfer and improved efficiency. With enhanced security features and a power-efficient architecture, the Xeon 6710E is perfect for modern data centers, AI tasks, and high-performance computing.
            </p>
        </div>
    </div>

    <div class="product-info__cta">
        <h4>Order Your Intel Xeon 6710E Today!</h4>
        <p>Upgrade your system with the Intel Xeon 6710E and experience next-level performance. Don’t miss out on this incredible offer—shop with us today and power your workloads with confidence!</p>
    </div>
</div>',
            )
        );
    }
}
add_action('init', 'my_custom_block_patterns');

// END pattern block description