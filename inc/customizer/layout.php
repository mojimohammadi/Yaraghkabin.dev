<?php

// Block direct access to the main plugin file.

use ahura\app\customization\image_radio_box;
use ahura\app\customization\ios_checkbox;
use ahura\app\customization\simple_select_box;

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

$wp_customize->add_section('ahura_layout',array(
  'title' => __( 'Theme Layout', 'ahura' ),
  'priority' => '2',
) );
$wp_customize->add_setting('ahura_columns',array(
  'default' => '2c',
));
$ahura_columns_items = [];
if(is_rtl())
{
  $ahura_columns_items = [
    '2cr' => [
      'label' => __( 'Right Sidebar', 'ahura' ),
      'image_url' => get_template_directory_uri() . '/img/customization/layout/site_columns_right.png',
    ],
    '2c' => [
      'label' => __( 'Left Sidebar', 'ahura' ),
      'image_url' => get_template_directory_uri() . '/img/customization/layout/site_columns_left.png',
    ],
    '3c' => [
      'label' => __( '3 Columns', 'ahura' ),
      'image_url' => get_template_directory_uri() . '/img/customization/layout/site_columns_3c.png',
    ],
    '1c' => [
      'label' => __( 'Full Width', 'ahura' ),
      'image_url' => get_template_directory_uri() . '/img/customization/layout/site_columns_full_width.png',
    ],
    '1cc' => [
      'label' => __( 'Full Width And Center Content', 'ahura' ),
      'image_url' => get_template_directory_uri() . '/img/customization/layout/site_columns_full_width_center.png',
    ],
  ];
}else{
  $ahura_columns_items = [
    '2c' => [
      'label' => __( 'Left Sidebar', 'ahura' ),
      'image_url' => get_template_directory_uri() . '/img/customization/layout/site_columns_left.png',
    ],
    '2cr' => [
      'label' => __( 'Right Sidebar', 'ahura' ),
      'image_url' => get_template_directory_uri() . '/img/customization/layout/site_columns_right.png',
    ],
    '3c' => [
      'label' => __( '3 Columns', 'ahura' ),
      'image_url' => get_template_directory_uri() . '/img/customization/layout/site_columns_3c.png',
    ],
    '1c' => [
      'label' => __( 'Full Width', 'ahura' ),
      'image_url' => get_template_directory_uri() . '/img/customization/layout/site_columns_full_width.png',
    ],
    '1cc' => [
      'label' => __( 'Full Width And Center Content', 'ahura' ),
      'image_url' => get_template_directory_uri() . '/img/customization/layout/site_columns_full_width_center.png',
    ],
  ];
}
$wp_customize->add_control(new image_radio_box($wp_customize, 'ahura_columns',array(
  'section' => 'ahura_layout',
  'label' => __( 'Website Columns', 'ahura' ),
  'choices' => $ahura_columns_items
)));
$wp_customize->add_setting('ahura_goto_top_position', ['default' => 'right']);
$wp_customize->add_control(new image_radio_box($wp_customize, 'ahura_goto_top_position', [
  'section' => 'ahura_layout',
  'label' => __("Goto-top button position", 'ahura'),
  'choices' => [
    'right' => [
      'label' => __("Right", 'ahura'),
      'image_url' => get_template_directory_uri() . '/img/customization/layout/goto_top_button_right.png',
    ],
    'left' => [
      'label' => __("Left", 'ahura'),
      'image_url' => get_template_directory_uri() . '/img/customization/layout/goto_top_button_left.png',
    ],
    'none' => [
      'label' => __('None', 'ahura'),
      'image_url' => get_template_directory_uri() . '/img/customization/layout/goto_top_button_none.png',
    ]
  ]
]));
$wp_customize->add_setting('ahura_product_page_columns',array(
  'default' => '2c',
));
$wp_customize->add_control(new image_radio_box($wp_customize, 'ahura_product_page_columns',array(
  'section' => 'ahura_layout',
  'label' => __( 'Woocommerce single page columns', 'ahura' ),
  'choices' => $ahura_columns_items
)));
$wp_customize->add_setting('ahura_shop_columns',array(
  'default' => '2c',
));
$ahura_columns_items = [];
if(is_rtl())
{
  $ahura_columns_items = [
    '2cr' => [
      'label' => __( 'Right Sidebar', 'ahura' ),
      'image_url' => get_template_directory_uri() . '/img/customization/layout/site_columns_right.png',
    ],
    '2c' => [
      'label' => __( 'Left Sidebar', 'ahura' ),
      'image_url' => get_template_directory_uri() . '/img/customization/layout/site_columns_left.png',
    ],
    '3c' => [
      'label' => __( 'Two Sidebars', 'ahura' ),
      'image_url' => get_template_directory_uri() . '/img/customization/layout/site_columns_3c.png',
    ],
    '1c' => [
      'label' => __( 'No Sidebar', 'ahura' ),
      'image_url' => get_template_directory_uri() . '/img/customization/layout/site_columns_full_width.png',
    ],
    '1cc' => [
      'label' => __( 'Full Width And Center Content', 'ahura' ),
      'image_url' => get_template_directory_uri() . '/img/customization/layout/site_columns_full_width_center.png',
    ]
  ];
}else{
  $ahura_columns_items = [
    '2c' => [
      'label' => __( 'Left Sidebar', 'ahura' ),
      'image_url' => get_template_directory_uri() . '/img/customization/layout/site_columns_left.png',
    ],
    '2cr' => [
      'label' => __( 'Right Sidebar', 'ahura' ),
      'image_url' => get_template_directory_uri() . '/img/customization/layout/site_columns_right.png',
    ],
    '3c' => [
      'label' => __( 'Two Sidebars', 'ahura' ),
      'image_url' => get_template_directory_uri() . '/img/customization/layout/site_columns_3c.png',
    ],
    '1c' => [
      'label' => __( 'No Sidebar', 'ahura' ),
      'image_url' => get_template_directory_uri() . '/img/customization/layout/site_columns_full_width.png',
    ],
    '1cc' => [
      'label' => __( 'Full Width And Center Content', 'ahura' ),
      'image_url' => get_template_directory_uri() . '/img/customization/layout/site_columns_full_width_center.png',
    ]
  ];
}

