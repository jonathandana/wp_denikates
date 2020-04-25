<?php
class WooJDResetWoocommerce{

    public static function init(){
        add_action('add_meta_boxes',array(__CLASS__,'removeMetaboxes'),40);
        add_action( 'admin_menu', array(__CLASS__,'nstrmRemoveAdminSubmenus'), 999 );
        add_action( 'admin_head',array(__CLASS__,'myCustomAdminStyleHidden'));

        add_filter('woocommerce_product_data_tabs',array(__CLASS__,'removeLinkedProducts'), 10, 1);
        add_filter( 'woocommerce_checkout_fields' , array(__CLASS__,'filterFieldsCheckout'));
       // add_filter( 'woocommerce_add_error', 'changeErrorsMessage' );



        self::unregisterTaxonomy();

    }

    /**
     * Remove metaboxes Woocommerce
     * */
    public static function removeMetaboxes(){
        remove_meta_box( 'woocommerce-product-images',  'product', 'side');
        remove_meta_box('tagsdiv-product_tag','product','side');
    }

    /**
     * Remove Taxonomy Woocommerce
     * */
    public static function unregisterTaxonomy(){
        global $wp_taxonomies;
        $taxonomy = 'product_tag';
        if ( taxonomy_exists( $taxonomy)){
            unset( $wp_taxonomies[$taxonomy]);
        }


    }


    /**
     * Remove attribute tab to metabox Woocommerce (singular product)
     * */
    public static function removeLinkedProducts($tabs){
        unset($tabs['attribute']);
        //unset($tabs['inventory']);
        unset($tabs['shipping']);
        unset($tabs['linked_product']);
        unset($tabs['variations']);
        unset($tabs['advanced']);
        return($tabs);
    }


    /**
     * Remove attribute submenu to post type product
     */
    public static function nstrmRemoveAdminSubmenus() {
        remove_submenu_page( 'edit.php?post_type=product', 'product_attributes' );
    }


    /**
     * Create custom css to display none option woo.
     */
    public static function myCustomAdminStyleHidden(){
        echo '<style> 
            #woocommerce-product-data .hndle span span{display: none;} 
            .post-type-shop_order .order_notes{display: none!important}
            </style>';
    }



    /**
     * Remove Fields to form checkout.
     * Remove required field
     */
    public static function filterFieldsCheckout( $fields ) {

        //Change Labels fields.
        $fields['order']['order_comments']['label']='הערות הזמנה';
        //not required field
        $fields['billing']['billing_postcode']['required'] = false;

        //remove
        unset($fields['billing']['billing_address_1']['placeholder']);
        unset($fields['billing']['billing_address_2']['placeholder']);

        unset($fields['order']['order_comments']['placeholder']);
        unset($fields['billing']['billing_country']);
        unset($fields['billing']['billing_company']);
        unset($fields['billing']['billing_address_2']);

        //remove shipping Fields
        unset($fields['shipping']);




        return $fields;
    }



}