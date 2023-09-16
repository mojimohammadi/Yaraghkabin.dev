<?php
// Block direct access to the main plugin file.
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

/**
 * 
 * Register customizer export/import action
 * 
 */
add_action('customize_register', '\ahura\app\customization\Ahura_Customizer_Backup::init', 999999);

/**
 * Register customizer tabs
 *
 * @param object $wp_customize
 * @return void
 */
function mw_theme_new_customizer_settings($wp_customize) {
    require get_template_directory() . '/inc/customizer/style.php';
    require get_template_directory() . '/inc/customizer/header.php';
    require get_template_directory() . '/inc/customizer/archive.php';
    require get_template_directory() . '/inc/customizer/footer.php';
    require get_template_directory() . '/inc/customizer/page.php';
    require get_template_directory() . '/inc/customizer/post.php';
    require get_template_directory() . '/inc/customizer/layout.php';
    require get_template_directory() . '/inc/customizer/shop.php';
    require get_template_directory() . '/inc/customizer/product.php';

    if(!\ahura\app\mw_post_type::is_disabled_post_type('portfolio')){
        require get_template_directory() . '/inc/customizer/portfolio.php';
        require get_template_directory() . '/inc/customizer/portfolio_archive.php';
    }

    require get_template_directory() . '/inc/customizer/typography.php';
    require get_template_directory() . '/inc/customizer/404.php';
    require get_template_directory() . '/inc/customizer/backup.php';
}
add_action('customize_register', 'mw_theme_new_customizer_settings');
