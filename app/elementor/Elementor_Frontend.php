<?php
namespace ahura\app\elementor;

use Elementor\Plugin;
use Elementor\Widget_Base;

class Elementor_Frontend {
    private function render_element_plain_content($element_data) {
        if ('widget' === $element_data['elType']) {
            $widget = Plugin::$instance->elements_manager->create_element_instance($element_data);
            if ($widget) {
                $widget->print_element();
            }
        }

        if ( ! empty( $element_data['elements'] ) ) {
            foreach ( $element_data['elements'] as $element ) {
                $this->render_element_plain_content( $element );
            }
        }
    }

    public function render_widgets($category, $count = 20, $return = false){
        $elementor_instance = Plugin::instance();
        $documents = $elementor_instance->documents;
        $widgets = $elementor_instance->widgets_manager->get_widget_types();
        $loaded_elements = isset($GLOBALS['ahura_render_elements']) && !empty($GLOBALS['ahura_render_elements']) ? $GLOBALS['ahura_render_elements'] : false;

        if(!$widgets || empty($category)){
            return false;
        }

        if($return){
            ob_start();
        }

        echo "<div class='custom-render-widgets-container'>";
        $i = 0;
        foreach ($widgets as $widget) {
            if(in_array($category, $widget->get_categories())){
                if($loaded_elements && in_array($widget->get_name(), $loaded_elements)){
                    continue;
                }
                $GLOBALS['ahura_render_elements'][] = $widget->get_name();

                if($category == 'ahurabuilder'){
                    echo '<div id="topbar" class="header-mode-1 header-mode-2 header-mode-3 clearfix">';
                }
                echo sprintf("<h3 class='render-elementor-widget-title'>%s</h3>", $widget->get_title());

                $this->render_element_plain_content([
                    'elType' => 'widget',
                    'widgetType' => $widget->get_name(),
                    'id' => uniqid(),
                ]);

                if($category == 'ahurabuilder'){
                    echo '</div>';
                }
                if($i == $count){
                    break;
                }
                $i++;
            }
        }
        echo '</div>';
        if($return){
            return ob_get_clean();
        }
    }
}