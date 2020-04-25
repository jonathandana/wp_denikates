<?php
$term  = wp_get_post_terms(get_the_ID(), WooJDFunctions::WOO_CAT)[0];
$query = WooJDFunctions::getProductsQuery($term,4,1,'rand');
$product_id = get_the_ID();
$product = wc_get_product($product_id);
$in_stock = $product->is_in_stock();
$class = $in_stock ? 'in-stock' : 'out-stock';
get_header();
?>
<div class="product-page <?=$class?>">
    <div class="wrap-product container">

        <div class="clear-fixed">
            <div class="wrap-thumb">
                <?php the_post_thumbnail('product')?>
            </div>
            <div class="the-content">
                <h1><?php the_title();?></h1>
                <?php the_content()?>

                <?php if($in_stock):?>
                    <div class="form-add-to-cart-page">
                        <?php get_template_part('template-parts/form','add-to-cart');?>
                        <?php get_template_part('template-parts/preloader','cards');?>
                    </div>
                <?php else:?>
                    <div class="message-stock">אזל המלאי</div>
                <?php endif;?>

                <?php if($message = get_field('message_product')):?>
                    <div class="custom-message-product">
                        <span>*</span><?=$message?>
                    </div>
                <?php endif;?>
            </div>
        </div>


        <div class="wrap-relation-products">
            <h2>מוצרים נוספים שיכולים לעניין אותך...</h2>
            <div class="wrap-cards product-cards">
                <?php while($query->have_posts()):$query->the_post()?>
                    <?php get_template_part('template-parts/card','product');?>
                <?php endwhile;?>
            </div>
        </div>

    </div>
</div>
<?php get_footer();?>
