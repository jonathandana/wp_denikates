<?php

class SLTemplates{


    /**
     * @description Get html login btn
     * @return string
     */
    public static function getLoginHtml(){
            ob_start();
            require SL_DIR . '/templates/login_btn.php';
            $html = ob_get_contents();
            ob_end_clean();
            return $html;
    }


    /**
     * @description Get html popup login
     * @return string
     */
    public static function getPopupLoginHtml(){
        ob_start();
        require SL_DIR.'/templates/popup-login.php';
        $html = ob_get_contents();
        ob_end_clean();
        return $html;
    }

    /**
     * @description login form
     * @return string
     */
    public static function getLoginFormHtml(){
        ob_start();
        require SL_DIR.'/templates/login-form.php';
        $html = ob_get_contents();
        ob_end_clean();
        return $html;
    }

    /**
     * @description Register form
     * @return string
     */
    public static function getRegisterFormHtml(){
        ob_start();
        require SL_DIR.'/templates/register-form.php';
        $html = ob_get_contents();
        ob_end_clean();
        return $html;
    }

    /**
     * @description Register form
     * @return string
     */
    public static function getForgotPassFormHtml(){
        ob_start();
        require SL_DIR.'/templates/forgot-pass-form.php';
        $html = ob_get_contents();
        ob_end_clean();
        return $html;
    }

    /**
     * @description Register form
     * @return string
     */
    public static function getResetPassFormHtml(){
        ob_start();
        require SL_DIR.'/templates/reset-pass.php';
        $html = ob_get_contents();
        ob_end_clean();
        return $html;
    }


}