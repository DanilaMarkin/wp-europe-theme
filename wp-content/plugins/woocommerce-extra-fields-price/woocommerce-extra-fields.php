<?php
/**
 * Plugin Name: WooCommerce Extra Product Fields
 * Plugin URI: https://yourwebsite.com
 * Description: Добавляет дополнительные поля к товарам WooCommerce с возможностью добавлять динамические группы полей.
 * Version: 1.1
 * Author: Данила Маркин
 * Author URI: https://yourwebsite.com
 * Text Domain: woocommerce-extra-fields
 */

 if (!defined('ABSPATH')) {
     exit; // Защита от прямого доступа
 }
 
 class WooCommerce_Extra_Fields {
     public function __construct() {
         // Хуки для добавления полей в админку
         add_action('woocommerce_product_options_general_product_data', [$this, 'add_custom_fields']);
         add_action('woocommerce_process_product_meta', [$this, 'save_custom_fields']);
     }
 
     // Добавление полей в админку WooCommerce
     public function add_custom_fields() {
         global $post;
         $custom_fields = get_post_meta($post->ID, '_custom_fields_group', true) ?: [];
 
         echo '<div class="options_group">';
         echo '<div id="extra-fields-wrapper">';
 
         // Отображение существующих полей
         if (!empty($custom_fields)) {
             foreach ($custom_fields as $index => $field_group) {
                 $this->render_field_group($index, $field_group);
             }
         } else {
             $this->render_field_group(0); // Отображаем одну пустую группу, если полей нет
         }
 
         echo '</div>';
         echo '<button type="button" class="button add-extra-field">' . __('Add Field Group', 'woocommerce-extra-fields') . '</button>';
         echo '</div>';
 
         // JS для динамического добавления полей
         $this->enqueue_admin_scripts();
     }
 
     private function render_field_group($index, $field_group = []) {
         $name_price = $field_group['name_price'] ?? '';
         $code_excel = $field_group['code_excel'] ?? '';
         $price = $field_group['price'] ?? '';
         $price_message = $field_group['price_message'] ?? '';
 
         echo '<div class="extra-field-group">';
         echo '<p><strong>' . __('Field Group (дополнительная цена)', 'woocommerce-extra-fields') . ' ' . ($index + 1) . '</strong></p>';
         woocommerce_wp_text_input([
             'id' => "extra_fields[$index][name_price]",
             'label' => __('Name Price', 'woocommerce-extra-fields'),
             'value' => $name_price,
         ]);
         woocommerce_wp_text_input([
             'id' => "extra_fields[$index][code_excel]",
             'label' => __('Code Excel', 'woocommerce-extra-fields'),
             'value' => $code_excel,
         ]);
         woocommerce_wp_text_input([
             'id' => "extra_fields[$index][price]",
             'label' => __('Price', 'woocommerce-extra-fields'),
             'value' => $price,
         ]);
         woocommerce_wp_text_input([
             'id' => "extra_fields[$index][price_message]",
             'label' => __('Price Message', 'woocommerce-extra-fields'),
             'value' => $price_message,
         ]);
         echo '<button type="button" class="button remove-extra-field">' . __('Remove', 'woocommerce-extra-fields') . '</button>';
         echo '<hr>';
         echo '</div>';
     }
 
     // Сохранение полей в метаданные товара
     public function save_custom_fields($post_id) {
         if (isset($_POST['extra_fields']) && is_array($_POST['extra_fields'])) {
             $sanitized_fields = [];
             foreach ($_POST['extra_fields'] as $field_group) {
                 $sanitized_fields[] = [
                     'name_price' => sanitize_text_field($field_group['name_price']),
                     'code_excel' => sanitize_text_field($field_group['code_excel']),
                     'price' => sanitize_text_field($field_group['price']),
                     'price_message' => sanitize_text_field($field_group['price_message']),
                 ];
             }
             update_post_meta($post_id, '_custom_fields_group', $sanitized_fields);
         }
     }
 
     // Подключение скриптов для админки
     private function enqueue_admin_scripts() {
         ?>
         <script>
         jQuery(document).ready(function($) {
             let fieldIndex = <?php echo json_encode(count(get_post_meta(get_the_ID(), '_custom_fields_group', true) ?: [])); ?>;
 
             // Добавление новой группы полей
             $('.add-extra-field').on('click', function() {
                 const newFieldGroup = `
                 <div class="extra-field-group">
                     <p><strong><?php echo __('Field Group', 'woocommerce-extra-fields'); ?> ${fieldIndex + 1}</strong></p>
                     <p class="form-field">
                         <label for="extra_fields[${fieldIndex}][name_price]"><?php echo __('Name Price', 'woocommerce-extra-fields'); ?></label>
                         <input type="text" id="extra_fields[${fieldIndex}][name_price]" name="extra_fields[${fieldIndex}][name_price]" value="" />
                     </p>
                     <p class="form-field">
                         <label for="extra_fields[${fieldIndex}][code_excel]"><?php echo __('Code Excel', 'woocommerce-extra-fields'); ?></label>
                         <input type="text" id="extra_fields[${fieldIndex}][code_excel]" name="extra_fields[${fieldIndex}][code_excel]" value="" />
                     </p>
                     <p class="form-field">
                         <label for="extra_fields[${fieldIndex}][price]"><?php echo __('Price', 'woocommerce-extra-fields'); ?></label>
                         <input type="text" id="extra_fields[${fieldIndex}][price]" name="extra_fields[${fieldIndex}][price]" value="" />
                     </p>
                     <p class="form-field">
                         <label for="extra_fields[${fieldIndex}][price_message]"><?php echo __('Price Message', 'woocommerce-extra-fields'); ?></label>
                         <input type="text" id="extra_fields[${fieldIndex}][price_message]" name="extra_fields[${fieldIndex}][price_message]" value="" />
                     </p>
                     <button type="button" class="button remove-extra-field"><?php echo __('Remove', 'woocommerce-extra-fields'); ?></button>
                     <hr>
                 </div>`;
                 $('#extra-fields-wrapper').append(newFieldGroup);
                 fieldIndex++;
             });
 
             // Удаление группы полей
             $(document).on('click', '.remove-extra-field', function() {
                 $(this).closest('.extra-field-group').remove();
             });
         });
         </script>
         <?php
     }
 }
 
 // Инициализация плагина
 new WooCommerce_Extra_Fields();
 