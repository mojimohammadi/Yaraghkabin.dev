<?php

use ahura\app\customization\image_radio_box;
use ahura\app\customization\ios_checkbox;
use ahura\app\customization\simple_text;
use ahura\app\customization\simple_range;
use ahura\app\customization\simple_notice;
use \ahura\app\mw_options;

// Block direct access to the main plugin file.
defined('ABSPATH') or die('No script kiddies please!');

$wp_customize->add_section('ahura_post', array(
      'title'      => __('Single Post', 'ahura'),
      'priority'   => 3,
));

$wp_customize->add_setting(
    'show_single_post_thumbnail',
    array('default' => 'right')
);
$wp_customize->add_control(new image_radio_box($wp_customize, 'show_single_post_thumbnail', array(
    'label' => __('Post Thumbnail in Content', 'ahura'),
    'section' => 'ahura_post',
    'choices' => array(
        'right' => [
            'label' => __('Right', 'ahura'),
            'image_url' => get_template_directory_uri() . '/img/customization/posts/post_thumbnail_alignment_right.png',
        ],
        'center' => [
            'label' => __('Center', 'ahura'),
            'image_url' => get_template_directory_uri() . '/img/customization/posts/post_thumbnail_alignment_center.png',
        ],
        'left' => [
            'label' => __('Left', 'ahura'),
            'image_url' => get_template_directory_uri() . '/img/customization/posts/post_thumbnail_alignment_left.png',
        ],
        'wide' => [
            'label' => __('Wide', 'ahura'),
            'image_url' => get_template_directory_uri() . '/img/customization/posts/post_thumbnail_alignment_wide.png',
        ],
        'none' => [
            'label' => __('Hide', 'ahura'),
            'image_url' => get_template_directory_uri() . '/img/customization/posts/post_thumbnail_alignment_hidden.png',
        ],
    ),
)));
$wp_customize->add_setting('absolute_thumbnail');
$wp_customize->add_control(new ios_checkbox($wp_customize, 'absolute_thumbnail', array(
    'label' => __('Abosulte thumbnail', 'ahura'),
    'section' => 'ahura_post',
    'active_callback'=> ['\ahura\app\mw_options','is_active_absolute_thumbnail'],
)));
$wp_customize->add_setting('show_single_post_title', ['default' => true]);
$wp_customize->add_control(new ios_checkbox($wp_customize, 'show_single_post_title', array(
    'label' => __('Show Title', 'ahura'),
    'section' => 'ahura_post',
)));
$wp_customize->add_setting('show_tags', ['default' => true]);
$wp_customize->add_control(new ios_checkbox($wp_customize, 'show_tags', array(
    'label' => __('Show Tags', 'ahura'),
    'section' => 'ahura_post',
)));
$wp_customize->add_setting('show_content_types', ['default' => true]);
$wp_customize->add_control(new ios_checkbox($wp_customize, 'show_content_types', array(
    'label' => __('Show Content Types', 'ahura'),
    'section' => 'ahura_post',
)));
$wp_customize->add_setting('post-meta-comments', ['default'  => true]);
$wp_customize->add_control(new ios_checkbox($wp_customize, 'post-meta-comments', array(
    'label' => __('Show Comments Count', 'ahura'),
    'section' => 'ahura_post',
)));
$wp_customize->add_setting('show_categories', ['default'  => true]);
$wp_customize->add_control(new ios_checkbox($wp_customize, 'show_categories', array(
    'label' => __('Show categories', 'ahura'),
    'section' => 'ahura_post',
)));
$wp_customize->get_setting('show_tags')->transport   = 'postMessage';
$wp_customize->selective_refresh->add_partial('show_tags', array(
            'selector' => '.post-entry #tags',
            'render_callback' => '__return_false',
));
$wp_customize->add_setting('show_author', ['default' => true]);
$wp_customize->add_control(new ios_checkbox($wp_customize, 'show_author', array(
    'label' => __('Show Post Author', 'ahura'),
    'section' => 'ahura_post',
)));
$wp_customize->get_setting('show_author')->transport   = 'postMessage';
$wp_customize->selective_refresh->add_partial('show_author', array(
            'selector' => '.post-entry .authorbox',
            'render_callback' => '__return_false',
));
$wp_customize->add_setting('show_date');
$wp_customize->add_control(new ios_checkbox($wp_customize, 'show_date', array(
    'label' => __('Show post date', 'ahura'),
    'section' => 'ahura_post',
)));
$wp_customize->add_setting( 'show_update_date' );
$wp_customize->add_control(new ios_checkbox($wp_customize, 'show_update_date', [
    'label'     => __( 'Show post update date', 'ahura' ),
    'section'   => 'ahura_post',
] ) );
$wp_customize->add_setting( 'post_update_date_icon', [ 'default' => 'fas fa-history' ] );
$wp_customize->add_control( new simple_text( $wp_customize, 'post_update_date_icon', [
    'label'     => __( 'Post update date icon', 'ahura' ),
    'description' => __( 'Use font awesome 5 icon. Example: fas fa-history', 'ahura' ),
    'section'   => 'ahura_post',
    'active_callback'   =>  [ '\ahura\app\mw_options', 'get_mod_is_active_post_show_update_date' ]
] ) );
$wp_customize->add_setting( 'post_update_date_text' );
$wp_customize->add_control( new simple_text( $wp_customize, 'post_update_date_text', [
    'label' => __( 'Update date text', 'ahura' ),
    'section' => 'ahura_post',
    'active_callback' => [ '\ahura\app\mw_options', 'get_mod_is_active_post_show_update_date' ],
] ) );
$wp_customize->add_setting( 'post_update_date_text_color', [ 'default' => '#333333' ] );
$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'post_update_date_text_color', [
    'label'     => __( 'Post update date text color', 'ahura' ),
    'section'   => 'ahura_post',
    'settings'  => 'post_update_date_text_color',
    'active_callback'   =>  [ '\ahura\app\mw_options', 'get_mod_is_active_post_show_update_date' ]
] ) );
$wp_customize->add_setting( 'post_update_date_text_backcolor', [ 'default' => '#ffffff' ] );
$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'post_update_date_text_backcolor', [
    'label'     => __( 'Post update date text background color', 'ahura' ),
    'section'   => 'ahura_post',
    'settings'  => 'post_update_date_text_backcolor',
    'active_callback'   =>  [ '\ahura\app\mw_options', 'get_mod_is_active_post_show_update_date' ]
] ) );

