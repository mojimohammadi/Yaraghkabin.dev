<?php

// Block direct access to the main plugin file.

use ahura\app\customization\image_radio_box;
use ahura\app\customization\ios_checkbox;
use ahura\app\customization\simple_range;
use ahura\app\customization\simple_select_box;
use ahura\app\customization\simple_text;
use ahura\app\mw_options;

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

$wp_customize->add_section( 'ahuraheader' , array(
      'title'      => __('Header','ahura'),
      'priority'   => 3,
) );
$headers = array();
$args = array('post_type' => 'section_builder');
$header_list = get_posts( $args ); 
foreach($header_list as $header) {
    $headers[$header->ID] = $header->post_title;
}
$wp_customize->add_setting('use_custom_header');
$customHeaderArgs = [
    'label' => __('Use custom header','ahura'),
    'section' => 'ahuraheader',
];
if(!\ahura\app\mw_options::is_ahura_builder_accessible())
{
    $customHeaderArgs['input_attrs']['disabled'] = true;
    $customHeaderArgs['description'] = esc_html__('Install Elementor plugin to use this option', 'ahura');
}
$wp_customize->add_control(new ios_checkbox($wp_customize, 'use_custom_header', $customHeaderArgs));
$custom_header_id = get_theme_mod('custom_header') ? get_theme_mod('custom_header') : 0;
$wp_customize->add_setting('custom_header');
$wp_customize->add_control(new simple_select_box($wp_customize, 'custom_header', [
    'section' => 'ahuraheader',
    'label' => __('Custom header', 'ahura'),
    'choices' => $headers,
    'input_attrs' => [
        'load-ajax' => true,
        'class' => 'ahura-section-select-on-change ahura-section-select-ajax-load-options',
        'data-affected' => '.header-select-on-change-affected',
        'data-affected-attr' => 'href',
        'data-affected-pattern' => 'post=(.*)&',
    ],
    'links' => [
        [
            'title' => esc_html__('All headers', 'ahura'),
            'url' => admin_url('edit.php?post_type=section_builder'),
            'target' => '_blank'
        ],
        [
            'title' => esc_html__('Edit header', 'ahura'),
            'url' => admin_url("post.php?post={$custom_header_id}&action=elementor"),
            'target' => '_blank',
            'class' => 'header-select-on-change-affected'
        ],
        [
            'title' => esc_html__('Create a new header', 'ahura'),
            'url' => admin_url('post-new.php?post_type=section_builder'),
            'target' => '_blank'
        ],
    ],
    'active_callback' => ['\ahura\app\mw_options','get_mod_is_active_custom_header'],
]));

$wp_customize->add_setting('ahura_header_style', ['default' => 1]);
$wp_customize->add_control(new simple_select_box($wp_customize, 'ahura_header_style', [
    'section' => 'ahuraheader',
    'label' => __('Header Style', 'ahura'),
    'choices' => [
        1 => __('Style 1', 'ahura'),
        2 => __('Style 2', 'ahura'),
    ],
    'active_callback' => ['\ahura\app\mw_options','get_mod_is_not_active_custom_header'],
]));

$wp_customize->add_setting('ahura_header_box_mode', ['default' => false]);
$wp_customize->add_control(new ios_checkbox($wp_customize, 'ahura_header_box_mode', array(
    'label' => __('Box Mode', 'ahura'),
    'section' => 'ahuraheader',
    'active_callback' => function(){
            return mw_options::get_mod_is_not_active_custom_header() && mw_options::is_active_header_style(2);
    },
)));

$wp_customize->add_setting('ahura_header_sticking_top', ['default' => false]);
$wp_customize->add_control(new ios_checkbox($wp_customize, 'ahura_header_sticking_top', array(
    'label' => __('Sticking Top', 'ahura'),
    'section' => 'ahuraheader',
    'active_callback' => function(){
        return mw_options::get_mod_is_not_active_custom_header() && mw_options::is_active_header_style(2) && mw_options::is_active_header_box_mode();
    },
)));

$wp_customize->add_setting('ahura_change_header_dimension', ['default' => false]);
$wp_customize->add_control(new ios_checkbox($wp_customize, 'ahura_change_header_dimension', array(
    'label' => __('Change Header Dimension', 'ahura'),
    'section' => 'ahuraheader',
    'active_callback' => function(){
        return mw_options::get_mod_is_not_active_custom_header() && !mw_options::is_active_header_box_mode();
    },
)));

$wp_customize->add_setting('ahura_header_width', ['default' => 81.77]);
$wp_customize->add_control(new simple_range($wp_customize, 'ahura_header_width', [
    'label' => __('Width','ahura'),
    'section' => 'ahuraheader',
    'input_attrs' => [
        'step' => 0.01,
        'min' => 0,
        'max' => 100,
    ],
    'active_callback' => function(){
        return \ahura\app\mw_options::get_mod_is_not_active_custom_header() && get_theme_mod('ahura_change_header_dimension') == true && !mw_options::is_active_header_box_mode();
    }
]));

$wp_customize->add_setting('stickyheader', [ 'default' => true ]);
$wp_customize->add_control(new ios_checkbox($wp_customize, 'stickyheader', array(
    'label' => __('Sticky Header','ahura'),
    'section' => 'ahuraheader',
)));
$wp_customize->add_setting('ahura_sticky_header_show_top_scrolling');
$wp_customize->add_control(new ios_checkbox($wp_customize, 'ahura_sticky_header_show_top_scrolling', [
    'label' => __('Sticky header show top scrolling','ahura'),
    'section' => 'ahuraheader',
    'active_callback' => function(){
        return get_theme_mod('stickyheader') == true;
    }
]));

