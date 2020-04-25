<?php
global $wp_query;
get_header();
?>

<div class="search-page">

    <?php if(have_posts()): ?>
        <div class="min-container">
            <div class="title">
                <h1> תוצאות חיפוש עבור: <span>"<?=get_search_query();?>"</span></h1>
                <p>נימצאו <?=$wp_query->found_posts;?> תוצאות </p>
            </div>
        </div>

        <div class="wrap-result min-container">
            <?php while(have_posts()): the_post();
                $title = get_the_title();
            ?>
                <div class="result clear-fixed">
                    <div class="thumb">
                        <a title="עבוד לעמוד <?=$title?>" href="<?=esc_url(get_the_permalink())?>">
                            <img alt="" src="<?= get_img_product(get_the_ID())?>"/>
                        </a>
                    </div>

                    <div class="info">
                        <div class="title">
                            <a title="עבוד לעמוד <?=$title?>" href="<?=esc_url(get_the_permalink())?>">
                                <h2><?=$title?></h2>
                            </a>
                        </div>
                        <div class="expert">
                            <?php the_excerpt();?>
                        </div>
                        <a title="עבוד לעמוד <?=$title?>" href="<?=esc_url(get_the_permalink())?>">קרא עוד</a>
                    </div>

                </div>
            <?php endwhile;?>
        </div>

        <?= get_custom_pagination(); ?>

    <?php else:?>
        <div class="container">
            <div class="title">
                <h1>לא נמצאו תוצאות חיפוש</h1>
            </div>
        </div>
    <?php endif;?>

</div>

<?php get_footer(); ?>
