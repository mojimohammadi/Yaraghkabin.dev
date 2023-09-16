<?php
namespace ahura\inc\widgets;

use ahura\app\mw_assets;

// Block direct access to the main plugin file.
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );


class post_archive2 extends \Elementor\Widget_Base {

	public function get_name() {
		return 'postarchive2';
	}

	public function get_title() {
		return __( 'Post Archive 2', 'ahura' );
	}

    public function get_icon() {
		return 'aicon-svg-post-archive-2';
	}

	public function get_categories() {
		return [ 'ahuraelements', 'ahura_posts' ];
	}
	function get_keywords()
	{
		return ['post_archive2', 'postarchive2', esc_html__( 'Post Archive 2' , 'ahura')];
	}
	function __construct($data=[], $args=null)
	{
		parent::__construct($data, $args);
		$post_archive2_css = mw_assets::get_css('elementor.post_archive2');
		mw_assets::register_style('post_archive2', $post_archive2_css);
	}
	function get_style_depends()
	{
		return [mw_assets::get_handle_name('post_archive2')];
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

		$this->add_control(
			'target_link',
			[
				'label' => __('Open Link in New tab', 'ahura'),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'default' => '_self',
				'options' => [
					'_blank' => [
						'title' => __('Yes', 'ahura'),
						'icon' => 'eicon-check'
					],
					'_self' => [
						'title' => __('No', 'ahura'),
						'icon' => 'eicon-close-circle'
					],
				],
				'toggle' => true
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
            'image_styles',
            [
                'label' => __( 'Image', 'ahura' ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'box_img_width',
            [
                'label' => esc_html__('Width', 'ahura'),
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
                'default' => [
                    'unit' => '%',
                    'size' => 100
                ],
                'selectors' => [
                    '{{WRAPPER}} .post-archive1-thumbnail img' => 'width: {{SIZE}}{{UNIT}}',
                ]
            ]
        );

        $this->add_responsive_control(
            'box_img_height',
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
                'default' => [
                    'unit' => 'px',
                    'size' => 255
                ],
                'selectors' => [
                    '{{WRAPPER}} .post-archive1-thumbnail img' => 'height: {{SIZE}}{{UNIT}}',
                ]
            ]
        );

        $this->add_control(
            'img_border_radius',
            [
                'label' => esc_html__('Border Radius', 'ahura'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .post-archive1-thumbnail img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'default' => [
                    'is_linked' => true,
                    'top' => 10,
                    'right' => 10,
                    'bottom' => 10,
                    'left' => 10,
                ]
            ]
        );
        $this->end_controls_section();
		$this->start_controls_section(
			'content_styles',
			[
				'label' => __( 'Content', 'ahura' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

        $alignment = array(
            'right' => [
                'title' => esc_html__('Right', 'ahura'),
                'icon' => 'eicon-text-align-right',
            ],
            'center' => [
                'title' => esc_html__('Center', 'ahura'),
                'icon' => 'eicon-text-align-center',
            ],
            'left' => [
                'title' => esc_html__('Left', 'ahura'),
                'icon' => 'eicon-text-align-left',
            ]
        );

        $this->add_control(
            'box_text_align',
            [
                'label' => esc_html__('Text Alignment', 'ahura'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => (is_rtl()) ? $alignment : array_reverse($alignment),
                'default' => (is_rtl() ? 'right' : 'left'),
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .post-archive1-details' => 'text-align: {{VALUE}}',
                ]
            ]
        );

		$this->add_control(
			'catcolor',
			[
				'label'   => __( 'Category Color', 'ahura' ),
				'type'    => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .post-archive1-details h2' => 'color: {{VALUE}}'
				]
			]
		);

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'box_cat_typography',
                'label' => esc_html__('Typography', 'ahura'),
                'selector' => '{{WRAPPER}} .post-archive1-details h2',
                'fields_options' =>
                    [
                        'typography' => [
                            'default' => 'yes'
                        ],
                        'font_size' => [
                            'default' => [
                                'unit' => 'px',
                                'size' => '32'
                            ]
                        ],
                        'font_weight' => [
                            'default' => '700'
                        ]
                    ]
            ]
        );

		$this->add_control(
			'titlecolor',
			[
				'label'   => __( 'Post Title Color', 'ahura' ),
				'type'    => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .post-archive1-details h3' => 'color: {{VALUE}}'
				]
			]
		);

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'box_title_typography',
                'label' => esc_html__('Typography', 'ahura'),
                'selector' => '{{WRAPPER}} .post-archive1-details h3',
                'fields_options' =>
                    [
                        'typography' => [
                            'default' => 'yes'
                        ],
                        'font_size' => [
                            'default' => [
                                'unit' => 'px',
                                'size' => '20'
                            ]
                        ],
                        'font_weight' => [
                            'default' => '700'
                        ]
                    ]
            ]
        );
		$this->end_controls_section();
        $this->start_controls_section(
            'button_styles',
            [
                'label' => __( 'Button', 'ahura' ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'btn_align',
            [
                'label' => esc_html__('Position', 'ahura'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => (is_rtl()) ? $alignment : array_reverse($alignment),
                'default' => 'center',
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .post-archive1-details .btns-wrap' => 'text-align: {{VALUE}}',
                ]
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'btn_background',
                'label' => __( 'Link Background', 'ahura' ),
                'types' => ['classic', 'gradient'],
                'exclude' => ['image'],
                'selector' => '{{WRAPPER}} .post-archive1-details a',
            ]
        );

        $this->add_control(
            'btn_text_color',
            [
                'label'   => __( 'Link Color', 'ahura' ),
                'type'    => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .post-archive1-details a' => 'color: {{VALUE}}'
                ]
            ]
        );

        $this->add_control(
            'link_border_radius',
            [
                'label' => esc_html__('Border Radius', 'ahura'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .post-archive1-details a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'default' => [
                    'isLinked' => true,
                    'top' => 50,
                    'right' => 50,
                    'bottom' => 50,
                    'left' => 50,
                ]
            ]
        );

        $this->end_controls_section();
        $this->start_controls_section(
            'box_styles',
            [
                'label' => __( 'Box', 'ahura' ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'box_background',
                'types' => ['classic', 'gradient'],
                'exclude' => ['image'],
                'selector' => '{{WRAPPER}} .post-archive1',
            ]
        );

        $this->add_control(
            'box_border_radius',
            [
                'label' => esc_html__('Border Radius', 'ahura'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .post-archive1' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'box_padding',
            [
                'label' => esc_html__('Padding', 'ahura'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .post-archive1' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'box_border',
                'label' => esc_html__('Border', 'ahura'),
                'selector' => '{{WRAPPER}} .post-archive1',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'box_wrap_shadow',
                'label' => esc_html__('Box Shadow', 'ahura'),
                'selector' => '{{WRAPPER}} .post-archive1',
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
        <div class="post-archive1">
            <div class="post-archive1-thumbnail">
                <?php the_post_thumbnail($settings['item_cover_size'])?>
            </div>
            <div class="post-archive1-details">
				<h2><?php echo get_cat_name($settings['catsid']); ?></h2>
                <h3><?php the_title();?></h3>
                <div class="btns-wrap">
                    <a href="<?php the_permalink()?>" target="<?php echo $settings['target_link']; ?>">
                        <?php echo esc_html__('View Post', 'ahura') ?>
                    </a>
                </div>
            </div>
        </div>
        <?php 
            endwhile;
            endif;
        ?>
		<?php
	}

}
