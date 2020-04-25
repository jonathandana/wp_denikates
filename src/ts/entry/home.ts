import {SimpleFunctions} from '../cls/SimpleFunctions';

const $ = jQuery;
const $product_link = $('.product > a');
const $section_cat = $('.section-cat');



SimpleFunctions.detectIsMobile();
initSwiperCat();

SimpleFunctions.scrollToMyElement($product_link,$section_cat);

if(location.hash == '#product'){
    $product_link.trigger('click');
}





function initSwiperCat(){
    // TODO create response slider.
    if(SimpleFunctions.isMobile) {
        //General Options.
        let options:any = {
            pagination: {
                el: '.section-cat .swiper-pagination',
                clickable: true,
            },
            effect: 'coverflow',
            grabCursor: true,
            centeredSlides: true,
            loop: true,
            slidesPerView: 'auto',
            simulateTouch:true,
             coverflow: {
                 rotate: 50,
                 stretch: 0,
                 depth: 100,
                 modifier: 1,
                 slideShadows: true
             }
         };

        let swiperCat = new Swiper('.section-cat .swiper-container',options);

        options.pagination.el = '.product-cards .swiper-pagination';
        let swiperProducts = new Swiper('.product-cards .swiper-container',options);


    }

    //setTimeout(()=>{window.swiperCat.destroy(true,true)},10);





}
