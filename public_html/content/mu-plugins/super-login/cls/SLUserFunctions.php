<?php

class SLUserFunctions{

    /**
     * @description Update meta data woo commerce and wordpress
     * @param $id
     * @param $fname
     * @return void
     */
    public static function updateFirstName($id, $fname){
        update_user_meta($id,'first_name',$fname);
        update_user_meta($id,'shipping_first_name',$fname);
        update_user_meta($id,'billing_first_name',$fname);
    }

    /**
     * @description Update meta data woo commerce and wordpress
     * @param $id
     * @param $lname
     * @return void
     */
    public static function updateLastName($id, $lname){
        update_user_meta($id,'last_name',$lname);
        update_user_meta($id,'shipping_last_name',$lname);
        update_user_meta($id,'billing_last_name',$lname);
    }


    /**
     * @description Update meta data woo commerce and wordpress
     * @param $id
     * @param $country
     * @return void
     */
    public static function updateCountry($id, $country = 'IL'){
        update_user_meta($id,'shipping_country',$country);
        update_user_meta($id,'billing_country',$country);
    }

    /**
     * @description Update meta data woo commerce and wordpress
     * @param $id
     * @param $phone
     * @return void
     */
    public static function updatePhone($id, $phone){
        update_user_meta($id,'billing_phone',$phone);
    }

    public static function isLoggedCookie(){
        if(!count($_COOKIE)){
            return false;
        }

        foreach ($_COOKIE as $key => $val){
            if(preg_match("/wordpress_logged_in/i", $key)){
                return true;
            }
        }
        return false;

    }

    public static function getUserByCookie(){
        if(!isset($_COOKIE[LOGGED_IN_COOKIE])){
            return false;
        }

        return wp_validate_auth_cookie( $_COOKIE[LOGGED_IN_COOKIE], 'logged_in' );
    }




}