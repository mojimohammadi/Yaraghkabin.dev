<?php

require_once get_parent_theme_file_path('/wizard/tgmpa.php');
require_once get_parent_theme_file_path('/wizard/merlin/vendor/autoload.php');
require_once get_parent_theme_file_path('/wizard/merlin/class-merlin.php');
require_once get_parent_theme_file_path('/wizard/merlin-config.php');
require_once get_parent_theme_file_path( '/wizard/tgmpa.php' );
require_once get_parent_theme_file_path( '/wizard/merlin/vendor/autoload.php' );
require_once get_parent_theme_file_path( '/wizard/merlin/class-merlin.php' );
require_once get_parent_theme_file_path( '/wizard/merlin-config.php' );
require_once get_parent_theme_file_path( '/inc/lib/jdf.php' );
require_once get_parent_theme_file_path('/inc/breadcrumb.php');

// Block direct access to the main plugin file.
defined('ABSPATH') or die('No script kiddies please!');

if(!function_exists('is_active_elementor')){
    function is_active_elementor(){
        return did_action('elementor/loaded');
    }
}

function ahura_register_nav_menus() {
    register_nav_menus(array(
        'topmenu' => __('Top Menu', 'ahura'),
        'mega_menu' => __('Mega Menu', 'ahura'),
        'header_sticky_menu' => __('Header sticky menu', 'ahura'),
        'secondry_menu' => __('Secondry Menu', 'ahura'),
    ));
}
add_action('init', 'ahura_register_nav_menus');

function rd_topmenu($has_mega_menu = true)
{
    if (has_nav_menu('topmenu')) {
        $mihan_walker = false;
        if($has_mega_menu){
            if (!class_exists('Mihan_Walker')) {
                $mihan_walker_path = get_template_directory() . DIRECTORY_SEPARATOR . 'inc' . DIRECTORY_SEPARATOR . 'mihan_walker.php';
                require_once $mihan_walker_path;
            }
            $mihan_walker = new Mihan_Walker();
        }
        wp_nav_menu(array(
            'menu' => __('Top Menu', 'ahura'),
            'theme_location' => 'topmenu',
            'menu_class' => 'topmenu',
            'container_class' => 'topmenu-wrap',
            'walker' => $mihan_walker,
        ));
    }
}

function render_mega_menu($menu_location = 'mega_menu')
{
    if (!has_nav_menu($menu_location)) {
        return false;
    }
    if (!class_exists('Mihan_Walker')) {
        $mihan_walker_path = get_template_directory() . DIRECTORY_SEPARATOR . 'inc' . DIRECTORY_SEPARATOR . 'mihan_walker.php';
        require_once $mihan_walker_path;
    }
    $mihan_walker = new Mihan_Walker();
    wp_nav_menu([
        'menu' => __('Mega Menu', 'ahura'),
        'theme_location' => $menu_location,
        'walker' => $mihan_walker,
    ]);
}

function render_menu_location($location = 'topmenu', $has_mega_menu = false){
    if (has_nav_menu($location)) {
        $mihan_walker = false;
        if($has_mega_menu){
            if (!class_exists('Mihan_Walker')) {
                $mihan_walker_path = get_template_directory() . DIRECTORY_SEPARATOR . 'inc' . DIRECTORY_SEPARATOR . 'mihan_walker.php';
                require_once $mihan_walker_path;
            }
            $mihan_walker = new Mihan_Walker();
        }
        wp_nav_menu(array(
            'menu' => $location,
            'theme_location' => $location,
            'menu_class' => 'topmenu',
            'container_class' => "topmenu-wrap menu-location-wrap {$location}-nav-wrap",
            'walker' => $mihan_walker,
        ));
    }
}

function render_header_sticky_menu()
{
    if (!has_nav_menu('header_sticky_menu')) {
        return false;
    }
    if (!class_exists('Mihan_Walker')) {
        $mihan_walker_path = get_template_directory() . DIRECTORY_SEPARATOR . 'inc' . DIRECTORY_SEPARATOR . 'mihan_walker.php';
        require_once $mihan_walker_path;
    }
    $mihan_walker = new Mihan_Walker();
    wp_nav_menu([
        'menu' => __('Header sticky menu', 'ahura'),
        'theme_location' => 'header_sticky_menu',
        'walker' => $mihan_walker,
        'menu_class' => 'topmenu'
    ]);
}

require get_template_directory() . '/inc/customizer.php';

if(is_active_elementor()){
    require get_template_directory() . '/inc/elementor.php';
}

function wpdocs_excerpt_more($more)
{
    return '...';
}

add_filter('excerpt_more', 'wpdocs_excerpt_more');
function custom_excerpt_length($length)
{
    return 30;
}

add_filter('excerpt_length', 'custom_excerpt_length', 999);

