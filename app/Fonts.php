<?php
namespace ahura\app;

class Fonts {
    public static function get_font_options(){
        $font_options_key = [
            'ahura_theme_font',
            'ahura_en_theme_font',
            'ahura_post_font_family',
            'ahura_menu_font_family',
            'ahura_mega_menu_font_family',
            'ahura_footer_widget_font_family',
            'ahura_post_font_family',
            'ahura_post_title_font_family',
            'ahura_en_post_title_font_family',
            'ahura_single_post_author_font_family',
            'ahura_en_single_post_author_font_family',
            'ahura_single_post_cats_font_family',
            'ahura_single_post_comment_count_font_family',
            'ahura_en_single_post_comment_count_font_family',
            'ahura_single_post_date_font_family',
            'post_title_font_family',
            'post_description_font_family',
            'post_author_font_family',
            'post_time_font_family',
            'ahura_en_post_font_family',
        ];

        $font_options_key = apply_filters('ahura_get_font_options', $font_options_key);

        return $font_options_key;
    } 
    /**
     * 
     * Get current font stylesheets file uri
     * Returned all activated fonts stylesheet
     * 
     * @return array|bool
     */
    public static function get_current_font_file_stylesheets($return_path = true, $extension = 'php'){
        $styles = [];

        $font_options_key = self::get_font_options();
    
        $font_names = [\ahura\app\mw_options::get_mod_theme_font()];
    
        if(is_array($font_options_key) && count($font_options_key)){
            foreach($font_options_key as $option){
                if(!empty($option)){
                    $font_names[] = get_theme_mod($option, 'iransans');
                }
            }
        }
    
        $font_names = array_unique($font_names);

        if(is_array($font_names) && !empty($font_names) && count($font_names) > 0){
            foreach($font_names as $name){
                if(!empty($name)){
                    $font_path = "/css/fonts/{$name}." . $extension;
                    $style_uri = get_template_directory_uri() . $font_path;
                    $style_path = get_parent_theme_file_path($font_path);
                    $style_uri = (file_exists($style_path) && is_readable($style_path)) ? ($return_path === true ? $style_path : $style_uri)  : null;
                    if(!empty($style_uri)){
                        $styles[$name] = $style_uri;
                    }
                }
            }
        }
    
        return is_array($styles) && !empty($styles) && count($styles) > 0 ? array_unique($styles) : false;
    }

    /**
     * 
     *  Get current fonts inline style
     * 
     */
    public static function get_current_font_inline_styles(){
        $style_files = self::get_current_font_file_stylesheets();
        $inline_style = '';

        if(is_array($style_files) && count($style_files) > 0){
            foreach($style_files as $key => $value){
                $style = \ahura\app\mw_tools::get_executable_file_content($value);
                if(!empty($style)){
                    $inline_style .= $style;
                }
            }
        }

        return $inline_style;
    }

    /**
     * 
     * 
     * Generate font style file
     * 
     * 
     */
    public static function generate_fonts_style_file(){
        $font_styles = self::get_current_font_inline_styles();
        $style_hash = md5($font_styles);
        $dir = self::get_fonts_dir();
        $file_path = $dir . 'fonts.css';

        if(!empty($font_styles)){
            $current_style_hash = file_exists($file_path) ? md5(file_get_contents($file_path)) : null;
            if(!empty($current_style_hash) && $style_hash == $current_style_hash){
                return false;
            }
            file_put_contents($file_path, $font_styles);
        }
    }

    public static function get_fonts_dir(){
        $dir = get_template_directory();
        return $dir . '/css/fonts/';
    }

    public static function get_fonts_stylesheet_uri(){
        return get_template_directory_uri() . '/css/fonts/fonts.css';
    }
}