<?php
/*
Plugin Name: JD Functions
Plugin URI:
Version: 1.0.0
Author:
*/

if(!defined('JD_FUNCTIONS_BASE')){
    define( 'JD_FUNCTIONS_BASE', plugins_url( '', __FILE__ ) );
    define( 'JD_FUNCTIONS_DIR', dirname(__FILE__) );

    require_once JD_FUNCTIONS_DIR.'/inc/extend_search.php';

    spl_autoload_register( function($class) {
        $filename = JD_FUNCTIONS_DIR . "/cls/{$class}.php";
        if ( file_exists($filename) ){
            require_once($filename);
        }
    });

    if (!function_exists('acf_add_options_sub_page')||!function_exists('acf_add_local_field_group')){
        add_action('admin_notices', array('OptionsTheme', 'alertNeedAcf'));
        return false;
    }




    add_action('init',function(){
        OptionsTheme::init();
        DKHomePage::init();
        DKMerchandise::init();
        DKRestApi::init();
        DKProduct::init();
        //DKMyCakes::init();
        //DKTips::init();
     });


    add_action('admin_enqueue_scripts', array('CustomFunctionsAdmin', 'load_css_js'));
    add_action( 'admin_menu', array('CustomFunctionsAdmin','menuRemoving'));

    /**ajax**/
    add_action( 'wp_ajax_loadMore', array('HelperFunctions','loadMore'));
    add_action( 'wp_ajax_nopriv_loadMore',array('HelperFunctions','loadMore'));

}
