<?php defined('ABSPATH') or die(); ?>
<div class="wrap-form">
    <form action="<?=SLConfig::$routeLogin?>" id="SL_login" method="post" novalidate>
        <h2 class="title-form">התחברות</h2>

        <fieldset>
            <div class="wrap-field required-field">
                <label for="SLLogin_email">אימייל:</label>
                <input aria-describedby="SLLogin_email_error" aria-required="true" type="email"
                       data-jd-require="true" data-jd-message-invalid="אימייל לא תקין"
                       data-jd-error-message="אימייל שדה חובה"
                       data-jd-vtype="isEmail" class="form-input" id="SLLogin_email"
                       name="email" maxlength="80">
                <div role="alert" id="SLLogin_email_error" class="error-message"></div>
            </div>


            <div class="wrap-field required-field">
                <label for="SLLogin_password">סיסמה:</label>
                <input aria-describedby="SLLogin_password_error" aria-required="true" data-jd-vtype="simpleValid"
                       data-jd-require="true" data-jd-error-message="סיסמה שדה חובה"
                       type="password" name="password" id="SLLogin_password" />
                <div role="alert" id="SLLogin_password_error" class="error-message"></div>
                <div role="alert" class="error error-server"></div>
            </div>

            <div class="wrap-submit">
                <button class="" type="submit">
                    <span class="txt">התחבר</span>
                    <?=getPreloader()?>
                </button>
            </div>
        </fieldset>
    </form>
</div>