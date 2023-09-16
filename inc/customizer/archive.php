<?php

// Block direct access to the main plugin file.

use ahura\app\customization\ios_checkbox;
use ahura\app\customization\simple_text;
use ahura\app\customization\simple_select_box;
use \ahura\app\mw_options;

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );


$wp_customize->add_section( 'ahura_archive' , array(
      'title'      => __( 'Blog Settings', 'ahura' ),
      'priority'   => 6,
));

$theme_post_types = \ahura\app\mw_post_type::get_post_types();
$types = array();
if($theme_post_types){
    foreach ($theme_post_types as $key => $value) {
        if(is_array($value) && isset($value['is_public'])){
            if($value['is_public'] == true){
                $types[$key] = $value['labels']['singular_name'];
            }
        }
    }    
}

$wp_customize->add_setting('ahura_disabled_post_types');
$wp_customize->add_control(new simple_select_box($wp_customize, 'ahura_disabled_post_types', [
    'section' => 'ahura_archive',
    'label' => __('Disabled post types', 'ahura'),
    'choices' => $types,
    'input_attrs' => [
        'multiple' => true,
        'class' => 'ahura-select'
    ],
]));

$wp_customize->add_setting('post-meta-time', ['default'  => true]);
$wp_customize->add_control(new ios_checkbox($wp_customize, 'post-meta-time', array(
    'label' => __( 'Show Time in Archive', 'ahura' ),
    'section' => 'ahura_archive',
)));
$wp_customize->get_setting( 'post-meta-time' )->transport   = 'postMessage';
$wp_customize->selective_refresh->add_partial( 'post-meta-time', array(
            'selector' => '.post-meta li:nth-child(1)',
            'render_callback' => '__return_false',
) );
$wp_customize->add_setting('post-meta-author', ['default'  => true]);
$wp_customize->add_control(new ios_checkbox($wp_customize, 'post-meta-author', array(
    'label' => __( 'Show Author', 'ahura' ),
    'section' => 'ahura_archive',
)));
$wp_customize->get_setting( 'post-meta-author' )->transport   = 'postMessage';
$wp_customize->selective_refresh->add_partial( 'post-meta-author', array(
            'selector' => '.post-meta li:nth-child(2)',
            'render_callback' => '__return_false',
) );
$wp_customize->add_setting('use_ahura_player');
$wp_customize->add_control(new ios_checkbox($wp_customize, 'use_ahura_player', array(
    'label' => __( 'Use Ahura player', 'ahura' ),
    'section' => 'ahura_archive',
)));
$wp_customize->add_setting('cat_box_desc');
$wp_customize->add_control(new ios_checkbox($wp_customize, 'cat_box_desc', array(
    'label' => __( 'Hide Category Page Post Box Description', 'ahura' ),
    'section' => 'ahura_archive',
)));
$wp_customize->add_setting('blog_archive_hide_title_box');
$wp_customize->add_control(new ios_checkbox($wp_customize, 'blog_archive_hide_title_box', array(
    'label' => __( 'Hide Category Title Box', 'ahura' ),
    'section' => 'ahura_archive',
)));
$wp_customize->add_setting('blog_archive_hide_description');
$wp_customize->add_control(new ios_checkbox($wp_customize, 'blog_archive_hide_description', array(
    'label' => __( 'Hide Category Description', 'ahura' ),
    'section' => 'ahura_archive',
)));
$wp_customize->add_setting('archive_show_content_types', ['default' => true]);
$wp_customize->add_control(new ios_checkbox($wp_customize, 'archive_show_content_types', array(
    'label' => __('Show Content Types', 'ahura'),
    'section' => 'ahura_archive',
)));
$wp_customize->add_setting('ahura_new_posts_label_status', ['default' => false]);
$wp_customize->add_control(new ios_checkbox($wp_customize, 'ahura_new_posts_label_status', array(
    'label' => __('New posts label status', 'ahura'),
    'section' => 'ahura_archive',
)));
$wp_customize->add_setting('ahura_new_posts_label_days_ago', ['default' => 5]);
$wp_customize->add_control(new simple_text($wp_customize, 'ahura_new_posts_label_days_ago', array(
    'label' => __('Last days ago for new post label', 'ahura'),
    'section' => 'ahura_archive',
    'type'  =>  'number'
)));
$wp_customize->add_setting('post_title_color');
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'post_title_color', array(
    'label' => __( 'Post title color', 'ahura' ),
    'section' => 'ahura_archive',
)));
$wp_customize->add_setting('post_title_font_size');
$wp_customize->add_control(new simple_text($wp_customize, 'post_title_font_size', array(
    'label' => __( 'Post title font size', 'ahura' ),
    'section' => 'ahura_archive',
    'type'  =>  'number'
)));
$wp_customize->add_setting('post_title_font_family');
$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'post_title_font_family', array(
    'label' => __( 'Post title font family', 'ahura' ),
    'section' => 'ahura_archive',
    'type'  =>  'select',
    'choices'=> mw_options::get_ahura_fonts()
)));
$wp_customize->add_setting('post_title_font_weight');
$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'post_title_font_weight', array(
    'label' => __( 'Post title font weight', 'ahura' ),
    'section' => 'ahura_archive',
    'type'  =>  'select',
    'choices' => mw_options::get_font_weights()
)));
$wp_customize->add_setting('post_description_color');
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'post_description_color', array(
    'label' => __( 'Post description color', 'ahura' ),
    'section' => 'ahura_archive',
)));
$wp_customize->add_setting('post_description_font_size');
$wp_customize->add_control(new simple_text($wp_customize, 'post_description_font_size', array(
    'label' => __( 'Post description font size', 'ahura' ),
    'section' => 'ahura_archive',
    'type'  =>  'number'
)));
$wp_customize->add_setting('post_description_font_family');
$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'post_description_font_family', array(
    'label' => __( 'Post description font family', 'ahura' ),
    'section' => 'ahura_archive',
    'type'  =>  'select',
    'choices'=> mw_options::get_ahura_fonts()
)));
$wp_customize->add_setting('post_description_font_weight');
$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'post_description_font_weight', array(
    'label' => __( 'Post title font wright', 'ahura' ),
    'section' => 'ahura_archive',
    'type'  =>  'select',
    'choices' => mw_options::get_font_weights()
)));
$wp_customize->add_setting('post_author_color');
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'post_author_color', array(
    'label' => __( 'Post author color', 'ahura' ),
    'section' => 'ahura_archive',
)));
$wp_customize->add_setting('post_author_font_size');
$wp_customize->add_control(new simple_text($wp_customize, 'post_author_font_size', array(
    'label' => __( 'Post author font size', 'ahura' ),
    'section' => 'ahura_archive',
    'type'  =>  'number'
)));
$wp_customize->add_setting('post_author_font_family');
$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'post_author_font_family', array(
    'label' => __( 'Post author font family', 'ahura' ),
    'section' => 'ahura_archive',
    'type'  =>  'select',
    'choices'=> mw_options::get_ahura_fonts()
)));
$wp_customize->add_setting('post_author_font_weight');
$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'post_author_font_weight', array(
    'label' => __( 'Post author font wright', 'ahura' ),
    'section' => 'ahura_archive',
    'type'  =>  'select',
    'choices' => mw_options::get_font_weights()
)));
$wp_customize->add_setting('post_time_color');
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'post_time_color', array(
    'label' => __( 'Post time color', 'ahura' ),
    'section' => 'ahura_archive',
)));
$wp_customize->add_setting('post_time_font_size');
$wp_customize->add_control(new simple_text($wp_customize, 'post_time_font_size', array(
    'label' => __( 'Post time font size', 'ahura' ),
    'section' => 'ahura_archive',
    'type'  =>  'number'
)));
$wp_customize->add_setting('post_time_font_family');
$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'post_time_font_family', array(
    'label' => __( 'Post time font family', 'ahura' ),
    'section' => 'ahura_archive',
    'type'  =>  'select',
    'choices'=> mw_options::get_ahura_fonts()
)));
$wp_customize->add_setting('post_time_font_weight');
$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'post_time_font_weight', array(
    'label' => __( 'Post time font wright', 'ahura' ),
    'section' => 'ahura_archive',
    'type'  =>  'select',
    'choices' => mw_options::get_font_weights()
)));
$wp_customize->add_setting( 'ahura_archive_column', ['default' => '3'] );
$wp_customize->add_control( 'ahura_archive_column', [
  'type' => 'select',
  'section' => 'ahura_archive',
  'label' => __( 'Archive desktop column', 'ahura' ),
  'choices' => [
    '2' => __( '6', 'ahura' ),
    '3' => __( '4', 'ahura' ),
    '4' => __( '3', 'ahura' ),
    '6' => __( '2', 'ahura' ),
  ],
 ] );