function ahura_footer_columns()
{
    switch (get_theme_mod('footer_columns')) {
        case '1c':
            $footer_columns = 'footer-widget col-md-12';
            break;
        case '2c':
            $footer_columns = 'footer-widget col-md-6';
            break;
        case '3c':
            $footer_columns = 'footer-widget col-md-4';
            break;
        case '4c':
            $footer_columns = 'footer-widget col-md-3';
            break;
        default:
            $footer_columns = 'footer-widget col-md-3';
            break;
    }
    return $footer_columns;
}

function ahura_footer_widget()
{
    $footer_columns = ahura_footer_columns();
    register_sidebar(array(
        'name' => __('Footer', 'ahura'),
        'id' => 'ahura_footer_widget',
        'before_widget' => '<div class="' . $footer_columns . '">',
        'after_widget' => '</div>',
        'before_title' => '<span class="footer-widget-title">',
        'after_title' => '</span>',
    ));
}

add_action('widgets_init', 'ahura_footer_widget');

function ahura_rightsidebar_widget()
{
    register_sidebar(array(
        'name' => __('Right Sidebar', 'ahura'),
        'id' => 'ahura_rightsidebar_widget',
        'before_widget' => '<div class="sidebar-widget">',
        'after_widget' => '</div><div class="clear"></div>',
        'before_title' => '<span class="sidebar-widget-title">',
        'after_title' => '</span>',
    ));
}

add_action('widgets_init', 'ahura_rightsidebar_widget');

function ahura_leftsidebar_widget()
{
    register_sidebar(array(
        'name' => __('Left Sidebar', 'ahura'),
        'id' => 'ahura_leftsidebar_widget',
        'before_widget' => '<div class="sidebar-widget">',
        'after_widget' => '</div><div class="clear"></div>',
        'before_title' => '<span class="sidebar-widget-title">',
        'after_title' => '</span>',
    ));
}

add_action('widgets_init', 'ahura_leftsidebar_widget');

function ahura_shop_right_widget()
{
    register_sidebar(array(
        'name' => __('Woocommerce pages right sidebar', 'ahura'),
        'id' => 'ahura_shop_right_widget',
        'before_widget' => '<div class="sidebar-widget">',
        'after_widget' => '</div><div class="clear"></div>',
        'before_title' => '<span class="sidebar-widget-title">',
        'after_title' => '</span>',
    ));
}

add_action('widgets_init', 'ahura_shop_right_widget');

function ahura_shop_left_widget()
{
    register_sidebar(array(
        'name' => __('Woocommerce pages left sidebar', 'ahura'),
        'id' => 'ahura_shop_left_widget',
        'before_widget' => '<div class="sidebar-widget">',
        'after_widget' => '</div><div class="clear"></div>',
        'before_title' => '<span class="sidebar-widget-title">',
        'after_title' => '</span>',
    ));
}

add_action('widgets_init', 'ahura_shop_left_widget');

function ahura_product_left_widget()
{
    register_sidebar(array(
        'name' => __('Woocommerce single page left sidebar', 'ahura'),
        'id' => 'ahura_product_left_widget',
        'before_widget' => '<div class="sidebar-widget">',
        'after_widget' => '</div><div class="clear"></div>',
        'before_title' => '<span class="sidebar-widget-title">',
        'after_title' => '</span>',
    ));
}

add_action('widgets_init', 'ahura_product_left_widget');

function ahura_product_right_widget()
{
    register_sidebar(array(
        'name' => __('Woocommerce single page right sidebar', 'ahura'),
        'id' => 'ahura_product_right_widget',
        'before_widget' => '<div class="sidebar-widget">',
        'after_widget' => '</div><div class="clear"></div>',
        'before_title' => '<span class="sidebar-widget-title">',
        'after_title' => '</span>',
    ));
}

add_action('widgets_init', 'ahura_product_right_widget');

function ahura_content_widget()
{
    register_sidebar(array(
        'name' => __('Start Content widget', 'ahura'),
        'id' => 'ahura_start_content_widget',
        'before_widget' => '<div class="sidebar-widget">',
        'after_widget' => '</div><div class="clear"></div>',
        'before_title' => '<span class="sidebar-widget-title">',
        'after_title' => '</span>',
    ));
    $customizer_post_link = sprintf('<a href="%s" target="_blank">%s</a>', esc_url(admin_url('customize.php?tab=ahura_post')), __('Customizer > Single Post', 'ahura'));
    register_sidebar(array(
        'name' => __('Between Content widget', 'ahura'),
        'id' => 'ahura_between_content_widget',
        'before_widget' => '<div class="sidebar-widget">',
        'after_widget' => '</div><div class="clear"></div>',
        'before_title' => '<span class="sidebar-widget-title">',
        'after_title' => '</span>',
        'description' => sprintf(__('To configure this section, go to %s.', 'ahura'), $customizer_post_link)
    ));
    register_sidebar(array(
        'name' => __('End Content widget', 'ahura'),
        'id' => 'ahura_content_widget',
        'before_widget' => '<div class="sidebar-widget">',
        'after_widget' => '</div><div class="clear"></div>',
        'before_title' => '<span class="sidebar-widget-title">',
        'after_title' => '</span>',
    ));
}

