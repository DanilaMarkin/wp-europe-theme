<?php
// Подключаем стили темы
function europe_enqueue_styles()
{
    wp_enqueue_style('europe-style', get_stylesheet_uri());
    wp_enqueue_style('europe-reset', get_template_directory_uri() . '/assets/css/reset.css');
    wp_enqueue_style('europe-global', get_template_directory_uri() . '/assets/css/global.css');
    wp_enqueue_style('europe-header', get_template_directory_uri() . '/assets/css/header.css');
    wp_enqueue_style('europe-footer', get_template_directory_uri() . '/assets/css/footer.css');
    wp_enqueue_style('europe-woocommerce', get_template_directory_uri() . '/assets/css/woocommerce.css');
}
add_action('wp_enqueue_scripts', 'europe_enqueue_styles');

// Подключаем скрипты темы
function enqueue_custom_scripts()
{
    wp_enqueue_script('main-script', get_template_directory_uri() . '/assets/js/main.js', array('jquery'), null, true);
    wp_enqueue_script('store-script', get_template_directory_uri() . '/assets/js/store.js', array('jquery'), null, true);
}
add_action('wp_enqueue_scripts', 'enqueue_custom_scripts');


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

// Регистрация меню в теме
function register_my_menus()
{
    register_nav_menus(
        array(
            'side-menu-categories' => __('Categories Menu'),
            'side-menu-brands' => __('Brands Menu'),
        )
    );
}
add_action("init", "register_my_menus");

class Custom_Walker_Nav_Menu extends Walker_Nav_Menu
{
    // Вывод пункта меню
    function start_el(&$output, $item, $depth = 0, $args = null, $id = 0)
    {
        if ($depth === 0) {
            // Элементы верхнего уровня
            $output .= '<li class="menu-blocks-link">';

            // Проверка на наличие дочерних элементов
            if (in_array('menu-item-has-children', $item->classes)) {
                $output .= '<button class="menu-blocks-link-toggle" aria-expanded="false"';
                // Используем атрибут title, если он задан, иначе используем название
                $title = !empty($item->attr_title) ? $item->attr_title : $item->title;
                $output .= ' title="' . esc_attr($title) . '"';
                $output .= '>';
                $output .= '<span>' . esc_html($item->title) . '</span>';
                $output .= '<img src="' . get_template_directory_uri() . '/assets/icons/arrow-list.svg" alt="Expand subcategories">';
                $output .= '</button>';
            } else {
                $output .= '<a href="' . esc_url($item->url) . '"';
                // Используем атрибут title, если он задан, иначе используем название
                $title = !empty($item->attr_title) ? $item->attr_title : $item->title;
                $output .= ' title="' . esc_attr($title) . '"';
                $output .= '>' . esc_html($item->title) . '</a>';
            }
        } else {
            // Элементы подменю (вложенные элементы)
            $output .= '<li>';
            $output .= '<a href="' . esc_url($item->url) . '"';
            // Используем атрибут title, если он задан, иначе используем название
            $title = !empty($item->attr_title) ? $item->attr_title : $item->title;
            $output .= ' title="' . esc_attr($title) . '"';
            $output .= '>' . esc_html($item->title) . '</a>';
        }
    }

    // Открытие подменю
    function start_lvl(&$output, $depth = 0, $args = null)
    {
        // Добавляем класс только на первом уровне вложенности
        if ($depth === 0) {
            $output .= '<ul class="menu-blocks-links-submenu">';
        } else {
            $output .= '<ul>';
        }
    }

    // Закрытие подменю
    function end_lvl(&$output, $depth = 0, $args = null)
    {
        $output .= '</ul>';
    }

    // Закрытие пункта меню
    function end_el(&$output, $item, $depth = 0, $args = null)
    {
        $output .= '</li>';
    }
}
