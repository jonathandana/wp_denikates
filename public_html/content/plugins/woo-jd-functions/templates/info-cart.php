<?php defined('ABSPATH') or die();

$wc = WC();
$symbol = get_woocommerce_currency_symbol();
$items_cart = $wc->cart->get_cart();

if(count($items_cart)):?>
    <div class="info-cart">
        <a class="btn cart-url" href="<?=wc_get_cart_url()?>">עבור אל עגלת קניות</a>
        <div class="list-product">
            <ul>
                <?php foreach($items_cart as $item => $values):
                    $_product = $values['data']->post;
                    $price = get_post_meta($values['product_id'] , '_price', true);
                    ?>
                    <li>
                        <div class="wrap-info">
                            <a data-product-id="<?=$values['product_id']?>" data-product-item="<?=$item?>" href="<?=wc_get_cart_url()?>" class="remove-product">
                                <i class="fa fa-times" aria-hidden="true"></i>
                            </a>
                            <a href="<?=get_permalink($values['product_id'])?>" class="title-prod"><?=$_product->post_title?></a>
                            <div class="amount-product"><?=$symbol.$price?><strong>x</strong><?=$values['quantity']?></div>
                        </div>
                        <?php get_template_part('template-parts/preloader','cards')?>
                    </li>
                <?php endforeach;?>

                <li class="total-amount">סה״כ <span><?=$wc->cart->get_cart_total(); ?></span></li>
            </ul>
        </div>
        <a href="<?=wc_get_checkout_url()?>" class="btn">הזמן עכשיו</a>
    </div>
<?php endif;?>
