<?php

/**
 * Template Name: Custom Single Product
 * Template Post Type: product
 */
europe_get_header();
?>

<main class="product-single">
    <section class="product-single-header container">
        <h1 class="product-single-header-title">DELL EMC PowerEdge R740xd (28xSFF) Performance Rack Server with 2x Xeon Gold 6154 18-Core 3.00 GHz, 32 GB DDR4 RAM</h1>

        <div class="product-single-header-configuration">
            <h2 class="product-single-header-configuration-title">Configuration</h2>
            <ul class="product-single-header-configuration-items">
                <li class="product-single-header-configuration-item">
                    Item 1
                </li>
                <li class="product-single-header-configuration-item">
                    Item 2
                </li>
                <li class="product-single-header-configuration-item">
                    Item 3
                </li>
                <li class="product-single-header-configuration-item">
                    Item 4
                </li>
            </ul>
        </div>

        <div class="product-single-header-btn">
            <button class="product-single-header-btn-general product-single-header-btn-contact">Contact us</button>
            <button class="product-single-header-btn-general product-single-header-btn-price">$428</button>
        </div>

        <div class="product-gallery">
            <figure class="main-image">
                <img src="large-image.jpg" alt="Основное изображение товара">
                <figcaption>Основное изображение товара</figcaption>
            </figure>
            <ul class="thumbnail-gallery">
                <li>
                    <figure>
                        <img src="thumbnail1.jpg" alt="Миниатюра 1">
                    </figure>
                </li>
                <li>
                    <figure>
                        <img src="thumbnail2.jpg" alt="Миниатюра 2">
                    </figure>
                </li>
            </ul>
        </div>

    </section>

    <section class="product-single-description">
        <div class="container">
            <h2 class="product-single-description-title">Description</h2>
            <p class="product-single-description-text">Sed ornare dolor mauris mollis mattis lorem est. Dictum. Et adipiscing in amet, molestie faucibus. Vitae eleifend justo imperdiet cursus non dolor imperdiet cursus orci, tortor, augue luctus molestie sit quis, hac mattis leo, aenean amet, et aenean molestie sed est. Orci, est. Elit. Dapibus dictum faucibus. Velit et. Sit ut. Sit integer urna in tempus ultricies. Dolor orci, aenean velit accumsan ipsum ornare mattis habitasse dictum. Sit libero, id sit vestibulum elit. Integer amet, tempus libero, in faucibus. Non dictumst. Habitasse faucibus. Morbi ornare sit amet, habitasse ex. Et sapien sapien accumsan risus aenean amet, pulvinar cras tortor, pulvina.</p>
        </div>
    </section>

    <section class="product-single-feature container">
        <h2 class="product-single-feature-title">Characteristics</h2>
        <dl class="product-specs">
            <dt>Процессор:</dt>
            <dd>2x Intel Xeon Gold 6154 18-Core 3.00 GHz (36-Threads, 3.70 GHz Turbo, 24.75 MB Cache)</dd>

            <dt>Оперативная память:</dt>
            <dd>64 GB DDR4</dd>

            <dt>Жесткий диск:</dt>
            <dd>1 TB SSD</dd>

            <dt>Графика:</dt>
            <dd>NVIDIA Tesla V100</dd>

            <dt>Операционная система:</dt>
            <dd>Linux Ubuntu 20.04</dd>
        </dl>
    </section>
</main>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const listsConfig = document.querySelector(".product-single-header-configuration-items");

        listsConfig.addEventListener("click", function(event) {
            const itemConfig = event.target;

            // Проверяем, что клик был по элементу списка
            if (itemConfig && itemConfig.classList.contains("product-single-header-configuration-item")) {
                const itemsConfig = listsConfig.querySelectorAll(".product-single-header-configuration-item");

                // Убираем класс active у всех элементов
                itemsConfig.forEach(i => i.classList.remove('active'));

                // Добавляем класс active к выбранному элементу
                itemConfig.classList.add('active');
            }
        });
    });
</script>

<?php europe_get_footer(); ?>