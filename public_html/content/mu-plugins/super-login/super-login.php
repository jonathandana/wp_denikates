<?php
/*
Plugin Name:Super Login
Plugin URI:
Version: 1.0.0
Author: Jonathan Dana</a>
*/

define('SL_DIR',__DIR__);
spl_autoload_register(function($class) {

    $file_location = SL_DIR.DIRECTORY_SEPARATOR.'cls'.DIRECTORY_SEPARATOR.$class.'.php';
    if( file_exists($file_location) ) {
        require_once $file_location;
    }
});

class SuperLogin{



    public function __construct(){
        SLConfig::init();
        SLLogin::init();
        SLRegister::init();
        SLForgotPassword::init();

        //Init.
    }
}

add_action('init',function(){
    new SuperLogin();
});


//if(!defined('TM_SL_BASE')) {
//    define('TM_SL_BASE', plugins_url('', __FILE__));
//    define('TM_SL_DIR', dirname(__FILE__));
//    define('SL_VERSION','1.0.0');
//
//    spl_autoload_register( function($class) {
//        $filename = TM_SL_DIR . "/cls/{$class}.php";
//        if(file_exists($filename)) {
//            require_once($filename);
//        }
//    });
//
//
//
//    add_action('init',function(){
//        SLConfig::init();
//        SLRegister::init();
//        SLLogin::init();
//        SLForgotPassword::init();
//        SLShortcodes::init();
//        SLUserFunctions::init();
//    });

//    add_action('wp_enqueue_scripts','load_script_and_css',2);
//    function load_script_and_css(){
//        wp_enqueue_script('validator',TM_SL_BASE.'/inc/js/lib/formmanager-0.4.3.min.js',array('jquery'),'0.4.3',true);
//        wp_enqueue_script('SLscripts',TM_SL_BASE.'/inc/js/script.js',array('jquery'),SL_VERSION,true);
//        wp_enqueue_style('SLmain-css',TM_SL_BASE.'/inc/css/sl-main.css',array(),SL_VERSION);
//        wp_enqueue_style('SLawesome-css','https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css',array(),'4.7.0');
//    }


//    add_filter( 'rest_url_prefix', 'egr_magnificent_api_slug');
//    function egr_magnificent_api_slug( $slug ) {
//        return 'mg';
//    }


//}
