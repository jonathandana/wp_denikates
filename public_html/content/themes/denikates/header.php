<!DOCTYPE html>
<?php
$gtm_arr = array('GTM-W8N24KV');
?>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=yes" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="theme-color" content="#e8a7b7">

	<?php wp_head(); ?>

    <?php foreach ($gtm_arr as $gtm):?>
        <!-- Google Tag Manager -->
        <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
                new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
                j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
                'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
            })(window,document,'script','dataLayer','<?=$gtm?>');
        </script>
    <?php endforeach;?>
    <!-- End Google Tag Manager -->

    <?php if(!is_user_logged_in()):?>
        <style>html {visibility:hidden }</style>
        <script>
            if (self == top) {
                document.documentElement.style.visibility = 'visible';
            }else {
                top.location = self.location;
            }
        </script>
    <?php endif;?>

</head>

<body <?php body_class(); ?>>

<?php foreach ($gtm_arr as $gtm):?>
    <noscript>
        <iframe src="https://www.googletagmanager.com/ns.html?id=<?=$gtm?>" height="0" width="0" style="display:none;visibility:hidden"></iframe>
    </noscript>
<?php endforeach;?>

<?= SLTemplates::getPopupLoginHtml(); ?>
<div class="overlay"></div>
<?php
    if(!has_dependencies_cls()){
        get_footer();
        die('check your plugins');
    }

    get_template_part('template-parts/preloader','site');
?>
    <?php echo do_shortcode('[JDShopCart]');?>

    <div id="fb-root"></div>
    <script>(function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s); js.id = id;
            js.src = "//connect.facebook.net/es_LA/sdk.js#xfbml=1&version=v2.8";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
    </script>

    <?php get_template_part('template-parts/header','menu-sticky');?>
<div id="main_wrapper">
    <header>
        <?php get_template_part('template-parts/header','top-bar-mobile');?>
        <?php get_template_part('template-parts/header','top');?>
        <?php get_template_part('template-parts/form','search');?>


		<div class="wrap-nav container jd-desktop">
            <?php get_template_part('template-parts/logo');?>

            <?php
				if(has_nav_menu('main_menu')):?>
				<nav id="main_menu">
					<?php
						wp_nav_menu(array(
							'theme_location'=>'main_menu',
							'menu_class'=>'main-menu',
							'container_id' =>'',
                            'walker' =>new addSubMenuWrap
						));
					?>
                </nav>
			<?php endif;?>
		</div>
        <?php get_template_part('template-parts/breadcrumbs')?>
    </header>

    <?php if(!is_front_page()):?>
        <a tabindex="-1" href="javascript:void(0)" id="scontent"></a>
    <?php endif;?>

