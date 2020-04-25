<div class="section-cat">
    <?php if($title = get_field('title_cat_area')):?>
        <h2><?=$title?></h2>
    <?php endif;?>

    <div class="jd-home-slider swiper-container">
        <div class="wrap-cards container swiper-wrapper">
            <?php foreach (WooJDFunctions::getCategoriesWoo(0) as $term):?>
                <a href="<?=get_term_link($term)?>" class="card swiper-slide">
                    <?php
                    $image_cat = wp_get_attachment_url(get_term_meta($term->term_id, 'thumbnail_id', true));
                    $image = $image_cat ? $image_cat : THEME_URI.'/view/images/default-img.jpg';
                    ?>


                    <div class="inner-thumb" style="background-image: url('<?=$image?>')">
                    </div>

                   <div class="info-card">
                        <div class="title">
                            <?=$term->name?>
                        </div>
                   </div>

                </a>
            <?php endforeach;?>
        </div>
        <!-- Add Pagination -->
        <div class="swiper-pagination"></div>
    </div>
</div>