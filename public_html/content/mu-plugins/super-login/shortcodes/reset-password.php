<?php defined('ABSPATH') or die(); ?>

<?php if(SLForgotPassword::$rp_user_data):?>


<div class="popup-middle-wrapper">

    <div class="popup-left">
        <h3 class="popup-heading">set New<br>password</h3>
    </div>

    <div id="SLReset" class="popup-right wrap-form">
        <form class="SLForms" action="<?= SLConfig::$routeRP;?>" method="post" novalidate>
            <fieldset>
                <input type="hidden" name="form_name" value="SLReset">
                <div class="wrap-field">
                    <input type="hidden" value="<?= SLForgotPassword::$rp_user_data->ID;?>" name="id">
                    <input type="password" name="password" id="SLReset_password" placeholder="Password" data-require="1" data-error-messages='{"required":"Password Required field","invalid":"Password Invalid"}' />
                    <div role="alert" id="SLReset_password_error" class="error-msg"></div>
                </div>

                <button type="submit">Send</button>
            </fieldset>

        </form>

        <div class="preloader">
            <i class="fa fa-spinner fa-spin fa-3x fa-fw"></i>
        </div>

        <div class="message-success">
            Password has been reset successfully.
        </div>

    </div>
</div>


<?php endif;?>
