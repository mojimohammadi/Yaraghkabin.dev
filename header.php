<?php
$data_theme = ahura_get_current_theme_mode();
$html_class = $data_theme;
?>
<!DOCTYPE html>
<html data-theme="<?php echo $data_theme ?>" <?php language_attributes(); ?> class="<?php echo $html_class ?>">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <?php
        \ahura\app\mw_options::theme_viewport_meta_html();
        wp_head();
        ?>
    </head>
<body <?php body_class() ?>>
<?php wp_body_open(); ?>
<?php if (get_theme_mod('use_custom_header') && get_theme_mod('custom_header')) : ?>
<div id="ahura-header-main-wrap">
    <header id="topbar" class="<?php echo \ahura\app\mw_options::get_page_is_float_mode_header(get_the_ID()) ? 'float-mode' : ''; ?> <?php echo \ahura\app\mw_options::check_is_transparent_header_in_single_page() ? 'ahura_transparent' : '';?> in_custom_header topbar header-mode-1 header-mode-2 header-mode-3 clearfix">
        <?php
        if(class_exists('\ahura\app\elementor\Ahura_Elementor_Builder'))
        {
            $elementor_builder = new \ahura\app\elementor\Ahura_Elementor_Builder();
            echo $elementor_builder->setContentID(get_theme_mod('custom_header'))->display();
        }
        ?>
    </header>
</div>
<?php
else :
\ahura\app\Header::get_header(\ahura\app\mw_options::get_header_style());
    if(\ahura\app\mw_options::get_mod_is_show_header_popup_login()): ?>
<div id="ah-login-modal" class="modal">
    <h2 class="header-popup-title"><?php echo __('Login To Account','ahura');?></h2>
    <?php \ahura\header\PopupLogin::render_popup_content();?>
</div>
<?php
    endif;
endif;
?>