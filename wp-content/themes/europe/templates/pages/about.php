<?php
/* Template Name: About Us */
europe_get_header();
?>

<main class="page-content-main">
    <section class="container about-block">
        <h1 class="page-title"><?= the_title(); ?></h1>
        <div class="page-content about-content">
            <?php
            $content = get_the_content(); // Получаем контент без вывода
            if (!empty($content)) {
                echo apply_filters('the_content', $content); // Применяем фильтры и выводим контент
            } else {
                echo "<p>There's nothing here yet</p>";
            }
            ?>
        </div>
    </section>
    <section class="brands">
        <div class="brands-blocks container">
            <h2 class="brands-title">Our Brands</h2>
            <div class="brands-blocks-slider">
                <button class="brands-blocks-slider-down">
                    <img src="" alt="">
                </button>
                <ul class="brands-blocks-slider-lists">
                    <li class="brands-blocks-slider-lists-circle">
                        <a href="#">
                            <h3>Apple</h3>
                        </a>
                    </li>
                    <li class="brands-blocks-slider-lists-circle">
                        <a href="#">
                            <h3>Asus</h3>
                        </a>
                    </li>
                    <li class="brands-blocks-slider-lists-circle">
                        <a href="#">
                            <h3>SuperMicro</h3>
                        </a>
                    </li>
                    <li class="brands-blocks-slider-lists-circle">
                        <a href="#">
                            <h3>Intel</h3>
                        </a>
                    </li>
                    <li class="brands-blocks-slider-lists-circle">
                        <a href="#">
                            <h3>AMD</h3>
                        </a>
                    </li>
                    <li class="brands-blocks-slider-lists-circle">
                        <a href="#">
                            <h3>Gigabyte</h3>
                        </a>
                    </li>
                </ul>
                <button class="brands-blocks-slider-next">
                    <img src="" alt="">
                </button>
            </div>
        </div>
    </section>
    <section class="all-categories container">
        <a href="#" class="all-categories-blocks" title="View all categories">
            <h2 class="all-categories-blocks-title">View All Categories</h2>
            <div class="all-categories-blocks-arrow">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/arrow_all.svg" alt="View all categories" class="all-categories-blocks-arrow-img">
            </div>
        </a>
    </section>
</main>

<?php
europe_get_footer();
?>