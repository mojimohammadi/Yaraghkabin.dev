<?php
use ahura\app\customization\image_radio_box;
use ahura\app\customization\ios_checkbox;
use ahura\app\customization\simple_text;

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

$wp_customize->add_section('ahura_product',array(
    'title' => __( 'Product Single', 'ahura' ),
    'priority' => '3',
) );

$wp_customize->add_setting('ahura_shop_show_product_thumbnails_in_slider',['default' => false]);
$wp_customize->add_control(new ios_checkbox($wp_customize, 'ahura_shop_show_product_thumbnails_in_slider',array(
    'section' => 'ahura_product',
    'label' => __( 'Show product gallery in slider', 'ahura' ),
)));

$wp_customize->add_setting('ahura_shop_show_product_slider_buttons',['default' => true]);
$wp_customize->add_control(new ios_checkbox($wp_customize, 'ahura_shop_show_product_slider_buttons',array(
    'section' => 'ahura_product',
    'label' => __('Show product gallery slider buttons', 'ahura'),
    'active_callback' => ['\ahura\app\mw_options','get_mod_show_product_thumbnails_in_slider'],
)));

$wp_customize->add_setting('ahura_shop_show_product_related',['default' => false]);
$wp_customize->add_control(new ios_checkbox($wp_customize, 'ahura_shop_show_product_related',array(
    'section' => 'ahura_product',
    'label' => __( 'Show product related', 'ahura' ),
)));

$wp_customize->add_setting('ahura_shop_show_product_related_in_slider',['default' => false]);
$wp_customize->add_control(new ios_checkbox($wp_customize, 'ahura_shop_show_product_related_in_slider',array(
    'section' => 'ahura_product',
    'label' => __( 'Show product related in slider', 'ahura' ),
    'active_callback' => [ '\ahura\app\mw_options','get_mod_is_active_product_related' ],
)));

$wp_customize->add_setting('ahura_shop_show_related_product_slider_btns',['default' => false]);
$wp_customize->add_control(new ios_checkbox($wp_customize, 'ahura_shop_show_related_product_slider_btns',array(
    'section' => 'ahura_product',
    'label' => __('Show related product slider buttons', 'ahura'),
    'active_callback' => ['\ahura\app\mw_options', 'get_mod_is_active_product_related_in_slider'],
)));

$wp_customize->add_setting( 'ahura_related_product_column', ['default' => '3'] );
$wp_customize->add_control( 'ahura_related_product_column', [
    'type'    => 'select',
    'section' => 'ahura_product',
    'label'   => __( 'Related products column', 'ahura' ),
    'choices' => [
        '2' => __( '2', 'ahura' ),
        '3' => __( '3', 'ahura' ),
        '4' => __( '4', 'ahura' ),
    ],
    'active_callback' => [ '\ahura\app\mw_options','get_mod_is_active_product_related' ],
] );

$wp_customize->add_setting( 'ahura_max_related_products_num',[ 'default' => '3' ] );
$wp_customize->add_control( new simple_text( $wp_customize,'ahura_max_related_products_num', [
    'section' => 'ahura_product',
    'type'    => 'number',
    'label'   => __( 'Maximum related products', 'ahura' ),
    'active_callback' => [ '\ahura\app\mw_options','get_mod_is_active_product_related' ],
] ) );


$wp_customize->add_setting('ahura_shop_show_call_for_price_inquery', ['default' => false]);
$wp_customize->add_control(new ios_checkbox($wp_customize, 'ahura_shop_show_call_for_price_inquery',array(
    'section' => 'ahura_product',
    'label' => __('Show text call for price inquery', 'ahura'),
    'description' => __('Displayed text only for products without price', 'ahura'),
)));

$wp_customize->add_setting('ahura_shop_text_call_for_price_inquery', ['default' => esc_html__('Call for price inquiry', 'ahura')]);
$wp_customize->add_control(new simple_text($wp_customize,'ahura_shop_text_call_for_price_inquery',array(
    'section' => 'ahura_product',
    'type' => 'text',
    'label' => __('Text call for price inquery', 'ahura' ),
    'active_callback' => ['\ahura\app\mw_options','get_mod_show_call_for_price_inquery'],
)));

