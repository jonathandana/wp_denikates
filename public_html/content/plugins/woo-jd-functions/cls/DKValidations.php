<?php

class DKValidations {

    /**
     * @param $var
     * @return bool
     */
    public static function isEmail($var){
        return is_string(filter_var($var,FILTER_VALIDATE_EMAIL));
    }


    /**
     * @param $var
     * @return bool
     */
    public static function notEmpty($var){
        if($var === '0'){
            return true;
        }

        return !empty(trim($var));
    }

    /**
     * @param $var
     * @return bool
     */
    public static function isPhone($var){
        return (bool)preg_match('/^0(5[0,2,3,4,7,8,9,5]|7[2,3,4,6,7,8]|[2,3,4,8,9])[2-9][\d]{6}$/', $var);
    }
}