$des_wbc = \ahura\app\mw_options::is_ahura_builder_accessible() ? esc_html__('This feature is disabled in pages that are build with elementor.', 'ahura') : '';
$wp_customize->add_setting('ahura_show_widgets_between_post_content', ['default' => true]);
$wp_customize->add_control(new ios_checkbox($wp_customize, 'ahura_show_widgets_between_post_content', array(
    'label' => __('Widgets between content', 'ahura'),
    'section' => 'ahura_post',
    'description' => $des_wbc
)));

$wp_customize->add_setting('ahura_widgets_between_post_content_position', ['default' => 1]);
$wp_customize->add_control(new simple_text($wp_customize, 'ahura_widgets_between_post_content_position', [
    'type' => 'number',
    'label' => __('Widgets between content position', 'ahura'),
    'section' => 'ahura_post',
    'active_callback' => ['\ahura\app\mw_options', 'get_mod_show_widgets_between_post_content'],
]));

$wp_customize->add_setting('single_post_show_titles_helper_box', ['default' => false]);
$wp_customize->add_control(new ios_checkbox($wp_customize, 'single_post_show_titles_helper_box', [
    'label'     => __( 'Show Titles Helper Box', 'ahura' ),
    'section'   => 'ahura_post',
] ) );

$wp_customize->add_setting('show_relatedposts', ['default'  => true]);
$wp_customize->add_control(new ios_checkbox($wp_customize, 'show_relatedposts', array(
    'label' => __('Related Posts', 'ahura'),
    'section' => 'ahura_post',
)));
$wp_customize->add_setting('show_relatedposts_ontags', ['default'  => false]);
$wp_customize->add_control(new ios_checkbox($wp_customize, 'show_relatedposts_ontags', array(
    'label' => __('Related Posts on tags', 'ahura'),
    'section' => 'ahura_post',
    'active_callback'   =>  ['\ahura\app\mw_options','get_mod_is_active_relatedpost']
)));
$wp_customize->add_setting( 'relatedposts_img_height', [ 'default' => 100 ] );
$wp_customize->add_control(
    new simple_range( $wp_customize, 'relatedposts_img_height', [
        'label' => __( 'Related posts image height', 'ahura' ),
        'description' => __( 'Default 100px', 'ahura' ),
        'section' => 'ahura_post',
        'active_callback'   =>  ['\ahura\app\mw_options','get_mod_is_active_relatedpost'],
        'input_attrs' => [
            'min' => 50,
            'max' => 500,
        ],
    ] )
);
$wp_customize->add_setting( 'relatedposts_img_darkness', [ 'default' => 0 ] );
$wp_customize->add_control(
    new simple_range( $wp_customize, 'relatedposts_img_darkness', [
        'label' => __( 'Related posts image darkness', 'ahura' ),
        'section' => 'ahura_post',
        'active_callback'   =>  ['\ahura\app\mw_options','get_mod_is_active_relatedpost'],
        'input_attrs' => [
            'min' => 0,
            'max' => 100,
        ],
    ] )
);
$wp_customize->add_setting('show_breadcrumb');
$wp_customize->add_control(new ios_checkbox($wp_customize, 'show_breadcrumb', [
    'label' => __('Show Breadcrumb', 'ahura'),
    'section' => 'ahura_post'
]));
$wp_customize->add_setting('breadcrumb');
$wp_customize->add_control(new image_radio_box($wp_customize, 'breadcrumb', [
    'label' => __('Breadcrumb Dispaly Mode', 'ahura'),
    'section' => 'ahura_post',
    'choices' => array(
        'one' => [
            'label' => __('One', 'ahura'),
            'image_url' => get_template_directory_uri() . '/img/customization/posts/breadcrumb_mode_mode_1.png',
        ],
        'two' => [
            'label' => __('Two', 'ahura'),
            'image_url' => get_template_directory_uri() . '/img/customization/posts/breadcrumb_mode_mode_2.png',
        ],
    ),
    'active_callback'   =>  ['\ahura\app\mw_options','get_mod_is_active_breadcrumb']
]));
$wp_customize->add_setting('breadcrumb_seprator');
$wp_customize->add_control('breadcrumb_seprator', [
    'type' => 'text',
    'section' => 'ahura_post',
    'label' => __('Breadcrumb seprator', 'ahura'),
    'active_callback'   =>  ['\ahura\app\mw_options','get_mod_is_active_breadcrumb']
]);
$wp_customize->get_setting('show_relatedposts')->transport   = 'postMessage';
$wp_customize->selective_refresh->add_partial('show_relatedposts', array(
            'selector' => '.related-posts',
            'render_callback' => '__return_false',
));
if (get_bloginfo('language') == 'fa-IR') {
    if (get_theme_mod('ahura_custom_font')) {
        $wp_customize->add_setting('ahura_post_font_family', [
            'sanitize_callback' => ['\ahura\app\mw_options', 'sanitize_select_field']
        ]);
        $wp_customize->add_control('ahura_post_font_family', [
            'section' => 'ahura_post',
            'type' => 'select',
            'label' => __("Post Paragraph Font Family", 'ahura'),
            'choices' => mw_options::get_ahura_fonts(),
        ]);
    } else {
        $wp_customize->add_setting('ahura_post_font_family', [
            'sanitize_callback' => ['\ahura\app\mw_options', 'sanitize_select_field']
        ]);
        $wp_customize->add_control('ahura_post_font_family', [
            'section' => 'ahura_post',
            'type' => 'select',
            'label' => __("Post Paragraph Font Family", 'ahura'),
            'choices' => mw_options::get_ahura_fonts(),
        ]);
    }
} else {
    $wp_customize->add_setting('ahura_en_post_font_family', [
        'default' => 'default_font',
        'sanitize_callback' => ['\ahura\app\mw_options', 'sanitize_select_field']
    ]);
    $wp_customize->add_control('ahura_en_post_font_family', [
        'section' => 'ahura_post',
        'type' => 'select',
        'label' => "Theme Font",
        'choices' => mw_options::get_ahura_fonts()
    ]);
}
$wp_customize->add_setting('ahura_post_content_font_weight');
$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'ahura_post_content_font_weight', array(
    'label' => __('Post content font weight', 'ahura'),
    'section' => 'ahura_post',
    'type'  =>  'select',
    'choices' => mw_options::get_font_weights()
)));
if (get_bloginfo('language') == 'fa-IR') {
    $wp_customize->add_setting('ahura_post_title_font_family', [
        'sanitize_callback' => ['\ahura\app\mw_options', 'sanitize_select_field']
    ]);
    $wp_customize->add_control('ahura_post_title_font_family', [
        'section' => 'ahura_post',
        'type' => 'select',
        'label' => __("Post Title Font Family", 'ahura'),
        'choices' => mw_options::get_ahura_fonts(),
    ]);
} else {
    $wp_customize->add_setting('ahura_en_post_title_font_family', [
        'default' => 'default_font',
        'sanitize_callback' => ['\ahura\app\mw_options', 'sanitize_select_field']
    ]);
    $wp_customize->add_control('ahura_en_post_title_font_family', [
        'section' => 'ahura_post',
        'type' => 'select',
        'label' => "Theme Font",
        'choices' => mw_options::get_ahura_fonts()
    ]);
}
$wp_customize->add_setting('ahura_post_title_font_weight');
$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'ahura_post_title_font_weight', array(
    'label' => __('Post title font weight', 'ahura'),
    'section' => 'ahura_post',
    'type'  =>  'select',
    'choices' => mw_options::get_font_weights()
)));
if (get_bloginfo('language') == 'fa-IR') {
    $wp_customize->add_setting('ahura_single_post_author_font_family', [
        'sanitize_callback' => ['\ahura\app\mw_options', 'sanitize_select_field']
    ]);
    $wp_customize->add_control('ahura_single_post_author_font_family', [
        'section' => 'ahura_post',
        'type' => 'select',
        'label' => __("Post author font family", 'ahura'),
        'choices' => mw_options::get_ahura_fonts(),
    ]);
} else {
    $wp_customize->add_setting('ahura_en_single_post_author_font_family', [
        'default' => 'default_font',
        'sanitize_callback' => ['\ahura\app\mw_options', 'sanitize_select_field']
    ]);
    $wp_customize->add_control('ahura_en_single_post_author_font_family', [
        'section' => 'ahura_post',
        'type' => 'select',
        'label' => "Post author font family",
        'choices' => mw_options::get_ahura_fonts()
    ]);
}
$wp_customize->add_setting('single_post_author_font_weight');
$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'single_post_author_font_weight', array(
    'label' => __('Post author font wright', 'ahura'),
    'section' => 'ahura_post',
    'type'  =>  'select',
    'choices' => mw_options::get_font_weights()
)));

