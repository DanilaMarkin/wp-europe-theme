// Variadble menu
const menuCloseBtn = document.querySelector(".menu-close");
const menuToggle = document.getElementById("menuToogle");
const sideMenu = document.getElementById("sideMenu");
// Variadble search popup
const searchToggle = document.getElementById("searchToogle");
const searchPopup = document.getElementById("searchPopup");
const searchCloseBtn = document.querySelector(".search-popup-block-close");
// Variadble contact popup
const contactPopupOpen = document.querySelector(".button-content-contact");
const contactPopupForm = document.getElementById("contactPopup");
const contactPopupСlose = document.querySelector(
  ".contact-popup-blocks-header-btn"
);
// Variadble price popup
const pricePopupOpen = document.querySelector(".button-content-download");
const pricePopupForm = document.getElementById("pricePopup");
const pricePopupСlose = document.querySelector(
  ".price-popup-blocks-header-btn"
);
// Variadble general
const overlay = document.getElementById("overlay");

// Переключение overlay
function toggleOverlay(isVisible) {
  if (overlay) overlay.classList.toggle("active", isVisible);
}

// Обновление состояния overlay
function updateOverlayState() {
  const isOverlayActive =
    sideMenu.classList.contains("open") ||
    searchPopup.classList.contains("open") ||
    contactPopupForm.classList.contains("open") ||
    pricePopupForm.classList.contains("open");
  toggleOverlay(isOverlayActive);
}

// Открытие/закрытие бокового меню
if (menuToggle && sideMenu) {
  menuToggle.addEventListener("click", () => {
    sideMenu.classList.toggle("open");
    updateOverlayState();
  });
}

// Открытие/закрытие поиска
if (searchToggle && searchPopup) {
  searchToggle.addEventListener("click", () => {
    searchPopup.classList.toggle("open");
    updateOverlayState();
  });
}

// Открытие/закрытие контакты
if (contactPopupOpen && contactPopupForm) {
  contactPopupOpen.addEventListener("click", () => {
    contactPopupForm.classList.toggle("open");
    updateOverlayState();
  });
}

// Открытие/закрытие price list
if (pricePopupOpen && pricePopupForm) {
  pricePopupOpen.addEventListener("click", () => {
    pricePopupForm.classList.toggle("open");
    updateOverlayState();
  });
}

// Закрытие поиска при клике на кнопку закрытия
if (searchCloseBtn && searchPopup) {
  searchCloseBtn.addEventListener("click", () => {
    searchPopup.classList.remove("open");
    updateOverlayState();
  });
}

// Закрытие меню при клике на кнопку закрытия
if (menuCloseBtn && sideMenu) {
  menuCloseBtn.addEventListener("click", () => {
    sideMenu.classList.remove("open");
    updateOverlayState();
  });
}

// Закрытие меню при клике на кнопку закрытия
if (contactPopupСlose && contactPopupForm) {
  contactPopupСlose.addEventListener("click", () => {
    contactPopupForm.classList.remove("open");
    updateOverlayState();
  });
}

// Закрытие pricePopup при клике на кнопку закрытия
if (pricePopupСlose && pricePopupForm) {
  pricePopupСlose.addEventListener("click", () => {
    pricePopupForm.classList.remove("open");
    updateOverlayState();
  });
}

// Закрытие по клику вне блока или на overlay
document.addEventListener("click", (event) => {
  if (overlay && event.target === overlay) {
    sideMenu.classList.remove("open");
    searchPopup.classList.remove("open");
    contactPopupForm.classList.remove("open");
    pricePopupForm.classList.remove("open");
    toggleOverlay(false);
  }
});

// menuList Main open submeny
const menuListMain = document.querySelectorAll(".menu-blocks-link-toggle");
const menuSubMenu = document.querySelectorAll(".menu-blocks-links-submenu");

menuListMain.forEach((key, value) => {
  key.addEventListener("click", () => {
    menuListMain[value].classList.toggle("open");
    menuSubMenu[value].classList.toggle("open");
  });
});

// in menu toogle categories
const categoriesMenuBtn = document.querySelector(
  ".menu-blocks-header-categories"
);
const categoriesMenu = document.getElementById("categoriesMenu");
const brandsMenu = document.getElementById("brandsMenu");
const brandsMenuBtn = document.querySelector(".menu-blocks-header-brands");

brandsMenuBtn.addEventListener("click", () => {
  brandsMenuBtn.classList.add("active");
  categoriesMenuBtn.classList.remove("active");
  brandsMenu.classList.remove("hidden");
  categoriesMenu.classList.add("hidden");
});

categoriesMenuBtn.addEventListener("click", () => {
  brandsMenuBtn.classList.remove("active");
  categoriesMenuBtn.classList.add("active");
  brandsMenu.classList.add("hidden");
  categoriesMenu.classList.remove("hidden");
});
