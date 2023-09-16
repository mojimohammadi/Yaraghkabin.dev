<?php

// Block direct access to the main plugin file.

use ahura\app\customization\ios_checkbox;
use ahura\app\customization\simple_range;
use ahura\app\customization\simple_notice;
use ahura\app\customization\simple_select_box;
use ahura\app\customization\simple_text;

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

$wp_customize->add_section( 'ahura_logo' , array(
      'title'      => __('Logo & Style','ahura'),
      'priority'   => 1,
));
$wp_customize->add_setting('ahura_theme_logo');
$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'ahura_theme_logo',
array(
'label' => __( 'Your Logo', 'ahura' ),
'section' => 'ahura_logo',
'settings' => 'ahura_theme_logo',
'description' => __( 'Recommended size: 304 X 98px', 'ahura' ),
'active_callback' => ['\ahura\app\mw_options', 'get_mod_is_not_active_custom_header'],
) ) );
$wp_customize->add_setting( 'ahura_logo_notice', [ 'default' => '' ] );
$wp_customize->add_control( new simple_notice( $wp_customize, 'ahura_logo_notice',[
		'description' => __( 'Please change logo from custom header created in wp admin area > theme settings > Ahura header builder', 'ahura' ),
		'section' => 'ahura_logo',
    'active_callback' => ['\ahura\app\mw_options','get_mod_is_active_custom_header'],
	]
));

$wp_customize->get_setting( 'ahura_theme_logo' )->transport   = 'postMessage';
$wp_customize->selective_refresh->add_partial( 'ahura_theme_logo', array(
  'selector' => '.logo',
  'render_callback' => '__return_false',
));

$wp_customize->add_setting('ahura_theme_dark_logo');
$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'ahura_theme_dark_logo',array(
  'label' => __('Dark Mode Logo', 'ahura'),
  'section' => 'ahura_logo',
  'settings' => 'ahura_theme_dark_logo',
  'description' => __('Recommended size: 304 X 98px', 'ahura'),
  'active_callback' => function(){
    return \ahura\app\mw_options::get_mod_is_not_active_custom_header() && \ahura\app\mw_options::get_mod_is_active_dark_theme();
  },
)));

$wp_customize->get_setting('ahura_theme_dark_logo')->transport = 'postMessage';
$wp_customize->selective_refresh->add_partial('ahura_theme_dark_logo', array(
    'selector' => '.logo',
    'render_callback' => '__return_false',
));

$wp_customize->add_setting('ahura_use_mobile_logo', ['default' => false]);
$wp_customize->add_control(
	new ios_checkbox(
	$wp_customize, 'ahura_use_mobile_logo', array(
		'label'      => __( 'Use Mobile Logo', 'ahura' ),
		'section'    => 'ahura_logo',
    'active_callback' => ['\ahura\app\mw_options','get_mod_is_not_active_custom_header'],
	) )
);

$wp_customize->add_setting('ahura_theme_mobile_logo');
$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'ahura_theme_mobile_logo',
array(
  'label' => __( 'Mobile Logo', 'ahura' ),
  'section' => 'ahura_logo',
  'settings' => 'ahura_theme_mobile_logo',
  'description' => __( 'The maximum width of the logo should be 450px.', 'ahura' ),
  'active_callback' => function (){
    return \ahura\app\mw_options::get_mod_theme_use_mobile_logo() && \ahura\app\mw_options::get_mod_is_not_active_custom_header();
  },
) ) );
$wp_customize->get_setting( 'ahura_theme_mobile_logo' )->transport   = 'postMessage';
$wp_customize->selective_refresh->add_partial( 'ahura_theme_mobile_logo', array(
  'selector' => '.logo',
  'render_callback' => '__return_false',
) );