if (get_bloginfo('language') == 'fa-IR') {
    $wp_customize->add_setting('ahura_single_post_cats_font_family', [
        'sanitize_callback' => ['\ahura\app\mw_options', 'sanitize_select_field']
    ]);
    $wp_customize->add_control('ahura_single_post_cats_font_family', [
        'section' => 'ahura_post',
        'type' => 'select',
        'label' => __("Post cats font family", 'ahura'),
        'choices' => mw_options::get_ahura_fonts(),
    ]);
} else {
    $wp_customize->add_setting('ahura_en_single_post_cats_font_family', [
        'default' => 'default_font',
        'sanitize_callback' => ['\ahura\app\mw_options', 'sanitize_select_field']
    ]);
    $wp_customize->add_control('ahura_en_single_post_cats_font_family', [
        'section' => 'ahura_post',
        'type' => 'select',
        'label' => "Post cats font family",
        'choices' => mw_options::get_ahura_fonts()
    ]);
}
$wp_customize->add_setting('single_post_cats_font_weight');
$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'single_post_cats_font_weight', array(
    'label' => __('Post cats font weight', 'ahura'),
    'section' => 'ahura_post',
    'type'  =>  'select',
    'choices' => mw_options::get_font_weights()
)));

if (get_bloginfo('language') == 'fa-IR') {
    $wp_customize->add_setting('ahura_single_post_comment_count_font_family', [
        'sanitize_callback' => ['\ahura\app\mw_options', 'sanitize_select_field']
    ]);
    $wp_customize->add_control('ahura_single_post_comment_count_font_family', [
        'section' => 'ahura_post',
        'type' => 'select',
        'label' => __("Post comment count font family", 'ahura'),
        'choices' => mw_options::get_ahura_fonts(),
    ]);
} else {
    $wp_customize->add_setting('ahura_en_single_post_comment_count_font_family', [
        'default' => 'default_font',
        'sanitize_callback' => ['\ahura\app\mw_options', 'sanitize_select_field']
    ]);
    $wp_customize->add_control('ahura_en_single_post_comment_count_font_family', [
        'section' => 'ahura_post',
        'type' => 'select',
        'label' => "Post comment count font family",
        'choices' => mw_options::get_ahura_fonts()
    ]);
}
$wp_customize->add_setting('single_post_comment_count_font_weight');
$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'single_post_comment_count_font_weight', array(
    'label' => __('Post comment count font weight', 'ahura'),
    'section' => 'ahura_post',
    'type'  =>  'select',
    'choices' => mw_options::get_font_weights()
)));

