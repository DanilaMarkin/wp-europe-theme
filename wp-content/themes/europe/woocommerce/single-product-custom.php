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
            <div class="product-single-header-btn-tootle-contact hidden">
                <button id="productOpenWA">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/whatsapp.svg" alt="">
                </button>
                <button d="productOpenTg">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/telegram-sidemenu.svg" alt="">
                </button>
            </div>
            <button class="product-single-header-btn-general product-single-header-btn-price" data-id="<?= $product_id = get_the_ID(); ?>">
                <img src="<?= get_template_directory_uri() ?>/assets/icons/cart.svg" alt="Cart icon" class="product-block-cart-img">
            </button>
        </div>

        <div class="product-gallery">
            <figure class="main-image">
                <?php if (has_post_thumbnail()) :
                    // Получаем ID миниатюры
                    $thumbnail_id = get_post_thumbnail_id(get_the_ID());
                ?>
                    <img src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'large'); ?>"
                        alt="<?php echo esc_attr(get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true)); ?>"
                        title="<?php echo esc_attr(get_the_title($thumbnail_id)); ?>"
                        loading="lazy">
                <?php endif; ?>
            </figure>
            <?php
            $gallery = get_post_meta(get_the_ID(), '_product_image_gallery', true);
            $gallery_ids = explode(',', $gallery);

            if (!empty($gallery_ids)) {
                echo '
                <div class="thumbnail-gallery-wrapper">
                    <button class="arrow-left hidden">
                        <img src="' . get_template_directory_uri() . '/assets/icons/arrow.svg" alt="">
                    </button>
                        <ul class="thumbnail-gallery">
                ';
                foreach ($gallery_ids as $attachment_id) {
                    $image_url = wp_get_attachment_url($attachment_id);
                    $image_alt = get_post_meta($attachment_id, '_wp_attachment_image_alt', true) ?: get_the_title($attachment_id);

                    echo '<li class="thumbnail-gallery-item">
                        <figure><img src="' . esc_url($image_url) . '" alt="' . esc_attr($image_alt) . '" loading="lazy"></figure>
                    </li>';
                }
                echo '
                        </ul>
                    <button class="arrow-right hidden">
                        <img src="' . get_template_directory_uri() . '/assets/icons/arrow.svg" alt="">
                    </button>
                </div>';
            } else {
                echo 'Галерея пуста.';
            }
            ?>
            <div id="product-notification" class="hidden">
                <span>Item successfully added to cart</span>
            </div>
        </div>
    </section>

    <?php
    global $post;
    $product_configurations = get_post_meta($post->ID, '_product_configurations', true);
    if (!empty($product_configurations)) {
        foreach ($product_configurations as $section) {
    ?>
            <section class="configuration">
                <div class="container">
                    <h2 class="configuration-title"><?= $section["title"] ?: "Default"; ?></h2>
                    <ul class="config-items">
                        <?php foreach ($section['configs'] as $config) { ?>
                            <li class="config-item">
                                <?= $config; ?>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            </section>
    <?php
        }
    }
    ?>

    <section class="product-single-description">
        <div class="container">
            <h2 class="product-single-description-title">Description</h2>
            <?php
            $descr = get_the_content();
            if (!empty(trim($descr))) {
            ?>
                <div class="product-single-description-text"><?= $descr ?></div>
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
    // click on list configuration
    document.addEventListener("DOMContentLoaded", function() {
        const listsConfig = document.querySelector(".config-items");
        if (listsConfig) {
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
        }
    });

    // changing button settings
    const productHeader = document.querySelector(".product-single-header-btn");
    const congigContainer = document.querySelector(".configuration .container");

    function handleResizeButton() {
        const screenWidth = window.innerWidth;
        if (congigContainer) {
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
    }

    // Запуск при загрузке страницы
    handleResizeButton();

    // Добавляем обработчик на изменение размера окна
    window.addEventListener("resize", handleResizeButton);

    // switch photos in gallery
    const mainImage = document.querySelector(".main-image img");
    const galleryItems = document.querySelectorAll(".thumbnail-gallery-item");

    if (galleryItems) {
        galleryItems.forEach((item) => {
            item.addEventListener("click", () => {
                const galleryItem = item.querySelector("figure img");
                const originalSrcMain = mainImage.src;

                mainImage.src = galleryItem.src;
                galleryItem.src = originalSrcMain;
            });
        });
    }

    // slider image gallery
    const arrowLeft = document.querySelector(".arrow-left");
    const arrowRight = document.querySelector(".arrow-right");
    const gallery = document.querySelector(".thumbnail-gallery");

    const itemWidth = document.querySelector(".thumbnail-gallery-item").offsetWidth;
    const visibleWidth = gallery.offsetWidth;

    // Показываем/скрываем стрелки
    function updateArrows() {
        arrowLeft.classList.toggle("hidden", gallery.scrollLeft <= 0);
        arrowRight.classList.toggle("hidden", gallery.scrollLeft + visibleWidth >= gallery.scrollWidth);
    }

    // Перемещение галереи
    arrowLeft.addEventListener("click", () => {
        gallery.scrollLeft -= itemWidth * 3; // Сдвиг на 3 элемента влево
        updateArrows();
    });

    arrowRight.addEventListener("click", () => {
        gallery.scrollLeft += itemWidth * 3; // Сдвиг на 3 элемента вправо
        updateArrows();
    });

    // Обновляем стрелки при загрузке
    updateArrows();
    // Обновляем стрелки при прокрутке вручную (например, через тачскрин)
    gallery.addEventListener("scroll", updateArrows);

    // add product in cart
    const notification = document.querySelector("#product-notification");
    const addBtncart = document.querySelector(".product-single-header-btn-price");
    const cartId = addBtncart.getAttribute("data-id");

    const configs = document.querySelector(".config-items"); // Блок конфигураций
    const config = document.querySelectorAll(".config-item"); // Конфигурация

    // Функция для изменения общего кол-ва товаров в корзину
    function updateCartQuantity() {
        // Получаем элемент, который отображает количество товаров в корзине
        const totalProductsCount = document.querySelector(".nav-block-cart-count");

        // Получаем данные корзины из localStorage
        let cart = JSON.parse(localStorage.getItem("cart"));

        if (cart && Array.isArray(cart)) {
            const totalCount = cart.reduce((sum, item) => sum + (item.count || 0), 0);
            if (totalProductsCount) {
                totalProductsCount.textContent = totalCount; // Обновляем количество товаров в корзине
            }
        } else {
            // Если корзина пуста
            if (totalProductsCount) {
                totalProductsCount.textContent = 0;
            }
        }
    }

    function saveCartLocalStorage(productId, count, config = null) {
        let cart = JSON.parse(localStorage.getItem("cart")) || [];

        const existingCart = cart.find((item) => item.id === productId);

        if (existingCart) {
            existingCart.count += count;
            if (config) {
                existingCart.config = config;
            }
        } else {
            cart.push({
                id: productId,
                count: count,
                config: config,
            });
        }

        // Сохраняем обновленную корзину обратно в localStorage
        localStorage.setItem("cart", JSON.stringify(cart));
    }

    addBtncart.addEventListener("click", () => {
        const count = 1; // Устанавливаем количество товаров, например 1, при добавлении в корзину

        // Если на странице есть выбор конфигураций
        if (configs) {
            // Проверяем, есть ли хотя бы один элемент с классом "active"
            const hasActive = Array.from(config).some(item => item.classList.contains("active"));

            // Если нет активных элементов, добавляем "error" ко всем
            if (!hasActive) {
                config.forEach((item) => {
                    if (!item.classList.contains("active")) {
                        item.classList.add("error");
                    }
                });
            }

            config.forEach((item) => {
                // Если нажали на конфигурацию убирать error у всех эл-ов
                item.addEventListener("click", () => {
                    config.forEach((el) => {
                        el.classList.remove("error");
                    });
                });

                // У эл-та у которого есть класс active взять зн-ие и добавить в корзину
                if (item.classList.contains("active")) {
                    let configValue = item.textContent;
                    notification.classList.remove("hidden");
                    saveCartLocalStorage(cartId, count, configValue); // Сохраняем товар в корзине, передав ID и количество
                    item.classList.remove("active");
                }
            });
        } else { // Если нет конфигураций на сайте то показыать увед-ие и добавлять товар в корзину
            notification.classList.remove("hidden");
            saveCartLocalStorage(cartId, count); // Сохраняем товар в корзине, передав ID и количество
        }

        updateCartQuantity(); // Обновление кол-ва корзины при нажатие на кнопку addBtncart

        setTimeout(() => {
            notification.classList.add("hidden");
        }, 5000); // скрывать уведомление спустя 5 сек на сайте
    });

    // switch bt cart and contacts social
    const contactBtn = document.querySelector(".product-single-header-btn-contact");
    const contactToogleBlock = document.querySelector(".product-single-header-btn-tootle-contact");

    contactBtn.addEventListener("click", () => {
        contactBtn.classList.add("hidden");
        contactToogleBlock.classList.remove("hidden");
    });

    document.addEventListener("click", (event) => {
        if (!contactBtn.contains(event.target) && !contactToogleBlock.contains(event.target)) {
            contactBtn.classList.remove("hidden");
            contactToogleBlock.classList.add("hidden");
        }
    });
</script>