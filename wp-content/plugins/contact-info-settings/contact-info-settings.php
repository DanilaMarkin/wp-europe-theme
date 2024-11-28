<?php
/*
Plugin Name: Contact Info Settings
Description: Настройки контактной информации для сайта.
Version: 1.0
Author: Данила Маркин
*/

// Регистрируем настройки
function contact_info_register_settings()
{
    // Регистрируем поля для почты, телефона и адреса
    register_setting('contact_info_group', 'contact_info_email');
    register_setting('contact_info_group', 'contact_info_email_down_descr');
    register_setting('contact_info_group', 'contact_info_phone');
    register_setting('contact_info_group', 'contact_info_phone_down_descr');
    register_setting('contact_info_group', 'contact_info_address');
    register_setting('contact_info_group', 'contact_info_address_down_descr');
}
add_action('admin_init', 'contact_info_register_settings');

// Добавляем меню в админку
function contact_info_menu()
{
    add_menu_page(
        'Контактная инфорация',  // Название страницы
        'Конт. инфо',  // Название меню
        'manage_options',         // Права доступа
        'contact-info',           // Слаг
        'contact_info_page',      // Функция отображения страницы
        'dashicons-phone',        // Иконка
        25                        // Позиция в меню
    );
}
add_action('admin_menu', 'contact_info_menu');

// Страница настроек
function contact_info_page()
{
?>
    <div class="wrap">
        <h1>Настройки контактной информации</h1>
        <form method="post" action="options.php">
            <?php
            settings_fields('contact_info_group');
            ?>
            <table class="form-table">
                <tr valign="top">
                    <th scope="row">Электронная почта</th>
                    <td><input type="text" name="contact_info_email" value="<?php echo get_option('contact_info_email'); ?>" /></td>
                </tr>
                <tr valign="top">
                    <th scope="row">Электронная почта(Нижнее описание)</th>
                    <td><input type="text" name="contact_info_email_down_descr" value="<?php echo get_option('contact_info_email_down_descr'); ?>" /></td>
                </tr>
                <tr valign="top">
                    <th scope="row">Телефон</th>
                    <td><input type="text" name="contact_info_phone" value="<?php echo get_option('contact_info_phone'); ?>" /></td>
                </tr>
                <tr valign="top">
                    <th scope="row">Телефон(Нижнее описание)</th>
                    <td><input type="text" name="contact_info_phone_down_descr" value="<?php echo get_option('contact_info_phone_down_descr'); ?>" /></td>
                </tr>
                <tr valign="top">
                    <th scope="row">Адрес</th>
                    <td><input type="text" name="contact_info_address" value="<?php echo get_option('contact_info_address'); ?>" /></td>
                </tr>
                <tr valign="top">
                    <th scope="row">Адрес(Нижнее описание)</th>
                    <td><input type="text" name="contact_info_address_down_descr" value="<?php echo get_option('contact_info_address_down_descr'); ?>" /></td>
                </tr>
            </table>
            <?php submit_button(); ?>
        </form>
    </div>
<?php
}
