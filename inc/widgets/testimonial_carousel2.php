<?php

namespace ahura\inc\widgets;

// Die if is direct opened file
defined('ABSPATH') or die('No script kiddies please!');

use Elementor\Controls_Manager;
use ahura\app\mw_assets;

class testimonial_carousel2 extends \Elementor\Widget_Base
{
    /**
     * testimonial_carousel2 constructor.
     * @param array $data
     * @param null $args
     */
    public function __construct($data = [], $args = null)
    {
        parent::__construct($data, $args);
        mw_assets::register_style('testimonial_carousel2_css', mw_assets::get_css('elementor.testimonial_carousel2'));
        mw_assets::register_script('swiperjs', mw_assets::get_js('swiper-bundle-min'), false);
        mw_assets::register_style('swipercss',mw_assets::get_css('swiper-bundle-min'));
    }

    public function get_style_depends()
    {
        return [mw_assets::get_handle_name('testimonial_carousel2_css'), mw_assets::get_handle_name('swipercss')];
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
        return 'testimonial_carousel2';
    }

    /**
     *
     * Set element widget
     *
     * @return mixed
     */
    public function get_title()
    {
        return esc_html__('Testimonial Carousel 2', 'ahura');
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
        return ['testimonialcarousel2', 'testimonial_carousel2', esc_html__('Testimonial Carousel 2', 'ahura')];
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
            'box_tst_style',
            [
                'label' => esc_html__('Content', 'ahura'),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );

        $alignment_options = [
			'right' => [
				'title' => __("Right", 'ahura'),
				'icon' => 'fa fa-align-right'
			],
			'center' => [
				'title' => __("Center", 'ahura'),
				'icon' => 'fa fa-align-center'
			],
			'left'	=>	[
				'title' => __('Left', 'ahura'),
				'icon'	=>	'fa fa-align-left'
			]
		];
		$this->add_control(
			'user_data_alignment',
			[
				'label' => __('User Data Alignment', 'ahura'),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'default' => 'left',
				'options' => is_rtl() ? $alignment_options : array_reverse($alignment_options)
			]
		);
		$this->add_control(
			'txt_color',
			[
				'label' => __("Text Color", 'ahura'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => 'white',
				'selectors' => [
					'{{WRAPPER}} .content *' => 'color: {{VALUE}}'
				]
			]
		);
		$this->add_control(
			'box_background_color',
			[
				'label' => __('Background Color', 'ahura'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#588cff',
				'selectors' => [
					'{{WRAPPER}} .content' => 'background-color: {{VALUE}}'
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
        <div class="testimonial-carousel testimonial-carousel-2<?php echo $has_paginate ? ' has-paginate-' . $settings['pagination'] : '' ?><?php echo $has_navigate ? ' has-navigate' : '' ?>">
            <div class="swiper testimonial-carousel-2-<?php echo $wid; ?>">
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
                            <?php if($avatar_url): ?>
                                <div style="background-image: url('<?php echo $avatar_url?>')" class="avatar"></div>
                            <?php endif; ?>
                            <div class="content">
                                <span class="quote-start fa fa-quote-<?php echo is_rtl() ? 'right' : 'left';?>"></span>
                                <p><?php echo $content;?></p>
                                <span class="quote-end fa fa-quote-<?php echo is_rtl() ? 'left' : 'right'; ?>"></span>
                                <div class="meta ah_align_<?php echo $settings['user_data_alignment']?>">
                                    <span class="username"><?php echo $name; ?></span>
                                    <span class="sitename"><?php echo $site_name; ?></span>
                                </div>
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
                            var tc2_swiper = new Swiper('.testimonial-carousel-2-<?php echo $wid; ?>', {
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
                                    el: ".testimonial-carousel-2-<?php echo $wid; ?> .tc-swiper-pagination",
                                    clickable: true,
                                    <?php if($settings['pagination'] != 'default'): ?>
                                        type: "<?php echo $settings['pagination'] ?>",
                                    <?php endif; ?>
                                },
                                <?php endif; ?>
                                <?php if($has_navigate): ?>
                                navigation: {
                                    nextEl: ".testimonial-carousel-2-<?php echo $wid; ?> .tc-swiper-button-next",
                                    prevEl: ".testimonial-carousel-2-<?php echo $wid; ?> .tc-swiper-button-prev",
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
