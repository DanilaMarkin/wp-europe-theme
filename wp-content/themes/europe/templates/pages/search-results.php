<?php
/* Template Name: Search Results */
europe_get_header();

$query = isset($_GET['query']) ? sanitize_text_field($_GET['query']) : '';
$args = [
    'post_type' => 'product',
    's' => $query,
    'posts_per_page' => -1, // Все результаты
];
$products = new WP_Query($args);
?>

<main class="search-results container">
    <h1><?= the_title(); ?> for "<?php echo esc_html($query); ?>"</h1>
    <?php if ($products->have_posts()) : ?>
        <section>
            <ul class="general-main-products-blocks-cards products-blocks-cards">
                <?php while ($products->have_posts()) : $products->the_post();
                    global $product; ?>
                    <li class="products-blocks-id products-blocks-card" data-id="<?= $product->get_id(); ?>">
                        <div class="products-blocks-card-preview">
                            <a href="<?php echo get_permalink($product->get_id()); ?>">
                                <?php
                                $thumbnail_id = $product->get_image_id();
                                $alt_text = get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true);
                                $title_text = get_the_title($thumbnail_id);
                                ?>
                                <img src="<?php echo wp_get_attachment_image_url($thumbnail_id, 'thumbnail'); ?>"
                                    srcset="<?php echo wp_get_attachment_image_srcset($thumbnail_id); ?>"
                                    alt="<?php echo esc_attr($alt_text ?: $product->get_name()); ?>"
                                    title="<?php echo esc_attr($title_text ?: $product->get_name()); ?>"
                                    class="products-blocks-card-preview-image">
                            </a>
                            <h2 class="products-blocks-card-preview-title"><?php the_title(); ?></h2>
                            <span class="products-blocks-card-preview-price">from <?php echo $product->get_price_html(); ?></span>
                        </div>
                        <div class="products-blocks-card-btn">
                            <div class="products-blocks-card-btn-contact-full">
                                <button class="products-blocks-card-btn-contact-full-general products-blocks-card-btn-contact-full-wa">
                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/whatsapp.svg" alt="">
                                </button>
                                <button class="products-blocks-card-btn-contact-full-general products-blocks-card-btn-contact-full-tg">
                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/telegram-sidemenu.svg" alt="">
                                </button>
                            </div>
                            <div class="products-blocks-card-btn-count">
                                <button class="count-btn minus" aria-label="Уменьшить количество">-</button>
                                <span class="count-number">0</span>
                                <button class="count-btn plus" aria-label="Увеличить количество">+</button>
                            </div>
                            <button class="products-blocks-card-btn-general products-blocks-card-btn-contact">Contact us</button>
                            <button class="products-blocks-card-btn-general products-blocks-card-btn-cart">
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/cart.svg" alt="">
                            </button>
                        </div>
                    </li>
                <?php endwhile; ?>
            </ul>
        </section>
    <?php else : ?>
        <p class="search-result-empty">No products found for your query.</p>
    <?php endif; ?>
</main>

<?php
europe_get_footer();
