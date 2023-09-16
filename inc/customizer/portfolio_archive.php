<?php

use ahura\app\customization\ios_checkbox;
use ahura\app\customization\simple_range;

defined('ABSPATH') or die('No script kiddies please!');

$wp_customize->add_section('ahura_portfolio_arhchive', array(
      'title'      => __('Portfolio Archive', 'ahura'),
      'priority'   => 6,
));

$wp_customize->add_setting('ahura_show_portfolio_archive_breadcrumb', ['default' => true]);
$wp_customize->add_control(new ios_checkbox($wp_customize, 'ahura_show_portfolio_archive_breadcrumb', array(
    'label' => __('Breadcrumb', 'ahura'),
    'section' => 'ahura_portfolio_arhchive',
)));

$wp_customize->add_setting('ahura_portfolio_archive_cover_height', ['default' => 260]);
$wp_customize->add_control(
    new simple_range($wp_customize, 'ahura_portfolio_archive_cover_height', [
        'label' => __('Portfolio cover height', 'ahura'),
        'section' => 'ahura_portfolio_arhchive',
        'input_attrs' => [
            'min' => 0,
            'max' => 1000,
        ],
    ])
);

$wp_customize->add_setting('ahura_portfolio_archive_title_color', ['default' => '#333']);
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'ahura_portfolio_archive_title_color', [
    'label'     => __('Archive title color', 'ahura'),
    'section'   => 'ahura_portfolio_arhchive',
    'settings'  => 'ahura_portfolio_archive_title_color',
]));

$wp_customize->add_setting('ahura_portfolio_archive_portfolio_title_color', ['default' => '#333']);
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'ahura_portfolio_archive_portfolio_title_color', [
    'label'     => __('Portfolio title color', 'ahura'),
    'section'   => 'ahura_portfolio_arhchive',
    'settings'  => 'ahura_portfolio_archive_portfolio_title_color',
]));

$wp_customize->add_setting('ahura_portfolio_archive_cover_bg_color', ['default' => '#00b0ff']);
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'ahura_portfolio_archive_cover_bg_color', [
    'label'     => __('Portfolio cover background color', 'ahura'),
    'section'   => 'ahura_portfolio_arhchive',
    'settings'  => 'ahura_portfolio_archive_cover_bg_color',
]));

$wp_customize->add_setting('ahura_portfolio_archive_cover_text_color', ['default' => '#fff']);
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'ahura_portfolio_archive_cover_text_color', [
    'label'     => __('Portfolio cover text color', 'ahura'),
    'section'   => 'ahura_portfolio_arhchive',
    'settings'  => 'ahura_portfolio_archive_cover_text_color',
]));