if (get_bloginfo('language') == 'fa-IR') {
    $wp_customize->add_setting('ahura_single_post_date_font_family', [
        'sanitize_callback' => ['\ahura\app\mw_options', 'sanitize_select_field']
    ]);
    $wp_customize->add_control('ahura_single_post_date_font_family', [
        'section' => 'ahura_post',
        'type' => 'select',
        'label' => __("Post date font family", 'ahura'),
        'choices' => mw_options::get_ahura_fonts(),
    ]);
} else {
    $wp_customize->add_setting('ahura_en_single_post_date_font_family', [
        'default' => 'default_font',
        'sanitize_callback' => ['\ahura\app\mw_options', 'sanitize_select_field']
    ]);
    $wp_customize->add_control('ahura_en_single_post_date_font_family', [
        'section' => 'ahura_post',
        'type' => 'select',
        'label' => "Post date font family",
        'choices' => mw_options::get_ahura_fonts()
    ]);
}
$wp_customize->add_setting('single_post_date_font_weight');
$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'single_post_date_font_weight', array(
    'label' => __('Post date font weight', 'ahura'),
    'section' => 'ahura_post',
    'type'  =>  'select',
    'choices' => mw_options::get_font_weights()
)));

$wp_customize->add_setting('single_post_author_name_font_size');
$wp_customize->add_control(new simple_text($wp_customize, 'single_post_author_name_font_size', array(
    'label' => __('Post author font size', 'ahura'),
    'section' => 'ahura_post',
    'type'    => 'number',
)));

