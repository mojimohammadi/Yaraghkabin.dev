<?php
namespace ahura\inc\widgets;

use ahura\app\mw_assets;
use Elementor\Controls_Manager;

// Block direct access to the main plugin file.
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

class banner_box_2 extends \Elementor\Widget_Base
{
    use \ahura\app\traits\mw_elementor;
    public function get_name()
    {
        return 'ahura_banner_box_2';
    }
    public function get_icon() {
		return 'aicon-svg-banner-box-2';
	}
    function get_title()
    {
        return esc_html__('Banner Box 2', 'ahura');
    }
    function get_categories() {
		return [ 'ahuraelements' ];
	}
    function get_keywords()
    {
        return ['bannerbox2', 'banner_box_2', esc_html__('Banner box 2', 'ahura')];
    }
    function __construct($data=[], $args=null)
    {
        parent::__construct($data, $args);
        $banner_box_2_css = mw_assets::get_css('elementor.banner_box_2');
        mw_assets::register_style('banner_box_2', $banner_box_2_css);
    }
    function get_style_depends()
    {
        return [mw_assets::get_handle_name('banner_box_2')];
    }
    protected function register_controls()
    {
        $this->start_controls_section(
            'title_section',
            [
                'label' => esc_html__('Title', 'ahura'),
            ]
        );
        $this->add_control(
            'title',
            [
                'label' => esc_html__('Title', 'ahura'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Bag', 'ahura'),
            ]
        );
        $this->add_control(
            'title_color',
            [
                'label' => esc_html__('Color', 'ahura'),
                'type' => Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' =>
                [
                    '{{WRAPPER}} .title' => 'color: {{VALUE}}'
                ]
            ]
        );
        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
                'label' => esc_html__('Typography', 'ahura'),
				'selector' => '{{WRAPPER}} .title span',
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
                        'default' => 'bold'
                    ]
				]
			]
		);
        $this->end_controls_section();
        $this->start_controls_section(
            'button_section',
            [
                'label' => esc_html__('Button', 'ahura')
            ]
        );
        $this->add_control(
            'button_text',
            [
                'label' => esc_html__('Text', 'ahura'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Show Products', 'ahura'),
            ]
        );
        $this->add_control(
            'button_text_color',
            [
                'label' => esc_html__('Text Color', 'ahura'),
                'type' => Controls_Manager::COLOR,
                'default' => '#39ca9d',
                'selectors' =>
                [
                    '{{WRAPPER}} .btn-wrapper' => 'color: {{VALUE}}'
                ]
            ]
        );
        $this->add_control(
            'button_bg_color',
            [
                'label' => esc_html__('Background Color', 'ahura'),
                'type' => Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' =>
                [
                    '{{WRAPPER}} .btn-wrapper' => 'background-color: {{VALUE}}'
                ]
            ]
        );        
        $this->add_control(
			'button_link',
			[
				'label' => esc_html__( 'Button link', 'ahura' ),
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
            'circle_section',
            [
                'label' => esc_html__('Circle', 'ahura')
            ]
        );
        $this->add_control(
            'circle_bg_color',
            [
                'label' => esc_html__('Circle background color', 'ahura'),
                'type' => Controls_Manager::COLOR,
                'default' => '#36ab87',
                'selectors' =>
                [
                    '{{WRAPPER}} .circle' => 'background-color: {{VALUE}}'
                ]
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'box_section',
            [
                'label' => esc_html__('Box', 'ahura')
            ]
        );        
        $this->add_control(
            'box_border_radius',
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
					'{{WRAPPER}} .ahura_element_banner_box_2' => 'border-radius: {{SIZE}}{{UNIT}};',
				],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'box_bg',
                'selector' => '{{WRAPPER}} .ahura_element_banner_box_2',
                'fields_options' =>
                [
                    'background' =>
                    [
                        'default' => 'classic'
                    ],
                    'color' => 
                    [
                        'default' => '#44D7AA'
                    ],
                ]
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
        ?>
        <div class="ahura_element_banner_box_2">
            <div class="circle">
                <div class="title">
                    <span><?php echo $settings['title'];?></span>
                </div>
                <a <?php $this->render_link_attrs($settings['button_link'])?> class="btn-wrapper"><?php echo $settings['button_text']?></a>
            </div>
        </div>
        <?php
    }
}