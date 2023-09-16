<?php
namespace ahura\inc\widgets;

use ahura\app\mw_assets;

// Block direct access to the main plugin file.
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );


class radio_post extends \Elementor\Widget_Base {

	public function get_name() {
		return 'radiopost';
	}

	public function get_title() {
		return __( 'Radio Post', 'ahura' );
	}

	public function get_icon() {
		return 'aicon-svg-radio-post';
	}

	public function get_categories() {
		return [ 'ahuraelements' ];
	}
	function get_keywords()
	{
		return ['radio_post', 'radiopost', esc_html__( 'Radio Post' , 'ahura')];
	}
	function __construct($data=[], $args=null)
	{
		parent::__construct($data, $args);
		$radio_post_css = mw_assets::get_css('elementor.radio_post');
		mw_assets::register_style('radio_post', $radio_post_css);
	}
	function get_style_depends()
	{
		return [mw_assets::get_handle_name('radio_post')];
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
				'multiple' => false,
				'default' => $default
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
            'box_img_width',
            [
                'label' => esc_html__('Cover Width', 'ahura'),
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
                    '{{WRAPPER}} .radio-post-box img' => 'width: {{SIZE}}{{UNIT}}',
                ]
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
                    '{{WRAPPER}} .radio-post-box img' => 'height: {{SIZE}}{{UNIT}}',
                ]
            ]
        );

		$this->add_control(
			'catcolor',
			[
				'label'   => __( 'Category Color', 'ahura' ),
				'type'    => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .radio-post-right h2' => 'color: {{VALUE}}'
				]
			]
		);

		$this->add_control(
			'titlecolor',
			[
				'label'   => __( 'Post Title Color', 'ahura' ),
				'type'    => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .radio-post-right h3' => 'color: {{VALUE}}'
				]
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'bntbackground',
				'label' => __( 'Link Background', 'ahura' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .radio-post-right a',
			]
		);

		$this->add_control(
			'btx_text_color',
			[
				'label'   => __( 'Link Color', 'ahura' ),
				'type'    => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .radio-post-right a' => 'color: {{VALUE}}'
				]
			]
		);
		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		?>
        <?php $the_query = new \WP_Query(array(
            'posts_per_page' => 1,
            'cat' =>$settings['catsid'],
        ));
         if ( $the_query->have_posts() ):
         while ( $the_query->have_posts() ) : $the_query->the_post();
        ?>
        <div class="radio-post-box">
            <div class="radio-post-right">
                <h2><?php echo get_cat_name($settings['catsid']);?></h2>
                <h3><?php the_title();?></h3>
                <a href="<?php the_permalink()?>">نمایش نوشته</a>
            </div>
            <div class="radio-post-left">
                <?php the_post_thumbnail($settings['item_cover_size']);?>
            </div>
        </div>
        <?php 
            endwhile;
            endif;
        ?>
		<?php
	}

}