$wp_customize->add_setting('ahura_active_alert_box', ['default' => false]);
$wp_customize->add_control(new ios_checkbox($wp_customize, 'ahura_active_alert_box', array(
    'label' => __('Notification Bar', 'ahura'),
    'section' => 'ahuraheader',
    'active_callback' => function(){
        return mw_options::get_mod_is_not_active_custom_header() && mw_options::is_active_header_style(2);
    },
)));

$wp_customize->add_setting('ahura_alert_box_text', ['default' => __('Notification Bar Text', 'ahura')]);
$wp_customize->add_control(new simple_text($wp_customize, 'ahura_alert_box_text', [
    'section' => 'ahuraheader',
    'type' => 'text',
    'label' => __('Notification Bar Text', 'ahura'),
    'active_callback' => function(){
        return mw_options::is_active_notification_bar() && mw_options::is_active_header_style(2);
    },
]));

$wp_customize->add_setting('ahura_active_alert_box_button', ['default' => true]);
$wp_customize->add_control(new ios_checkbox($wp_customize, 'ahura_active_alert_box_button', array(
    'label' => __('Notification Bar Button', 'ahura'),
    'section' => 'ahuraheader',
    'active_callback' => function(){
        return mw_options::is_active_notification_bar() && mw_options::is_active_header_style(2);
    },
)));

$wp_customize->add_setting('ahura_alert_box_btn_text', ['default' => __('Button Text', 'ahura')]);
$wp_customize->add_control(new simple_text($wp_customize, 'ahura_alert_box_btn_text', [
    'section' => 'ahuraheader',
    'type' => 'text',
    'label' => __('Notification Bar Button Text', 'ahura'),
    'active_callback' => function(){
        return mw_options::is_active_notification_bar_button() && mw_options::is_active_header_style(2);
    },
]));

$wp_customize->add_setting('ahura_alert_box_btn_link', ['default' => '#']);
$wp_customize->add_control(new simple_text($wp_customize, 'ahura_alert_box_btn_link', [
    'section' => 'ahuraheader',
    'type' => 'text',
    'label' => __('Notification Bar Button Link', 'ahura'),
    'active_callback' => function(){
        return mw_options::is_active_notification_bar_button() && mw_options::is_active_header_style(2);
    },
]));

$wp_customize->add_setting('ahura_alert_box_text_color');
$wp_customize->add_control('ahura_alert_box_text_color', [
    'section' => 'ahuraheader',
    'type' => 'color',
    'label' => __('Alert box text color', 'ahura'),
    'active_callback' => function(){
        return mw_options::is_active_notification_bar() && mw_options::is_active_header_style(2);
    },
]);

$wp_customize->add_setting('ahura_alert_box_bg_color');
$wp_customize->add_control('ahura_alert_box_bg_color', [
    'section' => 'ahuraheader',
    'type' => 'color',
    'label' => __('Alert box background color', 'ahura'),
    'active_callback' => function(){
        return mw_options::is_active_notification_bar() && mw_options::is_active_header_style(2);
    },
]);

$wp_customize->add_setting('ahura_alert_btn_text_color');
$wp_customize->add_control('ahura_alert_btn_text_color', [
    'section' => 'ahuraheader',
    'type' => 'color',
    'label' => __('Alert button text color', 'ahura'),
    'active_callback' => function(){
        return mw_options::is_active_notification_bar_button() && mw_options::is_active_header_style(2);
    },
]);

$wp_customize->add_setting('ahura_alert_btn_bg_color');
$wp_customize->add_control('ahura_alert_btn_bg_color', [
    'section' => 'ahuraheader',
    'type' => 'color',
    'label' => __('Alert button background color', 'ahura'),
    'active_callback' => function(){
        return mw_options::is_active_notification_bar_button() && mw_options::is_active_header_style(2);
    },
]);

$wp_customize->add_setting('ahura_is_active_ajax_search', ['default' => true]);
$wp_customize->add_control(
	new ios_checkbox($wp_customize, 'ahura_is_active_ajax_search', [
		'label' =>  __('Active ajax search', "ahura"),
		'section' => 'ahuraheader',
        'active_callback' => function(){
            return mw_options::get_mod_is_not_active_custom_header() && mw_options::is_active_header_style(1);
        },
	])
);

$wp_customize->add_setting('ajax_search_background_opacity', ['default' => 80]);
$wp_customize->add_control(new simple_range($wp_customize, 'ajax_search_background_opacity', [
    'label' => __('Ajax search background opacity','ahura'),
    'section' => 'ahuraheader',
    'active_callback' => function(){
        return mw_options::get_mod_is_not_active_custom_header() && mw_options::is_active_header_style(1);
    },
    'input_attrs' => [
        'min' => 0,
        'max' => 100
    ],
]));
$wp_customize->add_setting('ajax_seach_font_color');
$wp_customize->add_control('ajax_seach_font_color', [
    'section' => 'ahuraheader',
    'type' => 'color',
    'label' => __('Ajax search font color', 'ahura'),
    'active_callback' => ['\ahura\app\mw_options','get_mod_is_not_active_custom_header'],
]);
$wp_customize->add_setting('ajax_search_font_size');
$wp_customize->add_control(new simple_text($wp_customize, 'ajax_search_font_size', [
    'section' => 'ahuraheader',
    'type' => 'number',
    'label' => __('Ajax search font size', 'ahura'),
]));
$wp_customize->add_setting('ajax_search_result_font_size');
$wp_customize->add_control(new simple_text($wp_customize, 'ajax_search_result_font_size', [
    'section' => 'ahuraheader',
    'type' => 'number',
    'label' => __('Ajax search result font size', 'ahura'),
    'active_callback' => function(){
        return mw_options::is_active_header_style(1);
    }
]));
$wp_customize->selective_refresh->add_partial('ahura_is_active_ajax_search',[
	'selector' => '.header-mode-1 .search-form, .header-mode-3 .search-form, .header-mode-2 .action-box #action_search'
]);
$wp_customize->add_setting('ahura_is_show_header_top_border', ['default' => true]);
$wp_customize->add_control(new ios_checkbox($wp_customize, 'ahura_is_show_header_top_border', [
    'label' => __('Show header top border','ahura'),
    'section' => 'ahuraheader',
    'active_callback' => ['\ahura\app\mw_options','get_mod_is_not_active_custom_header']
]));
$wp_customize->add_setting('ahura_header_top_border_height', ['default' => 4]);
$wp_customize->add_control(new simple_range($wp_customize, 'ahura_header_top_border_height', [
    'label' => __('Header top border height','ahura'),
    'section' => 'ahuraheader',
    'active_callback' => ['\ahura\app\mw_options', 'get_mod_is_show_header_top_border'],
    'input_attrs' => [
        'min' => 4,
        'max' => 25
    ],
]));

