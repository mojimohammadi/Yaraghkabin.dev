<?php

namespace ahura\inc\widgets;

// Die if is direct opened file
defined('ABSPATH') or die('No script kiddies please!');

use Elementor\Controls_Manager;
use ahura\app\mw_assets;

class testimonial_carousel extends \Elementor\Widget_Base
{
    /**
     * testimonial_carousel constructor.
     * @param array $data
     * @param null $args
     */
    public function __construct($data = [], $args = null)
    {
        parent::__construct($data, $args);
        mw_assets::register_style('testimonial_carousel_css', mw_assets::get_css('elementor.testimonial_carousel'));
        mw_assets::register_script('swiperjs', mw_assets::get_js('swiper-bundle-min'), false);
        mw_assets::register_style('swipercss',mw_assets::get_css('swiper-bundle-min'));
    }

    public function get_style_depends()
    {
        return [mw_assets::get_handle_name('testimonial_carousel_css'), mw_assets::get_handle_name('swipercss')];
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
        return 'testimonial_carousel';
    }

    /**
     *
     * Set element widget
     *
     * @return mixed
     */
    public function get_title()
    {
        return esc_html__('Testimonial Carousel', 'ahura');
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
        return ['testimonialcarousel', 'testimonial_carousel', esc_html__('Testimonial Carousel', 'ahura')];
    }

