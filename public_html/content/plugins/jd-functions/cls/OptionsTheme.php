<?php
class OptionsTheme {

    public static $top_sulg = 'global_options';
    public static $title_global_option = 'אפשרויות תבנית';



    /**
     * Initial Class Function
     * @return void
     * */
    public static function init(){
        self::_globalOptions();
        self::_addOptionsField();
        add_action( 'admin_bar_menu',  array(__CLASS__,'addOptionLinkToAdimBar'), 999 );

    }

    /**
     * Add Text Link options theme to admin bar wordpress.
     * @return void
     * */
    public static function addOptionLinkToAdimBar( $wp_admin_bar ) {
        $args = array(
             'id'    => 'options',
             'title' => self::$title_global_option,
             'href'  => admin_url('admin.php?page=').self::$top_sulg,
             'meta'  => array( 'class' => 'option-theme')
         );
         $wp_admin_bar->add_node( $args );
   }

    /**
    * Add Admin Page to admin wordpress (ACF)
    * @return void
    * */
    private static function _globalOptions(){
      acf_add_options_page(array('page_title'=>self::$title_global_option,'menu_slug' => self::$top_sulg,'redirect'=>false));
    }

    /**
     * Register Group Fields ACF
     * @return void
     * */
    private static function _addOptionsField(){
        $fields = array();
        $fields = array_merge($fields,self::tabGeneral());
        $fields = array_merge($fields,self::tabIcons());

         $args = array(
            'key' => 'group_574bebd51fab6',
            'title' => __('אפשרויות', ''),
            'fields' => $fields,
            'location' => array(array(array(
                'param' => 'options_page',
                'operator' => '==',
                'value' => self::$top_sulg,
            ),),),
        );
        acf_add_local_field_group($args);
    }


    /**
     * Create tab for Plugins ACF
     * @return array
     * */
    private static function tabGeneral(){

        $tab_name = 'כללי';

        $tab = array(
            array (
                'key' => 'field_588ds5d4f39946c',
                'label' => $tab_name,
                'type' => 'tab',
                'placement' => 'top',
                'endpoint' => 0,
            ),
            array(
                'key' => 'field_574bebd4acad8',
                'name' => 'logo',
                'label' => __('לוגו', ''),
                'type' => 'image',
                'preview_size' => 'medium',
                'return_format' => 'array',
            ),

            array(
                'key' => 'field_1ds2asdfr34dy37',
                'name' => 'phone',
                'label' => __('מספר טלפון', ''),
                'type' => 'text',
            ),

            array (
                'key' => 'field_5913fdc30edf4',
                'label' => 'עמוד צור קשר',
                'name' => 'contactus_url',
                'type' => 'page_link',
                'post_type' => array ('page'),
            ),

            array (
                'key' => 'field_59s13fdcdsdf4',
                'label' => 'הצהרת נגישות',
                'name' => 'negishut_url',
                'type' => 'page_link',
                'post_type' => array ('page'),
            ),


        );

        return $tab;

    }


    /**
     * Create tab for Plugins ACF
     * @return array
     * */
    private static function tabIcons(){

        $tab_name = 'חלק עליון';
        $url_awesome = 'http://fontawesome.io/icons/';

        $tab = array(
            array (
                'key' => 'field_5885d4f39946c',
                'label' => $tab_name,
                'type' => 'tab',
                'placement' => 'top',
                'endpoint' => 0,
            ),

            array (
                'key' => 'field_5885e9Dasdas',
                'label' => 'אייקונים',
                'name' => 'top_header_icons',
                'type' => 'repeater',
                'layout' => 'table',
                'button_label' => 'הוסף אייקון',
                'sub_fields' => array (

                    array(
                        'key' => 'field_dsajkdhsa7',
                        'name' => 'icon_class',
                        'label' => __('אייקון', ''),
                        'type' => 'text',
                        'instructions'=>'Add please name class css from font awesome <a target="_blank" href="'.$url_awesome.'">click here</a>',
                    ),

                    array(
                        'key' => 'field_12asdDsdsajkdhsa7',
                        'name' => 'icon_url',
                        'label' => __('קישור', ''),
                        'type' => 'url',
                    ),

                )
            ),



        );

        return $tab;

    }




    public static function alertNeedAcf(){
        echo '<div style="padding: 22px 12px;" class="error notice">Alert you need plugins acf pro</div>';
    }

}