$logo_alignments = [
    'right' => [
        'label' => __('Right', 'ahura'),
        'image_url' => get_template_directory_uri() . '/img/customization/header/logo_alignment_right.png',
    ],
    'center' => [
        'label' => __("Center", 'ahura'),
        'image_url' => get_template_directory_uri() . '/img/customization/header/logo_alignment_center.png',
    ],
    'left' => [
        'label' => __("Left", 'ahura'),
        'image_url' => get_template_directory_uri() . '/img/customization/header/logo_alignment_left.png',
    ],
];

$wp_customize->add_setting('ahura_header_logo_alignment', ['default' => 'right']);
$wp_customize->add_control(new image_radio_box($wp_customize, 'ahura_header_logo_alignment', [
    'label' => __("Logo alignment", 'ahura'),
    'section' => 'ahuraheader',
    'choices' => $logo_alignments,
    'active_callback' => function(){
        return mw_options::get_mod_is_not_active_custom_header() && mw_options::is_active_header_style(1);
    }
]));

unset($logo_alignments['center']);
$wp_customize->add_setting('ahura_header_logo_alignment_rl', ['default' => 'right']);
$wp_customize->add_control(new image_radio_box($wp_customize, 'ahura_header_logo_alignment_rl', [
    'label' => __("Logo alignment", 'ahura'),
    'section' => 'ahuraheader',
    'choices' => $logo_alignments,
    'active_callback' => function(){
        return mw_options::get_mod_is_not_active_custom_header() && mw_options::is_active_header_style(2);
    }
]));

$wp_customize->add_setting('ahura_menu_position', ['default' => 'middle']);
$wp_customize->add_control(new image_radio_box($wp_customize, 'ahura_menu_position', [
    'label' => __("Menu position", 'ahura'),
    'section' => 'ahuraheader',
    'choices' => [
        'top' => [
            'label' => __('Top', 'ahura'),
            'image_url' => get_template_directory_uri() . '/img/customization/header/menu_position_top.png',
        ],
        'middle' => [
            'label' => __("Middle", 'ahura'),
            'image_url' => get_template_directory_uri() . '/img/customization/header/menu_position_middle.png',
        ],
        'bottom' => [
            'label' => __("Bottom", 'ahura'),
            'image_url' => get_template_directory_uri() . '/img/customization/header/menu_position_bottom.png',
        ],
    ],
    'active_callback' => function(){
        return mw_options::get_mod_is_not_active_custom_header() && mw_options::is_active_header_style(1);
    }
]));
$wp_customize->add_setting('ahura_menu_position_sticky_header', ['default' => 'middle']);
$wp_customize->add_control(new image_radio_box($wp_customize, 'ahura_menu_position_sticky_header', [
    'label' => __("Menu position in sticky header", 'ahura'),
    'section' => 'ahuraheader',
    'choices' => [
        'top' => [
            'label' => __('Top', 'ahura'),
            'image_url' => get_template_directory_uri() . '/img/customization/header/menu_position_top.png',
        ],
        'middle' => [
            'label' => __("Middle", 'ahura'),
            'image_url' => get_template_directory_uri() . '/img/customization/header/menu_position_middle.png',
        ],
        'bottom' => [
            'label' => __("Bottom", 'ahura'),
            'image_url' => get_template_directory_uri() . '/img/customization/header/menu_position_bottom.png',
        ],
        'hide' => [
            'label' => __("Hide", 'ahura'),
            'image_url' => get_template_directory_uri() . '/img/customization/hide.png',
        ],
    ],
    'active_callback' => function(){
        return mw_options::get_mod_is_not_active_custom_header() && mw_options::is_active_header_style(1);
    }
]));
$wp_customize->add_setting('ahura_menu_alignment', ['default' => 'left']);
$wp_customize->add_control(new image_radio_box($wp_customize, 'ahura_menu_alignment', [
    'label' => __("Menu alignment", 'ahura'),
    'section' => 'ahuraheader',
    'choices' => [
        'right' => [
            'label' => __('Right', 'ahura'),
            'image_url' => get_template_directory_uri() . '/img/customization/header/menu_alignment_right.png',
        ],
        'left' => [
            'label' => __("Left", 'ahura'),
            'image_url' => get_template_directory_uri() . '/img/customization/header/menu_alignment_left.png',
        ],
    ],
    'active_callback' => function(){
        return mw_options::check_is_header_menu_alignment_accessible() && mw_options::is_active_header_style(1);
    }
]));
$wp_customize->add_setting('ahura_menu_color');
$wp_customize->add_control('ahura_menu_color', [
    'section' => 'ahuraheader',
    'type' => 'color',
    'label' => __('Menu Color', 'ahura'),
    'active_callback' => ['\ahura\app\mw_options','get_mod_is_not_active_custom_header'],
]);
$wp_customize->add_setting('ahura_menu_hover_color');
$wp_customize->add_control('ahura_menu_hover_color', [
    'section' => 'ahuraheader',
    'type' => 'color',
    'label' => __('Menu Hover Color', 'ahura'),
    'active_callback' => function(){
        return mw_options::get_mod_is_not_active_custom_header() && mw_options::is_active_header_style(2);
    },
]);
$wp_customize->add_setting('ahura_open_mobile_menu_from_left', ['default' => false]);
$wp_customize->add_control(new ios_checkbox($wp_customize, 'ahura_open_mobile_menu_from_left', [
    'label' => __('Open mobile menu from left','ahura'),
    'section' => 'ahuraheader',
]));
$wp_customize->add_setting('ahura_change_mobile_menu_style', ['default' => false]);
$wp_customize->add_control(new ios_checkbox($wp_customize, 'ahura_change_mobile_menu_style', [
    'label' => __('Change mobile menu style','ahura'),
    'section' => 'ahuraheader',
    'active_callback' => function(){
        return mw_options::get_mod_is_not_active_custom_header() && mw_options::is_active_header_style(1);
    },
]));
$wp_customize->add_setting('ahura_open_mobile_submenu_with_click_title', ['default' => false]);
$wp_customize->add_control(new ios_checkbox($wp_customize, 'ahura_open_mobile_submenu_with_click_title', [
    'label' => __('Open mobile submenu with click item title','ahura'),
    'section' => 'ahuraheader',
]));
$wp_customize->add_setting('ahura_header_top_box_background_color', ['default' => '#ffffff']);
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'ahura_header_top_box_background_color', [
    'label' => __("Header top box", 'ahura'),
    'section' => 'ahuraheader',
    'active_callback' => ['\ahura\app\mw_options', 'check_is_header_top_box_background_color_accessible']
]));
$wp_customize->add_setting('ahura_header_bottom_box_background_color', ['default' => '#ffffff']);
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'ahura_header_bottom_box_background_color', [
    'label' => __("Bottom top box", 'ahura'),
    'section' => 'ahuraheader',
    'active_callback' => ['\ahura\app\mw_options', 'check_is_header_bottom_box_background_color_accessible']
]));
$wp_customize->add_setting('ahura_header_top_and_bottom_box_text_color', ['default' => '#35495C']);
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'ahura_header_top_and_bottom_box_text_color', [
    'label' => __("Menu text color", 'ahura'),
    'section' => 'ahuraheader',
    'active_callback' => ['\ahura\app\mw_options', 'check_is_header_top_and_bottom_box_text_color_accessible']
]));

