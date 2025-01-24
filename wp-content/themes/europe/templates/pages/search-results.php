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
                    <!-- product cart -->
                    <?php get_template_part('templates/partials/product-card'); ?>
                    <!-- product cart -->
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
