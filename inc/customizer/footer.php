<?php

// Block direct access to the main plugin file.

use ahura\app\customization\image_radio_box;
use ahura\app\customization\ios_checkbox;
use ahura\app\customization\ios_radio_box;
use ahura\app\customization\simple_text;
use ahura\app\customization\simple_select_box;
use ahura\app\customization\icon_selector;

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );
$wp_customize->add_section( 'ahura_custom_footer' , array(
    'title'      => __('Footer','ahura'),
    'priority'   => 3,
) );

$footers_arr = array();
if(class_exists('\ahura\app\elementor\Ahura_Custom_Footer'))
{
    $footer_cls = new \ahura\app\elementor\Ahura_Custom_Footer();
    $footers = $footer_cls->getTemplates();
    foreach($footers as $footer) {
        $footers_arr[$footer->ID] = $footer->post_title;
    }
}else{
    $footers_arr[1] = esc_html__('Nothing found', 'ahura');
}
$wp_customize->add_section( 'ahura_footer' , array(
    'title'      => __('Footer','ahura'),
    'priority'   => 6,
));
$wp_customize->add_setting('use_custom_footer');
$customFooterArgs = [
    'label' => __('Use custom Footer','ahura'),
    'section' => 'ahura_footer',
];
if(!\ahura\app\mw_options::is_ahura_builder_accessible())
{
    $customFooterArgs['input_attrs']['disabled'] = true;
    $customFooterArgs['description'] = esc_html__('Install Elementor plugin to use this option', 'ahura');
}
$wp_customize->add_control(new ios_checkbox($wp_customize, 'use_custom_footer', $customFooterArgs));

$custom_footer_id = get_theme_mod('custom_footer') ? get_theme_mod('custom_footer') : 0;
$wp_customize->add_setting('custom_footer');
$wp_customize->add_control(new simple_select_box($wp_customize, 'custom_footer', [
    'section' => 'ahura_footer',
    'label' => __('Custom Footer', 'ahura'),
    'choices' => $footers_arr,
    'input_attrs' => [
        'load-ajax' => true,
        'class' => 'ahura-section-select-on-change ahura-section-select-ajax-load-options',
        'data-affected' => '.footer-select-on-change-affected',
        'data-affected-attr' => 'href',
        'data-affected-pattern' => 'post=(.*)&',
    ],
    'links' => [
        [
            'title' => esc_html__('All Footers', 'ahura'),
            'url' => admin_url('edit.php?post_type=section_builder'),
            'target' => '_blank'
        ],
        [
            'title' => esc_html__('Edit footer', 'ahura'),
            'url' => admin_url("post.php?post={$custom_footer_id}&action=elementor"),
            'target' => '_blank',
            'class' => 'footer-select-on-change-affected'
        ],
        [
            'title' => esc_html__('Create a new footer', 'ahura'),
            'url' => admin_url('post-new.php?post_type=section_builder'),
            'target' => '_blank'
        ],
    ],
    'active_callback' => ['\ahura\app\mw_options','get_mod_is_active_custom_footer'],
]));


$wp_customize->add_setting('ahura_footer_color');
$wp_customize->add_control(
    new WP_Customize_Color_Control(
        $wp_customize, 'ahura_footer_color', array(
        'label'      => __( 'Background Color', 'ahura' ),
        'section'    => 'ahura_footer',
        'settings'   => 'ahura_footer_color',
        'active_callback' => ['\ahura\app\mw_options','get_mod_is_not_active_custom_footer'],
    ) )
);

$wp_customize->add_setting('ahura_footer_text_color');
$wp_customize->add_control(
    new WP_Customize_Color_Control(
        $wp_customize, 'ahura_footer_text_color', array(
        'label'      => __( 'Text Color', 'ahura' ),
        'section'    => 'ahura_footer',
        'settings'   => 'ahura_footer_text_color',
        'active_callback' => ['\ahura\app\mw_options','get_mod_is_not_active_custom_footer'],
    ) )
);

