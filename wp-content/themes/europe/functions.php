<?php
// Подключаем стили темы
function europe_enqueue_styles()
{
    wp_enqueue_style('europe-style', get_stylesheet_uri());
    wp_enqueue_style('europe-reset', get_template_directory_uri() . '/assets/css/reset.css');
    wp_enqueue_style('europe-global', get_template_directory_uri() . '/assets/css/global.css');
    wp_enqueue_style('europe-header', get_template_directory_uri() . '/assets/css/header.css');
    wp_enqueue_style('europe-footer', get_template_directory_uri() . '/assets/css/footer.css');
    wp_enqueue_style('europe-pages', get_template_directory_uri() . '/assets/css/pages.css');
    wp_enqueue_style('europe-woocommerce', get_template_directory_uri() . '/assets/css/woocommerce.css');
}
add_action('wp_enqueue_scripts', 'europe_enqueue_styles');

// Подключаем скрипты темы
function enqueue_custom_scripts()
{
    wp_enqueue_script('main-script', get_template_directory_uri() . '/assets/js/main.js', array('jquery'), null, true);
    wp_enqueue_script('store-script', get_template_directory_uri() . '/assets/js/store.js', array('jquery'), null, true);
}
add_action('wp_enqueue_scripts', 'enqueue_custom_scripts');

// Поддержка WooCommerce в теме
function europe_woocommerce_setup()
{
    add_theme_support('woocommerce');
}
add_action('after_setup_theme', 'europe_woocommerce_setup');

// Подключаем шапки сайта
function europe_get_header()
{
    get_template_part('templates/partials/header');
}

// Подключаем подвала сайта
function europe_get_footer()
{
    get_template_part('templates/partials/footer');
}

// Автозагрузка классов (если используете автозагрузку)
function include_custom_walkers()
{
    require_once get_template_directory() . '/includes/walkers/custom-walker-side-menu.php';
    require_once get_template_directory() . '/includes/walkers/custom-walker-nav-menu.php';
    require_once get_template_directory() . '/includes/walkers/custom-walker-nav-menu-pages.php';
}

add_action('after_setup_theme', 'include_custom_walkers');

// Регистрация меню в теме
function register_my_menus()
{
    register_nav_menus(
        array(
            'side-menu-categories' => __('Categories Menu'),
            'side-menu-brands' => __('Brands Menu'),
            'nav-general-pages' => __('Menu General Pages'),
        )
    );
}
add_action("init", "register_my_menus");

function custom_breadcrumbs()
{
    if (is_front_page()) {
        return;
    }

    $home = 'Home';
    $separator = ' | ';
    echo '<nav class="container bread-crumbs" aria-label="Breadcrumb" itemscope itemtype="https://schema.org/BreadcrumbList"><ol>';

    // Главная страница
    echo '<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';
    echo '<a href="' . home_url() . '" itemprop="item"><span itemprop="name">' . $home . '</span></a>';
    echo '<meta itemprop="position" content="1" /></li>';

    $position = 2;

    // Хлебные крошки для категории продукта WooCommerce
    if (is_product_category()) {
        $category = get_queried_object();
        if ($category) {
            echo '<li class="bread-crumbs-separator">' . $separator . '</li>';
            echo '<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';
            echo '<a href="' . get_term_link($category) . '" itemprop="item">';
            echo '<span itemprop="name" class="bread-crumbs-active">' . esc_html($category->name) . '</span></a>';
            echo '<meta itemprop="position" content="' . $position++ . '" />';
            echo '</li>';
        }
    }

    // Хлебные крошки для товаров WooCommerce
    if (is_product()) {
        $categories = wc_get_product_terms(get_the_ID(), 'product_cat');
        if (!empty($categories)) {
            echo '<li class="bread-crumbs-separator">' . $separator . '</li>';
            foreach ($categories as $category) {
                echo '<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';
                echo '<a href="' . get_term_link($category) . '" itemprop="item">';
                echo '<span itemprop="name">' . esc_html($category->name) . '</span></a>';
                echo '<meta itemprop="position" content="' . $position++ . '" />';
                echo '</li>';
            }
        }
        echo '<li class="bread-crumbs-separator">' . $separator . '</li>';
        echo '<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';
        echo '<span itemprop="name">' . get_the_title() . '</span>';
        echo '<meta itemprop="position" content="' . $position++ . '" />';
        echo '</li>';
    }

    if (is_single()) {
        echo '<li class="bread-crumbs-separator">' . $separator . '</li>';
        echo '<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';
        echo '<span itemprop="name">' . get_the_title() . '</span>';
        echo '<meta itemprop="position" content="' . $position++ . '" />';
        echo '</li>';
    }

    if (is_page() && !is_front_page()) {
        echo '<li class="bread-crumbs-separator">' . $separator . '</li>';
        echo '<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';
        echo '<span itemprop="name" class="bread-crumbs-active">' . get_the_title() . '</span>';
        echo '<meta itemprop="position" content="' . $position++ . '" />';
        echo '</li>';
    }

    if (is_search()) {
        echo '<li class="bread-crumbs-separator">' . $separator . '</li>';
        echo '<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';
        echo '<span itemprop="name">Search results for: ' . get_search_query() . '</span>';
        echo '<meta itemprop="position" content="' . $position++ . '" />';
        echo '</li>';
    }

    if (is_404()) {
        echo '<li class="bread-crumbs-separator">' . $separator . '</li>';
        echo '<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';
        echo '<span itemprop="name">404 - Page not found</span>';
        echo '<meta itemprop="position" content="' . $position++ . '" />';
        echo '</li>';
    }
    echo '</ol></nav>';
}

