<?php

namespace ahura\inc\widgets;

// Die if is direct opened file
defined('ABSPATH') or die('No script kiddies please!');

use Elementor\Controls_Manager;
use ahura\app\mw_assets;

class testimonial_carousel4 extends \Elementor\Widget_Base
{
    /**
     * testimonial_carousel4 constructor.
     * @param array $data
     * @param null $args
     */
    public function __construct($data = [], $args = null)
    {
        parent::__construct($data, $args);
        mw_assets::register_style('testimonial_carousel4_css', mw_assets::get_css('elementor.testimonial_carousel4'));
        mw_assets::register_script('swiperjs', mw_assets::get_js('swiper-bundle-min'), false);
        mw_assets::register_style('swipercss',mw_assets::get_css('swiper-bundle-min'));
    }

    public function get_style_depends()
    {
        return [mw_assets::get_handle_name('testimonial_carousel4_css'), mw_assets::get_handle_name('swipercss')];
    }

    public function get_script_depends()
    {
        return [mw_assets::get_handle_name('swiperjs')];
    }

    /**
     *
     * Set element id
     *
     * @return string
     */
    public function get_name()
    {
        return 'testimonial_carousel4';
    }

    /**
     *
     * Set element widget
     *
     * @return mixed
     */
    public function get_title()
    {
        return esc_html__('Testimonial Carousel 4', 'ahura');
    }

    /**
     *
     * Set widget icon
     *
     */
    public function get_icon()
    {
        return 'eicon-testimonial-carousel';
    }

    /**
     *
     * Set element category
     *
     * @return string[]
     */
    public function get_categories()
    {
        return ['ahuraelements'];
    }

    /**
     *
     * Keywords for search
     *
     * @return array
     */
    public function get_keywords()
    {
        return ['testimonialcarousel4', 'testimonial_carousel4', esc_html__('Testimonial Carousel 4', 'ahura')];
    }

    /**
     *
     * Element controls option
     *
     */
    public function register_controls()
    {
        $right_alignment_option = [
			'title' => __('Right', 'ahura'),
			'icon' => 'eicon-text-align-right'
		];
		$left_alignment_option = [
			'title' => __('Left', 'ahura'),
			'icon' => 'eicon-text-align-left'
		];
		$center_alignment_option = [
			'title' => __('Center', 'ahura'),
			'icon' => 'eicon-text-align-center'
		];
		$flex_alignemnt_options = [
			'start' => $right_alignment_option,
			'center' => $center_alignment_option,
			'end' => $left_alignment_option,
		];
		$text_alignment = [
			'right' => $right_alignment_option,
			'center' => $center_alignment_option,
			'left' => $left_alignment_option,
		];
		if(!is_rtl())
		{
			$flex_alignemnt_options['start'] = $left_alignment_option;
			$flex_alignemnt_options['end'] = $right_alignment_option;
			$text_alignment = array_reverse($text_alignment);
		}

        /**
         *
         * Start content section
         *
         */
        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__('Content', 'ahura'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();

        $items = get_posts(['post_type' => 'testimonial', 'numberposts' => -1]);
        $options = [];
        if ($items) {
            foreach ($items as $item) {
                $options[$item->ID] = $item->post_title;
            }
        }

        $default = ($options && is_array($options)) ? key($options) : false;

        $repeater->add_control(
            'tst_id',
            [
                'type' => Controls_Manager::SELECT2,
                'label' => esc_html__('Select', 'ahura'),
                'label_block' => true,
                'options' => $options,
                'default' => $default
            ]
        );

        $this->add_control(
			'testimonials',
			[
				'label' => esc_html__('Testimonial', 'ahura'),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'tst_id' => $default,
                        'rate' => 5
					],
				],
				'title_field' => '{{{tst_id}}}',
			]
		);