$wp_customize->add_setting('ahura_footer_bg');
$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'ahura_footer_bg',
    array(
        'label' => __( 'Footer Background', 'ahura' ),
        'section' => 'ahura_footer',
        'settings' => 'ahura_footer_bg',
        'active_callback' => ['\ahura\app\mw_options','get_mod_is_not_active_custom_footer'],
    )));
$wp_customize->add_setting('ahura_footer_bg_size', ['default' => 'auto']);
$wp_customize->add_control(new ios_radio_box($wp_customize, 'ahura_footer_bg_size', [
    'section' => 'ahura_footer',
    'label' => __("Background Size", 'ahura'),
    'choices' => [
        'auto' => __("Auto", 'ahura'),
        'contain' => __('Contain', 'ahura'),
        'cover' => __('Cover', 'ahura')
    ],
    'active_callback' => ['\ahura\app\mw_options', 'check_has_footer_bg'] // check
]));

$wp_customize->add_setting('ahura_legend', ['default'  => true]);
$wp_customize->add_control(new ios_checkbox($wp_customize, 'ahura_legend', array(
    'label' => __( 'Footer Slogan', 'ahura' ),
    'section' => 'ahura_footer',
    'active_callback' => ['\ahura\app\mw_options','get_mod_is_not_active_custom_footer'],
)));
$wp_customize->get_setting( 'ahura_legend' )->transport   = 'postMessage';
$wp_customize->selective_refresh->add_partial( 'ahura_legend', array(
    'selector' => '.footer-legend',
    'render_callback' => '__return_false',
) );
$wp_customize->add_setting('ahura_legend_text');
$wp_customize->add_control(new simple_text($wp_customize, 'ahura_legend_text', array(
    'label' => __( 'Footer Slogan Text', 'ahura' ),
    'section' => 'ahura_footer',
    'active_callback' => ['\ahura\app\mw_options','get_mod_is_active_footer_slogan']
)));
$wp_customize->get_setting( 'ahura_legend_text' )->transport   = 'postMessage';
$wp_customize->selective_refresh->add_partial( 'ahura_legend_text', array(
    'selector' => '.footer-legend h5',
    'render_callback' => '__return_false',
    'active_callback' => ['\ahura\app\mw_options','get_mod_is_active_footer_slogan']
) );
$wp_customize->add_setting('ahura_legend_ctalink');
$wp_customize->add_control(new simple_text($wp_customize, 'ahura_legend_ctalink', array(
    'label' => __( 'Footer Slogan Link', 'ahura' ),
    'section' => 'ahura_footer',
    'active_callback' => ['\ahura\app\mw_options','get_mod_is_active_footer_slogan'] // check
)));
$wp_customize->get_setting( 'ahura_legend_ctalink' )->transport   = 'postMessage';
$wp_customize->selective_refresh->add_partial( 'ahura_legend_ctalink', array(
    'selector' => '.footer-legend a',
    'render_callback' => '__return_false',
    'active_callback' => ['\ahura\app\mw_options','get_mod_is_active_footer_slogan'] //check
) );
$wp_customize->add_setting('ahura_legend_ctatext');
$wp_customize->add_control(new simple_text($wp_customize, 'ahura_legend_ctatext', array(
    'label' => __( 'Footer Slogan Button Text', 'ahura' ),
    'section' => 'ahura_footer',
    'active_callback' => ['\ahura\app\mw_options','get_mod_is_active_footer_slogan'] //check
)));
$wp_customize->add_setting('ahura_legend_ctatext_color');
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'ahura_legend_ctatext_color', array(
    'label' => __( 'Footer Slogan Button Text Color', 'ahura' ),
    'section' => 'ahura_footer',
    'active_callback' => ['\ahura\app\mw_options','get_mod_is_active_footer_slogan'] //check
)));
$wp_customize->add_setting('ahura_legend_background');
$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'ahura_legend_background',
    array(
        'label' => __( 'Footer Slogan Background', 'ahura' ),
        'section' => 'ahura_footer',
        'settings' => 'ahura_legend_background',
        'active_callback' => ['\ahura\app\mw_options','get_mod_is_active_footer_slogan'],
    )));