function get_global_settings($page_id)
{
    return [
        'phone' => get_field('contact_info_phone', $page_id),
        'phone_desc' => get_field('contact_info_phone_down_descr', $page_id),
        'email' => get_field('contact_info_email', $page_id),
        'email_desc' => get_field('contact_info_email_down_descr', $page_id),
        'address' => get_field('contact_info_address', $page_id),
        'address_desc' => get_field('contact_info_address_down_descr', $page_id),
    ];
}

add_action('wp_ajax_filter_products_sort', 'filter_products_sort');
add_action('wp_ajax_nopriv_filter_products_sort', 'filter_products_sort');

function filter_products_sort()
{
    if (isset($_GET['sort'])) {
        $sort = sanitize_text_field($_GET['sort']);

        // WP_Query параметры для сортировки
        $args = array(
            'post_type' => 'product',
            'posts_per_page' => -1,
            'orderby' => 'date', // Сортировка по дате по умолчанию
            'order' => 'DESC'
        );

        // Изменение параметров сортировки в зависимости от выбранного варианта
        if ($sort == 'price_asc') {
            $args['orderby'] = 'meta_value_num';
            $args['meta_key'] = '_price';
            $args['order'] = 'ASC';
        } elseif ($sort == 'price_desc') {
            $args['orderby'] = 'meta_value_num';
            $args['meta_key'] = '_price';
            $args['order'] = 'DESC';
        } elseif ($sort == 'popularity') {
            $args['orderby'] = 'meta_value_num';
            $args['meta_key'] = 'total_sales';
            $args['order'] = 'DESC';
        }

        // Получаем товары по заданным параметрам
        $query = new WP_Query($args);

        if ($query->have_posts()) :
            while ($query->have_posts()) : $query->the_post();
                global $product;
                // Выводим карточку товара
?>
                <li class="products-blocks-id products-blocks-card" data-id="<?= $product->get_id(); ?>">
                    <div class="products-blocks-card-preview">
                        <a href="<?php the_permalink(); ?>">
                            <?php
                            $thumbnail_id = $product->get_image_id();
                            $alt_text = get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true);
                            $title_text = get_the_title($thumbnail_id);
                            ?>
                            <img src="<?= wp_get_attachment_image_url($thumbnail_id, 'medium'); ?>"
                                alt="<?= esc_attr($alt_text ?: $product->get_name()); ?>"
                                title="<?= esc_attr($title_text ?: $product->get_name()); ?>"
                                class="products-blocks-card-preview-image">
                        </a>
                        <h2 class="products-blocks-card-preview-title"><?php the_title(); ?></h2>
                        <span class="products-blocks-card-preview-price">from <?= $product->get_price_html(); ?></span>
                    </div>
                    <div class="products-blocks-card-btn">
                        <div class="products-blocks-card-btn-contact-full">
                            <button class="products-blocks-card-btn-contact-full-general products-blocks-card-btn-contact-full-wa">
                                <img src="<?= get_template_directory_uri(); ?>/assets/icons/whatsapp.svg" alt="">
                            </button>
                            <button class="products-blocks-card-btn-contact-full-general products-blocks-card-btn-contact-full-tg">
                                <img src="<?= get_template_directory_uri(); ?>/assets/icons/telegram-sidemenu.svg" alt="">
                            </button>
                        </div>
                        <div class="products-blocks-card-btn-count">
                            <button class="count-btn minus" aria-label="Уменьшить количество">-</button>
                            <span class="count-number">0</span>
                            <button class="count-btn plus" aria-label="Увеличить количество">+</button>
                        </div>
                        <button class="products-blocks-card-btn-general products-blocks-card-btn-contact">Contact us</button>
                        <button class="products-blocks-card-btn-general products-blocks-card-btn-cart">
                            <img src="<?= get_template_directory_uri(); ?>/assets/icons/cart.svg" alt="">
                        </button>
                    </div>
                </li>
        <?php
            endwhile;
        else :
            echo '<p>No products found</p>';
        endif;

        wp_reset_postdata();
    }
    die();
}

add_filter('theme_page_templates', function ($templates) {
    // Добавляем новые шаблоны
    $templates['templates/pages/payment.php'] = 'Payment and Delivery';
    $templates['templates/pages/about.php'] = 'About Us';
    $templates['templates/pages/contacts.php'] = 'Contacts';
    return $templates;
});

add_filter('template_include', function ($template) {
    // Обработка шаблона "Payment and Delivery"
    if (get_page_template_slug() === 'templates/pages/payment.php') {
        return get_stylesheet_directory() . '/templates/pages/payment.php';
    }

    // Обработка шаблона "About Us"
    if (get_page_template_slug() === 'templates/pages/about.php') {
        return get_stylesheet_directory() . '/templates/pages/about.php';
    }

    // Обработка шаблона "Contacts"
    if (get_page_template_slug() === 'templates/pages/contacts.php') {
        return get_stylesheet_directory() . '/templates/pages/contacts.php';
    }

    return $template;
});
