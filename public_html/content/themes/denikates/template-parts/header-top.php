<div id="top_header" class="clear-fixed jd-desktop">
    <div class="container">
        <?php if(have_rows('top_header_icons','options') ):?>
            <div class="wrap-social-icons">
                <ul>
                    <li class="wrap-accessibility">
                        <a href="#">
                            <i class="fa fa-wheelchair" aria-hidden="true"></i>
                        </a>
                        <?php get_template_part('template-parts/widget','accessibility');?>
                    </li>
                    <?php while ( have_rows('top_header_icons','options') ) : the_row();?>
                        <?php if($link = get_sub_field('icon_url','options')):?>
                            <li>
                                <a target="_blank" href="<?=esc_url($link)?>">
                                    <?php if($icon = get_sub_field('icon_class','options')):?>
                                        <i class="fa <?=$icon?>" aria-hidden="true"></i>
                                    <?php endif;?>
                                </a>
                            </li>
                        <?php endif;?>
                    <?php endwhile;?>
                    <?php get_template_part('template-parts/header','inline-list');?>

                    <?php if(is_user_logged_in()):?>
                        <li>
                            <a href="<?php echo wp_logout_url( get_permalink() );?>">התנתק</a>
                        </li>
                    <?php endif;?>
                </ul>
            </div>
        <?php endif;?>
        
        <?= SLTemplates::getLoginHtml();?>

        <?php get_template_part('template-parts/c2c');?>
    </div>
</div>
