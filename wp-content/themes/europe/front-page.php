<?php europe_get_header(); ?>

<section class="banner">
    <div class="banner-content container">
        <h1 class="banner-content-title">Electronic Components Distributor with a Huge Selection in Stock and Ready to Ship with no Minimum Orders</h1>
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
                        <button class="contact-popup-blocks-form-action-btn">Contact me</button>
                    </div>
                    <div class="custom-checkbox-wrapper">
                        <label class="custom-checkbox-label">
                            <input type="checkbox" class="custom-checkbox">
                            <span class="custom-check-icon"></span>
                            I have read and agree to the <a href="#" class="custom-check-policy"> data processing policy</a>
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
                    <li class="products-blocks-card">
                        <div class="products-blocks-card-preview">
                            <img src="" alt="" class="products-blocks-card-preview-image">
                            <h3 class="products-blocks-card-preview-title">DELL EMC PowerEdge R630 (8xSFF/3xLP) Performance Rack test</h3>
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

<script>
    // Variadble menu
    const menuCloseBtn = document.querySelector(".menu-close");
    const menuToggle = document.getElementById('menuToogle');
    const sideMenu = document.getElementById('sideMenu');
    // Variadble search popup
    const searchToggle = document.getElementById('searchToogle');
    const searchPopup = document.getElementById('searchPopup');
    const searchCloseBtn = document.querySelector('.search-popup-block-close');
    // Variadble contact popup
    const contactPopupOpen = document.querySelector(".button-content-contact");
    const contactPopupForm = document.getElementById("contactPopup");
    const contactPopupСlose = document.querySelector(".contact-popup-blocks-header-btn");
    // Variadble general
    const overlay = document.getElementById('overlay');

    // Переключение overlay
    function toggleOverlay(isVisible) {
        if (overlay) overlay.classList.toggle("active", isVisible);
    }

    // Обновление состояния overlay
    function updateOverlayState() {
        const isOverlayActive = sideMenu.classList.contains("open") || searchPopup.classList.contains("open") || contactPopupForm.classList.contains("open");
        toggleOverlay(isOverlayActive);
    }

    // Открытие/закрытие бокового меню
    if (menuToggle && sideMenu) {
        menuToggle.addEventListener("click", () => {
            sideMenu.classList.toggle("open");
            updateOverlayState();
        });
    }

    // Открытие/закрытие поиска
    if (searchToggle && searchPopup) {
        searchToggle.addEventListener("click", () => {
            searchPopup.classList.toggle("open");
            updateOverlayState();
        });
    }

    // Открытие/закрытие контакты
    if (contactPopupOpen && contactPopupForm) {
        contactPopupOpen.addEventListener("click", () => {
            contactPopupForm.classList.toggle("open");
            updateOverlayState();
        });
    }

    // Закрытие поиска при клике на кнопку закрытия
    if (searchCloseBtn && searchPopup) {
        searchCloseBtn.addEventListener("click", () => {
            searchPopup.classList.remove("open");
            updateOverlayState();
        });
    }

    // Закрытие меню при клике на кнопку закрытия
    if (menuCloseBtn && sideMenu) {
        menuCloseBtn.addEventListener("click", () => {
            sideMenu.classList.remove("open");
            updateOverlayState();
        });
    }

    // Закрытие меню при клике на кнопку закрытия
    if (contactPopupСlose && contactPopupForm) {
        contactPopupСlose.addEventListener("click", () => {
            contactPopupForm.classList.remove("open");
            updateOverlayState();
        });
    }

    // Закрытие по клику вне блока или на overlay
    document.addEventListener("click", (event) => {
        if (overlay && event.target === overlay) {
            sideMenu.classList.remove("open");
            searchPopup.classList.remove("open");
            contactPopupForm.classList.remove("open");
            toggleOverlay(false);
        }
    });

    const menuListMain = document.querySelectorAll(".menu-blocks-link-toggle");
    const menuSubMenu = document.querySelectorAll(".menu-blocks-links-submenu");

    menuListMain.forEach((key, value) => {
        key.addEventListener("click", () => {
            menuListMain[value].classList.toggle("open");
            menuSubMenu[value].classList.toggle("open");
        });
    });

    const categoriesMenuBtn = document.querySelector(".menu-blocks-header-categories");
    const categoriesMenu = document.getElementById("categoriesMenu");
    const brandsMenu = document.getElementById("brandsMenu");
    const brandsMenuBtn = document.querySelector(".menu-blocks-header-brands");

    brandsMenuBtn.addEventListener("click", () => {
        brandsMenuBtn.classList.add("active");
        categoriesMenuBtn.classList.remove("active");
        brandsMenu.classList.remove("hidden");
        categoriesMenu.classList.add("hidden");
    });

    categoriesMenuBtn.addEventListener("click", () => {
        brandsMenuBtn.classList.remove("active");
        categoriesMenuBtn.classList.add("active");
        brandsMenu.classList.add("hidden");
        categoriesMenu.classList.remove("hidden");
    });
</script>
<?php europe_get_footer(); ?>