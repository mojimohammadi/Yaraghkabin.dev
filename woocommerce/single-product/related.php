<?php
/**
 * Related Products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/related.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce/Templates
 * @version     3.9.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$in_slider = \ahura\app\woocommerce::is_active() && is_product() ? \ahura\app\mw_options::get_mod_is_active_product_related_in_slider() : false;
$show_slider_btns = get_theme_mod('ahura_shop_show_related_product_slider_btns');
?>
<?php if(get_theme_mod('ahura_shop_show_product_related')) :?>
    <?php
    if ( $related_products ) : ?>

        <section class="related products<?php echo $in_slider ? ' related-slider' : '' ?><?php echo !$show_slider_btns ? ' related-slider-without-btn' : '' ?>">

            <?php
            $heading = apply_filters( 'woocommerce_product_related_products_heading', __( 'Related products', 'woocommerce' ) );

            if ( $heading ) :
                ?>
                <h2><?php echo esc_html( $heading ); ?></h2>
            <?php endif; ?>

            <?php woocommerce_product_loop_start(); ?>
            <?php 
			if($in_slider):
				global $related_element_tag;
				$related_element_tag = 'div';
			?>
            <div dir="rtl" class="product-related-slider">
                <div class="products owl-carousel owl-theme">
                    <?php endif; ?>
						<?php foreach ( $related_products as $related_product ) : ?>
							<?php
							$post_object = get_post( $related_product->get_id() );

							setup_postdata( $GLOBALS['post'] =& $post_object ); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited, Squiz.PHP.DisallowMultipleAssignments.Found

							wc_get_template_part( 'content', 'product' );
							?>

						<?php endforeach; ?>
                    <?php if($in_slider): ?>
                </div>
            </div>
            <script>
                jQuery(document).ready(function($){
                    if($(document).find('.product-related-slider').length){
                        $('.product-related-slider .products').owlCarousel({
                            loop:false,
                            margin:10,
                            responsiveClass:true,
                            autoplay:true,
                            autoplayTimeout:4000,
                            rtl: <?php echo is_rtl() ? 'true' : 'false' ?>,
                            navText: [
                                '<i class="fas fa-angle-left"></i>',
                                '<i class="fas fa-angle-right"></i>'
                            ],
                            responsive:{
                                0:{
                                    items:1,
                                    nav:<?php echo $show_slider_btns ? 'true' : 'false' ?>
                                },
                                600:{
                                    items:1,
                                    nav:<?php echo $show_slider_btns ? 'true' : 'false' ?>
                                },
                                1000:{
                                    items: <?php echo get_theme_mod('ahura_related_product_column') ? get_theme_mod('ahura_related_product_column') : 3 ?>,
                                    nav:<?php echo $show_slider_btns ? 'true' : 'false' ?>,
                                    loop:false
                                }
                            }
                        })
                    }
                });
            </script>
        <?php endif; ?>
            <?php woocommerce_product_loop_end(); ?>
        </section>
    <?php
    endif;

    wp_reset_postdata();
    ?>
<?php endif; ?>