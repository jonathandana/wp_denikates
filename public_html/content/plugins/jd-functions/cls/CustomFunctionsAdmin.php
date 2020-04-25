<?php

class CustomFunctionsAdmin{

    private static $super_user = 'jonathandana';

    public static  function menuRemoving() {
        $current_user = wp_get_current_user();

        $menus_sulg = array(
            'coment'=> 'edit-comments.php',
        );

        if($current_user->user_login != self::$super_user){
            $menus_sulg['acfpro'] = 'edit.php?post_type=acf-field-group';
            $menus_sulg['post'] = 'edit.php';
        }

        foreach ($menus_sulg as $key => $menu_slug){
            remove_menu_page( $menu_slug );
            remove_menu_page('admin.php?page=itsec');

        }

    }

    public static function load_css_js(){
        wp_enqueue_style( 'tm-admin-css', JD_FUNCTIONS_BASE.'/admin/css/admin.css','1.0.0');
    }
}