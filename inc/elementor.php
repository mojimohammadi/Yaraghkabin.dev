<?php
/**
 *
 * Block direct access to the main plugin file.
 *
 */
defined('ABSPATH') or die('No script kiddies please!');
final class Ahura_Elementor_Init {
    const VERSION = '1';
    const MINIMUM_ELEMENTOR_VERSION = '2.0.0';
    const MINIMUM_PHP_VERSION = '7.0';

    private $widgets = [];
    private $namespace = 'widget';

    private static $_instance = null;

    /**
     *
     *
     * Ahura_Elementor_Init singleton
     *
     */
    public static function instance()
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new self();
        }

        return self::$_instance;
    }

    /**
     *
     *
     * Ahura_Elementor_Init construction
     *
     */
    public function __construct()
    {
        add_action('admin_notices', [$this, '_check_requirements_minimum_version']);

        add_action('elementor/widgets/register', [$this, 'widgets_registered']);

        $this->load_settings();
    }

    /**
     * Elements settings
     *
     * @return void
     */
    private function load_settings(){
        $settings = [
            'User_Visibility'
        ];

        if($settings){
            foreach($settings as $setting){
                $base_path = '/app/elementor/';
                $namespace = '\ahura\app\elementor\settings';
                $cls_name = $namespace . '\\' . $setting;

                if(!class_exists('\ahura\app\elementor\Ahura_Elements_Settings')){
                    $class_path = get_parent_theme_file_path($base_path . 'Ahura_Elements_Settings.php');
                    if(file_exists($class_path) && is_readable($class_path)){
                        require_once($class_path);
                    }
                }

                if(!class_exists($cls_name)){
                    $class_path = get_parent_theme_file_path('/app/elementor/settings/' . $setting . '.php');
                    if(file_exists($class_path) && is_readable($class_path)){
                        require_once($class_path);
                    }
                }

                if(class_exists($cls_name)){
                    $cls_name::instance();
                }
            }
        }
    }

    /**
     * Elementor register widgets
     *
     * @return void
     */
    private function register_widgets(){
        /**
         * Section Global widgets
         */
        $this->register_widget('grid_posts');
        $this->register_widget('grid_posts2');
        $this->register_widget('grid_posts3');
        $this->register_widget('grid_posts4');
        $this->register_widget('grid_posts5');
        $this->register_widget('grid_posts6');
        $this->register_widget('grid_posts7');
        $this->register_widget('grid_posts8');
        $this->register_widget('grid_posts9');
        $this->register_widget('grid_posts10');
        $this->register_widget('grid_posts11');
        $this->register_widget('grid_posts_12');
        $this->register_widget('grid_products');
        $this->register_widget('grid_products2');
        $this->register_widget('blog_box_posts');
        $this->register_widget('blog_box_posts2');
        $this->register_widget('item_portfolio');
        $this->register_widget('post_archive');
        $this->register_widget('post_archive2');
        $this->register_widget('post_carousel');
        $this->register_widget('post_carousel2');
        $this->register_widget('post_carousel3');
        $this->register_widget('post_carousel_4');
        $this->register_widget('post_list');
        $this->register_widget('post_list2');
        $this->register_widget('post_list3');
        $this->register_widget('post_list4');
        $this->register_widget('post_list_5');
        $this->register_widget('post_list_6');
        $this->register_widget('post_grid_tab');
        $this->register_widget('product_pricebox_1');
        $this->register_widget('shop_carousel');
        $this->register_widget('shop_carousel2');
        $this->register_widget('shop_carousel3');
        $this->register_widget('shop_carousel4');
        $this->register_widget('shop_carousel5');
        $this->register_widget('bestseller_carousel');
        $this->register_widget('shop_category');
        $this->register_widget('shop_category1');
        $this->register_widget('shop_category2');
        $this->register_widget('shop_category3');
        $this->register_widget('shop_category4');
        $this->register_widget('shop_category5');
        $this->register_widget('shop_category6');
        $this->register_widget('iconbox');
        $this->register_widget('icon_box_2');
        $this->register_widget('icon_box_3');
        $this->register_widget('icon_box_4');
        $this->register_widget('icon_box_5');
        $this->register_widget('item_videobox');
        $this->register_widget('imgbox');
        $this->register_widget('imgbox2');
        $this->register_widget('imgbox3');
        $this->register_widget('item_call_action');
        $this->register_widget('shop_countdown');
        $this->register_widget('countdown');
        $this->register_widget('countdown3');
        $this->register_widget('search_input');
        $this->register_widget('services_box');
        $this->register_widget('services_box2');
        $this->register_widget('services_box3');
        $this->register_widget('special_title');
        $this->register_widget('circular_box');
        $this->register_widget('banner_box_1');
        $this->register_widget('banner_box_2');
        $this->register_widget('banner_box_3');
        $this->register_widget('banner_box_4');
        $this->register_widget('banner_box_5');
        $this->register_widget('notice');
        $this->register_widget('notice_box_2');
        $this->register_widget('notice_box_3');
        $this->register_widget('typewriter');
        $this->register_widget('colorful_title');
        $this->register_widget('colorful_title2');
        $this->register_widget('radio_post');
        $this->register_widget('suggestion_posts');
        $this->register_widget('introduction_box');
        $this->register_widget('mailer_lite');
        $this->register_widget('mailer_lite2');
        $this->register_widget('price_table');
        $this->register_widget('service_price_box');
        $this->register_widget('price_box_2');
        $this->register_widget('price_box_3');
        $this->register_widget('price_box_4');
        $this->register_widget('price_box_5');
        $this->register_widget('price_box_6');
        $this->register_widget('price_box_7');
        $this->register_widget('price_box_8');
        $this->register_widget('price_box_9');
        $this->register_widget('price_box_10');
        $this->register_widget('price_box_11');
        $this->register_widget('php_snippet');
        $this->register_widget('image_box');
        $this->register_widget('information_box');
        $this->register_widget('information_box_2');
        $this->register_widget('information_box_3');
        $this->register_widget('information_box_4');
        $this->register_widget('information_box_5');
        $this->register_widget('information_box_6');
        $this->register_widget('information_box_7');
        $this->register_widget('information_box_8');
        $this->register_widget('information_box_9');
        $this->register_widget('information_box_10');
        $this->register_widget('testimonial_box1');
        $this->register_widget('testimonial_box2');
        $this->register_widget('testimonial_box3');
        $this->register_widget('testimonial_box4');
        $this->register_widget('testimonial_box5');
        $this->register_widget('testimonial_box6');
        $this->register_widget('testimonial_carousel');
        $this->register_widget('testimonial_carousel2');
        $this->register_widget('testimonial_carousel3');
        $this->register_widget('testimonial_carousel4');
        $this->register_widget('testimonial_carousel5');
        $this->register_widget('testimonial_carousel6');
        $this->register_widget('category_box');
        $this->register_widget('items_carousel');
        $this->register_widget('video_carousel');
        $this->register_widget('video_carousel2');
        $this->register_widget('video_post_grid');
        $this->register_widget('timeline');
        $this->register_widget('timeline_2');
        $this->register_widget('navbar');
        $this->register_widget('navbar2');
        $this->register_widget('navbar3');
        $this->register_widget('product_tab');
        $this->register_widget('product_tab2');
        $this->register_widget('product_box_carousel');
        $this->register_widget('product_customers');
        $this->register_widget('breadcrumb');
        $this->register_widget('sound_player');
        $this->register_widget('video_player');
        $this->register_widget('offer_carousel');
        $this->register_widget('image_slider');
        $this->register_widget('image_slider2');
        $this->register_widget('image_slider3');
        $this->register_widget('templates_carousel');
        $this->register_widget('mapbox_1');
        $this->register_widget('neshan_map');
        $this->register_widget('alert_box');
        $this->register_widget('double_button');
        $this->register_widget('before_after');
        $this->register_widget('products_category');
        $this->register_widget('products_category2');
        $this->register_widget('team_members');
        $this->register_widget('gallery');
        $this->register_widget('story');
        $this->register_widget('brands');
        $this->register_widget('card_box');
        $this->register_widget('card_box_2');
        $this->register_widget('card_box_3');
        $this->register_widget('card_box_4');
        $this->register_widget('modal_video');
        $this->register_widget('faq');
        $this->register_widget('faq_2');
        $this->register_widget('faq_3');
        $this->register_widget('lottie');
    }

    /**
     * Registered widgets append to elementor
     *
     * @return void
     */
    public function widgets_registered($widgets_manager){
        $this->register_widgets();

        $widgets = $this->get_widgets();

        if($widgets && is_array($widgets)){
            foreach($widgets as $widget){
                $class_name = $widget['namespace'] . '\\' . $widget['widget'];
                $post_type = !empty($widget['post_type']) ? $widget['post_type'] : '';
                $check_disabled = ($widget['check_disabled'] == true);

                if(class_exists($class_name)){
                    $class = new $class_name();
                    if($post_type){
                        if($check_disabled && post_type_exists($post_type) && !\ahura\app\mw_post_type::is_disabled_post_type($post_type)){
                            $widgets_manager->register($class);
                        } elseif(post_type_exists($post_type)){
                            $widgets_manager->register($class);
                        }
                    } else {
                        $widgets_manager->register($class);
                    }
                }
            }
        }

        /**
         * Ahura section builder
         */
        require_once(__DIR__ . '/widgets/section_builder/logo.php');
        $widgets_manager->register(new \Elementor_ahura_logo());

        require_once(__DIR__ . '/widgets/section_builder/logo_svg.php');
        $widgets_manager->register(new \Elementor_ahura_logo_svg());

        require_once(__DIR__ . '/widgets/section_builder/popup_search.php');
        $widgets_manager->register(new \Ahura_Popup_Search());

        require_once(__DIR__ . '/widgets/section_builder/search.php');
        $widgets_manager->register(new \Ahura_Search());

        require_once(__DIR__ . '/widgets/section_builder/menu.php');
        $widgets_manager->register(new \Ahura_Menu());

        require_once(__DIR__ . '/widgets/section_builder/menu2.php');
        $widgets_manager->register(new \Ahura_Menu2());

        require_once(__DIR__ . '/widgets/section_builder/main_menu.php');
        $widgets_manager->register(new \Ahura_Main_Menu());

        require_once(__DIR__ . '/widgets/section_builder/mega_menu.php');
        $widgets_manager->register(new \Ahura_Mega_Menu());

        require_once(__DIR__ . '/widgets/section_builder/mega_menu2.php');
        $widgets_manager->register(new \Ahura_Mega_Menu2());

        require_once(__DIR__ . '/widgets/section_builder/mobile_menu.php');
        $widgets_manager->register(new \Ahura_Mobile_Menu());

        require_once(__DIR__ . '/widgets/section_builder/mobile_menu2.php');
        $widgets_manager->register(new \Ahura_Mobile_Menu2());

        require_once(__DIR__ . '/widgets/section_builder/mini_cart.php');
        $widgets_manager->register(new \Ahura_Mini_Cart());

        require_once(__DIR__ . '/widgets/section_builder/mini_cart2.php');
        $widgets_manager->register(new \Ahura_Mini_Cart2());

        require_once(__DIR__ . '/widgets/section_builder/popup_login.php');
        $widgets_manager->register(new \Ahura_Popup_Login());
    }

    /**
     * Elements namespaces
     *
     * @return string
     */
    private function get_namespace(){
        $namespaces = array(
            'widget' => 'ahura\inc\widgets',
            'builder' => 'ahura\inc\widgets\section_builder',
        );

        return (!empty($this->namespace) && isset($namespaces[$this->namespace])) ? $namespaces[$this->namespace] : $this->namespace;
    }

    /**
     * Set widget class namespace
     *
     * @param string $namespace
     * @return object
     */
    private function namespace($namespace = 'widget'){
        $this->namespace = $namespace;
        return $this;
    }

    /**
     * Register a widget
     *
     * @param string $widget
     * @param string $post_type
     * @param boolean $check_disabled_post_type
     * @return void
     */
    private function register_widget($widget, $post_type = '', $check_disabled_post_type = false){
        $this->widgets[] = ['namespace' => $this->get_namespace(), 'widget' => $widget, 'post_type' => $post_type, 'check_disabled' => $check_disabled_post_type];
    }

    /**
     * Get registered widgets
     *
     * @return array
     */
    public function get_widgets(){
        return $this->widgets;
    }

    /**
     * Generate html notice minimum version
     *
     * @param string $property
     * @param string $minimum_version
     * @return string
     */
    public function _notice_minimum_version($property, $minimum_version, $current_version, $notice_type = 'warning'){
        if((!empty($minimum_version) && !empty($current_version)) && version_compare($current_version, $minimum_version, '<')){
            $str_before = '<strong>';
            $str_after = '</strong>';
            $message = sprintf(
                esc_html__('"%1$s" requires "%2$s" version %3$s or greater.', 'ahura'),
                $str_before . esc_html__('Ahura', 'ahura') . $str_after,
                $str_before . esc_html__($property, 'ahura') . $str_after,
                $minimum_version
            );
            return sprintf('<div class="notice notice-%1$s is-dismissible"><p>%2$s</p></div>', $notice_type, $message);
        }
        return false;
    }

    /**
     * Elementor minimum version check notice
     *
     * @return string
     */
    public function _check_requirements_minimum_version(){
        echo $this->_notice_minimum_version('Elementor', self::MINIMUM_ELEMENTOR_VERSION, get_option('elementor_version'));
        echo $this->_notice_minimum_version('PHP', self::MINIMUM_PHP_VERSION, PHP_VERSION);
    }
}

