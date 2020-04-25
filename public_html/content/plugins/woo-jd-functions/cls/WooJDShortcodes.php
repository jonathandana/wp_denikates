<?php

class WooJDShortcodes{

    public static function init(){
        add_shortcode('JDShopCart',array(__CLASS__,'JDShopCart'));
    }


    public static function JDShopCart(){
        require_once WOO_JD_DIR.'/shortcodes/shop_cart.php';
    }
}



