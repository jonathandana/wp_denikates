<?php
class WooAfterOrder{

    public static function init(){
        add_action( 'woocommerce_thankyou',array(__CLASS__,'afterOrder'));

    }

    public static function afterOrder($order_id){
        $order = wc_get_order($order_id);
        $order->update_status('processing');
    }

}