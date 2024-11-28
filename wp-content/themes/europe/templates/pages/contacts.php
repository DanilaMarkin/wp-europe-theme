<?php
/* Template Name: Contacts */
europe_get_header();
?>

<main class="page-content-main">
    <section class="container contacts-block">
        <h1 class="page-title"><?= the_title(); ?></h1>

        <div class="page-content contacts-content">
            <div class="contacts-content-social-block">
                <h2 class="contacts-content-social-block-title">Contact Information</h2>
                <ul class="contacts-content-social-list">
                    <li class="contacts-content-social-list-circle">
                        <p class="contacts-content-social-list-head">
                            <a href="tel:<?=  str_replace(" ", "", get_option("contact_info_phone"));  ?>" aria-label="Call via Phone, WhatsApp, or Telegram"><?= get_option("contact_info_phone"); ?></a>
                        </p>
                        <p class="contacts-content-social-list-desc"><?= get_option("contact_info_phone_down_descr"); ?></p>
                    </li>
                    <li class="contacts-content-social-list-circle">
                        <p class="contacts-content-social-list-head">
                            <a href="mailto:<?= get_option("contact_info_email"); ?>" aria-label="Send an email to <?= get_option("contact_info_email"); ?>"><?= get_option("contact_info_email"); ?></a>
                        </p>
                        <p class="contacts-content-social-list-desc"><?= get_option("contact_info_email_down_descr"); ?></p>
                    </li>
                    <li class="contacts-content-social-list-circle">
                        <p class="contacts-content-social-list-head"><?= get_option("contact_info_address"); ?></p>
                        <p class="contacts-content-social-list-desc">
                        <address><?= get_option("contact_info_address_down_descr"); ?></address>
                        </p>
                    </li>
                </ul>
            </div>
            <div class="contacts-content-map-block">
                <h2 class="contacts-content-social-block-title">Find Us on the Map</h2>
                <div class="contacts-content-map" aria-label="Location Map">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2990.962999519642!2d2.2377683765449485!3d41.440024492727716!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x12a4bb6a7a8c9a43%3A0x69c114342fab8736!2zQ2FycmVyIGRlIENlcnZhbnRlcywgNjgsIDA4OTEyIEJhZGFsb25hLCBCYXJjZWxvbmEsINCY0YHQv9Cw0L3QuNGP!5e0!3m2!1sru!2sru!4v1732790827270!5m2!1sru!2sru"
                        width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" title="Map of Barcelona"></iframe>
                </div>
            </div>
        </div>
    </section>
</main>

<?php
europe_get_footer();
?>