$wp_customize->add_setting( 'footer-copyright', [ 'default' => __( 'All rights reserved.', 'ahura' ) ] );
$wp_customize->add_control(new simple_text($wp_customize, 'footer-copyright', array(
    'label' => __( 'Footer Right Copyright', 'ahura' ),
    'section' => 'ahura_footer',
    'active_callback' => ['\ahura\app\mw_options','get_mod_is_not_active_custom_footer'],
)));
$wp_customize->get_setting( 'footer-copyright' )->transport   = 'postMessage';
$wp_customize->selective_refresh->add_partial( 'footer-copyright', array(
    'selector' => '.footer-copyright',
    'render_callback' => '__return_false',
) );
$wp_customize->add_setting('footer-copyright2');
$wp_customize->add_control(new simple_text($wp_customize, 'footer-copyright2', array(
    'label' => __( 'Footer Left Copyright', 'ahura' ),
    'section' => 'ahura_footer',
    'active_callback' => ['\ahura\app\mw_options','get_mod_is_not_active_custom_footer'],
)));
$wp_customize->get_setting( 'footer-copyright2' )->transport   = 'postMessage';
$wp_customize->selective_refresh->add_partial( 'footer-copyright2', array(
    'selector' => '.footer-copyright2',
    'render_callback' => '__return_false',
) );

$wp_customize->add_setting('footer_namad_check',['default' => false]);
$wp_customize->add_control( new ios_checkbox( $wp_customize, 'footer_namad_check',
array(
    'label' => __( 'Show Footer Symbol', 'ahura' ),
    'section' => 'ahura_footer',
    'active_callback' => ['\ahura\app\mw_options','get_mod_is_not_active_custom_footer'],
)));

$wp_customize->add_setting('use_enamad_html',['default' => false]);
$wp_customize->add_control(new ios_checkbox($wp_customize, 'use_enamad_html',
array(
    'label' => __('Use enamad html code', 'ahura'),
    'section' => 'ahura_footer',
    'active_callback' => function(){
        return \ahura\app\mw_options::get_mod_show_footer_symbols() && \ahura\app\mw_options::get_mod_is_not_active_custom_footer();
    },
)
));

$wp_customize->add_setting('show_symbol1',['default' => true]);
$wp_customize->add_control( new ios_checkbox( $wp_customize, 'show_symbol1',
    array(
        'label' => __( 'Show Footer Symbol 1', 'ahura' ),
        'section' => 'ahura_footer',
        'active_callback' => function(){
            return \ahura\app\mw_options::get_mod_show_footer_symbols() && \ahura\app\mw_options::get_mod_is_not_active_custom_footer() && \ahura\app\mw_options::get_mod_not_enamad_use_html_code();
        },
    )));

$wp_customize->add_setting('show_symbol2',['default' => true]);
$wp_customize->add_control( new ios_checkbox( $wp_customize, 'show_symbol2',
    array(
        'label' => __( 'Show Footer Symbol 2', 'ahura' ),
        'section' => 'ahura_footer',
        'active_callback' => function(){
            return \ahura\app\mw_options::get_mod_show_footer_symbols() && \ahura\app\mw_options::get_mod_is_not_active_custom_footer() && \ahura\app\mw_options::get_mod_not_enamad_use_html_code();
        },
    )));

$wp_customize->add_setting('footer_namad1');
$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'footer_namad1',
    array(
        'label' => __( 'Footer Symbol 1', 'ahura' ),
        'section' => 'ahura_footer',
        'settings' => 'footer_namad1',
        'active_callback' => function(){
            return \ahura\app\mw_options::get_mod_show_footer_symbol1() && \ahura\app\mw_options::get_mod_is_not_active_custom_footer() && \ahura\app\mw_options::get_mod_not_enamad_use_html_code();
        },
    )));

