
<?php
defined('ABSPATH') or die();

define('THEME_URI', get_stylesheet_directory_uri());
define('BASE_URL', __DIR__);
define('VERSION','6.1.5');
add_filter('the_generator', '__return_null');



add_action("wp_enqueue_scripts","load_script_and_style");
function load_script_and_style(){
    //register scripts
    wp_register_style('swiper-css',THEME_URI.'/view/css/lib/swiper.min.4.3.5.css',array(),VERSION);
    wp_register_script('swiper',THEME_URI.'/view/js/lib/swiper.min.4.3.5.js',array('jquery'),VERSION,true);
    //EOF

    //remove styles and scripts woo
    remove_styles_and_script_woo();
    //EOF

    wp_enqueue_style('GoogleFonts','https://fonts.googleapis.com/css?family=Heebo',array(),VERSION);
    wp_enqueue_style('normalize',THEME_URI.'/view/css/lib/normalize.css',array(),VERSION);
    wp_enqueue_style('wm-awesome-css','https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css',array(),'4.7.0');
	wp_enqueue_style('jd-main',THEME_URI.'/view/css/main.css',array('normalize','swiper-css'),VERSION);
	wp_enqueue_script('angularjs',THEME_URI.'/view/js/lib/angular.1.6.6.min.js',['jquery'],'1.6.6',true);
	wp_enqueue_script('jd-js',THEME_URI.'/view/js/general.js',array('jquery','angularjs'),VERSION,true);
	wp_localize_script('jd-js','obj',['auto_complete'=>DKRestApi::$route_auto_complete]);

    if(is_front_page()){
        wp_enqueue_style('swiper-css');
        wp_enqueue_script('swiper');

        wp_enqueue_style('jd-homepage',THEME_URI.'/view/css/home-page.css',array('jd-main'),VERSION);
        wp_enqueue_script('jd-home-js',THEME_URI.'/view/js/home.js',array('jquery'),VERSION,true);
    }

    else if(is_tax(WooJDFunctions::WOO_CAT)){
        wp_enqueue_style('jd-tax-product',THEME_URI.'/view/css/product-category.css',array('jd-main'),VERSION);
    }

    else if(is_singular(WooJDFunctions::POST_TYPE)){
        wp_enqueue_style('jd-product-page',THEME_URI.'/view/css/product-page.css',array('jd-main'),VERSION);
    }

    else if(is_search()){
        wp_enqueue_style('jd-search',THEME_URI.'/view/css/search.css',array('jd-main'),VERSION);
    }

    else if(is_page_template('page-templates/page-contactus.php')){
        wp_enqueue_style('contact-us',THEME_URI.'/view/css/contact-us.css',array('jd-main'),VERSION);
        wp_enqueue_script('jd-contactus-js',THEME_URI.'/view/js/contactus.js',array('jquery'),VERSION,true);
    }

    else if(is_404()){
        wp_enqueue_style('jd-404',THEME_URI.'/view/css/404.css',array('jd-main'),VERSION);
    }

}


add_action('after_setup_theme', 'tm_after_setup');
function tm_after_setup(){
	load_theme_textdomain( "danikates", get_stylesheet_directory()."/lang" );
	add_theme_support('post-thumbnails');
	add_theme_support('custom-logo');
	add_theme_support( 'woocommerce' );
}

function custom_excerpt_more( $more ) {
	return '';
}
add_filter( 'excerpt_more', 'custom_excerpt_more' );




add_filter('wpseo_metabox_prio', 'yoast_bottom');
function yoast_bottom() {
    return 'low';
}


register_nav_menus(
	array(
		'main_menu'=>'Main menu',
	)
);


add_action( 'pre_get_posts', 'posts_per_page' );
function posts_per_page($query){
	if(is_tax(WooJDFunctions::WOO_CAT)) {
		$query->set( 'posts_per_page', WooJDFunctions::POSTS_PER_PAGE_CAT );
	}
}