        $this->end_controls_section();
        $this->start_controls_section(
            'content_settings',
            [
                'label' => esc_html__('Settings', 'ahura'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_responsive_control(
            'slides_per_view',
            [
                'label' => esc_html__('Slides per view', 'ahura'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    1 => '1',
                    2 => '2',
                    3 => '3',
                    4 => '4',
                    5 => '5',
                    6 => '6',
                    7 => '7',
                    8 => '8',
                ],
                'default' => 3,
            ]
        );

        $this->add_control(
            'show_arrows',
            [
                'label' => esc_html__('Arrows', 'ahura'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'ahura'),
                'label_off' => esc_html__('Hide', 'ahura'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'pagination',
            [
                'label' => esc_html__('Pagination', 'ahura'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'none' => esc_html__('None', 'ahura'),
                    'default' => esc_html__('Dots', 'ahura'),
                    'fraction' => esc_html__('Fraction', 'ahura'),
                    'progressbar' => esc_html__('Progress', 'ahura'),
                ],
                'default' => 'default',
            ]
        );

        $this->add_control(
            'autoplay',
            [
                'label' => esc_html__('Autoplay', 'ahura'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'ahura'),
                'label_off' => esc_html__('No', 'ahura'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'transition_duration',
            [
                'label' => esc_html__('Transition Duration', 'ahura'),
                'type' => Controls_Manager::NUMBER,
                'default' => 2500,
                'condition' => [
                    'autoplay' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'infinite_loop',
            [
                'label' => esc_html__('Infinite Loop', 'ahura'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'ahura'),
                'label_off' => esc_html__('No', 'ahura'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->end_controls_section();
        /*
         *
         *
         *
         * Start style section
         *
         */
        /**
         *
         *
         *
         *
         * Start styles
         *
         */
        $this->start_controls_section(
			'box_wrap_styles_section',
			[
				'label' => __('Content', 'ahura'),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
        $this->add_control(
			'box_bg_color',
			[
				'label' => esc_html__( 'Background Color', 'ahura' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .testimonial-carousel-4 .testimonial-carousel-item-content' => 'background-color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'box_padding',
			[
				'label' => esc_html__( 'Padding', 'ahura' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default' => [
					'isLinked' => true,
					'top' => '20',
					'right' => '20',
					'bottom' => '20',
					'left' => '20'
				],
				'selectors' => [
					'{{WRAPPER}} .testimonial-carousel-4 .testimonial-carousel-item-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        $this->add_control(
            'box_border_radius',
            [
                'label' => esc_html__('Border radius', 'ahura'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ '%', 'px' ],
				'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100
                    ],
				],
				'default' => [
					'unit' => 'px',
					'size' => '30',
				],
				'selectors' => [
					'{{WRAPPER}} .testimonial-carousel-4 .testimonial-carousel-item-content' => 'border-radius: {{SIZE}}{{UNIT}};'
				]
            ]
        );
        $this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_shadow',
				'label' => __( 'Box shadow', 'ahura' ),
				'selector' => '{{WRAPPER}} .testimonial-carousel-4 .testimonial-carousel-item-content',
                'fields_options' =>
					[
						'box_shadow_type' =>
                        [ 
                            'default' =>'yes' 
                        ],
						'box_shadow' => [
							'default' =>
								[
									'horizontal' => 0,
                                    'vertical' => 0,
                                    'blur' => 10,
                                    'spread' => 0,
                                    'color' => 'rgba(0,0,0,0.1)'
								]
						]
					]
			]
		);
        $this->end_controls_section();
        $this->start_controls_section(
			'avatar_section',
			[
				'label' => __( 'Avatar', 'ahura' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$avatar_alignment = $text_alignment;
		unset($avatar_alignment['center']);
        $this->add_responsive_control(
            'avatar_alignment',
            [
                'label' => __('Alignment', 'ahura'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'default' => 'left',
                'options' => $avatar_alignment,
				'selectors' =>
				[
					'{{WRAPPER}} .avatar' => '{{VALUE}}: 0;',
				]
            ]
        );
        $this->add_control(
            'avatar_transform_y',
            [
                'label' => esc_html__('Margin from top', 'ahura'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ '%' ],
				'range' => [
                    '%' => [
                        'min' => -100,
                        'max' => 100
                    ],
				],
				'default' => [
					'unit' => '%',
					'size' => '5',
				],
            ]
        );
        $this->add_control(
            'avatar_transform_x',
            [
                'label' => esc_html__('Margin from side', 'ahura'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ '%' ],
				'range' => [
                    '%' => [
                        'min' => -100,
                        'max' => 100
                    ],
				],
				'default' => [
					'unit' => '%',
					'size' => '5',
				],
            ]
        );
        $this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'avatar_box_shadow',
				'label' => __( 'Box Shadow', 'ahura' ),
				'selector' => '{{WRAPPER}} .testimonial-carousel-4 .testimonial-carousel-item-content .avatar',
                'fields_options' =>
					[
						'box_shadow_type' =>
                        [ 
                            'default' =>'yes'
                        ],
						'box_shadow' => [
							'default' =>
								[
									'horizontal' => 0,
                                    'vertical' => 5,
                                    'blur' => 10,
                                    'spread' => 0,
                                    'color' => 'rgba(0,0,0,0.1)'
								]
						]
					]
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'name_section',
			[
				'label' => __( 'Name', 'ahura' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'name_bg_color',
			[
				'label' => esc_html__( 'User Name Background Color', 'ahura' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#2a8ae9',
				'selectors' => [
					'{{WRAPPER}} .name' => 'background-color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'name_text_color',
			[
				'label' => esc_html__( 'User Name Color', 'ahura' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .name' => 'color: {{VALUE}}',
				],
			]
		);

        $this->add_responsive_control(
            'name_flex_alignment',
            [
                'label' => __('Alignment', 'ahura'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'default' => 'start',
                'options' => $flex_alignemnt_options,
				'selectors' =>
				[
					'{{WRAPPER}} .name' => 'align-self: {{VALUE}}',
				]
            ]
        );
        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'label' => __('Typography', 'ahura'),
				'name' => 'name_typography',
				'selector' => '{{WRAPPER}} .name',
                'fields_options' =>
				[
                    'typography' => [
                        'default' => 'yes'
                    ],
					'font_size' => [
						'default' => [
							'unit' => 'px',
							'size' => '18',
						]
                    ],
				]
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'content_styles_section',
			[
				'label' => __( 'Content', 'ahura' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
        $this->add_responsive_control(
            'content_alignment',
            [
                'label' => __('Alignment', 'ahura'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'default' => 'right',
                'options' => $text_alignment,
				'selectors' =>
				[
					'{{WRAPPER}} .content p' => 'text-align: {{VALUE}}',
				]
            ]
        );
		$this->add_control(
			'content_color',
			[
				'label' => esc_html__( 'Text Color', 'ahura' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#35495C',
				'selectors' => [
					'{{WRAPPER}} .content p' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'margin_top',
			[
				'label' => esc_html__( 'Margin Top', 'ahura' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'allowed_dimensions' => ['top'],
				'size_units' => [ 'px', '%', 'em' ],
				'default' => [
					'top' => '35',
				],
				'selectors' => [
					'{{WRAPPER}} .content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'label' => __('Typography', 'ahura'),
				'name' => 'content_typography',
				'selector' => '{{WRAPPER}} .content p',
                'fields_options' =>
				[
                    'typography' => [
                        'default' => 'yes'
                    ],
					'font_size' => [
						'default' => [
							'unit' => 'px',
							'size' => '16',
						]
                    ],
				]
			]
		);
		$this->end_controls_section();

        $this->start_controls_section(
            'box_navigation_style',
            [
                'label' => esc_html__('Navigation', 'ahura'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
			'nav_options',
			[
				'label' => esc_html__('Navigation', 'ahura'),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

        $this->add_control(
            'box_nav_color',
            [
                'label' => esc_html__('Color', 'ahura'),
                'type' => Controls_Manager::COLOR,
                'default' => '#000',
                'selectors' => [
                    '{{WRAPPER}} .testimonial-carousel .tc-swiper-button-next, {{WRAPPER}} .testimonial-carousel .tc-swiper-button-prev' => 'color: {{VALUE}}',
                ]
            ]
        );

        $this->add_control(
			'paginate_options',
			[
				'label' => esc_html__('Pagination', 'ahura'),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

        $this->add_control(
            'box_paginate_color',
            [
                'label' => esc_html__('Color', 'ahura'),
                'type' => Controls_Manager::COLOR,
                'default' => '#00000087',
                'selectors' => [
                    '{{WRAPPER}} .testimonial-carousel .tc-swiper-pagination.swiper-pagination-bullets .swiper-pagination-bullet' => 'background: {{VALUE}}',
                    '{{WRAPPER}} .testimonial-carousel .tc-swiper-pagination.swiper-pagination-progressbar' => 'background: {{VALUE}}',
                ]
            ]
        );

        $this->add_control(
            'box_paginate_active_color',
            [
                'label' => esc_html__('Active Color', 'ahura'),
                'type' => Controls_Manager::COLOR,
                'default' => '#000',
                'selectors' => [
                    '{{WRAPPER}} .testimonial-carousel .tc-swiper-pagination.swiper-pagination-bullets .swiper-pagination-bullet-active' => 'background: {{VALUE}}',
                    '{{WRAPPER}} .testimonial-carousel .tc-swiper-pagination.swiper-pagination-progressbar .swiper-pagination-progressbar-fill' => 'background: {{VALUE}}',
                ]
            ]
        );

        $this->end_controls_section();
    }

    function avatar_additional_style($settings)
	{
		$avatar_transform_x = sprintf('%s%s', $settings['avatar_transform_x']['size'], $settings['avatar_transform_x']['unit']);
		$avatar_transform_y = sprintf('%s%s', $settings['avatar_transform_y']['size'], $settings['avatar_transform_y']['unit']);
		$transform = sprintf('translate(%s, %s)', $avatar_transform_x, $avatar_transform_y);
		$style = sprintf('style="transform: %s;"', $transform);
		return $style;
	}

    /**
     *
     * Render element content (html)
     *
     */
    public function render()
    {
        $settings = $this->get_settings_for_display();
        $wid = $this->get_id();
        $items = $settings['testimonials'];

        if (!$items) {
            return false;
        }

        $has_paginate = ($settings['pagination'] == 'yes' || $settings['pagination'] != 'none');
        $has_navigate = ($settings['show_arrows'] == 'yes');
        ?>
        <div class="testimonial-carousel testimonial-carousel-4<?php echo $has_paginate ? ' has-paginate-' . $settings['pagination'] : '' ?><?php echo $has_navigate ? ' has-navigate' : '' ?>">
            <div class="swiper testimonial-carousel-4-<?php echo $wid; ?>">
                <div class="swiper-wrapper">
                <?php 
                foreach($items as $item):
                    $name = \ahura\app\mw_options::get_testimonial_username($item['tst_id']);
                    $site_name = \ahura\app\mw_options::get_testimonial_sitename($item['tst_id']);
                    $avatar_url = get_the_post_thumbnail_url($item['tst_id'], 'thumbnail');
                    $content = get_post_field('post_content', $item['tst_id']);
                ?>
                <div class="swiper-slide">
                    <div class="testimonial-carousel-item-wrap">
                        <div class="ahura-testimonial testimonial-carousel-item">
                            <div class="testimonial-carousel-item-content">
                                <?php if($avatar_url): ?>
                                <div <?php echo $this->avatar_additional_style($settings);?> class="avatar">
                                    <img src="<?php echo $avatar_url?>" alt="<?php printf('%s_testimonial_avatar', $name);?>">
                                </div>
                                <?php endif; ?>
                                <div class="name"><?php echo $site_name?></div>
                                <div class="content"><p><?php echo $content?></p></div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
                </div>
                <?php if($has_paginate): ?>
                    <div class="tc-swiper-pagination"></div>
                <?php endif; ?>
                <?php if($has_navigate): ?>
                    <div class="swiper-nav-button tc-swiper-button-prev"><i class="fas fa-angle-right"></i></div>
                    <div class="swiper-nav-button tc-swiper-button-next"><i class="fas fa-angle-left"></i></div>
                <?php endif; ?>
                <script type="text/javascript">
                    jQuery(document).ready(function($){
                        if (typeof window.Swiper != undefined) {
                            var tc4_swiper = new Swiper('.testimonial-carousel-4-<?php echo $wid; ?>', {
                                loop: <?php echo $settings['infinite_loop'] == 'yes' ? 'true' : 'false' ?>,
                                slidesPerView: <?php echo (isset($settings['slides_per_view_mobile']) && intval($settings['slides_per_view_mobile'])) ? $settings['slides_per_view_mobile'] : 1 ?>,
                                spaceBetween: 20,
                                <?php if($settings['autoplay'] == 'yes'): ?>
                                autoplay: {
                                    delay: <?php echo (intval($settings['transition_duration'])) ? $settings['transition_duration'] : 2500 ?>,
                                    disableOnInteraction: false,
                                },
                                <?php endif; ?>
                                <?php if($has_paginate): ?>
                                pagination: {
                                    el: ".testimonial-carousel-4-<?php echo $wid; ?> .tc-swiper-pagination",
                                    clickable: true,
                                    <?php if($settings['pagination'] != 'default'): ?>
                                        type: "<?php echo $settings['pagination'] ?>",
                                    <?php endif; ?>
                                },
                                <?php endif; ?>
                                <?php if($has_navigate): ?>
                                navigation: {
                                    nextEl: ".testimonial-carousel-4-<?php echo $wid; ?> .tc-swiper-button-next",
                                    prevEl: ".testimonial-carousel-4-<?php echo $wid; ?> .tc-swiper-button-prev",
                                },
                                <?php endif; ?>
                                breakpoints: {
                                    640: {
                                        slidesPerView: <?php echo (isset($settings['slides_per_view_mobile']) && intval($settings['slides_per_view_mobile'])) ? $settings['slides_per_view_mobile'] : 1 ?>,
                                        spaceBetween: 10,
                                    },
                                    768: {
                                        slidesPerView: <?php echo (isset($settings['slides_per_view_tablet']) && intval($settings['slides_per_view_tablet'])) ? $settings['slides_per_view_tablet'] : 2 ?>,
                                        spaceBetween: 20,
                                    },
                                    1024: {
                                        slidesPerView: <?php echo (isset($settings['slides_per_view']) && intval($settings['slides_per_view'])) ? $settings['slides_per_view'] : 3 ?>,
                                        spaceBetween: 20,
                                    },
                                },
                            });
                        }
                    });
                </script>
            </div>
        </div>
        <?php
    }
}