    /**
     *
     * Element controls option
     *
     */
    public function register_controls()
    {
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

        $repeater->add_control(
            'show_rate',
            [
                'label' => esc_html__('Show Rate', 'ahura'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'ahura'),
                'label_off' => esc_html__('Hide', 'ahura'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $repeater->add_control(
            'rate',
            [
                'label' => esc_html__('Rate', 'ahura'),
                'type' => Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 5,
                'step' => 0.1,
                'default' => 5,
                'condition' => ['show_rate' => 'yes']
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
         * Start avatar styles
         *
         */
        $this->start_controls_section(
            'box_avatar_style',
            [
                'label' => esc_html__('Avatar', 'ahura'),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_responsive_control(
            'box_avatar_size',
            [
                'label' => esc_html__('Avatar Size', 'ahura'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'rem'],
                'selectors' => [
                    '{{WRAPPER}} .testimonial-carousel-item-wrap .avatar img' => 'width: {{SIZE}}{{UNIT}}',
                ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 65
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 60
                ],
            ]
        );

        $this->add_control(
            'box_avatar_radius',
            [
                'label' => esc_html__('Avatar Border Radius', 'ahura'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem'],
                'selectors' => [
                    '{{WRAPPER}} .testimonial-carousel-item-wrap .avatar img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'box_avatar_shadow',
                'label' => esc_html__('Avatar Shadow', 'ahura'),
                'selector' => '{{WRAPPER}} .testimonial-carousel-item-wrap .avatar img',
                'fields_options' => [
                    'box_shadow_type' => ['default' => 'yes'],
                    'box_shadow' => [
                        'default' => [
                            'horizontal' => 0,
                            'vertical' => 0,
                            'blur' => 17,
                            'spread' => 0,
                            'color' => 'rgba(0, 0, 0, 0.13)'
                        ]
                    ]
                ],
            ]
        );

        $this->end_controls_section();

        /**
         *
         *
         *
         *
         * Start title styles
         *
         */
        $this->start_controls_section(
            'box_head_style',
            [
                'label' => esc_html__('Title', 'ahura'),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_control(
            'box_title_padding',
            [
                'label' => esc_html__('Title Box Padding', 'ahura'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem'],
                'selectors' => [
                    '{{WRAPPER}} .testimonial-carousel-item-wrap .meta' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'default' => [
                    'isLinked' => false,
                    'top' => 20,
                    'right' => 20,
                    'bottom' => 20,
                    'left' => 5,
                    'unit' => 'px',
                ]
            ]
        );

        $this->add_control(
            'box_stars_color',
            [
                'label' => esc_html__('Stars color', 'ahura'),
                'type' => Controls_Manager::COLOR,
                'default' => '#13913f',
                'selectors' => [
                    '{{WRAPPER}} .testimonial-carousel-item-wrap .meta .rate .stars span.checked' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'box_untracked_stars_color',
            [
                'label' => esc_html__('Untracked Stars color', 'ahura'),
                'type' => Controls_Manager::COLOR,
                'default' => '#C8C8C8',
                'selectors' => [
                    '{{WRAPPER}} .testimonial-carousel-item-wrap .meta .rate .stars span' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'box_title_color',
            [
                'label' => esc_html__('Title color', 'ahura'),
                'type' => Controls_Manager::COLOR,
                'default' => '#000000',
                'selectors' => [
                    '{{WRAPPER}} .testimonial-carousel-item-wrap .name' => 'color: {{VALUE}}',
                ]
            ]
        );

        $this->add_control(
            'box_subtitle_color',
            [
                'label' => esc_html__('SubTitle color', 'ahura'),
                'type' => Controls_Manager::COLOR,
                'default' => '#7c7c7c',
                'selectors' => [
                    '{{WRAPPER}} .testimonial-carousel-item-wrap .site-name' => 'color: {{VALUE}}',
                ]
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'box_title_typo',
                'label' => esc_html__('Title Typography', 'ahura'),
                'selector' => '{{WRAPPER}} .testimonial-carousel-item-wrap .name',
                'fields_options' => [
                    'typography' => ['default' => 'yes'],
                    'font_size' => [
                        'default' => [
                            'unit' => 'px',
                            'size' => '17'
                        ]
                    ],
                    'font_weight' => [
                        'default' => 'bold'
                    ],
                ]
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'box_subtitle_typo',
                'label' => esc_html__('SubTitle Typography', 'ahura'),
                'selector' => '{{WRAPPER}} .testimonial-carousel-item-wrap .site-name',
                'fields_options' => [
                    'typography' => ['default' => 'yes'],
                    'font_size' => [
                        'default' => [
                            'unit' => 'px',
                            'size' => '14'
                        ]
                    ],
                    'font_weight' => [
                        'default' => 300
                    ],
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'box_content_style',
            [
                'label' => esc_html__('Content', 'ahura'),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );
        $this->start_controls_tabs('box_content_style_tabs');
        $this->start_controls_tab(
            'box_content_normal_tab',
            [
                'label' => esc_html__('Normal', 'ahura'),
            ]
        );

        $this->add_control(
            'box_content_bg',
            [
                'label' => esc_html__('Background color', 'ahura'),
                'type' => Controls_Manager::COLOR,
                'default' => '#fff',
                'selectors' => [
                    '{{WRAPPER}} .testimonial-carousel-item' => 'background-color: {{VALUE}}',
                    '{{WRAPPER}} .testimonial-carousel-item .curve:before' => 'box-shadow: 50px -50px 0 0 {{VALUE}};',
                ]
            ]
        );

        $this->add_control(
            'box_text_color',
            [
                'label' => esc_html__('Text color', 'ahura'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .testimonial-carousel-item .content' => 'color: {{VALUE}}',
                ]
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'box_content_typo',
                'selector' => '{{WRAPPER}} .testimonial-carousel-item .content',
                'fields_options' => [
                    'typography' => ['default' => 'yes'],
                    'font_size' => [
                        'default' => [
                            'unit' => 'px',
                            'size' => '13'
                        ]
                    ],
                    'font_weight' => [
                        'default' => 300
                    ],
                ]
            ]
        );

        $this->add_control(
            'box_border_radius',
            [
                'label' => esc_html__('Border Radius', 'ahura'),
                'type' => Controls_Manager::DIMENSIONS,
                'allowed_dimensions' => ['top', 'right', 'left'],
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .testimonial-carousel-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'default' => [
                    'isLinked' => true,
                    'top' => 17,
                    'right' => 17,
                    'bottom' => 0,
                    'left' => 17,
                ]
            ]
        );

        $this->add_control(
            'box_content_padding',
            [
                'label' => esc_html__('Padding', 'ahura'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem'],
                'selectors' => [
                    '{{WRAPPER}} .testimonial-carousel-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'default' => [
                    'isLinked' => true,
                    'top' => 23,
                    'right' => 23,
                    'bottom' => 23,
                    'left' => 23,
                    'unit' => 'px',
                ]
            ]
        );

        $this->end_controls_tab();
        $this->start_controls_tab(
            'box_content_hover_tab',
            [
                'label' => esc_html__('Hover', 'ahura'),
            ]
        );

        $this->add_control(
            'box_text_hover_color',
            [
                'label' => esc_html__('Text color', 'ahura'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .testimonial-carousel-item-wrap:hover .content' => 'color: {{VALUE}}',
                ]
            ]
        );

        $this->add_control(
            'box_bg_hover_color',
            [
                'label' => esc_html__('Background color', 'ahura'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .testimonial-carousel-item-wrap:hover .testimonial-carousel-item' => 'background-color: {{VALUE}}',
                    '{{WRAPPER}} .testimonial-carousel-item-wrap:hover .testimonial-carousel-item .curve:before' => 'box-shadow: 50px -50px 0 0 {{VALUE}};',
                ]
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();
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
        <div class="testimonial-carousel testimonial-carousel-1<?php echo $has_paginate ? ' has-paginate-' . $settings['pagination'] : '' ?><?php echo $has_navigate ? ' has-navigate' : '' ?>">
            <div class="swiper testimonial-carousel-1-<?php echo $wid; ?>">
                <div class="swiper-wrapper">
                <?php 
                foreach($items as $item):
                    $name = \ahura\app\mw_options::get_testimonial_username($item['tst_id']);
                    $site_name = \ahura\app\mw_options::get_testimonial_sitename($item['tst_id']);
                    $avatar_url = get_the_post_thumbnail_url($item['tst_id'], 'thumbnail');
                    $content = get_post_field('post_content', $item['tst_id']);
                    $star_rate = $item['rate'];
                ?>
                <div class="swiper-slide">
                    <div class="testimonial-carousel-item-wrap">
                        <div class="ahura-testimonial testimonial-carousel-item">
                            <div class="content"><?php echo $content ?></div>
                            <div class="curve"></div>
                        </div>
                        <div class="meta">
                            <div class="avatar">
                                <img src="<?= $avatar_url ?>" alt="<?= $name ?>">
                            </div>
                            <div class="right">
                                <div class="name"><?= $name ?></div>
                                <div class="site-name"><?= $site_name ?></div>
                            </div>
                            <div class="left">
                                <?php if ($item['show_rate'] === 'yes' && $star_rate): ?>
                                    <div class="rate">
                                        <div class="num"><?= $star_rate ?></div>
                                        <div class="stars">
                                            <?php
                                            for ($i = 0; $i <= $star_rate; $i++) {
                                                if ($i >= 5) {
                                                    break;
                                                }
                                                $checked = ($i < 5 && $i < $star_rate) ? 'checked' : '';
                                                if ($checked) {
                                                    echo '<span class="fa fa-star ' . $checked . '"></span>';
                                                }
                                            }
                                            if ($i <= 5) {
                                                for ($n = 1; $n <= 5 - $star_rate; $n++) {
                                                    echo '<span class="fa fa-star"></span>';
                                                }
                                            } ?>
                                        </div>
                                    </div>
                                <?php endif; ?>
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
                            var tc_swiper = new Swiper('.testimonial-carousel-1-<?php echo $wid; ?>', {
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
                                    el: ".testimonial-carousel-1-<?php echo $wid; ?> .tc-swiper-pagination",
                                    clickable: true,
                                    <?php if($settings['pagination'] != 'default'): ?>
                                        type: "<?php echo $settings['pagination'] ?>",
                                    <?php endif; ?>
                                },
                                <?php endif; ?>
                                <?php if($has_navigate): ?>
                                navigation: {
                                    nextEl: ".testimonial-carousel-1-<?php echo $wid; ?> .tc-swiper-button-next",
                                    prevEl: ".testimonial-carousel-1-<?php echo $wid; ?> .tc-swiper-button-prev",
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
