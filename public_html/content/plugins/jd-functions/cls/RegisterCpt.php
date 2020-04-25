<?php
class RegisterCpt {

    public static function register($postype_name , $name_post ,  $_labels = array() , $_args = array()){
        $labels = array(
            'name'                  =>  $name_post,
            'singular_name'         => 	$name_post,
            'menu_name'             => 	$name_post,
            'name_admin_bar'        => 	$name_post,
            'add_new_item'          =>	'פוסט חדש',
            'add_new'               => 	'פוסט חדש'
        );

        if(count($_labels)){
            $labels = array_merge($labels ,  $_labels);
        }

        $args = array(
            'label'                 => __( $name_post, 'tm_functions' ),
            'description'           => __( $name_post, 'tm_functions' ),
            'labels'                => $labels,
            'supports'              => array( 'title','editor','thumbnail','excerpt'),
            'public'                => true,
            'has_archive'           => true,
            'capability_type'       => 'post',
            'hierarchical'          => false,
            'exclude_from_search'   => false,
            'publicly_queryable'    => true,
            'show_in_nav_menus'     => true,
            'show_in_menu'          => true,
        );


        if(count($_args)){
            $args = array_merge($args, $_args);
        }


        register_post_type( $postype_name, $args );

    }

}
