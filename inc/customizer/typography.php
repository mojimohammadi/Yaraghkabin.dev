<?php
use ahura\app\customization\ios_checkbox;
use ahura\app\customization\simple_text;
use ahura\app\customization\simple_select_box;
use ahura\app\customization\simple_notice;
use \ahura\app\mw_options;

// Block direct access to the main plugin file.
defined('ABSPATH') or die('No script kiddies please!');

$wp_customize->add_section('ahura_typography', array(
    'title' => __('Typography', 'ahura'),
    'priority' => 1,
));

if (get_bloginfo('language') == 'fa-IR') {
    $wp_customize->add_setting('ahura_theme_font', ['default' => 'iransans']);
    $wp_customize->add_control('ahura_theme_font', [
        'section' => 'ahura_typography',
        'type' => 'select',
        'label' => __("Theme Font", 'ahura'),
        'choices' => mw_options::get_ahura_fonts()
    ]);
} else {
    $wp_customize->add_setting('use_fa_fonts', ['default' => false]);
    $wp_customize->add_control(new ios_checkbox($wp_customize, 'use_fa_fonts',array(
        'section' => 'ahura_typography',
        'label' => __( 'Use FA Fonts', 'ahura' ),
    )));

    $wp_customize->add_setting('ahura_use_fa_fonts_notice');
    $wp_customize->add_control( new simple_notice($wp_customize, 'ahura_use_fa_fonts_notice',[
        'description' => __('After enabled the use of FA fonts, you must reload the page.', 'ahura'),
        'section' => 'ahura_typography',
        'active_callback' => ['\ahura\app\mw_options','get_mod_not_use_fa_fonts_status'],
        ]
    ));

    $wp_customize->add_setting('ahura_en_theme_font', ['default' => 'default_font']);
    $wp_customize->add_control('ahura_en_theme_font', [
        'section' => 'ahura_typography',
        'type' => 'select',
        'label' => "Theme Font",
        'choices' => mw_options::get_ahura_fonts()
    ]);
}

$wp_customize->add_setting('ahura_theme_font_weight', ['default' => 'normal']);
$wp_customize->add_control('ahura_theme_font_weight', [
    'section' => 'ahura_typography',
    'type' => 'select',
    'label' => __("Font Weight", 'ahura'),
    'choices' => mw_options::get_font_weights()
]);

$wp_customize->add_setting('ahura_menu_font_family');
$wp_customize->add_control('ahura_menu_font_family', [
    'section' => 'ahura_typography',
    'type' => 'select',
    'label' => __('Menu Font Family', 'ahura'),
    'choices' => mw_options::get_ahura_fonts(),
]);

$wp_customize->add_setting('ahura_menu_font_weight', ['default' => 'normal']);
$wp_customize->add_control('ahura_menu_font_weight', [
    'section' => 'ahura_typography',
    'type' => 'select',
    'label' => __("Font Weight", 'ahura'),
    'choices' => mw_options::get_font_weights()
]);

$wp_customize->add_setting('ahura_mega_menu_font_family');
$wp_customize->add_control('ahura_mega_menu_font_family', [
    'section' => 'ahura_typography',
    'type' => 'select',
    'label' => __('Mega Menu Font Family', 'ahura'),
    'choices' => mw_options::get_ahura_fonts(),
]);

$wp_customize->add_setting('ahura_mega_menu_font_weight', ['default' => 'normal']);
$wp_customize->add_control('ahura_mega_menu_font_weight', [
    'section' => 'ahura_typography',
    'type' => 'select',
    'label' => __("Font Weight", 'ahura'),
    'choices' => mw_options::get_font_weights()
]);

$wp_customize->add_setting('ahura_footer_widget_font_family');
$wp_customize->add_control('ahura_footer_widget_font_family', [
    'section' => 'ahura_typography',
    'type' => 'select',
    'label' => __('Footer Widget Title Font Family', 'ahura'),
    'choices' => mw_options::get_ahura_fonts(),
]);

$wp_customize->add_setting('ahura_footer_widget_font_weight', ['default' => 'normal']);
$wp_customize->add_control('ahura_footer_widget_font_weight', [
    'section' => 'ahura_typography',
    'type' => 'select',
    'label' => __("Font Weight", 'ahura'),
    'choices' => mw_options::get_font_weights()
]);

