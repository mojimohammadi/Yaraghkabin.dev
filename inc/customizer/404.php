<?php

// Block direct access to the main plugin file.

use ahura\app\customization\ios_checkbox;
use ahura\app\customization\simple_text;
use ahura\app\customization\simple_select_box;

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

$wp_customize->add_section( 'ahura_404' , array(
      'title'      => __( '404 Settings', 'ahura' ),
      'priority'   => 7,
));

$wp_customize->add_setting('use_custom_404_page');
$custom404Args = [
    'label' => __('Use custom 404 Page','ahura'),
    'section' => 'ahura_404',
];
if(!\ahura\app\mw_options::is_ahura_builder_accessible())
{
    $customFooterArgs['input_attrs']['disabled'] = true;
    $customFooterArgs['description'] = esc_html__('Install Elementor plugin to use this option', 'ahura');
}
$wp_customize->add_control(new ios_checkbox($wp_customize, 'use_custom_404_page', $custom404Args));

$pages_arr = array();
if(class_exists('\ahura\app\elementor\Ahura_Elementor_Builder'))
{
    $pages_cls = new \ahura\app\elementor\Ahura_Elementor_Builder();
    $pages = $pages_cls->getTemplates();
    if($pages){
        foreach($pages as $page) {
            $pages_arr[$page->ID] = $page->post_title;
        }
    }
}else{
    $pages_arr[0] = esc_html__('Nothing found', 'ahura');
}

$custom_404_id = get_theme_mod('custom_404_page') ? get_theme_mod('custom_404_page') : 0;
$wp_customize->add_setting('custom_404_page');
$wp_customize->add_control(new simple_select_box($wp_customize, 'custom_404_page', [
    'section' => 'ahura_404',
    'label' => __('Custom 404 Page', 'ahura'),
    'choices' => $pages_arr,
    'input_attrs' => [
        'load-ajax' => true,
        'class' => 'ahura-section-select-on-change ahura-section-select-ajax-load-options',
        'data-affected' => '.page-404-select-on-change-affected',
        'data-affected-attr' => 'href',
        'data-affected-pattern' => 'post=(.*)&',
    ],
    'links' => [
        [
            'title' => esc_html__('All Pages', 'ahura'),
            'url' => admin_url('edit.php?post_type=section_builder'),
            'target' => '_blank'
        ],
        [
            'title' => esc_html__('Edit Page', 'ahura'),
            'url' => admin_url("post.php?post={$custom_404_id}&action=elementor"),
            'target' => '_blank',
            'class' => 'page-404-select-on-change-affected'
        ],
        [
            'title' => esc_html__('Create a new Page', 'ahura'),
            'url' => admin_url('post-new.php?post_type=section_builder'),
            'target' => '_blank'
        ],
    ],
    'active_callback' => ['\ahura\app\mw_options','get_mod_is_active_custom_404_page'],
]));

$wp_customize->add_setting('ahura_404_show_text',['default'=>true]);
$wp_customize->add_control(new ios_checkbox($wp_customize, 'ahura_404_show_text',[
    'label' => __( 'Show Text', 'ahura' ),
    'section' => 'ahura_404',
    'active_callback' => ['\ahura\app\mw_options','get_mod_is_not_active_custom_404_page'],
]));
$wp_customize->add_setting('ahura_404_text',['default'=>__('Page Not Found!','ahura')]);
$wp_customize->add_control(new simple_text($wp_customize, 'ahura_404_text',[
    'label' => __( 'Text', 'ahura' ),
    'section' => 'ahura_404',
    'active_callback' => ['\ahura\app\mw_options','get_mod_is_not_active_custom_404_page'],
]));
$wp_customize->add_setting('ahura_404_show_image',['default'=>true]);
$wp_customize->add_control(new ios_checkbox($wp_customize, 'ahura_404_show_image',[
    'label' => __( 'Show Image', 'ahura' ),
    'section' => 'ahura_404',
    'active_callback' => ['\ahura\app\mw_options','get_mod_is_not_active_custom_404_page'],
]));
$wp_customize->add_setting('ahura_404_image');
$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'ahura_404_image',[
    'label' => __( 'Image', 'ahura' ),
    'section' => 'ahura_404',
    'settings' => 'ahura_404_image',
    'active_callback' => ['\ahura\app\mw_options','get_mod_is_not_active_custom_404_page'],
]));
$wp_customize->add_setting('ahura_404_show_go_home');
$wp_customize->add_control(new ios_checkbox($wp_customize, 'ahura_404_show_go_home',[
    'label' => __( 'Show Go Back Button', 'ahura' ),
    'section' => 'ahura_404',
    'active_callback' => ['\ahura\app\mw_options','get_mod_is_not_active_custom_404_page'],
]));
$wp_customize->add_setting('ahura_404_go_home_text',['default'=>__('Title Here','ahura')]);
$wp_customize->add_control(new simple_text($wp_customize, 'ahura_404_go_home_text',[
    'label' => __( 'Go Back Button Text', 'ahura' ),
    'section' => 'ahura_404',
    'active_callback' => ['\ahura\app\mw_options','get_mod_is_not_active_custom_404_page'],
]));
$wp_customize->add_setting('ahura_404_go_home_url');
$wp_customize->add_control(new simple_text($wp_customize, 'ahura_404_go_home_url',[
    'label' => __( 'Go Back Button Text URL', 'ahura' ),
    'section' => 'ahura_404',
    'active_callback' => ['\ahura\app\mw_options','get_mod_is_not_active_custom_404_page'],
]));
$wp_customize->add_setting('ahura_404_go_home_background_color');
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'ahura_404_go_home_background_color',[
    'label' => __( 'Go Back Button Background Color', 'ahura' ),
    'section' => 'ahura_404',
    'settings' => 'ahura_404_go_home_background_color',
    'active_callback' => ['\ahura\app\mw_options','get_mod_is_not_active_custom_404_page'],
]));
$wp_customize->add_setting('ahura_404_go_home_color');
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'ahura_404_go_home_color',[
    'label' => __( 'Go Back Button Text Color', 'ahura' ),
    'section' => 'ahura_404',
    'settings' => 'ahura_404_go_home_color',
    'active_callback' => ['\ahura\app\mw_options','get_mod_is_not_active_custom_404_page'],
]));
$wp_customize->add_setting('ahura_404_go_home_border_radius');
$wp_customize->add_control(new simple_text($wp_customize, 'ahura_404_go_home_border_radius',[
    'label' => __( 'Go Back Button Border Radius', 'ahura' ),
    'section' => 'ahura_404',
    'type' => 'number',
    'active_callback' => ['\ahura\app\mw_options','get_mod_is_not_active_custom_404_page'],
]));
$wp_customize->add_setting('ahura_404_go_home_shadow_color');
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'ahura_404_go_home_shadow_color',[
    'label' => __( 'Go Back Button Shadow Color', 'ahura' ),
    'section' => 'ahura_404',
    'settings' => 'ahura_404_go_home_shadow_color',
    'active_callback' => ['\ahura\app\mw_options','get_mod_is_not_active_custom_404_page'],
]));