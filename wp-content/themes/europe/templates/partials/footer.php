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
                    <a href="https://t.me/<?php echo esc_attr($phone_number); ?>"
                        target="_blank"
                        rel="noopener noreferrer"
                        title="Contact us on Telegram via <?php echo esc_attr($phone_number); ?>"
                        aria-label="Contact us on Telegram">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/telegram_footer.svg"
                            alt="Telegram icon to contact us">
                    </a>
                </li>
                <li>
                    <a href="https://wa.me/<?php echo esc_attr($phone_number); ?>"
                        target="_blank"
                        rel="noopener noreferrer"
                        title="Message us on WhatsApp via <?php echo esc_attr($phone_number); ?>"
                        aria-label="Message us on WhatsApp">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/whatsapp.svg"
                            alt="WhatsApp icon to message us">
                    </a>
                </li>
                <li>
                    <a href="tel:<?php echo esc_attr($phone_number); ?>"
                        title="Call us at <?php echo esc_attr($phone_number); ?>"
                        aria-label="Call us at <?php echo esc_attr($phone_number); ?>">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/phone_footer.svg"
                            alt="Phone icon to call us">
                    </a>
                </li>
                <li>
                    <a href="mailto:<?php echo esc_attr($global_settings['email']); ?>"
                        target="_blank"
                        rel="noopener noreferrer"
                        title="Email us at <?php echo esc_attr($global_settings['email']); ?>"
                        aria-label="Email us at <?php echo esc_attr($global_settings['email']); ?>">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/mail.svg"
                            alt="Email icon to contact us">
                    </a>
                </li>
            </ul>
        </div>
        <div class="footer-blocks-contacts">
            <ul class="footer-blocks-contacts-list">
                <li>
                    <a href="tel:<?php echo esc_attr($phone_number); ?>" target="_blank" rel="noopener noreferrer" title="Call us at <?php echo esc_attr($global_settings['phone']); ?>" aria-label="Call us at <?php echo esc_attr($global_settings['phone']); ?>">
                        <?php echo esc_html($global_settings['phone']); ?>
                    </a>
                    <span aria-label="Phone description"><?php echo esc_html($global_settings['phone_desc']); ?></span>
                </li>
                <li>
                    <a href="mailto:<?php echo esc_attr($global_settings['email']); ?>" target="_blank" rel="noopener noreferrer" title="Email us at <?php echo esc_attr($global_settings['email']); ?>" aria-label="Email us at <?php echo esc_attr($global_settings['email']); ?>">
                        <?php echo esc_html($global_settings['email']); ?>
                    </a>
                    <span aria-label="Email description"><?php echo esc_html($global_settings['email_desc']); ?></span>
                </li>
                <li>
                    <p aria-label="Company Address">
                        <?php echo esc_html($global_settings['address']); ?>
                    </p>
                    <span aria-label="Address description"><?php echo esc_html($global_settings['address_desc']); ?></span>
                </li>
            </ul>
        </div>
    </nav>
    <div class="bottom-tab-bar">
        <ul class="bottom-tab-bar-lists">
            <li class="bottom-tab-bar-list">
                <a href="/" class="bottom-tab-bar-list-action" title="Go to Home Page" aria-label="Home Page">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/home.svg" alt="Home Icon" class="bottom-tab-bar-list-action-img">
                    <span class="bottom-tab-bar-list-action-title">Home</span>
                </a>
            </li>
            <li class="bottom-tab-bar-list">
                <button class="bottom-tab-bar-list-action bottom-tab-bar-list-action-catalog" title="View Catalog" aria-label="Catalog">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/catalog.svg" alt="Catalog Icon" class="bottom-tab-bar-list-action-img">
                    <span class="bottom-tab-bar-list-action-title">Catalog</span>
                </button>
            </li>
            <li class="bottom-tab-bar-list">
                <button class="bottom-tab-bar-list-action" title="Open Assistant" aria-label="Assistant">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/assistant.svg" alt="Assistant Icon" class="bottom-tab-bar-list-action-img">
                    <span class="bottom-tab-bar-list-action-title">Assistant</span>
                </button>
            </li>
            <li class="bottom-tab-bar-list">
                <button class="bottom-tab-bar-list-action bottom-tab-bar-list-action-contacts" title="Open Contacts" aria-label="Contacts">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/contacts-people.svg" alt="Contacts Icon" class="bottom-tab-bar-list-action-img">
                    <span class="bottom-tab-bar-list-action-title">Contacts</span>
                </button>
                <ul class="bottom-tab-bar-list-contacts">
                    <li>
                        <a href="https://t.me/<?php echo esc_attr($phone_number); ?>"
                            target="_blank"
                            rel="noopener noreferrer"
                            title="Contact us on Telegram via <?php echo esc_attr($phone_number); ?>"
                            aria-label="Contact us on Telegram">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/telegram_footer.svg"
                                alt="Telegram icon to contact us">
                        </a>
                    </li>
                    <li>
                        <a href="https://wa.me/<?php echo esc_attr($phone_number); ?>"
                            target="_blank"
                            rel="noopener noreferrer"
                            title="Message us on WhatsApp via <?php echo esc_attr($phone_number); ?>"
                            aria-label="Message us on WhatsApp">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/whatsapp.svg"
                                alt="WhatsApp icon to message us">
                        </a>
                    </li>
                    <li>
                        <a href="tel:<?php echo esc_attr($phone_number); ?>"
                            title="Call us at <?php echo esc_attr($phone_number); ?>"
                            aria-label="Call us at <?php echo esc_attr($phone_number); ?>">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/phone_footer.svg"
                                alt="Phone icon to call us">
                        </a>
                    </li>
                    <li>
                        <a href="mailto:<?php echo esc_attr($global_settings['email']); ?>"
                            target="_blank"
                            rel="noopener noreferrer"
                            title="Email us at <?php echo esc_attr($global_settings['email']); ?>"
                            aria-label="Email us at <?php echo esc_attr($global_settings['email']); ?>">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/mail.svg"
                                alt="Email icon to contact us">
                        </a>
                    </li>
                </ul>
            </li>
            <li class="bottom-tab-bar-list">
                <button class="bottom-tab-bar-list-action bottom-tab-bar-list-action-more" title="View More Options" aria-label="More">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/more.svg" alt="More Options Icon" class="bottom-tab-bar-list-action-img">
                    <span class="bottom-tab-bar-list-action-title">More</span>
                </button>
            </li>
        </ul>
    </div>
</footer>
<?php wp_footer(); ?>
</body>

</html>