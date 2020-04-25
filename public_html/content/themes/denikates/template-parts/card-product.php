<?php
$class = get_query_var('class');

$product_id = get_the_ID();
$product = wc_get_product($product_id);
$in_stock = $product->is_in_stock();
$class_stock = $in_stock ? 'in-stock' : 'out-stock';
?>
<div class="card <?=$class?> <?=$class_stock?>">
    <?php if(!$in_stock):?>
        <div class="message-stock">אזל המלאי</div>
    <?php endif;?>

    <?php if($message = get_field('message_product')):?>
        <div class="custom-message-product">
            <span>*</span><?=$message?>
        </div>
    <?php endif;?>

    <div class="inner">
        <a title="מעבר לעמוד מוצר" href="<?=esc_url(get_the_permalink())?>">

            <div class="inner-thumb" style="background-image: url('<?=get_img_product(get_the_ID())?>')">
            </div>

            <div class="info-card">
                <div class="title">
                    <?php the_title();?>
                </div>
            </div>
        </a>
        <?php get_template_part('template-parts/form','add-to-cart')?>
    </div>
    <?php get_template_part('template-parts/preloader','cards')?>
</div>

