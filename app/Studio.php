<?php
namespace ahura\app;

class Studio {
    /**
     * Demo Studio page filter tabs
     *
     * @return array
     */
    public static function get_filter_tabs(){
        $tabs = array(
            'services' => __('Services', 'ahura'),
            'shop' => __('Shop', 'ahura'),
            'file' => __('File', 'ahura'),
            'news' => __('News', 'ahura'),
        );
        $tabs = apply_filters('ahura_studio_get_filter_tabs', $tabs);
        return $tabs;
    }

    /**
     * 
     * Get demo api base url
     * 
     * @return string|boolean
     */
    public static function get_base_url(){
        $license_key = license::get_license_key();
        return mw_tools::getRemoteServerByLicenseKey($license_key);
    }

    /**
     *
     * Check is studio page
     *
     * @return boolean
     */
    public static function is_studio(){
        return (isset($_GET['page']) && in_array($_GET['page'], ['studio', 'ahura_studio']));
    }
}