add_action('init','images_sizes');
function images_sizes(){
    add_image_size('logo',210,135);
    add_image_size('banner_home_page',1920);
    add_image_size('product',566,424);
}

/*No Load css and js cf7*/
add_filter( 'wpcf7_load_css', '__return_false' );
add_filter( 'wpcf7_load_js', '__return_false' );

/*No Load css and Woocommerce*/




function get_custom_pagination() {

    global $wp_query;
    $paged_exist = array_key_exists('paged',$wp_query->query);
	$paged = $paged_exist ? $wp_query->query['paged']  : '1' ;
	$last_page = $paged == $wp_query->max_num_pages;
	$pages = paginate_links(array(
			'prev_text'=> __('<i class="fa fa-angle-right" aria-hidden="true"></i>'),
			'next_text'=> __('<i class="fa fa-angle-left" aria-hidden="true"></i>'),
			'type'	   => 'array'
		));

	if( is_array( $pages ) ) {
		$pagination =  '<div class="pagination-con"><ul>';
		if($paged_exist){
			$pagination .= '<li class="arrow"><a href="'.get_pagenum_link('1').'"><i class="fa fa-angle-double-right" aria-hidden="true"></i></a></li>';
		}

		foreach ( $pages as $page ) {
			$pagination.= "<li>$page</li>";
		}

		if(!$last_page){
			$pagination .= '<li class="arrow"><a href="'.get_pagenum_link($wp_query->max_num_pages).'"><i class="fa fa-angle-double-left" aria-hidden="true"></i></a></li>';
		}
		$pagination.= '</ul></div>';

		return $pagination;
	}

	return false;
}


/**
 * Function check is exist dependencies classes
 * @return boolean
 * */
function has_dependencies_cls(){
    $classes = array('OptionsTheme','WooJDConfig','acf');

    foreach ($classes as $class) {
        if(!class_exists($class)){
            return false;
        }
    }

    return true;
}

/**
 * Function filter facebook to array.
 * @param $array_search
 * @return string | boolean
 * */
function filter_facebook_link_to_array($array_search){

    if(!is_array($array_search)){
        return false;
    }

    foreach ($array_search as $item){

        $pos = strpos($item['icon_url'],'facebook.com');

        if ($pos !== false) {
            return $item['icon_url'];
        }

    }

    return false;

}

/**
 * If has image product get image or img cat or img default.
 * @param $post_id boolean
 * @return string | boolean
 * */
function get_img_product($post_id){

    $img_default = THEME_URI.'/view/images/default-img.jpg';

    if(has_post_thumbnail($post_id)){
        return get_the_post_thumbnail_url($post_id,'product');
    }

//    $terms = wp_get_post_terms( $post_id,WooJDFunctions::WOO_CAT);
//    $term = $terms[0];
//    $image_cat = wp_get_attachment_url(get_term_meta($term->term_id, 'thumbnail_id', true));
//
//    if($image_cat){
//        return $image_cat;
//    }

    return $img_default;

}

add_action('template_redirect','redirect_archive_product');
function redirect_archive_product(){
    if(!is_post_type_archive(WooJDFunctions::POST_TYPE)){
        return;
    }

    wp_redirect(esc_url(home_url('#product')),302);
    exit;
}


/**
 * Remove styles and script to all pages outside page cart and checkout.
 * @return void
 * */
