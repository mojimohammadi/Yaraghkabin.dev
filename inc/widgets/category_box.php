<?php
namespace ahura\inc\widgets;
// Block direct access to the main plugin file.

use ahura\app\mw_assets;
use Elementor\Controls_Manager;

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

class category_box extends \Elementor\Widget_Base
{
    use \ahura\app\traits\mw_elementor;
    public function get_name()
    {
        return 'ahura_category_box';
    }
    function get_title()
    {
        return esc_html__('Category Box', 'ahura');
    }
    public function get_icon() {
		return 'aicon-svg-category-box';
	}
    function get_categories() {
		return [ 'ahuraelements' ];
	}
    function get_keywords()
    {
        return ['category_box', esc_html__('Category Box', 'ahura')];
    }
    function __construct($data=[], $args=null)
    {
        parent::__construct($data, $args);
        $bannerBox5_css = mw_assets::get_css('elementor.category_box');
        mw_assets::register_style('category_box', $bannerBox5_css);
    }
    function get_style_depends()
    {
        return [mw_assets::get_handle_name('category_box')];
    }
    protected function register_controls()
    {
        $this->start_controls_section(
            'box_section',
            [
                'label' => esc_html__('Box', 'ahura'),
            ]
        );
        $this->add_control(
			'box_bg_color',
			[
				'label' => __( 'Background Color', 'ahura' ),
				'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#434eb5',
				'selectors' => [
					'{{WRAPPER}} .info_section' => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .info_section .button:hover' => 'color: {{VALUE}}',
				],
			]
		);
        $this->end_controls_section();
        $this->start_controls_section(
            'tilte_section',
            [
                'label' => esc_html__('Title', 'ahura'),
            ]
        );
        $this->add_control(
			'title',
			[
				'label' => __( 'Title', 'ahura' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Products Category', 'ahura' ),
			]
		);
        $this->add_control(
			'title_color',
			[
				'label' => __( 'Color', 'ahura' ),
				'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .info_section .title' => 'color: {{VALUE}}',
				],
			]
		);
        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'label' => __('Title Typography', 'ahura'),
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .info_section .title',
                'fields_options' =>
				[
                    'typography' => [
                        'default' => 'yes'
                    ],
                    'font_weight' => [
                        'default' => 'bold'
                    ],
					'font_size' => [
						'default' => [
							'unit' => 'px',
							'size' => '25',
						]
					]
				]
			]
		);
        $this->end_controls_section();
        
        $this->start_controls_section(
            'description_section',
            [
                'label' => esc_html__('Description', 'ahura'),
            ]
        );
        $this->add_control(
			'description_text',
			[
				'label' => __( 'Description', 'ahura' ),
				'type' => Controls_Manager::TEXTAREA,
				'default' => __( 'Description Here', 'ahura' ),
			]
		);
        $this->add_control(
			'description_color',
			[
				'label' => __( 'Color', 'ahura' ),
				'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .info_section .description p' => 'color: {{VALUE}}',
				],
			]
		);
        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'label' => __('Description Typography', 'ahura'),
				'name' => 'description_typography',
				'selector' => '{{WRAPPER}} .info_section .description p',
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
					]
				]
			]
		);
        $this->add_control(
            'description_margin',
            [
                'label' => esc_html__('Margin', 'ahura'),
                'type' => Controls_Manager::DIMENSIONS,
                'allowed_dimensions' => ['top', 'bottom'],
                'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .info_section .description p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
                'default' =>
                [
                    'isLinked' => false,
                    'top' => '25',
                ]
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'button_section',
            [
                'label' => esc_html__('Button', 'ahura'),
            ]
        );
        // color
        $this->add_control(
			'button_text_color',
			[
				'label' => __( 'Text Color', 'ahura' ),
				'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .info_section .button' => 'color: {{VALUE}}',
					'{{WRAPPER}} .info_section .button:hover' => 'background-color: {{VALUE}}',
				],
			]
		);
        // border radius
        $this->add_control(
            'button_border_radius',
            [
                'label' => esc_html__('Border Radius', 'ahura'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
				'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 80
                    ],
				],
				'default' => [
					'unit' => 'px',
					'size' => 10,
				],
				'selectors' => [
					'{{WRAPPER}} .info_section .button' => 'border-radius: {{SIZE}}{{UNIT}};',
				],
            ]
        );
        $this->add_control(
            'button_margin',
            [
                'label' => esc_html__('Margin', 'ahura'),
                'type' => Controls_Manager::DIMENSIONS,
                'allowed_dimensions' => ['top', 'bottom'],
                'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .info_section .button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
                'default' =>
                [
                    'isLinked' => false,
                    'top' => '10',
                ]
            ]
        );
        $this->add_control(
            'button_padding',
            [
                'label' => esc_html__('Padding', 'ahura'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .info_section .button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
                'default' =>
                [
                    'isLinked' => false,
                    'top' => '10',
                    'bottom' => '10',
                    'right' => '25',
                    'left' => '25',
                ]
            ]
        );
        $this->add_control(
			'button_link',
			[
				'label' => esc_html__( 'Link', 'ahura'),
				'type' => Controls_Manager::URL,
				'placeholder' => 'https://mihanwp.com/',
				'show_external' => true,
                'dynamic' => ['active' => true],
				'default' => [
					'url' => '',
					'is_external' => true,
					'nofollow' => true,
				],
			]
		);
        $this->end_controls_section();
        
        $this->start_controls_section(
            'items_section',
            [
                'label' => esc_html__('Items', 'ahura'),
            ]
        );
        $this->add_control(
            'items_icon_size',
            [
                'label' => esc_html__('Icon Size', 'ahura'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
				'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 80
                    ],
				],
				'default' => [
					'unit' => 'px',
					'size' => 30,
				],
				'selectors' => [
					'{{WRAPPER}} .items_section .icon' => 'font-size: {{SIZE}}{{UNIT}};',
				],
            ]
        );
        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'label' => __('Item Text Typography', 'ahura'),
				'name' => 'item_text_typography',
				'selector' => '{{WRAPPER}} .items_section .title',
                'fields_options' =>
				[
                    'typography' => [
                        'default' => 'yes'
                    ],
                    'font_weight' => [
                        'default' => 'bold'
                    ],
					'font_size' => [
						'default' => [
							'unit' => 'px',
							'size' => '20',
						]
					]
				]
			]
		);
        $this->add_control(
            'item_padding',
            [
                'label' => esc_html__('Item Padding', 'ahura'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .items_section .item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
                'default' =>
                [
                    'isLinked' => true,
                    'top' => '45',
                    'right' => '45',
                    'bottom' => '45',
                    'left' => '45',
                ]
            ]
        );
        $items_repeater = new \Elementor\Repeater();
        $items_repeater->add_control(
			'item_title',
			[
				'label' => __( 'Title', 'ahura' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Title', 'ahura' ),
			]
		);
        $items_repeater->add_control(
            'item_icon',
            [
                'label' => esc_html__('Icon', 'ahura'),
                'type' => Controls_Manager::ICONS,
                'skin' => 'inline',
                'exclude_inline_options' => ['svg'],
                'default' => [
                    'library' => 'solid',
                    'value' => 'fas fa-rocket'
                ]
            ]
        );
        $items_repeater->add_control(
			'item_color',
			[
				'label' => __( 'Color', 'ahura' ),
				'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#9397f5',
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .icon' => 'color: {{VALUE}}',
					'{{WRAPPER}} {{CURRENT_ITEM}} .title' => 'color: {{VALUE}}',
					'{{WRAPPER}} {{CURRENT_ITEM}}:hover' => 'box-shadow: 5px 10px 10px 0 {{VALUE}}1a',
				],
			]
		);
        $items_repeater->add_control(
			'item_link',
			[
				'label' => esc_html__( 'Link', 'ahura'),
				'type' => Controls_Manager::URL,
				'placeholder' => 'https://mihanwp.com/',
				'show_external' => true,
                'dynamic' => ['active' => true],
				'default' => [
					'url' => '',
					'is_external' => true,
					'nofollow' => true,
				],
			]
		);
        $default_item = [
            [
                'item_title' => __('T-Shirt', 'ahura'),
                'item_color' => '#9397f5',
                'item_icon' => [
                    'value' => 'fas fa-tshirt'
                ],
            ],
            [
                'item_title' => __('T-Shirt', 'ahura'),
                'item_color' => '#9397f5',
                'item_icon' => [
                    'value' => 'fas fa-tshirt'
                ],
            ],
            [
                'item_title' => __('T-Shirt', 'ahura'),
                'item_color' => '#9397f5',
                'item_icon' => [
                    'value' => 'fas fa-tshirt'
                ],
            ],
            [
                'item_title' => __('T-Shirt', 'ahura'),
                'item_color' => '#9397f5',
                'item_icon' => [
                    'value' => 'fas fa-tshirt'
                ],
            ],
        ];
        $this->add_control(
            'category_items',
            [
                'label' => esc_html__('Items', 'ahura'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $items_repeater->get_controls(),
                'title_field' => '{{{item_title}}}',
                'default' => $default_item
            ]
        );
        $this->end_controls_section();
    }
    protected function render_link_attrs($url_data)
	{
        if(!$url_data)
        {
            return false;
        }
		$target = $url_data['is_external'] ? 'target="_blank"' : '';
		$nofollow = $url_data['nofollow'] ? 'rel="nofollow"' : '';
		$cu_attr = $url_data['custom_attributes'] ? $url_data['custom_attributes'] : false;
		$data = 'href="'.$url_data['url'].'" '.$target.' '.$nofollow.' '.$cu_attr;
		echo $data;
	}
    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $items = $settings['category_items'];
        ?>
        <div class="ahura_element_category_box">
            <div class="info_section">
                <div class="title"><?php echo $settings['title'];?></div>
                <div class="description"><p><?php echo $settings['description_text']?></p></div>
                <a <?php $this->render_link_attrs($settings['button_link'])?> class="button">مشاهده همه</a>
            </div>
            <div class="items_section">
                <?php if($items): ?>
                    <?php foreach($items as $item): ?>
                        <a <?php $this->render_link_attrs($item['item_link'])?> class="item elementor-repeater-item-<?php echo $item['_id']?>">
                            <div class="icon"><?php \Elementor\Icons_Manager::render_icon($item['item_icon'])?></div>
                            <div class="title"><?php echo $item['item_title']; ?></div>
                        </a>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
        <?php
    }
}