<?php


class WooJDConfig{

    const WOO_JD_NAMESPACE = '/WOO-JD/v1';
    public static $NAMESPACEWP;


    public static $routeAddProductToCart;
    public static $routeRemoveFromTheCart;
    public static $getDataCart;



    /**
     * init function plugin
     * */
    public static function init(){
        if(!class_exists( 'WooCommerce' )){
            add_action('admin_notices',array(__CLASS__,'deactivate_plugin_WooJD'));
            return;
        }

        self::$NAMESPACEWP            =  rest_get_url_prefix();
        self::$getDataCart            =  self::$NAMESPACEWP.self::WOO_JD_NAMESPACE.WooJDFunctions::LOCATION_GET_DATA_CART;
        self::$routeAddProductToCart  =  self::$NAMESPACEWP.self::WOO_JD_NAMESPACE.WooJDFunctions::LOCATION_ADD_TO_CART;
        self::$routeRemoveFromTheCart =  self::$NAMESPACEWP.self::WOO_JD_NAMESPACE.WooJDFunctions::LOCATION_REMOVE_TO_CART;


        add_action('wp_enqueue_scripts',array(__CLASS__,'load_scripts_and_styles'),2);
    }

    /**
     * Call Functions Wordpress and deactivate this plugins.
     * @return boolean
     * */
    public static function  deactivate_plugin_WooJD(){
        echo '<div style="padding: 22px 12px;" class="error notice">Alert you need plugins woocommerce <span style="color:red">(plugin woo jd function deactive now)</span></div>';
        deactivate_plugins( plugin_basename( __FILE__ ) );
    }

    /**
     *
     * Load css And Scripts Files
     *
     **/
    public static function load_scripts_and_styles(){
        //wp_enqueue_style('WooJD',WOO_JD_BASE.'/inc/css/style.css',array(),WOO_JD_VERSION);
        wp_enqueue_script('WooJD',WOO_JD_BASE.'/inc/js/script.js',array('jquery'),WOO_JD_VERSION,true);
        wp_localize_script('WooJD','obj_WooJD',array(
           'get_data_cart'=>'/'.self::$getDataCart.'/',
           'add_to_cart'=>'/'.self::$routeAddProductToCart.'/',
            'remove_from_the_cart'=>'/'.self::$routeRemoveFromTheCart.'/'
        ));
    }

}