add_action('widgets_init', 'ahura_content_widget');

if(class_exists('LifterLMS')){
    function ahura_register_lifterlms_sidebars()
    {
        register_sidebar(array(
            'name' => __('LifterLMS Sidebar', 'ahura'),
            'id' => 'ahura_llms_primary_sidebar',
            'description' => __('This sidebar is registered only for compatibility of the template with the LMS plugin, insert the widgets related to the LMS plugin in the main sidebars of the plugin (Course, Lesson, etc.).', 'ahura'),
            'before_widget' => '<div class="sidebar-widget">',
            'after_widget' => '</div><div class="clear"></div>',
            'before_title' => '<span class="sidebar-widget-title">',
            'after_title' => '</span>',
        ));
    }

    add_action('widgets_init', 'ahura_register_lifterlms_sidebars');
}

function get_breadcrumb()
{
    echo '<a href="' . home_url() . '" rel="nofollow">', __('Home', 'ahura'), '</a>';
    if (is_category() || is_single()) {
        echo get_theme_mod('breadcrumb_seprator') ? '&nbsp;&nbsp;' . get_theme_mod('breadcrumb_seprator') . '&nbsp;&nbsp;' : "&nbsp;&nbsp;&#187;&nbsp;&nbsp;";
        the_category(' &bull; ');
        if (is_single()) {
            echo get_theme_mod('breadcrumb_seprator') ? '&nbsp;&nbsp;' . get_theme_mod('breadcrumb_seprator') . '&nbsp;&nbsp;' : "&nbsp;&nbsp;&#187;&nbsp;&nbsp;";
            the_title();
        }
    } elseif (is_page()) {
        echo get_theme_mod('breadcrumb_seprator') ? '&nbsp;&nbsp;' . get_theme_mod('breadcrumb_seprator') . '&nbsp;&nbsp;' : "&nbsp;&nbsp;&#187;&nbsp;&nbsp;";
        echo the_title();
    } elseif (is_search()) {
        echo __('Search Results For ', 'ahura');
        echo '"<em>';
        echo the_search_query();
        echo '</em>"';
    }
}