$wp_customize->add_setting('ahura_paragraph_alignment', ['default' => false]);
$wp_customize->add_control(new ios_checkbox($wp_customize, 'ahura_paragraph_alignment', [
    'section' => 'ahura_typography',
    'label' => __('Justify paragraph', 'ahura'),
]));
$wp_customize->add_setting('ahura_light_font');
$wp_customize->add_control(new ios_checkbox($wp_customize, 'ahura_light_font', [
    'section' => 'ahura_typography',
    'label' => __('Remove Light Font Weight', 'ahura'),
]));
$wp_customize->add_setting('ahura_ultralight_font');
$wp_customize->add_control(new ios_checkbox($wp_customize, 'ahura_ultralight_font', [
    'section' => 'ahura_typography',
    'label' => __('Remove UltraLight Font Weight', 'ahura'),
]));
$wp_customize->add_setting('ahura_medium_font');
$wp_customize->add_control(new ios_checkbox($wp_customize, 'ahura_medium_font', [
    'section' => 'ahura_typography',
    'label' => __('Remove Medium Font Weight', 'ahura'),
]));
$wp_customize->add_setting('ahura_bold_font');
$wp_customize->add_control(new ios_checkbox($wp_customize, 'ahura_bold_font', [
    'section' => 'ahura_typography',
    'label' => __('Remove Bold Font Weight', 'ahura'),
]));
$wp_customize->add_setting('ahura_black_font');
$wp_customize->add_control(new ios_checkbox($wp_customize, 'ahura_black_font', [
    'section' => 'ahura_typography',
    'label' => __('Remove Black Font Weight', 'ahura'),
]));
$wp_customize->add_setting('ahura_footer_widget_font_color');
$wp_customize->add_control('ahura_footer_widget_font_color', [
    'section' => 'ahura_typography',
    'type' => 'color',
    'label' => __('Footer Widget Title Color', 'ahura'),
]);

$wp_customize->add_setting('ahura_logo_text_font_size');
$wp_customize->add_control(new simple_text($wp_customize, 'ahura_logo_text_font_size', [
    'section' => 'ahura_typography',
    'type' => 'number',
    'label' => __('Logo Text Font Size', 'ahura'),
    'active_callback' => function(){
        return !\ahura\app\mw_options::get_mod_logo_option();
    }
]));

$wp_customize->add_setting('ahura_menu_font_size');
$wp_customize->add_control(new simple_text($wp_customize, 'ahura_menu_font_size', [
    'section' => 'ahura_typography',
    'type' => 'number',
    'label' => __('Menu Font Size', 'ahura'),
]));


$wp_customize->add_setting('ahura_popup_login_font_size');
$wp_customize->add_control(new simple_text($wp_customize, 'ahura_popup_login_font_size', [
    'section' => 'ahura_typography',
    'type' => 'number',
    'label' => __('Popup Login Font Size', 'ahura'),
]));

$wp_customize->add_setting('ahura_mega_menu_font_size');
$wp_customize->add_control(new simple_text($wp_customize, 'ahura_mega_menu_font_size', [
    'section' => 'ahura_typography',
    'type' => 'number',
    'label' => __('Mega Menu Font Size', 'ahura'),
]));


