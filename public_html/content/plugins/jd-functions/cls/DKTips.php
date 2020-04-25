<?php

class DKTips{

    public static function init(){
        $labels = array('menu_icon' =>'dashicons-clipboard');
        RegisterCpt::register('tips','טיפים',array(),$labels);

        self::registerFields();

    }



    public static function registerFields(){

    }

}