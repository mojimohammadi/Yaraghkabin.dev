<footer class="website-footer">
    <?php
    if (\ahura\app\mw_options::get_mod_is_active_custom_footer()):
        if(class_exists('\ahura\app\elementor\Ahura_Elementor_Builder')):
            $elementor_builder = new \ahura\app\elementor\Ahura_Elementor_Builder();
            echo $elementor_builder->setContentID(get_theme_mod('custom_footer'))->display();
        endif;
    else:
        $is_set_enamad = get_theme_mod('footer_namad_check') == true && (get_theme_mod('show_symbol1',true) || get_theme_mod('show_symbol2',true)) && get_theme_mod('footer_namad1_url') || get_theme_mod('footer_namad2_url');
        $copyright_reverse = get_theme_mod('change_footer_namad_and_copyright_direction', false);
        ?>
        <?php if ( get_theme_mod( 'ahura_legend' ) ) : ?>
        <section class="footer-legend">
            <div class="footer-legend-inner">
                <h5><?php echo get_theme_mod( 'ahura_legend_text' );?></h5>
                <a href="<?php echo get_theme_mod( 'ahura_legend_ctalink' );?>" target="_blank"><?php echo get_theme_mod( 'ahura_legend_ctatext' );?></a>
                <div class="clear"></div>
            </div>
        </section>
    <?php endif;?>
        <div class="footer-center<?php echo get_theme_mod('remove_footer_border_top') != true ? ' footer-center-border-top' : '' ?><?php echo $copyright_reverse ? ' copyright-reverse-direction' : '' ?>">
            <div class="row">
                <?php if ( is_active_sidebar( 'ahura_footer_widget' ) ) : ?>
                    <?php dynamic_sidebar( 'ahura_footer_widget' ); ?>
                <?php endif; ?>
                <div class="clear"></div>
                <div class="<?php echo !get_theme_mod('footer_namad_check') && empty(get_theme_mod('footer-copyright2')) ? 'footer-end-100' : 'footer-end' ?>">
                    <?php if ( get_theme_mod( 'footer-copyright' ) ) : ?>
                        <p class="<?php echo (get_theme_mod('footer-copyright2') == null) ? 'footer-copyright-fullwidth': 'footer-copyright'; ?>">
                            <?php echo get_theme_mod( 'footer-copyright' ); ?>
                        </p>
                    <?php endif;?>
                </div>
                <?php if ( get_theme_mod( 'footer-copyright2' ) || get_theme_mod('footer_namad_check') ) : ?>
                    <div class="footer-copyright2-section">
                        <?php 
                        $use_enamad_html = \ahura\app\mw_options::get_mod_enamad_use_html_code();
                        if(get_theme_mod('footer_namad_check')):?>
                            <div class="footer-namad <?php echo $use_enamad_html ? ' footer-namad-html' : '' ?>">
                                <?php if($use_enamad_html): ?>
                                    <?php echo get_theme_mod('footer_enamad_html_code') ?>
                                <?php else:?>
                                <?php
                                $enamad = get_template_directory_uri() . "/img/enamad.png";
                                $samandehi = get_template_directory_uri() . "/img/samandehi.png";
                                ?>
                                    <?php if(get_theme_mod('show_symbol1',true)):?>
                                        <a href="<?php echo get_theme_mod('footer_namad1_url');?>">
                                            <img width="70" height="70" src="<?php echo (get_theme_mod('footer_namad1') == true ? get_theme_mod('footer_namad1') : $enamad);?>">
                                        </a>
                                    <?php endif;?>
                                    <?php if(get_theme_mod('show_symbol2',true)):?>
                                        <a href="<?php echo get_theme_mod('footer_namad2_url');?>">
                                            <img width="70" height="70" src="<?php echo (get_theme_mod('footer_namad2') == true ? get_theme_mod('footer_namad2') : $samandehi);?>">
                                        </a>
                                    <?php endif;?>
                                <?php endif;?>
                            </div>
                        <?php endif;?>
                        <p class="footer-copyright2">
                        <?php echo get_theme_mod( 'footer-copyright2' ); ?>
                        </p>
                    </div>
                <?php endif;?>
                <div class="clear"></div>
            </div>
        </div>
    <?php endif; // end if check is custom footer ?>
</footer>
<?php wp_footer(); ?>
</body>
</html>
