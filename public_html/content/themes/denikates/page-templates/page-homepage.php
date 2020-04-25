<?php
/*
 Template Name: Home Page
 */
get_header();
    echo'<main class="home-page">';
        get_template_part('template-parts/homepage','slider');
        echo '<a tabindex="-1" href="javascript:void(0)" id="scontent"></a>';

        get_template_part('template-parts/homepage','section-cat');
        get_template_part('template-parts/homepage','products-popular');
    echo '</main>';
get_footer();