$wp_customize->add_setting('footer_namad1_url',['default' => '#']);
$wp_customize->add_control( new simple_text( $wp_customize, 'footer_namad1_url',
    array(
        'label' => __( 'Footer Symbol 1 Url', 'ahura' ),
        'section' => 'ahura_footer',
        'active_callback' => function(){
            return \ahura\app\mw_options::get_mod_show_footer_symbol1() && \ahura\app\mw_options::get_mod_is_not_active_custom_footer() && \ahura\app\mw_options::get_mod_not_enamad_use_html_code();
        },
    )));

$wp_customize->add_setting('footer_namad2');
$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'footer_namad2',
    array(
        'label' => __( 'Footer Symbol 2', 'ahura' ),
        'section' => 'ahura_footer',
        'settings' => 'footer_namad2',
        'active_callback' => function(){
            return \ahura\app\mw_options::get_mod_show_footer_symbol2() && \ahura\app\mw_options::get_mod_is_not_active_custom_footer() && \ahura\app\mw_options::get_mod_not_enamad_use_html_code();
        },
    )));

$wp_customize->add_setting('footer_namad2_url', ['default' => '#']);
$wp_customize->add_control( new simple_text( $wp_customize, 'footer_namad2_url',
    array(
        'label' => __( 'Footer Symbol 2 Url', 'ahura' ),
        'section' => 'ahura_footer',
        'active_callback' => function(){
            return \ahura\app\mw_options::get_mod_show_footer_symbol2() && \ahura\app\mw_options::get_mod_is_not_active_custom_footer() && \ahura\app\mw_options::get_mod_not_enamad_use_html_code();
        },
    )));

$wp_customize->add_setting('footer_enamad_html_code');
$wp_customize->add_control( new simple_text( $wp_customize, 'footer_enamad_html_code',[
    'label' => __( 'Namad Html Code', 'ahura' ),
    'section' => 'ahura_footer',
    'type'  => 'textarea',
    'active_callback' => function(){
        return \ahura\app\mw_options::get_mod_show_footer_symbols() && \ahura\app\mw_options::get_mod_is_not_active_custom_footer() && \ahura\app\mw_options::get_mod_enamad_use_html_code();
    },
]));


$wp_customize->add_setting('footer_columns');
$wp_customize->add_control( new image_radio_box( $wp_customize, 'footer_columns',
    array(
        'label' => __( 'Footer Columns', 'ahura' ),
        'section' => 'ahura_footer',
        'choices' => array(
            '1c' => [
                'label' => __( '1 Column', 'ahura' ),
                'image_url' => get_template_directory_uri() . '/img/customization/footer/footer_columns_1c.png',
            ],
            '2c' => [
                'label' => __( '2 Column', 'ahura' ),
                'image_url' => get_template_directory_uri() . '/img/customization/footer/footer_columns_2c.png',
            ],
            '3c' => [
                'label' => __( '3 Column', 'ahura' ),
                'image_url' => get_template_directory_uri() . '/img/customization/footer/footer_columns_3c.png',
            ],
            '4c' => [
                'label' => __( '4 Column', 'ahura' ),
                'image_url' => get_template_directory_uri() . '/img/customization/footer/footer_columns_4c.png',
            ],
        ),
        'active_callback' => ['\ahura\app\mw_options','get_mod_is_not_active_custom_footer'],
    )));
$wp_customize->add_setting('remove_footer_border_top');
$wp_customize->add_control( new ios_checkbox( $wp_customize, 'remove_footer_border_top',
    array(
        'label' => __( 'Remove Footer Border Top', 'ahura' ),
        'section' => 'ahura_footer',
        'active_callback' => ['\ahura\app\mw_options','get_mod_is_not_active_custom_footer'],
    )));
$wp_customize->add_setting('change_footer_namad_and_copyright_direction');
$wp_customize->add_control( new ios_checkbox( $wp_customize, 'change_footer_namad_and_copyright_direction',
    array(
        'label' => __( 'Change Copyright And Namad Direction', 'ahura' ),
        'section' => 'ahura_footer',
        'active_callback' => ['\ahura\app\mw_options','get_mod_is_not_active_custom_footer'],
    )));
    
