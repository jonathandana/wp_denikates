<?php
/*
 Template Name: Development
 */
    if(!is_user_logged_in()){
        die('try again');
    }
    $query = WooJDFunctions::getProductsQuery(null,-1);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="robots" content="noindex,follow">
    <title>development</title>
    <style>
        body{padding: 20px;direction: rtl;text-align: right}
        a{direction: ltr;display: block;}
    </style>
</head>
<body>
    <main id="main_content" class="container">
        <?php while($query->have_posts() && false): $query->the_post();

            $product = wc_get_product(get_the_ID());
            $price = $product->get_regular_price(get_the_ID());
            if($price != ''){continue;}
            ?>
            <?php the_title()?><br>
            <a href="<?php the_permalink()?>"><?=urldecode_deep(get_the_permalink())?></a><br>
            <div class="">

                <?php

                $css= $price == '' ? 'style="color:red"' : '';
                ?>
                <span <?=$css?>>מחיר:</span>
                <span><?=$price?></span>
            </div>
            <hr>

        <?php endwhile;?>

    <?php while($query->have_posts()): $query->the_post();?>
        <?php if(has_post_thumbnail()){continue;} ?>
        <?php the_title()?><br>
        <a href="<?php the_permalink()?>"><?=urldecode_deep(get_the_permalink())?></a><br>
        <hr>
    <?php endwhile;?>

    </main>
</body>
</html>


