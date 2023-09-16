<?php
namespace ahura\inc\widgets;

// Block direct access to the main plugin file.
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

use ahura\app\mw_assets;

class post_carousel2 extends \Elementor\Widget_Base {
    /**
     * post_carousel2 constructor.
     * @param array $data
     * @param null $args
     */
    public function __construct($data = [], $args = null)
    {
        parent::__construct($data, $args);
		mw_assets::register_style('owl_carousel_css', mw_assets::get_css('owl-carousel'));
        mw_assets::register_script('owl_carousel_js', mw_assets::get_js('owl-carousel-min'));
        mw_assets::register_style('post_carousel2_css', mw_assets::get_css('elementor.post_carousel2'));
        mw_assets::register_script('post_carousel2_js', mw_assets::get_js('elementor.post_carousel2'));
        if (!is_rtl()) {
            mw_assets::register_style('post_carousel2_ltr_css', mw_assets::get_css('elementor.ltr.post_carousel2_ltr'));
        }
    }

    public function get_style_depends()
    {
        $styles = [mw_assets::get_handle_name('post_carousel2_css'), mw_assets::get_handle_name('owl_carousel_css')];
        if(!is_rtl()){
            $styles[] = mw_assets::get_handle_name('post_carousel2_ltr_css');
        }
        return $styles;
    }

    public function get_script_depends()
    {
        return [mw_assets::get_handle_name('owl_carousel_js'), mw_assets::get_handle_name('post_carousel2_js')];
    }

	public function get_name() {
		return 'postcarousel2';
	}

	public function get_title() {
		return __( 'Post Carousel 2', 'ahura' );
	}

    public function get_icon() {
		return 'aicon-svg-post-carousel-2';
	}

	public function get_categories() {
		return [ 'ahuraelements', 'ahura_posts' ];
	}
	function get_keywords()
	{
		return ['post_carousel2', 'postcarousel2', esc_html__( 'Post Carousel 2' , 'ahura')];
	}

	public function register_controls() {
		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Content', 'ahura' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$categories = get_categories();
		$cats       = array();
		foreach ( $categories as $category ) {
			$cats[ $category->term_id ] = $category->name;
		}
		$default = key($cats);
		$this->add_control(
			'catsid',
			[
				'label'    => __( 'Categories', 'ahura' ),
				'type'     => \Elementor\Controls_Manager::SELECT2,
				'options'  => $cats,
				'label_block' => true,
				'multiple' => true,
				'default'	=>	$default
			]
		);

		$this->add_control(
			'date',
			[
				'label'   => __( 'Show Date', 'ahura' ),
				'type'    => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'yes' => [ 'title' => __( 'Yes', 'ahura' ), 'icon' => 'fa fa-check-circle' ],
					'no'  => [ 'title' => __( 'No', 'ahura' ), 'icon' => 'fa fa-times-circle' ]
				],
				'default' => 'yes'
			]
		);


		$this->add_control(
			'count',
			[
				'label'      => __( 'Number of posts', 'ahura' ),
				'type'       => \Elementor\Controls_Manager::NUMBER,
				'default'    => 8
			]
		);

		$this->add_control(
			'post_order',
			[
				'label' => __('Sort', 'ahura'),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'default' => 'DESC',
				'options' => [
					'ASC' => [
						'title' => __('Ascending', 'ahura'),
						'icon' => 'fa fa-arrow-up'
					],
					'DESC' => [
						'title' => __('Descending', 'ahura'),
						'icon' => 'fa fa-arrow-down'
					],
				],
				'toggle' => true
			]
		);

		$this->add_group_control(
            \Elementor\Group_Control_Image_Size::get_type(),
            [
                'name' => 'item_cover',
                'default' => 'verthumb',
            ]
        );

		$this->end_controls_section();
		/**
		 * 
		 * 
		 * Styles
		 * 
		 *
		 */
		$this->start_controls_section(
			'content_styles',
			[
				'label' => __( 'Content', 'ahura' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
            'box_height',
            [
                'label' => esc_html__('Height', 'ahura'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', 'rem', '%'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                    'em' => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                    'rem' => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                ],
                'devices' => ['desktop', 'tablet', 'mobile'],
                'selectors' => [
                    '{{WRAPPER}} .carousel2post' => 'height: {{SIZE}}{{UNIT}}',
                ]
            ]
        );
		$this->end_controls_section();
	}

	public function render() {
		$settings = $this->get_settings_for_display();
		$wid = $this->get_id();
		$postbox5 = new \WP_Query ( array(
			'posts_per_page' => $settings['count'],
			'cat'            => $settings['catsid'],
            'order'         =>  $settings['post_order']
		) );
		if ( $postbox5->have_posts() ) : ?>
            <div class="post-carousel2 post-carousel2-<?php echo $wid ?>">
                <div class="owl-carousel owl-post-carousel2">
					<?php while ( $postbox5->have_posts() ) : $postbox5->the_post(); ?>
						<?php
						$thumb_id  = get_post_thumbnail_id();
						$thumb_url = wp_get_attachment_image_src( $thumb_id, $settings['item_cover_size'], true );
						?>
                        <div class="carousel2post grid-post-grey" style="background-image:url('<?php echo $thumb_url[0]; ?>');">
							<a href="<?php the_permalink(); ?>">
								<div class="details">
									<h2><?php the_title(); ?></h2>
									<?php if ( $settings['date'] == 'yes' ) : ?>
										<span><i class="fa fa-clock"></i> <?php echo get_the_date( 'd F Y' ); ?></span>
									<?php endif; ?>
								</div>
							</a>
                        </div>
					<?php endwhile; ?>
				</div>
            </div>
			<?php wp_reset_postdata(); ?>
			<?php if(is_admin()): ?>
				<script type="text/javascript">
					jQuery(document).ready(function ($) {
						$('.post-carousel2-<?php echo $wid ?> .owl-post-carousel2').owlCarousel({
							center: false,
							loop: true,
							items: 6,
							lazyLoad: true,
							margin: 0,
							navigation: true,
							navText: ["<i class='fa fa-3x fa-chevron-left'></i>", "<i class='fa fa-3x fa-chevron-right'></i>"],
							responsive: {
								0: {
									items: 1
								},
								400: {
									items: 2
								},
								600: {
									items: 3
								},
								1000: {
									items: 4
								}
							}
						});
					});
				</script>
			<?php endif; ?>
			<?php else:?>
					<div class="mw_element_error">
						<?php echo __('Nothing found. Edit the page with Elementor and select a category for this section.','ahura');?>
					</div>
		<?php endif; ?>
        <div class="clear"></div>
		<?php
	}

}
