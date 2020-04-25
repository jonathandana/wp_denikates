<?php
/*
Plugin Name: Woo JD Functions
Description:Custom functions by<span style="color:red"> woocommerce plugins is required </span>.
Plugin URI:
Version: 1.0.0
Author: Jonathan Dana
*/

if(!defined('WOO_JD')) {
    define('WOO_JD_BASE', plugins_url('', __FILE__));
    define('WOO_JD_DIR', dirname(__FILE__));
    define('WOO_JD_VERSION','3.1.1');

    spl_autoload_register( function($class) {
        $filename = WOO_JD_DIR . "/cls/{$class}.php";
        if(file_exists($filename)) {
            require_once($filename);
        }
    });



    add_action('init',function(){
        WooJDConfig::init();
        WooJDFunctions::init();
        WooJDShortcodes::init();
        WooAfterOrder::init();
        WooJDResetWoocommerce::init();
    });


}