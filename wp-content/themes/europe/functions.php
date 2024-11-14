<?php
// Подключаем стили и скрипты темы
function europe_enqueue_styles()
{
    // Подключаем основной файл стилей
    wp_enqueue_style('europe-style', get_stylesheet_uri());
    // Подключаем дополнительные стили
    wp_enqueue_style('europe-reset', get_template_directory_uri() . '/assets/css/reset.css');
    wp_enqueue_style('europe-global', get_template_directory_uri() . '/assets/css/global.css');
    wp_enqueue_style('europe-header', get_template_directory_uri() . '/assets/css/header.css');
    wp_enqueue_style('europe-footer', get_template_directory_uri() . '/assets/css/footer.css');
    wp_enqueue_style('europe-woocommerce', get_template_directory_uri() . '/assets/css/woocommerce.css');
}
add_action('wp_enqueue_scripts', 'europe_enqueue_styles');

// Поддержка WooCommerce в теме
function europe_woocommerce_setup()
{
    add_theme_support('woocommerce');
}
add_action('after_setup_theme', 'europe_woocommerce_setup');

function europe_get_header()
{
    get_template_part('partials/header');
}

function europe_get_footer()
{
    get_template_part('partials/footer');
}
