<?php defined('ABSPATH') or die(); ?>

<?php if(!is_user_logged_in()):?>

<div class="popup-middle-wrapper">

    <div class="popup-left">
        <h3 class="popup-heading">Reset<br>password</h3>
    </div>

    <div id="SLForgot" class="popup-right wrap-form">
        <form class="SLForms" action="<?= SLConfig::$routeFP;?>" method="post" novalidate>
            <fieldset>
                <legend>Enter your email to reset password</legend>
                <div class="wrap-field">
                    <input type="hidden" name="form_name" value="SLForgot">
                    <input type="email" name="email" id="SLForgot_email" placeholder="Email" data-require="1" data-vtype="email" data-error-messages='{"required":"Email Required field","invalid":"Email Invalid"}' />
                    <div role="alert" id="SLForgot_email_error" class="error-msg"></div>
                </div>

                <button type="submit">Send</button>
            </fieldset>

        </form>
        <div class="preloader">
            <i class="fa fa-spinner fa-spin fa-3x fa-fw"></i>
        </div>

        <div class="message-success">
            password reset link was sent to your email.
        </div>

    </div>
</div>


<?php endif; ?>