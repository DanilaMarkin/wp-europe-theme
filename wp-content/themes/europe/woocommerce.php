<?php

// WooCommerce шаблон
europe_get_header();

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

        /* --------------START category-block-filter-------------- */
        .category-block-filter {
            max-width: 253px;
            padding: 30px 30px 0 0;
            width: 100%;
            border-right: 2px solid #7D7D7D;
        }

        .category-block-filter-hide {
            font-size: 12px;
            color: #7D7D7D;
            margin-bottom: 30px;
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

        .category-block-filter-list-action {
            margin-right: 5px;
            width: 10px;
            height: 10px;
            transition: transform 0.3s ease;
        }

        .category-block-filter-list-full {
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
    </style>

    <main class="container category-blocks">
        <aside class="category-block-filter">
            <span class="category-block-filter-hide" role="button" aria-label="Hide All Filters">Hide All</span>
            <div class="category-blocks-filter-head-lists">
                <ul class="category-block-filter-lists">
                    <li class="category-block-filter-list">
                        <div class="category-block-filter-list-head">
                            <p class="category-block-filter-list-title">Brand</p>
                            <button class="category-block-filter-list-action" aria-expanded="false" aria-controls="brand-filter">
                                <img src="<?= get_template_directory_uri() ?>/assets/icons/arrow-list.svg" alt="Toggle Brand Filter">
                            </button>
                        </div>
                        <ul class="category-block-filter-list-full">
                            <li>
                                <label class="category-block-filter-list-full-subfilter">
                                    <p>Dell</p>
                                    <input type="checkbox" class="category-block-filter-list-full-subfilter-checkbox">
                                    <span class="category-block-filter-list-full-subfilter-checkbox-icon"></span>
                                </label>
                            </li>
                            <li>
                                <label class="category-block-filter-list-full-subfilter">
                                    <p>Asus</p>
                                    <input type="checkbox" class="category-block-filter-list-full-subfilter-checkbox">
                                    <span class="category-block-filter-list-full-subfilter-checkbox-icon"></span>
                                </label>
                            </li>
                            <li>
                                <label class="category-block-filter-list-full-subfilter">
                                    <p>Intel</p>
                                    <input type="checkbox" class="category-block-filter-list-full-subfilter-checkbox">
                                    <span class="category-block-filter-list-full-subfilter-checkbox-icon"></span>
                                </label>
                            </li>
                            <li>
                                <label class="category-block-filter-list-full-subfilter">
                                    <p>AMD</p>
                                    <input type="checkbox" class="category-block-filter-list-full-subfilter-checkbox">
                                    <span class="category-block-filter-list-full-subfilter-checkbox-icon"></span>
                                </label>
                            </li>
                        </ul>
                    </li>
                    <li class="category-block-filter-list">
                        <div class="category-block-filter-list-head">
                            <p class="category-block-filter-list-title">Brand</p>
                            <button class="category-block-filter-list-action" aria-expanded="false" aria-controls="brand-filter">
                                <img src="<?= get_template_directory_uri() ?>/assets/icons/arrow-list.svg" alt="Toggle Brand Filter">
                            </button>
                        </div>
                        <ul class="category-block-filter-list-full">
                            <li>
                                <label class="category-block-filter-list-full-subfilter">
                                    <p>Dell</p>
                                    <input type="checkbox" class="category-block-filter-list-full-subfilter-checkbox">
                                    <span class="category-block-filter-list-full-subfilter-checkbox-icon"></span>
                                </label>
                            </li>
                            <li>
                                <label class="category-block-filter-list-full-subfilter">
                                    <p>Asus</p>
                                    <input type="checkbox" class="category-block-filter-list-full-subfilter-checkbox">
                                    <span class="category-block-filter-list-full-subfilter-checkbox-icon"></span>
                                </label>
                            </li>
                            <li>
                                <label class="category-block-filter-list-full-subfilter">
                                    <p>Intel</p>
                                    <input type="checkbox" class="category-block-filter-list-full-subfilter-checkbox">
                                    <span class="category-block-filter-list-full-subfilter-checkbox-icon"></span>
                                </label>
                            </li>
                            <li>
                                <label class="category-block-filter-list-full-subfilter">
                                    <p>AMD</p>
                                    <input type="checkbox" class="category-block-filter-list-full-subfilter-checkbox">
                                    <span class="category-block-filter-list-full-subfilter-checkbox-icon"></span>
                                </label>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </aside>
        <section class="products-blocks container">
            <?php if ($products->have_posts()) : ?>
                <ul class="category-blocks-cards">
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
                                    <img src="<?= wp_get_attachment_image_url($thumbnail_id, 'medium'); ?>"
                                        alt="<?= esc_attr($alt_text ?: $product->get_name()); ?>"
                                        title="<?= esc_attr($title_text ?: $product->get_name()); ?>"
                                        class="products-blocks-card-preview-image">
                                </a>
                                <h3 class="products-blocks-card-preview-title"><?php the_title(); ?></h3>
                                <span class="products-blocks-card-preview-price">from <?= $product->get_price_html(); ?></span>
                            </div>
                            <div class="products-blocks-card-btn">
                                <div class="products-blocks-card-btn-contact-full">
                                    <button class="products-blocks-card-btn-contact-full-general products-blocks-card-btn-contact-full-wa">
                                        <img src="<?= get_template_directory_uri(); ?>/assets/icons/whatsapp.svg" alt="">
                                    </button>
                                    <button class="products-blocks-card-btn-contact-full-general products-blocks-card-btn-contact-full-tg">
                                        <img src="<?= get_template_directory_uri(); ?>/assets/icons/telegram-sidemenu.svg" alt="">
                                    </button>
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
        </section>
    </main>

    <script>
        const categoryToogle = document.querySelectorAll(".category-block-filter-list-head");
        const categorySub = document.querySelectorAll(".category-block-filter-list-full");

        categoryToogle.forEach((index, item) => {
            index.addEventListener("click", () => {
                categoryToogle[item].classList.toggle("open");
                categorySub[item].classList.toggle("open");
            });
        });
    </script>
<?php
    wp_reset_postdata();
}

europe_get_footer();
?>