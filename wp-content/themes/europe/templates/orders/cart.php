<?php
/* Template Name: Cart */
europe_get_header();
?>

<main class="cart-blocks">
    <section class="cart-info-blocks container">
        <div class="cart-info-blocks-list-products">
            <h1 class="cart-title"><?= the_title(); ?></h1>
            <ul id="cartDetails" class="cart-info-block-products-items">
                <!-- products.data -->
            </ul>
            <div class="loader-blocks">
                <span class="loader"></span>
            </div>
        </div>
        <form id="orderForm" class="cart-info-blocks-form">
            <div class="cart-info-blocks-input">
                <p>Country of delivery</p>
                <input id="country" type="text" placeholder="Country of Delivery" class="cart-info-blocks-input-general">
            </div>
            <div class="cart-info-blocks-input">
                <p>Contact Information</p>
                <div class="cart-info-block-input-fio">
                    <input id="name" type="text" placeholder="Name" class="cart-info-blocks-input-general">
                    <input id="phone" type="tel" placeholder="Phone" class="cart-info-blocks-input-general">
                    <input id="email" type="email" placeholder="E-mail" class="cart-info-blocks-input-general">
                </div>
            </div>
            <div class="cart-info-blocks-input">
                <p>Payment Method</p>
                <ul class="cart-info-blocks-input-payment-items">
                    <li>
                        <label class="cart-info-blocks-payment-item-value">
                            <p>Cash on Delivery</p>
                            <input type="radio" name="paymentMethod" value="Cash on Delivery" class="cart-info-blocks-payment-item-value-empty">
                            <span class="cart-info-blocks-payment-item-custom-checkbox"></span>
                        </label>
                    </li>
                    <li>
                        <label class="cart-info-blocks-payment-item-value">
                            <p>Visa/MasterCard</p>
                            <input type="radio" name="paymentMethod" value="Visa/MasterCard" class="cart-info-blocks-payment-item-value-empty">
                            <span class="cart-info-blocks-payment-item-custom-checkbox"></span>
                        </label>
                    </li>
                    <li>
                        <label class="cart-info-blocks-payment-item-value">
                            <p>PayPal</p>
                            <input type="radio" name="paymentMethod" value="PayPal" class="cart-info-blocks-payment-item-value-empty">
                            <span class="cart-info-blocks-payment-item-custom-checkbox"></span>
                        </label>
                    </li>
                    <li>
                        <label class="cart-info-blocks-payment-item-value">
                            <p>Bank Transfer</p>
                            <input type="radio" name="paymentMethod" value="Bank Transfer" class="cart-info-blocks-payment-item-value-empty">
                            <span class="cart-info-blocks-payment-item-custom-checkbox"></span>
                        </label>
                    </li>
                </ul>
            </div>
        </form>
    </section>
    <section class="total">
        <div class="total-blocks container">
            <div class="total-blocks-checkout">
                <div class="total-checkbox-wrapper">
                    <label class="total-checkbox-label">
                        <input id="agreeCheckbox" type="checkbox" class="custom-checkbox">
                        <span class="total-check-icon"></span>
                        <div class="total-checkbox-label-text-agree">
                            I have read and agree to the <a href="#" class="total-check-policy"> privacy policy</a>
                        </div>
                    </label>
                </div>
                <div class="total-blocks-btn">
                    <button id="checkout">Checkout</button>
                    <button>Get an offer</button>
                </div>
            </div>
            <div class="total-blocks-finish">
                <p class="total-blocks-finish-title">Total</p>
                <ul class="total-blocks-finist-items">
                    <li class="total-blocks-finist-item">
                        <p class="total-blocks-finist-item-value">Number of products
                        </p>
                        <span id="totalCount" class="total-blocks-finist-item-price">0</span>
                    </li>
                    <li class="total-blocks-finist-item">
                        <p class="total-blocks-finist-item-value">Total</p>
                        <span id="totalPrice" class="total-blocks-finist-item-price">€0</span>
                    </li>
                </ul>
            </div>
        </div>
    </section>
</main>

<?php
europe_get_footer();
?>