<?php
/*
Plugin Name: Product Characteristics
Description: Плагин для добавления характеристик на странице товара в WooCommerce.
Version: 1.0
Author: Данила Маркин
*/

// Добавление мета-бокса

function add_product_meta_box() {
    add_meta_box(
        'product_characteristics',
        'Product characteristics',
        'render_product_meta_box',
        'product',
        'normal',
        'default'
    );
}
add_action('add_meta_boxes', 'add_product_meta_box');

function render_product_meta_box($post) {
    // Получаем сохраненные характеристики
    $characteristics = get_post_meta($post->ID, 'product_characteristics', true);
    if (!is_array($characteristics)) {
        $characteristics = [];
    }

    ?>
    <div id="product-characteristics-container">
        <?php
        // Для каждой сохраненной характеристики выводим поля
        foreach ($characteristics as $characteristic) {
            ?>
            <div class="characteristic-row">
                <div>
                    <label for="char_name[]">Name:</label>
                    <input type="text" name="char_name[]" value="<?php echo esc_attr($characteristic['name']); ?>" style="width: 100%;" />
                </div>

                <div>
                    <label for="char_value[]">Meaning:</label>
                    <input type="text" name="char_value[]" value="<?php echo esc_attr($characteristic['value']); ?>" style="width: 100%;" />
                </div>
            </div>
            <?php
        }
        ?>
    </div>

    <button type="button" id="add-characteristic" class="button" style="margin-top: 10px;">Add a characteristic</button>

    <script>
        document.getElementById('add-characteristic').addEventListener('click', function() {
            var container = document.getElementById('product-characteristics-container');
            var row = document.createElement('div');
            row.classList.add('characteristic-row');

            row.innerHTML = `
                <div>
                    <label for="char_name[]">Name:</label>
                    <input type="text" name="char_name[]" value="" style="width: 100%;" />
                </div>

                 <div>
                    <label for="char_value[]">Meaning:</label>
                    <input type="text" name="char_value[]" value="" style="width: 100%;" />
                </div>
            `;

            container.appendChild(row);
        });
    </script>
    <?php
}

function save_product_meta_box($post_id) {
    // Если это автосохранение, не сохраняем данные
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;

    // Проверяем права пользователя
    if (!current_user_can('edit_post', $post_id)) return;

    // Сохраняем характеристики
    if (isset($_POST['char_name']) && isset($_POST['char_value'])) {
        $characteristics = [];
        $names = $_POST['char_name'];
        $values = $_POST['char_value'];

        // Собираем характеристики
        foreach ($names as $key => $name) {
            if (!empty($name) && !empty($values[$key])) {
                $characteristics[] = [
                    'name'  => sanitize_text_field($name),
                    'value' => sanitize_text_field($values[$key])
                ];
            }
        }

        // Сохраняем в пост-мета
        update_post_meta($post_id, 'product_characteristics', $characteristics);
    }
}
add_action('save_post', 'save_product_meta_box');
