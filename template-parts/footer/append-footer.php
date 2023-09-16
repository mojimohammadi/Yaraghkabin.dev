<?php 
$show_sticky_btns = \ahura\app\mw_options::get_mod_show_sticky_buttons();
if($show_sticky_btns):
    $first_btn = \ahura\app\mw_options::get_mod_show_first_sticky_button();
    $second_btn = \ahura\app\mw_options::get_mod_show_sec_sticky_button();
?>
    <?php if($first_btn): ?>
        <a href="<?php echo \ahura\app\mw_options::get_mod_first_sticky_button_url() ?>" target="_blank" class="ahura-sticky-button ahura-first-sticky-button">
            <i class="<?php echo \ahura\app\mw_options::get_mod_first_sticky_button_icon() ?>"></i>
        </a>
    <?php endif; ?>
    <?php if($second_btn): ?>
        <a href="<?php echo \ahura\app\mw_options::get_mod_sec_sticky_button_url() ?>" target="_blank" class="ahura-sticky-button ahura-second-sticky-button">
            <i class="<?php echo \ahura\app\mw_options::get_mod_sec_sticky_button_icon() ?>"></i>
        </a>
    <?php endif; ?>
<?php endif; ?>
<?php
$goto_top_mode = \ahura\app\mw_options::get_mod_goto_top_btn_position();
if($goto_top_mode !== 'none'):
?>
    <div id="goto-top" class="<?php echo $goto_top_mode?>">
        <span class="fa fa-arrow-up"></span>
    </div>
<?php endif; ?>
<?php
if($footer_additional_code = get_theme_mod('ahura_additional_code_in_footer')){
    echo $footer_additional_code;
}
?>
<?php if(get_theme_mod('ahura_show_preloader')): ?>
    <div class="ahura-pre-loader"></div>
<?php endif; ?>
<div class="ahura-modal-search search-modal">
    <div class="search-modal-overlay close"></div>
    <form class="search-form" action="<?php echo home_url()?>">
        <span class="close"><i class="fa fa-times"></i></span>
        <?php $ajax_search_status = \ahura\app\mw_options::get_mod_is_ajax_search();?>
        <input <?php echo $ajax_search_status ? 'autocomplete="off"' : ''; ?> required type="text" name="s" placeholder="<?php echo get_theme_mod('ahura_search_box_placeholder') ? get_theme_mod('ahura_search_box_placeholder') : __('Type and Hit Enter...','ahura');?>"/>
        <?php
        if(get_theme_mod('ahura_search_in_product'))
        {
            echo '<input type="hidden" name="post_type" value="product" />';
        }
        ?>
        <?php if($ajax_search_status): ?>
            <div class="ajax_search_loading" id="ajax_search_loading"><span class="fa fa-spinner fa-spin"></span></div>
            <div class="ajax_search_res" id="ajax_search_res"></div>
        <?php endif; ?>
    </form>
</div>