function remove_styles_and_script_woo(){

    if ( function_exists( 'is_woocommerce' ) ) {
        if (! is_cart() && ! is_checkout() ) {
            # Styles
            wp_dequeue_style( 'woocommerce-general' );
            wp_dequeue_style( 'woocommerce-layout' );
            wp_dequeue_style( 'woocommerce-smallscreen' );
            wp_dequeue_style( 'woocommerce_frontend_styles' );
            wp_dequeue_style( 'woocommerce_fancybox_styles' );
            wp_dequeue_style( 'woocommerce_chosen_styles' );
            wp_dequeue_style( 'woocommerce_prettyPhoto_css' );
            # Scripts
            wp_dequeue_script( 'wc_price_slider' );
            wp_dequeue_script( 'wc-single-product' );
            wp_dequeue_script( 'wc-add-to-cart' );
            wp_dequeue_script( 'wc-cart-fragments' );
            wp_dequeue_script( 'wc-checkout' );
            wp_dequeue_script( 'wc-add-to-cart-variation' );
            wp_dequeue_script( 'wc-single-product' );
            wp_dequeue_script( 'wc-cart' );
            wp_dequeue_script( 'wc-chosen' );
            wp_dequeue_script( 'woocommerce' );
            wp_dequeue_script( 'prettyPhoto' );
            wp_dequeue_script( 'prettyPhoto-init' );
            wp_dequeue_script( 'jquery-blockui' );
            wp_dequeue_script( 'jquery-placeholder' );
            wp_dequeue_script( 'fancybox' );
            wp_dequeue_script( 'jqueryui' );
        }
    }
}



class addSubMenuWrap extends Walker_Nav_Menu{

    function start_lvl( &$output, $depth = 0, $args = array() ) {
        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent<div class='sub-menu-wrap'><ul class='sub-menu'>\n";
    }
    function end_lvl( &$output, $depth = 0, $args = array() ) {
        $indent = str_repeat("\t", $depth);
        $output .= "$indent</ul></div>\n";
    }
}


/**
 * get video id youtube
 * @param $field string
 * @return string
 **/
function convert_field_oembed_to_video_id ($field){
    preg_match('/src="(.+?)"/', $field, $matches);
    $url = $matches[0];
    return substr(strrchr(parse_url($url, PHP_URL_PATH), '/'),1);
}

/**
 * get path image youtube.
 * @param $id  string
 * @param $image integer
 * @return string
 **/
function get_path_img_youtube_by_id($id , $image = 0){
    return "https://img.youtube.com/vi/{$id}/{$image}.jpg";
}



/**
 *remove wp/v2/users.
 **/
/*
add_filter( 'rest_endpoints', function( $endpoints ){
    if ( isset( $endpoints['/wp/v2/users'] ) ) {
        unset( $endpoints['/wp/v2/users'] );
    }
    if ( isset( $endpoints['/wp/v2/users/(?P<id>[\d]+)'] ) ) {
        unset( $endpoints['/wp/v2/users/(?P<id>[\d]+)'] );
    }
    return $endpoints;
});
*/
add_filter( 'rewrite_rules_array', 'removeRewriteRules' );
function removeRewriteRules($rules){
    foreach ($rules as $rule => $rewrite) {
        if ( preg_match('/(?:feed|attachment|cpage|trackback|embed|year|category_name|tag)=/',$rewrite) ) {
            unset($rules[$rule]);
        }
    }

    return $rules;
}

add_action('template_redirect',function(){
   if(!is_attachment()){
       return;
   }

   wp_redirect(home_url(),302);
});


add_filter( 'wpseo_breadcrumb_links', 'wpse_100012_override_yoast_breadcrumb_trail' );

function wpse_100012_override_yoast_breadcrumb_trail( $links ) {
    global $post;
    if(function_exists('is_checkout') && is_checkout()) {
        $breadcrumb[] = array(
            'url' => wc_get_cart_url(),
            'text' => 'עגלת קניות',
        );
    }

    array_splice( $links, 1, -2, $breadcrumb );


    return $links;
}


// Function to change email address
//todo add in setting
function wpb_sender_email( $original_email_address ) {
    return 'noreply@denikates.co.il';
}

// Function to change sender name
function wpb_sender_name( $original_email_from ) {
    return 'דניקטס';
}

// Hooking up our functions to WordPress filters
add_filter( 'wp_mail_from', 'wpb_sender_email' );
add_filter( 'wp_mail_from_name', 'wpb_sender_name' );

function getPreloader(){
    return <<<HTML
    <div class="loader">
        <span class="inner1"></span>
        <span class="inner2"></span>
        <span class="inner3"></span>
    </div>
HTML;

}