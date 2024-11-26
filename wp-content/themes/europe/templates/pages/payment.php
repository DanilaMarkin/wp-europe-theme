<?php
/* Template Name: Payment and Delivery */

europe_get_header();
?>

<style>
    .page-title {
        font-weight: 700;
        font-size: 32px;
        margin: 60px 0 40px 0;
    }

    .page-content p {
        font-size: 20px;
    }

    .page-content h2 {
        font-weight: 600;
        font-size: 30px;
        margin: 60px 0 40px 0;
    }

    .page-content h3 {
        font-weight: 700;
        font-size: 20px;
        margin-bottom: 15px;
    }

    .page-content ul {
        margin-top: 15px;
    }

    .page-content ul li {
        font-size: 20px;
        list-style: disc;
        margin-left: 20px;
    }

    .wp-block-group__inner-container {
        margin: 40px 0;
    }

    @media (max-width: 768px) {
        .page-title {
            font-size: 16px;
            margin: 30px 0 20px 0;
        }

        .page-content p,
        .page-content ul li {
            font-size: 12px;
        }

        .page-content h2 {
            font-size: 15px;
            margin: 30px 0 20px 0;
        }

        .page-content h3 {
            font-size: 12px;
            margin-bottom: 10px;
        }

        .wp-block-group__inner-container {
            margin: 20px 0;
        }
    }
</style>

<main class="page-content">
    <section class="container">
        <h1 class="page-title"><?php the_title(); ?></h1>
        <div class="page-content">
            <?php
            if (have_posts()) {
                while (have_posts()) {
                    the_post();
                    the_content();
                }
            }
            ?>
        </div>
    </section>
</main>

<?php
europe_get_footer();
?>