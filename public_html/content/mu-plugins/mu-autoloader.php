<?php
/*
Plugin Name: Loading mu plugins
Description: List Plugins: advanced-custom-fields-pro, tm-functions, tm-lead-interface
Plugin URI:
Version: 1.0.0
Author:
*/

$plugins = [
    'super-login'=>'super-login.php'
];

if(empty($plugins)){
    return false;
}

foreach ($plugins as  $dir => $file){

    $plugin_path = WPMU_PLUGIN_DIR.DIRECTORY_SEPARATOR.$dir.DIRECTORY_SEPARATOR.$file;

    if(file_exists($plugin_path)){
        include_once $plugin_path;
    }

}