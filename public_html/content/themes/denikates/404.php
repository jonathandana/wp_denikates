<?php get_header(); ?>

<main class="error-page">
    <div class="min-container">
        <p> אופס, העמוד לא נמצא.<br> ניתן לפנות אלינו דרך <a href="<?= get_field('contactus_url','option')?>">הצור קשר</a>
        <br>
 או לחזור <a href="<?= home_url()?>">לעמוד הבית</a></p>
    </div>
</main>

<?php get_footer(); ?>
