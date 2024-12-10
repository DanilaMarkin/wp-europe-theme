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

        <div class="product-single-header-prices">
            <ul class="product-single-header-prices-items">
                <li>
                    <p>B2B Price</p>
                    <div class="product-single-header-prices-item">
                        <span><?php echo wc_price(get_post_meta(get_the_ID(), '_price', true)); ?></span>
                        <img src="<?= get_template_directory_uri() ?>/assets/icons/information.svg" title="More information" alt="Information icon">
                    </div>
                </li>
                <li>
                    <p>Retail Price</p>
                    <div class="product-single-header-prices-item">
                        <span>$412</span>
                        <img src="<?= get_template_directory_uri() ?>/assets/icons/information.svg" title="More information" alt="Information icon">
                    </div>
                </li>
            </ul>
            <button class="offer-btn">Offer your Price <img src="<?= get_template_directory_uri() ?>/assets/icons/information.svg" title="More information" alt="Information icon"></button>
        </div>

        <div class="product-single-header-btn">
            <button class="product-single-header-btn-general product-single-header-btn-contact">Contact us</button>
            <button class="product-single-header-btn-general product-single-header-btn-price">
                <img src="<?= get_template_directory_uri() ?>/assets/icons/cart.svg" alt="Cart icon" class="product-block-cart-img">
            </button>
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

    <section class="configuration">
        <div class="container">
            <h2 class="configuration-title">Configuration</h2>
            <ul class="config-items">
                <li class="config-item">
                    Lenovo ThinkPad P1 Gen 7 MOBILE WORKSTATION Core™ Ultra 7 165H 1TB SSD 32GB 16" (2560x1600) 165Hz WIN11 Pro NVIDIA® RTX 4070 8192MB BLACK Backlit Keyboard FP Reader - 21KV0018US-R
                </li>
                <li class="config-item">
                    Lenovo ThinkPad P1 Gen 7 MOBILE WORKSTATION Core™ Ultra 7 165H vPro 2TB SSD 64GB 16" (3840 x 2400) WQUXGA TOUCHSCREEN WIN11 Pro NVIDIA® RTX 3000 8GB BLACK Backlit Keyboard FP Reader - 21KV001AUS
                </li>
                <li class="config-item">
                    Lenovo ThinkPad P1 Gen 7 MOBILE WORKSTATION Core™ Ultra 9 185H 2TB SSD 64GB 16" (3840x2400) OLED TOUCHSCREEN WIN11 Pro NVIDIA® RTX 3000 8192MB BLACK Backlit Keyboard FP Reader - 21KV001DUS-R
                </li>
                <li class="config-item">
                    Lenovo ThinkPad P1 Gen 7 MOBILE WORKSTATION Core™ Ultra 7 155H 1TB SSD 32GB 16" (1920x1200) WUXGA WIN11 Pro NVIDIA® RTX 2000 8GB BLACK Backlit Keyboard FP Reader 1-year Premier support - 21KV0013US
                </li>
            </ul>
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
            echo "<p class='product-single-description-text'>There's nothing here yet.</p>";
        }
        ?>
    </section>

    <?php
    $related_ids = wc_get_related_products(get_the_ID(), 6);

    if (!empty($related_ids)) {
        $related_query = new WP_Query(array(
            'post_type' => 'product',
            'post__in' => $related_ids,
            'posts_per_page' => 6,
        ));

        if ($related_query->have_posts()) {
    ?>
            <section class="related-products">
                <div class="container">
                    <h2 class="related-products-title">Related Products</h2>
                    <ul class="related-products-items">
                        <?php while ($related_query->have_posts()) : $related_query->the_post(); ?>
                            <li class="related-products-item">
                                <a href="<?php the_permalink(); ?>" title="View details of <?php the_title(); ?>">
                                    <div class="related-products-item-preview">
                                        <img src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'medium'); ?>" alt="<?php the_title_attribute(); ?>" class="related-products-item-preview-img">
                                    </div>
                                    <div class="related-products-item-info">
                                        <h3 class="related-products-item-info-title"><?php the_title(); ?></h3>
                                        <p class="related-products-item-info-price">from
                                            <?php
                                            $product = wc_get_product(get_the_ID());
                                            echo wc_price($product->get_price());
                                            ?>
                                        </p>
                                    </div>
                                </a>
                            </li>
                        <?php endwhile; ?>
                    </ul>
                </div>
            </section>
    <?php
            wp_reset_postdata(); // Сброс глобального поста WP
        }
    }
    ?>
</main>

<?php europe_get_footer(); ?>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const listsConfig = document.querySelector(".config-items");

        listsConfig.addEventListener("click", function(event) {
            const itemConfig = event.target;

            // Проверяем, что клик был по элементу списка
            if (itemConfig && itemConfig.classList.contains("config-item")) {
                const itemsConfig = listsConfig.querySelectorAll(".config-item");

                // Убираем класс active у всех элементов
                itemsConfig.forEach(i => i.classList.remove('active'));

                // Добавляем класс active к выбранному элементу
                itemConfig.classList.add('active');
            }
        });
    });

    const productHeader = document.querySelector(".product-single-header-btn");
    const congigContainer = document.querySelector(".configuration .container");

    function handleResizeButton() {
        const screenWidth = window.innerWidth;

        if (screenWidth < 768) {
            if (productHeader && !congigContainer.contains(productHeader)) {
                congigContainer.appendChild(productHeader); // Вставляем блок в контейнер
            }
        } else {
            if (productHeader && congigContainer.contains(productHeader)) {
                productHeader.parentElement.removeChild(productHeader); // Удаляем из контейнера
                document.body.insertBefore(productHeader, document.body.firstChild); // Возвращаем в начало body или нужное место
            }
        }
    }

    // Запуск при загрузке страницы
    handleResizeButton();

    // Добавляем обработчик на изменение размера окна
    window.addEventListener("resize", handleResizeButton);
</script>