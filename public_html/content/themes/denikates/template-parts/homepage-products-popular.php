<?php
$posts = get_field('products_popular');
if($posts):
?>
    <div class="jd-home-slider">
        <div class="wrap-cards container product-cards">
            <?php if($title = get_field('title_prod_popular')):?>
                <div class="title">
                    <h2><?=$title?></h2>
                </div>
            <?php endif;?>
            <div class="swiper-container">
                <div class="swiper-wrapper">

                <?php
                 foreach( $posts as $post){
                    setup_postdata($post);
                    set_query_var('class','swiper-slide');
                    get_template_part('template-parts/card','product');

                 }
                ?>
                </div>
                <!-- Add Pagination -->
                <div class="swiper-pagination"></div>
            </div>
        </div>
    </div>
<?php endif;?>