$wp_customize->add_setting('ahura_logo_text', ['default' => get_bloginfo('name')]);
$wp_customize->add_control(new simple_text($wp_customize, 'ahura_logo_text', array(
    'label' => __('Logo Text', 'ahura'),
    'section' => 'ahura_logo',
    'type'    => 'text',
    'active_callback' => function(){
        return !\ahura\app\mw_options::get_mod_logo_option();
    }
)));

$wp_customize->add_setting('ahura_logo_text_color', ['default' => '#000000']);
$wp_customize->add_control(
    new WP_Customize_Color_Control(
        $wp_customize, 'ahura_logo_text_color', array(
        'label'      => __( 'Logo Color', 'ahura' ),
        'section'    => 'ahura_logo',
        'settings'   => 'ahura_logo_text_color',
        'active_callback' => function(){
            return !\ahura\app\mw_options::get_mod_logo_option();
        }
    ) )
);

$wp_customize->add_setting('theme_dark');
$wp_customize->add_control(
	new ios_checkbox(
	$wp_customize, 'theme_dark', array(
		'label'      => __( 'Dark Mode', 'ahura' ),
		'section'    => 'ahura_logo',
	) )
);

$wp_customize->add_setting('ahura_show_theme_mode_switcher');
$wp_customize->add_control(new ios_checkbox($wp_customize, 'ahura_show_theme_mode_switcher', array(
		'label'      => __('Show theme mode switcher', 'ahura'),
		'section'    => 'ahura_logo',
    'active_callback' => ['\ahura\app\mw_options', 'get_mod_is_active_dark_theme']
)));

$wp_customize->add_setting('ahura_default_theme_mode', ['default' => 'dark']);
$wp_customize->add_control('ahura_default_theme_mode', [
    'section' => 'ahura_logo',
    'type' => 'select',
    'label' => "Default Theme Mode",
    'choices' => [
        'dark' => __('Dark', 'ahura'),
        'light' => __('Light', 'ahura'),
        'black' => __('Black', 'ahura'),
    ],
    'active_callback' => function(){
        return \ahura\app\mw_options::get_mod_is_active_dark_theme() && \ahura\app\mw_options::get_mod_show_theme_mode_switcher();
    }
]);

$wp_customize->add_setting('ahura_show_theme_mode_switcher_titles', ['default' => true]);
$wp_customize->add_control(new ios_checkbox($wp_customize, 'ahura_show_theme_mode_switcher_titles', array(
    'label'      => __('Show theme mode switcher titles', 'ahura'),
	'section'    => 'ahura_logo',
    'active_callback' => function(){
            return \ahura\app\mw_options::get_mod_is_active_dark_theme() && \ahura\app\mw_options::get_mod_show_theme_mode_switcher();
    }
)));

$wp_customize->add_setting('ahura_dark_mode_has_scheduler', ['default' => false]);
$wp_customize->add_control(new ios_checkbox($wp_customize, 'ahura_dark_mode_has_scheduler', array(
    'label'      => __('Dark mode has scheduler', 'ahura'),
    'section'    => 'ahura_logo',
    'active_callback' => function(){
        return \ahura\app\mw_options::get_mod_is_active_dark_theme() && \ahura\app\mw_options::get_mod_show_theme_mode_switcher();
    }
)));

$sch_times = [];

for($i = 1; $i <= 24; $i++) {
  $t = $i <= 9 ? "0{$i}" : (($i == 24) ? '00' : $i);
  $sch_times[$t] = "{$t}:00";
}

$wp_customize->add_setting('ahura_dark_mode_schedule_start_time');
$wp_customize->add_control(new simple_select_box($wp_customize, 'ahura_dark_mode_schedule_start_time', [
    'section' => 'ahura_logo',
    'label' => __('Dark mode schedule start time', 'ahura'),
    'choices' => $sch_times,
    'active_callback' => function(){
        return \ahura\app\mw_options::get_mod_is_active_dark_theme() && \ahura\app\mw_options::get_mod_dark_mode_has_scheduler();
    }
]));

