<?php
// WooCommerce шаблон
europe_get_header();

// Global data all site
$global_settings = get_global_settings(190);

$phone_number = preg_replace('/\s+/', '', $global_settings['phone']);

// Проверяем, является ли это магазином, категорией или тегом
if (is_shop() || is_product_category() || is_product_tag()) {

    $paged = get_query_var('paged') ? get_query_var('paged') : 1;

    $args = array(
        'post_type'      => 'product',
        'posts_per_page' => 12, // Количество продуктов на странице
        'paged' => $paged, // Передача текущей страницы
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
            margin-bottom: 30px;
        }

        .category-blocks {
            padding: 60px 0;
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
        .category-banner-title {
            font-weight: 700;
            font-size: var(--h1-title);
            margin: 47px 0 40px 0;
        }

        .category-banner-description {
            display: flex;
            flex-direction: column;
            gap: 1rem;
            font-size: var(--text-base);
        }

        /* --------------END category-banner-------------- */

        /* --------------START pagination-------------- */
        .pagination {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 8px;
        }

        .pagination ul {
            display: flex;
            list-style: none;
        }

        .pagination-item a,
        .pagination-item span {
            display: inline-block;
            padding: 8px 12px;
            border: 1px solid #ddd;
            border-radius: 4px;
            color: #333;
            text-decoration: none;
            font-size: 16px;
            transition: background-color 0.3s, color 0.3s;
        }

        .pagination-item a:hover,
        .pagination-item span:hover {
            background: linear-gradient(90deg, #f0c814 0%, #f0ac15 100%);
            color: #000;
        }

        .pagination-item-prev a,
        .pagination-item-next a {
            font-weight: 700;
        }

        .pagination-item.active {
            background: linear-gradient(90deg, #f0c814 0%, #f0ac15 100%);
            color: #000;
            cursor: default;
            pointer-events: none;
        }

        /* --------------END pagingation-------------- */

        /* --------------START responsive style-------------- */
        @media (max-width: 768px) {

            /* --------------START category-banner-------------- */
            .category-banner-title {
                margin: 20px 0;
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
                padding: 30px 0;
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
                z-index: 10;
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

            /* --------------START pagination-------------- */
            .pagination ul {
                flex-wrap: wrap;
                justify-content: center;
            }

            .pagination-item a,
            .pagination-item span {
                padding: 6px 10px;
                font-size: 14px;
            }

            .pagination-item-prev a,
            .pagination-item-next a {
                display: none;
                /* Скрываем кнопки "Назад" и "Вперед" на мобильных */
            }

            /* --------------END pagination-------------- */
        }

        /* --------------END responsive style-------------- */
    </style>

    <main class="archive-product container">
        <section class="category-banner">
            <?php if ($category->name) { ?>
                <h1 class="category-banner-title"><?= $category->name; ?></h1>
            <?php } ?>
            <div class="category-banner-description">
                <?php if ($category->description) {
                    // Обрезаем текст на две части
                    $description = $category->description;
                    $parts = explode('.', $description, 2); // Разделяем на две части по первой точке
                    $firstPart = $parts[0] ?? ''; // Первая часть до точки
                    $secondPart = $parts[1] ?? ''; // Оставшаяся часть
                ?>
                    <?= wp_kses_post(wpautop($firstPart . '.')); // Добавляем точку обратно 
                    ?>
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
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/sort-low.svg" alt="Sort by price low to high" title="Sort by price (low to high)">
                            <span>Sort by Price (Low to High)</span>
                        </li>
                        <li class="filter-sort-list" data-sort="price_desc">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/sort-hight.svg" alt="Sort by price high to low" title="Sort by price (high to low)">
                            <span>Sort by Price (High to Low)</span>
                        </li>
                        <li class="filter-sort-list" data-sort="popularity">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/sort-hight.svg" alt="Sort by popularity" title="Sort by popularity">
                            <span>Sort by Popularity</span>
                        </li>
                        <li class="filter-sort-list" data-sort="date">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/sort-hight.svg" alt="Sort by news" title="Sort by news">
                            <span>Sort by News</span>
                        </li>
                    </ul>
                </div>
                <button class="filter-head-mob-btn filter-btn-mob" aria-label="Open filters">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/filters-config.svg" alt="Filters icon" title="Open filters">
                    Filters
                </button>
            </div>
            <aside class="category-block-filter">
                <button class="category-block-filter-mob-close-action">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/close.svg" alt="Close icon" title="Close the filter" class="category-block-filter-mob-close">
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
                            <!-- product cart -->
                            <?php get_template_part('templates/partials/product-card'); ?>
                            <!-- product cart -->
                        <?php endwhile; ?>
                    </ul>
                    <!-- pagination -->
                    <div class="pagination">
                        <?php
                        // Получаем общее количество страниц
                        global $wp_query;

                        $total_pages = $wp_query->max_num_pages;

                        // Получаем текущую страницу
                        $current_page = max(1, get_query_var('paged'));

                        // Генерация пагинации
                        if ($total_pages > 1) {
                            echo generate_custom_pagination($total_pages, $current_page);
                        }
                        ?>
                    </div>
                    <!-- pagination -->
                <?php else : ?>
                    <p>No products found</p>
                <?php endif; ?>
                <!-- notification add cart -->
                <?php get_template_part('templates/notifications/notification-empty'); ?>
                <!-- notification add cart -->
            </section>
        </section>

        <section class="category-banner">
            <div class="category-banner-description">
                <?php if (!empty($secondPart)) { ?>
                    <?= wp_kses_post(wpautop($secondPart)); ?>
            </div>
        <?php } ?>
        </section>
    </main>
<?php
    wp_reset_postdata();
}

europe_get_footer();
?>