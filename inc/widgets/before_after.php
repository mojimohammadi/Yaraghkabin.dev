<?php
namespace ahura\inc\widgets;

use \Elementor\Controls_Manager;
use ahura\app\mw_assets;

// Block direct access to the main plugin file.
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

class before_after extends \Elementor\Widget_Base
{
    public function __construct($data=[], $args=[])
    {
        parent::__construct($data, $args);
        mw_assets::register_style('before_after', mw_assets::get_css('elementor.before_after'));
        mw_assets::register_script('before_after_js', mw_assets::get_js('elementor.before_after'));
    }

    public function get_style_depends()
    {
        $styles = [mw_assets::get_handle_name('before_after')];
        return $styles;
    }

    public function get_script_depends()
    {
        return [mw_assets::get_handle_name('before_after_js')];
    }

    public function get_name()
    {
        return 'ahura_before_after';
    }

    public function get_title()
    {
        return esc_html__('Before & After', 'ahura');
    }

    public function get_icon() {
		return 'eicon-image-before-after';
	}

    public function get_categories() {
		return ['ahuraelements'];
	}

    public function get_keywords()
    {
        return ['before_after', 'beforeafter', esc_html__('Before & After' , 'ahura')];
    }

    public function register_controls()
    {
        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__('Content', 'ahura'),
                'tab' => Controls_Manager::TAB_CONTENT
            ]
        );

        $this->add_control(
			'image1',
			[
				'label' => esc_html__('Image 1', 'ahura'),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);

        $this->add_control(
			'image2',
			[
				'label' => esc_html__('Image 2', 'ahura'),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);

        $this->end_controls_section();
        /**
         * 
         * 
         * 
         * Styles
         * 
         * 
         */
        $this->start_controls_section(
            'content_styles',
            [
                'label' => esc_html__('Content', 'ahura'),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_responsive_control(
            'box_width',
            [
                'label' => esc_html__('Width', 'ahura'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'rem', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .ahura-image-before-after' => 'width: {{SIZE}}{{UNIT}};',
                ],
                'range' => [
                    '%' => [
                        'min' => 0,
                        'max' => 100
                    ],
                    'px' => [
                        'min' => 0,
                        'max' => 3000
                    ],
                ],
                'default' => [
                    'unit' => '%',
                    'size' => 100
                ],
            ]
        );

        $this->add_responsive_control(
            'box_height',
            [
                'label' => esc_html__('Height', 'ahura'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'rem', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .ahura-image-before-after, {{WRAPPER}} .ahura-image-before-after img' => 'height: {{SIZE}}{{UNIT}};',
                ],
                'range' => [
                    '%' => [
                        'min' => 0,
                        'max' => 100
                    ],
                    'px' => [
                        'min' => 0,
                        'max' => 3000
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 650
                ],
            ]
        );

        $this->add_responsive_control(
            'box_radius',
            [
                'label' => esc_html__('Border Radius', 'ahura'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', 'rem', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .ahura-image-before-after' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    public function render()
    {
        $settings = $this->get_settings_for_display();
        $wid = $this->get_id();
        
        $img1 = $settings['image1'];
        $img2 = $settings['image2'];

        if(empty($img1['url']) || empty($img2['url'])){
            return false;
        }
        ?>
        <div class="ahura-image-before-after before-after-element">
            <div class="mover"></div>
            <img class="img-left" src="<?php echo esc_url($img1['url']); ?>">
            <img class="img-right" src="<?php echo esc_url($img2['url']); ?>">
        </div>
        <?php
    }
}