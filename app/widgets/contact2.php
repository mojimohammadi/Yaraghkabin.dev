<?php

namespace ahura\app\widgets;

class contact2 extends \WP_Widget
{
    /**
     * contact2 constructor.
     *
     * creating widget
     */
    function __construct()
    {
        parent::__construct('ahura_contact2', __('Ahura: Contact 2', 'ahura'), [
            'description' => __('Ahura Show Contact info', 'ahura'),
            'show_instance_in_rest' => true,
        ]);
    }

    /**
     * @param $args
     * @param $instance
     *
     * Display widget front-end
     */
    public function widget($args, $instance)
    {
        $title = apply_filters('widget_title', $instance['title']);
        $items = apply_filters('widget_items', $instance['items']);
        // outputs the content of the widget
        extract($args);
        echo $before_widget;
        if ($title) {
            echo $before_title . $title . $after_title;
        }
        ?>
        <div class="ahura_contact_widget">
        <?php
        if($items && isset($items['contacts'])):
            foreach($items['contacts'] as $key => $value):
                ?>
                <div class="ci">
                    <div class="ahura_contact_widget_item">
                        <span><?php echo $value['title'] ?></span>
                        <p><?php echo $value['value'] ?></p>
                    </div>
                </div>
            <?php
            endforeach;
        endif;
        ?>
        </div>
        <?php
        echo $after_widget;
    }

    public function form($instance)
    {
        $title = isset($instance['title']) ? $instance['title'] : esc_html__('Contact', 'ahura');
        $items = isset($instance['items']) ? $instance['items'] : [];
        ?>
        <style type="text/css">
            .ahura_contact_widget_box .ahura_contact_item_delete{position:absolute;border:none;left:5px;background:#f75b5b;color:#fff;padding:3px;font-size:12px;border-radius:2px;font-weight:100;cursor:pointer}.ahura_contact_widget_box input,.ahura_contact_widget_box button,.ahura_contact_widget_boxspan,.ahura_contact_widget_boxlabel{font-family:IRANSans!important}.ahura_contact_widget_box button#ahura_contact_widget_new_info{background:#ffc33a;box-shadow:0 7px 20px #ffc33a60;padding:0 20px;border-radius:50px;color:#fff;line-height:3em;font-weight:400;margin-top:20px;border:none;cursor:pointer;font-size:14px}
            .contact-item {background-color: #f0f0f0;padding: 8px;border-radius: 5px;margin-bottom: 10px;position: relative;}
            .contact-item label {display: inline-block;margin-bottom: 6px;}
        </style>
        <div class="ahura_contact_widget_box">
            <p>
                <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Widget title', 'ahura'); ?></label>
                <input type="text" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $title; ?>" />
            </p>
            <div class="contact-2-widget-items">
                <?php
                if($items && isset($items['contacts'])):
                    foreach($items['contacts'] as $key => $value):
                    ?>
                        <div class="contact-item" item-id="<?php echo $key ?>">
                            <button class="ahura_contact_item_delete acid" type="button" data-widget-id="<?php echo $this->id ?>"><?php _e('Delete', 'ahura')?></button>
                            <br>
                            <label><?php _e('Title', 'ahura')?></label>
                            <input type="text" value="<?php echo $value['title'] ?>" class="widefat" id="widget-<?php echo $this->id ?>-items-<?php echo $key ?>" name="widget-<?php echo $this->id_base ?>[<?php echo $this->number ?>][items][contacts][<?php echo $key ?>][title]">
                            <label><?php _e('Value', 'ahura')?></label>
                            <input type="text" value="<?php echo $value['value'] ?>" class="widefat" id="widget-<?php echo $this->id ?>-items-<?php echo $key ?>" name="widget-<?php echo $this->id_base ?>[<?php echo $this->number ?>][items][contacts][<?php echo $key ?>][value]">
                        </div>
                <?php
                    endforeach;
                endif;
                ?>
            </div>
            <input id="contact_count" type="hidden" value="0"/>
            <button id="ahura_contact_widget_new_info" type="button" data-widget-id="<?php echo $this->id ?>" data-item-name="<?php echo $this->get_field_name('items'); ?>" data-item-id="<?php echo $this->get_field_id('items'); ?>">
                <?php _e('Add new item', 'ahura') ?>
            </button>
        </div>
    <?php }

    public function update($new_instance, $old_instance)
    {
        $instance = array();
        $instance['title'] = (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';
        $instance['items'] = ($new_instance['items']) ? $new_instance['items'] : '';
        return $instance;
    }
}
