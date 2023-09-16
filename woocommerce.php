<?php

use mihanpanel\app\form\profile;
$theme_columns = \ahura\app\mw_options::get_theme_columns();
$sidebar = \ahura\app\Ahura_Sidebar_Controller::getInstance();

get_header(); ?>
<section class="site-container ahura-<?php echo $theme_columns;?>-column ahura-post-single woocommerce <?php echo is_rtl() ? 'mw_rtl' : 'mw_ltr'; ?>">
<div class="wrapper">
<?php 
if ($theme_columns == '2cr'):
  $sidebar->col('2cr')->display(); // right sidebar
endif;
?>
<section class="post-box">
<?php 
if ($theme_columns == '3c'):
  $sidebar->col('3c')->display(); // right sidebar
endif;
?>
<div class="content">
<div class="theiaStickySidebar">
  <div class="ahura_woocommerce_content_wrapper">
  <?php if(get_theme_mod('show_woocommerce_breadcrumb')):?>
  <div class="bread-crumb2">
  <?php woocommerce_breadcrumb();?>
  </div>
  <?php endif;?>
  <?php woocommerce_content(''); ?>
    </div>
  </div>
</div>
</section>
<?php 
if ($theme_columns == '2c' || $theme_columns == '3c'):
  $sidebar->col(['2c', '3c'])->display(); // left sidebar
endif;
?>
<div class="clear"></div>
</div>
</section>
<?php get_footer(); ?>