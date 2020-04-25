<?php defined('ABSPATH') or die(); ?>
<div class="wrap-form">
    <form action="<?=SLConfig::$routeFP?>" id="SL_forgot_pass" method="post" novalidate>
        <h2 class="title-form">איפוס סיסמה</h2>

        <fieldset>
            <div class="wrap-field required-field">
                <label for="SLForgotPass_email">אימייל:</label>
                <input aria-describedby="SLForgotPass_email_error" aria-required="true" type="email"
                       data-jd-require="true" data-jd-message-invalid="אימייל לא תקין"
                       data-jd-error-message="אימייל שדה חובה"
                       data-jd-vtype="isEmail" class="form-input" id="SLForgotPass_email"
                       name="email" maxlength="80">
                <div role="alert" id="SLForgotPass_email_error" class="error-message"></div>
            </div>

            <div class="wrap-submit">
                <button class="" type="submit">
                    <span class="txt">איפוס סיסמה</span>
                    <?=getPreloader()?>
                </button>
            </div>
            <div class="message-thanks">קישור לאיפוס סיסמה נשלח לאימייל.</div>
        </fieldset>
    </form>
</div>