$wp_customize->add_setting('ahura_additional_code_in_footer');
$wp_customize->add_control( new simple_text( $wp_customize, 'ahura_additional_code_in_footer',[
    'label' => __( 'Add Code to Footer', 'ahura' ),
    'section' => 'ahura_footer',
    'type'  => 'textarea',
]));

$wp_customize->add_setting('ahura_show_sticky_buttons', ['default' => false]);
$wp_customize->add_control(new ios_checkbox($wp_customize, 'ahura_show_sticky_buttons', array(
    'label' => __('Sticky Buttons', 'ahura'),
    'section' => 'ahura_footer',
)));

$wp_customize->add_setting('ahura_show_first_btn_sticky', ['default' => false]);
$wp_customize->add_control(new ios_checkbox($wp_customize, 'ahura_show_first_btn_sticky', array(
    'label' => __('First Sticky Button', 'ahura'),
    'section' => 'ahura_footer',
    'active_callback' => ['\ahura\app\mw_options','get_mod_show_sticky_buttons'],
)));

$wp_customize->add_setting('ahura_first_btn_sticky_url', ['default' => '#']);
$wp_customize->add_control( new simple_text( $wp_customize, 'ahura_first_btn_sticky_url',
array(
    'label' => __('First Button Url', 'ahura'),
    'section' => 'ahura_footer',
    'active_callback' => ['\ahura\app\mw_options','get_mod_show_first_sticky_button'],
)));

$wp_customize->add_setting('ahura_first_btn_sticky_icon', ['default' => 'fab fa-whatsapp']);
$wp_customize->add_control(new icon_selector($wp_customize, 'ahura_first_btn_sticky_icon', array(
    'label' => __('Icon', 'ahura'),
    'section' => 'ahura_footer',
    'active_callback' => ['\ahura\app\mw_options','get_mod_show_first_sticky_button'],
)));

$wp_customize->add_setting('ahura_first_btn_sticky_color');
$wp_customize->add_control(
	new WP_Customize_Color_Control(
	$wp_customize, 'ahura_first_btn_sticky_color', array(
		'label'      => __('Color', 'ahura'),
		'section'    => 'ahura_footer',
		'settings'   => 'ahura_first_btn_sticky_color',
        'active_callback' => ['\ahura\app\mw_options','get_mod_show_first_sticky_button'],
	))
);

$wp_customize->add_setting('ahura_show_sec_btn_sticky', ['default' => false]);
$wp_customize->add_control(new ios_checkbox($wp_customize, 'ahura_show_sec_btn_sticky', array(
    'label' => __('Second Sticky Button', 'ahura'),
    'section' => 'ahura_footer',
    'active_callback' => ['\ahura\app\mw_options','get_mod_show_sticky_buttons'],
)));

$wp_customize->add_setting('ahura_sec_btn_sticky_url', ['default' => '#']);
$wp_customize->add_control( new simple_text( $wp_customize, 'ahura_sec_btn_sticky_url',
array(
    'label' => __('Second Button Url', 'ahura'),
    'section' => 'ahura_footer',
    'active_callback' => ['\ahura\app\mw_options','get_mod_show_sec_sticky_button'],
)));

$wp_customize->add_setting('ahura_sec_btn_sticky_icon', ['default' => 'fab fa-telegram']);
$wp_customize->add_control(new icon_selector($wp_customize, 'ahura_sec_btn_sticky_icon', array(
    'label' => __('Icon', 'ahura'),
    'section' => 'ahura_footer',
    'active_callback' => ['\ahura\app\mw_options','get_mod_show_sec_sticky_button'],
)));

$wp_customize->add_setting('ahura_sec_btn_sticky_color');
$wp_customize->add_control(
	new WP_Customize_Color_Control(
	$wp_customize, 'ahura_sec_btn_sticky_color', array(
		'label'      => __('Color', 'ahura'),
		'section'    => 'ahura_footer',
		'settings'   => 'ahura_sec_btn_sticky_color',
        'active_callback' => ['\ahura\app\mw_options','get_mod_show_sec_sticky_button'],
	))
);