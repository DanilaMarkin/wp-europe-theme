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
                        <span id="totalCount" class="total-blocks-finist-item-price">$0.00</span>
                    </li>
                    <!-- <li class="total-blocks-finist-item">
                        <p class="total-blocks-finist-item-value">Shipping</p>
                        <span class="total-blocks-finist-item-price">$0.00</span>
                    </li> -->
                    <li class="total-blocks-finist-item">
                        <p class="total-blocks-finist-item-value">Total</p>
                        <span id="totalPrice" class="total-blocks-finist-item-price">$0.00</span>
                    </li>
                </ul>
            </div>
        </div>
    </section>
</main>

<script>
    const cartData = JSON.parse(localStorage.getItem("cart")) || [];

    function fetchCartDetails(cart) {
        return new Promise((resolve, reject) => {
            jQuery.ajax({
                url: "/wp-admin/admin-ajax.php",
                type: "POST",
                data: {
                    action: "get_cart_details",
                    product_ids: cart.map(item => item.id)
                },
                success: function(response) {
                    if (response.success) {
                        resolve(response.data);
                    } else {
                        reject(response.data);
                    }
                },
                error: function(error) {
                    console.log(error);
                }
            });
        });
    }

    // Функция для изменения общего кол-ва товаров в корзину
    function updateCartQuantity() {
        // Получаем элемент, который отображает количество товаров в корзине
        const totalProductsCount = document.querySelector(".nav-block-cart-count");

        // Получаем данные корзины из localStorage
        let cart = JSON.parse(localStorage.getItem("cart"));

        if (cart && Array.isArray(cart)) {
            const totalCount = cart.reduce((sum, item) => sum + (item.count || 0), 0);
            if (totalProductsCount) {
                totalProductsCount.textContent = totalCount; // Обновляем количество товаров в корзине
            }
        } else {
            // Если корзина пуста
            if (totalProductsCount) {
                totalProductsCount.textContent = 0;
            }
        }
    }

    function saveCartLocalStorage(cartId, count) {
        const cartData = JSON.parse(localStorage.getItem("cart")) || [];

        // Найти товар по cartId
        const productIndex = cartData.findIndex(item => item.id === cartId);

        if (productIndex !== -1) {
            // Обновить только количество
            cartData[productIndex].count = count;
        } else {
            // Добавить новый товар с указанным количеством
            cartData.push({
                id: cartId,
                count
            });
        }

        // Сохранить обновленные данные в localStorage
        localStorage.setItem("cart", JSON.stringify(cartData));
    }

    function displayCartDetails(products) {
        const cartcontainer = document.querySelector("#cartDetails");
        const loader = document.querySelector(".loader-blocks");

        const totalProductsElem = document.querySelector("#totalCount");
        const totalAmountElem = document.querySelector("#totalPrice");

        cartcontainer.innerHTML = "";

        if (loader) {
            loader.classList.add("hidden");
        }

        const cartData = JSON.parse(localStorage.getItem("cart")) || [];

        let totalPrice = 0; // Initialize total price
        let totalCount = 0; // Initialize total product count

        products.forEach(product => {
            const cartItem = cartData.find(item => Number(item.id) === Number(product.id));
            const productCount = cartItem ? cartItem.count : 1;

            totalCount += productCount;
            totalPrice += product.price * productCount;

            const cartItemHTML = `
                <li class="cart-info-block-products-item" data-id="${product.id}">
                    <a href="${product.link}" title="View details for ${product.name}" class="cart-info-block-products-item-img">
                        <img src="${product.image}" title="${product.name}" alt="${product.name} - Buy online">
                    </a>
                    <div class="cart-info-block-products-item-info">
                        <h2 class="cart-info-block-products-item-info-title"><a href="${product.link}" title="More about ${product.name}">${product.name}</a></h2>
                        <div class="cart-info-block-products-total-info">
                            <div class="cart-info-block-products-item-info-count">
                                <button class="cart-minus" aria-label="Decrease quantity">-</button>
                                <span class="cart-count-item">${productCount} pcs</span>
                                <button class="cart-plus" aria-label="Increase quantity">+</button>
                            </div>
                            <p class="cart-info-block-products-item-info-price">$${product.price}</p>
                        </div>
                    </div>
                </li>
            `;
            cartcontainer.innerHTML += cartItemHTML;
        });

        // Update total price and product count in the total section
        if (totalProductsElem) {
            totalProductsElem.textContent = `${totalCount} pcs`; // Update number of products
        }
        if (totalAmountElem) {
            totalAmountElem.textContent = `$${totalPrice.toFixed(2)}`; // Update total price, with 2 decimals
        }

        // update cunt for cart in order
        const plus = document.querySelectorAll(".cart-plus");
        const minus = document.querySelectorAll(".cart-minus");
        const cartCount = document.querySelectorAll(".cart-count-item");
        const cartProduct = document.querySelectorAll(".cart-info-block-products-item");

        plus.forEach((item, index) => {
            item.addEventListener("click", () => {
                const cartId = cartProduct[index].getAttribute("data-id");
                if (cartCount[index]) {
                    let currentCount = parseInt(cartCount[index].textContent, 10) || 0;
                    currentCount += 1
                    cartCount[index].textContent = `${currentCount} pcs`;
                    saveCartLocalStorage(cartId, currentCount); // Передаем обновленный count
                    updateCartQuantity();
                }
            });
        });

        minus.forEach((item, index) => {
            item.addEventListener("click", () => {
                const cartId = cartProduct[index].getAttribute("data-id");
                if (cartCount[index]) {
                    let currentCount = parseInt(cartCount[index].textContent, 10) || 0;
                    currentCount -= 1
                    if (currentCount > 0) {
                        cartCount[index].textContent = `${currentCount} pcs`;
                        saveCartLocalStorage(cartId, currentCount); // Передаем обновленный count
                        updateCartQuantity();
                    }
                }
            });
        })
    }

    updateCartQuantity();

    if (cartData.length > 0) {
        fetchCartDetails(cartData)
            .then(displayCartDetails)
            .catch(error => console.error("Ошибка обработки данных:", error));
    } else {
        const formCart = document.querySelector(".cart-info-blocks-form");
        const totalCart = document.querySelector(".total");
        const headerCartEmpty = document.querySelector(".cart-info-blocks-list-products");

        formCart.classList.add("hidden");
        totalCart.classList.add("hidden");

        headerCartEmpty.innerHTML = `
            <h1 class="cart-title"><?= the_title(); ?></h1>
            <p class="cart-descr">Your cart is empty. Browse our products to find something you’ll love!</p>
            <a href="/" class="cart-back-to-shopping" title="Go back to the homepage">Back to shopping</a>
        `;
    }

    // Валидация полей формы    
    document.getElementById("checkout").addEventListener("click", (event) => {
        event.preventDefault(); // Предотвращаем стандартное поведение 

        const form = document.getElementById("orderForm");

        // Country of delivery
        const country = document.getElementById("country");
        // Contact Information
        const name = document.getElementById("name");
        const phone = document.getElementById("phone");
        const email = document.getElementById("email");

        // Payment Method
        const radioPayments = document.querySelectorAll(".cart-info-blocks-payment-item-value-empty");
        let valuePayment = null;

        // Privacy Policy
        const paymentBlock = document.querySelector(".cart-info-blocks-input-payment-items");
        const labelCheckBox = document.querySelector(".total-checkbox-label");
        const agreeCheckbox = document.getElementById("agreeCheckbox");

        let isValid = true; // Флаг для проверки всех полей

        // Валидация поле "Country"
        if (country.value.trim() === "") {
            country.classList.add("error");
            isValid = false; // Если есть ошибка, флаг становится false
        } else {
            country.classList.remove("error");
        }

        // Валидация поле "Name"
        if (name.value.trim() === "") {
            name.classList.add("error");
            isValid = false; // Если есть ошибка, флаг становится false
        } else {
            name.classList.remove("error");
        }

        // Валидация поле "Phone"
        if (phone.value.trim() === "") {
            phone.classList.add("error");
            isValid = false; // Если есть ошибка, флаг становится false
        } else {
            phone.classList.remove("error");
        }

        // Валидация поле "Почта"
        if (email.value.trim() === "") {
            email.classList.add("error");
            isValid = false; // Если есть ошибка, флаг становится false
        } else {
            email.classList.remove("error");
        }

        // Валидация Payment Method Radio
        radioPayments.forEach(radio => {
            if (!radio.checked) {
                paymentBlock.classList.add("error");
                isValid = false; // Если есть ошибка, флаг становится false
            } else {
                paymentBlock.classList.remove("error");
                valuePayment = radio.value;
            }
        });

        // Валидация Privacy Policy CheckBox
        if (!agreeCheckbox.checked) {
            agreeCheckbox.classList.add("error");
            labelCheckBox.classList.add("error");
            isValid = false; // Если есть ошибка, флаг становится false
        } else {
            agreeCheckbox.classList.remove("error");
            labelCheckBox.classList.remove("error");
        }

        if (isValid) {
            form.submit();
        }
    });
</script>
<?php
europe_get_footer();
?>