$wp_customize->add_setting('ahura_shop_btn_text_call_for_price_inquery', ['default' => esc_html__('Contact us', 'ahura')]);
$wp_customize->add_control(new simple_text($wp_customize,'ahura_shop_btn_text_call_for_price_inquery',array(
    'section' => 'ahura_product',
    'type' => 'text',
    'label' => __('Call button text', 'ahura' ),
    'active_callback' => ['\ahura\app\mw_options','get_mod_show_call_for_price_inquery'],
)));

$wp_customize->add_setting('ahura_shop_btn_url_call_for_price_inquery', ['default' => 'tel:+989123456789']);
$wp_customize->add_control(new simple_text($wp_customize,'ahura_shop_btn_url_call_for_price_inquery',array(
    'section' => 'ahura_product',
    'type' => 'url',
    'label' => __('Call button url', 'ahura' ),
    'active_callback' => ['\ahura\app\mw_options','get_mod_show_call_for_price_inquery'],
)));

$wp_customize->add_setting('ahura_shop_text_call_for_price_inquery_color', ['default' => '#5CE1B3']);
$wp_customize->add_control(
    new WP_Customize_Color_Control($wp_customize,'ahura_shop_text_call_for_price_inquery_color',array(
        'section' => 'ahura_product',
        'setting' => 'ahura_shop_text_call_for_price_inquery_color',
        'label' => __( 'Inquery Text Color', 'ahura' ),
    ))
);

$wp_customize->add_setting('ahura_product_buy_button_text_color', ['default' => '#ffffff']);
$wp_customize->add_control(
    new WP_Customize_Color_Control($wp_customize,'ahura_product_buy_button_text_color',array(
        'section' => 'ahura_product',
        'setting' => 'ahura_product_buy_button_text_color',
        'label' => __( 'Add to cart button color', 'ahura' ),
    ))
);

$wp_customize->add_setting('ahura_product_buy_button_bg_color', ['default' => '#00b0ff']);
$wp_customize->add_control(
    new WP_Customize_Color_Control($wp_customize,'ahura_product_buy_button_bg_color',array(
        'section' => 'ahura_product',
        'setting' => 'ahura_product_buy_button_bg_color',
        'label' => __( 'Add to cart button background color', 'ahura' ),
    ))
);

$wp_customize->add_setting( 'ahura_woo_modified_date', [ 'default' => false ] );
$wp_customize->add_control( new ios_checkbox( $wp_customize, 'ahura_woo_modified_date', [
    'label' => __( 'Show Woocommerce product modified date', 'ahura' ),
    'section' => 'ahura_product'
]));

$wp_customize->add_setting( 'ahura_woo_modified_title_date_color',[ 'default' => '#181522' ] );
$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize,'ahura_woo_modified_title_date_color', [
    'section' => 'ahura_product',
    'setting' => 'ahura_woo_modified_title_date_color',
    'label'   => __( 'Product modified title date color', 'ahura' ),
    'active_callback' => ['\ahura\app\mw_options','get_mod_is_active_woo_modified_date'],
] ) );

$wp_customize->add_setting( 'ahura_woo_modified_date_color',[ 'default' => '#181522' ] );
$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize,'ahura_woo_modified_date_color', [
    'section' => 'ahura_product',
    'setting' => 'ahura_woo_modified_date_color',
    'label'   => __( 'Product modified date color', 'ahura' ),
    'active_callback' => ['\ahura\app\mw_options','get_mod_is_active_woo_modified_date'],
] ) );

$wp_customize->add_setting( 'product_update_date_text',[ 'default' => esc_html__('Product updated in:', 'ahura')] );
$wp_customize->add_control( new simple_text( $wp_customize, 'product_update_date_text', [
    'label' => __( 'Product update date text', 'ahura' ),
    'section' => 'ahura_product',
    'active_callback' => [ '\ahura\app\mw_options', 'get_mod_is_active_woo_modified_date' ],
] ) );