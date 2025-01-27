<?php
/* Template Name: 404 */
europe_get_header();
?>

<style>
    .error-404-container {
        display: flex;
        justify-content: center;
        align-items: center;
        text-align: center;
        padding: 0 10px;
        flex-grow: 1;
    }

    .error-404-content h1 {
        font-size: 10rem;
        margin: 0;
        color: #343a40;
    }

    .error-404-content p {
        font-size: 1.5rem;
        color: #6c757d;
        margin: 10px 0;
    }

    .error-404-content a {
        display: inline-block;
        margin-top: 20px;
        padding: 10px 20px;
        background: var(--bg-color);
        color: #000;
        text-decoration: none;
        border-radius: 5px;
        transition: background-color 0.3s ease;
    }

    /* Адаптивность для мобильных устройств */
    @media (max-width: 768px) {
        .error-404-content h1 {
            font-size: 6rem;
        }

        .error-404-content p {
            font-size: 1.2rem;
        }

        .error-404-content a {
            padding: 8px 16px;
            font-size: 0.9rem;
        }
    }
</style>

<main class="error-404-container">
    <section class="error-404-content">
        <?php
        $page_id = 374; // ID страницы
        $page_title = get_the_title($page_id); // Получаем заголовок страницы по ID
        $page_content = get_post_field('post_content', $page_id); // Получаем контент страницы по ID

        if (!empty($page_title)) {
            echo '<h1>' . esc_html($page_title) . '</h1>'; // Выводим заголовок
        } else {
            echo '<h1>Page Not Found</h1>'; // Заголовок по умолчанию
        }

        if (!empty($page_content)) {
            echo apply_filters('the_content', $page_content); // Применяем фильтры и выводим контент
        } else {
            echo "<p>There's nothing here yet</p>"; // Контент по умолчанию
        }
        ?>
    </section>
</main>

<?php
europe_get_footer();
?>