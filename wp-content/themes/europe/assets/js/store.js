// Переменные для  видимости блоков "Корзина" и "Количество"
const productsBlocksCardBtnCart = document.querySelectorAll(".products-blocks-card-btn-cart");
const productsBlocksCardBtnCount = document.querySelectorAll(".products-blocks-card-btn-count");
const productsBlocksCardBtnContact = document.querySelectorAll(".products-blocks-card-btn-contact");
// Переменные для обновления общего количества товаров 
const totalProductsCount = document.querySelector(".nav-block-cart-count");
// Получаем дополнительные данные о товаре
const productsBlocksCard = document.querySelectorAll(".products-blocks-id");
const productsBlocksCardPreviewImage = document.querySelectorAll(".products-blocks-card-preview-image");
const productsBlocksCardPreviewTitle = document.querySelectorAll(".products-blocks-card-preview-title");
const productsBlocksCardPreviewPrice = document.querySelectorAll(".products-blocks-card-preview-price");

// Функция для изменения общего кол-ва товаров в корзину
function updateCartQuantity() {
    let totalCount = 0;
    document.querySelectorAll(".count-number").forEach((countNumber) => {
        totalCount += parseInt(countNumber.textContent, 10);
    });
    if (totalProductsCount) {
        totalProductsCount.textContent = totalCount;
    }
}

function saveProductToLocalStorage(productId, count, image, title, price) {
     // Получаем список товаров из localStorage (если он есть)
    let cart = JSON.parse(localStorage.getItem('cart')) || [];

    if (count <= 0) {
        cart = cart.filter(item => item.id !== productId);
    } else {
        // Проверяем, есть ли товар в корзине
        const existingCart = cart.find(item => item.id === productId); 

        if (existingCart) {
            // Если товар уже есть, обновляем его количество
            existingCart.count = count;
        } else {
            // Если товара нет, добавляем новый
            cart.push({
                id: productId,
                count: count,
                image: image,
                title: title,
                price: price,
            });
        }
    }

    localStorage.setItem('cart', JSON.stringify(cart));
}

// Функция для добавления товара в корзину (например, с использованием ID товара)
function addProductToCart(productId, count, image, title, price) {
    // Проверяем, если количество товара больше нуля, сохраняем в localStorage
    if (count >= 0) {
        saveProductToLocalStorage(productId, count, image, title, price);
    }
}

// Переключение видимости блоков "Корзина" и "Количество"
productsBlocksCardBtnCart.forEach((key, value) => {
    key.addEventListener("click", () => {
        productsBlocksCardBtnContact[value].classList.toggle("hidden");
        productsBlocksCardBtnCount[value].classList.toggle("open");
    });
});

// Логика для изменения количества товара
productsBlocksCardBtnCount.forEach((countBlock, index) => {
    const productMinus = countBlock.querySelector(".count-btn.minus");
    const spanCountNumber = countBlock.querySelector(".count-number");
    const productPlus = countBlock.querySelector(".count-btn.plus");

    let countNumber = parseInt(spanCountNumber.textContent, 10);
    
    // Получаем информацию о товаре
    const productId = productsBlocksCard[index].getAttribute("data-id");

    const image = productsBlocksCardPreviewImage[index].src;  // Получаем URL изображения
    const title = productsBlocksCardPreviewTitle[index].textContent;  // Получаем название товара
    const price = parseFloat(productsBlocksCardPreviewPrice[index].textContent.replace(/[^0-9.-]+/g, ""));  // Получаем цену товара

    // Уменьшение количества
    productMinus.addEventListener("click", () => {
        if (countNumber > 0) {
            countNumber -= 1;
            spanCountNumber.textContent = countNumber;
            updateCartQuantity();
            addProductToCart(productId, countNumber, image, title, price);
        }
    });

    // Увеличение количества
    productPlus.addEventListener("click", () => {
        countNumber += 1;
        spanCountNumber.textContent = countNumber;
        updateCartQuantity();
        addProductToCart(productId, countNumber, image, title, price);
    });
});

// Инициализация общего количества при загрузке страницы
updateCartQuantity();