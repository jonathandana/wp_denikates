<?php

class DKMerchandise{

    const POST_TYPE = 'merchandise';
    const TAX_NAME = 'provider';
    const TAX_NAME_YEAR = 'year-merchandise';

    /**
     * Initial Class Function
     * @return void
     * */
    public static function init(){

        //Register cpt
        $args = array(
            'menu_icon' => 'dashicons-welcome-write-blog',
            'publicly_queryable' => false,
            'exclude_from_search'=>true,
            'has_archive' => false,
            'supports' => array('title','thumbnail')
        );
        RegisterCpt::register(self::POST_TYPE,'רישום סחורה',array(),$args);

        //Register Tax
        RegisterTaxonomies::register(self::TAX_NAME,'ספקים',self::POST_TYPE,array(),array('public'=>false));

        //Register Tax
        RegisterTaxonomies::register(self::TAX_NAME_YEAR,'שנים',self::POST_TYPE,array(),array('public'=>false));


        self::registerFields();

        add_filter('manage_posts_columns', array(__CLASS__,'columnsHead'));
        add_action('manage_posts_custom_column',array(__CLASS__,'columnsContent'), 10, 2);
        //add_action( 'save_post' , array(__CLASS__,'totalPaidUp') );


    }



    /**
     * Register Group Fields ACF.
     * @return void
     **/
    public static function registerFields(){

        $fields = array(
            array (
                'key' => 'field_588154822dsadsa',
                'label' => 'מספר חשבונית',
                'name' => 'invoice_number',
                'type' => 'text',
            ),

            array (
                'key' => 'field_57208dd87854898',
                'label' => 'רשימת מוצרים',
                'name' => 'list_products',
                'type' => 'repeater',
                'layout' => 'row',
                'button_label' => 'הסופה מוצר',
                'sub_fields' => array (
                    array(
                        'key' => 'field_591c65548251',
                        'label' => 'שם המוצר',
                        'name' => 'name_product',
                        'type' => 'text',
                    ),
                    array(
                        'key' => 'field_591c6s25548251',
                        'label' => 'מקט',
                        'name' => 'makat',
                        'type' => 'text',
                    ),
                    array(
                        'key' => 'field_591c6554845201',
                        'label' => 'כמות',
                        'name' => 'amount',
                        'instructions'=>'<span style="color:red">נא להזין מספר בילבד</span>',
                        'type' => 'number',
                    ),
                    array(
                        'key' => 'field_591c655484545781',
                        'label' => 'מחיר לפי יחידה',
                        'name' => 'price_per_unit',
                        'instructions'=>'<span style="color:red">נא להזין מספר בילבד</span>',
                        'type' => 'text',
                    ),
                    array(
                        'key' => 'field_591c65545456445781',
                        'label' => 'כמות שנמכרה',
                        'name' => 'quantity_sold',
                        'instructions'=>'<span style="color:red">נא להזין מספר בילבד</span>',
                        'type' => 'number',
                    ),
                    array(
                        'key' => 'field_591c866s65545456445781',
                        'label' => 'האם נמכר כל הכמות ?',
                        'name' => 'sold_out',
                        'instructions'=>'<span style="color:red">אם נמכר כל הכמות נא לסמן את התיבה</span>',
                        'type' => 'true_false',
                    ),


                ),
            ),


            array (
                'key' => 'field_588s022dsa548',
                'label' => 'דמי מישלוח',
                'instructions'=>'',
                'name' => 'shipping',
                'type' => 'text',
                'disabled' => 0,
            ),

            array (
                'key' => 'field_588154822dsa548',
                'label' => 'סה״כ שולם (כולל מע"ם)',
                'instructions'=>'',
                'name' => 'total_payment',
                'type' => 'number',
                'disabled' => 0,
            ),
        );

        $args = array(
            'key' => 'group_574dad51ssa86fab6',
            'title' => __('שדות', ''),
            'fields' => $fields,
            'location' => array(array(array(
                'param' => 'post_type',
                'operator' => '==',
                'value' => self::POST_TYPE,
            ),),),
        );
        acf_add_local_field_group($args);


        //side

        $fields = array(
            array (
                'key' => 'field_598dssa548',
                'label' => 'הערות',
                'instructions'=>'',
                'name' => 'remarks',
                'type' => 'textarea',
                'disabled' => 0,
            ),
        );

        $args = array(
            'key' => 'group_574343sa86fab6',
            'title' => __('שדות', ''),
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