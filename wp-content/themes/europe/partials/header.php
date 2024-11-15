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
                        <aside id="sideMenu" aria-label="Site navigation">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/close.svg" alt="" class="menu-close">
                            <div class="menu-blocks">
                                <div class="menu-blocks-header">
                                    <button class="menu-blocks-header-btn-general active menu-blocks-header-categories">Categories</button>
                                    <span>|</span>
                                    <button class="menu-blocks-header-btn-general menu-blocks-header-brands">Brands</button>
                                </div>
                                <ul id="brandsMenu" class="menu-blocks-links hidden">
                                    <li class="menu-blocks-link">
                                        <button class="menu-blocks-link-toggle" aria-expanded="false">
                                            <span>Apple</span>
                                            <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/arrow-list.svg" alt="Expand subcategories">
                                        </button>
                                        <ul class="menu-blocks-links-submenu">
                                            <li>
                                                <a href="">Subcategory</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="menu-blocks-link">
                                        <button class="menu-blocks-link-toggle" aria-expanded="false">
                                            <span>Asus</span>
                                            <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/arrow-list.svg" alt="Expand subcategories">
                                        </button>
                                        <ul class="menu-blocks-links-submenu">
                                            <li>
                                                <a href="">Subcategory</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="menu-blocks-link">
                                        <button class="menu-blocks-link-toggle" aria-expanded="false">
                                            <span>Supermicro</span>
                                            <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/arrow-list.svg" alt="Expand subcategories">
                                        </button>
                                        <ul class="menu-blocks-links-submenu">
                                            <li>
                                                <a href="">Subcategory</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="menu-blocks-link">
                                        <button class="menu-blocks-link-toggle" aria-expanded="false">
                                            <span>Intel</span>
                                            <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/arrow-list.svg" alt="Expand subcategories">
                                        </button>
                                        <ul class="menu-blocks-links-submenu">
                                            <li>
                                                <a href="">Subcategory</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="menu-blocks-link">
                                        <button class="menu-blocks-link-toggle" aria-expanded="false">
                                            <span>AMD</span>
                                            <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/arrow-list.svg" alt="Expand subcategories">
                                        </button>
                                        <ul class="menu-blocks-links-submenu">
                                            <li>
                                                <a href="">Subcategory</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="menu-blocks-link">
                                        <button class="menu-blocks-link-toggle" aria-expanded="false">
                                            <span>Gigabyte</span>
                                            <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/arrow-list.svg" alt="Expand subcategories">
                                        </button>
                                        <ul class="menu-blocks-links-submenu">
                                            <li>
                                                <a href="">Subcategory</a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                                <ul id="categoriesMenu" class="menu-blocks-links">
                                    <li class="menu-blocks-link">
                                        <button class="menu-blocks-link-toggle" aria-expanded="false">
                                            <span>Server Equipment</span>
                                            <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/arrow-list.svg" alt="Expand subcategories">
                                        </button>
                                        <ul class="menu-blocks-links-submenu">
                                            <li>
                                                <a href="">Subcategory</a>
                                            </li>
                                            <li>
                                                <a href="">Subcategory</a>
                                            </li>
                                            <li>
                                                <a href="">Subcategory</a>
                                            </li>
                                            <li>
                                                <a href="">Subcategory</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="menu-blocks-link">
                                        <button class="menu-blocks-link-toggle" aria-expanded="false">
                                            <span>Computers and Laptops</span>
                                            <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/arrow-list.svg" alt="Expand subcategories">
                                        </button>
                                        <ul class="menu-blocks-links-submenu">
                                            <li>
                                                <a href="">Subcategory</a>
                                            </li>
                                            <li>
                                                <a href="">Subcategory</a>
                                            </li>
                                            <li>
                                                <a href="">Subcategory</a>
                                            </li>
                                            <li>
                                                <a href="">Subcategory</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="menu-blocks-link">
                                        <button class="menu-blocks-link-toggle" aria-expanded="false">
                                            <span>Storage</span>
                                            <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/arrow-list.svg" alt="Expand subcategories">
                                        </button>
                                        <ul class="menu-blocks-links-submenu">
                                            <li>
                                                <a href="">Subcategory</a>
                                            </li>
                                            <li>
                                                <a href="">Subcategory</a>
                                            </li>
                                            <li>
                                                <a href="">Subcategory</a>
                                            </li>
                                            <li>
                                                <a href="">Subcategory</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="menu-blocks-link">
                                        <button class="menu-blocks-link-toggle" aria-expanded="false">
                                            <span>Workstations</span>
                                            <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/arrow-list.svg" alt="Expand subcategories">
                                        </button>
                                        <ul class="menu-blocks-links-submenu">
                                            <li>
                                                <a href="">Subcategory</a>
                                            </li>
                                            <li>
                                                <a href="">Subcategory</a>
                                            </li>
                                            <li>
                                                <a href="">Subcategory</a>
                                            </li>
                                            <li>
                                                <a href="">Subcategory</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="menu-blocks-link">
                                        <button class="menu-blocks-link-toggle" aria-expanded="false">
                                            <span>Network Equipment</span>
                                            <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/arrow-list.svg" alt="Expand subcategories">
                                        </button>
                                        <ul class="menu-blocks-links-submenu">
                                            <li>
                                                <a href="">Subcategory</a>
                                            </li>
                                            <li>
                                                <a href="">Subcategory</a>
                                            </li>
                                            <li>
                                                <a href="">Subcategory</a>
                                            </li>
                                            <li>
                                                <a href="">Subcategory</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="menu-blocks-link">
                                        <button class="menu-blocks-link-toggle" aria-expanded="false">
                                            <span>Components</span>
                                            <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/arrow-list.svg" alt="Expand subcategories">
                                        </button>
                                        <ul class="menu-blocks-links-submenu">
                                            <li>
                                                <a href="">Subcategory</a>
                                            </li>
                                            <li>
                                                <a href="">Subcategory</a>
                                            </li>
                                            <li>
                                                <a href="">Subcategory</a>
                                            </li>
                                            <li>
                                                <a href="">Subcategory</a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
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