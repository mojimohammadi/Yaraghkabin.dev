<?php
namespace ahura\app;

class Header {
    public static function get_header_dir(){
        $dir = get_template_directory() . '/template-parts/header/styles/';
        $dir = apply_filters('ahura_get_header_dir', $dir);
        return $dir;
    }

    public static function get_header_file($style = null){
        $dir = self::get_header_dir();
        $file_path = $dir . 'header-' . $style . '.php';
        $file_path = apply_filters('ahura_get_header_file_path', $file_path, $style);
        return file_exists($file_path) ? $file_path : false;
    }

    public static function get_header($style = null){
        $is_active_woo = woocommerce::is_active();
        $cart = $is_active_woo ? \WC()->cart : false;
        $cart_items = $cart ? $cart->get_cart() : null;
        $cart_total_price = $cart ? $cart->get_cart_total() : 0;
        $cart_total_items = $cart ? $cart->get_cart_contents_count() : 0;

        $cart_url = $is_active_woo ? wc_get_cart_url() : null;
        $checkout_url = $is_active_woo ? wc_get_checkout_url() : null;

        $menu_position = mw_options::get_mod_header_menu_position();
        $menu_position_sticky = mw_options::get_mod_sticky_header_menu_position();
        $menu_alignment = mw_options::get_mod_header_menu_alignment();
        $is_menu_in_middle = $menu_position == 'middle';
        $middle_menu_class = mw_tools::get_header_middle_section_menu_class();
        $is_sticky_menu = ($menu_position !== $menu_position_sticky && !empty($menu_position_sticky));
        $isset_sticky_menu = has_nav_menu('header_sticky_menu');
        $use_mobile_logo = mw_options::get_mod_theme_use_mobile_logo();
        $mobile_logo = mw_options::get_mod_theme_mobile_logo();
        $show_mode_switcher = mw_options::get_mod_show_theme_mode_switcher();
        $mode_switcher_titles = mw_options::get_mod_show_theme_mode_switcher_titles();
        $dark_mode_logo = mw_options::get_mod_theme_dark_logo();
        $has_dark_mode_logo = mw_options::get_mod_is_active_dark_theme() && $dark_mode_logo;
        $logo_text = mw_options::get_mod_logo_text();
        $login_url = get_ahura_login_url();
        $trs_logo = mw_options::get_mod_ahorua_transparent_logo();
        $has_trs_logo = mw_options::check_is_transparent_header() && $trs_logo;

        $dir = self::get_header_dir();
        $file_path = self::get_header_file($style);

        require_once get_parent_theme_file_path('/template-parts/header/popuplogin.php');

        if($file_path){
            include_once $file_path;
        } else {
            include_once $dir . 'header-1.php';
        }
    }
}