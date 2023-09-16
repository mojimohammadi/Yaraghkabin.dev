<?php
namespace ahura\app;

use ahura\app\Logger;

class Studio_Demo extends Studio {
    protected $demo_name = 'demo';
    private $demo_id = 0;

    /**
     * 
     * Generate demo screenshot url
     * 
     * @param string $path
     * @return string
     * 
     */
    public static function generate_screenshot_url($path){
        $base_url = self::get_base_url();
        $demo_base_url = $base_url . 'demo/ahura/wp-content/uploads/';
        return $demo_base_url . $path;
    }

    /**
     * 
     * 
     * Get demo list
     *
     * @return array
     * 
     */
    public static function get_demo_list(){
        $base_url = self::get_base_url();
        $license_key = \ahura\app\license::get_license_key();
	    $base_url = $base_url . 'api/v2/' . $license_key . '/demo/get/?product_id=' . MW_AHURA_UPDATER_ITEM_ID;
	
        $demos = array(
            array(
                'import_file_name'           => __('Construction','ahura'),
                'import_file_url'            => $base_url . '&demo=construction&type=theme',
                'import_widget_file_url'     => $base_url . '&demo=construction&type=widgets',
                'import_customizer_file_url' => $base_url . '&demo=construction&type=customizer',
                'import_demo_cat'            => 'services',
                'import_demo_name'           => 'construction',
                'import_demo_img'            => self::generate_screenshot_url('2022/04/%D8%B3%D8%A7%D8%AE%D8%AA-%D9%88-%D8%B3%D8%A7%D8%B2-%E2%80%93-%DB%8C%DA%A9-%D8%B3%D8%A7%DB%8C%D8%AA-%D9%85%DB%8C%D9%87%D9%86-%D9%85%D8%A7%D8%B1%DA%A9%D8%AA-%D8%AF%DB%8C%DA%AF%D8%B1.jpeg')
            ),
            array(
                'import_file_name'           => __('Company','ahura'),
                'import_file_url'            => $base_url . '&demo=company&type=theme',
                'import_widget_file_url'     => $base_url . '&demo=company&type=widgets',
                'import_customizer_file_url' => $base_url . '&demo=company&type=customizer',
                'import_demo_cat'            => 'services',
                'import_demo_name'           => 'company',
                'import_demo_img'            => self::generate_screenshot_url('2022/02/%D8%A7%D9%87%D9%88%D8%B1%D8%A7-%DA%A9%D9%85%D9%BE%D8%A7%D9%86%DB%8C-%E2%80%93-%DB%8C%DA%A9-%D8%B3%D8%A7%DB%8C%D8%AA-%D9%85%DB%8C%D9%87%D9%86-%D9%85%D8%A7%D8%B1%DA%A9%D8%AA-%D8%AF%DB%8C%DA%AF%D8%B1.jpeg')
            ),
            array(
                'import_file_name'           => __('Web Design','ahura'),
                'import_file_url'            => $base_url . '&demo=webdesign&type=theme',
                'import_widget_file_url'     => $base_url . '&demo=webdesign&type=widgets',
                'import_customizer_file_url' => $base_url . '&demo=webdesign&type=customizer',
                'import_demo_cat'            => 'services',
                'import_demo_name'           => 'webdesign',
                'import_demo_img'            => self::generate_screenshot_url('2022/02/%D8%B7%D8%B1%D8%A7%D8%AD%DB%8C-%D8%B3%D8%A7%DB%8C%D8%AA-%D8%A7%D9%87%D9%88%D8%B1%D8%A7-%E2%80%93-%DB%8C%DA%A9-%D8%B3%D8%A7%DB%8C%D8%AA-%D9%85%DB%8C%D9%87%D9%86-%D9%85%D8%A7%D8%B1%DA%A9%D8%AA-%D8%AF%DB%8C%DA%AF%D8%B1.jpeg'),
            ),
            array(
                'import_file_name'           => __('Fashion & Clothing','ahura'),
                'import_file_url'            => $base_url . '&demo=dress&type=theme',
                'import_widget_file_url'     => $base_url . '&demo=dress&type=widgets',
                'import_customizer_file_url' => $base_url . '&demo=dress&type=customizer',
                'import_demo_cat'            => 'shop',
                'import_demo_name'           => 'dress',
                'import_demo_img'            => self::generate_screenshot_url('2022/04/%D9%81%D8%B1%D9%88%D8%B4%DA%AF%D8%A7%D9%87-%D9%BE%D9%88%D8%B4%D8%A7%DA%A9-%D9%88-%D9%84%D8%A8%D8%A7%D8%B3-%E2%80%93-%DB%8C%DA%A9-%D8%B3%D8%A7%DB%8C%D8%AA-%D9%85%DB%8C%D9%87%D9%86-%D9%85%D8%A7%D8%B1%DA%A9%D8%AA-%D8%AF%DB%8C%DA%AF%D8%B1.jpeg')
            ),
            array(
                'import_file_name'           => __('Classic','ahura'),
                'import_file_url'            => $base_url . '&demo=classic&type=theme',
                'import_widget_file_url'     => $base_url . '&demo=classic&type=widgets',
                'import_customizer_file_url' => $base_url . '&demo=classic&type=customizer',
                'import_demo_cat'            => 'shop',
                'import_demo_name'           => 'classic',
                'import_demo_img'            => self::generate_screenshot_url('2022/04/%D8%AF%D9%85%D9%88-%DA%A9%D9%84%D8%A7%D8%B3%DB%8C%DA%A9-%E2%80%93-%DB%8C%DA%A9-%D8%B3%D8%A7%DB%8C%D8%AA-%D8%AF%DB%8C%DA%AF%D8%B1-%D8%A8%D8%A7-%D9%88%D8%B1%D8%AF%D9%BE%D8%B1%D8%B3-%D9%81%D8%A7%D8%B1%D8%B3%DB%8C-1.jpeg')
            ),
            array(
                'import_file_name'           => __('Mobile','ahura'),
                'import_file_url'            => $base_url . '&demo=mobile&type=theme',
                'import_widget_file_url'     => $base_url . '&demo=mobile&type=widgets',
                'import_customizer_file_url' => $base_url . '&demo=mobile&type=customizer',
                'import_demo_cat'            => 'shop',
                'import_demo_name'           => 'mobile',
                'import_demo_img'            => self::generate_screenshot_url('2022/03/%D9%81%D8%B1%D9%88%D8%B4%DA%AF%D8%A7%D9%87-%D9%85%D9%88%D8%A8%D8%A7%DB%8C%D9%84-%E2%80%93-%DB%8C%DA%A9-%D8%B3%D8%A7%DB%8C%D8%AA-%D9%85%DB%8C%D9%87%D9%86-%D9%85%D8%A7%D8%B1%DA%A9%D8%AA-%D8%AF%DB%8C%DA%AF%D8%B1.jpeg')
            ),
            array(
                'import_file_name'           => __('Fruit','ahura'),
                'import_file_url'            => $base_url . '&demo=fruit&type=theme',
                'import_widget_file_url'     => $base_url . '&demo=fruit&type=widgets',
                'import_customizer_file_url' => $base_url . '&demo=fruit&type=customizer',
                'import_demo_cat'            => 'shop',
                'import_demo_name'           => 'fruit',
                'import_demo_img'            => self::generate_screenshot_url('2022/04/%D9%85%DB%8C%D9%88%D9%87-%D9%81%D8%B1%D9%88%D8%B4%DB%8C-%E2%80%93-%DB%8C%DA%A9-%D8%B3%D8%A7%DB%8C%D8%AA-%D9%85%DB%8C%D9%87%D9%86-%D9%85%D8%A7%D8%B1%DA%A9%D8%AA-%D8%AF%DB%8C%DA%AF%D8%B1.jpeg')
            ),
            array(
                'import_file_name'           => __('Computer','ahura'),
                'import_file_url'            => $base_url . '&demo=computer&type=theme',
                'import_widget_file_url'     => $base_url . '&demo=computer&type=widgets',
                'import_customizer_file_url' => $base_url . '&demo=computer&type=customizer',
                'import_demo_cat'            => 'shop',
                'import_demo_name'           => 'computer',
                'import_demo_img'            => self::generate_screenshot_url('2022/04/%D9%81%D8%B1%D9%88%D8%B4%DA%AF%D8%A7%D9%87-%DA%A9%D8%A7%D9%85%D9%BE%DB%8C%D9%88%D8%AA%D8%B1-%E2%80%93-%DB%8C%DA%A9-%D8%B3%D8%A7%DB%8C%D8%AA-%D9%85%DB%8C%D9%87%D9%86-%D9%85%D8%A7%D8%B1%DA%A9%D8%AA-%D8%AF%DB%8C%DA%AF%D8%B1.jpeg')
            ),
            array(
                'import_file_name'           => __('Beauty','ahura'),
                'import_file_url'            => $base_url . '&demo=beauty&type=theme',
                'import_widget_file_url'     => $base_url . '&demo=beauty&type=widgets',
                'import_customizer_file_url' => $base_url . '&demo=beauty&type=customizer',
                'import_demo_cat'            => 'shop',
                'import_demo_name'           => 'beauty',
                'import_demo_img'            => self::generate_screenshot_url('2022/04/%D9%81%D8%B1%D9%88%D8%B4%DA%AF%D8%A7%D9%87-%D8%A7%D9%93%D8%B1%D8%A7%DB%8C%D8%B4%DB%8C-%D8%A8%D9%87%D8%AF%D8%A7%D8%B4%D8%AA%DB%8C-%E2%80%93-%DB%8C%DA%A9-%D8%B3%D8%A7%DB%8C%D8%AA-%D9%85%DB%8C%D9%87%D9%86-%D9%85%D8%A7%D8%B1%DA%A9%D8%AA-%D8%AF%DB%8C%DA%AF%D8%B1-1.jpeg')
            ),
            array(
                'import_file_name'           => __('Furniture','ahura'),
                'import_file_url'            => $base_url . '&demo=furniture&type=theme',
                'import_widget_file_url'     => $base_url . '&demo=furniture&type=widgets',
                'import_customizer_file_url' => $base_url . '&demo=furniture&type=customizer',
                'import_demo_cat'            => 'shop',
                'import_demo_name'           => 'furniture',
                'import_demo_img'            => self::generate_screenshot_url('2022/04/%D8%AF%DA%A9%D9%88%D8%B1%D8%A7%D8%B3%DB%8C%D9%88%D9%86-%D9%88-%D9%85%D8%A8%D9%84%D9%85%D8%A7%D9%86-%E2%80%93-%DB%8C%DA%A9-%D8%B3%D8%A7%DB%8C%D8%AA-%D9%85%DB%8C%D9%87%D9%86-%D9%85%D8%A7%D8%B1%DA%A9%D8%AA-%D8%AF%DB%8C%DA%AF%D8%B1.jpeg')
            ),
            array(
                'import_file_name'           => __('Kitchen','ahura'),
                'import_file_url'            => $base_url . '&demo=kitchen&type=theme',
                'import_widget_file_url'     => $base_url . '&demo=kitchen&type=widgets',
                'import_customizer_file_url' => $base_url . '&demo=kitchen&type=customizer',
                'import_demo_cat'            => 'shop',
                'import_demo_name'           => 'kitchen',
                'import_demo_img'            => self::generate_screenshot_url('2022/04/%D8%AE%D8%A7%D9%86%D9%87-%D9%88-%D8%A7%D9%93%D8%B4%D9%BE%D8%B2%D8%AE%D8%A7%D9%86%D9%87-%E2%80%93-%DB%8C%DA%A9-%D8%B3%D8%A7%DB%8C%D8%AA-%D9%85%DB%8C%D9%87%D9%86-%D9%85%D8%A7%D8%B1%DA%A9%D8%AA-%D8%AF%DB%8C%DA%AF%D8%B1-1.jpeg')
            ),
            array(
                'import_file_name'           => __('Dairy','ahura'),
                'import_file_url'            => $base_url . '&demo=dairy&type=theme',
                'import_widget_file_url'     => $base_url . '&demo=dairy&type=widgets',
                'import_customizer_file_url' => $base_url . '&demo=dairy&type=customizer',
                'import_demo_cat'            => 'shop',
                'import_demo_name'           => 'dairy',
                'import_demo_img'            => self::generate_screenshot_url('2022/04/%D9%81%D8%B1%D8%A7%D9%88%D8%B1%D8%AF%D9%87_%D9%87%D8%A7%DB%8C-%D9%84%D8%A8%D9%86%DB%8C-%E2%80%93-%DB%8C%DA%A9-%D8%B3%D8%A7%DB%8C%D8%AA-%D9%85%DB%8C%D9%87%D9%86-%D9%85%D8%A7%D8%B1%DA%A9%D8%AA-%D8%AF%DB%8C%DA%AF%D8%B1.jpeg')
            ),
            array(
                'import_file_name'           => __('Market','ahura'),
                'import_file_url'            => $base_url . '&demo=market&type=theme',
                'import_widget_file_url'     => $base_url . '&demo=market&type=widgets',
                'import_customizer_file_url' => $base_url . '&demo=market&type=customizer',
                'import_demo_cat'            => 'shop',
                'import_demo_name'           => 'market',
                'import_demo_img'            => self::generate_screenshot_url('2022/04/%D8%B3%D9%88%D9%BE%D8%B1-%D9%85%D8%A7%D8%B1%DA%A9%D8%AA-%E2%80%93-%DB%8C%DA%A9-%D8%B3%D8%A7%DB%8C%D8%AA-%D9%85%DB%8C%D9%87%D9%86-%D9%85%D8%A7%D8%B1%DA%A9%D8%AA-%D8%AF%DB%8C%DA%AF%D8%B1.jpeg')
            ),
            array(
                'import_file_name'           => __('Fastfood','ahura'),
                'import_file_url'            => $base_url . '&demo=fastfood&type=theme',
                'import_widget_file_url'     => $base_url . '&demo=fastfood&type=widgets',
                'import_customizer_file_url' => $base_url . '&demo=fastfood&type=customizer',
                'import_demo_cat'            => 'shop',
                'import_demo_name'           => 'fastfood',
                'import_demo_img'            => self::generate_screenshot_url('2022/04/%D9%81%D8%B3%D8%AA-%D9%81%D9%88%D8%AF-%E2%80%93-%DB%8C%DA%A9-%D8%B3%D8%A7%DB%8C%D8%AA-%D9%85%DB%8C%D9%87%D9%86-%D9%85%D8%A7%D8%B1%DA%A9%D8%AA-%D8%AF%DB%8C%DA%AF%D8%B1.jpeg')
            ),
            array(
                'import_file_name'           => __('Medical','ahura'),
                'import_file_url'            => $base_url . '&demo=medical&type=theme',
                'import_widget_file_url'     => $base_url . '&demo=medical&type=widgets',
                'import_customizer_file_url' => $base_url . '&demo=medical&type=customizer',
                'import_demo_cat'            => 'shop',
                'import_demo_name'           => 'medical',
                'import_demo_img'            => self::generate_screenshot_url('2022/04/%D9%BE%D8%B2%D8%B4%DA%A9%DB%8C-%E2%80%93-%DB%8C%DA%A9-%D8%B3%D8%A7%DB%8C%D8%AA-%D9%85%DB%8C%D9%87%D9%86-%D9%85%D8%A7%D8%B1%DA%A9%D8%AA-%D8%AF%DB%8C%DA%AF%D8%B1.jpeg')
            ),
            array(
                'import_file_name'           => __('Cooking','ahura'),
                'import_file_url'            => $base_url . '&demo=cooking&type=theme',
                'import_widget_file_url'     => $base_url . '&demo=cooking&type=widgets',
                'import_customizer_file_url' => $base_url . '&demo=cooking&type=customizer',
                'import_demo_cat'            => 'file',
                'import_demo_name'           => 'cooking',
                'import_demo_img'            => self::generate_screenshot_url('2022/04/%D8%A7%D9%87%D9%88%D8%B1%D8%A7-%D8%A7%D9%93%D8%B4%D9%BE%D8%B2-%E2%80%93-%DB%8C%DA%A9-%D8%B3%D8%A7%DB%8C%D8%AA-%D9%85%DB%8C%D9%87%D9%86-%D9%85%D8%A7%D8%B1%DA%A9%D8%AA-%D8%AF%DB%8C%DA%AF%D8%B1.jpeg')
            ),
            array(
                'import_file_name'           => __('Technology','ahura'),
                'import_file_url'            => $base_url . '&demo=tech&type=theme',
                'import_widget_file_url'     => $base_url . '&demo=tech&type=widgets',
                'import_customizer_file_url' => $base_url . '&demo=tech&type=customizer',
                'import_demo_cat'            => 'news',
                'import_demo_name'           => 'tech',
                'import_demo_img'            => self::generate_screenshot_url('2022/04/%D8%AA%DA%A9%D9%86%D9%88%D9%84%D9%88%DA%98%DB%8C-%E2%80%93-%DB%8C%DA%A9-%D8%B3%D8%A7%DB%8C%D8%AA-%D8%A7%D9%87%D9%88%D8%B1%D8%A7-%D8%AF%DB%8C%DA%AF%D8%B1.jpeg')
            ),
            array(
                'import_file_name'           => __('Electronic','ahura'),
                'import_file_url'            => $base_url . '&demo=electronic&type=theme',
                'import_widget_file_url'     => $base_url . '&demo=electronic&type=widgets',
                'import_customizer_file_url' => $base_url . '&demo=electronic&type=customizer',
                'import_demo_cat'            => 'shop',
                'import_demo_name'           => 'electronic',
                'import_demo_img'            => self::generate_screenshot_url('2022/04/%D9%81%D8%B1%D9%88%D8%B4%DA%AF%D8%A7%D9%87-%D9%84%D9%88%D8%A7%D8%B2%D9%85-%D8%A8%D8%B1%D9%82%DB%8C-%E2%80%93-%DB%8C%DA%A9-%D8%B3%D8%A7%DB%8C%D8%AA-%D9%85%DB%8C%D9%87%D9%86-%D9%85%D8%A7%D8%B1%DA%A9%D8%AA-%D8%AF%DB%8C%DA%AF%D8%B1.png')
            ),
            array(
                'import_file_name'           => __('Jewelry','ahura'),
                'import_file_url'            => $base_url . '&demo=jewelry&type=theme',
                'import_widget_file_url'     => $base_url . '&demo=jewelry&type=widgets',
                'import_customizer_file_url' => $base_url . '&demo=jewelry&type=customizer',
                'import_demo_cat'            => 'shop',
                'import_demo_name'           => 'jewelry',
                'import_demo_img'            => self::generate_screenshot_url('2022/04/%D8%B7%D9%84%D8%A7-%D9%88-%D8%AC%D9%88%D8%A7%D9%87%D8%B1-%E2%80%93-%DB%8C%DA%A9-%D8%B3%D8%A7%DB%8C%D8%AA-%D9%85%DB%8C%D9%87%D9%86-%D9%85%D8%A7%D8%B1%DA%A9%D8%AA-%D8%AF%DB%8C%DA%AF%D8%B1.jpeg')
            ),
            array(
                'import_file_name'           => __('Tools','ahura'),
                'import_file_url'            => $base_url . '&demo=tools&type=theme',
                'import_widget_file_url'     => $base_url . '&demo=tools&type=widgets',
                'import_customizer_file_url' => $base_url . '&demo=tools&type=customizer',
                'import_demo_cat'            => 'shop',
                'import_demo_name'           => 'tools',
                'import_demo_img'            => self::generate_screenshot_url('2022/04/%D9%81%D8%B1%D9%88%D8%B4%DA%AF%D8%A7%D9%87-%D8%A7%D8%A8%D8%B2%D8%A7%D8%B1-%D8%A2%D9%84%D8%A7%D8%AA-%E2%80%93-%DB%8C%DA%A9-%D8%B3%D8%A7%DB%8C%D8%AA-%D9%85%DB%8C%D9%87%D9%86-%D9%85%D8%A7%D8%B1%DA%A9%D8%AA-%D8%AF%DB%8C%DA%AF%D8%B1.jpeg')
            ),
            array(
                'import_file_name'           => __('Restaurant','ahura'),
                'import_file_url'            => $base_url . '&demo=resturant&type=theme',
                'import_widget_file_url'     => $base_url . '&demo=resturant&type=widgets',
                'import_customizer_file_url' => $base_url . '&demo=resturant&type=customizer',
                'import_demo_cat'            => 'shop',
                'import_demo_name'           => 'resturant',
                'import_demo_img'            => self::generate_screenshot_url('2022/04/%D8%B1%D8%B3%D8%AA%D9%88%D8%B1%D8%A7%D9%86-%E2%80%93-%DB%8C%DA%A9-%D8%B3%D8%A7%DB%8C%D8%AA-%D8%A7%D9%87%D9%88%D8%B1%D8%A7-%D8%AF%DB%8C%DA%AF%D8%B1.jpeg')
            ),
            array(
                'import_file_name'           => __('Education','ahura'),
                'import_file_url'            => $base_url . '&demo=edu&type=theme',
                'import_widget_file_url'     => $base_url . '&demo=edu&type=widgets',
                'import_customizer_file_url' => $base_url . '&demo=edu&type=customizer',
                'import_demo_cat'            => 'file',
                'import_demo_name'           => 'edu',
                'import_demo_img'            => self::generate_screenshot_url('2021/10/ahura-edu.png')
            ),
            array(
                'import_file_name'           => __('Hotel','ahura'),
                'import_file_url'            => $base_url . '&demo=hotel&type=theme',
                'import_widget_file_url'     => $base_url . '&demo=hotel&type=widgets',
                'import_customizer_file_url' => $base_url . '&demo=hotel&type=customizer',
                'import_demo_cat'            => 'services',
                'import_demo_name'           => 'hotel',
                'import_demo_img'            => self::generate_screenshot_url('2022/04/%D9%87%D8%AA%D9%84-%E2%80%93-%DB%8C%DA%A9-%D8%B3%D8%A7%DB%8C%D8%AA-%D8%A7%D9%87%D9%88%D8%B1%D8%A7-%D8%AF%DB%8C%DA%AF%D8%B1.jpeg')
            ),
            array(
                'import_file_name'           => __('Crypto','ahura'),
                'import_file_url'            => $base_url . '&demo=crypto&type=theme',
                'import_widget_file_url'     => $base_url . '&demo=crypto&type=widgets',
                'import_customizer_file_url' => $base_url . '&demo=crypto&type=customizer',
                'import_demo_cat'            => 'services',
                'import_demo_name'           => 'crypto',
                'import_demo_img'            => self::generate_screenshot_url('2022/04/%D8%A7%D9%87%D9%88%D8%B1%D8%A7-%DA%A9%D8%B1%DB%8C%D9%BE%D8%AA%D9%88-%E2%80%93-%DB%8C%DA%A9-%D8%B3%D8%A7%DB%8C%D8%AA-%D8%A7%D9%87%D9%88%D8%B1%D8%A7-%D8%AF%DB%8C%DA%AF%D8%B1.jpeg')
            ),
            array(
                'import_file_name'           => __('Sport','ahura'),
                'import_file_url'            => $base_url . '&demo=sport&type=theme',
                'import_widget_file_url'     => $base_url . '&demo=sport&type=widgets',
                'import_customizer_file_url' => $base_url . '&demo=sport&type=customizer',
                'import_demo_cat'            => 'services',
                'import_demo_name'           => 'sport',
                'import_demo_img'            => self::generate_screenshot_url('2022/03/sport.jpeg')
            ),
            array(
                'import_file_name'           => __('Security','ahura'),
                'import_file_url'            => $base_url . '&demo=security&type=theme',
                'import_widget_file_url'     => $base_url . '&demo=security&type=widgets',
                'import_customizer_file_url' => $base_url . '&demo=security&type=customizer',
                'import_demo_cat'            => 'services',
                'import_demo_name'           => 'security',
                'import_demo_img'            => self::generate_screenshot_url('2022/03/security.jpeg')
            ),
            array(
                'import_file_name'           => __('Education 2','ahura'),
                'import_file_url'            => $base_url . '&demo=edu2&type=theme',
                'import_widget_file_url'     => $base_url . '&demo=edu2&type=widgets',
                'import_customizer_file_url' => $base_url . '&demo=edu2&type=customizer',
                'import_demo_cat'            => 'file',
                'import_demo_name'           => 'education',
                'import_demo_id'             => 'edu2',
                'import_demo_img'            => self::generate_screenshot_url('2022/03/edu2.jpeg')
            ),
            array(
                'import_file_name'           => __('File Shop','ahura'),
                'import_file_url'            => $base_url . '&demo=goods&type=theme',
                'import_widget_file_url'     => $base_url . '&demo=goods&type=widgets',
                'import_customizer_file_url' => $base_url . '&demo=goods&type=customizer',
                'import_demo_cat'            => 'file',
                'import_demo_name'           => 'goods',
                'import_demo_img'            => self::generate_screenshot_url('2022/03/goods.jpeg')
            ),
            array(
                'import_file_name'           => __('Lawyer','ahura'),
                'import_file_url'            => $base_url . '&demo=lawyer&type=theme',
                'import_widget_file_url'     => $base_url . '&demo=lawyer&type=widgets',
                'import_customizer_file_url' => $base_url . '&demo=lawyer&type=customizer',
                'import_demo_cat'            => 'services',
                'import_demo_name'           => 'lawyer',
                'import_demo_img'            => self::generate_screenshot_url('2022/03/lawyer.jpeg')
            ),
            array(
                'import_file_name'           => __('Doctor','ahura'),
                'import_file_url'            => $base_url . '&demo=doctor&type=theme',
                'import_widget_file_url'     => $base_url . '&demo=doctor&type=widgets',
                'import_customizer_file_url' => $base_url . '&demo=doctor&type=customizer',
                'import_demo_cat'            => 'services',
                'import_demo_name'           => 'doctor',
                'import_demo_img'            => self::generate_screenshot_url('2022/03/doctor.jpeg')
            ),
            array(
                'import_file_name'           => __('Product','ahura'),
                'import_file_url'            => $base_url . '&demo=product&type=theme',
                'import_widget_file_url'     => $base_url . '&demo=product&type=widgets',
                'import_customizer_file_url' => $base_url . '&demo=product&type=customizer',
                'import_demo_cat'            => 'services',
                'import_demo_name'           => 'product',
                'import_demo_img'            => self::generate_screenshot_url('2022/03/product.jpeg')
            ),
            array(
                'import_file_name'           => __('SEO','ahura'),
                'import_file_url'            => $base_url . '&demo=seo&type=theme',
                'import_widget_file_url'     => $base_url . '&demo=seo&type=widgets',
                'import_customizer_file_url' => $base_url . '&demo=seo&type=customizer',
                'import_demo_cat'            => 'services',
                'import_demo_name'           => 'seo',
                'import_demo_img'            => self::generate_screenshot_url('2022/03/seo.jpeg')
            ),
            array(
                'import_file_name'           => __('Yoga','ahura'),
                'import_file_url'            => $base_url . '&demo=yoga&type=theme',
                'import_widget_file_url'     => $base_url . '&demo=yoga&type=widgets',
                'import_customizer_file_url' => $base_url . '&demo=yoga&type=customizer',
                'import_demo_cat'            => 'services',
                'import_demo_name'           => 'yoga',
                'import_demo_img'            => self::generate_screenshot_url('2022/05/%D8%A7%D9%87%D9%88%D8%B1%D8%A7-%DB%8C%D9%88%DA%AF%D8%A7-%E2%80%93-%DB%8C%DA%A9-%D8%B3%D8%A7%DB%8C%D8%AA-%D8%A7%D9%87%D9%88%D8%B1%D8%A7-%D8%AF%DB%8C%DA%AF%D8%B1-1.jpeg')
            ),
            array(
                'import_file_name'           => __('PhotoGraphy','ahura'),
                'import_file_url'            => $base_url . '&demo=photography&type=theme',
                'import_widget_file_url'     => $base_url . '&demo=photography&type=widgets',
                'import_customizer_file_url' => $base_url . '&demo=photography&type=customizer',
                'import_demo_cat'            => 'services',
                'import_demo_name'           => 'photography',
                'import_demo_img'            => self::generate_screenshot_url('2022/06/Photography-%E2%80%93-%DB%8C%DA%A9-%D8%B3%D8%A7%DB%8C%D8%AA-%D8%A7%D9%87%D9%88%D8%B1%D8%A7-%D8%AF%DB%8C%DA%AF%D8%B1.jpeg')
            ),
            array(
                'import_file_name'           => __('Carpet','ahura'),
                'import_file_url'            => $base_url . '&demo=carpet&type=theme',
                'import_widget_file_url'     => $base_url . '&demo=carpet&type=widgets',
                'import_customizer_file_url' => $base_url . '&demo=carpet&type=customizer',
                'import_demo_cat'            => 'shop',
                'import_demo_name'           => 'carpet',
                'import_demo_img'            => self::generate_screenshot_url('2022/06/%D9%81%D8%B1%D9%88%D8%B4%DA%AF%D8%A7%D9%87-%D9%81%D8%B1%D8%B4-%E2%80%93-%DB%8C%DA%A9-%D8%B3%D8%A7%DB%8C%D8%AA-%D8%A7%D9%87%D9%88%D8%B1%D8%A7-%D8%AF%DB%8C%DA%AF%D8%B1.jpeg')
            ),
            array(
                'import_file_name'           => __('Books','ahura'),
                'import_file_url'            => $base_url . '&demo=books&type=theme',
                'import_widget_file_url'     => $base_url . '&demo=books&type=widgets',
                'import_customizer_file_url' => $base_url . '&demo=books&type=customizer',
                'import_demo_cat'            => 'shop',
                'import_demo_name'           => 'books',
                'import_demo_img'            => self::generate_screenshot_url('2022/06/%D9%81%D8%B1%D9%88%D8%B4%DA%AF%D8%A7%D9%87-%DA%A9%D8%AA%D8%A7%D8%A8-%E2%80%93-%DB%8C%DA%A9-%D8%B3%D8%A7%DB%8C%D8%AA-%D8%A7%D9%87%D9%88%D8%B1%D8%A7-%D8%AF%DB%8C%DA%AF%D8%B1.jpeg')
            ),
            array(
                'import_file_name'           => __('Game','ahura'),
                'import_file_url'            => $base_url . '&demo=game&type=theme',
                'import_widget_file_url'     => $base_url . '&demo=game&type=widgets',
                'import_customizer_file_url' => $base_url . '&demo=game&type=customizer',
                'import_demo_cat'            => 'services',
                'import_demo_name'           => 'game',
                'import_demo_img'            => self::generate_screenshot_url('2022/06/%D8%A8%D8%A7%D8%B2%DB%8C-%DA%A9%D8%A7%D9%85%D9%BE%DB%8C%D9%88%D8%AA%D8%B1%DB%8C-%E2%80%93-%DB%8C%DA%A9-%D8%B3%D8%A7%DB%8C%D8%AA-%D8%A7%D9%87%D9%88%D8%B1%D8%A7-%D8%AF%DB%8C%DA%AF%D8%B1.jpeg')
            ),
            array(
                'import_file_name'           => __('Application','ahura'),
                'import_file_url'            => $base_url . '&demo=app&type=theme',
                'import_widget_file_url'     => $base_url . '&demo=app&type=widgets',
                'import_customizer_file_url' => $base_url . '&demo=app&type=customizer',
                'import_demo_cat'            => 'services',
                'import_demo_name'           => 'app',
                'import_demo_img'            => self::generate_screenshot_url('2022/06/%D9%85%D8%B9%D8%B1%D9%81%DB%8C-%D8%A7%D9%BE%D9%84%DB%8C%DA%A9%DB%8C%D8%B4%D9%86-%E2%80%93-%DB%8C%DA%A9-%D8%B3%D8%A7%DB%8C%D8%AA-%D8%A7%D9%87%D9%88%D8%B1%D8%A7-%D8%AF%DB%8C%DA%AF%D8%B1.jpeg')
            ),
            array(
                'import_file_name'           => __('Sleep products','ahura'),
                'import_file_url'            => $base_url . '&demo=sleep&type=theme',
                'import_widget_file_url'     => $base_url . '&demo=sleep&type=widgets',
                'import_customizer_file_url' => $base_url . '&demo=sleep&type=customizer',
                'import_demo_cat'            => 'shop',
                'import_demo_name'           => 'sleep',
                'import_demo_img'            => self::generate_screenshot_url('2022/06/%DA%A9%D8%A7%D9%84%D8%A7%DB%8C-%D8%AE%D9%88%D8%A7%D8%A8-%E2%80%93-%DB%8C%DA%A9-%D8%B3%D8%A7%DB%8C%D8%AA-%D8%A7%D9%87%D9%88%D8%B1%D8%A7-%D8%AF%DB%8C%DA%AF%D8%B1.jpeg')
            ),
            array(
                'import_file_name'           => __('Pets Shop','ahura'),
                'import_file_url'            => $base_url . '&demo=pets&type=theme',
                'import_widget_file_url'     => $base_url . '&demo=pets&type=widgets',
                'import_customizer_file_url' => $base_url . '&demo=pets&type=customizer',
                'import_demo_cat'            => 'shop',
                'import_demo_name'           => 'pets',
                'import_demo_img'            => self::generate_screenshot_url('2022/06/%D8%AD%DB%8C%D9%88%D8%A7%D9%86%D8%A7%D8%AA-%D8%AE%D8%A7%D9%86%DA%AF%DB%8C-%E2%80%93-%DB%8C%DA%A9-%D8%B3%D8%A7%DB%8C%D8%AA-%D8%A7%D9%87%D9%88%D8%B1%D8%A7-%D8%AF%DB%8C%DA%AF%D8%B1.jpeg')
            ),
            array(
                'import_file_name'           => __('Nike','ahura'),
                'import_file_url'            => $base_url . '&demo=nike&type=theme',
                'import_widget_file_url'     => $base_url . '&demo=nike&type=widgets',
                'import_customizer_file_url' => $base_url . '&demo=nike&type=customizer',
                'import_demo_cat'            => 'shop',
                'import_demo_name'           => 'nike',
                'import_demo_img'            => self::generate_screenshot_url('2022/06/%D9%86%D8%A7%DB%8C%DA%A9-%E2%80%93-%DB%8C%DA%A9-%D8%B3%D8%A7%DB%8C%D8%AA-%D8%A7%D9%87%D9%88%D8%B1%D8%A7-%D8%AF%DB%8C%DA%AF%D8%B1.jpeg')
            ),
            array(
                'import_file_name'           => __('Car Rent','ahura'),
                'import_file_url'            => $base_url . '&demo=rent&type=theme',
                'import_widget_file_url'     => $base_url . '&demo=rent&type=widgets',
                'import_customizer_file_url' => $base_url . '&demo=rent&type=customizer',
                'import_demo_cat'            => 'services',
                'import_demo_name'           => 'rent',
                'import_demo_img'            => self::generate_screenshot_url('2022/06/%D8%A7%D9%87%D9%88%D8%B1%D8%A7-%DA%A9%D8%B1%D8%A7%DB%8C%D9%87-%E2%80%93-%DB%8C%DA%A9-%D8%B3%D8%A7%DB%8C%D8%AA-%D8%A7%D9%87%D9%88%D8%B1%D8%A7-%D8%AF%DB%8C%DA%AF%D8%B1.jpeg')
            ),
            array(
                'import_file_name'           => __('Logistic','ahura'),
                'import_file_url'            => $base_url . '&demo=logistic&type=theme',
                'import_widget_file_url'     => $base_url . '&demo=logistic&type=widgets',
                'import_customizer_file_url' => $base_url . '&demo=logistic&type=customizer',
                'import_demo_cat'            => 'services',
                'import_demo_name'           => 'logistic',
                'import_demo_img'            => self::generate_screenshot_url('2022/06/%D8%AD%D9%85%D9%84-%D9%88-%D9%86%D9%82%D9%84-%D8%A7%D9%87%D9%88%D8%B1%D8%A7-%E2%80%93-%DB%8C%DA%A9-%D8%B3%D8%A7%DB%8C%D8%AA-%D8%A7%D9%87%D9%88%D8%B1%D8%A7-%D8%AF%DB%8C%DA%AF%D8%B1.jpeg')
            ),
            array(
                'import_file_name'           => __('Jobs','ahura'),
                'import_file_url'            => $base_url . '&demo=jobs&type=theme',
                'import_widget_file_url'     => $base_url . '&demo=jobs&type=widgets',
                'import_customizer_file_url' => $base_url . '&demo=jobs&type=customizer',
                'import_demo_cat'            => 'services',
                'import_demo_name'           => 'jobs',
                'import_demo_img'            => self::generate_screenshot_url('2022/06/%D8%A7%D9%87%D9%88%D8%B1%D8%A7-%D8%AC%D8%A7%D8%A8%D8%B2-%E2%80%93-%DB%8C%DA%A9-%D8%B3%D8%A7%DB%8C%D8%AA-%D8%A7%D9%87%D9%88%D8%B1%D8%A7-%D8%AF%DB%8C%DA%AF%D8%B1.jpeg')
            ),
            array(
                'import_file_name'           => __('Real Estate','ahura'),
                'import_file_url'            => $base_url . '&demo=realestate&type=theme',
                'import_widget_file_url'     => $base_url . '&demo=realestate&type=widgets',
                'import_customizer_file_url' => $base_url . '&demo=realestate&type=customizer',
                'import_demo_cat'            => 'services',
                'import_demo_name'           => 'realestate',
                'import_demo_img'            => self::generate_screenshot_url('2022/06/%D8%A7%D9%85%D9%84%D8%A7%DA%A9-%D8%A7%D9%87%D9%88%D8%B1%D8%A7-%E2%80%93-%DB%8C%DA%A9-%D8%B3%D8%A7%DB%8C%D8%AA-%D8%A7%D9%87%D9%88%D8%B1%D8%A7-%D8%AF%DB%8C%DA%AF%D8%B1.jpeg'),
            ),
            array(
                'import_file_name'           => __('Hosting','ahura'),
                'import_file_url'            => $base_url . '&demo=hosting&type=theme',
                'import_widget_file_url'     => $base_url . '&demo=hosting&type=widgets',
                'import_customizer_file_url' => $base_url . '&demo=hosting&type=customizer',
                'import_demo_cat'            => 'services',
                'import_demo_name'           => 'hosting',
                'import_demo_img'            => self::generate_screenshot_url('2022/06/%D8%A7%D9%87%D9%88%D8%B1%D8%A7-%D9%87%D8%A7%D8%B3%D8%AA-%E2%80%93-%DB%8C%DA%A9-%D8%B3%D8%A7%DB%8C%D8%AA-%D8%A7%D9%87%D9%88%D8%B1%D8%A7-%D8%AF%DB%8C%DA%AF%D8%B1.jpeg'),
            ),
            array(
                'import_file_name'           => __('Content Services','ahura'),
                'import_file_url'            => $base_url . '&demo=content&type=theme',
                'import_widget_file_url'     => $base_url . '&demo=content&type=widgets',
                'import_customizer_file_url' => $base_url . '&demo=content&type=customizer',
                'import_demo_cat'            => 'services',
                'import_demo_name'           => 'content',
                'import_demo_img'            => self::generate_screenshot_url('2022/06/%D8%A7%D9%87%D9%88%D8%B1%D8%A7-%D9%85%D8%AD%D8%AA%D9%88%D8%A7-%E2%80%93-%DB%8C%DA%A9-%D8%B3%D8%A7%DB%8C%D8%AA-%D8%A7%D9%87%D9%88%D8%B1%D8%A7-%D8%AF%DB%8C%DA%AF%D8%B1.jpeg')
            ),
            array(
                'import_file_name'           => __('Accessories','ahura'),
                'import_file_url'            => $base_url . '&demo=accessories&type=theme',
                'import_widget_file_url'     => $base_url . '&demo=accessories&type=widgets',
                'import_customizer_file_url' => $base_url . '&demo=accessories&type=customizer',
                'import_demo_cat'            => 'shop',
                'import_demo_name'           => 'accessories',
                'import_demo_img'            => self::generate_screenshot_url('2022/07/%D9%84%D9%88%D8%A7%D8%B2%D9%85-%D8%AC%D8%A7%D9%86%D8%A8%DB%8C-%D9%85%D9%88%D8%A8%D8%A7%DB%8C%D9%84-%E2%80%93-%DB%8C%DA%A9-%D8%B3%D8%A7%DB%8C%D8%AA-%D8%A7%D9%87%D9%88%D8%B1%D8%A7-%D8%AF%DB%8C%DA%AF%D8%B1.jpeg')
            ),
            array(
                'import_file_name'           => __('Bicycle','ahura'),
                'import_file_url'            => $base_url . '&demo=bicycle&type=theme',
                'import_widget_file_url'     => $base_url . '&demo=bicycle&type=widgets',
                'import_customizer_file_url' => $base_url . '&demo=bicycle&type=customizer',
                'import_demo_cat'            => 'shop',
                'import_demo_name'           => 'bicycle',
                'import_demo_img'            => self::generate_screenshot_url('2022/07/%D9%81%D8%B1%D9%88%D8%B4%DA%AF%D8%A7%D9%87-%D8%AF%D9%88%DA%86%D8%B1%D8%AE%D9%87-%E2%80%93-%DB%8C%DA%A9-%D8%B3%D8%A7%DB%8C%D8%AA-%D8%A7%D9%87%D9%88%D8%B1%D8%A7-%D8%AF%DB%8C%DA%AF%D8%B1.jpeg')
            ),
            array(
                'import_file_name'           => __('Finance','ahura'),
                'import_file_url'            => $base_url . '&demo=finance&type=theme',
                'import_widget_file_url'     => $base_url . '&demo=finance&type=widgets',
                'import_customizer_file_url' => $base_url . '&demo=finance&type=customizer',
                'import_demo_cat'            => 'services',
                'import_demo_name'           => 'finance',
                'import_demo_img'            => self::generate_screenshot_url('2022/07/%D8%AE%D8%AF%D9%85%D8%A7%D8%AA-%D9%85%D8%A7%D9%84%DB%8C-%E2%80%93-%DB%8C%DA%A9-%D8%B3%D8%A7%DB%8C%D8%AA-%D8%A7%D9%87%D9%88%D8%B1%D8%A7-%D8%AF%DB%8C%DA%AF%D8%B1.jpeg')
            ),
            array(
                'import_file_name'           => __('Flowers','ahura'),
                'import_file_url'            => $base_url . '&demo=flowers&type=theme',
                'import_widget_file_url'     => $base_url . '&demo=flowers&type=widgets',
                'import_customizer_file_url' => $base_url . '&demo=flowers&type=customizer',
                'import_demo_cat'            => 'shop',
                'import_demo_name'           => 'flowers',
                'import_demo_img'            => self::generate_screenshot_url('2022/07/%D9%81%D8%B1%D9%88%D8%B4-%DA%AF%D9%84-%D9%88-%DA%AF%DB%8C%D8%A7%D9%87-%E2%80%93-%DB%8C%DA%A9-%D8%B3%D8%A7%DB%8C%D8%AA-%D8%A7%D9%87%D9%88%D8%B1%D8%A7-%D8%AF%DB%8C%DA%AF%D8%B1.jpeg')
            ),
            array(
                'import_file_name'           => __('Lab','ahura'),
                'import_file_url'            => $base_url . '&demo=lab&type=theme',
                'import_widget_file_url'     => $base_url . '&demo=lab&type=widgets',
                'import_customizer_file_url' => $base_url . '&demo=lab&type=customizer',
                'import_demo_cat'            => 'services',
                'import_demo_name'           => 'lab',
                'import_demo_img'            => self::generate_screenshot_url('2022/07/%D8%A2%D8%B2%D9%85%D8%A7%DB%8C%D8%B4%DA%AF%D8%A7%D9%87-%D8%AE%D8%B5%D9%88%D8%B5%DB%8C-%E2%80%93-%DB%8C%DA%A9-%D8%B3%D8%A7%DB%8C%D8%AA-%D8%A7%D9%87%D9%88%D8%B1%D8%A7-%D8%AF%DB%8C%DA%AF%D8%B1.jpeg')
            ),
            array(
                'import_file_name'           => __('Follower','ahura'),
                'import_file_url'            => $base_url . '&demo=follower&type=theme',
                'import_widget_file_url'     => $base_url . '&demo=follower&type=widgets',
                'import_customizer_file_url' => $base_url . '&demo=follower&type=customizer',
                'import_demo_cat'            => 'services',
                'import_demo_name'           => 'follower',
                'import_demo_img'            => self::generate_screenshot_url('2022/07/%D9%81%D8%B1%D9%88%D8%B4-%D9%81%D8%A7%D9%84%D9%88%D9%88%D8%B1-%D8%A7%DB%8C%D9%86%D8%B3%D8%AA%D8%A7%DA%AF%D8%B1%D8%A7%D9%85-%E2%80%93-%DB%8C%DA%A9-%D8%B3%D8%A7%DB%8C%D8%AA-%D8%A7%D9%87%D9%88%D8%B1%D8%A7-%D8%AF%DB%8C%DA%AF%D8%B1.jpeg')
            ),
            array(
                'import_file_name'           => __('Musical','ahura'),
                'import_file_url'            => $base_url . '&demo=musical&type=theme',
                'import_widget_file_url'     => $base_url . '&demo=musical&type=widgets',
                'import_customizer_file_url' => $base_url . '&demo=musical&type=customizer',
                'import_demo_cat'            => 'shop',
                'import_demo_name'           => 'musical',
                'import_demo_img'            => self::generate_screenshot_url('2022/07/%D9%81%D8%B1%D9%88%D8%B4%DA%AF%D8%A7%D9%87-%D8%A7%D8%A8%D8%B2%D8%A7%D8%B1-%D9%85%D9%88%D8%B3%DB%8C%D9%82%DB%8C-%E2%80%93-%DB%8C%DA%A9-%D8%B3%D8%A7%DB%8C%D8%AA-%D8%A7%D9%87%D9%88%D8%B1%D8%A7-%D8%AF%DB%8C%DA%AF%D8%B1.jpeg')
            ),
            array(
                'import_file_name'           => __('Post','ahura'),
                'import_file_url'            => $base_url . '&demo=post&type=theme',
                'import_widget_file_url'     => $base_url . '&demo=post&type=widgets',
                'import_customizer_file_url' => $base_url . '&demo=post&type=customizer',
                'import_demo_cat'            => 'services',
                'import_demo_name'           => 'post',
                'import_demo_img'            => self::generate_screenshot_url('2022/07/%D8%AE%D8%AF%D9%85%D8%A7%D8%AA-%D9%BE%D8%B3%D8%AA%DB%8C-%E2%80%93-%DB%8C%DA%A9-%D8%B3%D8%A7%DB%8C%D8%AA-%D8%A7%D9%87%D9%88%D8%B1%D8%A7-%D8%AF%DB%8C%DA%AF%D8%B1.jpeg')
            ),
            array(
                'import_file_name'           => _x('Telegram', 'Demo importer','ahura'),
                'import_file_url'            => $base_url . '&demo=telegram&type=theme',
                'import_widget_file_url'     => $base_url . '&demo=telegram&type=widgets',
                'import_customizer_file_url' => $base_url . '&demo=telegram&type=customizer',
                'import_demo_cat'            => 'services',
                'import_demo_name'           => 'telegram',
                'import_demo_img'            => self::generate_screenshot_url('2022/07/%D8%AE%D8%AF%D9%85%D8%A7%D8%AA-%D8%AA%D9%84%DA%AF%D8%B1%D8%A7%D9%85-%E2%80%93-%DB%8C%DA%A9-%D8%B3%D8%A7%DB%8C%D8%AA-%D8%A7%D9%87%D9%88%D8%B1%D8%A7-%D8%AF%DB%8C%DA%AF%D8%B1.jpeg')
            ),
            array(
                'import_file_name'           => __('Tour','ahura'),
                'import_file_url'            => $base_url . '&demo=tour&type=theme',
                'import_widget_file_url'     => $base_url . '&demo=tour&type=widgets',
                'import_customizer_file_url' => $base_url . '&demo=tour&type=customizer',
                'import_demo_cat'            => 'services',
                'import_demo_name'           => 'tour',
                'import_demo_img'            => self::generate_screenshot_url('2022/07/%D8%AA%D9%88%D8%B1-%DA%AF%D8%B1%D8%AF%D8%B4%DA%AF%D8%B1%DB%8C-%E2%80%93-%DB%8C%DA%A9-%D8%B3%D8%A7%DB%8C%D8%AA-%D8%A7%D9%87%D9%88%D8%B1%D8%A7-%D8%AF%DB%8C%DA%AF%D8%B1.jpeg')
            ),
            array(
                'import_file_name'           => __('Watch','ahura'),
                'import_file_url'            => $base_url . '&demo=watch&type=theme',
                'import_widget_file_url'     => $base_url . '&demo=watch&type=widgets',
                'import_customizer_file_url' => $base_url . '&demo=watch&type=customizer',
                'import_demo_cat'            => 'shop',
                'import_demo_name'           => 'watch',
                'import_demo_img'            => self::generate_screenshot_url('2022/07/%D9%81%D8%B1%D9%88%D8%B4%DA%AF%D8%A7%D9%87-%D8%B3%D8%A7%D8%B9%D8%AA-%E2%80%93-%DB%8C%DA%A9-%D8%B3%D8%A7%DB%8C%D8%AA-%D8%A7%D9%87%D9%88%D8%B1%D8%A7-%D8%AF%DB%8C%DA%AF%D8%B1.jpeg')
            ),
            array(
                'import_file_name'           => __('EN - Web Design','ahura'),
                'import_file_url'            => $base_url . '&demo=en&type=theme',
                'import_widget_file_url'     => $base_url . '&demo=en&type=widgets',
                'import_customizer_file_url' => $base_url . '&demo=en&type=customizer',
                'import_demo_cat'            => 'services',
                'import_demo_name'           => 'en',
                'import_demo_img'            => self::generate_screenshot_url('2022/03/English-Demo-%E2%80%93-Ahura-Theme.png')
            ),
            array(
                'import_file_name'           => __('DigiKala','ahura'),
                'import_file_url'            => $base_url . '&demo=digikala&type=theme',
                'import_widget_file_url'     => $base_url . '&demo=digikala&type=widgets',
                'import_customizer_file_url' => $base_url . '&demo=digikala&type=customizer',
                'import_demo_cat'            => 'shop',
                'import_demo_name'           => 'digikala',
                'import_demo_img'            => self::generate_screenshot_url('2023/06/digikala.jpg')
            ),
            array(
                'import_file_name'           => __('Digital Marketing','ahura'),
                'import_file_url'            => $base_url . '&demo=digitalmarketing&type=theme',
                'import_widget_file_url'     => $base_url . '&demo=digitalmarketing&type=widgets',
                'import_customizer_file_url' => $base_url . '&demo=digitalmarketing&type=customizer',
                'import_demo_cat'            => 'services',
                'import_demo_name'           => 'digitalmarketing',
                'import_demo_img'            => self::generate_screenshot_url('2023/08/digitalmarketing.webp')
            )
        );

        $demos = apply_filters('ahura_studio_get_demo_list', $demos);

        return $demos;
    }

