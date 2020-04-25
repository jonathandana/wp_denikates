<div class="sticky-main-menu">
    <div class="container">
        <?php get_template_part('template-parts/c2c');?>
        <div class="sticky-wrap-main-menu">
            <?php
            if(has_nav_menu('main_menu')):?>
                <nav>
                    <?php
                    wp_nav_menu(array(
                        'theme_location'=>'main_menu',
                        'menu_class'=>'main-menu',
                        'container_id' =>''
                    ));
                    ?>

                </nav>
            <?php endif;?>
            <?= SLTemplates::getLoginHtml();?>
        </div>
        <?php get_template_part('template-parts/logo');?>


    </div>

</div>