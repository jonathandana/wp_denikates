<?php defined('ABSPATH') or die();
$key = filter_input(INPUT_GET, "key");
?>
<div class="wrap-form">
    <form action="<?=SLConfig::$routeRP?>" id="SL_reset_pass" method="post" novalidate>
        <h2 class="title-form">איפוס סיסמה</h2>

        <fieldset>
            <input type="hidden" name="key" value="<?=$key?>">
            <div class="wrap-field required-field">
                <label for="SLReset_pass">סיסמה:</label>
                <input aria-describedby="SLReset_pass_error" aria-required="true" data-jd-vtype="simpleValid"
                       data-jd-require="true" data-jd-error-message="סיסמה שדה חובה"
                       type="password" name="password" id="SLReset_pass" />
                <div role="alert" id="SLReset_pass_error" class="error-message"></div>
                <div role="alert" class="error error-server"></div>
            </div>

            <div class="wrap-submit">
                <button class="" type="submit">
                    <span class="txt">איפוס סיסמה</span>
                    <?=getPreloader()?>
                </button>
            </div>
        </fieldset>
    </form>
</div>