<?php

namespace ahura\inc\widgets;
// Block direct access to the main plugin file.

use ahura\app\mw_assets;
use Elementor\Controls_Manager;

defined('ABSPATH') or die('No script kiddies please!');

class post_carousel_4 extends \Elementor\Widget_Base
{
    use \ahura\app\traits\mw_elementor;
    public function get_name()
    {
        return 'ahura_post_carousel_4';
    }
    function get_title()
    {
        return esc_html__('Post Carousel 4', 'ahura');
    }
    public function get_icon() {
		return 'aicon-svg-post-carousel-4';
	}
    function get_categories()
    {
        return ['ahuraelements', 'ahura_posts'];
    }
    function get_keywords()
    {
        return ['postcarousel4', 'post_carousel_4', esc_html__('Post Carousel 4', 'ahura')];
    }
    function __construct($data = [], $args = null)
    {
        parent::__construct($data, $args);
        mw_assets::register_style('owl_carousel_css', mw_assets::get_css('owl-carousel'));
        mw_assets::register_script('owl_carousel_js', mw_assets::get_js('owl-carousel-min'));
        $infoboxcarousel_css = mw_assets::get_css('elementor.post_carousel_4');
        mw_assets::register_style('post_carousel_4', $infoboxcarousel_css);
    }
    function get_style_depends()
    {
        return [mw_assets::get_handle_name('post_carousel_4'), mw_assets::get_handle_name('owl_carousel_css')];
    }
    public function get_script_depends()
    {
        return [mw_assets::get_handle_name('owl_carousel_js')];
    }
    protected function register_controls()
    {
        $this->start_controls_section(
            'content_section',
            [
                'label' => __('Content', 'ahura'),
            ]
        );

        $this->add_control(
            'slider_count',
            [
                'label' => __('Slides count', 'ahura'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => 4,
            ]
        );

        $this->add_control(
			'auto_play',
			[
				'label' => __( 'Auto play', 'ahura' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
                'return_value' => 'yes',
				'default' => 'yes',
			]
		);
        $categories = get_categories(['fields' => 'id=>name']);
        $this->add_control(
			'post_categories',
			[
				'label' => __( 'Categories', 'ahura' ),
				'type' => \Elementor\Controls_Manager::SELECT2,
				'multiple' => true,
				'options' => $categories,
				'default' => key($categories),
			]
		);
        
        $this->add_control(
            'link_title',
            [
                'label' => __('Button Title', 'ahura'),
                'type' => Controls_Manager::TEXT,
                'default' => __('Read more', 'ahura')
            ]
        );

        $this->add_control('divider1', ['type' => \Elementor\Controls_Manager::DIVIDER]);

        $this->add_control(
            'show_excerpt',
            [
                'label' => esc_html__('Show Excerpt', 'ahura'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'ahura'),
                'label_off' => esc_html__('Hide', 'ahura'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
			'excerpt_chars_count',
			[
				'label'   => __( 'Excerpt Characters', 'ahura' ),
				'type'    => \Elementor\Controls_Manager::NUMBER,
				'condition' => [
					'show_excerpt' => 'yes'
				]
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
				'label' => __( 'Item', 'ahura' ),
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
                    '{{WRAPPER}} .post-carousel-4-image' => 'height: {{SIZE}}{{UNIT}}',
                ]
            ]
        );

        $this->add_control(
            'item_title_color',
            [
                'label' => esc_html__('Title Color', 'ahura'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .post-carousel-4-content h5' => 'color: {{VALUE}}',
                ],
                'default' => '#222',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'label' => __('Title Typography', 'ahura'),
                'name' => 'title_typography',
                'selector' => '{{WRAPPER}} .post-carousel-4-content h5',
                'fields_options' =>
                [
                    'typography' => [
                        'default' => 'yes'
                    ],
                    'font_size' => [
                        'default' => [
                            'unit' => 'px',
                            'size' => '25',
                        ]
                    ],
                    'font_weight' => [
                        'default' => '800'
                    ],
                    'line_height' => [
                        'default' => [
                            'unit' => 'px',
                            'size' => '40',
                        ]
                    ],
                ]
            ]
        );

        $this->add_control(
            'item_des_color',
            [
                'label' => esc_html__('Description Color', 'ahura'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#777',
                'selectors' => [
                    '{{WRAPPER}} .post-carousel-4-content p' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'label' => __('Description Typography', 'ahura'),
                'name' => 'description_typography',
                'selector' => '{{WRAPPER}} .post-carousel-4-content p',
                'fields_options' =>
                [
                    'typography' => [
                        'default' => 'yes'
                    ],
                    'font_size' => [
                        'default' => [
                            'unit' => 'px',
                            'size' => '15',
                        ]
                    ],
                    'font_weight' => [
                        'default' => '300'
                    ],
                    'line_height' => [
                        'default' => [
                            'unit' => 'px',
                            'size' => '25',
                        ]
                    ],
                ],
                'condition' => [
                    'show_excerpt' => 'yes'
                ]
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'item_background',
                'label' => __( 'Background Color', 'ahura' ),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .owl-item, {{WRAPPER}} .post-carousel-4-content',
                'fields_options' => [
                    'background' => ['default' => 'classic'],
                    'color' => ['default' => '#fff'],
                ]
            ]
        );

        $this->add_control(
            'item_radius',
            [
                'label' => esc_html__( 'Border Radius', 'ahura' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                'selectors' => [
                    '{{WRAPPER}} .post-carousel-4-item, {{WRAPPER}} .owl-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'default' => [
                    'unit' => 'px',
                    'top' => 10,
                    'right' => 10,
                    'bottom' => 10,
                    'left' => 10,
                ]
            ]
        );
		$this->end_controls_section();
        $this->start_controls_section(
            'btn_styles',
            [
                'label' => __( 'Button', 'ahura' ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'btn_color',
            [
                'label' => esc_html__('Text Color', 'ahura'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#fff',
                'selectors' => [
                    '{{WRAPPER}} .post-carousel-4-link a' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'link_background',
                'label' => __( 'Button Background Color', 'ahura' ),
                'types' => [ 'classic', 'gradient' ],
                'exclude' => ['image'],
                'selector' => '{{WRAPPER}} .post-carousel-4-link a',
                'fields_options' =>
                    [
                        'background' =>
                            [
                                'default' => 'classic'
                            ],
                        'color' =>
                            [
                                'default' => '#B63131'
                            ],
                    ]
            ]
        );

        $this->add_control(
            'btn_radius',
            [
                'label' => esc_html__( 'Border Radius', 'ahura' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                'selectors' => [
                    '{{WRAPPER}} .post-carousel-4-link a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'default' => [
                    'unit' => 'px',
                    'top' => 5,
                    'right' => 5,
                    'bottom' => 5,
                    'left' => 5,
                ]
            ]
        );

        $this->end_controls_section();
    }
    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $chars_num = isset($settings['excerpt_chars_count']) && intval($settings['excerpt_chars_count']) ? $settings['excerpt_chars_count'] : false;
        $post_args = [
            'posts_per_page' => '',
            'cat' => $settings['post_categories'],
            'order' => '',
        ];
        $posts = new \WP_Query($post_args);
?>
        <script>
            jQuery(document).ready(function($) {
                $('.owl-post-carousel-4').owlCarousel({
                    center: true,
                    loop: true,
                    lazyLoad: true,
                    items: <?php echo $settings['slider_count'] ?>,
                    autoplay: <?php if($settings['auto_play']) echo 'true'; else echo 'false';?>,
                    autoplaytimeout: 4000,
                    margin: 30,
                    navigation: true,
                    navText: ["<i class='fa fa-3x fa-chevron-left'></i>", "<i class='fa fa-3x fa-chevron-right'></i>"],
                    responsive: {
                        0: {
                            items: 1
                        },
                        400: {
                            items: 1
                        },
                        600:{
                            items: 2
                        },
                        1000: {
                            items: <?php echo $settings['slider_count'];?>
                        }
                    }
                });
            })
        </script>
        <div class="post-carousel-4">
            <div class="owl-carousel owl-post-carousel-4">
                <?php
                if ($posts->have_posts()):
                    while ($posts->have_posts()): $posts->the_post() ?>
                        <div class="post-carousel-4-item">
                            <div class="post-carousel-4-image" style="background-image: url(<?php echo the_post_thumbnail_url(null, $settings['item_cover_size']) ?>)"></div>
                            <div class="post-carousel-4-content">
                                <h5><?php echo the_title() ?></h5>
                                <?php if($settings['show_excerpt'] == 'yes'): ?>
                                    <div class="excerpt_section"><?php 
                                        if($chars_num){
                                            echo '<p>' . wp_trim_words(get_the_excerpt(), $chars_num, '...') . '</p>';
                                        } else {
                                            the_excerpt();
                                        }
								    ?></div>
                                <?php endif; ?>
                                <div class="post-carousel-4-link">
                                    <a href="<?php echo the_permalink() ?>"><?php echo $settings['link_title'] ?></a>
                                </div>
                            </div>
                        </div>
                <?php endwhile;
                endif;
                ?>
            </div>
        </div>
<?php
    }
}