$wp_customize->add_control(new image_radio_box($wp_customize, 'ahura_shop_columns',array(
  'type' => 'radio',
  'section' => 'ahura_layout',
  'label' => __( 'Woocommerce pages columns', 'ahura' ),
  'choices' => $ahura_columns_items
)));
$wp_customize->add_setting('ahura_page_columns',array(
  'default' => '2c',
));
$wp_customize->add_control(new image_radio_box($wp_customize, 'ahura_page_columns',array(
  'section' => 'ahura_layout',
  'label' => __( 'Page Columns', 'ahura' ),
  'choices' => $ahura_columns_items
)));

if (class_exists('LifterLMS')) {
    if(is_rtl()){
        $llms_columns_items = [
            'right' => [
                'label' => __( 'Right Sidebar', 'ahura' ),
                'image_url' => get_template_directory_uri() . '/img/customization/layout/site_columns_right.png',
            ],
            'left' => [
                'label' => __( 'Left Sidebar', 'ahura' ),
                'image_url' => get_template_directory_uri() . '/img/customization/layout/site_columns_left.png',
            ],
        ];
    } else {
        $llms_columns_items = [
            'left' => [
                'label' => __( 'Left Sidebar', 'ahura' ),
                'image_url' => get_template_directory_uri() . '/img/customization/layout/site_columns_left.png',
            ],
            'right' => [
                'label' => __( 'Right Sidebar', 'ahura' ),
                'image_url' => get_template_directory_uri() . '/img/customization/layout/site_columns_right.png',
            ],
        ];
    }
    $wp_customize->add_setting('ahura_llms_sidebar_position',array(
        'default' => 'left',
    ));
    $wp_customize->add_control(new image_radio_box($wp_customize, 'ahura_llms_sidebar_position', array(
        'section' => 'ahura_layout',
        'label' => __('LifterLMS sidebar position', 'ahura'),
        'choices' => $llms_columns_items
    )));
}

$wp_customize->add_setting('ahura_fixed_sidebar');
$wp_customize->add_control(new ios_checkbox($wp_customize, 'ahura_fixed_sidebar',array(
  'section' => 'ahura_layout',
  'label' => __( 'Fixed sidebar', 'ahura' ),
)));

$wp_customize->add_setting( 'ahura_hidden_mobile_sidebar' );
$wp_customize->add_control( new ios_checkbox( $wp_customize, 'ahura_hidden_mobile_sidebar', [
  'section' => 'ahura_layout',
  'label' => __( 'Hide mobile sidebar', 'ahura' ),
] ) );

$wp_customize->add_setting( 'ahura_hidden_post_mobile_sidebar' );
$wp_customize->add_control( new ios_checkbox( $wp_customize, 'ahura_hidden_post_mobile_sidebar', [
  'section' => 'ahura_layout',
  'label' => __( 'Hide mobile post sidebar', 'ahura' ),
  'active_callback'   =>  [ '\ahura\app\mw_options', 'get_mod_is_active_hidden_mobile_sidebar' ]
] ) );

$wp_customize->add_setting( 'ahura_hidden_shop_mobile_sidebar' );
$wp_customize->add_control( new ios_checkbox( $wp_customize, 'ahura_hidden_shop_mobile_sidebar', [
  'section' => 'ahura_layout',
  'label' => __( 'Hide mobile shop sidebar', 'ahura' ),
  'active_callback'   =>  [ '\ahura\app\mw_options', 'get_mod_is_active_hidden_mobile_sidebar' ]
] ) );
