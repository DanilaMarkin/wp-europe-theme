<?php
class Custom_Walker_Side_Menu extends Walker_Nav_Menu
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
