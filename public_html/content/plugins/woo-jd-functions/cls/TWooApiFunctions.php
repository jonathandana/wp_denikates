<?php
trait TWooApiFunctions{

    /**
     *Insert product to cart Rest Api;
     * */
    public static function insertProductToCart(WP_REST_Request $request){
        try{
            $wc = WC();
            $quantity   = (int)$request->get_param('quantity');
            $product_id = (int)$request->get_param('product_id');

            if(!$quantity || !$product_id  || !is_int($quantity) || !is_int($product_id)){
                throw new Exception('invalid');
            }

            if(!$wc->cart->add_to_cart($product_id, $quantity )){
                throw new Exception('Not insert in the cart');
            }

            ob_start();
            include WOO_JD_DIR.'/templates/info-cart.php';
            $content = ob_get_contents();
            ob_clean();

            $response = array(
                'get_cart_contents_count' => $wc->cart->get_cart_contents_count(),
                'get_content'             => $content,
            );

            return new WP_REST_Response($response);

        }catch (Exception $error){
            return new WP_REST_Response($error->getMessage(),400);
        }


    }

    /**
     * Get data cart.
     * */
    public static function getDataCart(){
        $wc = WC();

        ob_start();
            include WOO_JD_DIR.'/templates/info-cart.php';
            $content = ob_get_contents();
        ob_clean();

        $response = array(
            'get_cart_contents_count' => $wc->cart->get_cart_contents_count(),
            'get_content'             => $content,
        );

        return new WP_REST_Response($response,200,array('Cache-Control'=>'no-cache, must-revalidate, max-age=0'));
    }


    /**
     * Rest api remove product form cart
     * */
    public static function removeProductFromCart(WP_REST_Request $request){
        try{
            $wc = WC();

            $product_id = (int)$request->get_param('product_id');
            $cart_item_key = $request->get_param('cart_item_key');

            if(!$product_id || !is_int($product_id) || !$cart_item_key){
                throw new Exception('invalid');
            }

            $wc->cart->remove_cart_item($product_id);
            $wc->cart->remove_cart_item($cart_item_key);

            $respose = array(
                'get_cart_contents_count' => $wc->cart->get_cart_contents_count(),
                'get_cart_total' =>$wc->cart->get_cart_total(),
            );

            return new WP_REST_Response($respose);


        }catch (Exception $error){
            return new WP_REST_Response($error->getMessage(),400);
        }
    }

}