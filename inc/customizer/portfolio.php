<?php
use ahura\app\customization\ios_checkbox;
use ahura\app\customization\simple_text;

defined('ABSPATH') or die('No script kiddies please!');

$wp_customize->add_section('ahura_portfolio', array(
      'title'      => __('Portfolio', 'ahura'),
      'priority'   => 6,
));

$wp_customize->add_setting('ahura_show_portfolio_breadcrumb', ['default' => true]);
$wp_customize->add_control(new ios_checkbox($wp_customize, 'ahura_show_portfolio_breadcrumb', array(
    'label' => __('Breadcrumb', 'ahura'),
    'section' => 'ahura_portfolio',
)));

$wp_customize->add_setting('ahura_show_portfolio_excerpt', ['default' => true]);
$wp_customize->add_control(new ios_checkbox($wp_customize, 'ahura_show_portfolio_excerpt', array(
    'label' => __('Excerpt', 'ahura'),
    'section' => 'ahura_portfolio',
)));

$wp_customize->add_setting('ahura_show_portfolio_description', ['default' => true]);
$wp_customize->add_control(new ios_checkbox($wp_customize, 'ahura_show_portfolio_description', array(
    'label' => __('Content', 'ahura'),
    'section' => 'ahura_portfolio',
)));

$wp_customize->add_setting('ahura_show_related_portfolios', ['default' => true]);
$wp_customize->add_control(new ios_checkbox($wp_customize, 'ahura_show_related_portfolios', array(
    'label' => __('Our other portfolios', 'ahura'),
    'section' => 'ahura_portfolio',
)));

$wp_customize->add_setting('ahura_related_portfolios_number', ['default' => 3]);
$wp_customize->add_control(new simple_text($wp_customize, 'ahura_related_portfolios_number', array(
    'label' => __('Related Portfolios Number', 'ahura'),
    'section' => 'ahura_portfolio',
    'type'    => 'number',
	'input_attrs' => [
        'min' => 1,
        'max' => 100,
    ],
	'active_callback'   =>  ['\ahura\app\mw_options', 'get_mod_show_related_portfolios']
)));

$wp_customize->add_setting('ahura_related_portfolios_text_color', ['default' => '#fff']);
$wp_customize->add_control(new WP_Customize_Color_Control( $wp_customize, 'ahura_related_portfolios_text_color', [
    'label'     => __('Related portfolios text color', 'ahura'),
    'section'   => 'ahura_portfolio',
    'settings'  => 'ahura_related_portfolios_text_color',
    'active_callback'   =>  ['\ahura\app\mw_options', 'get_mod_show_related_portfolios']
]));

$wp_customize->add_setting('ahura_related_portfolios_bg_color', ['default' => '#00b0ff']);
$wp_customize->add_control(new WP_Customize_Color_Control( $wp_customize, 'ahura_related_portfolios_bg_color', [
    'label'     => __('Related portfolios background color', 'ahura'),
    'section'   => 'ahura_portfolio',
    'settings'  => 'ahura_related_portfolios_bg_color',
    'active_callback'   =>  ['\ahura\app\mw_options', 'get_mod_show_related_portfolios']
]));

$wp_customize->add_setting('ahura_show_portfolio_like_box', ['default' => true]);
$wp_customize->add_control(new ios_checkbox($wp_customize, 'ahura_show_portfolio_like_box', array(
    'label' => __('Portfolio like box', 'ahura'),
    'section' => 'ahura_portfolio',
)));

$wp_customize->add_setting('ahura_portfolio_like_box_title', ['default' => __('Do you like this portfolio?', 'ahura')]);
$wp_customize->add_control(new simple_text( $wp_customize, 'ahura_portfolio_like_box_title', [
    'label' => __('Portfolio like box title', 'ahura'),
    'section' => 'ahura_portfolio',
    'active_callback' => ['\ahura\app\mw_options', 'get_mod_show_portfolio_like_box'],
]));
