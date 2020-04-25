<?php if($phone = get_field('phone','options')):?>
    <div class="wrap-info">
        <a class="c2c" href="tel:<?=$phone?>">חייגו עכשיו: <?=$phone?></a>
    </div>
<?php endif; ?>