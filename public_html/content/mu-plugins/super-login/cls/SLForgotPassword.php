<?php

class SLForgotPassword{

    const LOCATION = '/user/forgot/';
    const LOCATIONRP = '/user/reset/';

    public static function init(){
        add_action('rest_api_init',array(__CLASS__,'registerRoutes'));

        if(self::init_rp()){
            self::add_class_css_user_reset_password();
        }

    }

    private static function add_class_css_user_reset_password(){
        add_filter( 'body_class', function( $classes ) {
            return array_merge( $classes, array( 'reset-password' ) );
        });
    }

    public static function registerRoutes(){

        //post /wp-json/super-login/v1/user/forgot/
        register_rest_route(SLConfig::SLNAMESPACE,self::LOCATION,array(
            'methods' => WP_REST_Server::CREATABLE,
            'callback' => array(__CLASS__,'forgot_password'),
            'args' => array('email'),
        ));

        //post /wp-json/super-login/v1/user/reset/
        register_rest_route(SLConfig::SLNAMESPACE,self::LOCATIONRP,array(
            'methods' => WP_REST_Server::CREATABLE,
            'callback' => array(__CLASS__,'reset_password'),
            'args' => array('password'),
        ));


    }

    public static function forgot_password($params){
        try{
            $response = [];

            $email = filter_var($params->get_param('email'),FILTER_VALIDATE_EMAIL);
            $user = get_user_by( 'email', $email );

            //is not valid Email
            if(!$email){
                throw new Exception('אימייל לא תקין',1);
            }

            //is not valid user
            if(!$user || $user->roles[0] != SLConfig::WOO_ROLE){
                throw new Exception('משתמש לא קיים במערכת');
            }

            //The email is not sent
            if(!self::send_rp_link($user)){
                throw new Exception('אימייל לא נישלח נא לנסות שוב או לפנות למנהל האתר');
            }

        }catch (Exception $error){
           $response['SLForgot'] = $error->getMessage();
           return new WP_REST_Response($response,400);
        }


        return new WP_REST_Response(true);
    }

    public static function reset_password($params){
        try{
            $response = array('SLReset' => null);
            $password = $params->get_param('password');
            $key      = $params->get_param('key');

            $user = self::getUserByKey($key);


            if(!$password){
                throw new Exception ('Password Required',220);
            }

            if(!$user){
               throw new Exception ('User Required',221);
            }

            if(get_user_by('id',$user->ID)->roles[0] != SLConfig::WOO_ROLE){
                throw new Exception ('User not valid',223);
            }
            
            //Set New Pass.
            wp_set_password( $password, $user->ID);
            SLConfig::auto_login_user($user->ID);
            //Send email Create New user in site.
            $user_info = get_userdata($user->ID);
            foreach (SLConfig::EMAILS_NOT as $email_not){
                wp_mail($email_not,'איפוס סיסמה',"{$user_info->first_name} {$user_info->last_name} איפס סיסמה.  ");
            }

            return new WP_REST_Response(true);

        }catch (Exception $error){
            $response['SLReset'] = "Error {$error->getCode()} Try again";
            return new WP_REST_Response($response,400);
        }




    }

    private static function send_rp_link($user_obj){
        global $wpdb;
        $salt = wp_generate_password(20, false);
        $key = sha1($salt . $user_obj->user_email . uniqid(time(), true));
        $wpdb->update($wpdb->users, array('user_activation_key' => $key), array('user_login' => $user_obj->user_login));
        $link_rp = site_url()."?action=rp&key={$key}";

        $message = "לחץ על הקישור לאיפוס סיסמה:\n";
        $message.=$link_rp."\n";

        return  wp_mail($user_obj->user_email,site_url(),$message);
    }

    private static function init_rp(){
        $action = filter_input(INPUT_GET, "action") == 'rp';
        $key = filter_input(INPUT_GET, "key");

        if(!$action || !$key){
            return false;
        }

       return self::getUserByKey($key);
    }

    public static function getUserByKey($key){
        if(!$key){
            return false;
        }
        global $wpdb;
        $results = $wpdb->prepare("SELECT ID, user_login, user_email FROM {$wpdb->users} WHERE user_activation_key = %s", $key);
        return $wpdb->get_row($results);
    }


}