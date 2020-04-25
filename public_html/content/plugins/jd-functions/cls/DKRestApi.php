<?php

class DKRestApi{

    //Name Space.
    const ROUTE_NAME_SPACE  = '/denikates/0.1';

    //Routes.
    const ROUTE_AUTO_COMPLETE = '/autocomplete/get';

    public static $route_auto_complete;
    public static $prefix_rest;

    //Const AutoComplete.
    const POSTS_TYPES = ['product'];
    const POST_PER_PAGE = 10;

    /**
     *Init Class.
     */
    public static function init(){
        add_action('rest_api_init', array(__CLASS__, 'registerRoutes'));

        self::$prefix_rest = rest_get_url_prefix();
        self::$route_auto_complete = '/'.self::$prefix_rest.self::ROUTE_NAME_SPACE.self::ROUTE_AUTO_COMPLETE.'/';

    }

    /**
     * Register Routes WP.
     */
    public static function registerRoutes(){
        register_rest_route(self::ROUTE_NAME_SPACE,self::ROUTE_AUTO_COMPLETE,array(
            'methods'  => WP_REST_Server::READABLE,
            'callback' => array( __CLASS__, 'autoComplete'),
            'args'     => array(
                'q'=> ['required_field'=>false],
                'ppp'=>['required_field'=>false],
            )
        ));
    }

    /**
     * @desc Auto Complete API.
     * @param WP_REST_Request $request
     * @return WP_REST_Response
     */
    public static function autoComplete(WP_REST_Request $request){
        $q = $request->get_param('q');
        $ppp = $request->get_param('ppp');

        $data = [];

        if(!$q){
            return new WP_REST_Response($data);
        }

        $post_per_page = $ppp ? $ppp : self::POST_PER_PAGE;

        $args = array(
        'post_type',self::POSTS_TYPES,
            's' => $q,
            'posts_per_page' =>$post_per_page
        );

        add_filter('posts_where', function($where) use ($q){
            global $wpdb;
            return "{$where} AND {$wpdb->posts}.post_title REGEXP '({$q})'";
        });

        $query = new WP_Query($args);

        while($query->have_posts()){
            $query->the_post();

            $data[] = [
                "img"   => get_the_post_thumbnail_url(get_the_ID(),'thumbnail'),
                "name"  => htmlspecialchars_decode(get_the_title()),
                "url"   => get_permalink()
            ];
        }

        return new WP_REST_Response($data);
    }


}