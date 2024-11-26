<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <div id="overlay" class="overlay"></div>
    <header>
        <div class="header-block">
            <div class="header-blocks container">
                <div class="header-block-main">
                    <nav class="header-block-main-menu">
                        <button id="menuToogle" title="Open menu">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/menu.svg" alt="Menu icon">
                            Menu
                        </button>
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
        </div>

        <nav class="nav-line">
            <div class="nav-blocks container">
                <div class="nav-block-catalog">
                    <ul class="nav-block-catalog-lists">
                        <?php
                        wp_nav_menu(array(
                            'theme_location' => 'side-menu-categories',  // Замените на ваше место расположения меню
                            'container' => false,                         // Убираем контейнер вокруг меню
                            'menu_class' => 'nav-block-catalog-lists',    // Присваиваем класс для списка
                            'items_wrap' => '%3$s',                       // Выводим только элементы <li>
                            'walker' => new Custom_Walker_Nav_Menu(),     // Используем кастомный walker
                            'depth' => 1                                  // Убираем вложенные пункты меню
                        ));
                        ?>
                    </ul>
                </div>
                <div class="nav-blocks-detail">
                    <div class="nav-blocks-cart-search">
                        <input type="search" name="" id="" placeholder="Search on the Site" class="nav-blocks-detail-search-input">
                        <img id="searchToogle" src="<?php echo get_template_directory_uri(); ?>/assets/icons/search.svg" alt="Search icon">
                    </div>
                    <aside id="sideMenu" aria-label="Site navigation">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/close.svg" alt="" class="menu-close">
                        <div class="menu-blocks">
                            <div class="menu-blocks-header">
                                <button class="menu-blocks-header-btn-general active menu-blocks-header-categories">Categories</button>
                                <span>|</span>
                                <button class="menu-blocks-header-btn-general menu-blocks-header-brands">Brands</button>
                            </div>
                            <?php
                            wp_nav_menu(array(
                                'theme_location' => 'side-menu-brands',
                                'container' => 'ul', // Убираем обертку div
                                'menu_id' => 'brandsMenu', // Присваиваем ID
                                'menu_class' => 'menu-blocks-links hidden', // Присваиваем класс
                                'depth' => 2, // Поддержка вложенных пунктов
                                'walker' => new Custom_Walker_Side_Menu() // Добавляем кастомный walker для точной структуры
                            ));
                            ?>
                            <?php
                            wp_nav_menu(array(
                                'theme_location' => 'side-menu-categories',
                                'container' => 'ul', // Убираем обертку div
                                'menu_id' => 'categoriesMenu', // Присваиваем ID
                                'menu_class' => 'menu-blocks-links', // Присваиваем класс
                                'depth' => 2, // Поддержка вложенных пунктов
                                'walker' => new Custom_Walker_Side_Menu() // Добавляем кастомный walker для точной структуры
                            ));
                            ?>
                            <ul class="menu-blocks-pages-general">
                                <li><a href="#">About us</a></li>
                                <li><a href="#">Payment and Delivery</a></li>
                                <li><a href="#">Contacts</a></li>
                            </ul>
                            <ul class="menu-blocks-contact">
                                <li>
                                    <a href="">+34 666 359 259</a>
                                    <span>Phone, WhatsApp, Telegram</span>
                                </li>
                                <li>
                                    <a href="">info@info.com</a>
                                    <span>For questions regarding acquisition and cooperation</span>
                                </li>
                                <li>
                                    <a href="">Address</a>
                                    <span>08912, Spain, Barcelona, Badalona, Cervantes 68 </span>
                                </li>
                            </ul>
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
                        </div>
                    </aside>
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
                                <p class="search-popup-block-results-header">
                                    Based on your request we found <span class="search-popup-block-results-header-count-offers">17 offers</span></p>
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