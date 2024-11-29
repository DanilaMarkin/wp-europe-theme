<?php
// Global data all site
$global_settings = get_global_settings(190);

// Убираем пробелы из номера телефона
$phone_number = preg_replace('/\s+/', '', $global_settings['phone']);
?>
<footer>
    <nav class="footer-blocks container">
        <div class="footer-blocks-social">
            <ul class="footer-social-block-list">
                <li>
                    <a href="" title="Telegram">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/telegram_footer.svg" alt="Telegram icon">
                    </a>
                </li>
                <li>
                    <a href="" title="WhatsApp">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/whatsapp.svg" alt="WhatsApp icon">
                    </a>
                </li>
                <li>
                    <a href="" title="Call us">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/phone_footer.svg" alt="Phone icon">
                    </a>
                </li>
                <li>
                    <a href="" title="Send an email">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/mail.svg" alt="Mail icon">
                    </a>
                </li>
            </ul>
        </div>
        <div class="footer-blocks-general-pages">
            <ul class="footer-blocks-general-pages-list">
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
        </div>
        <div class="footer-blocks-categorys">
            <div class="footer-blocks-category">
                <div class="footer-blocks-category-general">
                    <p>Server Equipment</p>
                    <ul class="footer-blocks-category-list footer-blocks-category-left-list">
                        <li>
                            <a href="">Subcategory 1</a>
                        </li>
                        <li>
                            <a href="">Subcategory 2</a>
                        </li>
                        <li>
                            <a href="">Subcategory 3</a>
                        </li>
                        <li>
                            <a href="">Subcategory 4</a>
                        </li>
                    </ul>
                </div>
                <div class="footer-blocks-category-general">
                    <p>Storage</p>
                    <ul class="footer-blocks-category-list footer-blocks-category-right-list">
                        <li>
                            <a href="">Subcategory 1</a>
                        </li>
                        <li>
                            <a href="">Subcategory 2</a>
                        </li>
                        <li>
                            <a href="">Subcategory 3</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="footer-blocks-category">
                <div class="footer-blocks-category-general">
                    <p>Computers and Laptops</p>
                    <ul class="footer-blocks-category-list footer-blocks-category-left-list">
                        <li>
                            <a href="">Subcategory 1</a>
                        </li>
                    </ul>
                </div>
                <div class="footer-blocks-category-general">
                    <p>Workstations</p>
                    <ul class="footer-blocks-category-list footer-blocks-category-right-list">
                        <li>
                            <a href="">Subcategory 1</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="footer-blocks-contacts">
            <ul class="footer-blocks-contacts-list">
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
        </div>
    </nav>
    <div class="bottom-tab-bar">
        <ul class="bottom-tab-bar-lists">
            <li class="bottom-tab-bar-list">
                <a href="/" class="bottom-tab-bar-list-action">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/home.svg" alt="" class="bottom-tab-bar-list-action-img">
                    <span class="bottom-tab-bar-list-action-title">Home</span>
                </a>
            </li>
            <li class="bottom-tab-bar-list">
                <button href="/" class="bottom-tab-bar-list-action bottom-tab-bar-list-action-catalog">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/catalog.svg" alt="" class="bottom-tab-bar-list-action-img">
                    <span class="bottom-tab-bar-list-action-title">Catalog</span>
                </button>
            </li>
            <li class="bottom-tab-bar-list">
                <button href="/" class="bottom-tab-bar-list-action">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/assistant.svg" alt="" class="bottom-tab-bar-list-action-img">
                    <span class="bottom-tab-bar-list-action-title">Assistant</span>
                </button>
            </li>
            <li class="bottom-tab-bar-list">
                <button href="/" class="bottom-tab-bar-list-action bottom-tab-bar-list-action-contacts">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/contacts-people.svg" alt="" class="bottom-tab-bar-list-action-img">
                    <span class="bottom-tab-bar-list-action-title">Contacts</span>
                </button>
                <ul class="bottom-tab-bar-list-contacts">
                    <li>
                        <a href="">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/telegram_footer.svg" alt="">
                        </a>
                    </li>
                    <li>
                        <a href="">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/whatsapp.svg" alt="">
                        </a>
                    </li>
                    <li>
                        <a href="">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/phone.svg" alt="">
                        </a>
                    </li>
                    <li>
                        <a href="">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/mail.svg" alt="">
                        </a>
                    </li>
                </ul>
            </li>
            <li class="bottom-tab-bar-list">
                <button href="/" class="bottom-tab-bar-list-action bottom-tab-bar-list-action-more">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/more.svg" alt="" class="bottom-tab-bar-list-action-img">
                    <span class="bottom-tab-bar-list-action-title">More</span>
                </button>
            </li>
        </ul>
    </div>
</footer>
<?php wp_footer(); ?>
</body>

</html>