$wp_customize->add_setting('single_post_cats_font_size');
$wp_customize->add_control(new simple_text($wp_customize, 'single_post_cats_font_size', array(
    'label' => __('Post cats font size', 'ahura'),
    'section' => 'ahura_post',
    'type'    => 'number',
)));

$wp_customize->add_setting('single_post_comment_count_font_size');
$wp_customize->add_control(new simple_text($wp_customize, 'single_post_comment_count_font_size', array(
    'label' => __('Post comment count font size', 'ahura'),
    'section' => 'ahura_post',
    'type'    => 'number',
)));

$wp_customize->add_setting('single_post_date_font_size');
$wp_customize->add_control(new simple_text($wp_customize, 'single_post_date_font_size', array(
    'label' => __('Post date font size', 'ahura'),
    'section' => 'ahura_post',
    'type'    => 'number',
)));

$wp_customize->add_setting('post_paragraph_size');
$wp_customize->add_control(new simple_text($wp_customize, 'post_paragraph_size', array(
    'label' => __('Post paragraph font size', 'ahura'),
    'section' => 'ahura_post',
    'description' => __('Default 16px', 'ahura'),
    'type'    => 'number',
)));

$wp_customize->add_setting('post_paragraph_size');
$wp_customize->add_control(new simple_text($wp_customize, 'post_paragraph_size', array(
    'label' => __('Post paragraph font size', 'ahura'),
    'section' => 'ahura_post',
    'description' => __('Default 16px', 'ahura'),
    'type'    => 'number',
)));

