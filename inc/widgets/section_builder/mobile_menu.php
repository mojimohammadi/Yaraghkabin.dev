<?php

// Block direct access to the main plugin file.
defined('ABSPATH') or die('No script kiddies please!');

use Elementor\Controls_Manager;

class Ahura_Mobile_Menu extends \Elementor\Widget_Base
{

    public function get_name()
    {
        return 'mobilemenu';
    }

    public function get_title()
    {
        return __('Mobile Menu', 'ahura');
    }

    public function get_icon()
    {
        return 'eicon-menu-toggle';
    }

    public function get_categories()
    {
        return ['ahurabuilder'];
    }

    protected function register_controls()
    {
        $this->start_controls_section(
            'content_section',
            [
                'label' => __('Content', 'ahura'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'icon',
            [
                'label' => esc_html__('Icon', 'ahura'),
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-bars',
                    'library' => 'fa-solid',
                ],
            ]
        );

        $this->add_control(
            'hide_in_scroll',
            [
                'label' => __('Hide in scroll', 'ahura'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'default' => false
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
            'content_style_section',
            [
                'label' => __('Menu', 'ahura'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
			'more_options',
			[
				'label' => esc_html__('Menu', 'ahura'),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

        $alignment = array(
            'right' => [
                'title' => esc_html__('Right', 'ahura'),
                'icon' => 'eicon-text-align-right',
            ],
            'center' => [
                'title' => esc_html__('Center', 'ahura'),
                'icon' => 'eicon-text-align-center',
            ],
            'left' => [
                'title' => esc_html__('Left', 'ahura'),
                'icon' => 'eicon-text-align-left',
            ]
        );

        $this->add_control(
            'mobile_text_align',
            [
                'label' => esc_html__('Text Alignment', 'ahura'),
                'type' => Controls_Manager::CHOOSE,
                'options' => (is_rtl()) ? $alignment : array_reverse($alignment),
                'default' => 'right',
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .siteside ul li a' => 'text-align: {{VALUE}}',
                ]
            ]
        );

        $this->add_control(
            'back_mobile_menu_color',
            [
                'label' => __('Mobile menu backrground color', 'ahura'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' =>
                    [
                        '.siteside' => 'background-color: {{VALUE}}',
                    ]
            ]
        );

        $this->add_control(
            'mobile_menu_color',
            [
                'label' => __('Mobile menu color', 'ahura'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' =>
                    [
                        '.siteside li a' => 'color: {{VALUE}}',
                    ]
            ]
        );
		
		$this->add_control(
            'mobile_menu_color_hover',
            [
                'label' => esc_html__('Hover Color', 'ahura'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' =>
                    [
                        '.siteside li a:hover' => 'color: {{VALUE}} !important',
                    ]
            ]
        );

        $this->add_control(
            'mobile_menu_current_color_hover',
            [
                'label' => __('Current Menu color', 'ahura'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' =>
                    [
                        '.siteside li.current-menu-item a' => 'color: {{VALUE}}',
                    ]
            ]
        );

        $this->add_control(
            'back_mobile_menu_current_color_hover',
            [
                'label' => __('Current Menu Background color', 'ahura'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' =>
                    [
                        '.siteside li.current-menu-item a' => 'background-color: {{VALUE}}',
                    ]
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'items_border',
                'label' => esc_html__('Border', 'ahura'),
                'selector' => '.siteside li a',
            ]
        );

        $this->add_control(
            'items_spacing',
            [
                'label' => esc_html__('Margin', 'ahura'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', 'rem'],
                'allowed_dimensions' => ['top', 'bottom'],
                'selectors' => [
                    '.siteside li' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
			'more2_options',
			[
				'label' => esc_html__('Button', 'ahura'),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

        $this->add_responsive_control(
            'mm_btn_icon_size',
            [
                'label' => esc_html__('Icon Size', 'ahura'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px','em','rem','%'],
                'selectors' => [
                    '{{WRAPPER}} .menu-icon, #topbar {{WRAPPER}} .menu-icon' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .menu-icon svg, #topbar {{WRAPPER}} .menu-icon svg' => 'width: {{SIZE}}{{UNIT}};',
                ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 200
                    ],
                ],
            ]
        );

        $this->add_control(
            'mm_btn_color',
            [
                'label' => esc_html__('Color', 'ahura'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .menu-icon, #topbar {{WRAPPER}} .menu-icon' => 'color: {{VALUE}}',
                ]
            ]
        );

        $this->end_controls_section();
        $this->start_controls_section(
            'sub_content_style_section',
            [
                'label' => __('SubMenu', 'ahura'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );


        $this->add_control(
            'mobile_menu_sub_color',
            [
                'label' => __('Sub Menu color', 'ahura'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' =>
                    [
                        '.siteside .sub-menu li a' => 'color: {{VALUE}}',
                    ]
            ]
        );
		
		$this->add_control(
            'mobile_menu_sub_menu_color_hover',
            [
                'label' => esc_html__('Hover Color', 'ahura'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' =>
                    [
                        '.siteside .sub-menu li a:hover' => 'color: {{VALUE}} !important',
                    ]
            ]
        );

        $this->add_control(
            'back_mobile_menu_sub_color_hover',
            [
                'label' => __('Sub Menu Background color', 'ahura'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' =>
                    [
                        '.siteside .sub-menu li a' => 'background-color: {{VALUE}}',
                    ]
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        ?>
        <?php if (has_nav_menu('topmenu')) : ?>
        <a href="#" class="menu-icon<?php if ($settings['hide_in_scroll']) {
            echo ' hide_in_scroll';
        } ?>" id="mw_open_side_menu">
            <?php \Elementor\Icons_Manager::render_icon( $settings['icon'], [ 'aria-hidden' => 'true' ] ); ?>
        </a>
        <div id="siteside" class="siteside" data-align="<?php echo $settings['mobile_text_align'] ?>">
            <span class="fa fa-window-close siteside-close" id="menu-close"></span>
            <?php rd_topmenu(); ?>
        </div>
    <?php endif; ?>
        <?php
    }
}
