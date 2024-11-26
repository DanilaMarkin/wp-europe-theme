<?php
class Custom_Walker_Nav_Menu_Pages extends Walker_Nav_Menu
{
    function start_el(&$output, $item, $depth = 0, $args = null, $id = 0)
    {
        if ($depth === 0) {
            $output .= '<li>';
            $output .= '<a href="' . esc_url($item->url) . '" title="' . esc_attr($item->attr_title) . '">';
            $output .= esc_html($item->title);
            $output .= '</a>';
            $output .= '</li>';
        }
    }
}