<?php

// Block direct access to the main plugin file.

use ahura\app\customization\backup_control;

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

$wp_customize->add_section('ahura_backup' , array(
    'title'      => __('Backup', 'ahura'),
    'priority'   => 8,
));

$section = 'ahura_backup';

$wp_customize->add_setting('ahura_backup_setting', array(
    'default' => '',
    'type'	  => 'none'
));

$wp_customize->add_control(new backup_control(
    $wp_customize,
    'ahura_backup_setting',
    array(
        'section'	=> $section,
        'priority'	=> 1
    )
));