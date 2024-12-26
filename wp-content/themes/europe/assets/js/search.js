document.addEventListener("DOMContentLoaded", function () {
    const searchInput = document.querySelectorAll(
      ".search-popup-block-inlet, .nav-blocks-detail-search-input"
    );
    const resultsHeader = document.querySelector(".search-popup-block-results-header");
    const resultsHeaderEmpty = document.querySelector(".search-popup-block-results-header-empty");
    const resultSearch = document.querySelector(".search-popup-block-results-products");
    const resultsHeaderCount = document.querySelector(".search-popup-block-results-header-count-offers");
    
    const viewAll = document.querySelector(".search-popup-block-results-view-all");

    // Добавление обработчика для поля с классом .nav-blocks-detail-search-input
    const searchInputNav = document.querySelector(".nav-blocks-detail-search-input");
    const overlay = document.getElementById("overlay");
    const searchPopup = document.getElementById("searchPopup");
  
    searchInput.forEach((input) => {
      input.addEventListener("input", function () {
        const query = this.value.trim();
  
        if (query.length > 1) {
          fetchSearchResults(query);
        } else {
          resultSearch.innerHTML = "";
          resultSearch.classList.add("hidden"); // Скрываем блок с результатами
          viewAll.classList.add("hidden");
          resultsHeader.classList.add("hidden"); // Скрываем сообщение, если поле пустое
          resultsHeaderEmpty.classList.add("hidden"); // Скрываем сообщение, если поле пустое
        }
      });
    });
  
    // Добавляем обработчик на input с классом .nav-blocks-detail-search-input
    if (searchInputNav) {
        searchInputNav.addEventListener("focus", function () {
            // Добавляем классы при фокусе на поле ввода
            if (overlay) overlay.classList.add("active");
            if (searchPopup) searchPopup.classList.add("open");
        });
    
        searchInputNav.addEventListener("blur", function () {
            // Убираем классы, если поле ввода теряет фокус
            if (overlay) overlay.classList.remove("active");
            if (searchPopup) searchPopup.classList.remove("open");
        });
    }
  
    function fetchSearchResults(query) {
      fetch(
        `${ajaxObject.ajaxurl}?action=woocommerce_product_search&query=${query}`
      )
        .then((response) => response.json())
        .then((data) => {
          resultSearch.innerHTML = ""; // Очищаем старые результаты
  
          if (data.length) {
            resultSearch.classList.remove("hidden"); // Показываем блок с результатами
            resultsHeader.classList.remove("hidden"); // Показываем сообщение о найденных результатах
            viewAll.classList.remove("hidden"); // Показываем сообщение о найденных результатах
            resultsHeaderEmpty.classList.add("hidden"); // Скрываем сообщение о ненайденных результатах
            resultsHeaderCount.textContent = `${data.length} offers`; // Обновляем количество найденных товаров
  
            data.slice(0, 4).forEach((product) => {
              resultSearch.innerHTML += `
              <li class="products-blocks-card">
                  <a href="${product.url}" class="products-blocks-card-preview">
                      <img src="${product.image}" alt="${product.title}" class="products-blocks-card-preview-image">
                      <div class="search-popup-block-results-info">
                          <p class="products-blocks-card-preview-title">${product.title}</p>
                          <span class="products-blocks-card-preview-price">от ${product.price}</span>
                      </div>
                  </a>
              </li>`;
            });

            // Добавляем обработчик для кнопки "View All"
            viewAll.addEventListener("click", function () {
              if (query.length > 1) {
                  window.location.href = `/search-results/?query=${encodeURIComponent(query)}`;
              }
          });

          } else {
            resultSearch.classList.add("hidden"); // Скрываем список результатов
            viewAll.classList.add("hidden"); // Скрываем список результатов
            resultsHeader.classList.add("hidden"); // Показываем сообщение о ненайденных результатах
            resultsHeaderEmpty.classList.remove("hidden"); // Показываем сообщение о ненайденных результатах
          }
        })
        .catch((error) => {
          console.error("Error fetching search results:", error);
        });
    }
});
