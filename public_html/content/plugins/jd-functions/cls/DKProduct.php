<?php

class DKProduct{

    const POST_TYPE = 'product';


    /**
     * Initial Class Function
     * @return void
     * */
    public static function init(){
        self::registerFields();
    }



    /**
     * Register Group Fields ACF.
     * @return void
     **/
    public static function registerFields(){

        $fields = array(
            array (
                'key' => 'field_4822dsadsa',
                'label' => 'הודעה',
                'name' => 'message_product',
                'type' => 'text',
            ),

        );

        $args = array(
            'key' => 'group_5743486fab6',
            'title' => __('הודעות מוצר', ''),
            'fields' => $fields,
            'position' => 'side',
            'location' => array(array(array(
                'param' => 'post_type',
                'operator' => '==',
                'value' => self::POST_TYPE,
            ),),),
        );

        acf_add_local_field_group($args);

    }



    /**
     * add new column head to table post type admin.
     * @return array
     **/
    public static function columnsHead($defaults) {
        if(!isset($_GET['post_type']) && $_GET['post_type'] != self::POST_TYPE){
            return $defaults;
        }

        $defaults['amount'] = 'סה״כ שולם (כולל מע"ם)';
        return $defaults;
    }

    /**
     * add new column content to table post type admin.
     * @return array
     **/
    public static function columnsContent($column_name, $post_ID) {
        if ($column_name == 'amount') {
            if($field = get_field('total_payment')){
                $symbol = get_woocommerce_currency_symbol();
                echo '<span style="color:green">'.$symbol.$field.'</span>';
            }
        }
    }



    /**
     * Calculates the sum paid.
     * @return void
     **/
    public static function totalPaidUp($post_id){
        $products = get_field('list_products',$post_id);

        if(!$products){
            return;
        }

        $total = 0;
        foreach ($products as $product){
            $total =  $total + (int)$product['price_per_unit'];
        }

        update_field('total_payment',$total,$post_id);

    }





}