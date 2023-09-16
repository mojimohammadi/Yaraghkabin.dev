<?php
namespace ahura\inc\widgets;

use ahura\app\mw_assets;

// Block direct access to the main plugin file.
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

class image_box extends \Elementor\Widget_Base
{
    use \ahura\app\traits\mw_elementor;
    public function get_name()
    {
        return 'ahura_image_box';
    }
    function get_title()
    {
        return esc_html__('Image box', 'ahura');
    }
    public function get_icon() {
		return 'aicon-svg-image-box';
	}
    function get_categories() {
		return [ 'ahuraelements' ];
	}
    function get_keywords()
    {
        return ['image_box', 'imagebox', esc_html__( 'Image box' , 'ahura')];
    }
    function __construct($data=[], $args=null)
    {
        parent::__construct($data, $args);
        $image_box_css = mw_assets::get_css('elementor.image_box');
        mw_assets::register_style('image_box', $image_box_css);
    }
    function get_style_depends()
    {
        return [mw_assets::get_handle_name('image_box')];
    }
    protected function register_controls()
    {
        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__('Content', 'ahura'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT
            ]
        );
        $this->add_control(
            'title',
            [
                'label' => esc_html__('Title', 'ahura'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Title Here', 'ahura')
            ]
        );
        $this->add_control(
            'sub_title',
            [
                'label' => esc_html__('Sub title', 'ahura'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Sub title here', 'ahura')
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'box_style',
            [
                'label' => esc_html__('Box style', 'ahura'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'box_background',
                'label' => esc_html__('Background', 'ahura'),
                'selector' => '{{WRAPPER}} .ahura_image_box',
                'fields_options' => [
                    'background' => [
                        'default' => 'classic'
                    ],
                    'color' => [
                        'default' => '#EADD9E'
                    ]                    
                ]
            ]
        );
        $this->add_control(
            'box_height',
            [
                'label' => esc_html__('Height', 'ahura'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 1000,
                    ]
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 300
                ],
                'selectors' => [
                    '{{WRAPPER}} .ahura_image_box' => 'height: {{SIZE}}{{UNIT}}'
                ]
            ]
        );
        $this->add_control(
            'box_border_radius',
            [
                'label' => esc_html__('Border radius', 'ahura'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['%'],
                'range' => [
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ]
                ],
                'default' => [
                    'unit' => '%',
                    'size' => 3
                ],
                'selectors' => [
                    '{{WRAPPER}} .ahura_image_box' => 'border-radius: {{SIZE}}{{UNIT}}'
                ]
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'typography',
            [
                'label' => esc_html__('Typography', 'ahura'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'label' => esc_html__('Title typography', 'ahura'),
                'name' => 'title_typography',
                'selector' => '{{WRAPPER}} .ahura_image_box .title',
                'fields_options' => [
                    'typography' => ['default' => 'yes'],
                    'font_size' => [
                        'default' => [
                            'unit' => 'px',
                            'size' => 20
                        ]
                    ]
                ]
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'label' => esc_html__('sub title typography', 'ahura'),
                'name' => 'sub_title_typography',
                'selector' => '{{WRAPPER}} .ahura_image_box .sub_title',
                'fields_options' => [
                    'typography' => ['default' => 'yes'],
                    'font_size' => [
                        'default' => [
                            'unit' => 'px',
                            'size' => 17
                        ]
                    ]
                ]
            ]
        );
        $this->add_control(
			'title_alignment',
			[
				'label' => __( 'Title alignment', 'ahura' ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'right' => [
						'title' => __( 'Right', 'ahura' ),
						'icon' => 'fa fa-align-right',
					],
					'center' => [
						'title' => __( 'Center', 'ahura' ),
						'icon' => 'fa fa-align-center',
					],
					'left' => [
						'title' => __( 'Left', 'ahura' ),
						'icon' => 'fa fa-align-left',
					]
				],
				'default' => 'center',
				'toggle' => false,
			]
		);
        $this->add_control(
			'sub_title_alignment',
			[
				'label' => __( 'Sub title alignment', 'ahura' ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'right' => [
						'title' => __( 'Right', 'ahura' ),
						'icon' => 'fa fa-align-right',
					],
					'center' => [
						'title' => __( 'Center', 'ahura' ),
						'icon' => 'fa fa-align-center',
					],
					'left' => [
						'title' => __( 'Left', 'ahura' ),
						'icon' => 'fa fa-align-left',
					]
				],
				'default' => 'center',
				'toggle' => false,
			]
		);
        $this->add_control(
			'title_margin',
			[
				'label' => __( 'Title margin', 'ahura' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
                'default' => [
                    'isLinked' => false
                ],
				'selectors' => [
					'{{WRAPPER}} .ahura_image_box .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				],
			]
		);
        $this->add_control(
			'sub_title_margin',
			[
				'label' => __( 'Sub title margin', 'ahura' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
                'default' => [
                    'isLinked' => false
                ],
				'selectors' => [
					'{{WRAPPER}} .ahura_image_box .sub_title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				],
			]
		);
        $this->end_controls_section();
    }
	protected function render_link_attrs($url_data)
	{
		$target = $url_data['is_external'] ? 'target="_blank"' : '';
		$nofollow = $url_data['nofollow'] ? 'rel="nofollow"' : '';
		$cu_attr = $url_data['custom_attributes'] ? $url_data['custom_attributes'] : false;
		$data = 'href="'.$url_data['url'].'" '.$target.' '.$nofollow.' '.$cu_attr;
		echo $data;
	}
    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $title_alignment = $settings['title_alignment'];
        $sub_title_alignment = $settings['sub_title_alignment'];
        ?>
        <div class="ahura_image_box">
            <div class="title <?php echo $title_alignment?>"><?php echo $settings['title'];?></div>
            <div class="sub_title <?php echo $sub_title_alignment?>"><?php echo $settings['sub_title']; ?></div>
        </div>
        <?php
    }
}