$wp_customize->add_setting('ahura_mobile_menu_button_color', ['default' => '#35495C']);
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'ahura_mobile_menu_button_color', [
    'label' => __("Mobile menu button color", 'ahura'),
    'section' => 'ahuraheader',
    'active_callback' => ['\ahura\app\mw_options','get_mod_is_not_active_custom_header']
]));

$wp_customize->add_setting('ahura_action_btn_alignment', ['default' => 'left']);
$wp_customize->add_control(new image_radio_box($wp_customize, 'ahura_action_btn_alignment', [
    'label' => __("Action buttons alignment", 'ahura'),
    'section' => 'ahuraheader',
    'type'  =>  'radio',
    'choices' => [
        'right' => [
            'label' => __('Right', 'ahura'),
            'image_url' => get_template_directory_uri() . '/img/customization/header/action_box_alignment_right.png',
        ],
        'left' => [
            'label' => __("Left", 'ahura'),
            'image_url' => get_template_directory_uri() . '/img/customization/header/action_box_alignment_left.png',
        ],
    ],
    'active_callback' => function(){
        return mw_options::get_mod_is_not_active_custom_header() && mw_options::is_active_header_style(1);
    }
]));

$wp_customize->add_setting('ahura_show_mega_menu', ['default' => true]);
$wp_customize->add_control(new ios_checkbox($wp_customize, 'ahura_show_mega_menu', [
    'label' => __('Show mega menu','ahura'),
    'section' => 'ahuraheader',
    'active_callback' => ['\ahura\app\mw_options','get_mod_is_not_active_custom_header']
]));
$wp_customize->add_setting('ahura_mega_menu_more_items_status', ['default' => false]);
$wp_customize->add_control(new ios_checkbox($wp_customize, 'ahura_mega_menu_more_items_status', [
    'label' => __('Mega Menu More Items Button','ahura'),
    'section' => 'ahuraheader',
    'active_callback' => function(){
        return mw_options::is_active_header_style(1);
    }
]));
$wp_customize->add_setting('ahura_mega_menu_more_items_count', ['default' => 7]);
$wp_customize->add_control(new simple_text($wp_customize, 'ahura_mega_menu_more_items_count', [
    'section' => 'ahuraheader',
    'type' => 'number',
    'label' => __('Active Items Count', 'ahura'),
    'input_attrs' => [
        'min' => 1,
    ],
    'active_callback' => ['\ahura\app\mw_options','get_mod_mega_menu_more_items_status']
]));
$wp_customize->add_setting('ahura_mega_menu_dynamic_alignment');
$wp_customize->add_control(new ios_checkbox($wp_customize, 'ahura_mega_menu_dynamic_alignment', [
    'label' => __('Use Dynamic Alignment','ahura'),
    'section' => 'ahuraheader',
    'active_callback' => function(){
        return mw_options::get_mod_is_active_mega_menu() && mw_options::is_active_header_style(1);
    },
]));
$wp_customize->add_setting('ahura_mega_menu_alignment', ['default' => 'right']);
$wp_customize->add_control(new image_radio_box($wp_customize, 'ahura_mega_menu_alignment', [
    'label' => __("Mega menu alignment", 'ahura'),
    'section' => 'ahuraheader',
    'active_callback' => ['\ahura\app\mw_options', 'ahura_mega_menu_dynamic_alignment'],
    'choices' => [
        'right' => [
            'label' => __('Right', 'ahura'),
            'image_url' => get_template_directory_uri() . '/img/customization/header/mega_menu_alignment_right.png',
        ],
        'left' => [
            'label' => __("Left", 'ahura'),
            'image_url' => get_template_directory_uri() . '/img/customization/header/mega_menu_alignment_left.png',
        ],
    ],
]));
$wp_customize->add_setting('ahura_mega_menu_title_background_color', ['default' => '#fed700']);
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'ahura_mega_menu_title_background_color', [
    'label' => __("Mega Menu Title Background Color", 'ahura'),
    'section' => 'ahuraheader',
    'active_callback' => ['\ahura\app\mw_options', 'get_mod_show_mega_menu']
]));
$wp_customize->add_setting('ahura_mega_menu_title_color', ['default' => '#35495c']);
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'ahura_mega_menu_title_color', [
    'label' => __("Mega Menu Title Color", 'ahura'),
    'section' => 'ahuraheader',
    'active_callback' => ['\ahura\app\mw_options', 'get_mod_show_mega_menu']
]));
$wp_customize->add_setting('ahura_mega_menu_wrapper_background_color', ['default' => '#ffffff']);
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'ahura_mega_menu_wrapper_background_color', [
    'label' => __("Category menu background color", 'ahura'),
    'section' => 'ahuraheader',
    'active_callback' => ['\ahura\app\mw_options', 'get_mod_show_mega_menu']
]));
$wp_customize->add_setting('ahura_mega_menu_wrapper_text_color', ['default' => '#35495C']);
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'ahura_mega_menu_wrapper_text_color', [
    'label' => __("Category menu text color", 'ahura'),
    'section' => 'ahuraheader',
    'active_callback' => ['\ahura\app\mw_options', 'get_mod_show_mega_menu']
]));
$wp_customize->add_setting('ahura_mega_menu_item_border_color', ['default' => '#f6f6f6']);
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'ahura_mega_menu_item_border_color', [
    'label' => __("Category menu item border color", 'ahura'),
    'section' => 'ahuraheader',
    'active_callback' => function(){
        return mw_options::get_mod_show_mega_menu() && mw_options::is_active_header_style(1);
    }
]));