$wp_customize->add_setting('post_paragraph_size');
$wp_customize->add_control(new simple_text($wp_customize, 'post_paragraph_size', array(
    'label' => __('Post paragraph font size', 'ahura'),
    'section' => 'ahura_post',
    'description' => __('Default 16px', 'ahura'),
    'type'    => 'number',
)));

$wp_customize->add_setting('post_paragraph_a_size');
$wp_customize->add_control(new simple_text($wp_customize, 'post_paragraph_a_size', array(
    'label' => __('Post paragraph link font size', 'ahura'),
    'section' => 'ahura_post',
    'description' => __('Default 16px', 'ahura'),
    'type'    => 'number',
)));
$wp_customize->add_setting('ahura_post_title_font_size');
$wp_customize->add_control(new simple_text($wp_customize, 'ahura_post_title_font_size', array(
    'label' => __('Post Title Fotn Size', 'ahura'),
    'section' => 'ahura_post',
    'type'  =>  'number',
)));

$wp_customize->add_setting('ahura_post_content_h1_font_weight');
$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'ahura_post_content_h1_font_weight', array(
    'label' => __('H1 font weight', 'ahura'),
    'section' => 'ahura_post',
    'type'  =>  'select',
    'choices' => mw_options::get_font_weights()
)));

$wp_customize->add_setting('ahura_post_content_h2_font_weight');
$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'ahura_post_content_h2_font_weight', array(
    'label' => __('H2 font weight', 'ahura'),
    'section' => 'ahura_post',
    'type'  =>  'select',
    'choices' => mw_options::get_font_weights()
)));

$wp_customize->add_setting('ahura_post_content_h3_font_weight');
$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'ahura_post_content_h3_font_weight', array(
    'label' => __('H3 font weight', 'ahura'),
    'section' => 'ahura_post',
    'type'  =>  'select',
    'choices' => mw_options::get_font_weights()
)));

$wp_customize->add_setting('ahura_post_content_h4_font_weight');
$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'ahura_post_content_h4_font_weight', array(
    'label' => __('H4 font weight', 'ahura'),
    'section' => 'ahura_post',
    'type'  =>  'select',
    'choices' => mw_options::get_font_weights()
)));

$wp_customize->add_setting('ahura_post_content_h5_font_weight');
$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'ahura_post_content_h5_font_weight', array(
    'label' => __('H5 font weight', 'ahura'),
    'section' => 'ahura_post',
    'type'  =>  'select',
    'choices' => mw_options::get_font_weights()
)));

$wp_customize->add_setting('ahura_post_content_h6_font_weight');
$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'ahura_post_content_h6_font_weight', array(
    'label' => __('H6 font weight', 'ahura'),
    'section' => 'ahura_post',
    'type'  =>  'select',
    'choices' => mw_options::get_font_weights()
)));

$wp_customize->add_setting('post_paragraph_color', ['default' => '#35495c']);
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'post_paragraph_color', array(
    'label' => __('Post paragraph color', 'ahura'),
    'section' => 'ahura_post',
    'settings' => 'post_paragraph_color',
)));

$wp_customize->add_setting('post_paragraph_a_color', ['default' => '#35495c']);
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'post_paragraph_a_color', array(
    'label' => __('Post paragraph link color', 'ahura'),
    'section' => 'ahura_post',
    'settings' => 'post_paragraph_a_color',
)));

$wp_customize->add_setting('comment_send_button_background');
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'comment_send_button_background', array(
    'label' => __('Commcnt Send Button Background', 'ahura'),
    'section' => 'ahura_post',
    'settings' => 'comment_send_button_background',
)));
$wp_customize->add_setting('comment_send_button_color');
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'comment_send_button_color', array(
    'label' => __('Comment Send Button Color', 'ahura'),
    'section' => 'ahura_post',
    'settings' => 'comment_send_button_color',
)));


