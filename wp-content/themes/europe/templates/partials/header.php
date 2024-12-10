<?php
// Global data all site
$global_settings = get_global_settings(190);

$phone_number = preg_replace('/\s+/', '', $global_settings['phone']);
?>
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
        <div class="header-general">
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
                                <?php
                                wp_nav_menu(array(
                                    'theme_location' => "nav-general-pages",
                                    'container' => false,
                                    'menu_class' => 'header-block-main-general-list',
                                    'items_wrap' => '%3$s',
                                    'walker' => new Custom_Walker_Nav_Menu_Pages(),
                                    'depth' => 1,
                                ));
                                ?>
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
                        <div class="nav-block-cart">
                            <a href="<?= get_permalink(258); ?>" title="Go to cart" class="nav-block-cart-link">
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/cart.svg" alt="Cart icon" class="nav-block-cart-img">
                            </a>
                            <span class="nav-block-cart-count">0</span>
                        </div>
                    </div>
                </div>
            </nav>
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
                    <?php
                    wp_nav_menu(array(
                        'theme_location' => "nav-general-pages",
                        'container' => false,
                        'menu_class' => 'header-block-main-general-list',
                        'items_wrap' => '%3$s',
                        'walker' => new Custom_Walker_Nav_Menu_Pages(),
                        'depth' => 1,
                    ));
                    ?>
                </ul>
                <ul class="menu-blocks-contact">
                    <li>
                        <a href="tel:<?php echo esc_attr($phone_number); ?>" title="Call us at <?php echo esc_attr($global_settings['phone']); ?>" aria-label="Phone number">
                            <?php echo esc_html($global_settings['phone']); ?>
                        </a>
                        <span><?php echo esc_html($global_settings['phone_desc']); ?></span>
                    </li>
                    <li>
                        <a href="mailto:<?php echo esc_attr($global_settings['email']); ?>" title="Email us at <?php echo esc_attr($global_settings['email']); ?>" aria-label="Email address">
                            <?php echo esc_html($global_settings['email']); ?>
                        </a>
                        <span><?php echo esc_html($global_settings['email_desc']); ?></span>
                    </li>
                    <li>
                        <p aria-label="Company Address">
                            <?php echo esc_html($global_settings['address']); ?>
                        </p>
                        <span><?php echo esc_html($global_settings['address_desc']); ?></span>
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
                    <p class="search-popup-block-results-header-empty hidden">No results were found for your request</p>
                    <p class="search-popup-block-results-header hidden">
                        Based on your request we found <span class="search-popup-block-results-header-count-offers">17 offers</span></p>
                    <ul class="search-popup-block-results-products products-blocks-cards ">
                    </ul>
                    <button class="search-popup-block-results-view-all hidden">View All</button>
                </div>
            </div>
        </aside>

    </header>

    <?php custom_breadcrumbs(); ?>