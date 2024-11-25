<?php
/* Template Name: Главная страница */
europe_get_header();
?>
<section class="banner">
    <div class="banner-content container">
        <?php
        // Получаем записи из категории "Баннеры"
        $args = array(
            'category_name'  => 'banner', // Слаг категории
            'posts_per_page' => -1,       // Все записи из категории
        );

        $query = new WP_Query($args);

        if ($query->have_posts()) :
            while ($query->have_posts()) : $query->the_post();
        ?>
                <h1 class="banner-content-title"><?php the_content(); ?></h1>
        <?php
            endwhile;
            wp_reset_postdata();
        else :
            echo '<p>В категории "Баннеры" пока нет записей.</p>';
        endif;
        ?>
        <div class="banner-content-buttons">
            <button class="button-content-general button-content-contact">Contact us</button>
            <button class="button-content-general button-content-download">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/download.svg" alt="Download icon"> Download Price List
            </button>
        </div>
    </div>
    <div class="banner-image">
        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/thumbnails/banner-image.webp" alt="Electronic components image">
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
                <form action="">
                    <p class="contact-popup-blocks-form-head">Provide your phone number for contact or contact us yourself</p>
                    <div class="contact-popup-blocks-form-action">
                        <input type="tel" placeholder="+7 (999) 999 99 99" name="" id="">
                        <input type="text" placeholder="Name" name="" id="">
                        <button class="contact-popup-blocks-form-action-btn" aria-label="Press to Contact me button">Contact me</button>
                    </div>
                    <div class="custom-checkbox-wrapper">
                        <label class="custom-checkbox-label">
                            <input type="checkbox" class="custom-checkbox">
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
        <div class="products-blocks container">
            <div class="products-blocks-header">
                <h2 class="products-blocks-header-title">Server Equipment</h2>
                <a href="#" class="products-blocks-header-all-link">
                    <span class="products-blocks-header-all">View All Products</span>
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/arrow_all.svg" alt="">
                </a>
            </div>
            <ul class="products-blocks-cards">
                <?php for ($i = 0; $i < 8; $i++) { ?>
                    <li class="products-blocks-id products-blocks-card" data-id="<?= $i ?>">
                        <div class="products-blocks-card-preview">
                            <img src="" alt="" class="products-blocks-card-preview-image">
                            <h3 class="products-blocks-card-preview-title">DELL EMC PowerEdge R630 (8xSFF/3xLP) Performance Rack test</h3>
                            <span class="products-blocks-card-preview-price">from $428</span>
                        </div>
                        <div class="products-blocks-card-btn">
                            <div class="products-blocks-card-btn-contact-full">
                                <button class="products-blocks-card-btn-contact-full-general products-blocks-card-btn-contact-full-wa">
                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/whatsapp.svg" alt="">
                                </button>
                                <button class="products-blocks-card-btn-contact-full-general products-blocks-card-btn-contact-full-tg">
                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/telegram-sidemenu.svg" alt="">
                                </button>
                            </div>
                            <div class="products-blocks-card-btn-count">
                                <button class="count-btn minus" aria-label="Уменьшить количество">-</button>
                                <span class="count-number">0</span>
                                <button class="count-btn plus" aria-label="Увеличить количество">+</button>
                            </div>
                            <button class="products-blocks-card-btn-general products-blocks-card-btn-contact">Contact us</button>
                            <button class="products-blocks-card-btn-general products-blocks-card-btn-cart">
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/cart.svg" alt="">
                            </button>
                        </div>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </section>
    <section class="all-categories container">
        <a href="#" class="all-categories-blocks">
            <h2 class="all-categories-blocks-title">View All Categories</h2>
            <div class="all-categories-blocks-arrow">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/arrow_all.svg" alt="" class="all-categories-blocks-arrow-img">
            </div>
        </a>
    </section>
</main>

<?php europe_get_footer(); ?>