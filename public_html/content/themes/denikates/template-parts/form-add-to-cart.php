<?php
$product_id = get_the_ID();
$product = wc_get_product($product_id);
$sale_price = $product->get_sale_price();
$price = $product->get_regular_price($product_id);
$class_css = !$sale_price ? '' : 'has-sale-price';
$symbol = get_woocommerce_currency_symbol();
if(!$price){
   return;
}
?>

<div class="wrap-data-prod <?=$class_css?>">
    <div class="wrap-price">
        <div class="price">מחיר <?= $symbol.$price?></div>
        <?php if($sale_price):?>
            <div class="sale-price">מחיר מבצע <?=$symbol.$sale_price?></div>
        <?php endif;?>
    </div>

    <form class="add-to-cart" method="post" action="/<?=WooJDConfig::$routeAddProductToCart?>" novalidate>
        <input type="hidden" name="product_id" value="<?=get_the_ID();?>"/>
        <input aria-label="כמות" placeholder="כמות" class="quantity" type="number" name="quantity" min="1"/>
        <input class='submit' type="submit" value="הוסף לסל">
    </form>

</div>