    public static function get_demo_options(){
        $options = array(
            'options' => __('Options', 'ahura'),
            'widgets' => __('Widgets', 'ahura'),
			'media' => __('Media', 'ahura'),
            'content' => __('Content', 'ahura'),
            'after_import' => __('After Import', 'ahura'),
        );
        $options = apply_filters('ahura_studio_get_demo_options', $options);
        return $options;
    }

    public function set_demo_id($demo_id = 0){
        $this->demo_id = $demo_id;
        return $this;
    }

    public function get_demo_id(){
        return $this->demo_id;
    }

    /**
     *
     * Get demo content from api
     *
     * @return boolean|array|object
     */
    public function get_demo_from_api(){
        $demos = self::get_demo_list();

        $demo_id = $this->get_demo_id();

        $demo_name = isset($demos[$demo_id]) ? $demos[$demo_id]['import_demo_name'] : false;

        if (!$demo_name)
            return false;

        $base_url = self::get_base_url();
        $license_key = license::get_license_key();

        if (empty($demo_name) || empty($license_key))
            return false;

        $base_url = $base_url . 'api/v2/' . $license_key . '/demo/get/?product_id=' . MW_AHURA_UPDATER_ITEM_ID;
        $demo_url = $base_url . "&demo={$demo_name}";
        $args = ['timeout' => 60, 'sslverify' => true];
        $remote = wp_remote_get($demo_url, $args);
        $json = !is_wp_error($remote) && wp_remote_retrieve_response_code($remote) === 200 ? wp_remote_retrieve_body($remote) : false;
        return !is_wp_error($json) && ahura_is_json($json) ? $json : false;
    }

