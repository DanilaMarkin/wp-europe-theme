<?php

/**
 * Plugin Name: WooCommerce Configurations with Titles
 * Description: Adds unlimited configurations grouped by titles to WooCommerce product pages.
 * Version: 1.0
 * Author: Данила Маркин
 */

if (! defined('ABSPATH')) {
    exit;
}

// Подключение метабокса на странице товара
add_action('add_meta_boxes', 'wc_add_configuration_metabox');
function wc_add_configuration_metabox()
{
    add_meta_box(
        'wc_product_configurations',
        __('Product Configurations', 'woocommerce'),
        'wc_render_configuration_metabox',
        'product',
        'normal',
        'high'
    );
}

// Рендер метабокса
function wc_render_configuration_metabox($post)
{
    $configurations = get_post_meta($post->ID, '_product_configurations', true) ?: [];
    wp_nonce_field('wc_save_configurations', 'wc_configurations_nonce');
?>
    <div id="wc-configuration-sections">
        <?php foreach ($configurations as $section_index => $section): ?>
            <div class="wc-configuration-section">
                <input
                    type="text"
                    name="configuration_titles[]"
                    value="<?php echo esc_attr($section['title']); ?>"
                    placeholder="<?php esc_attr_e('Enter configuration title', 'woocommerce'); ?>"
                    class="wc-configuration-title" />
                <div class="wc-configurations">
                    <?php foreach ($section['configs'] as $config): ?>
                        <div class="wc-configuration-row">
                            <input
                                type="text"
                                name="configuration_data[<?php echo esc_attr($section_index); ?>][]"
                                value="<?php echo esc_attr($config); ?>"
                                placeholder="<?php esc_attr_e('Enter configuration', 'woocommerce'); ?>" />
                            <button type="button" class="wc-remove-configuration">×</button>
                        </div>
                    <?php endforeach; ?>
                </div>
                <button type="button" class="wc-add-configuration"><?php esc_html_e('Add Configuration', 'woocommerce'); ?></button>
                <button type="button" class="wc-remove-section"><?php esc_html_e('Remove Section', 'woocommerce'); ?></button>
            </div>
        <?php endforeach; ?>
    </div>
    <button type="button" class="button" id="wc-add-section"><?php esc_html_e('Add Configuration Section', 'woocommerce'); ?></button>

    <style>
        .wc-configuration-section {
            margin-bottom: 20px;
            border: 1px solid #ddd;
            padding: 15px;
            background: #f9f9f9;
        }

        .wc-configuration-title {
            display: block;
            width: 100%;
            margin-bottom: 10px;
        }

        .wc-configuration-row {
            display: flex;
            align-items: center;
            margin-bottom: 5px;
        }

        .wc-configuration-row input {
            flex: 1;
        }

        .wc-remove-configuration,
        .wc-remove-section {
            background: red;
            color: white;
            border: none;
            margin-left: 10px;
            cursor: pointer;
        }

        .wc-add-configuration {
            background: #007cba;
            color: white;
            border: none;
            padding: 5px 10px;
            margin-top: 10px;
            cursor: pointer;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sectionsContainer = document.getElementById('wc-configuration-sections');
            const addSectionButton = document.getElementById('wc-add-section');

            // Добавление новой секции
            addSectionButton.addEventListener('click', () => {
                const newSection = document.createElement('div');
                newSection.classList.add('wc-configuration-section');
                newSection.innerHTML = `
                    <input type="text" name="configuration_titles[]" placeholder="Enter configuration title" class="wc-configuration-title" />
                    <div class="wc-configurations"></div>
                    <button type="button" class="wc-add-configuration">Add Configuration</button>
                    <button type="button" class="wc-remove-section">Remove Section</button>
                `;
                sectionsContainer.appendChild(newSection);

                addSectionHandlers(newSection);
            });

            // Добавление обработчиков событий для новой секции
            function addSectionHandlers(section) {
                const addConfigButton = section.querySelector('.wc-add-configuration');
                const removeSectionButton = section.querySelector('.wc-remove-section');

                // Добавление новой конфигурации
                addConfigButton.addEventListener('click', () => {
                    const configsContainer = section.querySelector('.wc-configurations');
                    const configIndex = configsContainer.children.length;
                    const newRow = document.createElement('div');
                    newRow.classList.add('wc-configuration-row');
                    newRow.innerHTML = `
                        <input type="text" name="configuration_data[${Array.from(sectionsContainer.children).indexOf(section)}][]" placeholder="Enter configuration" />
                        <button type="button" class="wc-remove-configuration">×</button>
                    `;
                    configsContainer.appendChild(newRow);
                });

                // Удаление секции
                removeSectionButton.addEventListener('click', () => {
                    section.remove();
                });
            }

            // Удаление конфигурации (с делегированием событий)
            sectionsContainer.addEventListener('click', function(event) {
                if (event.target.classList.contains('wc-remove-configuration')) {
                    const configRow = event.target.closest('.wc-configuration-row');
                    if (configRow) {
                        configRow.remove();
                    }
                }
            });

            // Применение обработчиков к существующим секциям
            Array.from(sectionsContainer.children).forEach(addSectionHandlers);
        });
    </script>
<?php
}

// Сохранение данных
add_action('save_post', 'wc_save_product_configurations');
function wc_save_product_configurations($post_id)
{
    if (! isset($_POST['wc_configurations_nonce']) || ! wp_verify_nonce($_POST['wc_configurations_nonce'], 'wc_save_configurations')) {
        return;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    if (! current_user_can('edit_post', $post_id)) {
        return;
    }

    $titles = $_POST['configuration_titles'] ?? [];
    $configs = $_POST['configuration_data'] ?? [];
    $sections = [];

    foreach ($titles as $index => $title) {
        $sections[] = [
            'title' => sanitize_text_field($title),
            'configs' => array_map('sanitize_text_field', $configs[$index] ?? [])
        ];
    }

    update_post_meta($post_id, '_product_configurations', $sections);
}

// Отображение данных
add_action('woocommerce_single_product_summary', 'wc_display_product_configurations', 25);
function wc_display_product_configurations()
{
    global $post;
    $configurations = get_post_meta($post->ID, '_product_configurations', true);

    if ($configurations) {
        foreach ($configurations as $section) {
            echo '<h4>' . esc_html($section['title']) . '</h4>';
            echo '<ul class="product-configurations">';
            foreach ($section['configs'] as $config) {
                echo '<li>' . esc_html($config) . '</li>';
            }
            echo '</ul>';
        }
    }
}
?>