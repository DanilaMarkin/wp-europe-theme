<?php

/**
 * Template Name: Custom Single Product
 * Template Post Type: product
 */
europe_get_header();
?>

<main class="product-single">
    <section class="product-single-header container">
        <h1 class="product-single-header-title"><?php the_title(); ?></h1>

        <div class="product-single-header-configuration">
            <h2 class="product-single-header-configuration-title">Configuration</h2>
            <ul class="product-single-header-configuration-items">
                <li class="product-single-header-configuration-item">
                    Item 1
                </li>
                <li class="product-single-header-configuration-item">
                    Item 2
                </li>
                <li class="product-single-header-configuration-item">
                    Item 3
                </li>
                <li class="product-single-header-configuration-item">
                    Item 4
                </li>
            </ul>
        </div>

        <div class="product-single-header-btn">
            <button class="product-single-header-btn-general product-single-header-btn-contact">Contact us</button>
            <button class="product-single-header-btn-general product-single-header-btn-price"><?php echo wc_price(get_post_meta(get_the_ID(), '_price', true)); ?></button>
        </div>

        <div class="product-gallery">
            <figure class="main-image">
                <?php if (has_post_thumbnail()) : ?>
                    <?php the_post_thumbnail('large'); ?>
                <?php endif; ?>
            </figure>
            <?php
            $gallery = get_post_meta(get_the_ID(), '_product_image_gallery', true);
            $gallery_ids = explode(',', $gallery);

            if (!empty($gallery_ids)) {
                echo '<ul class="thumbnail-gallery">';
                foreach ($gallery_ids as $attachment_id) {
                    $image_url = wp_get_attachment_url($attachment_id);
                    $image_alt = get_post_meta($attachment_id, '_wp_attachment_image_alt', true) ?: get_the_title($attachment_id);

                    echo '<li>
                    <figure><img src="' . esc_url($image_url) . '" alt="' . esc_attr($image_alt) . '"></figure>
                </li>';
                }
                echo '</ul>';
            } else {
                echo 'Галерея пуста.';
            }
            ?>
        </div>

    </section>

    <section class="product-single-description">
        <div class="container">
            <h2 class="product-single-description-title">Description</h2>
            <?php
            $descr = get_the_content();
            if (!empty(trim($descr))) {
            ?>
                <p class="product-single-description-text"><?= $descr ?></p>
            <?php } else { ?>
                <p class="product-single-description-text">There's nothing here yet</p>
            <?php } ?>
        </div>
    </section>

    <section class="product-single-feature container">
        <h2 class="product-single-feature-title">Characteristics</h2>
        <?php
        // Получаем характеристики из мета-данных
        $characteristics = get_post_meta(get_the_ID(), 'product_characteristics', true);

        if (!empty($characteristics)) {
            echo '<dl class="product-specs">';

            // Выводим каждую характеристику
            foreach ($characteristics as $characteristic) {
                echo '<dt>' . esc_html($characteristic['name']) . '</dt>';
                echo '<dd>' . esc_html($characteristic['value']) . '</dd>';
            }

            echo '</dl>';
        } else {
            echo "There's nothing here yet.";
        }
        ?>
    </section>

    <section class="related-products">
        <div class="container">
            <h2 class="related-products-title">Related Products</h2>
            <ul class="related-products-items">
                <li class="related-products-item">
                    <a href="/">
                        <div class="related-products-item-preview">
                            <img src="https://c.dns-shop.ru/thumb/st1/fit/500/500/8f6baee7d0e6e26b0be2655f3ba62a15/ff08f890aa46d09aab8f054d2ef8cbfbe7e2e61642541a304093deea91790a22.jpg" alt="" class="related-products-item-preview-img">
                        </div>
                        <div class="related-products-item-info">
                            <h3 class="related-products-item-info-title">DELL EMC PowerEdge R630 (8xSFF/3xLP) Performance Rack</h3>
                            <p class="related-products-item-info-price">from $428</p>
                        </div>
                    </a>
                </li>
            </ul>
        </div>
    </section>
</main>

<?php europe_get_footer(); ?>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const listsConfig = document.querySelector(".product-single-header-configuration-items");

        listsConfig.addEventListener("click", function(event) {
            const itemConfig = event.target;

            // Проверяем, что клик был по элементу списка
            if (itemConfig && itemConfig.classList.contains("product-single-header-configuration-item")) {
                const itemsConfig = listsConfig.querySelectorAll(".product-single-header-configuration-item");

                // Убираем класс active у всех элементов
                itemsConfig.forEach(i => i.classList.remove('active'));

                // Добавляем класс active к выбранному элементу
                itemConfig.classList.add('active');
            }
        });
    });
</script>