$wp_customize->add_setting('ahura_dark_mode_schedule_end_time');
$wp_customize->add_control(new simple_select_box($wp_customize, 'ahura_dark_mode_schedule_end_time', [
    'section' => 'ahura_logo',
    'label' => __('Dark mode schedule end time', 'ahura'),
    'choices' => $sch_times,
    'active_callback' => function(){
        return \ahura\app\mw_options::get_mod_is_active_dark_theme() && \ahura\app\mw_options::get_mod_dark_mode_has_scheduler();
    }
]));

$wp_customize->add_setting('bgcolor');
$wp_customize->add_control(
	new WP_Customize_Color_Control(
	$wp_customize, 'bgcolor', array(
		'label'      => __( 'Background Color', 'ahura' ),
		'section'    => 'ahura_logo',
		'settings'   => 'bgcolor',
	) )
);
$wp_customize->add_setting('themecolor', ['default' => '#00b0ff']);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
	$wp_customize, 'themecolor', array(
		'label'      => __( 'Main Color', 'ahura' ),
		'section'    => 'ahura_logo',
		'settings'   => 'themecolor',
	) )
);
$wp_customize->selective_refresh->add_partial('themecolor',[
	'selector' => '.header-mode-1 .cats-list.isnotfront'
]);
$wp_customize->add_setting('ahura_secondary_color',[
    'default' => '#fff'
]);
$wp_customize->add_control(
    new WP_Customize_Color_Control(
        $wp_customize,
        'ahura_secondary_color',
        [
            'label' => __('Secondary Color', 'ahura'),
            'section' => 'ahura_logo'
        ]
    )
);
$wp_customize->add_setting('ahura_mini_cart_bg_color', ['default' => '#2aba5f']);
$wp_customize->add_control(new WP_Customize_Color_Control(
	$wp_customize,
	'ahura_mini_cart_bg_color',
	[
		'section' => 'ahura_logo',
		'label' => __("Cart Background Color", 'ahura'),
		'active_callback' => ['\ahura\app\mw_options', 'check_is_show_mini_cart_option']
	]
	));
$wp_customize->add_setting('ahura_mini_cart_color', ['default' => '#fff']);
$wp_customize->add_control(new WP_Customize_Color_Control(
	$wp_customize,
	'ahura_mini_cart_color',
	[
		'section' => 'ahura_logo',
		'label' => __("Cart Color", 'ahura'),
		'active_callback' => ['\ahura\app\mw_options', 'check_is_show_mini_cart_option']
	]
));
$wp_customize->selective_refresh->add_partial(
	'ahura_mini_cart_bg_color',
	[
		'selector' => '.header-mode-1 .mini-cart-header'
	]
);

$wp_customize->add_setting('ahura_border_sidebar_title_color',array(
  'default' => '#35495c',
));
$wp_customize->add_control(
  new WP_Customize_Color_Control( $wp_customize, 'ahura_border_sidebar_title_color',array(
    'label' => __('Border right sidebar title color','ahura'),
    'section' => 'ahura_logo',
    'setting' => 'ahura_border_sidebar_title_color',
  ) )
);

$wp_customize->add_setting('ahura_background_selctor_color',array(
  'default' => '#3390ff'
));
$wp_customize->add_control(
  new WP_Customize_Color_Control( $wp_customize, 'ahura_background_selctor_color',array(
    'label' => __('Background selection color','ahura'),
    'section' => 'ahura_logo',
    'setting' => 'ahura_background_selctor_color',
  ) )
);

$wp_customize->add_setting('ahura_background_selctor_text_color',array(
  'default' => '#ffffff'
));
$wp_customize->add_control(
  new WP_Customize_Color_Control( $wp_customize, 'ahura_background_selctor_text_color',array(
    'label' => __('Background selection text color','ahura'),
    'section' => 'ahura_logo',
    'setting' => 'ahura_background_selctor_text_color',
  ) )
);