function mihanwp_numeric_posts_nav()
{

    if (is_singular())
        return;

    global $wp_query;

    /** Stop execution if there's only 1 page */
    if ($wp_query->max_num_pages <= 1)
        return;

    $paged = get_query_var('paged') ? absint(get_query_var('paged')) : 1;
    $max = intval($wp_query->max_num_pages);

    /**    Add current page to the array */
    if ($paged >= 1)
        $links[] = $paged;

    /**    Add the pages around the current page to the array */
    if ($paged >= 3) {
        $links[] = $paged - 1;
        $links[] = $paged - 2;
    }

    if (($paged + 2) <= $max) {
        $links[] = $paged + 2;
        $links[] = $paged + 1;
    }

    echo '<div class="navigation"><ul>' . "\n";

    /**    Previous Post Link */
    if (get_previous_posts_link()){
        $prev_label = get_theme_mod('ahura_archive_pagination_prev_text');
        $prev_label = (!empty($prev_label)) ? $prev_label : esc_html__('Previous Page', 'ahura');
        printf('<li>%s</li>' . "\n", get_previous_posts_link($prev_label));
    }

    /**    Link to first page, plus ellipses if necessary */
    if (!in_array(1, $links)) {
        $class = 1 == $paged ? ' class="active"' : '';

        printf('<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url(get_pagenum_link(1)), '1');

        if (!in_array(2, $links))
            echo '<li>…</li>';
    }

    /**    Link to current page, plus 2 pages in either direction if necessary */
    sort($links);
    foreach ((array)$links as $link) {
        $class = $paged == $link ? ' class="active"' : '';
        printf('<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url(get_pagenum_link($link)), $link);
    }

    /**    Link to last page, plus ellipses if necessary */
    if (!in_array($max, $links)) {
        if (!in_array($max - 1, $links))
            echo '<li>…</li>' . "\n";

        $class = $paged == $max ? ' class="active"' : '';
        printf('<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url(get_pagenum_link($max)), $max);
    }

    /**    Next Post Link */
    if (get_next_posts_link()){
        $next_label = get_theme_mod('ahura_archive_pagination_next_text');
        $next_label = (!empty($next_label)) ? $next_label : esc_html__('Next Page', 'ahura');
        printf('<li>%s</li>' . "\n", get_next_posts_link($next_label));
    }

    echo '</ul></div>' . "\n";

}

/**
 *
 *
 * Generate pagination with custom params
 *
 */
function ahura_custom_pagination($total, $per_page = 12, $current_page = 1, $format = '?page_num=%#%', $prev_text = null, $next_text = null)
{
    $page = $current_page;
    $max_num_pages = ceil($total / $per_page);
    if ($max_num_pages > 1) {
        echo paginate_links(array(
            'base' => preg_replace('/\?.*/', '/', get_pagenum_link(1)) . '%_%',
            'format' => $format,
            'total' => $max_num_pages,
            'current' => $page,
            'prev_text' => empty($prev_text) ? esc_html__('Prev', 'ahura') : $prev_text,
            'next_text' => empty($next_text) ? esc_html__('Next', 'ahura') : $next_text,
        ));
    }
}

add_action('set_comment_cookies', function ($comment, $user) {
    setcookie('ta_comment_wait_approval', '1', 0, '/');
}, 10, 2);

add_action('init', function () {
    if (isset($_COOKIE['ta_comment_wait_approval']) && $_COOKIE['ta_comment_wait_approval'] === '1') {
        setcookie('ta_comment_wait_approval', '0', 0, '/');
        add_action('comment_form_before', function () {
            echo "<p id='wait_approval'><strong>";
            echo __('Your Comment has been sent successfully.', 'ahura');
            echo '</strong></p>';
        });
    }
});

add_filter('comment_post_redirect', function ($location, $comment) {
    $location = get_permalink($comment->comment_post_ID) . '#wait_approval';
    return $location;
}, 10, 2);

function ahura_modify_comment_fields($fields)
{
    $req = null;
    $aria_req = null;
    $fields = array(

        'author' =>
            '<p class="comment-form-author"><label for="author">' . __('Name (Required)', 'ahura') .
            ($req ? '' : '') . '</label>' .
            '<input required oninvalid="this.setCustomValidity(\'?\')" oninput="setCustomValidity(\'\')" id="author" name="author" type="text" size="30"' . $aria_req . ' /></p>',

        'email' =>
            '<p class="comment-form-email"><label for="email">' . __('Email (Required)', 'ahura') .
            ($req ? '<span class="required">*</span>' : '') . '</label>' .
            '<input required oninvalid="this.setCustomValidity(\'?\')" oninput="setCustomValidity(\'\')" id="email" name="email" type="text" size="30"' . $aria_req . ' /></p>',

        'url' =>
            '<p class="comment-form-url"><label for="url">' . __('Website', 'ahura') . '</label>' .
            '<input id="url" name="url" type="text" size="30" /></p>',
    );
    return $fields;
}

get_option('require_name_email') ? add_filter('comment_form_default_fields', 'ahura_modify_comment_fields') : '';

// Add iransans font to wordpress admin panel
function mihanwp_custom_css()
{
    $temp_dir_uri = get_template_directory_uri();
    $str = '<style id="ahura-admin-custom-fonts">
      @font-face {
        font-family: IRANSans;
        font-style: normal;
        font-weight: 900;
        font-display: swap;
        src: url(%THEME_DIR_URI%/fonts/woff/IRANSansWeb_Black.woff);
      }
    
      @font-face {
        font-family: IRANSans;
        font-style: normal;
        font-weight: 700;
        font-display: swap;
        src: url(%THEME_DIR_URI%/fonts/woff/IRANSansWeb_Bold.woff);
      }
    
      @font-face {
        font-family: IRANSans;
        font-style: normal;
        font-display: swap;
        font-weight: 500;
        src: url(%THEME_DIR_URI%/fonts/woff/IRANSansWeb_Medium.woff);
      }
    
      @font-face {
        font-family: IRANSans;
        font-style: normal;
        font-display: swap;
        font-weight: 300;
        src: url(%THEME_DIR_URI%/fonts/woff/IRANSansWeb_Light.woff);
      }
    
      @font-face {
        font-family: IRANSans;
        font-style: normal;
        font-weight: 200;
        font-display: swap;
        src: url(%THEME_DIR_URI%/fonts/woff/IRANSansWeb_UltraLight.woff);
      }
    
      @font-face {
        font-family: IRANSans;
        font-style: normal;
        font-weight: 400;
        font-display: swap;
        src: url(%THEME_DIR_URI%/fonts/woff/IRANSansWeb.woff);
      }
      body,a,h1,h2,h3,h5,h6,h4,span,td,tr,input,p,textarea,.rtl h1, .rtl h2, .rtl h3, .rtl h4, .rtl h5, .rtl h6,.editor-post-title__block .editor-post-title__input{
        font-family: IRANSans, sans-serif;
      }
  </style>';
    if (is_rtl()){
        echo str_replace('%THEME_DIR_URI%', $temp_dir_uri, $str);
    }
}

add_action('admin_head', 'mihanwp_custom_css');

function ahura_admin_css()
{
    echo '
  <style>
    .wp-menu-image img{
      width:20px;
      height:20px;
    }
  </style>
  ';
}

add_action('admin_head', 'ahura_admin_css');

require_once get_template_directory() . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'app.php';

function product_discount_percent()
{
    global $product;
    if ( $product->is_on_sale() && $product->is_type( 'simple' ) ) {
        $discount_percent = (($product->get_regular_price() - $product->get_sale_price()) * 100) / ($product->get_regular_price());
        return round($discount_percent) . '%';
    }
}

add_filter('woocommerce_get_price_html', 'onsale_date_func', 100, 2);
function onsale_date_func($price, $product)
{
    global $post;
    $sales_price_to = get_post_meta($post->ID, '_sale_price_dates_to', true);
    if (is_single() && $sales_price_to != "") {

        $onsale_date_remain = (new DateTime())->diff(new DateTime(date("Y-m-d", $sales_price_to)));

        $month_remain = $onsale_date_remain->m ? $onsale_date_remain->m . __(" month ", "ahura") : '';
        $day_remain = $onsale_date_remain->d ? $onsale_date_remain->d . __(" days ", "ahura") : '';
        $hours_remain = $onsale_date_remain->h ? $onsale_date_remain->h . __(" hours ", "ahura") : '';
        $minutes_remain = $onsale_date_remain->i ? $onsale_date_remain->i . __(" minutes ", "ahura") : '';

        $onsale_date_remain_formatted = $month_remain . $day_remain . $hours_remain . $minutes_remain;

        return str_replace('</ins>', ' </ins> <p class="sale_price_date">' . __("Offer until ", "ahura") . $onsale_date_remain_formatted . '</p>', $price);
    } else {
        return apply_filters('woocommerce_get_price', $price);
    }
}

if (get_theme_mod('move_product_catdescription') == true) {
    function move_product_category_description()
    {
        if (is_product_category()) {
            remove_action('woocommerce_archive_description', 'woocommerce_taxonomy_archive_description', 10);
            if(get_theme_mod('show_product_cat_des_to_all_pages') != true){
                add_action('woocommerce_after_shop_loop', 'woocommerce_taxonomy_archive_description', 10);
            }
        }
    }

    add_action('woocommerce_archive_description', 'move_product_category_description', 3);
}

if(get_theme_mod('show_product_cat_des_to_all_pages') == true){
    remove_action('woocommerce_archive_description', 'woocommerce_taxonomy_archive_description', 10);
    function ahura_woocommerce_taxonomy_archive_description(){
        global $wp_query;
        if (is_woocommerce() && (is_product_category() || is_archive())) {
            $cat = $wp_query->get_queried_object();
            $cat_id = $cat->term_id;
            $cat_desc = term_description( $cat_id, $cat->taxonomy );
            if ($cat_desc){
                echo sprintf('<div class="term-description term-description-%s">%s</div>', $cat->taxonomy, $cat_desc);
            }
        }
    }
}

if(function_exists('ahura_woocommerce_taxonomy_archive_description')){
    if (get_theme_mod('move_product_catdescription') == true){
        add_action('woocommerce_after_shop_loop', 'ahura_woocommerce_taxonomy_archive_description', 10);
    } else {
        add_action('woocommerce_before_shop_loop', 'ahura_woocommerce_taxonomy_archive_description', 10);
    }
}

if (\ahura\app\mw_options::get_mod_is_active_woo_modified_date()) {
    add_action( 'woocommerce_product_meta_end', 'woocommerce_product_date_modified_func', 20);
    function woocommerce_product_date_modified_func(){
        global $product;
        $text = get_theme_mod( 'product_update_date_text' ) ? get_theme_mod( 'product_update_date_text' ) : esc_html__('Product updated in:', 'ahura');
        $modified_date = $product->get_date_modified();
        $date = (is_rtl()) ? ahura_jdate('j F o', strtotime($modified_date)) : $modified_date->date_i18n( ' d F Y' );
        ?>
        <br /><div class="woocommerce_product_date_modified"><span><?php echo $text; ?></span><span><?php echo $date; ?></span></div>
        <?php
    }
}

if( get_theme_mod( 'ahura_comment_form_controls' ) ) {
    add_filter( 'comment_form_default_fields', 'ahura_fields_filtered' );
    function ahura_fields_filtered( $fields ) {
        if( ( isset( $fields[ 'email' ] ) && get_theme_mod( 'ahura_comment_form_email_control' ) ) ) unset( $fields[ 'email' ] );
        if( ( isset( $fields[ 'url' ] ) && get_theme_mod( 'ahura_comment_form_url_control' ) ) ) unset( $fields[ 'url' ] );
        if( ( isset( $fields[ 'author' ] ) && get_theme_mod( 'ahura_comment_form_name_control' ) ) ) unset( $fields[ 'author' ] );
        return $fields;
    }
}

if ( get_theme_mod( 'ahura_shop_show_product_related' ) ) {
    add_filter( 'woocommerce_output_related_products_args', 'ahura_related_products_args', 20 );
    function ahura_related_products_args( $args ) {
        $args['posts_per_page'] = get_theme_mod( 'ahura_max_related_products_num' );
        $args['columns'] = get_theme_mod( 'ahura_related_product_column' );
        return $args;
    }
}

/**
 * Check is new post
 *
 * @param int $post_id
 * @return boolean
 */
function ahura_is_new_post(){
    $days = get_theme_mod('ahura_new_posts_label_days_ago');
    $days = (int) intval($days) ? $days : 5;
    return ((time() - (60 * 60 * 24 * $days)) < get_post_time());
}

/**
 *
 * Filter the title of a woocommerce product on the shop page
 *
 */
add_filter('the_title', 'ahura_filter_the_title', 10, 2);
function ahura_filter_the_title($post_title, $post_id = null) {
    if(\ahura\app\woocommerce::is_active()){
        $shop_title_words = \ahura\app\mw_options::get_mod_shop_product_title_words_number();

        if((is_shop() || is_product_category() || is_product_tag()) && intval($shop_title_words) && get_post_type($post_id) == 'product') {
            return wp_trim_words($post_title, $shop_title_words, '...');
        }
    }

    return $post_title;
}

/**
 * Include ahura post like template
 *
 * @return void
 */
add_action('ahura_post_like_template', 'ahura_post_like_template_callback', 10, 2);
function ahura_post_like_template_callback($post_id, $title = ''){
    $path = get_theme_file_path("template-parts/single/post-like.php");
    if(file_exists($path) && is_readable($path)){
        include($path);
    }
}

/**
 * Usage post like box template
 *
 * @param integer $post_id generate box for post with id
 * @param string $title set box title
 * @return void
 */
function ahura_post_like_template($post_id, $title = ''){
    do_action('ahura_post_like_template', $post_id, $title);
}

/**
 * Like box template for post single
 *
 * @param int $post_id
 * @param string $title
 * @return void
 */
function ahura_single_post_like_template($post_id, $title = ''){
    $show = \ahura\app\mw_options::get_mod_show_post_like_box();
    if($show){
        ahura_post_like_template($post_id, $title);
    }
}

/**
 * Get post like count
 *
 * @param integer $post_id
 * @return void
 */
function ahura_get_post_likes($post_id){
    return get_post_meta($post_id, 'ahura_post_likes', true);
}

/**
 * Get post dislike count
 *
 * @param integer $post_id
 * @return void
 */
function ahura_get_post_dislikes($post_id){
    return get_post_meta($post_id, 'ahura_post_dislikes', true);
}

/**
 * Update post like count
 *
 * @param integer $post_id
 * @return void
 */
function ahura_update_post_likes($post_id, $compare = '+'){
    $likes = (int) ahura_get_post_likes($post_id);
    if($compare == '-'){
        return (intval($likes)) ? update_post_meta($post_id, 'ahura_post_likes', $likes - 1) : false;
    } elseif($compare == '+'){
        return update_post_meta($post_id, 'ahura_post_likes', $likes + 1);
    }

    return false;
}

/**
 * Update post dislike count
 *
 * @param integer $post_id
 * @return void
 */
function ahura_update_post_dislikes($post_id, $compare = '+'){
    $dislikes = (int) ahura_get_post_dislikes($post_id);
    if($compare == '-'){
        return (intval($dislikes)) ? update_post_meta($post_id, 'ahura_post_dislikes', $dislikes - 1) : false;
    } elseif($compare == '+'){
        return update_post_meta($post_id, 'ahura_post_dislikes', $dislikes + 1);
    }

    return false;
}

/**
 *
 *
 * Get archive page title
 *
 *
 */
function ahura_get_archive_title(){
    $title = get_the_archive_title();

    if (is_category() || is_tag()){
        $title = single_cat_title('', false);
    } elseif(is_author()) {
        $title = get_the_author();
    } elseif(is_post_type_archive()) {
        $title = post_type_archive_title('', false);
    } elseif(is_tax()) {
        $title = single_term_title('', false);
    }

    return $title;
}

/**
 * Wp body class filter
 *
 * @param array $classes
 * @return array
 */
function ahura_filter_body_class_callback($classes){
    $direction_mode = is_rtl() ? 'mw_rtl' : 'mw_ltr';
    return array_merge($classes, array($direction_mode));
}
add_filter('body_class', 'ahura_filter_body_class_callback', 10, 1);

/**
 * Check between two hour
 *
 * @param string $start_hour
 * @param string $end_hour
 * @return boolean
 */
function ahura_is_between_hours($start_hour, $end_hour){
    if(is_rtl()){
        date_default_timezone_set('Asia/Tehran');
    }
    $currentTime = (new DateTime('now'))->modify('+1 day');
    $startTime = new DateTime($start_hour);
    $endTime = (new DateTime($end_hour))->modify('+1 day');
    
    return ($currentTime >= $startTime && $currentTime <= $endTime);
}

/**
 * 
 * 
 * Get current theme mode (light, dark, black)
 * 
 * @param boolean $boolean
 * @param array|string $if_theme
 * @return string|boolean
 */
function ahura_get_current_theme_mode($boolean = false, $if_theme = 'light'){
    $dark_mode_has_scheduler = \ahura\app\mw_options::get_mod_dark_mode_has_scheduler();
    $dark_mode_start_time = \ahura\app\mw_options::get_mod_dark_mode_schedule_start_time();
    $dark_mode_end_time = \ahura\app\mw_options::get_mod_dark_mode_schedule_end_time();
    $show_mode_switcher = \ahura\app\mw_options::get_mod_show_theme_mode_switcher();
    $default_mode = \ahura\app\mw_options::get_mod_default_theme_mode();
    $dark_mode_status = \ahura\app\mw_options::get_mod_is_active_dark_theme();

    if(!$dark_mode_status){
        if($boolean && $if_theme == 'light'){
            return true;
        }
        return 'ahura-light-theme';
    }

    if($dark_mode_has_scheduler && !empty($dark_mode_start_time) && !empty($dark_mode_end_time)){
        if(ahura_is_between_hours("{$dark_mode_start_time}:00", "{$dark_mode_end_time}:00")){
            if($boolean && $if_theme == 'dark'){
                return true;
            }
            return 'ahura-dark-theme';
        }
    }

    if(!isset($_COOKIE['ahura-theme-mode'])){
        if($boolean){
            return $boolean === $if_theme;
        }
        return sprintf('ahura-%s-theme', $default_mode);
    }

    if($show_mode_switcher){
        $mode = isset($_COOKIE['ahura-theme-mode']) ? $_COOKIE['ahura-theme-mode'] : 'ahura-light-theme';
        if($boolean && !empty($if_theme)){
            if(is_array($if_theme)){
                if(count($if_theme) > 0){
                    foreach($if_theme as $theme){
                        return (strpos($mode, $theme) !== false) ? true : false;
                    }
                }
            } else {
                return (strpos($mode, $if_theme) !== false) ? true : false;
            }
        }
    } else {
        $mode = $dark_mode_status ? 'ahura-dark-theme' : 'ahura-light-theme';
    }

    return $mode;
}

/**
 * Append content after paragraph
 *
 * @param string $insertion
 * @param int $paragraph_id
 * @param string $content
 * @return string
 */
function ahura_insert_content_after_paragraph($insertion, $paragraph_id, $content) {
    $closing_p = '</p>';
    $paragraphs = explode($closing_p, $content);
    $last_key = array_key_last($paragraphs);

    if(intval($paragraph_id) && is_array($paragraphs) && count($paragraphs) > 0){
        if($paragraph_id <= count($paragraphs)){
            foreach($paragraphs as $index => $paragraph) {
                if (trim($paragraph)) {
                    $paragraphs[$index] .= $closing_p;
                }
         
                if ($paragraph_id == $index + 1) {
                    $paragraphs[$index] .= $insertion;
                }
            }
        } elseif(isset($paragraphs[$last_key])) {
            if (trim($paragraphs[$last_key])) {
                $paragraphs[$last_key] .= $closing_p;
            }
     
            $paragraphs[$last_key] .= $insertion;
        }
    }
 
    return implode('', $paragraphs);
}

/**
 * Append sidebar widgets between post content
 *
 * @param string $content
 * @return string
 */
function ahura_insert_widget_between_post_content_callback($content) {
    if(\ahura\app\mw_options::is_ahura_builder_accessible() && is_single() || is_admin()){
        $builder = new \ahura\app\elementor\Ahura_Elementor_Builder();
        if($builder->setContentID(get_the_ID())->isEditMode() || $builder->isPreviewMode()){
            return $content;
        }
    }

    if (is_single() && !is_admin()) {
        $show_widgets = \ahura\app\mw_options::get_mod_show_widgets_between_post_content();
        if($show_widgets == true && get_post_type() == 'post'){
            $sidebar = \ahura\app\Ahura_Sidebar_Controller::getSidebarContent('ahura_between_content_widget');
            if($sidebar){
                $widgets_pos = \ahura\app\mw_options::get_mod_widgets_between_post_content_position();
                return ahura_insert_content_after_paragraph($sidebar, ($widgets_pos ? $widgets_pos : 1), $content);
            }
        }
    }
 
    return $content;
}
add_filter('the_content', 'ahura_insert_widget_between_post_content_callback');

function ahura_fonticons_array(){
    $path = get_theme_file_path("inc/fonticons.json");

    if(file_exists($path) && is_readable($path)){
        return json_decode(file_get_contents($path), true);
    }

    return false;
}

function ahura_html_content_types($post_id, $wrap_class = 'single-content-types', $item_class = 'single-content-type'){
    if(intval($post_id)){
        $content_types = get_the_terms($post_id,'content_types');
        if($content_types && !is_wp_error($content_types)){
            $output = "<div class='{$wrap_class}'>";
            foreach ($content_types as $term) {
                $icon_id = \ahura\app\taxonomies::get_term_meta($term->term_id, 'icon');
                $icon_url = wp_get_attachment_url($icon_id);
                $content_type_link = get_term_link($term,'content-types');
                $output .= '<a href="' . $content_type_link . '" class="' . $item_class . '">';
                if($icon_url){
                    $output .= '<img src="' . $icon_url . '"/>';
                }
                $output .= '<span>' . $term->name . '</span>';
                $output .= '</a>';
            }
            $output .= '</div>';
            echo $output;
        }
    }
}

/**
 *
 * Get content translation id
 *
 * Compatible: WPML / PolyLang
 *
 */
function ahura_get_content_translation_id($content_id){
    $post_type = get_post_type($content_id);
    $translate_id = 0;
    if(defined('ICL_PLUGIN_PATH')){
        $lang = apply_filters( 'wpml_current_language', null );
        $translation_id = apply_filters('wpml_object_id', $content_id, $post_type, FALSE, $lang);
        $translate_id = intval($translation_id) ? $translation_id : 0;
    } elseif(function_exists('pll_get_post_translations')){
        $lang = pll_current_language();
        $translations = pll_get_post_translations($content_id);
        $translate_id = (isset($translations[$lang]) && intval($translations[$lang])) ? $translations[$lang] : 0;
    }
    $content_id = intval($translate_id) ? $translate_id : $content_id;
    return apply_filters('ahura_get_content_translation_id', $content_id);
}

add_filter('body_class', 'ahura_filter_body_class', 10, 1);
/**
 *
 * Filter body_class
 *
 */
function ahura_filter_body_class($classes){
    $show_sticky_btns = \ahura\app\mw_options::get_mod_show_sticky_buttons();
    $first_btn = \ahura\app\mw_options::get_mod_show_first_sticky_button();
    $second_btn = \ahura\app\mw_options::get_mod_show_sec_sticky_button();

    if($show_sticky_btns && ($first_btn || $second_btn)){
        $classes[] = 'ahura-with-sticky-buttons';
    }

    if(\ahura\app\mw_options::get_open_mobile_menu_from_left() == true){
        $classes[] = 'open-mm-left';
    }

    $classes[] = is_rtl() ? 'mw_rtl' : 'mw_ltr';

    return $classes;
}

add_action('wp_head', 'ahura_action_wp_head');
function ahura_action_wp_head(){
    $header_additional_code = get_theme_mod('ahura_additional_code_in_header');
    if ($header_additional_code) {
        echo $header_additional_code;
    }
}

/**
 *
 *
 * Remove directory with content
 *
 *
 */
function ahura_rmdir_with_content($src){
    if (file_exists($src)) {
        $dir = opendir($src);
        while (false !== ($file = readdir($dir))) {
            if (($file != '.') && ($file != '..')) {
                $full = $src . '/' . $file;
                if (is_dir($full)) {
                    ahura_rmdir_with_content($full);
                } else {
                    unlink($full);
                }
            }
        }
        closedir($dir);
        rmdir($src);
    }
}

/**
 *
 *
 * Check string is json
 *
 *
 */
function ahura_is_json($str){
    return json_decode($str) && json_last_error() === JSON_ERROR_NONE;
}
add_action('wp_footer', 'ahura_append_content_to_footer_callback');
/**
 *
 *
 * Append content to footer with action wp_footer
 *
 *
 */
function ahura_append_content_to_footer_callback(){
	include_once get_template_directory() . '/template-parts/footer/append-footer.php';
}

function get_ahura_login_url(){
    $login_url = class_exists('MihanPanelApp') ? wp_login_url() : (\ahura\app\woocommerce::is_active() ? get_permalink(get_option('woocommerce_myaccount_page_id')) : wp_login_url());
    $login_url = apply_filters('get_ahura_login_url', $login_url);
    return $login_url;
}

function ahura_shortcode_render_elementor_widgets_callback($atts) {
    $atts = shortcode_atts(array(
        'category' => 'ahuraelements',
        'count' => 20,
    ), $atts);
    $elementor = new \ahura\app\elementor\Ahura_Elementor_Builder();

    if(is_admin() || wp_doing_ajax() || $elementor->isPreviewMode()){
        return sprintf("<div class='ahura-element-not-found-msg'>%s</div>", __('Not show in editor', 'ahura'));
    } else {
        $frontend = new \ahura\app\elementor\Elementor_Frontend();
        return $frontend->render_widgets($atts['category'], $atts['count'], true);
    }
}
add_shortcode('ahura_render_elementor_widgets', 'ahura_shortcode_render_elementor_widgets_callback');