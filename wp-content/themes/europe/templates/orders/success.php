<?php
/* Template Name: Cart success */
europe_get_header();
?>

<main class="cart-blocks container">
    <h1 class="cart-title"><?= the_title(); ?></h1>
    <?php if (!empty(get_the_content())) { ?>
        <p class="cart-descr"><?= get_the_content(); ?></p>
    <?php } else { ?>
        <p class="cart-descr">There's nothing here yet</p>
    <?php } ?>
    <a href="/" class="cart-back-to-shopping" title="Go back to the homepage"><?= esc_html(get_field("cart_back_to_shopping_")) ?: "Default"; ?></a>
</main>

<?php
europe_get_footer();
?>