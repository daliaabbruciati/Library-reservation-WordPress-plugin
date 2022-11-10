<?php

namespace Plugin\Enqueue;

class Enqueue
{

    function __construct(){
        add_action('admin_enqueue_scripts', [$this,'enqueue']);
    }

    public function enqueue(): void
    {
        // register the files
        wp_register_style('mypluginstyle', plugins_url('../admin/css/style.css', __DIR__));
//        wp_register_script('mypluginscript', plugins_url('../admin/js/script.js', __DIR__));
        //enqueue all our scripts
        wp_enqueue_style('mypluginstyle');
//        wp_enqueue_script('mypluginscript');
    }

}