Ahura_Elementor_Init::instance();

function register_elementor_controls($controls_manager)
{
    /**
     *
     * Controls class name
     *
     */
    $controls = [
        'Control_Jdate_Picker',
    ];
    if ($controls) {
        foreach ($controls as $control) {
            $class = '\ahura\app\elementor\controls' . '\\' . $control;
            if (class_exists($class) && method_exists($class, 'get_type')) {
                $class = new $class();
                $controls_manager->register($class);
            }
        }
    }
}

add_action('elementor/controls/register', 'register_elementor_controls');

function add_elementorahura_widget_categories($elements_manager)
{
    $elements_manager->add_category(
        'ahuraelements',
        [
            'title' => __('Ahura Elements', 'ahura'),
            'icon' => 'fa fa-plug',
        ]
    );
    $elements_manager->add_category(
        'ahura_posts',
        [
            'title' => __("Ahura Posts", 'ahura'),
        ]
    );
    $elements_manager->add_category(
        'ahura_price_box',
        [
            'title' => __("Ahura Price Box", 'ahura'),
        ]
    );
    $elements_manager->add_category(
        'ahurabuilder',
        [
            'title' => __('Ahura Builder', 'ahura'),
            'icon' => 'fa fa-plug',
        ]
    );
    $elements_manager->add_category(
        'ahuranavbar',
        [
            'title' => __('Ahura Navbar Elements', 'ahura'),
            'icon' => 'fa fa-plug',
        ]
    );
}

add_action('elementor/elements/categories_registered', 'add_elementorahura_widget_categories');