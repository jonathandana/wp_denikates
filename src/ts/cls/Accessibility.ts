import {SimpleFunctions} from "./SimpleFunctions";
const $ = jQuery;

export class Accessibility{

    protected static options:Array<string> = [
        'contrast',
        'font-normal',
        'font-medium',
        'font-large',
        'mark-links',
        'mark-heading',
        'font-readable',
        'big-cursor',
    ];

    public static init(){
        this.listenerClick();
        this.listenerOpenMenuAccessibility();
        this.insertOptionFromlocalStorage();
        this.offAccessibility();

        //function skip to content
        let $skip_to_content = $('.skip-to-content');
        let $scontent = $('#scontent');

        SimpleFunctions.scrollToMyElement($skip_to_content,$scontent,()=>{
            this.closeAccessibilityMenu();
            $scontent.focus();
        });

        $('.close-menu-accessibility').click(this.closeAccessibilityMenu);

    }

    /**
     * trigger click menu accessibility.
     * @return void
     **/
    public static closeAccessibilityMenu():void{
        $('.wrap-accessibility > a').trigger('click');
    }

    /**
     * listener click, open and close menu accessibility.
     * @return void
     **/
    public static listenerOpenMenuAccessibility():void{
        $('.wrap-accessibility > a').click((e)=>{
            e.preventDefault();
            $('.widget-accessibility').slideToggle();

        });
    }

    /**
     * listener click options accessibility and
     * add class body and insert localStorage.
     * @return void
     **/
    protected static listenerClick():void{
        $('.btn-aw').click((e)=>{
            const $self = $(e.currentTarget);
            const $top_parent = $self.closest('li');
            const type_aw = $self.data('aw');

            // call functions font size.
            const font_sizes:Array<string> = ['font-normal','font-medium','font-large'];
            if($.inArray(type_aw,font_sizes)!== -1){
               this.fontSizeFunc($top_parent, type_aw, font_sizes)
                return true;
            }

            //call function remove option and return.
            if($top_parent.hasClass('active')){
                this.optionOff($top_parent, type_aw);
                return true;
            }

            $top_parent.addClass('active');
            localStorage.setItem(type_aw,type_aw);
            $('body').addClass(type_aw);

        });
    }


    /**
     * listener click off accessibility and
     * remove class body and remove localStorage.
     * @return void
     **/
    protected static offAccessibility():void{
        $('.off-accessibility').click(()=>{
            for(let option of this.options){
                this.optionOff($('[data-aw='+option+']').closest('li'),option);
            }
            this.closeAccessibilityMenu();
        });
    }


    /**
     * listener click options accessibility and
     * remove class body and remove localStorage.
     * @param $top_parent:JQuery.
     * @param type_aw:string.
     * @return void
     **/
    protected static optionOff($top_parent:JQuery , type_aw:string):void{
        $top_parent.removeClass('active');
        $('body').removeClass(type_aw);
        localStorage.removeItem(type_aw);
    }


    /**
     * listener options to document ready
     * add class body.
     * @return void
     **/
    protected static insertOptionFromlocalStorage():void{
        for(let option of this.options){
            let item = localStorage.getItem(option);

            if(item){
                $('body').addClass(item);
                $('[data-aw='+item+']').closest('li').addClass('active');
            }
        }
    }

    /**
     * function font size
     * @param $top_parent
     * @param type_aw
     * @param font_sizes
     * @return void
     **/
    protected static fontSizeFunc($top_parent:JQuery, type_aw:string , font_sizes:Array<string>):void{
        //reset
        $('.li-font-size .active').removeClass('active');
        for(let option of font_sizes){
            this.optionOff($('[data-aw='+option+']').closest('li'),option);
        }

        $top_parent.addClass('active');
        localStorage.setItem(type_aw,type_aw);
        $('body').addClass(type_aw);
    }

}