$wp_customize->add_setting('openmenuinfrontpage', ['default' => true]);
$wp_customize->add_control(new ios_checkbox($wp_customize, 'openmenuinfrontpage', array(
    'label' => __('Open Menu is Front Page','ahura'),
    'section' => 'ahuraheader',
    'active_callback' => ['\ahura\app\mw_options', 'get_mod_show_mega_menu']
)));

$wp_customize->add_setting('ahura_mega_menu_title',[
    'default' => __("Category Menu", 'ahura')
]);
$wp_customize->add_control(new simple_text($wp_customize, 'ahura_mega_menu_title', [
    'label' => __('Mega menu title', 'ahura'),
    'section' => 'ahuraheader',
    'active_callback' => ['\ahura\app\mw_options', 'get_mod_show_mega_menu']
]));
$wp_customize->selective_refresh->add_partial('ahura_mega_menu_title',[
    'selector' => '.topbar .cats-list-title',
]);
$wp_customize->add_setting('show_ahura_header_cta_btn',['default' => true]);
$wp_customize->add_control(new ios_checkbox($wp_customize, 'show_ahura_header_cta_btn', [
    'label' => __("Show Button", 'ahura'),
    'section' => 'ahuraheader',
    'active_callback' => ['\ahura\app\mw_options','get_mod_is_not_active_custom_header']
]));
$wp_customize->add_setting('ahura_header_cta_btn_text', [
    'default' => __("Let's Start", 'ahura')
]);
$wp_customize->add_control(new simple_text($wp_customize, 'ahura_header_cta_btn_text', [
    'label' => __("Button Text", 'ahura'),
    'section' => 'ahuraheader',
    'active_callback' => ['\ahura\app\mw_options', 'get_mod_show_ahura_header_cta_btn'],
]));
$wp_customize->selective_refresh->add_partial('ahura_header_cta_btn_text',[
    'selector' => '.topbar .panel_menu_wrapper .cta_button, .topbar .action-box #action_link'
]);
$wp_customize->add_setting('ahura_header_cta_btn_url', [
    'default' => '#'
]);
$wp_customize->add_control(new simple_text($wp_customize, 'ahura_header_cta_btn_url', [
    'label' => __("Button Url", 'ahura'),
    'section' => 'ahuraheader',
    'active_callback' => ['\ahura\app\mw_options', 'get_mod_show_ahura_header_cta_btn'],
]));
$wp_customize->add_setting('ahura_header_cta_btn_text_color',['default'=>'#354ac4']);
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'ahura_header_cta_btn_text_color', [
    'label' => __("Button Text Color", 'ahura'),
    'section' => 'ahuraheader',
    'active_callback' => function(){
        return mw_options::get_mod_show_ahura_header_cta_btn() && mw_options::is_active_header_style(2);
    }
]));
$wp_customize->add_setting('ahura_header_cta_btn_bg',['default'=>'#e5e8ff']);
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'ahura_header_cta_btn_bg', [
    'label' => __("Button Background", 'ahura'),
    'section' => 'ahuraheader',
    'active_callback' => function(){
        return mw_options::get_mod_show_ahura_header_cta_btn() && mw_options::is_active_header_style(2);
    }
]));
$wp_customize->add_setting('ahura_header_is_transparent', ['default' => false]);
$wp_customize->add_control(new ios_checkbox($wp_customize, 'ahura_header_is_transparent', [
    'label' => __('Transparent Header', 'ahura'),
    'section' => 'ahuraheader',
    'active_callback' => ['\ahura\app\mw_options','get_mod_is_not_active_custom_header']
]));
$wp_customize->add_setting('ahura_header_transparent_content_color');
$wp_customize->add_control('ahura_header_transparent_content_color', [
    'label' => __("Header content color", 'ahura'),
    'type' => 'color',
    'section' => 'ahuraheader',
    'active_callback' => function(){
        return mw_options::check_is_transparent_header() && mw_options::is_active_header_style(1);
    }
]);
$wp_customize->add_setting('ahorua_transparent_logo');
$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'ahorua_transparent_logo', [
    'label' => __("Logo in transparent mode", 'ahura'),
    'section' => 'ahuraheader',
    'active_callback' => ['\ahura\app\mw_options', 'check_is_transparent_header'],
    'description' => __( 'Recommended size: 304 X 98px', 'ahura' ),
]));
$wp_customize->add_setting('ahura_header_background',['default'=>'#fff']);
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'ahura_header_background', [
    'label' => __("Header Background", 'ahura'),
    'section' => 'ahuraheader',
    'active_callback' => ['\ahura\app\mw_options','get_mod_is_not_active_custom_header']
]));
$wp_customize->add_setting('ahura_remove_header_shadow');
$wp_customize->add_control(new ios_checkbox($wp_customize, 'ahura_remove_header_shadow', [
    'label' => __("Remove Header Shadow", 'ahura'),
    'section' => 'ahuraheader',
    'active_callback' => ['\ahura\app\mw_options','get_mod_is_not_active_custom_header']
]));
$wp_customize->add_setting('ahura_remove_header_search_box');
$wp_customize->add_control(new ios_checkbox($wp_customize, 'ahura_remove_header_search_box', [
    'label' => __("Remove Header Search Box", 'ahura'),
    'section' => 'ahuraheader',
    'active_callback' => ['\ahura\app\mw_options','get_mod_is_not_active_custom_header']
]));
$wp_customize->add_setting('ahura_search_box_placeholder');
$wp_customize->add_control(new simple_text($wp_customize, 'ahura_search_box_placeholder', [
    'label' => __("Search Box Placeholder", 'ahura'),
    'section' => 'ahuraheader',
    'active_callback'   =>  ['\ahura\app\mw_options','get_mod_is_active_searhc_box']
]));
// search icon color
$wp_customize->add_setting('ahura_search_icon_color', ['default' => '#35495C']);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
	$wp_customize, 'ahura_search_icon_color', array(
		'label'      => __( 'Search icon color', 'ahura' ),
		'section'    => 'ahuraheader',
        'active_callback'   =>  ['\ahura\app\mw_options','get_mod_is_active_searhc_box']
	) )
);
$wp_customize->add_setting('ahura_search_in_product');
$wp_customize->add_control(new ios_checkbox($wp_customize, 'ahura_search_in_product', [
    'label' => __("Search in Products", 'ahura'),
    'section' => 'ahuraheader',
    'active_callback'   =>  ['\ahura\app\mw_options','get_mod_is_active_searhc_box']
]));
$wp_customize->add_setting('ahorua_show_mini_cart');
$wp_customize->add_control(new ios_checkbox($wp_customize, 'ahorua_show_mini_cart', [
    'label' => __("Show Mini Cart", 'ahura'),
    'section' => 'ahuraheader',
    'active_callback' => ['\ahura\app\mw_options','get_mod_is_not_active_custom_header']
]));
$wp_customize->add_setting('ahura_mini_cart_hide_content');
$wp_customize->add_control(new ios_checkbox($wp_customize, 'ahura_mini_cart_hide_content', [
    'label' => __("Mini cart hide content", 'ahura'),
    'section' => 'ahuraheader',
    'active_callback' => ['\ahura\app\mw_options','get_mod_is_active_mini_cart']
]));
// minicart icon color
$wp_customize->add_setting('ahura_mini_cart_icon_color', ['default' => '#35495C']);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
	$wp_customize, 'ahura_mini_cart_icon_color', array(
		'label'      => __( 'Mini Cart icon color', 'ahura' ),
		'section'    => 'ahuraheader',
        'active_callback'   =>  ['\ahura\app\mw_options','get_mod_is_active_mini_cart']
	) )
);

