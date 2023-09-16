<?php
namespace ahura\app;
class mw_config
{
    static function before_mini_cart()
    {
        echo '<div id="mcart-widget" class="mini-cart-header-content">';
    }
    static function after_minicart()
    {
        echo '</div>';
    }
    static function minicart_fragments($fragments)
    {
        ob_start();
        woocommerce_mini_cart();
        $fragments['#mcart-widget'] = ob_get_clean();
        return $fragments;
    }
    static function image_sizes()
    {
        add_image_size('stthumb',600,350, true);
        add_image_size('sqthumb',250,250, true);
        add_image_size('verthumb',500,600, true);
        add_image_size('smthumb',100,100, true);
    }
    static function after_setup_theme()
    {
        self::load_text_domain();
        self::theme_support();
        self::image_sizes();
        self::init_check_license_process();
        self::handle_db_version_changes();
    }
    static function load_text_domain()
    {
        load_theme_textdomain( 'ahura', get_template_directory() . '/languages' );
    }
    static function theme_support()
    {
        add_theme_support('title-tag');
        add_theme_support( 'post-thumbnails' );
        add_theme_support( 'woocommerce', array(
            'thumbnail_image_width' => 300,
            'single_image_width'    => 600,
            'product_grid'          => array(
                'default_rows'    => 4,
                'min_rows'        => 2,
                'max_rows'        => 8,
                'default_columns' => 3,
                'min_columns'     => 2,
                'max_columns'     => 3,
            ),
        ) );
        add_theme_support('wc-product-gallery-zoom');
        add_theme_support('wc-product-gallery-lightbox');
        add_theme_support('wc-product-gallery-slider');

        if(class_exists('LifterLMS')){
            add_theme_support('lifterlms-sidebars');
        }
    }
    static function reset_minicart_template_path($template, $template_name, $template_path)
    {
        if($template_name !== 'cart/mini-cart.php'){
            return $template;
        }
        $woocommerce_path = \WC()->plugin_path();
        $default_path = $woocommerce_path . DIRECTORY_SEPARATOR . 'templates' . DIRECTORY_SEPARATOR;
        // check is mini cart exists in theme
        $mini_cart_template = locate_template([
            trailingslashit($template_path) . $template_name,
            $template_name
        ]);
        if(!$mini_cart_template){
            $mini_cart_template = $default_path . $template_name;
        }
        return $mini_cart_template;
    }
    static function init_check_license_process()
    {
        if(!wp_next_scheduled('ahura_check_license'))
        {
            $hour = mt_rand(0, 23);
            $minute = mt_rand(0, 59);
            $second = mt_rand(0, 59);
            $time = strtotime("Y-m-d {$hour}:{$minute}:{$second}", strtotime('+1 day'));
            wp_schedule_event($time, 'daily', 'ahura_check_license');
        }
    }
    static function handle_upgrader_process_complete($upgrade_object, $options)
    {
        if($options['action'] == 'update' && $options['type'] == 'theme' && in_array('ahura', $options['themes']))
        {
            \ahura\app\customization\customizer_save::generate();
        }
    }

    static function add_theme_settings_menu()
    {
        add_menu_page(
            __( 'Ahura', 'ahura' ),
            __( 'Ahura', 'ahura' ),
            'manage_options',
            'ahura_studio',
            [__CLASS__, 'studio_page_callback'],
            get_template_directory_uri() . '/img/mihanwp.png'
        );
        add_submenu_page('ahura_studio',__('Studio','ahura'),__('Studio','ahura'),'manage_options', 'ahura_studio', [__CLASS__, 'studio_page_callback']);
    }

    static function add_theme_settings_sub_menu()
    {
        add_submenu_page('ahura_studio', __( 'Theme Settings', 'ahura' ), __( 'Theme Settings', 'ahura' ), 'manage_options', 'customize.php');
        if(\ahura\app\mw_options::is_ahura_builder_accessible()){
            add_submenu_page('ahura_studio',__('Section builder','ahura'),__('Builder','ahura'),'manage_options',admin_url().'/edit.php?post_type=section_builder');
        }
        add_submenu_page('ahura_studio',__('Ahura Fonts','ahura'),__('Ahura Fonts','ahura'),'manage_options',admin_url().'/edit.php?post_type=ahura_fonts');
        $childMenuHookSuffix = add_submenu_page('ahura_studio',__('Child theme','ahura'),__('Child theme','ahura'),'manage_options', 'ahura_child_theme', ['\ahura\app\child_theme', 'admin_menu_callback']);
        add_action('load-' . $childMenuHookSuffix, ['\ahura\app\child_theme', 'load_admin_menu_assets']);
    }
    static function handle_db_version_changes()
    {
        $current_version = mw_options::get_db_version();
        if($current_version < AHURA_DB_VERSION)
        {
            if($current_version < 1)
            {
                /**
                 * in this version
                 * custom post type and custom taxonomy was generated
                 * need to rewrite flush rules
                */
                 flush_rewrite_rules();
            }
            mw_options::update_db_version(AHURA_DB_VERSION);
        }
    }
    static function add_custom_upload_mimes($existing_mimes) {
        if(is_admin()){
            $existing_mimes['ttf'] = 'application/x-font-ttf';
            $existing_mimes['svg'] = 'image/svg+xml';
            $existing_mimes['woff'] = 'application/font-woff';
            $existing_mimes['woff2'] = 'application/font-woff2';
            $existing_mimes['eot'] = 'application/vnd.ms-fontobject';
        }
        return $existing_mimes;
    }
    static function set_lifterlms_default_sidebar($id){
        $sidebar_id = 'ahura_llms_primary_sidebar';
        return $sidebar_id;
    }

    /**
     * 
     * 
     * Register default template fullwidth for elementor builder page
     * 
     * 
     */
    static function elementor_builder_default_template_types($template){
		$post_id = get_queried_object_id();

		if (empty($post_id)) {
			return $template;
		}

        if (!empty($post_id)) {
            $template_type = get_post_meta($post_id, '_elementor_template_type', true);
        }
    
        if ('section_builder' !== get_post_type() || !in_array($template_type, ['wp-post', 'page'], true)) {
            return $template;
        }

        if(!class_exists('\ahura\app\elementor\Ahura_Elementor_Builder'))
        {
            return $template;
        }

        $builder = new \ahura\app\elementor\Ahura_Elementor_Builder();

        if($builder->isPreviewMode()){
            add_filter('show_admin_bar', '__return_false');
        }

        return get_parent_theme_file_path('/fullwidth.php');
    } 

    static function studio_page_callback(){
        include_once get_parent_theme_file_path('/template-parts/admin/pages/studio.php');
    }
}