<?php

// Block direct access to the main plugin file.
use ahura\app\mw_assets;

defined('ABSPATH') or die('No script kiddies please!');

class Ahura_Popup_Login extends \Elementor\Widget_Base
{
    /**
     * Ahura_Popup_Login constructor.
     * @param array $data
     * @param null $args
     */
    public function __construct($data = [], $args = null)
    {
        parent::__construct($data, $args);
        wp_register_script(mw_assets::get_handle_name('modaljs'), get_template_directory_uri(). '/js/jquery.modal.min.js' , ['jquery'], null, true);
    }

    public function get_script_depends()
    {
        return [mw_assets::get_handle_name('modaljs')];
    }

    public function get_name()
    {
        return 'popuplogin';
    }

    public function get_title()
    {
        return __('Popup Login', 'ahura');
    }

    public function get_icon()
    {
        return 'eicon-user-circle-o';
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
                'label' => __('Icon', 'ahura'),
                'type' => \Elementor\Controls_Manager::ICONS
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

        $this->add_control(
            'show_register',
            [
                'label' => __('Show register', 'ahura'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'default' => false
            ]
        );

        $this->add_control(
            'register_text',
            [
                'label' => __('Register text', 'ahura'),
                'type' => \Elementor\Controls_Manager::TEXT,
            ]
        );
        $this->add_control(
            'register_link',
            [
                'label' => __('Restister link', 'ahura'),
                'type' => \Elementor\Controls_Manager::URL,
                'dynamic' => ['active' => true],
            ]
        );
        $this->add_control(
            'register_dir',
            [
                'label' => __('Register text direction', 'ahura'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __('Left', 'ahura'),
                        'icon' => 'fa fa-align-left',
                    ],
                    'right' => [
                        'title' => __('Right', 'ahura'),
                        'icon' => 'fa fa-align-right',
                    ],
                ],
                'default' => 'right',
                'toggle' => true,
            ]
        );

        $this->end_controls_section();
        /**
         *
         *
         * Popup button style
         *
         */
        $this->start_controls_section(
            'pbutton_styles_section',
            [
                'label' => __('Popup Button', 'ahura'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );


        $this->add_control(
            'box_pbutton_text_color',
            [
                'label' => esc_html__('Text Color', 'ahura'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#35495C',
                'selectors' => [
                    '{{WRAPPER}} .header-popup-login-icon' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'box_pbutton_bg_color',
            [
                'label' => esc_html__('Background Color', 'ahura'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .header-popup-login-icon' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'box_pbutton_border',
                'label' => esc_html__('Border', 'ahura'),
                'selector' => '{{WRAPPER}} .header-popup-login-icon',
            ]
        );

        $this->add_control(
            'box_pbutton_border_radius',
            [
                'label' => esc_html__('Border Radius', 'ahura'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .header-popup-login-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'box_pbutton_margin',
            [
                'label' => esc_html__('Margin', 'ahura'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem'],
                'selectors' => [
                    '{{WRAPPER}} .header-popup-login-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'box_pbutton_shadow',
                'label' => esc_html__('Box Shadow', 'ahura'),
                'selector' => '{{WRAPPER}} .header-popup-login-icon',
            ]
        );

        $this->end_controls_section();
        /**
         *
         *
         * Fields style
         *
         */
        $this->start_controls_section(
            'fields_styles_section',
            [
                'label' => __('Fields', 'ahura'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );


        $this->add_control(
            'box_field_text_color',
            [
                'label' => esc_html__('Text Color', 'ahura'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#ex1 input:not([type="checkbox"]), #ex1 input:not([type="radio"])' => 'color: {{VALUE}} !important',
                ],
            ]
        );

        $this->add_control(
            'box_field_bg_color',
            [
                'label' => esc_html__('Background Color', 'ahura'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#ex1 input:not([type="checkbox"]), #ex1 input:not([type="radio"])' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'box_field_border',
                'label' => esc_html__('Border', 'ahura'),
                'selector' => '#ex1 input:not([type="checkbox"]), #ex1 input:not([type="radio"])',
            ]
        );

        $this->add_control(
            'box_field_border_radius',
            [
                'label' => esc_html__('Border Radius', 'ahura'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '#ex1 input:not([type="checkbox"]), #ex1 input:not([type="radio"])' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'box_field_padding',
            [
                'label' => esc_html__('padding', 'ahura'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem'],
                'selectors' => [
                    '#ex1 input:not([type="checkbox"]), #ex1 input:not([type="radio"])' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'box_field_margin',
            [
                'label' => esc_html__('Margin', 'ahura'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem'],
                'selectors' => [
                    '#ex1 input:not([type="checkbox"]), #ex1 input:not([type="radio"])' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'box_field_shadow',
                'label' => esc_html__('Box Shadow', 'ahura'),
                'selector' => '#ex1 input:not([type="checkbox"]), #ex1 input:not([type="radio"])',
            ]
        );

        $this->end_controls_section();
        /**
         *
         *
         * Button styles
         *
         *
         */
        $this->start_controls_section(
            'buttons_styles_section',
            [
                'label' => __('Button', 'ahura'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );


        $this->add_control(
            'box_button_text_color',
            [
                'label' => esc_html__('Text Color', 'ahura'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#ex1 input[type="submit"]' => 'color: {{VALUE}}',
                    '#ex1 button[type="submit"]' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'box_button_bg_color',
            [
                'label' => esc_html__('Background Color', 'ahura'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#ex1 input[type="submit"]' => 'background-color: {{VALUE}}',
                    '#ex1 button[type="submit"]' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'box_button_border',
                'label' => esc_html__('Border', 'ahura'),
                'selector' => '#ex1 input[type="submit"], #ex1 button[type="submit"]',
            ]
        );

        $this->add_control(
            'box_button_border_radius',
            [
                'label' => esc_html__('Border Radius', 'ahura'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '#ex1 input[type="submit"]' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '#ex1 button[type="submit"]' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'box_button_padding',
            [
                'label' => esc_html__('padding', 'ahura'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem'],
                'selectors' => [
                    '#ex1 input[type="submit"]' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '#ex1 button[type="submit"]' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'box_button_margin',
            [
                'label' => esc_html__('Margin', 'ahura'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem'],
                'selectors' => [
                    '#ex1 input[type="submit"]' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '#ex1 button[type="submit"]' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'box_button_shadow',
                'label' => esc_html__('Box Shadow', 'ahura'),
                'selector' => '#ex1 input[type="submit"], #ex1 button[type="submit"]',
            ]
        );

        $this->end_controls_section();
        /**
         *
         *
         * Box styles
         *
         *
         */
        $this->start_controls_section(
            'box_styles_section',
            [
                'label' => __('Box', 'ahura'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'box_text_color',
            [
                'label' => esc_html__('Text Color', 'ahura'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#ex1, #ex1 label, #ex1 a' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'box_bg_color',
            [
                'label' => esc_html__('Background Color', 'ahura'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '#ex1' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'box_border',
                'label' => esc_html__('Border', 'ahura'),
                'selector' => '#ex1',
            ]
        );

        $this->add_control(
            'box_border_radius',
            [
                'label' => esc_html__('Border Radius', 'ahura'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '#ex1' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'box_shadow',
                'label' => esc_html__('Box Shadow', 'ahura'),
                'selector' => '#ex1',
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        require_once get_parent_theme_file_path('/template-parts/header/popuplogin.php');
        $popup_setting = [];
        if ($settings['show_register']) {
            $popup_setting = [
                'link' => isset($settings['register_link']['url']) ? $settings['register_link']['url'] : '',
                'text' => isset($settings['register_text']) ? $settings['register_text'] : '',
                'class' => isset($settings['register_dir']) ? $settings['register_dir'] : ''
            ];
        }
        $inElementor = $settings['show_register'] ? true : false
        ?>
        <div id="popup_login" class="in_custom_header<?php if ($settings['hide_in_scroll']) {
            echo ' hide_in_scroll';
        } ?>">
            <?php if (is_admin()): ?>
                <a class="header-popup-login-icon" href="#"><i class="<?php echo $settings['icon']['value'] ? $settings['icon']['value'] : 'fa fa-user' ?>"></i></a>
            <?php else: ?>
                <?php \ahura\header\PopupLogin::render_popup_link(); ?>
            <?php endif; ?>
        </div>
        <div id="ah-login-modal" class="modal">
            <h2 class="header-popup-title"><?php echo __('Login To Account', 'ahura'); ?></h2>
            <?php \ahura\header\PopupLogin::render_popup_content($inElementor, $popup_setting); ?>
        </div>
        <?php
    }
}
