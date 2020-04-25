<div class="top-bar-mobile jd-mobile">
    <div id="nav_icon">
        <span></span>
        <span></span>
        <span></span>
    </div>

    <a href="#" class="open-search">
        <i class="fa fa-search" aria-hidden="true"></i>
    </a>

    <?php get_template_part('template-parts/logo');?>
</div>

<?php
if(has_nav_menu('main_menu')):?>
    <nav id="menu_mobile" class="jd-mobile">
        <ul class="wrap-user-items">
            <li><?= SLTemplates::getLoginHtml()?>
        </ul>
        <?php
            wp_nav_menu(array(
                'theme_location'=>'main_menu',
                'menu_class'=>'main-menu',
                'container_id' =>''
            ));
        ?>
        <ul class="wrap-logout">
            <?php if(is_user_logged_in()):?>
                <li><a href="<?php echo wp_logout_url( get_permalink() );?>">התנתק</a></li>
            <?php endif;?>
        </ul>
    </nav>
<?php endif;?>