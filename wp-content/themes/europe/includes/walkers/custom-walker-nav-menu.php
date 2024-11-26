<?php
class Custom_Walker_Nav_Menu extends Walker_Nav_Menu
{

    // Начало каждого элемента меню
    function start_el(&$output, $item, $depth = 0, $args = null, $id = 0)
    {
        if ($depth === 0) { // Только для первого уровня

            // Получаем мета-данные для текущего пункта меню
            $menu_meta = get_post_meta($item->ID);

            // Изображение пункта меню
            $menu_image = isset($menu_meta['_menu_list_image']) ? $menu_meta['_menu_list_image'][0] : '';

            // Получаем ID изображения
            $image_id = isset($menu_meta['_menu_list_image_id']) ? $menu_meta['_menu_list_image_id'][0] : '';

            // Получаем alt  для изображения
            $menu_image_alt = $image_id ? get_post_meta($image_id, '_wp_attachment_image_alt', true) : '';
            // Получаем заголовок изображения по ID
            $menu_image_title = $image_id ? get_the_title($image_id) : '';

            // Если alt не задан, используем title как fallback
            if (empty($menu_image_alt)) {
                $menu_image_alt = $item->title;
            }

            // Начало вывода HTML
            $output .= '<li>';
            $output .= '<a href="' . esc_url($item->url) . '" title="' . esc_attr($item->attr_title) . '">';
            $output .= '<img src="' . esc_url($menu_image) . '"  title="' . esc_attr($menu_image_title) . '"  alt="' . esc_attr($menu_image_alt) . '"> ' . esc_html($item->title);
            $output .= '</a>';
        }
    }
}
