// Инициализация обработчиков событий на кнопках товара
function initializeProductEvents() {
  // Переменные для  видимости блоков "Корзина" и "Количество"
  const productsBlocksCardBtnCart = document.querySelectorAll(
    ".products-blocks-card-btn-cart"
  );
  const productsBlocksCardBtnCount = document.querySelectorAll(
    ".products-blocks-card-btn-count"
  );
  const productsBlocksCardBtnContact = document.querySelectorAll(
    ".products-blocks-card-btn-contact"
  );
  // Получаем дополнительные данные о товаре
  const productsBlocksCard = document.querySelectorAll(".products-blocks-id");
  const productsBlocksCardPreviewPrice = document.querySelectorAll(
    ".products-blocks-card-preview-price"
  );
  // toogle menu click in btn Contact Us
  const productsBlocksCardBtnContactFull = document.querySelectorAll(
    ".products-blocks-card-btn-contact-full"
  );

  // Переключение видимости блоков "Корзина" и "Количество"
  productsBlocksCardBtnCart.forEach((key, value) => {
    const productId = productsBlocksCard[value].getAttribute("data-id"); // Получаем текущий элемент товара
    const spanCountExisting = document.querySelectorAll(".count-number"); // Для вставки акутального кол-ва товаров
    let countNumber = 1; // Начальное значение количества

    // Функция для обновления отображения товара
    const updateProductDisplay = () => {
      let cart = JSON.parse(localStorage.getItem("cart")) || [];
      const existingCartinPage = cart.find((item) => item.id === productId);

      if (existingCartinPage) {
        // Если товар уже в корзине, показываем блок "Количество" и скрываем "Корзина"
        productsBlocksCardBtnContact[value].classList.add("hidden");
        productsBlocksCardBtnCount[value].classList.add("open");
        spanCountExisting[value].textContent = existingCartinPage.count;
      } else {
        spanCountExisting[value].textContent = countNumber;
      }
    };

    // Переменные для поиска цены и управление модальным окном
    const notificationEmpty = document.querySelector(".notification-empty"); // Модальное окно об отсутсвие цены у товара
    const notificationClose = document.querySelector(
      ".notification-empty-close"
    ); // Закрытие модального окна

    const priceText = productsBlocksCardPreviewPrice[value].textContent.trim(); // Получаем текст
    const price = parseFloat(priceText.replace(/[^0-9.]/g, "")); // Убираем все символы, кроме цифр и точки

    key.addEventListener("click", () => {
      // Если цена есть, выполнять код ниже
      if (!isNaN(price)) {
        let cart = JSON.parse(localStorage.getItem("cart")) || [];
        const existingCartinPage = cart.find((item) => item.id === productId);
        const currentCount =
          parseInt(spanCountExisting[value].textContent) || 0;
        // Переключение видимости при клике
        productsBlocksCardBtnContact[value].classList.toggle("hidden");
        productsBlocksCardBtnCount[value].classList.toggle("open");

        if (!existingCartinPage && currentCount >= 1) {
          // Добавляем в корзину и обновляем её
          addProductToCart(productId, countNumber);
          updateCartQuantity();
        }

        if (
          productsBlocksCardBtnContactFull[value].classList.contains("open") &&
          !productsBlocksCardBtnContact[value].classList.contains("hidden")
        ) {
          productsBlocksCardBtnContactFull[value].classList.remove("open");
          productsBlocksCardBtnContact[value].classList.add("hidden");
        }
        // Если нет цены, то выводить модальное окно и удалять через 5 сикунд
      } else {
        // Проверка наличие на модальное окно
        if (notificationEmpty) {
          notificationEmpty.classList.add("open");
          setTimeout(() => {
            notificationEmpty.classList.remove("open");
          }, 5000);

          // Обработчик на закрытие модального окна
          notificationClose.addEventListener("click", () => {
            notificationEmpty.classList.remove("open");
          });
        }
      }
    });

    updateProductDisplay(); // Первичная установка отображения
  });

  // Открытие блока "Контакты"
  productsBlocksCardBtnContact.forEach((key, value) => {
    key.addEventListener("click", () => {
      productsBlocksCardBtnContactFull[value].classList.toggle("open");
      productsBlocksCardBtnContact[value].classList.toggle("hidden");
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

    // Уменьшение количества
    productMinus.addEventListener("click", () => {
      if (countNumber > 0) {
        countNumber -= 1;
        spanCountNumber.textContent = countNumber;
        addProductToCart(productId, countNumber);
        updateCartQuantity();
      }
    });

    // Увеличение количества
    productPlus.addEventListener("click", () => {
      countNumber += 1;
      spanCountNumber.textContent = countNumber;
      addProductToCart(productId, countNumber);
      updateCartQuantity();
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

function saveProductToLocalStorage(productId, count) {
  // Получаем список товаров из localStorage (если он есть)
  let cart = JSON.parse(localStorage.getItem("cart")) || [];

  if (count <= 0) {
    cart = cart.filter((item) => item.id !== productId);
  } else {
    // Проверяем, есть ли товар в корзине
    const existingCart = cart.find((item) => item.id === productId);

    if (existingCart) {
      // Если товар уже есть, обновляем его количество
      existingCart.count = count;
    } else {
      // Если товара нет, добавляем новый
      cart.push({
        id: productId,
        count: count,
      });
    }
  }

  localStorage.setItem("cart", JSON.stringify(cart));
}

// Функция для добавления товара в корзину (например, с использованием ID товара)
function addProductToCart(productId, count) {
  // Проверяем, если количество товара больше нуля, сохраняем в localStorage
  if (count >= 0) {
    saveProductToLocalStorage(productId, count);
  }
}

// fillter in pc open/close sub info and functional "Hide all" button
const categoryToogle = document.querySelectorAll(
  ".category-block-filter-list-head"
);
const categorySub = document.querySelectorAll(
  ".category-block-filter-list-full"
);

const screenWidth = window.innerWidth;

if (screenWidth > 768) {
  const hideAll = document.querySelector(".category-block-filter-hide");
  if (hideAll) {
    hideAll.addEventListener("click", () => {
      categoryToogle.forEach((item) => {
        item.classList.remove("open");
      });

      categorySub.forEach((item) => {
        item.classList.remove("open");
      });
    });
  }
}

categoryToogle.forEach((index, item) => {
  index.addEventListener("click", () => {
    categoryToogle[item].classList.toggle("open");
    categorySub[item].classList.toggle("open");
  });
});

// open in mobile Filter popup
const filterBtnMob = document.querySelector(".filter-btn-mob");
const categoryModale = document.querySelector(".category-block-filter");
const categoryModaleClose = document.querySelector(
  ".category-block-filter-mob-close-action"
);

if (filterBtnMob) {
  filterBtnMob.addEventListener("click", () => {
    categoryModale.classList.add("open");
  });
}
if (categoryModaleClose) {
  categoryModaleClose.addEventListener("click", () => {
    categoryModale.classList.remove("open");
  });
}

// open/close sort in mobile
const filterBtn = document.querySelector(".filter-sort-btn-mob");
const filterList = document.querySelector(".filter-sort-lists");

if (filterBtn && filterList) {
  filterBtn.addEventListener("click", () => {
    filterList.classList.toggle("open");
  });

  document.addEventListener("click", (event) => {
    if (
      !filterList.contains(event.target) &&
      !filterBtn.contains(event.target)
    ) {
      filterList.classList.remove("open");
    }
  });
}

// Инициализация обработчиков кликов на элементы сортировки
const filterSortItems = document.querySelectorAll(".filter-sort-list");
if (filterSortItems.length > 0) {
  filterSortItems.forEach((item) => {
    item.addEventListener("click", (e) => {
      filterSortItems.forEach((item) => item.classList.remove("active"));
      item.classList.add("active");
      const sortType = item.getAttribute("data-sort");
      const sortText = item.querySelector("span")
        ? item.querySelector("span").textContent
        : "";
      applySort(sortType, sortText);
    });
  });
}

// Функция для сортировки товаров через AJAX
function applySort(sortType, sortText) {
  // Получаем URL для AJAX, проверяя существование элемента
  const filterSortBtn = document.querySelector(".filter-sort-btn-mob");
  if (!filterSortBtn) {
    console.error("Элемент .filter-sort-btn-mob не найден!");
    return; // Выходим, если элемента нет
  }

  const ajaxUrl = filterSortBtn.getAttribute("data-url");
  const url = new URL(ajaxUrl);
  const categoryId = url.searchParams.get("category_id") || 0;
  const currentPage =
    document.querySelector(".pagination .current")?.textContent || 1;

  // Собираем текущие фильтры
  const checkboxes = document.querySelectorAll(
    ".category-block-filter-list-full-subfilter-checkbox"
  );
  const selectedFilters = {};

  checkboxes.forEach(function (checkbox) {
    if (checkbox.checked) {
      const attribute = checkbox.getAttribute("data-filter");
      const value = checkbox.value;

      if (!selectedFilters[attribute]) {
        selectedFilters[attribute] = [];
      }

      selectedFilters[attribute].push(value);
    }
  });

  const params = {
    action: "filter_products_sort",
    sort: sortType,
    category_id: categoryId,
    paged: currentPage,
  };

  // Добавляем параметры фильтров
  for (const [key, values] of Object.entries(selectedFilters)) {
    params["filter_" + key] = values.join(",");
  }

  url.search = new URLSearchParams(params).toString();

  fetch(url)
    .then((response) => response.json())
    .then((data) => {
      // Проверяем наличие .category-blocks-cards перед обновлением
      const categoryBlocksCards = document.querySelector(
        ".category-blocks-cards"
      );

      if (filterList.classList.contains("open")) {
        filterList.classList.remove("open");
      }

      // Обновляем товары
      if (categoryBlocksCards) {
        categoryBlocksCards.innerHTML = data.data.products;
      }

      // Обновляем пагинацию
      const paginationContainer = document.querySelector(".pagination");
      if (paginationContainer) {
        paginationContainer.innerHTML = data.data.pagination;
      }

      // Проверяем наличие кнопки перед изменением текста
      const filterBtnText = document.querySelector(".filter-sort-btn-mob p");
      if (filterBtnText) {
        filterBtnText.textContent = sortText;
      } else {
        console.error(".filter-sort-btn-mob p не найден!");
      }

      // После обновления контента заново инициализируем события
      setTimeout(() => {
        initializeProductEvents();
      }, 0);
    })
    .catch((error) => console.error("Ошибка при загрузке:", error));
}

document.addEventListener("DOMContentLoaded", function () {
  const checkboxes = document.querySelectorAll(
    ".category-block-filter-list-full-subfilter-checkbox"
  );
  const productsContainer = document.querySelector(
    ".general-main-products-blocks-cards"
  ); // Убедитесь, что у контейнера с продуктами есть этот класс.
  const loaderCategory = document.querySelector(".loader-blocks-category");
  const currentPage =
    document.querySelector(".pagination .current")?.textContent || 1;

  checkboxes.forEach(function (checkbox) {
    checkbox.addEventListener("change", function () {
      const selectedFilters = {};

      checkboxes.forEach(function (checkbox) {
        if (checkbox.checked) {
          const attribute = checkbox.getAttribute("data-filter");
          const value = checkbox.value;

          if (!selectedFilters[attribute]) {
            selectedFilters[attribute] = [];
          }

          selectedFilters[attribute].push(value);
        }
      });

      // Формируем строку запроса для фильтров
      const queryData = new URLSearchParams();

      for (const [key, values] of Object.entries(selectedFilters)) {
        queryData.append("filter_" + key, values.join(","));
      }

      loaderCategory.classList.add("active");
      productsContainer.classList.add("hidden");

      queryData.append("page", currentPage);
      // Отправляем AJAX-запрос
      fetch("/wp-admin/admin-ajax.php?action=load_filtered_products", {
        method: "POST",
        headers: {
          "Content-Type": "application/x-www-form-urlencoded",
        },
        body: queryData.toString(),
      })
        .then((response) => response.json())
        .then((data) => {
          loaderCategory.classList.remove("active");
          productsContainer.classList.remove("hidden");

          // Обновляем товары
          if (productsContainer) {
            productsContainer.innerHTML = data.data.products;
          }

          // Обновляем пагинацию
          const paginationContainer = document.querySelector(".pagination");
          if (paginationContainer) {
            paginationContainer.innerHTML = data.data.pagination;
          }

          initializeProductEvents();
        })
        .catch((error) => console.error("Ошибка при фильтрации:", error));
    });
  });
});

// pagination
// Начальная страница
let currentPage = 1;

// Получаем кнопки пагинации
document.addEventListener("DOMContentLoaded", function () {
  const pagination = document.querySelector(".pagination");

  if (pagination) {
    // Навешиваем обработчик на каждую кнопку
    pagination.addEventListener("click", function (e) {
      e.preventDefault();

      // Проверяем, был ли клик по элементу с атрибутом data-page
      const target = e.target.closest(".pagination-item");
      if (target) {
        // Удаляем класс "active" у всех элементов
        document.querySelectorAll(".pagination-item").forEach((el) => {
          el.classList.remove("active");
        });

        // Добавляем класс "active" к текущему элементу
        target.classList.add("active");

        const page = target.getAttribute("data-page"); // Номер страницы из атрибута
        if (page) {
          const currentPage = parseInt(page);
          loadProducts(currentPage);
        }
      }
    });
  }
});

function loadProducts(page) {
  // Собираем текущие фильтры
  const checkboxes = document.querySelectorAll(
    ".category-block-filter-list-full-subfilter-checkbox"
  );
  const selectedFilters = {};

  checkboxes.forEach(function (checkbox) {
    if (checkbox.checked) {
      const attribute = checkbox.getAttribute("data-filter");
      const value = checkbox.value;

      if (!selectedFilters[attribute]) {
        selectedFilters[attribute] = [];
      }
      selectedFilters[attribute].push(value);
    }
  });

  // Собираем текущую сортировку
  const activeSort = document.querySelector(".filter-sort-list.active");
  const sortType = activeSort ? activeSort.getAttribute("data-sort") : "";

  // Формируем данные для запроса
  const params = {
    action: "load_more_products",
    paged: page, // Номер текущей страницы
  };

  // Добавляем сортировку, только если она выбрана
  if (sortType) {
    params.sort = sortType; // Тип сортировки
  }

  // Добавляем фильтры в параметры
  for (const [key, values] of Object.entries(selectedFilters)) {
    params["filter_" + key] = values.join(",");
  }

  // Преобразуем параметры в строку
  const formData = new URLSearchParams(params);

  // Отправляем fetch-запрос
  fetch(ajaxObject.ajaxurl, {
    method: "POST",
    headers: {
      "Content-Type": "application/x-www-form-urlencoded",
    },
    body: formData.toString(),
  })
    .then((response) => {
      if (!response.ok) {
        throw new Error(`Ошибка загрузки: ${response.statusText}`);
      }
      return response.json();
    })
    .then((data) => {
      // Обновляем товары
      const productContainer = document.querySelector(
        ".general-main-products-blocks-cards"
      );
      if (productContainer) {
        productContainer.innerHTML = data.data.products;
      }

      // Обновляем пагинацию
      const paginationContainer = document.querySelector(".pagination");
      if (paginationContainer) {
        paginationContainer.innerHTML = data.data.pagination;
      }

      initializeProductEvents();
    })
    .catch((error) => {
      console.error("Ошибка загрузки товаров:", error.message);
    });
}

// pagination

// Инициализация при первой загрузке страницы
document.addEventListener("DOMContentLoaded", () => {
  initializeProductEvents();
  updateCartQuantity();
});
