<?php
class RegisterTaxonomies{

    public static function register($tax_name_register , $tax_name_menu , $tax_relation = array(),  $_labels = array() , $_args = array() ){
        $labels = array(
            'name'                       =>  $tax_name_menu,
            'singular_name'              =>  $tax_name_menu,
            'menu_name'                  =>  $tax_name_menu,
            'all_items'                  => __( 'All Items', ''),
            'parent_item'                => __( 'Parent Item', ''),
            'parent_item_colon'          => __( 'Parent Item:', ''),
            'new_item_name'              => __( 'New Item Name', ''),
            'add_new_item'               => __( 'Add New Item', ''),
            'edit_item'                  => __( 'Edit Item', ''),
            'update_item'                => __( 'Update Item', ''),
            'view_item'                  => __( 'View Item', ''),
            'separate_items_with_commas' => __( 'Separate items with commas', ''),
            'add_or_remove_items'        => __( 'Add or remove items', ''),
            'choose_from_most_used'      => __( 'Choose from the most used', ''),
            'popular_items'              => __( 'Popular Items', ''),
            'search_items'               => __( 'Search Items', ''),
            'not_found'                  => __( 'Not Found', ''),
            'no_terms'                   => __( 'No items', ''),
            'items_list'                 => __( 'Items list', ''),
            'items_list_navigation'      => __( 'Items list navigation', ''),
        );

        if(count($_labels)){
            $labels = array_merge($labels ,  $_labels);
        }

        $args = array(
            'labels'                     => $labels,
            'hierarchical'               => true,
            'public'                     => true,
            'show_ui'                    => true,
            'show_admin_column'          => true,
            'show_in_nav_menus'          => true,
            'show_tagcloud'              => true,
        );


        if(count($_args)){
            $args = array_merge($args, $_args);
        }


        register_taxonomy( $tax_name_register, $tax_relation , $args );

    }

}