$wp_customize->add_setting('ahura_mini_cart_icon_bgcolor');
$wp_customize->add_control(
	new WP_Customize_Color_Control(
	$wp_customize, 'ahura_mini_cart_icon_bgcolor', array(
		'label'      => __( 'Mini Cart icon background color', 'ahura' ),
		'section'    => 'ahuraheader',
        'active_callback'   =>  ['\ahura\app\mw_options','get_mod_is_active_mini_cart']
	) )
);

$wp_customize->add_setting('ahura_show_mini_cart_count');
$wp_customize->add_control(new ios_checkbox($wp_customize, 'ahura_show_mini_cart_count', [
    'label' => __("Show Mini Cart Count", 'ahura'),
    'section' => 'ahuraheader',
    'active_callback' => ['\ahura\app\mw_options','get_mod_is_active_mini_cart']
]));
$wp_customize->add_setting('ahura_mini_cart_count_background_color', ['default' => '#00b0ff']);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
	$wp_customize, 'ahura_mini_cart_count_background_color', array(
		'label'      => __( 'Mini Cart Count Background Color', 'ahura' ),
		'section'    => 'ahuraheader',
		'settings'   => 'ahura_mini_cart_count_background_color',
        'active_callback'   =>  ['ahura\app\mw_options','get_mod_is_active_mini_cart_count']
	) )
);
$wp_customize->add_setting('ahura_mini_cart_count_color', ['default' => '#ffffff']);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
	$wp_customize, 'ahura_mini_cart_count_color', array(
		'label'      => __( 'Mini Cart Count Color', 'ahura' ),
		'section'    => 'ahuraheader',
		'settings'   => 'ahura_mini_cart_count_color',
        'active_callback'   =>  ['ahura\app\mw_options','get_mod_is_active_mini_cart_count']
	) )
);
$wp_customize->add_setting('ahura_mini_cart_checkout_btn_color');
$wp_customize->add_control(
	new WP_Customize_Color_Control(
	$wp_customize, 'ahura_mini_cart_checkout_btn_color', array(
		'label'      => __( 'Mini Cart Checkout Button Color', 'ahura' ),
		'section'    => 'ahuraheader',
		'settings'   => 'ahura_mini_cart_checkout_btn_color',
        'active_callback'   =>  ['ahura\app\mw_options','get_mod_is_active_mini_cart']
	) )
);
$wp_customize->add_setting('ahura_mini_cart_checkout_btn_text_color');
$wp_customize->add_control(
	new WP_Customize_Color_Control(
	$wp_customize, 'ahura_mini_cart_checkout_btn_text_color', array(
		'label'      => __( 'Mini Cart Checkout Button Text Color', 'ahura' ),
		'section'    => 'ahuraheader',
		'settings'   => 'ahura_mini_cart_checkout_btn_text_color',
        'active_callback'   =>  ['ahura\app\mw_options','get_mod_is_active_mini_cart']
	) )
);
$wp_customize->add_setting('ahura_mini_cart_basket_btn_color');
$wp_customize->add_control(
	new WP_Customize_Color_Control(
	$wp_customize, 'ahura_mini_cart_basket_btn_color', array(
		'label'      => __( 'Mini Cart Basket Button Color', 'ahura' ),
		'section'    => 'ahuraheader',
		'settings'   => 'ahura_mini_cart_basket_btn_color',
        'active_callback'   =>  ['ahura\app\mw_options','get_mod_is_active_mini_cart']
	) )
);
$wp_customize->add_setting('ahura_mini_cart_basket_btn_text_color');
$wp_customize->add_control(
	new WP_Customize_Color_Control(
	$wp_customize, 'ahura_mini_cart_basket_btn_text_color', array(
		'label'      => __( 'Mini Cart Basket Button Text Color', 'ahura' ),
		'section'    => 'ahuraheader',
		'settings'   => 'ahura_mini_cart_basket_btn_text_color',
        'active_callback'   =>  ['ahura\app\mw_options','get_mod_is_active_mini_cart']
	) )
);
$wp_customize->add_setting('ahorua_header_popup_login', ['default' => true]);
$wp_customize->add_control(new ios_checkbox($wp_customize, 'ahorua_header_popup_login', [
    'label' => __("Show Header Popup Login", 'ahura'),
    'section' => 'ahuraheader',
    'active_callback' => ['\ahura\app\mw_options','get_mod_is_not_active_custom_header'],
]));
$wp_customize->add_setting('ahura_usage_other_login_forms', ['default' => false]);
$wp_customize->add_control(new ios_checkbox($wp_customize, 'ahura_usage_other_login_forms', [
    'label' => __("Usage other login form", 'ahura'),
    'section' => 'ahuraheader',
    'active_callback' => ['\ahura\app\mw_options','get_mod_is_show_header_popup_login'],
]));
$wp_customize->add_setting('ahura_other_login_form_shortcode');
$wp_customize->add_control(new simple_text($wp_customize, 'ahura_other_login_form_shortcode', [
    'label' => __("Other login form shortcode", 'ahura'),
    'section' => 'ahuraheader',
    'active_callback' => ['\ahura\app\mw_options', 'get_mod_usage_other_login_forms'],
]));
$wp_customize->add_setting('ahura_show_custom_login_form', ['default' => false]);
$wp_customize->add_control(new ios_checkbox($wp_customize, 'ahura_show_custom_login_form', [
    'label' => __("Show Custom Login Form", 'ahura'),
    'section' => 'ahuraheader',
    'active_callback' => function(){
        return \ahura\app\mw_options::get_mod_is_show_header_popup_login() && !\ahura\app\mw_options::get_mod_usage_other_login_forms();
    },
]));
$wp_customize->add_setting('ahura_auto_login_after_register', ['default' => false]);
$wp_customize->add_control(new ios_checkbox($wp_customize, 'ahura_auto_login_after_register', [
    'label' => __("Auto Login After Register", 'ahura'),
    'section' => 'ahuraheader',
    'active_callback' => function(){
        return \ahura\app\mw_options::get_mod_show_custom_login_form() && !\ahura\app\mw_options::get_mod_usage_other_login_forms();
    },
]));
$wp_customize->add_setting('ahura_show_captcha_in_login_form', ['default' => true]);
$wp_customize->add_control(new ios_checkbox($wp_customize, 'ahura_show_captcha_in_login_form', [
    'label' => __("Show Security Code", 'ahura'),
    'section' => 'ahuraheader',
    'active_callback' => function(){
        return \ahura\app\mw_options::get_mod_show_custom_login_form() && !\ahura\app\mw_options::get_mod_usage_other_login_forms();
    },
]));
$wp_customize->add_setting('ahura_popup_login_color');
$wp_customize->add_control('ahura_popup_login_color', [
    'section' => 'ahuraheader',
    'type' => 'color',
    'label' => __('Popup Login Color', 'ahura'),
    'active_callback' => ['\ahura\app\mw_options', 'get_mod_is_show_header_popup_login'],
]);
$wp_customize->add_setting('ahorua_header_popup_login_link');
$wp_customize->add_control(new simple_text($wp_customize, 'ahorua_header_popup_login_link', [
    'label' => __("Header Popup Login URL", 'ahura'),
    'section' => 'ahuraheader',
    'active_callback' => ['\ahura\app\mw_options', 'get_mod_is_show_header_popup_login'],
]));
$wp_customize->add_setting('ahura_header_show_popup_login_register_text');
$wp_customize->add_control(new ios_checkbox($wp_customize, 'ahura_header_show_popup_login_register_text', [
    'label' => __("Show Header Popup Login Register Text", 'ahura'),
    'section' => 'ahuraheader',
    'active_callback' => function(){
        return \ahura\app\mw_options::get_mod_is_show_header_popup_login() && !\ahura\app\mw_options::get_mod_show_custom_login_form();
    },
]));
$wp_customize->add_setting('ahura_header_popup_login_register_text', ['default' => __('Register', 'ahura')]);
$wp_customize->add_control(new simple_text($wp_customize, 'ahura_header_popup_login_register_text', [
    'label' => __("Popup Login Restister Text", 'ahura'),
    'section' => 'ahuraheader',
    'active_callback' => ['\ahura\app\mw_options', 'get_mod_is_show_header_popup_register_button'],
]));
$wp_customize->add_setting('ahura_header_popup_login_register_link', ['default' => wp_registration_url()]);
$wp_customize->add_control(new simple_text($wp_customize, 'ahura_header_popup_login_register_link', [
    'label' => __("Popup Login Restister Link", 'ahura'),
    'section' => 'ahuraheader',
    'active_callback' => ['\ahura\app\mw_options', 'get_mod_is_show_header_popup_register_button'],
]));
$wp_customize->add_setting('ahura_header_popup_login_register_text_dir');
$wp_customize->add_control(new image_radio_box($wp_customize, 'ahura_header_popup_login_register_text_dir', [
    'label' => __("Popup Login Restister Text Direction", 'ahura'),
    'section' => 'ahuraheader',
    'active_callback' => function(){
        return \ahura\app\mw_options::get_mod_is_show_header_popup_login() && !\ahura\app\mw_options::get_mod_show_custom_login_form();
    },
    'type'  =>  'radio',
    'choices' => [
        'right' => 
        [
            'label' => __('Right', 'ahura'),
            'image_url' => get_template_directory_uri() . '/img/customization/header/register_link_alignment_right.png',
        ],
        'left' => 
        [
            'label' => __("Left", 'ahura'),
            'image_url' => get_template_directory_uri() . '/img/customization/header/register_link_alignment_left.png',
        ],
    ],
]));
$wp_customize->add_setting('ahura_header_popup_login_link_to_url');
$wp_customize->add_control(new simple_text($wp_customize, 'ahura_header_popup_login_link_to_url', [
    'label' => __("Link to a URL (No Popup)", 'ahura'),
    'section' => 'ahuraheader',
    'active_callback' => ['\ahura\app\mw_options', 'get_mod_is_show_header_popup_login'],
]));
$wp_customize->add_setting('ahura_header_popup_login_show_log_out');
$wp_customize->add_control(new ios_checkbox($wp_customize, 'ahura_header_popup_login_show_log_out', [
    'label' => __("Show Log Out When User Login", 'ahura'),
    'section' => 'ahuraheader',
    'active_callback' => ['\ahura\app\mw_options','get_mod_is_not_active_custom_header'],
]));
$wp_customize->add_setting('ahura_additional_code_in_header');
$wp_customize->add_control( new simple_text( $wp_customize, 'ahura_additional_code_in_header',[
    'label' => __( 'Add Code to Header', 'ahura' ),
    'section' => 'ahuraheader',
    'type'  => 'textarea',
]));
$wp_customize->add_setting( 'ahura_show_user_loggedin_name', [ 'default'  => false ] );
$wp_customize->add_control( new ios_checkbox( $wp_customize, 'ahura_show_user_loggedin_name', [
    'label'           => __( 'Show logged in user\'s display name', 'ahura' ),
    'section'         => 'ahuraheader',
    'active_callback' => [ '\ahura\app\mw_options', 'get_mod_is_not_active_custom_header' ],
] ) );
$wp_customize->add_setting( 'ahura_user_loggedin_text' );
$wp_customize->add_control( new simple_text( $wp_customize, 'ahura_user_loggedin_text', [
    'label' => __( 'User loggedin message', 'ahura' ),
    'description' => __( 'use "d_name" as display name placeholder. example: Welcome! d_name', 'ahura' ),
    'section' => 'ahuraheader',
    'active_callback' => function(){
        return mw_options::get_mod_is_active_user_loggedin_name() && mw_options::is_active_header_style(1);
    },
]));

