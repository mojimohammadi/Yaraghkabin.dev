<?php
namespace ahura\inc\widgets;

// Block direct access to the main plugin file.
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );


class colorful_title extends \Elementor\Widget_Base {
	use \ahura\app\traits\mw_elementor;
	
	public function get_name() {
		return 'ahura_colorful_title';
	}

	public function get_title() {
		return __( 'Colorful Title', 'ahura' );
	}

	public function get_icon() {
		return 'aicon-svg-colorful-title';
	}

	public function get_categories() {
		return [ 'ahuraelements' ];
	}
	function get_keywords()
	{
		return ['colorful_title', 'colorfultitle', esc_html__( 'Colorful Title' , 'ahura')];
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
			'colorful_title',
			[
				'label' => __("Title Colorful", 'ahura'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __("Title Colorful Here", 'ahura')
			]
		);
		$this->add_control(
			'colorful_title_color',
			[
				'label' => __("Title Colorful Color", 'ahura'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => 
				[
					'{{WRAPPER}} .colorful_title' => 'color: {{VALUE}}',
				]			]
		);
		$this->add_control(
			'title_two',
			[
				'label' => __("Title Two", 'ahura'),
				'type' => \Elementor\Controls_Manager::TEXT,
			]
		);
		$this->add_control(
			'colorful_title_two_color',
			[
				'label' => __("Title Colorful Color", 'ahura'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => 
				[
					'{{WRAPPER}} span:nth-child(2)' => 'color: {{VALUE}}',
				]			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'label' => __('Typography', 'ahura'),
				'name' => 'colorful_typoghraphy',
				'selector' => "{{WRAPPER}} .colorful_element span"
			]
		);
		$this->add_responsive_control(
			'colorful_title_align',
			[
				'label' => __( 'Alignment', 'ahura' ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __( 'Left', 'ahura' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'ahura' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'ahura' ),
						'icon' => 'eicon-text-align-right',
					],
					'justify' => [
						'title' => __( 'Justified', 'ahura' ),
						'icon' => 'eicon-text-align-justify',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .colorful_element' => 'text-align: {{VALUE}};',
				],
			]
		);
		$this->end_controls_section();
	}
	protected function render() {
		$settings = $this->get_settings_for_display();
		?>
		<div class="colorful_element">
			<span class="colorful_title"><?php echo $settings['colorful_title'];?> </span><span><?php echo $settings['title_two'];?></span>
		</div>
		<?php
	}

}
