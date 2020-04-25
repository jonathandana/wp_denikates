const $ =  jQuery;

export class SimpleFunctions{

    protected static $:JQueryStatic = jQuery;
    protected static mobileWidth:string = '768px';

    public static isMobile:boolean;


    /**
     * init function.
     * @return void
     * */
    public static init(){
        this.detectIsMobile();
        this.openPopupFacebook();
        this.listenerMainMenu();
        this.listenerResize();
        this.openMenuMobile();
        this.sameheightCard();
        this.listenerSubMenuMobile();

    }

    /**
     *Function Open Facebook Application.
     *@return void
     * */
    public static openPopupFacebook():void{
        const $ =  this.$;
        const $facebook_popup = $('.facebook-application');
        $('.share-facebook').click((e)=>{
            e.preventDefault();
            this.showOverlay();
            $facebook_popup.fadeIn();
        });

        $('.facebook-application .close').click((e)=>{
            e.preventDefault();
            this.showOverlay(false);
            $facebook_popup.fadeOut();
        });

    }

    /**
     *Function Open Overlay.
     * @param on boolean
     * @return void
     * */
    public static showOverlay (on:boolean = true):void{
        const $ =  this.$;
        const $overlay = $('.overlay');

        if(on){
            $overlay.fadeIn();
        }else {
            $overlay.fadeOut();
        }

    }

    /**
     *Function scroll animation to element.
     * @param elemClick jQuery elem
     * @param elemScroll jQuery elem
     * @return void
     * */
    public static scrollToMyElement(elemClick:JQuery , elemScroll:JQuery , cb:Function = null):void{

        const $ =  this.$;
        const menu = $('.sticky-main-menu').outerHeight()+20;
        elemClick.click((e)=>{

            e.preventDefault();
            $('html, body').animate({
                scrollTop : elemScroll.offset().top-menu
            }, 1000);

            this.closeMenuMobile();

            if(cb){
                cb();
            }

        });


    }

    /**
     *  Listener Event scroll and add main menu sticky.
     *
     * @return void
     * */
    protected static listenerMainMenu():void{
        const $ =  this.$;
        const mainMenuHeight = $('#main_menu').outerHeight();
        
        let $location_nav =$('#main_menu').offset().top+mainMenuHeight;
        $(window).scroll(()=> {
            let $location_window =$(window).scrollTop();

            if($location_window > $location_nav){
                $('.sticky-main-menu').addClass('open');
            }else{
                $('.sticky-main-menu').removeClass('open');
            }
        });

    }

    /**
     *Listener open menu mobile.
     *@return void | boolean
     * */
    protected static openMenuMobile(){
        const $ =  this.$;
        $('#nav_icon').click((e)=>{
            if(!this.isMobile){
                return false;
            }

            if($('.search-form').hasClass('open')){
                this.switchSearchArea();
            }

            $('#nav_icon , #menu_mobile').toggleClass('open');
        });
    }

    /**
     * Open and close search area.
     * @return void | boolean
     * */
    public static switchSearchArea(){
        const $search_form = $('.search-form');
        const $menu_mobile = $('#menu_mobile');

        $search_form.slideToggle();
        $search_form.toggleClass('open');

        //is menu mobile open.
        if($menu_mobile.hasClass('open')){
            SimpleFunctions.closeMenuMobile();
        }

        //is open.
        if($search_form.hasClass('open')){
            $('html, body').animate({
                scrollTop : $search_form.offset().top
            }, 1000);

            $search_form.find('#form_search').focus();
        }
    }


    /**
     *Listener close menu mobile.
     *@return void | false bolean.
     * */
    public static closeMenuMobile(){
        const $ =  this.$;
        let mobileSelector = $('#nav_icon , #menu_mobile');

        if(!(mobileSelector.hasClass('open'))){
            return false;
        }

        mobileSelector.removeClass('open')
    }

    /**
     * Listener Sub menu mobile and add btn element to dom.
     * @return void.
     * */
    protected static listenerSubMenuMobile(){
        if(!this.isMobile){
            return;
        }

        $('#menu_mobile .menu-item-has-children').prepend('<div class="btn-sub-menu"></div>');

        $('#menu_mobile .btn-sub-menu').click((e)=>{
            let $self = $(e.currentTarget);
            let $top_parent = $self.closest('.menu-item-has-children');
            let $sub_menu = $top_parent.find('.sub-menu');
            $top_parent.toggleClass('open');
            $sub_menu.slideToggle();

        })
    }


    /**
     * Listener media queries screen.
     * @return void.
     * */
    public static detectIsMobile(){
        this.isMobile = window.matchMedia("(max-width:"+this.mobileWidth+")").matches;

    }

    /**
     * Listener Resize event.
     * @param cb Function default value null.
     * @return void.
     * */
    public static listenerResize(cb:Function = null){
        const $ = this.$;

        $(window).resize(()=>{
            this.detectIsMobile();
            this.sameheightCard();

            if (cb){
                cb();
            }


        });
    }

    public static onlyLetters(e) {
        let charCode = (e.which) ? e.which : e.keyCode;
        return charCode > 31 && (charCode < 48 || charCode > 57);
    }

    private static sameheightCard():void{
        const $ =  this.$;
        const $top_selector = $('.wrap-cards.product-cards');
        const $card = $top_selector.find('.card');
        const $title = $card.find('.title');
        const $wrap_price = $card.find('.wrap-price');

        let title_heigth = 0;
        let wrap_price_heigth = 0;

        $card.each((index,elem)=>{
            const $elem_title_height = $(elem).find('.title').height();
            const $wrap_price_height = $(elem).find('.wrap-price').height();

            if(title_heigth < $elem_title_height){
                title_heigth = $elem_title_height;
            }

            if(wrap_price_heigth < $wrap_price_height){
                wrap_price_heigth = $wrap_price_height;
            }
        });

        //result function
        $title.css({
            minHeight:title_heigth
        });

        $wrap_price.css({
            minHeight:wrap_price_heigth
        });



    }



    static calculatePopup(){
        const $ =  this.$;
        const $popups = $('.popup-auto-height:visible');
        const window_height = $(window).outerHeight();

        $popups.each(function(){
            const $popup = $(this);

            $popup.css('height','inherit');
            const popup_height  = $popup.outerHeight();
            let popup_position  = $popup.position().top;

            if(0 > popup_position){
                popup_position = 0;
            }

            if(popup_height+popup_position > window_height){
                $popup.css('height',window_height-popup_position+'px');
            }

        });
    }

}
