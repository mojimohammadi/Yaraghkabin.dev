<?php
namespace ahura\app;

use ahura\app\mw_assets;
class woocommerce
{
    static function is_active()
    {
        return class_exists('WooCommerce');
    }
    static function is_woocommerce()
    {
        return self::is_active() && is_woocommerce();
    }
    static function is_woocommerce_page()
    {
        return self::is_active() && (is_woocommerce() || is_cart() || is_checkout() || is_account_page());
    }
    static function before_shop_loop_item()
    {
        $terms = wp_get_post_terms(get_the_ID(), 'product_cat', ['fields' => 'names', 'number' => 5]);
        $term_data = '<span class="mw_term_data">';
        foreach ($terms as $term_name) {
            $term_data .= '<span class="mw_term_item">'.$term_name.'</span>';
        }
        $term_data .= '</span>';
        echo '<span class="mw_overly"></span>';
        echo $term_data;
    }
    static function show_product_stock_status()
    {
        global $product;
        echo get_theme_mod('ahura_shop_show_product_stock_status') ? wc_get_stock_html( $product ) : '';
    }
    static function loop_shop_columns()
    {
        return 3;
    }
    static function load_assets()
    {
        $version = \ahura\app\mw_tools::get_theme_version();

        if(self::is_active()){
            // woocommerce.css
            wp_enqueue_style('mw_woocommerce', get_template_directory_uri() . '/css/woocommerce.css', null, $version);

            if(!is_rtl()){
                wp_enqueue_style('mw_woocommerce_ltr', get_template_directory_uri() . '/css/woocommerce_ltr.css', null, $version);
            }

            mw_assets::enqueue_script('woocommerce_variations', mw_assets::get_js('woocommerce_variations'));
        }

        if(self::is_woocommerce_page() || is_shop())
        {
            if(is_cart() || is_product() || is_shop())
            {
                $woocommerce_js = get_template_directory_uri() . '/js/woocommerce.js';
                // woocommerce.js
                wp_enqueue_script('mw_woocommerce', $woocommerce_js, ['jquery'], $version, true);
            }

            if(is_cart() || is_checkout())
            {
                $btn_style = '.woocommerce .button.alt{ background-color: var(--mw_primary_color); color: #222; }';
                wp_add_inline_style('style', $btn_style);
            }
        }
    }
    static function woocommerce_cart_item_thumbnail($thumbnail, $cart_item, $cart_item_key){
        $cart_image_id = $cart_item['data']->get_image_id();
        $image = wp_get_attachment_image($cart_image_id, 'thumbnail');
        return $image;
    }
    static function related_products_args($args)
    {
        $args['posts_per_page'] = 3;
        $args['columns'] = 3;
        return $args;
    }
    static function change_shop_item_count_per_page( $cols ) {
        // $cols contains the current number of products per page based on the value stored on Options –> Reading
        // Return the number of products you wanna show per page.
        $cols = get_theme_mod('ahura_shop_per_page', 9);
        return $cols;
    }
    static function change_sale_text(){
        $text = get_theme_mod('woocommerce_sale_text') ? get_theme_mod('woocommerce_sale_text') : __('Sale!','woocommerce');
        $product_discount_percent = get_theme_mod('ahura_shop_show_product_onsale_percent') ? product_discount_percent().' ' : '';
        return '<span class="onsale">' . Number::numByLang($product_discount_percent . $text) . '</span>';
    }

    public static function add_to_cart_button_with_quantity($params = []){
        global $product;
        if(isset($params['product']) && is_object($params['product'])){
            $product = $params['product'];
        }
        if(is_object($product)){
            echo '<form action="' . esc_url($product->add_to_cart_url()) . '" class="d-flex align-center cart product-quantity-form crousel_addtobtn '. (isset($params['class']) ? $params['class'] : '') .'" method="post" enctype="multipart/form-data">';

            if(!isset($params['with_qty']) || isset($params['with_qty']) && $params['with_qty'] === true){
                echo woocommerce_quantity_input(['min_value' => 1, 'max_value' => (!$product->backorders_allowed() ? $product->get_stock_quantity() : '')]);
            }

            $btn_text = __('Add to Cart', 'ahura');
            if(isset($params['button_text'])){
                $btn_text = $params['button_text'];
            }

            $btn_icon = '';
            if(isset($params['has_button_icon']) && $params['has_button_icon'] === true){
                $btn_icon = '<i class="fa fa-shopping-cart"></i>';
                if(isset($params['button_icon'])){
                    $btn_icon = $params['button_icon'];
                }
            }

            echo '<button type="submit" class="button alt">'. $btn_icon . ' ' . $btn_text .'</button>';
            echo '</form>';
        }
    }

    public static function added_inquiry_text_for_without_products($price, $product){
        if('' === $product->get_price()) {
            $text = \ahura\app\mw_options::get_mod_text_call_for_price_inquery();
            $text = !empty($text) ? $text : esc_html__('Call for price inquiry', 'ahura');
            $btn_text = \ahura\app\mw_options::get_mod_call_for_price_inquery_button_text();
            $btn_url = \ahura\app\mw_options::get_mod_call_for_price_inquery_button_url();
            $output = "<div class='price_on_inquiry'><span>{$text}</span>";
            if(!empty($btn_url) && is_single()){
                $output .= "<a href='{$btn_url}' class='button'>{$btn_text}</a>";
            }
            $output .= "</div>";
            return $output;
        }
    
        return $price;
    }

    public static function change_single_product_add_to_cart_button_text(){
        $status = \ahura\app\mw_options::get_mod_change_add_to_cart_button_text_status();
        $text = \ahura\app\mw_options::get_mod_add_to_cart_button_text();
        if($status && !empty($text)){
            return $text;
        }
        return __('Add to Cart', 'ahura'); 
    }
}
