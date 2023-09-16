<?php
namespace ahura\inc\widgets;

// Block direct access to the main plugin file.
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

use ahura\app\mw_assets;

class post_carousel extends \Elementor\Widget_Base {
    /**
     * post_carousel constructor.
     * @param array $data
     * @param null $args
     */
    public function __construct($data = [], $args = null)
    {
        parent::__construct($data, $args);
		mw_assets::register_style('owl_carousel_css', mw_assets::get_css('owl-carousel'));
        mw_assets::register_script('owl_carousel_js', mw_assets::get_js('owl-carousel-min'));
        mw_assets::register_style('post_carousel_css', mw_assets::get_css('elementor.post_carousel'));
        mw_assets::register_script('post_carousel_js', mw_assets::get_js('elementor.post_carousel'));
        if (!is_rtl()) {
            mw_assets::register_style('post_carousel_ltr_css', mw_assets::get_css('elementor.ltr.post_carousel_ltr'));
        }
    }

    public function get_style_depends()
    {
        $styles = [mw_assets::get_handle_name('post_carousel_css'), mw_assets::get_handle_name('owl_carousel_css')];
        if(!is_rtl()){
            $styles[] = mw_assets::get_handle_name('post_carousel_ltr_css');
        }
        return $styles;
    }

    public function get_script_depends()
    {
        return [mw_assets::get_handle_name('owl_carousel_js'), mw_assets::get_handle_name('post_carousel_js')];
    }

	public function get_name() {
		return 'postcarousel';
	}

	public function get_title() {
		return __( 'Post Carousel', 'ahura' );
	}

    public function get_icon() {
		return 'aicon-svg-post-carousel';
	}

	public function get_categories() {
		return [ 'ahuraelements', 'ahura_posts' ];
	}

	protected function register_controls() {
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
				'default' => $default
			]
		);

		$this->add_control(
			'excerpt',
			[
				'label'   => __( 'Show Excerpt', 'ahura' ),
				'type'    => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'yes' => [ 'title' => __( 'Yes', 'ahura' ), 'icon' => 'fa fa-check-circle' ],
					'no'  => [ 'title' => __( 'No', 'ahura' ), 'icon' => 'fa fa-times-circle' ]
				],
				'default' => 'yes'
			]
		);

		$this->add_control(
			'excerpt_chars_count',
			[
				'label'   => __( 'Excerpt Characters', 'ahura' ),
				'type'    => \Elementor\Controls_Manager::NUMBER,
				'condition' => [
					'excerpt' => 'yes'
				]
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

		$this->add_control('divider1', ['type' => \Elementor\Controls_Manager::DIVIDER]);

		$this->add_control(
            'show_title',
            [
                'label' => esc_html__('Show Title', 'ahura'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'ahura'),
                'label_off' => esc_html__('Hide', 'ahura'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

		$this->add_control(
            'show_btn',
            [
                'label' => esc_html__('Show Button', 'ahura'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'ahura'),
                'label_off' => esc_html__('Hide', 'ahura'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

		$this->add_group_control(
            \Elementor\Group_Control_Image_Size::get_type(),
            [
                'name' => 'item_cover',
                'default' => 'stthumb',
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
            'box_img_height',
            [
                'label' => esc_html__('Cover Height', 'ahura'),
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
                    '{{WRAPPER}} .fimage img' => 'height: {{SIZE}}{{UNIT}}',
                ]
            ]
        );

		$this->add_control(
			'title_color',
			[
				'label'   => __( 'Title Color', 'ahura' ),
				'type'    => \Elementor\Controls_Manager::COLOR,
				'default' => '#66bb6a',
				'condition' => [
					'show_title' => 'yes'
				]
			]
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'button_styles',
			[
				'label' => __( 'Button', 'ahura' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => [
					'show_btn' => 'yes'
				]
			]
		);

		$this->add_control(
			'button_color',
			[
				'label'   => __( 'Color', 'ahura' ),
				'type'    => \Elementor\Controls_Manager::COLOR,
				'default' => '#66bb6a'
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$chars_num = isset($settings['excerpt_chars_count']) && intval($settings['excerpt_chars_count']) ? $settings['excerpt_chars_count'] : false;
		$catidd   = $settings['catsid'];
		$default_cat_id = is_array($catidd) ? reset($catidd) : $catidd;
		$postbox5 = new \WP_Query ( array(
			'posts_per_page' => $settings['count'],
			'cat'            => $catidd,
            'order'         =>  $settings['post_order']
		) );
		if ( $postbox5->have_posts() ) : ?>
            <div class="postbox5">
				<?php if($settings['show_title'] === 'yes'): ?>
				<h2 style="border-right-color:<?php echo $settings['title_color']; ?>;color:<?php echo $settings['title_color']; ?>"class="cat-name">
					<?php echo get_cat_name( $default_cat_id ) ?>
				</h2>
				<?php endif; ?>
				<?php if($settings['show_btn'] === 'yes'): ?>
				<a style="background-color:<?php echo $settings['button_color']; ?>;box-shadow:0 5px 20px <?php echo $settings['button_color']; ?>80" class="cat-more-link" href="<?php echo get_category_link( $default_cat_id ) ?>">
					<?php echo __( 'Show All', 'ahura' ); ?>
				</a>
				<?php endif; ?>
				<div class="clear"></div>
				<?php if(is_admin()): ?>
					<div class="preload_widget_section">
						<h3><?php _e('Slider is here!', 'ahura'); ?></h3>
						<small><?php _e('To see slider please view page.'); ?></small>
					</div>
					<?php else: ?>
                <div class="owl-carousel owl-post-carousel">
					<?php while ( $postbox5->have_posts() ) : $postbox5->the_post(); ?>
                        <div>
                            <a class="fimage"
                               href="<?php the_permalink(); ?>"><?php the_post_thumbnail($settings['item_cover_size']); ?></a>
                            <a href="<?php the_permalink(); ?>">
                                <h3><?php echo wp_trim_words( get_the_title(), 8, '...' ); ?></h3></a>
							<?php if ( $settings['excerpt'] == 'yes' ) : ?>
								<?php 
									if($chars_num){
										echo '<p>' . wp_trim_words(get_the_excerpt(), $chars_num, '...') . '</p>';
									} else {
										the_excerpt();
									}
								?>
							<?php endif; ?>
                        </div>
					<?php endwhile; ?>
				</div>
				<?php endif; ?>
            </div>
			<?php wp_reset_postdata(); ?>
			<?php else:?>
					<div class="mw_element_error">
						<?php echo __('Nothing found. Edit the page with Elementor and select a category for this section.','ahura');?>
					</div>
		<?php endif; ?>
        <div class="clear"></div>
		<?php
	}

}
