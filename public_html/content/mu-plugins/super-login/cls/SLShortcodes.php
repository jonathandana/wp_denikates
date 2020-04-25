<?php

class SLShortcodes{

    public static function init(){
        add_shortcode('SLRegister',array(__CLASS__,'SCRegister'));
        add_shortcode('SLLogin',array(__CLASS__,'SCLogin'));
        add_shortcode('SLForgot',array(__CLASS__,'SCForgot'));
        add_shortcode('SLReset',array(__CLASS__,'SCReset'));

        add_shortcode('SLSavedVideos',array(__CLASS__,'SCMySavedVideos'));
        add_shortcode('SLLastVideos',array(__CLASS__,'SCMyLastVideos'));


    }


    public static function SCRegister(){
        require_once TM_SL_DIR.'/shortcodes/register.php';
    }

    public static function SCLogin(){
        require_once TM_SL_DIR.'/shortcodes/login.php';
    }

    public static function SCForgot(){
        require_once TM_SL_DIR.'/shortcodes/forgot-password.php';
    }

    public static function SCReset(){
        require_once TM_SL_DIR.'/shortcodes/reset-password.php';
    }

    public static function SCMySavedVideos(){
        set_query_var('type',SLUserFunctions::MY_SAVED_VIDEOS);
        get_template_part('parts/personalArea','videos');
    }

    public static function SCMyLastVideos(){
        set_query_var('type',SLUserFunctions::LAST_VIEWS);
        get_template_part('parts/personalArea','videos');
    }
}



