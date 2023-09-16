<?php
namespace ahura\inc\widgets;

use ahura\app\mw_assets;

// Block direct access to the main plugin file.
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );


class item_call_action extends \Elementor\Widget_Base {
	use \ahura\app\traits\mw_elementor;
	
	public function get_name() {
		return 'item_call_action';
	}

	public function get_title() {
		return __( 'Call to Action', 'ahura' );
	}

	public function get_icon() {
		return 'aicon-svg-item-call-action';
	}

	public function get_categories() {
		return [ 'ahuraelements' ];
	}
	function get_keywords()
	{
		return ['item_call_action', 'itemcallaction', esc_html__( 'Call to Action' , 'ahura')];
	}
    
    public function __construct($data = [], $args = null) {
        parent::__construct($data, $args);
		$ctaStyle = mw_assets::get_css('elementor.call_to_action');
		mw_assets::register_style('cta_widget_style', $ctaStyle);
    }
 
    public function get_style_depends() {
		return [mw_assets::get_handle_name('cta_widget_style')];
    }
  

	protected function register_controls() {
		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Content', 'ahura' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
        
        $this->add_control(
			'cta_title', [
				'label' => __( 'Title', 'ahura' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'title' , 'ahura' ),
				'label_block' => true,
			]
		);

        $this->add_control(
            'title_color',
            [
                'type' => \Elementor\Controls_Manager::COLOR,
                'label' => __('Title color', 'ahura'),
                'default' => '#fff',
                'selectors' =>
                [
                    '{{WRAPPER}} .call_to_action .cta_content .cta_title' => 'color: {{VALUE}}'
                ]
            ]
        );

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
                'label' => __('Title typography', 'ahura'),
				'selector' => '{{WRAPPER}} .call_to_action .cta_content .cta_title',
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
        
        $this->add_control(
			'cta_desc', [
				'label' => __( 'Description', 'ahura' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'Description' , 'ahura' ),
				'label_block' => true,
			]
		);

        $this->add_control(
            'desc_color',
            [
                'type' => \Elementor\Controls_Manager::COLOR,
                'label' => __('Description color', 'ahura'),
                'default' => '#fff',
                'selectors' =>
                [
                    '{{WRAPPER}} .call_to_action .cta_content .cta_desc' => 'color: {{VALUE}}'
                ]
            ]
        );

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'desc_typography',
                'label' => __('Description typography', 'ahura'),
				'selector' => '{{WRAPPER}} .call_to_action .cta_content .cta_desc',
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

        $this->add_control(
			'text_direction',
			[
				'label' => __('Texts direction', 'ahura'),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'default' => 'center',
				'options' => [
					'right' => [
						'title' => __('right', 'ahura'),
						'icon' => 'eicon-h-align-right'
					],
					'center' => [
						'title' => __('center', 'ahura'),
						'icon' => 'eicon-h-align-center'
					],
					'left' => [
						'title' => __('left', 'ahura'),
						'icon' => 'eicon-h-align-left'
					],
				],
				'toggle' => true
			]
		);

		$this->end_controls_section();

        $this->start_controls_section(
			'btn_section',
			[
				'label' => __( 'button', 'ahura' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

        $this->add_control(
			'show_btn',
			[
				'label' => __('Show button', 'ahura'),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'default' => 'yes',
				'options' => [
					'yes' => [
						'title' => __('yes', 'ahura'),
						'icon' => 'eicon-check'
					],
					'no' => [
						'title' => __('no', 'ahura'),
						'icon' => 'eicon-close'
					],
				],
				'toggle' => true
			]
		);

        $this->add_control(
			'btn_text', [
				'label' => __( 'Button text', 'ahura' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'Text' , 'ahura' ),
				'label_block' => true,
			]
		);

        $this->add_control(
			'btn_link',
			[
				'label' => __( 'Button link', 'ahura' ),
				'type' => \Elementor\Controls_Manager::URL,
				'placeholder' => __( '#', 'ahura' ),
                'dynamic' => ['active' => true],
				'default' => [
					'url' => '',
					'is_external' => true,
					'nofollow' => true,
					'custom_attributes' => '',
				],
			]
		);

        $this->add_control(
			'btn_radius',
			[
				'label' => __( 'Button radius', 'ahura' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 0,
				'max' => 100,
				'step' => 1,
				'default' => 0,
			]
		);

        $this->add_control(
            'btn_title_color',
            [
                'type' => \Elementor\Controls_Manager::COLOR,
                'label' => __('Button title color', 'ahura'),
                'default' => '#444',
                'selectors' =>
                [
                    '{{WRAPPER}} .call_to_action .cta_content .cta_btn a' => 'color: {{VALUE}}'
                ]
            ]
        );

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'btn_title_typography',
                'label' => __('Button title typography', 'ahura'),
				'selector' => '{{WRAPPER}} .call_to_action .cta_content .cta_btn a',
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

        $this->add_control(
            'btn_back_color',
            [
                'type' => \Elementor\Controls_Manager::COLOR,
                'label' => __('Button background color', 'ahura'),
                'default' => '#fff',
                'selectors' =>
                [
                    '{{WRAPPER}} .call_to_action .cta_content .cta_btn a' => 'background-color: {{VALUE}}'
                ]
            ]
        );

        $this->add_control(
            'btn_hover_title_color',
            [
                'type' => \Elementor\Controls_Manager::COLOR,
                'label' => __('Button title hover color', 'ahura'),
                'default' => '#fff',
                'selectors' =>
                [
                    '{{WRAPPER}} .call_to_action .cta_content .cta_btn a:hover' => 'color: {{VALUE}}'
                ]
            ]
        );

        $this->add_control(
            'btn_hover_back_color',
            [
                'type' => \Elementor\Controls_Manager::COLOR,
                'label' => __('Button background hover color', 'ahura'),
                'default' => '#fff',
                'selectors' =>
                [
                    '{{WRAPPER}} .call_to_action .cta_content .cta_btn a:hover' => 'background-color: {{VALUE}}'
                ]
            ]
        );
        
        $this->end_controls_section();

        $this->start_controls_section(
			'image_section',
			[
				'label' => __( 'Image', 'ahura' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

        $this->add_control(
			'cta_image',
			[
				'label' => esc_html__( 'Choose Image', 'ahura' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);

        $this->add_control(
			'fit_image',
			[
				'label' => __('Fit image', 'ahura'),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'default' => 'initial',
				'options' => [
					'cover' => [
						'title' => __('yes', 'ahura'),
						'icon' => 'eicon-check'
					],
					'initial' => [
						'title' => __('no', 'ahura'),
						'icon' => 'eicon-close'
					],
				],
				'toggle' => true
			]
		);

        $this->add_control(
			'image_height',
			[
				'label' => __( 'Image height', 'ahura' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 100,
				'max' => 1000,
				'step' => 10,
				'default' => 400,
			]
		);

        $this->add_control(
			'image_position',
			[
				'label' => __( 'Images Position', 'ahura' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'initial',
				'options' => [
					'initial'  => __( 'initial', 'ahura' ),
					'left' => __( 'left', 'ahura' ),
					'right' => __( 'right', 'ahura' ),
					'top' => __( 'top', 'ahura' ),
					'bottom' => __( 'bottom', 'ahura' ),
					'center' => __( 'center', 'ahura' ),
				],
			]
		);

        $this->add_control(
			'image_effect',
			[
				'label' => __( 'Image effect', 'ahura' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 0,
				'max' => 100,
				'step' => 1,
				'default' => 100,
			]
		);

        $this->end_controls_section();
	}

    protected function render_link_attrs($url_data) {
		$target = $url_data['is_external'] ? 'target="_blank"' : '';
		$nofollow = $url_data['nofollow'] ? 'rel="nofollow"' : '';
		$cu_attr = $url_data['custom_attributes'] ? $url_data['custom_attributes'] : false;
		$data = 'href="'.$url_data['url'].'" '.$target.' '.$nofollow.' '.$cu_attr;
		echo $data;
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

        ?>

        <div class="call_to_action">
            <div class="container-fluid">
                <div class="row">
                    <div class="cta_image" style="background-image: url(<?php echo $settings['cta_image']['url']; ?>);background-size:<?php echo $settings['fit_image']; ?>;height:<?php echo $settings['image_height']; ?>px;background-position:<?php echo $settings['image_position']; ?>;filter: brightness(<?php echo $settings['image_effect']; ?>%);"></div>
                    <div class="cta_content" style="text-align: <?php echo $settings['text_direction']; ?>;">
                        <div class="cta_title"><?php echo $settings['cta_title']; ?></div>
                        <div class="cta_desc"><?php echo $settings['cta_desc']; ?></div>
                        <?php if($settings['show_btn'] === 'yes'): ?>
                            <div class="cta_btn"><a <?php $this->render_link_attrs($settings['btn_link']);?> style="border-radius:<?php echo $settings['btn_radius']; ?>px;"><?php echo $settings['btn_text']; ?></a></div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

    <?php
	}

}
