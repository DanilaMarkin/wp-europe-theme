<?php

/**
 * Template Name: Custom Single Product
 * Template Post Type: product
 */
europe_get_header();

// Global data all site
$global_settings = get_global_settings(190);

$phone_number = preg_replace('/\s+/', '', $global_settings['phone']);
?>

<main class="product-single">
    <section class="product-single-header container">
        <h1 class="product-single-header-title"><?php the_title(); ?></h1>

        <div class="product-single-header-prices">
            <ul class="product-single-header-prices-items">
                <?php
                $custom_fields = get_post_meta($post->ID, '_custom_fields_group', true);

                if ($custom_fields) {
                    foreach ($custom_fields as $custom_field) {
                ?>
                        <li>
                            <p><?= $custom_field["name_price"]; ?></p>
                            <div class="product-single-header-prices-item">
                                <span>
                                    <?php
                                    if ($custom_field["price"]) {
                                    ?>
                                        <?= number_format($custom_field["price"], 0, '.', '.'); ?> <?= get_woocommerce_currency_symbol(); ?>
                                    <?php } ?>
                                </span>
                                <?php
                                if (isset($custom_field["price_message"])) {
                                ?>
                                    <img src="<?= get_template_directory_uri() ?>/assets/icons/information.svg" title="More information" alt="Information icon">
                                <?php } ?>
                            </div>
                            <!-- popup notification -->
                            <?php
                            if (isset($custom_field["price_message"])) {
                            ?>
                                <aside id="notificationPopup" class="notification">
                                    <p><?= $custom_field["price_message"]; ?></p>
                                </aside>
                            <?php } ?>
                            <!-- popup notification -->
                        </li>
                <?php
                    }
                }
                ?>
                <li>
                    <?php
                    // Получаем данные метаполей
                    $name_price    = get_post_meta(get_the_ID(), '_name_price', true);
                    $price_message = get_post_meta(get_the_ID(), '_price_message', true);
                    ?>
                    <p><?= $name_price ?></p>
                    <div class="product-single-header-prices-item ">
                        <?php if (get_post_meta(get_the_ID(), '_price', true)) { ?>
                            <span id="mainPrice"><?php echo wc_price(get_post_meta(get_the_ID(), '_price', true)); ?></span>
                        <?php } else { ?>
                            <span id="mainPrice">-</span>
                        <?php } ?>
                        <img src="<?= get_template_directory_uri() ?>/assets/icons/information.svg" title="More information" alt="Information icon">
                    </div>
                    <!-- popup notification -->
                    <?php
                    if (isset($price_message)) {
                    ?>
                        <aside id="notificationPopup" class="notification">
                            <p><?= $price_message; ?></p>
                        </aside>
                    <?php } ?>
                    <!-- popup notification -->
                </li>
            </ul>
            <button class="offer-btn" aria-label="Suggest your price for the product">
                Offer your Price <img src="<?= get_template_directory_uri() ?>/assets/icons/information.svg" title="More information" alt="Information icon">
            </button>
        </div>

        <div class="product-single-header-btn">
            <button class="product-single-header-btn-general product-single-header-btn-contact">Contact us</button>
            <div class="product-single-header-btn-tootle-contact hidden">
                <a href="https://wa.me/<?php echo esc_attr($phone_number); ?>" target="_blank" rel="noopener noreferrer" id="productOpenWA" aria-label="Open WhatsApp chat with <?php echo htmlspecialchars($phone_number); ?>" title="Open WhatsApp chat with <?php echo htmlspecialchars($phone_number); ?>">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/whatsapp.svg" alt="Open WhatsApp chat with <?php echo htmlspecialchars($phone_number); ?>">
                </a>
                <a href="https://t.me/<?php echo esc_attr($phone_number); ?>" target="_blank" rel="noopener noreferrer" id="productOpenTg" aria-label="Open Telegram chat with <?php echo htmlspecialchars($phone_number); ?>" title="Open Telegram chat with <?php echo htmlspecialchars($phone_number); ?>">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/telegram-sidemenu.svg" alt="Open Telegram chat with <?php echo htmlspecialchars($phone_number); ?>">
                </a>
            </div>
            <button class="product-single-header-btn-general product-single-header-btn-price" aria-label="Add product to cart" data-id="<?= $product_id = get_the_ID(); ?>">
                <img src="<?= get_template_directory_uri() ?>/assets/icons/cart.svg" alt="Add to cart" class="product-block-cart-img">
            </button>
        </div>

        <div class="product-gallery">
            <?php
            // Получаем галерею изображений
            $gallery = get_post_meta(get_the_ID(), '_product_image_gallery', true);
            $gallery_ids = !empty($gallery) ? explode(',', $gallery) : array();

            if (!empty($gallery_ids)) {
                // Берем первое изображение из галереи как основное
                $main_image_id = array_shift($gallery_ids);
                $main_image_url = wp_get_attachment_url($main_image_id);
                $main_image_alt = get_post_meta($main_image_id, '_wp_attachment_image_alt', true) ?: get_the_title($main_image_id);
                $main_image_title = get_post($main_image_id)->post_title;
            } elseif (has_post_thumbnail()) {
                // Если галерея пуста, берем featured image
                $main_image_id = get_post_thumbnail_id(get_the_ID());
                $main_image_url = get_the_post_thumbnail_url(get_the_ID(), 'large');
                $main_image_alt = get_post_meta($main_image_id, '_wp_attachment_image_alt', true) ?: get_the_title($main_image_id);
                $main_image_title = get_the_title($main_image_id);
            }

            // Вывод главного изображения
            if (!empty($main_image_url)) :
            ?>
                <figure class="main-image">
                    <img src="<?php echo esc_url($main_image_url); ?>"
                        alt="<?php echo esc_attr($main_image_alt); ?>"
                        title="<?php echo esc_attr($main_image_title); ?>"
                        loading="lazy">
                </figure>
            <?php endif; ?>

            <?php if (!empty($gallery_ids)) : ?>
                <div class="thumbnail-gallery-wrapper">
                    <button class="arrow-left hidden">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/arrow.svg" alt="Arrow icon" title="Navigate">
                    </button>
                    <ul class="thumbnail-gallery">
                        <li class="thumbnail-gallery-item">
                            <figure>
                                <img src="<?php echo esc_url($main_image_url); ?>"
                                    alt="<?php echo esc_attr($main_image_alt); ?>"
                                    title="<?php echo esc_attr($main_image_title); ?>"
                                    loading="lazy">
                            </figure>
                        </li>
                        <?php
                        // Вывод оставшихся изображений галереи
                        foreach ($gallery_ids as $attachment_id) {
                            $image_url = wp_get_attachment_url($attachment_id);
                            $image_alt = get_post_meta($attachment_id, '_wp_attachment_image_alt', true) ?: get_the_title($attachment_id);
                            $image_title = get_post($attachment_id)->post_title;
                            echo '<li class="thumbnail-gallery-item">
                                        <figure>
                                            <img src="' . esc_url($image_url) . '" title="' . esc_attr($image_title) . '" alt="' . esc_attr($image_alt) . '" loading="lazy">
                                        </figure>
                                    </li>';
                        }
                        ?>
                    </ul>
                    <button class="arrow-right hidden">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/arrow.svg" alt="Arrow icon" title="Next">
                    </button>
                </div>
            <?php endif; ?>
            <!-- product add notification -->
            <div id="product-notification" class="hidden">
                <span>Item successfully added to cart</span>
            </div>
            <!-- product add notification -->
        </div>

        <!-- notification add cart -->
        <?php get_template_part('templates/notifications/notification-empty'); ?>
        <!-- notification add cart -->
        <!-- offer your price -->
        <?php get_template_part('templates/forms/offer-modal'); ?>
        <!-- offer your price -->
        </div>
        <!-- popup gallery full screen -->
        <aside id="galleryFull" class="galleryfull">
            <button class="galleryfull-close" aria-label="Close gallery">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/close.svg" alt="Close button" title="Close the gallery" class="galleryfull-close-img">
            </button>
            <div class="galleryfull-blocks">
                <div class="gallery-block-main">
                    <img src="<?php echo esc_url($main_image_url); ?>"
                        alt="<?php echo esc_attr($main_image_alt); ?>"
                        title="<?php echo esc_attr($main_image_title); ?>"
                        loading="lazy">
                </div>
                <div class="gallery-block-info">
                    <p><?php the_title(); ?></p>
                    <ul class="gallery-block-info-lists">
                        <li class="gallery-block-info-list">
                            <figure>
                                <img src="<?php echo esc_url($main_image_url); ?>"
                                    alt="<?php echo esc_attr($main_image_alt); ?>"
                                    title="<?php echo esc_attr($main_image_title); ?>"
                                    loading="lazy">
                            </figure>
                        </li>
                        <?php
                        if (!empty($gallery_ids)) {
                            foreach ($gallery_ids as $attachment_id) {
                                $image_url = wp_get_attachment_url($attachment_id);
                                $image_alt = get_post_meta($attachment_id, '_wp_attachment_image_alt', true) ?: get_the_title($attachment_id);
                                $image_title = get_post($attachment_id)->post_title;
                        ?>
                                <li class="gallery-block-info-list">
                                    <figure>
                                        <img src="<?= $image_url; ?>" title=" <?= $image_title ?>" alt="<?= $image_alt; ?>" loading="lazy">
                                    </figure>
                                </li>
                        <?php
                            }
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </aside>
        <!-- popup gallery full screen -->
    </section>

    <?php if ($product->is_type('variable')) { ?>
        <!-- atribute lists -->
        <?php
        global $post;
        $product = wc_get_product($post->ID);
        $attributes = $product->get_attributes();
        $variations = $product->is_type('variable') ? $product->get_children() : []; // Получаем ID вариаций

        // Массив для хранения соответствий "значение атрибута" => "изображение"
        $variation_images = [];

        if (!empty($variations)) {
            foreach ($variations as $variation_id) {
                $variation = wc_get_product($variation_id);
                $image_url = wp_get_attachment_url($variation->get_image_id());

                if ($image_url) {
                    // Получаем атрибуты этой вариации
                    $variation_attributes = $variation->get_attributes();

                    // Добавляем изображения в массив соответствий
                    foreach ($variation_attributes as $attr_name => $attr_value) {
                        $variation_images[$attr_value] = $image_url; // Привязываем изображение к значению атрибута
                    }
                }
            }
        }

        // Выводим атрибуты и кнопки
        if (!empty($attributes)) {
            foreach ($attributes as $attribute_name => $attribute) {
                $options = $attribute->get_options();
        ?>
                <section class="configuration">
                    <div class="container">
                        <h2 class="configuration-title"><?= esc_html(ucwords(str_replace('-', ' ', $attribute_name))); ?></h2>

                        <div class="config-items" data-attribute="<?= esc_attr($attribute_name); ?>">
                            <?php foreach ($options as $option) {
                                $img_src = isset($variation_images[$option]) ? $variation_images[$option] : ''; // Проверяем, есть ли изображение для этой опции
                            ?>
                                <button class="config-item"
                                    data-attribute="<?= esc_attr($attribute_name); ?>"
                                    data-value="<?= esc_attr($option); ?>"
                                    <?= $img_src ? 'data-src-variable-gallery="' . esc_url($img_src) . '"' : ''; ?>
                                    aria-label="Выбрать <?= esc_html($option); ?>"
                                    title="Выбрать <?= esc_html($option); ?>">
                                    <?= esc_html($option); ?>
                                </button>
                            <?php } ?>
                        </div>
                    </div>
                </section>
    <?php
            }
        }
    }
    ?>
    <!-- atribute lists -->

    <section class="tabs-blocks">
        <div class="container">
            <div class="tabs">
                <button class="tab active" data-tab="description">Description</button>
                <button class="tab" data-tab="specifications">Characteristics</button>
            </div>
        </div>
    </section>

    <section id="description" class="tab-pane active product-single-description">
        <div class="container">
            <!-- <h2 class="product-single-description-title">Description</h2> -->
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

    <section id="specifications" class="tab-pane product-single-feature">
        <div class="container">
            <!-- <h2 class="product-single-feature-title">Characteristics</h2> -->
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
        </div>
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
                                        <?php
                                        $product = wc_get_product(get_the_ID());
                                        $price = $product->get_price();

                                        if ($price) {
                                        ?>
                                            <p class="related-products-item-info-price">from
                                                <?php
                                                echo wc_price($price);
                                                ?>
                                            </p>
                                        <?php
                                        } else {
                                        ?>
                                            <p class="related-products-item-info-price">Price On Request</p>
                                        <?php } ?>
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

                    // Проверяем наличие data-src-variable-gallery и меняем изображение
                    const dataSrc = itemConfig.getAttribute('data-src-variable-gallery');
                    if (dataSrc) {
                        const mainImage = document.querySelector('.main-image img');
                        if (mainImage) {
                            mainImage.setAttribute('src', dataSrc);
                        }
                    }
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
                mainImage.src = galleryItem.src;
            });
        });
    }

    // slider image gallery
    const arrowLeft = document.querySelector(".arrow-left");
    const arrowRight = document.querySelector(".arrow-right");
    const gallery = document.querySelector(".thumbnail-gallery");

    let isDragging = false; // Флаг для отслеживания удержания мыши
    let startX = 0,
        startY = 0,
        scrollStartX = 0,
        scrollStartY = 0;

    // Функция определения ориентации
    function isVerticalMode() {
        return window.innerWidth > 768;
    }

    // Обновляем состояние стрелок
    function updateArrows() {
        if (isVerticalMode()) {
            // Вертикальная ориентация
            if (gallery) {
                const visibleHeight = gallery.offsetHeight;
                arrowLeft.classList.toggle("hidden", gallery.scrollTop <= 0);
                arrowRight.classList.toggle("hidden", gallery.scrollTop + visibleHeight >= gallery.scrollHeight);
            }

        } else {
            // Горизонтальная ориентация
            if (gallery) {
                const visibleWidth = gallery.offsetWidth;
                arrowLeft.classList.toggle("hidden", gallery.scrollLeft <= 0);
                arrowRight.classList.toggle("hidden", gallery.scrollLeft + visibleWidth >= gallery.scrollWidth);
            }
        }
    }

    // Перемещение галереи
    if (arrowLeft) {
        arrowLeft.addEventListener("click", () => {
            if (isVerticalMode()) {
                const itemHeight = document.querySelector(".thumbnail-gallery-item").offsetHeight;
                gallery.scrollTop -= itemHeight * 3; // Сдвиг на 3 элемента вверх
            } else {
                const itemWidth = document.querySelector(".thumbnail-gallery-item").offsetWidth;
                gallery.scrollLeft -= itemWidth * 3; // Сдвиг на 3 элемента влево
            }
            updateArrows();
        });
    }

    if (arrowRight) {
        arrowRight.addEventListener("click", () => {
            if (isVerticalMode()) {
                const itemHeight = document.querySelector(".thumbnail-gallery-item").offsetHeight;
                gallery.scrollTop += itemHeight * 3; // Сдвиг на 3 элемента вниз
            } else {
                const itemWidth = document.querySelector(".thumbnail-gallery-item").offsetWidth;
                gallery.scrollLeft += itemWidth * 3; // Сдвиг на 3 элемента вправо
            }
            updateArrows();
        });
    }

    // Свайп для горизонтальной ориентации
    if (gallery) {
        gallery.addEventListener("touchstart", (e) => {
            if (isVerticalMode()) {
                // Вертикальная ориентация
                startY = e.touches[0].clientY;
                scrollStartY = gallery.scrollTop;
            } else {
                // Горизонтальная ориентация
                startX = e.touches[0].clientX;
                scrollStartX = gallery.scrollLeft;
            }
        });

        gallery.addEventListener("touchmove", (e) => {
            if (isVerticalMode()) {
                // Вертикальная ориентация
                const deltaY = e.touches[0].clientY - startY;
                gallery.scrollTop = scrollStartY - deltaY;
            } else {
                // Горизонтальная ориентация
                const deltaX = e.touches[0].clientX - startX;
                gallery.scrollLeft = scrollStartX - deltaX;
            }
        });

        gallery.addEventListener("touchend", () => {
            updateArrows(); // Обновляем состояние стрелок
        });

        // События для мыши на ПК
        gallery.addEventListener("mousedown", (e) => {
            isDragging = true;
            startY = e.clientY;
            scrollStartY = gallery.scrollTop;
            gallery.style.cursor = "grabbing"; // Меняем курсор на "захват"
        });

        gallery.addEventListener("mousemove", (e) => {
            if (isDragging && isVerticalMode()) {
                const deltaY = e.clientY - startY;
                gallery.scrollTop = scrollStartY - deltaY;
            }
        });

        gallery.addEventListener("mouseup", () => {
            isDragging = false;
            gallery.style.cursor = "default"; // Возвращаем стандартный курсор
        });

        gallery.addEventListener("mouseleave", () => {
            isDragging = false; // Сбрасываем флаг, если мышь уходит за пределы галереи
        });

        gallery.addEventListener("scroll", updateArrows);
    }

    // Обновляем стрелки при загрузке
    updateArrows();

    // Обновляем стрелки при прокрутке вручную (например, через тачскрин)

    // Слушаем изменения размера экрана
    window.addEventListener("resize", updateArrows);

    // add product in cart
    const notification = document.querySelector("#product-notification");
    const addBtncart = document.querySelector(".product-single-header-btn-price");
    const cartId = addBtncart.getAttribute("data-id");

    const configs = document.querySelector(".config-items"); // Блок конфигураций
    const config = document.querySelectorAll(".config-item"); // Конфигурация

    const notificationEmpty = document.querySelector(".notification-empty"); // Модальное окно об отсутсвие цены у товара
    const notificationClose = document.querySelector(".notification-empty-close"); // Закрытие модального окна

    const priceText = document.querySelector("#mainPrice").textContent.trim(); // Получаем текст
    const price = parseFloat(priceText.replace(/[^0-9.]/g, "")); // Убираем все символы, кроме цифр и точки

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
        if (!isNaN(price)) {
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
        } else {
            // Проверка наличие на модальное окно
            if (notificationEmpty) {
                notificationEmpty.classList.add("open");
                setTimeout(() => {
                    notificationEmpty.classList.remove("open");
                }, 5000);

                // Обработчик на закрытие модального окна
                notificationClose.addEventListener("click", () => {
                    notificationEmpty.classList.remove("open");
                });
            }
        }
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

    // hover open notificationPopup
    const iconInfo = document.querySelectorAll(".product-single-header-prices-item img");
    const notificationPopup = document.querySelectorAll(".notification");

    iconInfo.forEach((item, index) => {
        item.addEventListener("mouseover", () => {
            notificationPopup[index].classList.add("open");
        });

        item.addEventListener("mouseout", () => {
            notificationPopup[index].classList.remove("open");
        });
    });

    // full size gallery and open/close modal window
    const header = document.querySelector("header");
    const overlayFull = document.querySelector("#overlay");
    const galleryPopup = document.querySelector("#galleryFull");
    const galleryPopupClose = document.querySelector(".galleryfull-close");
    const galleryFullMain = document.querySelector(".gallery-block-main > img");
    const galleryFullItems = document.querySelectorAll(".gallery-block-info-list");

    galleryFullItems.forEach((item) => {
        item.addEventListener("click", () => {
            // Удалить все классы active
            galleryFullItems.forEach((el) => el.classList.remove("active"));

            // Смена миниатюры на главную фотографию
            const imgFull = item.querySelector("figure > img");
            galleryFullMain.src = imgFull.src;
            item.classList.add("active");
        });
    });

    // Открываем модальное окно
    if (mainImage) {
        mainImage.addEventListener("click", () => {
            galleryFullMain.src = mainImage.src;
            // Перебор открытой фотографий чтобы добавлся класс active
            galleryFullItems.forEach((item) => {
                const imgFull = item.querySelector("figure > img");
                if (mainImage.src === imgFull.src) {
                    galleryFullItems.forEach((el) => el.classList.remove("active"));
                    item.classList.add("active");
                }
            })
            // Перебор открытой фотографий чтобы добавлся класс active
            galleryPopup.classList.add("open");
            overlayFull.classList.add("active");
            header.classList.add("no-zindex");
            document.body.classList.add("no-scroll");
        });
    }

    // Закрываем модальное окно
    galleryPopupClose.addEventListener("click", () => {
        galleryPopup.classList.remove("open");
        overlayFull.classList.remove("active");
        header.classList.remove("no-zindex");
        document.body.classList.remove("no-scroll");
    });

    // Закрываем при клике на оверлей(за пределеы)
    overlayFull.addEventListener("click", (event) => {
        if (modalOffer.classList.contains("open")) {
            modalOffer.classList.remove("open");
        }
        galleryPopup.classList.remove("open");
        overlayFull.classList.remove("active");
        header.classList.remove("no-zindex");
        document.body.classList.remove("no-scroll");
        updateOverlayState();
    });
    // full size gallery and open/close modal window

    // popup modal offer
    const modalOffer = document.querySelector("#offerModal");
    const modalOfferClose = document.querySelector(".modal-offer-close");
    const offerBtn = document.querySelector(".offer-btn");

    offerBtn.addEventListener("click", () => {
        modalOffer.classList.add("open");
        overlayFull.classList.add("active");
        header.classList.add("no-zindex");
        updateOverlayState();
    });

    modalOfferClose.addEventListener("click", () => {
        modalOffer.classList.remove("open");
        overlayFull.classList.remove("active");
        header.classList.remove("no-zindex");
        updateOverlayState();
    });
    // popup modal offer

    // validate form in modale window "Offer Your Price"
    document.getElementById("offerForm").addEventListener("submit", (event) => {
        event.preventDefault(); // Отключаем отправку формы для проверки

        let isValid = true;

        // Получаем значения полей
        const price = document.getElementById("priceOffer");
        const quantity = document.getElementById("quantityOffer");
        const name = document.getElementById("nameOffer");
        const phone = document.getElementById("phoneOffer");
        const address = document.getElementById("addressOffer");

        if (price.value.trim() === "") {
            price.classList.add("error");
            isValid = false;
        } else {
            price.classList.remove("error");
        }

        if (quantity.value.trim() === "") {
            quantity.classList.add("error");
            isValid = false;
        } else {
            quantity.classList.remove("error");
        }

        if (name.value.trim() === "") {
            name.classList.add("error");
            isValid = false;
        } else {
            name.classList.remove("error");
        }

        if (phone.value.trim() === "") {
            phone.classList.add("error");
            isValid = false;
        } else {
            phone.classList.remove("error");
        }

        if (address.value.trim() === "") {
            address.classList.add("error");
            isValid = false;
        } else {
            address.classList.remove("error");
        }

        if (isValid) {

            jQuery("#loaderOfferPrice").removeClass("hidden");
            jQuery("#offerForm").addClass("close");

            jQuery.ajax({
                url: ajaxObject.ajaxurl,
                type: "POST",
                data: {
                    action: "send_offer_price_mail",
                    offerForm: {
                        price: price.value.trim(),
                        quantity: quantity.value.trim(),
                        name: name.value.trim(),
                        phone: phone.value.trim(),
                        address: address.value.trim(),
                    },
                },
                success: function(response) {
                    jQuery("#loaderOfferPrice").addClass("hidden");
                    jQuery("#offerForm").removeClass("close");
                    // Очищаем поля формы
                    jQuery("#offerForm").find("input[type=text], input[type=number], input[type=tel], textarea").val("");
                    // Обратная связь для пользователя об отправке
                    Swal.fire({
                        title: "Form Submitted!",
                        text: "Your message has been successfully sent. We will get back to you soon.",
                        icon: "success",
                        confirmButtonText: "Close",
                        customClass: {
                            confirmButton: "custom-confirm-button",
                        },
                        timer: 4000, // Закрытие через 4 секунды
                        timerProgressBar: true, // Показывает индикатор времени
                    });

                },
                error: function(error) {
                    jQuery("#loaderOfferPrice").addClass("hidden");
                    jQuery("#offerForm").removeClass("close");
                    console.error("Error:", error);
                }
            });
        }
    });
    // validate form in modale window "Offer Your Price"

    // switch tab pane
    document.querySelectorAll('.tab').forEach(tab => {
        tab.addEventListener('click', function() {
            // Сбрасываем активные классы для всех табов и контента
            document.querySelectorAll('.tab').forEach(t => t.classList.remove('active'));
            document.querySelectorAll('.tab-pane').forEach(pane => pane.classList.remove('active'));

            // Активируем текущий таб и связанный контент
            this.classList.add('active');
            const target = this.getAttribute('data-tab');
            document.getElementById(target).classList.add('active');
        });
    });
    // switch tab pane
</script>