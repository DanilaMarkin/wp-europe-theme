const cartData = JSON.parse(localStorage.getItem("cart")) || [];

function fetchCartDetails(cart) {
  return new Promise((resolve, reject) => {
    jQuery.ajax({
      url: "/wp-admin/admin-ajax.php",
      type: "POST",
      data: {
        action: "get_cart_details",
        product_ids: cart.map((item) => item.id),
      },
      success: function (response) {
        if (response.success) {
          resolve(response.data);
        } else {
          reject(response.data);
        }
      },
      error: function (error) {
        console.log(error);
      },
    });
  });
}

// Фунция обновления конечной суммы и кол-ва
function updateTotalCart() {
  const cartItems = document.querySelectorAll(".cart-info-block-products-item"); // Каждый товар в корзине

  // Переменные для хранениц цены и кол-ва
  let totalCount = 0;
  let totalSum = 0;

  // Подсчет общего количества товаров и цены
  cartItems.forEach((item) => {
    const countElem = item.querySelector(".cart-count-item"); // Количество для товара
    const priceElem = item.querySelector(
      ".cart-info-block-products-item-info-price"
    ); // Цена для товара

    if (countElem && priceElem) {
      // Извлекаем количество и цену
      const count = parseInt(
        countElem.textContent.replace("pcs", "").trim(),
        10
      );
      const price = parseFloat(priceElem.textContent.replace("$", "").trim());

      if (!isNaN(count) && !isNaN(price)) {
        totalCount += count; // Суммируем количество
        totalSum += count * price; // Умножаем количество на цену и добавляем к общей сумме
      }
    }
  });

  // Находим элементы для отображения общих значений
  const totalProductsElem = document.querySelector("#totalCount");
  const totalAmountElem = document.querySelector("#totalPrice");

  // Обновляем текст в элементах
  if (totalProductsElem) {
    totalProductsElem.textContent = `${totalCount} pcs`;
  }
  if (totalAmountElem) {
    totalAmountElem.textContent = `$${totalSum.toFixed(0)}`;
  }
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

// Если корзина пуста вызывать фунцию
function emptyCart() {
  const cart = JSON.parse(localStorage.getItem("cart")) || [];

  // Если товаров в корзине 0 то изменять DOM
  if (cart.length === 0) {
    const formCart = document.querySelector(".cart-info-blocks-form");
    const totalCart = document.querySelector(".total");
    const headerCartEmpty = document.querySelector(
      ".cart-info-blocks-list-products"
    );

    formCart.classList.add("hidden");
    totalCart.classList.add("hidden");
    headerCartEmpty.innerHTML = `
            <h1 class="cart-title">Shopping Cart</h1>
            <p class="cart-descr">Your cart is empty. Browse our products to find something you’ll love!</p>
            <a href="/" class="cart-back-to-shopping" title="Go back to the homepage">Back to shopping</a>
        `;
  }
}

// Функция для обновления массива в локальном хранилище
function removeFromCartLocalStorage(cartId) {
  const cart = JSON.parse(localStorage.getItem("cart")) || [];
  const updatedCart = cart.filter((item) => item.id !== cartId); // Удаляем объект с указанным id
  localStorage.setItem("cart", JSON.stringify(updatedCart)); // Сохраняем обновленный массив
}

function saveCartLocalStorage(cartId, count) {
  const cartData = JSON.parse(localStorage.getItem("cart")) || [];

  // Найти товар по cartId
  const productIndex = cartData.findIndex((item) => item.id === cartId);

  if (productIndex !== -1) {
    // Обновить только количество
    cartData[productIndex].count = count;
  } else {
    // Добавить новый товар с указанным количеством
    cartData.push({
      id: cartId,
      count,
    });
  }

  // Сохранить обновленные данные в localStorage
  localStorage.setItem("cart", JSON.stringify(cartData));
}

function displayCartDetails(products) {
  const cartcontainer = document.querySelector("#cartDetails");
  const loader = document.querySelector(".loader-blocks");

  cartcontainer.innerHTML = "";

  if (loader) {
    loader.classList.add("hidden");
  }

  const cartData = JSON.parse(localStorage.getItem("cart")) || [];

  products.forEach((product) => {
    const cartItem = cartData.find(
      (item) => Number(item.id) === Number(product.id)
    );
    const productCount = cartItem ? cartItem.count : 1;
    
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
                            <p class="cart-info-block-products-item-info-price">€${product.price}</p>
                        </div>
                    </div>
                </li>
            `;
    cartcontainer.innerHTML += cartItemHTML;
  });

  // update cunt for cart in order
  const plus = document.querySelectorAll(".cart-plus");
  const minus = document.querySelectorAll(".cart-minus");
  const cartCount = document.querySelectorAll(".cart-count-item");
  const cartProduct = document.querySelectorAll(
    ".cart-info-block-products-item"
  );

  plus.forEach((item, index) => {
    item.addEventListener("click", () => {
      const cartId = cartProduct[index].getAttribute("data-id");
      if (cartCount[index]) {
        let currentCount = parseInt(cartCount[index].textContent, 10) || 0;
        currentCount += 1;
        cartCount[index].textContent = `${currentCount} pcs`;
        saveCartLocalStorage(cartId, currentCount); // Передаем обновленный count
        updateCartQuantity();
        updateTotalCart();
      }
    });
  });

  minus.forEach((item, index) => {
    item.addEventListener("click", () => {
      const cartId = cartProduct[index].getAttribute("data-id");
      if (cartCount[index]) {
        let currentCount = parseInt(cartCount[index].textContent, 10) || 0;
        currentCount -= 1;

        if (currentCount > 0) {
          cartCount[index].textContent = `${currentCount} pcs`;
          saveCartLocalStorage(cartId, currentCount); // Сохраняем обновленный count
        } else {
          // Если меньше 1, удаляем товар
          cartProduct[index].remove(); // Удаляем товар из DOM
          removeFromCartLocalStorage(cartId); // Удаляем товар из локального хранилища
        }
        emptyCart();
        updateCartQuantity();
        updateTotalCart();
      }
    });
  });
  updateTotalCart(); // Иницализация функции после загрузки товаров
}

if (cartData.length > 0) {
  fetchCartDetails(cartData)
    .then(displayCartDetails)
    .catch((error) => console.error("Ошибка обработки данных:", error));
} else {
  emptyCart();
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
  const radioPayments = document.querySelectorAll(
    ".cart-info-blocks-payment-item-value-empty"
  );
  let valuePayment = null;

  // Privacy Policy
  const paymentBlock = document.querySelector(
    ".cart-info-blocks-input-payment-items"
  );
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
  let isPaymentSelected = false; // Флаг, выбран ли метод оплаты

  radioPayments.forEach((radio) => {
    if (radio.checked) {
      isPaymentSelected = true; // Если хотя бы один выбран, выставляем флаг
      valuePayment = radio.value; // Сохраняем выбранное значение
    }
  });

  if (!isPaymentSelected) {
    paymentBlock.classList.add("error");
    isValid = false; // Если ни один не выбран, валидация провалена
  } else {
    paymentBlock.classList.remove("error"); // Убираем ошибку, если выбор есть
  }

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
    const cartItems = [];

    document
      .querySelectorAll(".cart-info-block-products-item")
      .forEach((item) => {
        const productId = item.getAttribute("data-id");
        const productName = item.querySelector(
          ".cart-info-block-products-item-info-title>a"
        ).textContent;
        const productQuantity = parseInt(
          item.querySelector(".cart-count-item").textContent.replace("pcs", ""),
          10
        );
        const productPrice = parseFloat(
          item
            .querySelector(".cart-info-block-products-item-info-price")
            .textContent.replace("$", "")
        );

        cartItems.push({
          id: productId,
          name: productName,
          quantity: productQuantity,
          price: productPrice,
        });
      });

    // Отправляем данные через AJAX
    jQuery.ajax({
      url: ajaxObject.ajaxurl, // Это будет "/wp-admin/admin-ajax.php"
      type: "POST",
      data: {
        action: "send_cart_to_woocommerce",
        cart: cartItems, // Массив товаров
        contactInfo: {
          country: country.value.trim(),
          name: name.value.trim(),
          phone: phone.value.trim(),
          email: email.value.trim(),
          paymentMethod: valuePayment,
        },
      },
      success: function (response) {
        
        if (response.success) {
          // Очистка корзины в локальном хранилище или сессии
          localStorage.removeItem("cart"); // Если корзина хранится в localStorage
          sessionStorage.removeItem("cart"); // Если корзина хранится в sessionStorage

          // Проверяем, существует ли redirect_url
          if (response.data.redirect_url) {
            console.log("Redirect URL:", response.data.redirect_url); // Логируем URL
            window.location.href = response.data.redirect_url; // Редирект на переданный URL
          } else {
            console.error("Redirect URL не найден в ответе");
          }
        } else {
          console.error("Ошибка:", response.data.message);
        }
      },
      error: function (error) {
        console.error("Error:", error);
      },
    });
  }
});
