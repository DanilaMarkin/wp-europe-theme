<?php
/* Template Name: Contacts */
europe_get_header();
?>

<main class="page-content-main">
    <section class="container contacts-block">
        <h1 class="page-title"><?= the_title(); ?></h1>
        <div class="page-content contacts-content">
            <section class="contacts-content-social-block">
                <h2 class="contacts-content-social-block-title"><?= esc_html(get_field('contact_heading_1_')) ?: 'Default Heading'; ?></h2>
                <ul class="contacts-content-social-list">
                    <li class="contacts-content-social-list-circle">
                        <p class="contacts-content-social-list-head">
                            <a href="tel:<?= str_replace(" ", "", get_option("contact_info_phone")); ?>"
                                title="Call via Phone, WhatsApp, or Telegram"
                                aria-label="Call via Phone"><?= get_option("contact_info_phone"); ?></a>
                        </p>
                        <p class="contacts-content-social-list-desc"><?= get_option("contact_info_phone_down_descr"); ?></p>
                    </li>
                    <li class="contacts-content-social-list-circle">
                        <p class="contacts-content-social-list-head">
                            <a href="mailto:<?= get_option("contact_info_email"); ?>"
                                title="Send an email to <?= get_option("contact_info_email"); ?>"
                                aria-label="Send an email"><?= get_option("contact_info_email"); ?></a>
                        </p>
                        <p class="contacts-content-social-list-desc"><?= get_option("contact_info_email_down_descr"); ?></p>
                    </li>
                    <li class="contacts-content-social-list-circle">
                        <p class="contacts-content-social-list-head" aria-label="Company Address"><?= get_option("contact_info_address"); ?></p>
                        <address class="contacts-content-social-list-desc" aria-label="Address details"><?= get_option("contact_info_address_down_descr"); ?></address>
                    </li>
                </ul>
            </section>
            <section class="contacts-content-map-block">
                <h2 class="contacts-content-social-block-title"><?= esc_html(get_field('contact_heading_2_')) ?: 'Default Heading'; ?></h2>
                <div class="contacts-content-map" aria-label="Location Map">
                    <?php
                    if (get_field('map_google_src')) { ?>
                        <iframe
                            src="<?= get_field('map_google_src'); ?>"
                            width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade" title="Map of Barcelona" aria-label="Map showing company location">
                        </iframe>
                    <?php } else { ?>
                        <p>There's nothing here yet</p>
                    <?php } ?>
                </div>
            </section>
        </div>
    </section>
</main>

<?php
europe_get_footer();
?>