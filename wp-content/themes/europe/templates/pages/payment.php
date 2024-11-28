<?php
/* Template Name: Payment and Delivery */
europe_get_header();
?>

<main class="page-content-main">
    <section class="container payment-block">
        <h1 class="page-title"><?= the_title(); ?></h1>
        <div class="page-content">
            <?php
            if (have_posts()) {
                while (have_posts()) {
                    the_post();
                    the_content();
                }
            } else {
                echo "<p>There's nothing here yet</p>";
            }
            ?>
        </div>
    </section>
</main>

<?php
europe_get_footer();
?>