<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <header>
        <div class="header-blocks container">
            <div class="header-block-main">
                <nav class="header-block-main-menu">
                    <button id="menuToogle" title="Open menu">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/menu.svg" alt="Menu icon">
                        Menu
                    </button>
                    <aside id="sideMenu" aria-label="Site navigation">
                    </aside>
                </nav>
                <nav class="header-block-main-general">
                    <ul class="header-block-main-general-lists">
                        <li>
                            <a href="" title="Learn more about us">About us</a>
                        </li>
                        <li>
                            <a href="" title="Payment and delivery terms">Payment and Delivery</a>
                        </li>
                        <li>
                            <a href="" title="Contact information">Contacts</a>
                        </li>
                    </ul>
                </nav>
            </div>
            <div class="header-block-social">
                <ul class="header-block-social-list">
                    <li>
                        <a href="" title="Telegram">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/telegram.svg" alt="Telegram icon">
                        </a>
                    </li>
                    <li>
                        <a href="" title="WhatsApp">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/whatsapp.svg" alt="WhatsApp icon">
                        </a>
                    </li>
                    <li>
                        <a href="" title="Call us">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/phone.svg" alt="Phone icon">
                        </a>
                    </li>
                    <li>
                        <a href="" title="Send an email">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/mail.svg" alt="Mail icon">
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <nav class="nav-line">
            <div class="nav-blocks container">
                <div class="nav-block-catalog">
                    <ul class="nav-block-catalog-lists">
                        <li>
                            <a href="" title="View server equipment catalog">
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/server_equipment.svg" alt="Server equipment icon">Server Equipment
                            </a>
                        </li>
                        <li>
                            <a href="" title="View computers and laptops catalog">
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/computers_and_laptops.svg" alt="Computers and laptops icon"> Computers and Laptops
                            </a>
                        </li>
                        <li>
                            <a href="" title="View storage catalog">
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/storage.svg" alt="Storage icon"> Storage
                            </a>
                        </li>
                        <li>
                            <a href="" title="View workstations catalog">
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/workstations.svg" alt="Workstations icon"> Workstations
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="nav-blocks-detail">
                    <div id="searchToogle" class="nav-blocks-cart-search">
                        <input type="search" name="" id="">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/search.svg" alt="Search icon">
                    </div>
                    <aside id="searchPopup" aria-label="Search Popup">
                        <div class="search-popup-blocks container">
                            <div class="search-popup-block">
                                <div class="search-popup-block-action">
                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/search.svg" alt="" class="search-popup-block-icon">
                                    <input type="search" placeholder="Search on the Site" class="search-popup-block-inlet">
                                </div>
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/close.svg" alt="" class="search-popup-block-close">
                            </div>
                            <div class="search-popup-block-results">
                                <!-- <p class="search-popup-block-results-header">No results were found for your request</p> -->
                                <ul class="search-popup-block-results-products products-blocks-cards ">
                                    <?php for ($i = 0; $i < 4; $i++) { ?>
                                        <li class="products-blocks-card">
                                            <div class="products-blocks-card-preview">
                                                <img src="" alt="" class="products-blocks-card-preview-image">
                                                <p class="products-blocks-card-preview-title">DELL EMC PowerEdge R630 (8xSFF/3xLP) Performance Rack test</p>
                                                <span class="products-blocks-card-preview-price">from $428</span>
                                            </div>
                                        </li>
                                    <?php } ?>
                                </ul>
                            </div>
                        </div>
                    </aside>
                    <div class="nav-block-cart">
                        <a href="" title="Go to cart" class="nav-block-cart-link">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/cart.svg" alt="Cart icon" class="nav-block-cart-img">
                        </a>
                        <span class="nav-block-cart-count">0</span>
                    </div>
                </div>
            </div>
        </nav>
    </header>


    <style>
        #sideMenu {
            position: fixed;
            top: 0;
            left: 0;
            width: 608px;
            height: 947px;
            background-color: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            /* Легкая тень для контраста */
            transform: translateX(-100%);
            /* Изначально меню скрыто за пределами экрана */
            transition: transform 0.3s ease;
            /* Плавный переход */
            z-index: 9;
            overflow-y: auto;
        }

        #sideMenu.open {
            transform: translateX(0);
        }
    </style>
    <script>
        // Получаем ссылки на элементы
        const menuToggle = document.getElementById('menuToogle');
        const sideMenu = document.getElementById('sideMenu');
        const searchToggle = document.getElementById('searchToogle');
        const searchPopup = document.getElementById('searchPopup');
        const searchCloseBtn = document.querySelector('.search-popup-block-close');

        // Функция для переключения видимости элемента
        function toggleClass(element, className) {
            if (element) element.classList.toggle(className);
        }

        // Открытие/закрытие бокового меню
        if (menuToggle && sideMenu) {
            menuToggle.addEventListener("click", () => toggleClass(sideMenu, "open"));
        }

        // Открытие/закрытие поиска
        if (searchToggle && searchPopup) {
            searchToggle.addEventListener("click", () => toggleClass(searchPopup, "open"));
        }

        // Закрытие поиска при клике на кнопку закрытия
        if (searchCloseBtn && searchPopup) {
            searchCloseBtn.addEventListener("click", () => searchPopup.classList.remove("open"));
        }

        // Закрытие по клику вне блока
        document.addEventListener("click", (event) => {
            // Проверка клика вне бокового меню
            if (sideMenu && !sideMenu.contains(event.target) && !menuToggle.contains(event.target)) {
                sideMenu.classList.remove("open");
            }

            // Проверка клика вне всплывающего окна поиска
            if (searchPopup && !searchPopup.contains(event.target) && !searchToggle.contains(event.target)) {
                searchPopup.classList.remove("open");
            }
        });
    </script>