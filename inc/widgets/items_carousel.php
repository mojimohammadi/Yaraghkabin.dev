<?php

namespace ahura\inc\widgets;
// Block direct access to the main plugin file.

use Elementor\Controls_Manager;
use \ahura\app\mw_assets;

defined('ABSPATH') or die('No script kiddies please!');

class items_carousel extends \Elementor\Widget_Base
{
    use \ahura\app\traits\mw_elementor;
    public function get_name()
    {
        return 'ahura_items_carousel';
    }
    function get_title()
    {
        return esc_html__('Items carousel', 'ahura');
    }
    public function get_icon() {
		return 'aicon-svg-items-carousel';
	}
    function get_categories()
    {
        return ['ahuraelements'];
    }
    function get_keywords()
    {
        return ['itemscarousel', 'items_carousel', esc_html__('Items carousel', 'ahura')];
    }
    function __construct($data = [], $args = null)
    {
        parent::__construct($data, $args);
        $items_carousel_css = mw_assets::get_css('elementor.items_carousel');
        mw_assets::register_style('items_carousel_css', $items_carousel_css);
        mw_assets::register_style('swipercss',mw_assets::get_css('swiper-bundle-min'));
        mw_assets::register_script('swiperjs', mw_assets::get_js('swiper-bundle-min'));
    }
    function get_style_depends()
    {
        return [mw_assets::get_handle_name('items_carousel_css'), mw_assets::get_handle_name('swipercss')];
    }
    function get_script_depends()
    {
        return [mw_assets::get_handle_name('swiperjs')];
    }
    protected function register_controls()
    {
        $this->start_controls_section(
            'conetent_section',
            [
                'label' => esc_html__('Content', 'ahura'),
            ]
        );
        $this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_shadow',
				'label' => __( 'Active box shadow', 'ahura' ),
				'selector' => '{{WRAPPER}} .items-carousel .swiper-slide-next',
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
                                    'blur' => 20,
                                    'spread' => 5,
                                    'color' => 'rgba(156,112,244,0.33)'
								]
						]
					]
			]
		);
        $this->add_control(
			'auto_play',
			[
				'label' => esc_html__( 'Auto Play', 'ahura' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'yes', 'ahura' ),
				'label_off' => esc_html__( 'no', 'ahura' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

        $this->add_control(
			'auto_play_speed',
			[
				'label' => esc_html__( 'Auto Play Speed', 'ahura' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 0,
				'max' => 10000,
				'step' => 1,
				'default' => 1000,
			]
		);
        $repeater = new \Elementor\Repeater();
        $repeater->add_control(
            'title',
            [
                'label' => __('Title', 'ahura'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Title', 'ahura'),
            ]
        );

        $repeater->add_control(
            'image',
            [
                'label' => __('Image', 'ahura'),
                'type' => \Elementor\Controls_Manager::MEDIA,
            ]
        );
        $repeater->add_control(
            'image_top',
            [
                'label' => esc_html__('Image top', 'ahura'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
				'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 40
                    ],
				],
				'default' => [
					'unit' => 'px',
					'size' => 40,
				],
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .items-carousel-image img' => 'margin-top: -{{SIZE}}{{UNIT}};',
				],
            ]
        );
        $repeater->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'background',
                'label' => __('Background', 'ahura'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} {{CURRENT_ITEM}}',
                'fields_options' => [
                    'background' =>
                    [
                        'default' => 'gradient'
                    ],
                    'color' => 
                    [
                        'default' => '#5c79d1'
                    ],
                    'color_b' =>
                    [
                        'default' => '#9c70f4'
                    ],
                ]
            ]
        );
        $repeater->add_control(
            'link_text',
            [
                'label' => __('Button Title', 'ahura'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Read more', 'ahura')
            ]
        );
        $repeater->add_control(
            'link_url',
            [
                'label' => __('Button url', 'ahura'),
                'type' => \Elementor\Controls_Manager::URL,
                'dynamic' => ['active' => true],
                'default' => [
                    'url' => '#'
                ]
            ]
        );
        $repeater->add_control(
            'link_color',
            [
                'label' => __('Button color', 'ahura'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#5C79D1',
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .items-carousel-content a' => 'color: {{VALUE}};'
                ]
            ]
        );
        $repeater->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'link_background_color',
				'label' => __( 'Button background color', 'ahura' ),
				'types' => [ 'classic', 'gradient'],
                'selector' => '{{WRAPPER}} {{CURRENT_ITEM}} .items-carousel-content a',
                'fields_options' => [
                    'background' =>
                    [
                        'default' => 'classic'
                    ],
                    'color' => 
                    [
                        'default' => '#fff'
                    ]
                ]
			]
		);
        $repeater->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'label' => __('Title Typography', 'ahura'),
                'name' => 'title_typography',
                'selector' => '{{WRAPPER}} {{CURRENT_ITEM}} .items-carousel-content h5',
                'fields_options' =>
                [
                    'font_size' => [
                        'default' => [
                            'unit' => 'px',
                            'size' => '3۵',
                        ]
                    ], 'font_weight' => [
                        'default' => '900'
                    ], 'line_height' => [
                        'default' => [
                            'unit' => 'px',
                            'size' => '40',
                        ]
                    ],
                ]
            ]
        );
        $this->add_control(
            'items',
            [
                'label' => __('Slides', 'ahura'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'title' => __('Title','ahura')
                    ],[
                        'title' => __('Title','ahura')
                    ],[
                        'title' => __('Title','ahura')
                    ]
                ],
                'title_field' => '{{{ title }}}',
            ]
        );
        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
?>
        <div class="swiper swiper-items-carousel items-carousel">
            <div class="swiper-wrapper">
                <?php if ($settings['items']) {
                    foreach ($settings['items'] as $item) { ?>
                        <div class="swiper-slide elementor-repeater-item-<?php echo $item['_id']; ?>">
                            <div class="items-carousel-image">
                                <img src="<?php echo $item['image']['url']; ?>">
                            </div>
                            <div class="items-carousel-content">
                                <div class="items-carousel-title">
                                    <h5><?php echo $item['title']; ?></h5>
                                </div>
                                <a href="<?php echo $item['link_url']['url']; ?>" class="items-carousel-link"><?php echo $item['link_text']; ?></a>
                            </div>
                        </div>
                <?php }
                } ?>
            </div>
            <div class="items-carousel-button-prev"><i class="fa fa-chevron-left"></i></div>
            <div class="items-carousel-button-next"><i class="fa fa-chevron-right"></i></div>
        </div>
        <script type="text/javascript">
        var playDelay = <?php echo 'yes' === $settings['auto_play'] ? $settings['auto_play_speed'] : 99999; ?>;
        jQuery(document).ready(function($){
            var itc_swiper = new Swiper('.swiper-items-carousel', {
                    loop: true,
                    slidesPerView: 1,
                    observeParents: true,
                    spaceBetween: 60,
                    navigation: {
                        nextEl: '.items-carousel-button-next',
                        prevEl: '.items-carousel-button-prev',
                    },
                    autoplay: {
                        delay: playDelay,
                    },
                    breakpoints: {
                        640: {
                            slidesPerView: 1,
                            spaceBetween: 15,
                        },
                        768: {
                            slidesPerView: 2,
                            spaceBetween: 30,
                        },
                        1024: {
                            slidesPerView: 3,
                            spaceBetween: 60,
                        },
                    },
            });
        });
        </script>
<?php
    }
}