$wp_customize->add_setting('ahura_post_title_color');
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'ahura_post_title_color', array(
    'label' => __('Post Title Color', 'ahura'),
    'section' => 'ahura_post',
    'settings' => 'ahura_post_title_color',
)));
$wp_customize->add_setting('ahura_post_background_color');
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'ahura_post_background_color', array(
    'label' => __('Post Background Color', 'ahura'),
    'section' => 'ahura_post',
    'settings' => 'ahura_post_background_color',
)));
$wp_customize->add_setting( 'ahura_post_quote', [ 'default' => 'column' ] );
$wp_customize->add_control( 'ahura_post_quote', [
    'type' => 'select',
    'section' => 'ahura_post',
    'label' => __( 'Quote citation position', 'ahura' ),
    'settings' => 'ahura_post_quote',
    'choices' => [
        'column-reverse' => __( 'top', 'ahura' ),
        'row-reverse' => __( 'right', 'ahura' ),
        'column' => __( 'bottom', 'ahura' ),
        'row' => __( 'left', 'ahura' ),
    ],
] );
$wp_customize->add_setting( 'ahura_comment_form_controls', [ 'default'  => false ] );
$wp_customize->add_control( new ios_checkbox( $wp_customize, 'ahura_comment_form_controls', [
    'label' => __( 'Controls single post comment area fields', 'ahura' ),
    'section' => 'ahura_post',
] ) );
$wp_customize->add_setting( 'ahura_email_fields_notice', [ 'default' => '' ] );
$wp_customize->add_control( new simple_notice( $wp_customize, 'ahura_email_fields_notice',[
    'description' => __( 'Please disable required email and name\'s field from admin area > options > discussion', 'ahura' ),
    'section' => 'ahura_post',
    'active_callback' => ['\ahura\app\mw_options','get_mod_is_active_email_form_controls'],
	]
) );
$wp_customize->add_setting( 'ahura_comment_form_name_control', [ 'default'  => false ] );
$wp_customize->add_control( new ios_checkbox( $wp_customize, 'ahura_comment_form_name_control', [
    'label' => __( 'Disable name field in comment area', 'ahura' ),
    'section' => 'ahura_post',
    'active_callback' => ['\ahura\app\mw_options','get_mod_is_active_email_form_controls'],
] ) );
$wp_customize->add_setting( 'ahura_comment_form_email_control', [ 'default'  => false ] );
$wp_customize->add_control( new ios_checkbox( $wp_customize, 'ahura_comment_form_email_control', [
    'label' => __( 'Disable email field in comment area', 'ahura' ),
    'section' => 'ahura_post',
    'active_callback' => ['\ahura\app\mw_options','get_mod_is_active_email_form_controls'],
] ) );
$wp_customize->add_setting( 'ahura_comment_form_url_control', [ 'default'  => false ] );
$wp_customize->add_control( new ios_checkbox( $wp_customize, 'ahura_comment_form_url_control', [
    'label' => __( 'Disable url field in comment area', 'ahura' ),
    'section' => 'ahura_post',
    'active_callback' => ['\ahura\app\mw_options','get_mod_is_active_email_form_controls'],
] ) );
$wp_customize->add_setting( 'ahura_switch_sidebar_order_mobile', [ 'default'  => false ] );
$wp_customize->add_control( new ios_checkbox( $wp_customize, 'ahura_switch_sidebar_order_mobile', [
    'label' => __( 'Switch sidebar and main content order in mobile view', 'ahura' ),
    'section' => 'ahura_post',
] ) );

$wp_customize->add_setting('ahura_show_post_like_box', ['default' => false]);
$wp_customize->add_control(new ios_checkbox($wp_customize, 'ahura_show_post_like_box', [
    'label' => __('Post like', 'ahura'),
    'section' => 'ahura_post',
]));

$wp_customize->add_setting('ahura_post_like_save_data_for_user', ['default' => false]);
$wp_customize->add_control(new ios_checkbox($wp_customize, 'ahura_post_like_save_data_for_user', [
    'label' => __('Save like data for logged in user', 'ahura'),
    'section' => 'ahura_post',
]));

