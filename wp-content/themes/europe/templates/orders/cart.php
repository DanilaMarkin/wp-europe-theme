<?php
/* Template Name: Cart */
europe_get_header();
?>

<main class="cart-blocks">
    <section class="cart-info-blocks container">
        <div class="cart-info-blocks-list-products">
            <h1 class="cart-title"><?= the_title(); ?></h1>
            <ul class="cart-info-block-products-items">
                <li class="cart-info-block-products-item">
                    <a href="" class="cart-info-block-products-item-img">
                        <img src="https://c.dns-shop.ru/thumb/st1/fit/500/500/cf3df55d0c474b3185c7a4952df8d536/459dea340d091d95f4995d58a54aafe2999b4e0997c531df6cd2a5ed73d12ab1.jpg" alt="">
                    </a>
                    <div class="cart-info-block-products-item-info">
                        <h2 class="cart-info-block-products-item-info-title"><a href="">DELL EMC PowerEdge R740xd (28xSFF) Performance Rack Server with 2x Xeon Gold 6154 18-Core 3.00 GHz, 32 GB DDR4 RAM</a></h2>
                        <div class="cart-info-block-products-total-info">
                            <div class="cart-info-block-products-item-info-count">
                                <button class="cart-minus" aria-label="Decrease quantity">-</button>
                                <span class="cart-count-item">1 pcs</span>
                                <button class="cart-plus" aria-label="Increase quantity">+</button>
                            </div>
                            <p class="cart-info-block-products-item-info-price">$850.00</p>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
        <form class="cart-info-blocks-form">
            <div class="cart-info-blocks-input">
                <p>Country of delivery</p>
                <input type="text" placeholder="Country of Delivery" class="cart-info-blocks-input-general">
            </div>
            <div class="cart-info-blocks-input">
                <p>Contact Information</p>
                <div class="cart-info-block-input-fio">
                    <input type="text" placeholder="Name" class="cart-info-blocks-input-general">
                    <input type="tel" placeholder="Phone" class="cart-info-blocks-input-general">
                    <input type="email" placeholder="E-mail" class="cart-info-blocks-input-general">
                </div>
            </div>
            <div class="cart-info-blocks-input">
                <p>Payment Method</p>

            </div>
        </form>
    </section>
    <section class="total">
        <div class="total-blocks container">
            <div class="total-blocks-checkout">
                <div class="total-checkbox-wrapper">
                    <label class="total-checkbox-label">
                        <input type="checkbox" class="custom-checkbox">
                        <span class="total-check-icon"></span>
                        <div class="total-checkbox-label-text-agree">
                            I have read and agree to the <a href="#" class="total-check-policy"> privacy policy</a>
                        </div>
                    </label>
                </div>
                <div class="total-blocks-btn">
                    <button>Checkout</button>
                    <button>Get an offer</button>
                </div>
            </div>
            <div class="total-blocks-finish">
                <p class="total-blocks-finish-title">Total</p>
                <ul class="total-blocks-finist-items">
                    <li class="total-blocks-finist-item">
                        <p class="total-blocks-finist-item-value">Value of items</p>
                        <span class="total-blocks-finist-item-price">$0.00</span>
                    </li>
                    <li class="total-blocks-finist-item">
                        <p class="total-blocks-finist-item-value">Shipping</p>
                        <span class="total-blocks-finist-item-price">$0.00</span>
                    </li>
                    <li class="total-blocks-finist-item">
                        <p class="total-blocks-finist-item-value">Total</p>
                        <span class="total-blocks-finist-item-price">$0.00</span>
                    </li>
                </ul>
            </div>
        </div>
    </section>
</main>

<?php
europe_get_footer();
?>