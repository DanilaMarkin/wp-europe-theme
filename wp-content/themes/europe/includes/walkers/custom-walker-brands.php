<?php
class Custom_Walker_Brands extends Walker_Nav_Menu
{
    function start_el(&$output, $item, $depth = 0, $args = null, $id = 0)
    {
        if ($depth === 0) {
            $output .= '<li class="brands-blocks-slider-lists-circle">';
            $output .= '<a href="' . esc_url($item->url) . '" title="' . esc_attr($item->attr_title) . '">';
            $output .= '<h3>';
            $output .= esc_html($item->title);
            $output .= '</h3>';
            $output .= '</a>';
            $output .= '</li>';
        }
    }
}