    <?php
    $facebook_url = filter_facebook_link_to_array(get_field('top_header_icons','options'));
    ?>
    <footer class="clear-fixed">
        <div class="container">
            <?php if($facebook_url):?>
                <div class="facebook-application">
                    <a href="#" title="סגירת חלון פסבוק" class="close">
                        <i class="fa fa-times" aria-hidden="true"></i>
                    </a>
                    <div class="fb-page" data-href="<?=$facebook_url?>" data-tabs="timeline" data-width="320px" data-height="210" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true">
                        <blockquote cite="<?=$facebook_url?>" class="fb-xfbml-parse-ignore">
                            <a href="<?=$facebook_url?>">דניקטס ציוד לאפייה וחומרי גלם לאפייה באשקלון‎</a>
                        </blockquote>
                    </div>
                </div>

                <a title="פתיחת חלון פסבוק" class="share-facebook" href="#">
                    <?php
                        $str_1 = 'עקבו אחרינו ב';
                        $str_2 = 'זה שווה !'
                    ?>
                     <?=$str_1?><i class="fa fa-facebook-official" aria-hidden="true"></i>...&nbsp;<?=$str_2?>
                </a>
            <?php endif;?>
            <?php get_template_part('template-parts/c2c');?>
        </div>
    </footer>
 </div>  <!--close main wrapper-->
<?php wp_footer(); ?>
    </body>
</html>
