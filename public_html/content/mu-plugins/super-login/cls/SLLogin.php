<?php

class SLLogin{

    const LOCATION = '/user/login/';

    public static function init(){
        add_action('rest_api_init',array(__CLASS__,'registerRoutes'));
    }

    public static function registerRoutes(){

        //post /wp-json/super-login/v1/user/login/
        register_rest_route(SLConfig::SLNAMESPACE,self::LOCATION,array(
            'methods' => WP_REST_Server::CREATABLE,
            'callback' => array(__CLASS__,'sign_in'),
            'args' => array('email', 'password'),
        ));
    }

    public static function sign_in($params){

        try{
            $email = filter_var($params->get_param('email'), FILTER_VALIDATE_EMAIL);
            $password = $params->get_param('password');
            $user = get_user_by( 'email', $email );

            //is not valid email
            if(!$email){
                throw new Exception;
            }

            //is not valid user
            if(!$user){
                throw new Exception;
            }

            //is not valid role
            if($user->roles[0] != SLConfig::WOO_ROLE){
                 throw new Exception;
            }

            //is not valid password
            if(!wp_check_password($password, $user->data->user_pass, $user->ID)){
                throw new Exception;
            }

        }catch(Exception $error){
            return new WP_REST_Response(array('SLLogin'=>'שם משתמש או סיסמה אינו תקינים.'),400);
        }


        /**is valid user***/
        SLConfig::auto_login_user($user->ID);
        return new WP_REST_Response(true);
    }

}