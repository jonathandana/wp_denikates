<?php

class DKMyCakes{

    public static function init(){
        $labels = array('menu_icon' =>'dashicons-smiley');
        RegisterCpt::register('my_cakes','העוגות שלי',array(),$labels);

        self::registerFields();

    }



    public static function registerFields(){

    }

}