<?php europe_get_header(); ?>

<section class="banner">
    <div class="banner-content container">
        <h1 class="banner-content-title">Electronic Components Distributor with a Huge Selection in Stock and Ready to Ship with no Minimum Orders</h1>
        <div class="banner-content-buttons">
            <a href="#contact" class="button-content-general button-content-contact">Contact us</a>
            <a href="#download" class="button-content-general button-content-download">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/download.svg" alt="Download icon"> Download Price List
            </a>
        </div>
    </div>
    <div class="banner-image">
        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/thumbnails/banner-image.webp" alt="Electronic components image">
    </div>
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
                        <a href="/">Apple</a>
                    </li>
                    <li class="brands-blocks-slider-lists-circle">
                        <a href="">Asus</a>
                    </li>
                    <li class="brands-blocks-slider-lists-circle">
                        <a href="">SuperMicro</a>
                    </li>
                    <li class="brands-blocks-slider-lists-circle">
                        <a href="">Intel</a>
                    </li>
                    <li class="brands-blocks-slider-lists-circle">
                        <a href="">AMD</a>
                    </li>
                    <li class="brands-blocks-slider-lists-circle">
                        <a href="">Gigabyte</a>
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
                <li class="products-blocks-card">
                    <div class="products-blocks-card-preview">
                        <img src="" alt="" class="products-blocks-card-preview-image">
                        <p class="products-blocks-card-preview-title">DELL EMC PowerEdge R630 (8xSFF/3xLP) Performance Rack test</p>
                        <span class="products-blocks-card-preview-price">from $428</span>
                    </div>
                    <div class="products-blocks-card-btn">
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
            <span class="all-categories-blocks-arrow">&#8599;</span>
        </a>
    </section>
</main>

<?php europe_get_footer(); ?>