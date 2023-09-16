<?php

// Block direct access to the main plugin file.

use ahura\app\customization\image_radio_box;
use ahura\app\customization\ios_checkbox;
use ahura\app\customization\simple_text;

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

$wp_customize->add_section('ahura_shop',array(
  'title' => __( 'Shop Settings', 'ahura' ),
  'priority' => '2',
) );

$wp_customize->add_setting('ahura_shop_show_peoduct_tags',['default' => true]);
$wp_customize->add_control(new ios_checkbox($wp_customize, 'ahura_shop_show_peoduct_tags',array(
  'section' => 'ahura_shop',
  'label' => __( 'Show product tags', 'ahura' ),
)));

$wp_customize->add_setting('ahura_shop_product_title_words_number');
$wp_customize->add_control( new simple_text($wp_customize,'ahura_shop_product_title_words_number', [
   'section' => 'ahura_shop',
   'type'    => 'number',
   'label'   => __('Maximum number of title words', 'ahura' ),
]));

$wp_customize->add_setting('ahura_active_woocommerce_element_mini_cart', ['default' => false]);
$wp_customize->add_control(new ios_checkbox($wp_customize, 'ahura_active_woocommerce_element_mini_cart',[
    'section' => 'ahura_shop',
    'label'   => __( 'Active woocommerce element mini cart', 'ahura' ),
    'description' => __('Changing the content of elementor mini card element to wooCommerce main format', 'ahura')
]));

$wp_customize->add_setting('ahura_shop_show_boxcover', ['default' => false]);
$wp_customize->add_control(new ios_checkbox($wp_customize, 'ahura_shop_show_boxcover',[
  'section' => 'ahura_shop',
  'label'   => __( 'Hide products box cover', 'ahura' ),
]));

$wp_customize->add_setting('ahura_shop_show_boxshadow', ['default' => true]);
$wp_customize->add_control(new ios_checkbox($wp_customize, 'ahura_shop_show_boxshadow',[
  'section' => 'ahura_shop',
  'label'   => __( 'Show product box shadow', 'ahura' ),
  'active_callback' => ['\ahura\app\mw_options','get_mod_isnot_active_show_boxcover_status'],
]));

$wp_customize->add_setting('ahura_shop_show_addtocartbtn_onproduct', ['default' => false]);
$wp_customize->add_control(new ios_checkbox($wp_customize, 'ahura_shop_show_addtocartbtn_onproduct',[
  'section' => 'ahura_shop',
  'label'   => __( 'Hide product box add to cart button', 'ahura' ),
  'active_callback' => ['\ahura\app\mw_options','get_mod_isnot_active_show_boxcover_status'],
]));

$wp_customize->add_setting('ahura_move_price_after_short_description', ['default' => false]);
$wp_customize->add_control(new ios_checkbox($wp_customize, 'ahura_move_price_after_short_description',array(
    'section' => 'ahura_shop',
    'label' => __('Move price after short description', 'ahura'),
)));

$wp_customize->add_setting('shop_change_add_to_cart_button_text_status', ['default' => false]);
$wp_customize->add_control(new ios_checkbox($wp_customize, 'shop_change_add_to_cart_button_text_status',[
  'section' => 'ahura_shop',
  'label'   => __( 'Change add to cart button text', 'ahura' ),
]));

$wp_customize->add_setting('shop_add_to_cart_button_text', ['default' => esc_html__('Add to Cart', 'ahura')]);
$wp_customize->add_control(new simple_text($wp_customize,'shop_add_to_cart_button_text',array(
  'section' => 'ahura_shop',
  'type' => 'text',
  'label' => __('Add to cart button text', 'ahura' ),
  'active_callback' => ['\ahura\app\mw_options','get_mod_change_add_to_cart_button_text_status'],
)));

$wp_customize->add_setting('ahura_shop_show_cat_onproduct', ['default' => false]);
$wp_customize->add_control(new ios_checkbox($wp_customize, 'ahura_shop_show_cat_onproduct',[
  'section' => 'ahura_shop',
  'label'   => __( 'Hide product box category', 'ahura' ),
  'active_callback' => ['\ahura\app\mw_options','get_mod_isnot_active_show_boxcover_status'],
]));

$wp_customize->add_setting('ahura_shop_page_product_title_color', ['default' => '#000']);
$wp_customize->add_control(
    new WP_Customize_Color_Control($wp_customize,'ahura_shop_page_product_title_color',array(
        'section' => 'ahura_shop',
        'setting' => 'ahura_shop_page_product_title_color',
        'label' => __( 'Product Title Color', 'ahura' ),
    ))
);

$wp_customize->add_setting('ahura_shop_page_description_color', ['default' => '#000']);
$wp_customize->add_control(
    new WP_Customize_Color_Control($wp_customize,'ahura_shop_page_description_color',array(
        'section' => 'ahura_shop',
        'setting' => 'ahura_shop_page_description_color',
        'label' => __( 'Shop description color', 'ahura' ),
    ))
);