$wp_customize->add_setting('ahura_archive_pagination_prev_text', ['default' => __('Previous Page', 'ahura')]);
$wp_customize->add_control(new simple_text($wp_customize, 'ahura_archive_pagination_prev_text', array(
    'label' => __('Pagination Previous Text', 'ahura'),
    'section' => 'ahura_archive',
    'type'  =>  'text'
)));

$wp_customize->add_setting('ahura_archive_pagination_next_text', ['default' => __('Next Page', 'ahura')]);
$wp_customize->add_control(new simple_text($wp_customize, 'ahura_archive_pagination_next_text', array(
    'label' => __('Pagination Next Text', 'ahura'),
    'section' => 'ahura_archive',
    'type'  =>  'text'
)));

$wp_customize->add_setting('ahura_archive_post_thumbnail_width', ['default' => '100%']);
$wp_customize->add_control(new simple_text($wp_customize, 'ahura_archive_post_thumbnail_width', array(
    'label' => __('Posts thumbnail width', 'ahura'),
    'section' => 'ahura_archive',
    'type'  =>  'text'
)));

$wp_customize->add_setting('ahura_archive_post_thumbnail_height', ['default' => 'auto']);
$wp_customize->add_control(new simple_text($wp_customize, 'ahura_archive_post_thumbnail_height', array(
    'label' => __('Posts thumbnail height', 'ahura'),
    'section' => 'ahura_archive',
    'type'  =>  'text'
)));