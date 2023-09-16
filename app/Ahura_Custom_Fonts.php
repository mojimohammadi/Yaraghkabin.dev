<?php

namespace ahura\app;

class Ahura_Custom_Fonts
{
    public static function getFontsObj(){
        return get_posts(['post_type' => 'ahura_fonts', 'post_status' => 'publish']);
    }

    public static function getFonts(){
        $fonts = static::getFontsObj();
        $arr = [];
        if($fonts){
            foreach($fonts as $font){
                $options = get_post_meta($font->ID, 'font_variations');
                if($options){
                    foreach($options as $key => $option){
                        if(is_array($option) && count($option) > 0){
                            $arr[$font->ID] = [
                                'font_family' => ($font->post_title) ? $font->post_title : '',
                                'vars' => $option
                            ];
                        }
                    }
                }
            }
        }
        return $arr;
    }
}