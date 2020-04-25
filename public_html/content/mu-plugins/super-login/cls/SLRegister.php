<?php

class SLRegister{

    const LOCATION = '/user/register/';
    public static $errors = array();


    public static function init(){
        add_action('rest_api_init',array(__CLASS__,'registerRoutes'));
    }

    public static function registerRoutes(){
        //post /wp-json/super-login/v1/user/register/

        register_rest_route(SLConfig::SLNAMESPACE,self::LOCATION,array(
            'methods' => WP_REST_Server::CREATABLE,
            'callback' => array(__CLASS__,'register_new_user'),
            'args' => array('fname','lname','email', 'password'),
        ));
    }

    public static function register_new_user($params){
        $fname = $params->get_param('fname');
        $lname = $params->get_param('lname');
        $email = filter_var($params->get_param('email'),FILTER_VALIDATE_EMAIL);
        $phone = $params->get_param('phone');
        $password = $params->get_param('password');

        if(!$email){
            self::$errors['SLRegister_email_error'] = 'אימייל לא תקין';
        }
        if(!$phone){
            self::$errors['SLRegister_phone_error'] = 'טלפון לא תקין';
        }

        if(!$fname){
            self::$errors['SLRegister_fname_error'] = 'שם לא תקין';
        }
        if(!$lname){
            self::$errors['SLRegister_lname_error'] = 'שם משפחה לא תקין';
        }

        if(!$password){
            self::$errors['SLRegister_password_error'] = 'סיסמה לא תקין';
        }

        if(email_exists($email)){
            self::$errors['SLRegister_email_error'] = 'אימייל קיים במערכת';
        }

        // Register Not Valid.
        if(count(self::$errors)){
            return new WP_REST_Response(self::$errors,400);
        }

        //Register Valid.
        self::generateUser($params);
        //Merge cart in user.
        return new WP_REST_Response('success');
    }


    private static function generateUser($params){
        $email = $params->get_param('email');
        $fname = $params->get_param('fname');
        $lname = $params->get_param('lname');
        $user_id = wp_create_user( $email, $params->get_param('password'), $email );

        //Update User data.
        $user = new WP_User($user_id);
        $user->set_role(SLConfig::WOO_ROLE);
        SLUserFunctions::updateFirstName($user_id,$fname);
        SLUserFunctions::updateLastName($user_id,$lname);
        SLUserFunctions::updateCountry($user_id);
        SLUserFunctions::updatePhone($user_id,$params->get_param('phone'));

        //Send email Create New user in site.
        foreach (SLConfig::EMAILS_NOT as $email_not){
            wp_mail($email_not,'משתמש חדש נירשם',"{$fname} {$lname} נירשם לאתר.  ");
        }


        SLConfig::auto_login_user($user_id);

        return true;

    }

    public static function genarate_array_fullname($full_name){
        $full_name = explode(' ',$full_name);
        $last_name = $full_name[count($full_name)-1];
        unset($full_name[count($full_name)-1]);
        $fname = implode(' ',$full_name);

        return array(
            'fname' => $fname,
            'lname' => $last_name
        );
    }

}