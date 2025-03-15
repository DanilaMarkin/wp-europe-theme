// Валидация модального окна на главной странице - Контакты
document.getElementById("contactForm").addEventListener("submit", (event) => {
  event.preventDefault(); // остановать станд. поведение браузера

  let isValid = true; // переменная для валидации

  // Поля телефон, имя и пользовательское соглащение
  const phone = document.getElementById("phoneContact");
  const name = document.getElementById("nameContact");

  // Валдиация телефона
  const phonePatternContact = /^[+\d\s()-]+$/; // Разрешает только цифры, пробелы и символы + ( ) -

  const labelCheckBoxContact = document.getElementById("contactLabelCheckbox");
  const checkboxContact = document.getElementById("contactCheckbox");

  // Валдиация телефона
  if (
    phone.value.trim() === "" ||
    !phonePatternContact.test(phone.value.trim())
  ) {
    phone.classList.add("error");
    isValid = false;
  } else {
    phone.classList.remove("error");
  }

  // Валдиация имени
  if (name.value.trim() === "") {
    name.classList.add("error");
    isValid = false;
  } else {
    name.classList.remove("error");
  }

  // Валдиация пользовательское соглащения
  if (!checkboxContact.checked) {
    checkboxContact.classList.add("error");
    labelCheckBoxContact.classList.add("error");
    isValid = false;
  } else {
    checkboxContact.classList.remove("error");
    labelCheckBoxContact.classList.remove("error");
  }

  // Если все поля прошли проверку выполнить отравку на почту
  if (isValid) {
    jQuery("#loaderContact").removeClass("hidden");
    jQuery("#contactForm").addClass("open");

    jQuery.ajax({
      url: ajaxObject.ajaxurl,
      type: "POST",
      data: {
        action: "send_form_contact_to_mail",
        form: {
          phone: phone.value.trim(),
          name: name.value.trim(),
        },
      },
      success: function (response) {
        jQuery("#loaderContact").addClass("hidden");
        jQuery("#contactForm").removeClass("open");

        // Очищаем поля формы
        jQuery("#contactForm")
          .find("input[type=text], input[type=tel]")
          .val("");

        // Сбрасываем флажок
        jQuery("#contactForm")
          .find("input[type=checkbox]")
          .prop("checked", false);
        // Обратная связь для пользователя
        Swal.fire({
          title: "Form Submitted!",
          text: "Your message has been successfully sent. We will get back to you soon.",
          icon: "success",
          confirmButtonText: "Close",
          customClass: {
            confirmButton: "custom-confirm-button",
          },
          timer: 4000, // Закрытие через 4 секунды
          timerProgressBar: true, // Показывает индикатор времени
        });
      },
      error: function (error) {
        // При ошибке скрываем loader и закрываем форму
        jQuery("#loaderContact").addClass("hidden");
        jQuery("#contactForm").removeClass("open");

        console.log("Error:", error);
      },
    });
  }
});

// Валидация модального окна на главной странице - Price List
document.getElementById("priceForm").addEventListener("submit", (e) => {
  e.preventDefault();

  let isValid = true; // переменная для валидации

  const phone = document.getElementById("phonePrice");

  const labelCheckBoxPrice = document.getElementById("priceLabelCheckbox");
  const checkboxPrice = document.getElementById("priceCheckbox");

  // Валдиация телефона
  const phonePattern = /^[+\d\s()-]+$/; // Разрешает только цифры, пробелы и символы + ( ) -

  if (phone.value.trim() === "" || !phonePattern.test(phone.value.trim())) {
    phone.classList.add("error");
    isValid = false;
  } else {
    phone.classList.remove("error");
  }

  // Валдиация пользовательское соглащения
  if (!checkboxPrice.checked) {
    labelCheckBoxPrice.classList.add("error");
    checkboxPrice.classList.add("error");
    isValid = false;
  } else {
    labelCheckBoxPrice.classList.remove("error");
    checkboxPrice.classList.remove("error");
  }
});
