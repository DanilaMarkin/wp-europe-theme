<?php
// WooCommerce шаблон
get_header();

if (is_shop() || is_product_category() || is_product_tag()) {
    woocommerce_content(); // Выводим контент WooCommerce
}

get_footer();
