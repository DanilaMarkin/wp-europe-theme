<?php
/* Template Name: Search Results */
europe_get_header();

// Global data all site
$global_settings = get_global_settings(190);

$phone_number = preg_replace('/\s+/', '', $global_settings['phone']);

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
                            <?php if ($product->get_price_html()) { ?>
                                <span class="products-blocks-card-preview-price">from <?php echo $product->get_price_html(); ?></span>
                            <?php } else { ?>
                                <span class="products-blocks-card-preview-price">Price On Request</span>
                            <?php } ?>
                        </div>
                        <div class="products-blocks-card-btn">
                            <div class="products-blocks-card-btn-contact-full">
                                <a href="https://wa.me/<?php echo esc_attr($phone_number); ?>" target="_blank" rel="noopener noreferrer" aria-label="Open WhatsApp chat with <?php echo htmlspecialchars($phone_number); ?>" title="Open WhatsApp chat with <?php echo htmlspecialchars($phone_number); ?>" class="products-blocks-card-btn-contact-full-general products-blocks-card-btn-contact-full-wa">
                                    <img src="<?= get_template_directory_uri(); ?>/assets/icons/whatsapp.svg" alt="Open WhatsApp chat with <?php echo htmlspecialchars($phone_number); ?>">
                                </a>
                                <a href="https://t.me/<?php echo esc_attr($phone_number); ?>" target="_blank" rel="noopener noreferrer" aria-label="Open Telegram chat with <?php echo htmlspecialchars($phone_number); ?>" title="Open Telegram chat with <?php echo htmlspecialchars($phone_number); ?>" class="products-blocks-card-btn-contact-full-general products-blocks-card-btn-contact-full-tg">
                                    <img src="<?= get_template_directory_uri(); ?>/assets/icons/telegram-sidemenu.svg" alt="Open Telegram chat with <?php echo htmlspecialchars($phone_number); ?>">
                                </a>
                            </div>
                            <div class="products-blocks-card-btn-count">
                                <button class="count-btn minus" aria-label="Уменьшить количество">-</button>
                                <span class="count-number">0</span>
                                <button class="count-btn plus" aria-label="Увеличить количество">+</button>
                            </div>
                            <button class="products-blocks-card-btn-general products-blocks-card-btn-contact">Request</button>
                            <button class="products-blocks-card-btn-general products-blocks-card-btn-cart">
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/cart.svg" alt="">
                            </button>
                        </div>
                    </li>
                <?php endwhile; ?>
            </ul>
            <!-- notification add cart -->
            <?php get_template_part('templates/notifications/notification-empty'); ?>
            <!-- notification add cart -->
        </section>
    <?php else : ?>
        <p class="search-result-empty">No products found for your query.</p>
    <?php endif; ?>
</main>

<?php
europe_get_footer();