$wp_customize->add_setting('ahura_heading_1_size');
$wp_customize->add_control(new simple_text($wp_customize, 'ahura_heading_1_size', [
    'section' => 'ahura_typography',
    'type' => 'number',
    'label' => __('Heading 1 Font Size', 'ahura'),
]));
$wp_customize->add_setting('ahura_h1_font_weight');
$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'ahura_h1_font_weight', array(
    'label' => __('H1 font weight', 'ahura'),
    'section' => 'ahura_typography',
    'type'  =>  'select',
    'choices' => mw_options::get_font_weights()
)));
$wp_customize->add_setting('ahura_heading_2_size');
$wp_customize->add_control(new simple_text($wp_customize, 'ahura_heading_2_size', [
    'section' => 'ahura_typography',
    'type' => 'number',
    'label' => __('Heading 2 Font Size', 'ahura'),
]));
$wp_customize->add_setting('ahura_h2_font_weight');
$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'ahura_h2_font_weight', array(
    'label' => __('H2 font weight', 'ahura'),
    'section' => 'ahura_typography',
    'type'  =>  'select',
    'choices' => mw_options::get_font_weights()
)));
$wp_customize->add_setting('ahura_heading_3_size');
$wp_customize->add_control(new simple_text($wp_customize, 'ahura_heading_3_size', [
    'section' => 'ahura_typography',
    'type' => 'number',
    'label' => __('Heading 3 Font Size', 'ahura'),
]));
$wp_customize->add_setting('ahura_h3_font_weight');
$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'ahura_h3_font_weight', array(
    'label' => __('H3 font weight', 'ahura'),
    'section' => 'ahura_typography',
    'type'  =>  'select',
    'choices' => mw_options::get_font_weights()
)));
$wp_customize->add_setting('ahura_heading_4_size');
$wp_customize->add_control(new simple_text($wp_customize, 'ahura_heading_4_size', [
    'section' => 'ahura_typography',
    'type' => 'number',
    'label' => __('Heading 4 Font Size', 'ahura'),
]));
$wp_customize->add_setting('ahura_h4_font_weight');
$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'ahura_h4_font_weight', array(
    'label' => __('H4 font weight', 'ahura'),
    'section' => 'ahura_typography',
    'type'  =>  'select',
    'choices' => mw_options::get_font_weights()
)));
$wp_customize->add_setting('ahura_heading_5_size');
$wp_customize->add_control(new simple_text($wp_customize, 'ahura_heading_5_size', [
    'section' => 'ahura_typography',
    'type' => 'number',
    'label' => __('Heading 5 Font Size', 'ahura'),
]));
$wp_customize->add_setting('ahura_h5_font_weight');
$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'ahura_h5_font_weight', array(
    'label' => __('H5 font weight', 'ahura'),
    'section' => 'ahura_typography',
    'type'  =>  'select',
    'choices' => mw_options::get_font_weights()
)));
$wp_customize->add_setting('ahura_heading_6_size');
$wp_customize->add_control(new simple_text($wp_customize, 'ahura_heading_6_size', [
    'section' => 'ahura_typography',
    'type' => 'number',
    'label' => __('Heading 6 Font Size', 'ahura'),
]));
$wp_customize->add_setting('ahura_h6_font_weight');
$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'ahura_h6_font_weight', array(
    'label' => __('H6 font weight', 'ahura'),
    'section' => 'ahura_typography',
    'type'  =>  'select',
    'choices' => mw_options::get_font_weights()
)));
$wp_customize->add_setting('ahura_footer_widget_font_size');
$wp_customize->add_control(new simple_text($wp_customize, 'ahura_footer_widget_font_size', [
    'section' => 'ahura_typography',
    'type' => 'number',
    'input_attrs' => array(
        'min' => 1,
    ),
    'label' => __('Footer Widget Font Size', 'ahura'),
]));

$wp_customize->add_setting('product_title_desktop_font_size');
$wp_customize->add_control(new simple_text($wp_customize, 'product_title_desktop_font_size', [
    'section' => 'ahura_typography',
    'type' => 'number',
    'input_attrs' => array(
        'min' => 1,
    ),
    'label' => __('Main shop product title desktop view Font Size', 'ahura'),
]));

$wp_customize->add_setting('product_title_mobileview_font_size');
$wp_customize->add_control(new simple_text($wp_customize, 'product_title_mobileview_font_size', [
    'section' => 'ahura_typography',
    'type' => 'number',
    'input_attrs' => array(
        'min' => 1,
    ),
    'label' => __('Main shop product title mobile view Font Size', 'ahura'),
]));

$wp_customize->add_setting('price_mobileview_multicol_font_size');
$wp_customize->add_control(new simple_text($wp_customize, 'price_mobileview_multicol_font_size', [
    'section' => 'ahura_typography',
    'type' => 'number',
    'input_attrs' => array(
        'min' => 1,
    ),
    'label' => __('Main shop product price mobile view Font Size', 'ahura'),
]));
$wp_customize->add_setting('ahura_disable_theme_font');
$wp_customize->add_control(new ios_checkbox($wp_customize, 'ahura_disable_theme_font', [
    'section' => 'ahura_typography',
    'label' => __('Disable all fonts', 'ahura'),
]));
$wp_customize->add_setting('ahura_active_another_font_formats');
$wp_customize->add_control(new ios_checkbox($wp_customize, 'ahura_active_another_font_formats', [
    'section' => 'ahura_typography',
    'label' => __('Enable another font formats', 'ahura'),
    'description' => __('By default, only WOFF format is active.', 'ahura'),
    'active_callback' => function(){
        return !get_theme_mod('ahura_disable_theme_font');
    }
]));