$wp_customize->add_setting('get_mod_post_like_save_data_for_user_notice', ['default' => '']);
$wp_customize->add_control(new simple_notice($wp_customize, 'get_mod_post_like_save_data_for_user_notice',[
    'description' => __('Note: if the number of users of your website if high, it is recommended not to use this possibility, if it is used, the size of the usermeta database may increase significantly.', 'ahura'),
    'section' => 'ahura_post',
    'active_callback' => ['\ahura\app\mw_options','get_mod_post_like_save_data_for_user'],
	]
));

$wp_customize->add_setting('ahura_post_like_box_title', ['default' => esc_html__('Was this post helpful to you?', 'ahura')]);
$wp_customize->add_control(new simple_text( $wp_customize, 'ahura_post_like_box_title', [
    'label'     => __('Post like box title', 'ahura'),
    'section'   => 'ahura_post',
    'active_callback'   =>  ['\ahura\app\mw_options', 'get_mod_show_post_like_box']
]));

$wp_customize->add_setting('ahura_post_like_button_title', ['default' => esc_html__('Yes', 'ahura')]);
$wp_customize->add_control(new simple_text( $wp_customize, 'ahura_post_like_button_title', [
    'label'     => __('Post like button title', 'ahura'),
    'section'   => 'ahura_post',
    'active_callback'   =>  ['\ahura\app\mw_options', 'get_mod_show_post_like_box']
]));

$wp_customize->add_setting('ahura_post_dislike_button_title', ['default' => esc_html__('No', 'ahura')]);
$wp_customize->add_control(new simple_text( $wp_customize, 'ahura_post_dislike_button_title', [
    'label'     => __('Post dislike button title', 'ahura'),
    'section'   => 'ahura_post',
    'active_callback'   =>  ['\ahura\app\mw_options', 'get_mod_show_post_like_box']
]));

$wp_customize->add_setting('ahura_post_like_box_bg_color');
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'ahura_post_like_box_bg_color', array(
    'label' => __('Post like box background color', 'ahura'),
    'section' => 'ahura_post',
    'settings' => 'ahura_post_like_box_bg_color',
    'active_callback'   =>  ['\ahura\app\mw_options', 'get_mod_show_post_like_box']
)));

$wp_customize->add_setting('ahura_post_like_box_title_color');
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'ahura_post_like_box_title_color', array(
    'label' => __('Post like box title color', 'ahura'),
    'section' => 'ahura_post',
    'settings' => 'ahura_post_like_box_title_color',
    'active_callback'   =>  ['\ahura\app\mw_options', 'get_mod_show_post_like_box']
)));

$wp_customize->add_setting('ahura_post_like_button_text_color');
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'ahura_post_like_button_text_color', array(
    'label' => __('Post like button text color', 'ahura'),
    'section' => 'ahura_post',
    'settings' => 'ahura_post_like_button_text_color',
    'active_callback'   =>  ['\ahura\app\mw_options', 'get_mod_show_post_like_box']
)));

$wp_customize->add_setting('ahura_post_like_button_color');
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'ahura_post_like_button_color', array(
    'label' => __('Post like button color', 'ahura'),
    'section' => 'ahura_post',
    'settings' => 'ahura_post_like_button_color',
    'active_callback'   =>  ['\ahura\app\mw_options', 'get_mod_show_post_like_box']
)));

$wp_customize->add_setting('ahura_post_dislike_button_text_color');
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'ahura_post_dislike_button_text_color', array(
    'label' => __('Post dislike button text color', 'ahura'),
    'section' => 'ahura_post',
    'settings' => 'ahura_post_dislike_button_text_color',
    'active_callback'   =>  ['\ahura\app\mw_options', 'get_mod_show_post_like_box']
)));

$wp_customize->add_setting('ahura_post_dislike_button_color');
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'ahura_post_dislike_button_color', array(
    'label' => __('Post dislike button color', 'ahura'),
    'section' => 'ahura_post',
    'settings' => 'ahura_post_dislike_button_color',
    'active_callback'   =>  ['\ahura\app\mw_options', 'get_mod_show_post_like_box']
)));