$wp_customize->add_setting('ahura_product_cover_hover_color', ['default' => '#00b0ff']);
$wp_customize->add_control(
    new WP_Customize_Color_Control($wp_customize,'ahura_product_cover_hover_color',array(
        'section' => 'ahura_shop',
        'setting' => 'ahura_product_cover_hover_color',
        'label' => __( 'Product cover color', 'ahura' ),
    ))
);

$wp_customize->add_setting('ahura_product_regular_price_color',['default' => '#66BB6A']);
$wp_customize->add_control(
  new WP_Customize_Color_Control($wp_customize,'ahura_product_regular_price_color',array(
  'section' => 'ahura_shop',
  'setting' => 'ahura_product_regular_price_color',
  'label' => __( 'Product regular price color', 'ahura' ),
))
);

$wp_customize->add_setting( 'ahura_product_desktop_column', ['default' => '3'] );
$wp_customize->add_control( 'ahura_product_desktop_column', [
  'type' => 'select',
  'section' => 'ahura_shop',
  'label' => __( 'Product shop desktop column', 'ahura' ),
  'choices' => [
    '2' => __( '2', 'ahura' ),
    '3' => __( '3', 'ahura' ),
    '4' => __( '4', 'ahura' ),
    '6' => __( '6', 'ahura' ),
  ],
 ] );
$wp_customize->add_setting( 'ahura_product_mobile_column', ['default' => '1'] );
$wp_customize->add_control( 'ahura_product_mobile_column', [
  'type' => 'select',
  'section' => 'ahura_shop',
  'label' => __( 'Product shop mobile column', 'ahura' ),
  'choices' => [
    '1' => __( '1', 'ahura' ),
    '2' => __( '2', 'ahura' ),
    '3' => __( '3', 'ahura' ),
  ],
 ] );

$wp_customize->add_setting('ahura_product_sale_price_color',['default' => '#66BB6A']);
$wp_customize->add_control(
  new WP_Customize_Color_Control($wp_customize,'ahura_product_sale_price_color',array(
  'section' => 'ahura_shop',
  'setting' => 'ahura_product_sale_price_color',
  'label' => __( 'Product sale price color', 'ahura' ),
))
);

$wp_customize->add_setting('ahura_onsale_date_color',['default' => '#dd3333']);
$wp_customize->add_control(
  new WP_Customize_Color_Control($wp_customize,'ahura_onsale_date_color',[
    'section' => 'ahura_shop',
    'setting' => 'ahura_onsale_date_color',
    'label' => __( 'Onsale date price color', 'ahura' ),
  ])
);

$wp_customize->add_setting('ahura_onsale_label_color',['default' => '#ffffff']);
$wp_customize->add_control(
  new WP_Customize_Color_Control($wp_customize,'ahura_onsale_label_color',[
    'section' => 'ahura_shop',
    'setting' => 'ahura_onsale_label_color',
    'label' => __( 'Onsale label color', 'ahura' ),
  ])
);

$wp_customize->add_setting('ahura_onsale_label_backcolor',['default' => '#dd3333']);
$wp_customize->add_control(
  new WP_Customize_Color_Control($wp_customize,'ahura_onsale_label_backcolor',[
    'section' => 'ahura_shop',
    'setting' => 'ahura_onsale_label_backcolor',
    'label' => __( 'Onsale label back color', 'ahura' ),
  ])
);

$wp_customize->add_setting('ahura_shop_show_product_onsale_percent',['default' => false]);
$wp_customize->add_control(new ios_checkbox($wp_customize, 'ahura_shop_show_product_onsale_percent',array(
  'section' => 'ahura_shop',
  'label' => __( 'Show product onsale percent', 'ahura' ),
)));

$wp_customize->add_setting('woocommerce_sale_text');
$wp_customize->add_control(new simple_text($wp_customize, 'woocommerce_sale_text', [
    'label' => __('Special sales text', 'ahura'),
    'section' => 'ahura_shop',
]));

$wp_customize->add_setting('ahura_shop_per_page',['default' => '9']);
$wp_customize->add_control(
  new simple_text($wp_customize,'ahura_shop_per_page',array(
  'section' => 'ahura_shop',
  'type' => 'number',
  'label' => __( 'Shop product per page', 'ahura' ),
))
);

$wp_customize->add_setting('ahura_shop_show_product_stock_status',['default' => false]);
$wp_customize->add_control(new ios_checkbox($wp_customize, 'ahura_shop_show_product_stock_status',array(
  'section' => 'ahura_shop',
  'label' => __( 'Show product stock status in shop', 'ahura' ),
)));
$wp_customize->add_setting('ahura_shop_show_product_stock_status_background',['default' => '#EE384E']);
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'ahura_shop_show_product_stock_status_background',array(
  'section' => 'ahura_shop',
  'setting' => 'ahura_shop_show_product_stock_status_background',
  'label' => __( 'Product stock status background in shop', 'ahura' ),
  'active_callback' => ['\ahura\app\mw_options','get_mod_is_active_show_product_stock_status'],
)));
$wp_customize->add_setting('ahura_shop_show_product_stock_status_color',['default' => '#fff']);
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'ahura_shop_show_product_stock_status_color',array(
  'section' => 'ahura_shop',
  'setting' => 'ahura_shop_show_product_stock_status_color',
  'label' => __( 'Product stock status color in shop', 'ahura' ),
  'active_callback' => ['\ahura\app\mw_options','get_mod_is_active_show_product_stock_status'],
)));
$wp_customize->add_setting('ahura_shop_show_product_stock_status_fontsize',['default' => '12']);
$wp_customize->add_control(new simple_text($wp_customize,'ahura_shop_show_product_stock_status_fontsize',array(
  'section' => 'ahura_shop',
  'type' => 'number',
  'label' => __( 'Product stock status font size in shop', 'ahura' ),
  'active_callback' => ['\ahura\app\mw_options','get_mod_is_active_show_product_stock_status'],
  'description' =>  __('Default 12px','ahura'),
)));

