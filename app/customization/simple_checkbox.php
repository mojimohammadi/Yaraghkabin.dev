<?php
namespace ahura\app\customization;

if(class_exists('WP_Customize_Control'))
{
    class simple_checkbox extends \WP_Customize_Control
    {
        function enqueue()
        {
            $simple_checkbox_css = get_template_directory_uri() . '/css/customization/simple_checkbox.css';
            wp_enqueue_style('ahura_customization_simple_checkbox', $simple_checkbox_css);
        }
        function render_content()
        {
            ?>
            <?php if(!empty($this->description)):?>
                <span class="ahura_cusomize_controller_description margin_bottom"><?php echo $this->description;?></span>
            <?php endif; ?>
            <div class="ahura_customize_simple_checkbox_wrapper">
                <label>
                    <input value="1" <?php checked($this->value(), true)?> type="checkbox" name="<?php echo esc_attr($this->id)?>" <?php $this->link();?>>
                    <span class="label">
                        <span class="label_text"><?php echo $this->label;?></span>
                    </span>
                </label>
            </div>
            <?php
        }
    }
}