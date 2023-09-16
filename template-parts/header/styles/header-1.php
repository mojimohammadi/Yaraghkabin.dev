<?php
$change_side_style = get_theme_mod('ahura_change_mobile_menu_style');
if (has_nav_menu('topmenu')) : ?>
    <div id="siteside" class="siteside <?php echo $change_side_style ? 'siteside-2' : '' ?>">
        <span class="fa fa-<?php echo $change_side_style ? 'times' : 'window-close' ?> siteside-close" id="menu-close"></span>
        <?php rd_topmenu(false); ?>
        <?php if ($change_side_style): ?>
            <div class="siteside-overlay"></div>
        <?php endif; ?>
    </div>
<?php endif; ?>
    <div id="mgsiteside" class="mgsiteside">
        <div class="cats-list">
            <span class="mg-cat-title" style="background-color:<?php echo \ahura\app\mw_options::get_mod_theme_color(); ?>;color:<?php echo \ahura\app\mw_options::get_mod_secondary_color(); ?>; ">
                <?php echo \ahura\app\mw_options::get_mod_header_cats_menu_title(); ?>
            </span>
            <?php wp_nav_menu(array('theme_location' => 'mega_menu')); ?>
        </div>
    </div>
<?php if (get_theme_mod('ahura_show_preloader')) : ?>
    <div class="ahura-pre-loader"></div>
<?php endif; ?>
<?php
include_once get_template_directory() . '/partials/header-main.php';