$wp_customize->add_setting('ahura_shop_alert_background',['default'=>'#a46497']);
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'ahura_shop_alert_background',array(
  'section' => 'woocommerce_store_notice',
  'label' => __( 'Background Color', 'ahura' ),
  'active_callback' => ['\ahura\app\mw_options','get_mod_is_active_shop_alert_settings'],
)));
$wp_customize->add_setting('ahura_shop_alert_color',['default'=>'#fff']);
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'ahura_shop_alert_color',array(
  'section' => 'woocommerce_store_notice',
  'label' => __( 'Color', 'ahura' ),
  'active_callback' => ['\ahura\app\mw_options','get_mod_is_active_shop_alert_settings'],
)));
$wp_customize->add_setting('ahura_shop_alert_fontsize',['default' => '16']);
$wp_customize->add_control(new simple_text($wp_customize,'ahura_shop_alert_fontsize',array(
  'section' => 'woocommerce_store_notice',
  'type' => 'number',
  'label' => __( 'Font size', 'ahura' ),
  'active_callback' => ['\ahura\app\mw_options','get_mod_is_active_shop_alert_settings'],
)));
$wp_customize->add_setting('show_woocommerce_breadcrumb');
$wp_customize->add_control(new ios_checkbox($wp_customize, 'show_woocommerce_breadcrumb', [
    'label' => __('Show Breadcrumb', 'ahura'),
    'section' => 'ahura_shop'
]));
$wp_customize->add_setting('show_product_cat_des_to_all_pages', ['default' => false]);
$wp_customize->add_control(new ios_checkbox($wp_customize, 'show_product_cat_des_to_all_pages', [
    'label' => __('Show product category description to all pages', 'ahura'),
    'section' => 'ahura_shop'
]));
$wp_customize->add_setting('move_product_catdescription');
$wp_customize->add_control(new ios_checkbox($wp_customize, 'move_product_catdescription', [
    'label' => __('Move product category description to the end', 'ahura'),
    'section' => 'ahura_shop'
]));
$wp_customize->add_setting('move_buy_button', ['default' => false]);
$wp_customize->add_control(new ios_checkbox($wp_customize, 'move_buy_button', [
    'label' => __('Move buy button to the end', 'ahura'),
    'section' => 'ahura_shop'
]));
$wp_customize->add_setting('shop_show_filters_button_toggle', ['default' => true]);
$wp_customize->add_control(new ios_checkbox($wp_customize, 'shop_show_filters_button_toggle', [
    'label' => __('Show Filters Button Toggle in Sidebar', 'ahura'),
    'section' => 'ahura_shop',
    'description' => __('For toggle the sidebar in mobile','ahura'),
]));
$wp_customize->add_setting('filters_button_toggle_text', ['default' => esc_html__('Products filter', 'ahura')]);
$wp_customize->add_control(new simple_text($wp_customize, 'filters_button_toggle_text', [
    'label' => __('Filters Button Toggle Text', 'ahura'),
    'section' => 'ahura_shop',
    'active_callback' => ['\ahura\app\mw_options','get_mod_shop_show_filters_button_toggle'],
]));

$wp_customize->add_setting('ahura_shop_filters_toggle_button_color', ['default' => '#181522']);
$wp_customize->add_control(
    new WP_Customize_Color_Control($wp_customize,'ahura_shop_filters_toggle_button_color',array(
        'section' => 'ahura_shop',
        'setting' => 'ahura_shop_filters_toggle_button_color',
        'label' => __( 'Filters button color', 'ahura' ),
        'active_callback' => ['\ahura\app\mw_options','get_mod_shop_show_filters_button_toggle'],
    ))
);

$wp_customize->add_setting('ahura_shop_filters_toggle_button_bg_color', ['default' => '#fed700']);
$wp_customize->add_control(
    new WP_Customize_Color_Control($wp_customize,'ahura_shop_filters_toggle_button_bg_color',array(
        'section' => 'ahura_shop',
        'setting' => 'ahura_shop_filters_toggle_button_bg_color',
        'label' => __( 'Filters button background color', 'ahura' ),
        'active_callback' => ['\ahura\app\mw_options','get_mod_shop_show_filters_button_toggle'],
    ))
);

