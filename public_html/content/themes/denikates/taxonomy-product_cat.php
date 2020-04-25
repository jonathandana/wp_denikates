<?php
    $paged = get_query_var('paged') ? get_query_var('paged') : 1;
    $term = get_queried_object();
    $sub_cat = WooJDFunctions::getCategoriesWoo($term->term_id);
    $query = WooJDFunctions::getProductsQuery($term,null,$paged);
    get_header();
?>
<main class="wrap-cat-page">
    <div class="title">
        <h1><?=$term->name;?></h1>
    </div>

    <?php if(!empty($sub_cat)):?>
        <!--Sub Cat-->
        <div class="wrap-cards container">
            <?php foreach ($sub_cat as $term):?>
                <a href="<?=get_term_link($term)?>" class="card">
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
        <!--End Sub Cat-->

    <?php else:?>
        <div class="wrap-cards container product-cards">
            <?php while($query->have_posts()):$query->the_post()?>
                <?php get_template_part('template-parts/card','product');?>
            <?php endwhile;?>

            <?php wp_reset_postdata(); ?>
            <?= get_custom_pagination()?>
        </div>
<?php endif;?>
</main>
<?php get_footer(); ?>
