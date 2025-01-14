<?php
// WooCommerce шаблон
europe_get_header();

// Global data all site
$global_settings = get_global_settings(190);

$phone_number = preg_replace('/\s+/', '', $global_settings['phone']);

// Проверяем, является ли это магазином, категорией или тегом
if (is_shop() || is_product_category() || is_product_tag()) {

    $args = array(
        'post_type'      => 'product',
        'posts_per_page' => -1, // Количество выводимых товаров
    );

    // Фильтрация по категории или тегу
    if (is_product_category()) {
        $category = get_queried_object();
        $args['tax_query'] = array(
            array(
                'taxonomy' => 'product_cat',
                'field'    => 'id',
                'terms'    => $category->term_id,
                'operator' => 'IN',
            ),
        );
    }

    if (is_product_tag()) {
        $tag = get_queried_object();
        $args['tax_query'] = array(
            array(
                'taxonomy' => 'product_tag',
                'field'    => 'id',
                'terms'    => $tag->term_id,
                'operator' => 'IN',
            ),
        );
    }

    $products = new WP_Query($args);
?>
    <style>
        /* --------------START category-blocks-cards-------------- */
        .archive-product {
            flex-grow: 1;
        }

        .category-blocks-cards {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            justify-content: space-between;
            gap: 40px 20px;
        }

        .category-blocks {
            padding-top: 60px;
            display: flex;
            gap: 21px;

        }

        .products-blocks {
            width: 100%;
        }

        .loader-blocks-category {
            display: none;
        }

        .loader-blocks-category.active {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100%;
        }

        /* --------------END category-blocks-cards-------------- */

        /* --------------START category-block-filter-------------- */
        .category-block-filter {
            max-width: 253px;
            padding: 30px 30px 0 0;
            width: 100%;
            border-right: 2px solid #7D7D7D;
        }

        .category-block-filter-hide {
            cursor: pointer;
            font-size: 12px;
            color: #7D7D7D;
        }

        .category-block-filter-hide::before {
            content: "Hide All";
        }

        .category-blocks-filter-head-lists {
            margin: 30px 0;
        }

        .category-block-filter-lists {
            display: flex;
            flex-direction: column;
            gap: 40px;
        }

        .category-block-filter-list-head {
            cursor: pointer;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .category-block-filter-list-head.open .category-block-filter-list-action {
            transform: rotate(-180deg);
        }

        .category-block-filter-list-title {
            font-weight: 700;
            font-size: 20px;
        }

        .category-block-filter-list-full-subfilter>p {
            font-size: 20px;
        }

        .category-block-filter-list-action {
            margin-right: 5px;
            width: 10px;
            height: 10px;
            transition: transform 0.3s ease;
        }

        .category-block-filter-list-full,
        .category-block-filter-mob-close-action,
        .filter-head-mob {
            display: none;
        }

        .category-block-filter-list-full.open {
            margin-top: 20px;
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .category-block-filter-list-full-subfilter {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .category-block-filter-list-full-subfilter-checkbox {
            display: none;
        }

        .category-block-filter-list-full-subfilter-checkbox-icon {
            position: relative;
            width: 20px;
            height: 20px;
            border: 2px solid #7D7D7D;
            border-radius: 2px;
        }

        .category-block-filter-list-full-subfilter input:checked~.category-block-filter-list-full-subfilter-checkbox-icon::before {
            display: block;
        }

        .category-block-filter-list-full-subfilter-checkbox-icon::before {
            content: "";
            position: absolute;
            display: none;
            width: 10px;
            height: 10px;
            border-radius: 1px;
            background-color: #7D7D7D;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        /* --------------END category-block-filter-------------- */

        /* --------------START category-banner-------------- */
        .category-banner {
            margin-top: 47px;
        }

        .category-banner-title {
            font-weight: 700;
            font-size: 30px;
        }

        .category-banner-description {
            display: flex;
            flex-direction: column;
            gap: 15px;
            margin-top: 40px;
        }

        /* --------------END category-banner-------------- */

        /* --------------START responsive style-------------- */
        @media (max-width: 768px) {

            /* --------------START category-banner-------------- */
            .category-banner,
            .category-banner-description {
                margin-top: 20px;
            }

            .category-banner-description {
                gap: 10px;
                font-size: 12px;
            }

            .category-banner-title {
                font-size: 15px;
            }

            /* --------------END category-banner-------------- */

            /* --------------START category-blocks-cards-------------- */
            .category-blocks-cards {
                grid-template-columns: repeat(2, 1fr);
                gap: 10px;
            }

            .category-blocks-cards-empty {
                font-size: 12px;
            }

            .category-blocks {
                flex-direction: column;
                padding-top: 30px;
            }

            .loader-blocks-category.active {
                margin: 30px 0 0 0;
            }

            /* --------------END category-blocks-cards-------------- */

            /* --------------START filter-head-mob-------------- */
            .filter-head-mob {
                display: flex;
                justify-content: space-between;
                gap: 12px;
                width: 100%;
                height: 31px;
            }

            .filter-head-mob-btn {
                width: 50%;
                border: 1px solid #7D7D7D;
                outline: none;
                border-radius: 5px;
                text-align: center;
                font-size: 12px;
                padding: 0;
            }

            .filter-btn-mob {
                display: flex;
                justify-content: center;
                gap: 10px;
                align-items: center;
            }

            .filter-sort-blocks {
                position: relative;
                width: 50%;

            }

            .filter-sort-btn-mob {
                width: 100%;
                height: 100%;
            }

            .filter-sort-lists {
                display: none;
            }

            .filter-sort-lists.open {
                position: absolute;
                top: 28px;
                left: 0;
                width: 100%;
                background-color: white;
                border: 1px solid #7D7D7D;
                border-radius: 0 0 5px 5px;
                padding: 16px 27px 22px 28px;
                display: flex;
                flex-direction: column;
                gap: 15px;
            }

            .filter-sort-list {
                display: flex;
                align-items: center;
                gap: 10px;
            }

            .filter-sort-list>span {
                font-size: 12px;
            }

            /* --------------END filter-head-mob-------------- */

            /* --------------START category-block-filter-------------- */
            .category-block-filter {
                max-width: 100%;
                border-right: unset;
                position: fixed;
                top: 0;
                left: 0;
                height: 100%;
                background-color: white;
                transform: translateX(-100%);
                transition: transform 0.3s ease;
                z-index: 21;
                overflow-y: scroll;
                scrollbar-width: none;
                display: flex;
                flex-direction: column;
                align-items: start;
                padding: 20px 10px;
            }

            .category-block-filter.open {
                transform: translateX(0);
            }

            .category-block-filter-list-title {
                font-size: 15px;
            }

            .category-blocks-filter-head-lists {
                width: 100%;
                margin: 20px 0;
            }

            .category-block-filter-list-head {
                max-width: 80px;
                width: 100%;
            }

            .category-block-filter-hide::before {
                content: "Filters";
            }

            .category-block-filter-list-action {
                width: 7.24px;
                height: 7.24px;
            }

            .category-block-filter-list-full-subfilter>p {
                font-size: 15px;
            }

            .category-block-filter-lists {
                gap: 0;
            }

            .category-block-filter-list-full.open {
                margin-top: 15px;
                gap: 11px;
            }

            .category-block-filter-lists>.category-block-filter-list {
                margin-bottom: 20px;
                padding-bottom: 20px;
                border-bottom: 1px solid #7D7D7D;
            }

            .category-block-filter-mob-close-action {
                display: block;
                position: absolute;
                top: 20px;
                right: 10px;
                width: 14px;
                height: 14px;
                filter: brightness(0) saturate(100%);
            }

            /* --------------END category-block-filter-------------- */
        }

        /* --------------END responsive style-------------- */
    </style>

    <main class="archive-product container">
        <section class="category-banner">
            <?php if ($category->name) { ?>
                <h1 class="category-banner-title"><?= $category->name; ?></h1>
            <?php } ?>
            <div class="category-banner-description">
                <?php if ($category->description) { ?>
                    <?= wp_kses_post(wpautop($category->description)); ?>
                <?php } ?>
            </div>
        </section>
        <section class="category-blocks">
            <div class="filter-head-mob">
                <div class="filter-sort-blocks">
                    <?php
                    // Проверяем, находимся ли мы на странице категории
                    $current_category_id = is_product_category() ? get_queried_object_id() : 0;
                    ?>
                    <button
                        class="filter-head-mob-btn filter-sort-btn-mob"
                        data-url="<?php echo admin_url("admin-ajax.php?action=filter_products_sort&category_id=" . $current_category_id); ?>">
                        <p>Default sorting</p>
                    </button>

                    <ul class="filter-sort-lists">
                        <li class="filter-sort-list" data-sort="price_asc">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/sort-low.svg" alt="">
                            <span>Sort by Price (Low to High)</span>
                        </li>
                        <li class="filter-sort-list" data-sort="price_desc">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/sort-hight.svg" alt="">
                            <span>Sort by Price (High to Low)</span>
                        </li>
                        <li class="filter-sort-list" data-sort="popularity">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/sort-hight.svg" alt="">
                            <span>Sort by Popularity</span>
                        </li>
                        <li class="filter-sort-list" data-sort="date">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/sort-hight.svg" alt="">
                            <span>Sort by News</span>
                        </li>
                    </ul>
                </div>
                <button class="filter-head-mob-btn filter-btn-mob">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/filters-config.svg" alt="">
                    Filters
                </button>
            </div>
            <aside class="category-block-filter">
                <button class="category-block-filter-mob-close-action">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/close.svg" alt="" class="category-block-filter-mob-close">
                </button>
                <span class="category-block-filter-hide" role="button" aria-label="Hide All Filters"></span>
                <div class="category-blocks-filter-head-lists">
                    <ul class="category-block-filter-lists">
                        <?php
                        // Получаем все атрибуты для товаров
                        $attribute_taxonomies = wc_get_attribute_taxonomies();

                        foreach ($attribute_taxonomies as $attribute) {
                            // Получаем термины для каждого атрибута
                            $terms = get_terms(array(
                                'taxonomy' => 'pa_' . $attribute->attribute_name, // Используем таксономию атрибута
                                'hide_empty' => true, // Показываем только те термины, которые имеют товары
                            ));

                            // Если термины существуют, генерируем фильтр
                            if (!empty($terms) && !is_wp_error($terms)) {
                        ?>
                                <li class="category-block-filter-list">
                                    <div class="category-block-filter-list-head">
                                        <p class="category-block-filter-list-title"><?php echo esc_html($attribute->attribute_label); ?></p>
                                        <button class="category-block-filter-list-action" aria-controls="<?php echo esc_attr($attribute->attribute_name); ?>-filter">
                                            <img src="<?= get_template_directory_uri() ?>/assets/icons/arrow-list.svg" alt="Toggle <?php echo esc_html($attribute->attribute_label); ?> Filter">
                                        </button>
                                    </div>
                                    <ul class="category-block-filter-list-full">
                                        <?php foreach ($terms as $term) { ?>
                                            <li>
                                                <label class="category-block-filter-list-full-subfilter">
                                                    <p><?php echo esc_html($term->name); ?></p>
                                                    <input type="checkbox"
                                                        class="category-block-filter-list-full-subfilter-checkbox"
                                                        value="<?php echo esc_attr($term->slug); ?>"
                                                        data-filter="<?php echo esc_attr($attribute->attribute_name); ?>">
                                                    <span class="category-block-filter-list-full-subfilter-checkbox-icon"></span>
                                                </label>
                                            </li>
                                        <?php } ?>
                                    </ul>
                                </li>
                        <?php
                            }
                        }
                        ?>
                    </ul>
                </div>
            </aside>
            <section class="products-blocks">
                <div class="loader-blocks-category">
                    <span class="loader"></span>
                </div>
                <?php if ($products->have_posts()) : ?>
                    <ul class="general-main-products-blocks-cards category-blocks-cards">
                        <?php while ($products->have_posts()) : $products->the_post();
                            global $product; ?>
                            <li class="products-blocks-id products-blocks-card" data-id="<?= $product->get_id(); ?>">
                                <div class="products-blocks-card-preview">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php
                                        $thumbnail_id = $product->get_image_id();
                                        $alt_text = get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true);
                                        $title_text = get_the_title($thumbnail_id);
                                        ?>
                                        <img src="<?= wp_get_attachment_image_url($thumbnail_id, 'thumbnail'); ?>"
                                            srcset="<?php echo wp_get_attachment_image_srcset($thumbnail_id); ?>"
                                            alt="<?= esc_attr($alt_text ?: $product->get_name()); ?>"
                                            title="<?= esc_attr($title_text ?: $product->get_name()); ?>"
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
                                    <button class="products-blocks-card-btn-general products-blocks-card-btn-contact">Contact us</button>
                                    <button class="products-blocks-card-btn-general products-blocks-card-btn-cart">
                                        <img src="<?= get_template_directory_uri(); ?>/assets/icons/cart.svg" alt="">
                                    </button>
                                </div>
                            </li>
                        <?php endwhile; ?>
                    </ul>
                <?php else : ?>
                    <p>No products found</p>
                <?php endif; ?>
                <!-- notification add cart -->
                <?php get_template_part('templates/notifications/notification-empty'); ?>
                <!-- notification add cart -->
            </section>
        </section>
    </main>
<?php
    wp_reset_postdata();
}

europe_get_footer();
?>