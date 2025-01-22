<?php
/* Template Name: Главная страница */
europe_get_header();

// Global data all site
$global_settings = get_global_settings(190);

$phone_number = preg_replace('/\s+/', '', $global_settings['phone']);
?>

<section class="banner">
    <div class="banner-content container">
        <h1 class="banner-content-title"><?= esc_html(get_field("title_banner")) ?: "There's nothing here yet" ?></h1>
        <div class="banner-content-buttons">
            <button class="button-content-general button-content-contact">Contact us</button>
            <button class="button-content-general button-content-download">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/download.svg" alt="Download icon"> Download Price List
            </button>
        </div>
    </div>
    <div class="banner-image">
        <?php
        $img_banner = get_field("img_banner");
        if ($img_banner) {
            $img_banner_id = $img_banner["ID"];
            $img_banner_alt = $img_banner["alt"] ?: "banner";
            $img_banner_title = $img_banner["title"];

            // Получаем URLы для разных размеров
            $img_banner_medium = wp_get_attachment_image_url($img_banner_id, 'medium'); // Мобильная версия
            $img_banner_large = wp_get_attachment_image_url($img_banner_id, 'large'); // Десктопная версия
        }
        ?>
        <img src="<?= esc_url($img_banner_medium); ?>"
            srcset="<?= esc_url($img_banner_medium); ?> 768w, <?= esc_url($img_banner_large); ?> 1024w"
            sizes="(max-width: 768px) 100vw, 1024px"
            title="<?= $img_banner_title; ?>"
            alt="<?= $img_banner_alt; ?>">
    </div>
    <aside id="contactPopup" aria-label="Contact us">
        <div class="contact-popup-blocks">
            <div class="contact-popup-blocks-header">
                <p>Contact Us</p>
                <button class="contact-popup-blocks-header-btn">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/close.svg" alt="" class="contact-popup-blocks-header-btn-close">
                </button>
            </div>
            <div class="contact-popup-blocks-form">
                <form id="contactForm">
                    <p class="contact-popup-blocks-form-head">Provide your phone number for contact or contact us yourself</p>
                    <div class="contact-popup-blocks-form-action">
                        <input type="tel" placeholder="+7 (999) 999 99 99" name="phone" id="phoneContact">
                        <input type="text" placeholder="Name" name="name" id="nameContact">
                        <button class="contact-popup-blocks-form-action-btn" aria-label="Press to Contact me button">Contact me</button>
                    </div>
                    <div class="custom-checkbox-wrapper">
                        <label id="contactLabelCheckbox" class="custom-checkbox-label">
                            <input id="contactCheckbox" type="checkbox" class="custom-checkbox">
                            <span class="custom-check-icon"></span>
                            <div class="custom-checkbox-label-text-agree">
                                I have read and agree to the <a href="#" class="custom-check-policy"> data processing policy</a>
                            </div>
                        </label>
                    </div>
                    <ul class="menu-blocks-social-blocks">
                        <li>
                            <a href="#">
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/phone-sidemenu.svg" alt="">
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/whatsapp-sidemenu.svg" alt="">
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/telegram-sidemenu.svg" alt="">
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/phone-sidemenu.svg" alt="">
                            </a>
                        </li>
                    </ul>
                </form>
                <div id="loaderContact" class="loader-blocks-contact hidden">
                    <span class="loader"></span>
                </div>
            </div>
        </div>
    </aside>
    <aside id="pricePopup" aria-label="Price List">
        <div class="contact-popup-blocks">
            <div class="contact-popup-blocks-header">
                <p>Download Price List</p>
                <button class="price-popup-blocks-header-btn contact-popup-blocks-header-btn">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/close.svg" alt="" class="contact-popup-blocks-header-btn-close">
                </button>
            </div>
            <div class="contact-popup-blocks-form">
                <form action="">
                    <p class="contact-popup-blocks-form-head">Provide your phone number and get the opportunity to download a price list for all offered Apple products.
                    </p>
                    <div class="price-popup-blocks-form-action">
                        <input type="tel" placeholder="+7 (999) 999 99 99" name="" id="">
                        <button class="price-popup-blocks-form-action-btn" aria-label="Press to Contact me button">Download Price List</button>
                    </div>
                    <div class="price-checkbox-wrapper">
                        <label class="custom-checkbox-label">
                            <input type="checkbox" class="custom-checkbox">
                            <span class="custom-check-icon"></span>
                            <div class="custom-checkbox-label-text-agree">
                                I have read and agree to the <a href="#" class="custom-check-policy"> data processing policy</a>
                            </div>
                        </label>
                    </div>
                </form>
            </div>
        </div>
    </aside>
</section>

<main>
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
    <section class="products">
        <?php
        // Получаем все категории продуктов
        $categories = get_terms(array(
            'taxonomy' => 'product_cat',
            'hide_empty' => true,
        ));

        if (!empty($categories) && !is_wp_error($categories)) {
            foreach ($categories as $category) {
        ?>
                <div class="products-blocks container">
                    <div class="products-blocks-header">
                        <h2 class="products-blocks-header-title"><?php echo esc_html($category->name); ?></h2>
                        <a href="<?php echo esc_url(get_term_link($category)); ?>" class="products-blocks-header-all-link">
                            <span class="products-blocks-header-all">View All Products</span>
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/arrow_all.svg" alt="">
                        </a>
                    </div>
                    <ul class="general-main-products-blocks-cards products-blocks-cards">
                        <?php
                        $args = array(
                            'post_type' => 'product',
                            'posts_per_page' => 4, // Выводим максимум 4 товара
                            'tax_query' => array(
                                array(
                                    'taxonomy' => 'product_cat',
                                    'field' => 'term_id',
                                    'terms' => $category->term_id,
                                ),
                            ),
                        );

                        $loop = new WP_Query($args);
                        if ($loop->have_posts()) {
                            while ($loop->have_posts()) {
                                $loop->the_post();
                                global $product;
                        ?>
                                <li class="products-blocks-id products-blocks-card" data-id="<?= $product->get_id(); ?>">
                                    <div class="products-blocks-card-preview">
                                        <a href="<?php echo get_permalink($product->get_id()); ?>">
                                            <?php
                                            $thumbnail_id = $product->get_image_id();
                                            $alt_text = get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true);
                                            $title_text = get_the_title($thumbnail_id);
                                            ?>
                                            <img src="<?php echo wp_get_attachment_image_url($thumbnail_id, 'thumbnail'); ?>"
                                                srcset="<?php echo wp_get_attachment_image_srcset($thumbnail_id); ?>"
                                                alt="<?php echo esc_attr($alt_text ?: $product->get_name()); ?>"
                                                title="<?php echo esc_attr($title_text ?: $product->get_name()); ?>"
                                                class="products-blocks-card-preview-image">
                                        </a>
                                        <h3 class="products-blocks-card-preview-title"><?php the_title(); ?></h3>
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
                                        <button class="products-blocks-card-btn-general products-blocks-card-btn-contact">Request</button>
                                        <button class="products-blocks-card-btn-general products-blocks-card-btn-cart">
                                            <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/cart.svg" alt="">
                                        </button>
                                    </div>
                                </li>
                        <?php }
                        } else {
                            echo '<p>No products found in this category</p>';
                        }
                        wp_reset_postdata();
                        ?>
                    </ul>
                </div>
        <?php
            }
        } else {
            echo '<p>No product categories found</p>';
        }
        ?>
        <!-- notification add cart -->
        <?php get_template_part('templates/notifications/notification-empty'); ?>
        <!-- notification add cart -->
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

<?php europe_get_footer(); ?>