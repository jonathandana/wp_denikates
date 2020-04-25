<?php
    class SLConfig{
          const WOO_ROLE = 'customer';
//        const CROLE = 'site_users';
        const SLNAMESPACE = '/super-login/v1';
        const EMAILS_NOT = ['jonathandana27@gmail.com','daniteld@gmail.com'];
        public static $NAMESPACEWP;
//
//
//
//
         public static $current_user;
//        //public static
//
//        //routes
        public static $routeLogin;
        public static $routeRegister;
        public static $routeFP;
        public static $routeRP;


        public static function init(){

            self::$NAMESPACEWP          =  rest_get_url_prefix();
            self::$routeLogin           =  home_url('/').self::$NAMESPACEWP.self::SLNAMESPACE.SLLogin::LOCATION;
            self::$routeRegister        =  home_url('/').self::$NAMESPACEWP.self::SLNAMESPACE.SLRegister::LOCATION;
            self::$routeFP              =  home_url('/').self::$NAMESPACEWP.self::SLNAMESPACE.SLForgotPassword::LOCATION;
            self::$routeRP              =  home_url('/').self::$NAMESPACEWP.self::SLNAMESPACE.SLForgotPassword::LOCATIONRP;

            self::$current_user = wp_get_current_user();
            self::isUserAllow();

            add_action('login_head',array(__CLASS__,'insert_code_head_login'));

//            add_filter( 'body_class', function( $classes ) {
//                $avatar_class_css =  get_user_meta(self::$current_user->ID,'wsl_current_user_image',true) ? 'has-avatar' : 'avatar-default';
//                return array_merge( $classes, array( $avatar_class_css ) );
//            } );


        }

        public static function insert_code_head_login(){
            $output = '<style>.wp-social-login-widget{display: none!important;}</style>';
            echo $output;
        }

        public static function isUserAllow(){
            if(!is_user_logged_in()){
                return false;
            }

            if(self::$current_user->ID && in_array(self::WOO_ROLE, self::$current_user->roles)){
                show_admin_bar(false);
                return true;
            }

            return false;
        }

        public static function auto_login_user($user_id){
            //Remember.
            wp_set_current_user($user_id);
            wp_set_auth_cookie($user_id);
        }
//
//        public static function sl_get_social_icons(){
//            if(!shortcode_exists('wordpress_social_login')){
//                return false;
//            }
//
//            return do_shortcode('[wordpress_social_login]');
//        }
//
//        public static function getAvatarLink(){
//
//            $avatar = get_user_meta(self::$current_user->ID,'wsl_current_user_image',true);
//
//            if($avatar == ''){
//                return self::$avatar_default;
//            }
//
//            return $avatar;
//
//        }
//
//
//        public static function sl_get_avatar_img(){
//
//            $avatar = get_user_meta(self::$current_user->ID,'wsl_current_user_image',true);
//
//            if($avatar == ''){
//                $img = "<img alt='avatar default' class='avatar-default' src='".self::$avatar_default."'/>";
//                return $img;
//            }
//
//            $img = "<img alt='".self::$current_user->user_login."' class='avatar-user' src='".$avatar."'/>";
//            return $img;
//
//        }
//
//        public static function sl_the_avatar(){
//
//            ob_start();
//            require_once TM_SL_DIR.'/templates/avatar.php';
//            $html_avatar = ob_get_contents();
//            ob_end_clean();
//
//            return $html_avatar;
//        }

}