$wp_customize->add_setting('ahura_cat_description_backgroundcolor',array(
  'default' => '#3f3492'
));
$wp_customize->add_control(
  new WP_Customize_Color_Control( $wp_customize, 'ahura_cat_description_backgroundcolor',array(
    'label' => __('Category descrtiption background color','ahura'),
    'section' => 'ahura_logo',
    'setting' => 'ahura_cat_description_backgroundcolor',
  ) )
);

$wp_customize->add_setting('ahura_content_radius',array(
  'default' => 10,
));
$wp_customize->add_control(
  new simple_range( $wp_customize, 'ahura_content_radius',array(
    'label' => __('Content border radius','ahura'),
    'description' => __('Default 10px','ahura'),
    'section' => 'ahura_logo',
    'input_attrs' => array(
      'min' => 0,
      'max' => 100,
    ),
  ) )
);

$wp_customize->add_setting('ahura_content_shadow',array(
  'default' => 10,
));
$wp_customize->add_control(
  new simple_range( $wp_customize, 'ahura_content_shadow',array(
    'label' => __('Content box shadow','ahura'),
    'description' => __('Default 10','ahura'),
    'section' => 'ahura_logo',
    'input_attrs' => array(
      'min' => 0,
      'max' => 100,
    ),
  ) )
);

$wp_customize->add_setting('ahura_sidebar_widget_radius',array(
  'default' => 10,
));
$wp_customize->add_control(
  new simple_range( $wp_customize, 'ahura_sidebar_widget_radius',array(
    'label' => __('Widget box border radius','ahura'),
    'description' => __('Default 10px','ahura'),
    'section' => 'ahura_logo',
    'input_attrs' => array(
      'min' => 0,
      'max' => 100,
    ),
  ) )
);

$wp_customize->add_setting('ahura_cta_widget_radius',array(
  'default' => 50,
));
$wp_customize->add_control(
  new simple_range( $wp_customize, 'ahura_cta_widget_radius',array(
    'label' => __('Header button border radius','ahura'),
    'description' => __('Default 50px','ahura'),
    'section' => 'ahura_logo',
    'input_attrs' => array(
      'min' => 0,
      'max' => 100,
    ),
  ) )
);

$wp_customize->add_setting('ahura_gototop_widget_radius',array(
  'default' => 5,
));
$wp_customize->add_control(
  new simple_range( $wp_customize, 'ahura_gototop_widget_radius',array(
    'label' => __('Got to top border radius','ahura'),
    'description' => __('Default 5px','ahura'),
    'section' => 'ahura_logo',
    'input_attrs' => array(
      'min' => 0,
      'max' => 100,
    ),
  ) )
);

$wp_customize->add_setting('ahura_show_preloader');
$wp_customize->add_control(
  new ios_checkbox( $wp_customize, 'ahura_show_preloader',array(
    'label' => __('Show Preloader','ahura'),
    'section' => 'ahura_logo',
  ) )
);

$wp_customize->add_setting('ahura_preloader_background');
$wp_customize->add_control(
  new WP_Customize_Color_Control( $wp_customize, 'ahura_preloader_background',array(
    'label' => __('Preloader Background','ahura'),
    'section' => 'ahura_logo',
    'setting' => 'ahura_preloader_background',
  ) )
);

$wp_customize->add_setting('ahura_preloader_picture');
$wp_customize->add_control(
  new WP_Customize_Image_Control( $wp_customize, 'ahura_preloader_picture',array(
    'label' => __('Preloader Center Picture','ahura'),
    'section' => 'ahura_logo',
    'setting' => 'ahura_preloader_picture',
  ) )
);

$wp_customize->add_setting('ahura_images_lightbox_status');
$wp_customize->add_control(new ios_checkbox( $wp_customize, 'ahura_images_lightbox_status', [
  'section' => 'ahura_logo',
  'label' => __('Enable images lightbox', 'ahura'),
  'description' => __('This feature is activated only on the single post and products.', 'ahura'),
]));
