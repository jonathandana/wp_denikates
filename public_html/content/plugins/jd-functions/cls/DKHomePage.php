<?php

class DKHomePage{

    const TEMPLATE_NAME = 'page-templates/page-homepage.php';

    /**
     * Initial Class Function
     * @return void
     * */
    public static function init(){
        if(!class_exists('WooJDFunctions')){
            return;
        }

        self::registerFields();
    }


    /**
     * Register Group Fields ACF
     * @return void
     * */
    public static function registerFields(){
        $fields = array();
        $fields = array_merge($fields,self::_tabGallery());
        $fields = array_merge($fields,self::_tabCatArea());
        $fields = array_merge($fields,self::_tabProductPopular());

        $args = array(
            'key' => 'group_574dad51sfab6',
            'title' => __('אפשרויות', ''),
            'fields' => $fields,
            'location' => array(array(array(
                'param' => 'page_template',
                'operator' => '==',
                'value' => self::TEMPLATE_NAME,
            ),),),
        );
        acf_add_local_field_group($args);
    }

    /**
     * Create tab for Plugins ACF
     * @return array
     * */
    protected static function _tabCatArea(){

        $tab_name = 'איזור קטגוריות מוצרים';

        $tab = array(
            array (
                'key' => 'field_5asd85d4f39946c',
                'label' => $tab_name,
                'type' => 'tab',
                'placement' => 'top',
                'endpoint' => 0,
            ),

            array (
                'key' => 'field_588dsadsa',
                'label' => 'כותרת',
                'name' => 'title_cat_area',
                'type' => 'text',
            ),



        );

        return $tab;

    }

    /**
     * Create tab for Plugins ACF
     * @return array
     * */
    protected static function _tabProductPopular(){

        $tab_name = 'מוצרים פופולרים';

        $tab = array(
            array (
                'key' => 'field_5asd85dsa3346c',
                'label' => $tab_name,
                'type' => 'tab',
                'placement' => 'top',
                'endpoint' => 0,
            ),

            array (
                'key' => 'field_58sassdfdsa',
                'label' => 'כותרת',
                'name' => 'title_prod_popular',
                'type' => 'text',
            ),

            array (
                'key' => 'field_58f28e49e9b3f',
                'label' => 'מוצרים פופלרים',
                'name' => 'products_popular',
                'type' => 'relationship',
                'instructions' => 'ניתן לבחור מוצרים פופולרים',
                'conditional_logic' => 0,
                'post_type' => array (
                    0 => WooJDFunctions::POST_TYPE,
                ),
                'taxonomy' => self::_generateArrayCat(),
                'filters' => array (
                    0 => 'search',
                    1 => 'post_type',
                    2 => 'taxonomy',
                ),

                'return_format' => 'object',
            ),




        );

        return $tab;

    }


    /**
     * Create tab for Plugins ACF
     * @return array
     * */
    protected static function _tabGallery(){

        $tab_name = 'גלריה';

        $tab = array(
            array (
                'key' => 'field_d85dsa3346c',
                'label' => $tab_name,
                'type' => 'tab',
                'placement' => 'top',
                'endpoint' => 0,
            ),

            array (
                'key' => 'field_57208dd898',
                'label' => 'תמונות גלריה',
                'name' => 'slider',
                'type' => 'repeater',
                'layout' => 'row',
                'button_label' => 'הוספת תמונה',
                'sub_fields' => array (
                    array(
                        'key' => 'field_5921365548251',
                        'label' => 'תמונה',
                        'name' => 'img_slide',
                        'type' => 'image',
                    ),
                    array(
                        'key' => 'field_5965548251',
                        'label' => 'קישור',
                        'name' => 'link_slide',
                        'type' => 'url',
                    ),
                    array(
                        'key' => 'field_5965ds',
                        'label' => 'לא פעיל',
                        'name' => 'disabled_slide',
                        'type' => 'true_false',
                    ),
                ),
            ),



        );

        return $tab;

    }

    /**
     * Create array categories for ACF field Relation Ship
     * @return array
     * */
    private static function _generateArrayCat(){
        $data = array();

        foreach (WooJDFunctions::getCategoriesWoo() as $cat){
            $data[] = WooJDFunctions::WOO_CAT.':'.$cat->slug;
        }

        return $data;
    }

}