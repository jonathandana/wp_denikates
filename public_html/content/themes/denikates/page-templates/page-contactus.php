<?php
/*
 Template Name: Contact Us
 */
$_wpcf7 = '5';
$_wpcf7_unit_tag = "wpcf7-f{$_wpcf7}-p73-o1"; // Taken from CF7 source code
$_wpnonce = substr( wp_hash( $_wpcf7, 'nonce' ), -12, 10 ); // Taken from CF7 source code


get_header(); ?>

<main class="contact-us">
    <div class="min-container">
        <div class="wrap-content">
            <div class="title">
                <h1><?php the_title()?></h1>
            </div>
            <div class="the-content">
                <?php the_content()?>
            </div>
        </div>

        <div class="wrap-form">
            <form id="form_contactus" action="/wp-json/contact-form-7/v1/contact-forms/<?=$_wpcf7?>/feedback" method="post" novalidate="novalidate">
                <input type="hidden" name="_wpcf7" value="<?=$_wpcf7?>">
                <input type="hidden" name="_wpcf7_nonce" value="<?=$_wpnonce?>">
                <input type="hidden" name="_wpcf7_unit_tag" value="<?=$_wpcf7_unit_tag?>">
                <input type="hidden" name="_wpcf7_is_ajax_call" value="1">

                <div class="wrap-field">
                    <label for="name"><span>*</span>שם:</label>
                    <input type="text" aria-describedby="name_error" aria-required="true" data-jd-require="true" data-jd-error-message="שם שדה חובה" data-jd-vtype="simpleValid" class="form-input" id="name" name="name" maxlength="30"/>
                    <div id="name_error" class="error-message" role="alert"></div>
                </div>

                <div class="wrap-field">
                    <label for="phone"><span>*</span>טלפון:</label>
                    <input type="tel" aria-describedby="phone_error" aria-required="true" data-jd-require="true" data-jd-error-message="טלפון שדה חובה" data-jd-message-invalid="טלפון לא תקין" data-jd-vtype="isPhone" class="form-input" id="phone" name="phone" maxlength="10"/>
                    <div id="phone_error" class="error-message" role="alert"></div>
                </div>

                <div class="wrap-field">
                    <label for="email">אימייל:</label>
                    <input type="email" data-jd-require="false" data-jd-message-invalid="אימייל לא תקין" data-jd-vtype="isEmail" class="form-input" id="email" name="email" maxlength="80"/>
                    <div id="email_error" class="error-message"></div>
                </div>

                <div class="wrap-field">
                    <label for="message">הודעה:</label>
                    <textarea data-jd-require="false" id="message" name="message"></textarea>
                </div>

                <div class="wrap-submit">
                    <button data-jd-submit="1" class="submit-form" type="submit">
                        <span class="val-text">שלח</span>
                        <?=getPreloader()?>
                    </button>
                </div>

            <div class="thanks">תודה פנייתך נשלחה</div>
            </form>
        </div>
    </div>
</main>

<?php get_footer(); ?>
