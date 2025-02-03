<section class="brands">
    <div class="brands-blocks container">
        <h2 class="brands-title">Our Brands</h2>
        <div class="brands-blocks-slider">
            <?php
            wp_nav_menu(array(
                'theme_location' => 'side-menu-brands',
                'container' => 'ul', // Убираем обертку div
                'menu_id' => 'brandsMenu', // Присваиваем ID
                'menu_class' => 'brands-blocks-slider-lists', // Присваиваем класс
                'depth' => 1, // Поддержка вложенных пунктов
                'walker' => new Custom_Walker_Brands() // Добавляем кастомный walker для точной структуры
            ));
            ?>
        </div>
    </div>
</section>