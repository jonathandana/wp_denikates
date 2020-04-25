<?php
class WooJDFunctions{

    use TWooApiFunctions;

    const LOCATION_GET_DATA_CART = '/product/get_data_cart';
    const LOCATION_ADD_TO_CART = '/product/add_to_cart';
    const LOCATION_REMOVE_TO_CART = '/product/remove_form_the_cart';


    const WOO_CAT = 'product_cat';
    const POST_TYPE = 'product';
    const POSTS_PER_PAGE_CAT = 24;


    public static function init(){
        add_action('rest_api_init', array(__CLASS__, 'registerRoutes'));
    }

    public static function registerRoutes(){

        register_rest_route(WooJDConfig::WOO_JD_NAMESPACE,self::LOCATION_ADD_TO_CART,array(
            'methods'  => WP_REST_Server::CREATABLE,
            'callback' => array(__CLASS__,'insertProductToCart'),
            'args'     => array('quantity','product_id')
        ));


        register_rest_route(WooJDConfig::WOO_JD_NAMESPACE,self::LOCATION_REMOVE_TO_CART,array(
            'methods'  => WP_REST_Server::CREATABLE,
            'callback' => array(__CLASS__,'removeProductFromCart'),
            'args'     => array('cart_item_key','product_id')
        ));

        register_rest_route(WooJDConfig::WOO_JD_NAMESPACE,self::LOCATION_GET_DATA_CART,array(
            'methods'  => WP_REST_Server::READABLE,
            'callback' => array(__CLASS__,'getDataCart'),
        ));

    }


    /**
     * Get Categories Woocommerce
     * @param $parent
     * @return object
     * */
     public static function getCategoriesWoo($parent = null){
         $args = array(
            'taxonomy' => self::WOO_CAT,
         );

         if($parent !== null){
             $args['parent'] = $parent;
         }

         $categories = get_terms($args);

         return $categories;
     }


    /**
     * Get Products by category or all products.
     * @param $term object
     * @param $posts_per_page integer
     * @return object
     * */
     public static function getProductsQuery($term = null, $posts_per_page = null, $paged = 1 , $orderby = null){

         $args = array(
             'post_type'=>self::POST_TYPE,
             'posts_per_page' => $posts_per_page,
             'paged'=> $paged,
             'order'=>'ASC'
         );

         if($orderby){
             $args['orderby'] = $orderby;
         }

         if($posts_per_page){
             $args['posts_per_page'] = $posts_per_page;
         }



         if($term){
             $args['tax_query'] = array(array(
                 'taxonomy' => $term->taxonomy,
                 'field'    => 'term_id',
                 'terms'    => $term->term_id,
             ));
         }
         
         return new WP_Query($args);
     }

}