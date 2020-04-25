<?php
global $post;
$img = get_the_post_thumbnail_url($post,'banner_home_page');
?>
<?php if($img):?>
<?php //Has future image?>
<div class="slider">
    <div class="slide" style="background-image: url('<?= $img?>')">
        <img alt="" style="visibility: hidden" src="<?=$img?>"/>
        <div class="the-content">
            <?php the_content() ?>
        </div>

        <div class="arrow bounce">
            <i class="fa fa-arrow-down" aria-hidden="true"></i>
        </div>

    </div>
</div>

<?php

//If empty future image show gallery.
else:
    $name_gallery = 'slider';
    if(have_rows($name_gallery)):
?>

    <div class="main-gallery swiper-container">
        <div class="swiper-wrapper">
            <?php while ( have_rows($name_gallery) ) : the_row();
                if(get_sub_field('disabled_slide')){continue;}
                $url = get_sub_field('link_slide');
                $img = get_sub_field('img_slide')['url'];
            ?>
                <a class="swiper-slide" href="<?=$url ? $url : 'javascript:void()'?>">
                    <div class="wrap-image" style="background-image: url('<?=$img?>')">
                        <img style="visibility: hidden" src="<?=$img?>">
                    </div>
                </a>
            <?php endwhile;?>
        </div>

        <!-- Add Pagination -->
        <div class="swiper-pagination"></div>
        <!-- Add Arrows -->
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>

    </div>

    <script>
        jQuery(document).ready(function($){
            if($(".main-gallery .swiper-slide").length == 1) {
                $('.main-gallery').addClass( "disabled" );
            }

            var swiper = new Swiper('.main-gallery', {
                spaceBetween: 30,
                centeredSlides: true,
                loop:true,
                speed: 800,
                autoplay: {
                    delay: 2000,
                    disableOnInteraction: false,
                },
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                },
                navigation: {
                    nextEl: '.main-gallery .swiper-button-next',
                    prevEl: '.main-gallery .swiper-button-prev',
                },
            });


            $(".main-gallery").hover(function(){
                swiper.autoplay.stop()
             }, function(){
                swiper.autoplay.start()
            });
        });
    </script>

    <?php endif; //not images slider end if?>

<?php endif;?>
