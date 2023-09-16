<?php
namespace ahura\inc\widgets;

// Block direct access to the main plugin file.

use ahura\app\mw_assets;
use Elementor\Controls_Manager;

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

class banner_box_5 extends \Elementor\Widget_Base
{
    use \ahura\app\traits\mw_elementor;
    public function get_name()
    {
        return 'ahura_banner_box_5';
    }
    function get_title()
    {
        return esc_html__('Banner Box 5', 'ahura');
    }
    public function get_icon() {
		return 'aicon-svg-banner-box-5';
	}
    function get_categories() {
		return [ 'ahuraelements' ];
	}
    function get_keywords()
    {
        return ['bannerbox5', 'banner_box_5', esc_html__('Banner box 5', 'ahura')];
    }
    function __construct($data=[], $args=null)
    {
        parent::__construct($data, $args);
        $bannerBox5_css = mw_assets::get_css('elementor.banner_box_5');
        mw_assets::register_style('banner_box_5', $bannerBox5_css);
    }
    function get_style_depends()
    {
        return [mw_assets::get_handle_name('banner_box_5')];
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
                'default' => '#00000047',
				'selectors' => [
					'{{WRAPPER}} .ahura_element_banner_box_5' => 'background-color: {{VALUE}}',
				],
			]
		);
        $this->add_control(
			'is_blur_background',
			[
				'label' => __( 'Blur Background', 'ahura' ),
                'description' => __('It is activate when you decrease oapcity in background color', 'ahura'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'ahura' ),
				'label_off' => __( 'Hide', 'ahura' ),
				'return_value' => 'yes',
                'default' => 'yes',
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
					'{{WRAPPER}} .ahura_element_banner_box_5' => 'border-radius: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .ahura_element_banner_box_5 .data' => 'border-radius: {{SIZE}}{{UNIT}};',
				],
            ]
        );
        $this->end_controls_section();
        
        $this->start_controls_section(
            'image_section',
            [
                'label' => esc_html__('Image', 'ahura'),
            ]
        );
        $this->add_control(
			'image',
			[
				'label' => __( 'Choose Image', 'plugin-domain' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);
        $this->add_control(
            'image_size',
            [
                'label' => esc_html__('Image Size', 'ahura'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ '%' ],
				'range' => [
                    '%' => [
                        'min' => 0,
                        'max' => 100
                    ],
				],
				'default' => [
					'unit' => '%',
					'size' => 90,
				],
				'selectors' => [
					'{{WRAPPER}} .ahura_element_banner_box_5 .image img' => 'width: {{SIZE}}{{UNIT}};',
				],
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'button_section',
            [
                'label' => esc_html__('Button', 'ahura'),
            ]
        );
        // text
        $this->add_control(
			'button_title',
			[
				'label' => __( 'Title', 'ahura' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'PlayStation', 'ahura' ),
			]
		);
        // icon
        $this->add_control(
            'icon',
            [
                'label' => esc_html__('Icon', 'ahura'),
                'type' => Controls_Manager::ICONS,
                'skin' => 'inline',
                'exclude_inline_options' => ['svg'],
                'default' => [
                    'library' => 'solid',
                    'value' => 'fas fa-chevron-left'
                ]
            ]
        );
        // link
        $this->add_control(
			'button_link',
			[
				'label' => esc_html__( 'Link', 'ahura'),
				'type' => Controls_Manager::URL,
				'placeholder' => 'https://mihanwp.com/',
				'show_external' => true,
				'default' => [
					'url' => '',
					'is_external' => true,
					'nofollow' => true,
				],
			]
		);
        // bg color
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'button_bg',
                'selector' => '{{WRAPPER}} .data',
                'fields_options' =>
                [
                    'background' =>
                    [
                        'default' => 'classic'
                    ],
                    'color' => 
                    [
                        'default' => '#E39D48'
                    ],
                ]
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
					'{{WRAPPER}} .data .title' => 'color: {{VALUE}}',
					'{{WRAPPER}} .data .icon' => 'color: {{VALUE}}',
				],
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
        $isBlur = $settings['is_blur_background'] == 'yes';
        ?>
        <div class="ahura_element_banner_box_5 <?php echo $isBlur ? 'blur' : '';?>">
            <div class="image">
                <img src="<?php echo $settings['image']['url']?>" alt="">
            </div>
            <a <?php $this->render_link_attrs($settings['button_link'])?> class="data">
                <div class="title"><span><?php echo $settings['button_title']; ?></span></div>
                <div class="icon"><?php \Elementor\Icons_Manager::render_icon($settings['icon'])?></div>
            </a>
        </div>
        <?php
    }
}