$wp_customize->add_setting( 'ahura_user_loggedin_name_color');
$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ahura_user_loggedin_name_color', [
    'label'   => __( 'User display name color','ahura' ),
    'section' => 'ahuraheader',
    'setting' => 'ahura_user_loggedin_name_color',
    'active_callback' => [ '\ahura\app\mw_options', 'get_mod_is_active_user_loggedin_name' ],
] ) );

$wp_customize->add_setting( 'ahura_user_loggedin_name_backcolor', ['default' => '#555'] );
$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ahura_user_loggedin_name_backcolor', [
    'label'   => __( 'User display name background color','ahura' ),
    'section' => 'ahuraheader',
    'setting' => 'ahura_user_loggedin_name_backcolor',
    'active_callback' => function(){
        return mw_options::get_mod_is_active_user_loggedin_name() && mw_options::is_active_header_style(1);
    },
] ) );

$wp_customize->add_setting('theme_viewport_maximum_scale', ['default' => 1]);
$wp_customize->add_control(new simple_text($wp_customize, 'theme_viewport_maximum_scale', [
    'section' => 'ahuraheader',
    'type' => 'number',
    'label' => __('Maximum Scale', 'ahura'),
    'description' => __('For Mobile Device', 'ahura'),
    'input_attrs' => [
        'min' => 1,
    ],
]));

$wp_customize->add_setting('theme_viewport_user_scalable', ['default' => false]);
$wp_customize->add_control(new ios_checkbox($wp_customize, 'theme_viewport_user_scalable', [
    'label' => __('User Scalable', 'ahura'),
    'section' => 'ahuraheader',
    'description' => __('For Mobile Device', 'ahura'),
]));