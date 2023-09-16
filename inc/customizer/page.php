<?php
use ahura\app\customization\ios_checkbox;
use \ahura\app\mw_options;

// Block direct access to the main plugin file.
defined('ABSPATH') or die('No script kiddies please!');

$wp_customize->add_section('ahura_page', array(
    'title'      => __('Pages', 'ahura'),
    'priority'   => 4,
));

$wp_customize->add_setting('page_comment_status', ['default' => false]);
$wp_customize->add_control(new ios_checkbox($wp_customize, 'page_comment_status', array(
    'label' => __('Comments', 'ahura'),
    'section' => 'ahura_page',
)));