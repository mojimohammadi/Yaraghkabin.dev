<?php
namespace ahura\app;
class mw_partials
{
    static function load_header()
    {
        $header_slug = 'main';
        get_template_part('partials/header', $header_slug);
    }
}