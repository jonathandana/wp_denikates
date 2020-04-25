<?php defined('ABSPATH') or die(); ?>

<div class="wrap-form">
    <form class="SLForms" id="SL_register" action="<?=SLConfig::$routeRegister?>" method="post" novalidate>
        <h2 class="title-form">הרשמה</h2>
        <fieldset>

            <div class="wrap-field required-field">
                <label for="SLRegister_fname">שם:</label>
                <input aria-describedby="SLRegister_fname_error" aria-required="true" type="text"
                       maxlength="30" id="SLRegister_fname" name="fname"
                       data-jd-require="true" data-jd-message-invalid="שם לא תקין"
                       data-jd-vtype="simpleValid" class="form-input"
                       data-jd-error-message="שם שדה חובה"
                />
                <div id="SLRegister_fname_error" class="error-message" role="alert"></div>
            </div>

            <div class="wrap-field required-field">
                <label for="SLRegister_lname">שם משפחה:</label>
                <input aria-describedby="SLRegister_lname_error" aria-required="true" type="text"
                       maxlength="30" id="SLRegister_lname" name="lname"
                       data-jd-require="true" data-jd-message-invalid="שם משפחה לא תקין"
                       data-jd-error-message="שם משפחה שדה חובה"
                       data-jd-vtype="simpleValid" class="form-input"
                />
                <div id="SLRegister_lname_error" class="error-message" role="alert"></div>
            </div>

            <div class="wrap-field required-field">
                <label for="SLRegister_phone">טלפון:</label>
                <input aria-describedby="SLRegister_phone_error" aria-required="true" type="tel"
                       maxlength="10" id="SLRegister_phone" name="phone"
                       data-jd-require="true" data-jd-message-invalid="טלפון לא תקין"
                       data-jd-error-message="טלפון שדה חובה"
                       data-jd-vtype="isPhone" class="form-input"
                />
                <div id="SLRegister_phone_error" class="error-message" role="alert"></div>
            </div>

            <div class="wrap-field required-field">
                <label for="SLRegister_email">אימייל:</label>
                <input aria-describedby="SLRegister_email_error" aria-required="true" type="email"
                       maxlength="80" id="SLRegister_email" name="email"
                       data-jd-require="true" data-jd-message-invalid="איימיל לא תקין"
                       data-jd-error-message="אימייל שדה חובה"
                       data-jd-vtype="isEmail" class="form-input"
                />
                <div id="SLRegister_email_error" class="error-message" role="alert"></div>
            </div>

            <div class="wrap-field required-field">
                <label for="SLRegister_password">סיסמה:</label>
                <input aria-describedby="SLRegister_password_error" aria-required="true" type="password"
                       id="SLRegister_password" name="password"
                       data-jd-require="true" data-jd-message-invalid="סיסמה לא תקין"
                       data-jd-error-message="סיסמה שדה חובה"
                       data-jd-vtype="simpleValid" class="form-input"
                />
                <div id="SLRegister_password_error" class="error-message" role="alert"></div>
            </div>

            <div class="wrap-field required-field">
                <label for="SLRegister_confirmation_password">אימות סיסמה:</label>
                <input aria-describedby="SLRegister_confirmation_password_error"
                       aria-required="false" type="password"
                       id="SLRegister_confirmation_password" name="password"
                       data-jd-require="false" data-jd-message-invalid="סיסמה לא תואם"
                       data-jd-error-message="סיסמה שדה חובה"
                       data-jd-same = "SLRegister_password"
                       data-jd-vtype="ss" class="form-input"
                />
                <div id="SLRegister_confirmation_password_error" class="error-message" role="alert"></div>
            </div>

            <div class="wrap-submit">
                <button type="submit">
                    <span class="txt">הירשם</span>
                    <?=getPreloader()?>
                </button>
            </div>

        </fieldset>

    </form>
</div>