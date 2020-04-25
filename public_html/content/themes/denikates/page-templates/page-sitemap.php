<?php
/*
 Template Name: Site Map
 */
get_header();
?>
<main id="main_content" class="content">
    <h1><?php the_title();?></h1>
    <?php the_content();?>
    <div id="site_map">
        <div class="small-container">
            <nav>
                <?php if ( has_nav_menu( 'map_site' )){
                    wp_nav_menu( array(
                        'theme_location' => 'map_site',
                        'menu_class'     => 'site-map-links',
                        'container'=> '',
                    ));
                }
                ?>
            </nav>
        </div>
    </div>
</main>

<?php get_footer(); ?>