    /**
     *
     * Get demo content path
     *
     * @return string
     */
    public function get_demo_path(){
        $path = wp_upload_dir();
        $dir = $path['basedir'] . '/ahura-import-demo/';
        if(!is_dir($dir)){
            mkdir($dir, 0755, true);
        }
        return $dir;
    }

    /**
     *
     * Get demo file path
     *
     * @return string
     */
    public function get_demo_file_path($ext = 'json'){
        return $this->get_demo_path() . $this->demo_name . '.' . $ext;
    }

    /**
     *
     * Get demo content
     *
     * @return false|mixed
     */
    public function get_demo_content(){
        $file = $this->get_demo_file_path();
        $content = file_exists($file) && is_readable($file) ? file_get_contents($file) : false;
        return $content && ahura_is_json($content) ? json_decode($content, true) : false;
    }

    /**
     *
     * Get demo content from api and save to server
     *
     * @return void
     */
    public function generate_demo_file(){
        $this->remove_demo_file();
        $json = $this->get_demo_from_api();
        if($json){
            $data = json_decode($json, true);

            $network_url = $data['extra']['network_url'];
            $home_url = $data['extra']['home_url'];
            $site_upload_url = isset($data['extra']['site_upload_url']) ? $data['extra']['site_upload_url'] : '';
            $upload_url = $data['extra']['upload_url'];

            $data = $this->replace_urls_recursive($data, [
                'site_upload_url' => $site_upload_url,
                'upload_url' => $upload_url,
                'home_url' => $home_url,
                'network_url' => $network_url,
            ]);

            $json = json_encode($data);

            do_action('ahura_before_generate_demo_import_file', $json);
            file_put_contents($this->get_demo_file_path(), $json);
        }
    }

    /**
     * @param $data
     * @param $urls
     * @return mixed
     */
    function replace_urls_recursive($data, $urls) {
        foreach ($data as $key => $value) {
            if ($key === 'guid')
                continue;

            $json = is_string($value) ? json_decode($value, true, 512, JSON_BIGINT_AS_STRING) : false;
            $value = $json !== null && $json != false ? $json : $value;
            if (is_array($value)) {
                $data[$key] = $this->replace_urls_recursive($value, $urls);
            } elseif (is_string($value)) {
                $upload = wp_upload_dir();
                if (isset($urls['site_upload_url']) && !empty($urls['site_upload_url'])){
                    $value = str_replace($urls['site_upload_url'], $upload['baseurl'], $value);
                }
                $value = str_replace($urls['upload_url'], $upload['baseurl'], $value);
                $value = str_replace($urls['home_url'], get_home_url(), $value);
                $value = str_replace($urls['network_url'], site_url('/'), $value);
                $data[$key] = $value;
            }
        }
        return $data;
    }

    /**
     *
     * Remove demo content file
     *
     * @return void
     */
    public function remove_demo_file(){
        $path = $this->get_demo_file_path();
        if(file_exists($path)){
            unlink($path);
        }
    }
}
