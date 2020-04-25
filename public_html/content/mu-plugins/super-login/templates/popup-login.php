<?php defined('ABSPATH') or die();
$key = filter_input(INPUT_GET, "key");
$user = SLForgotPassword::getUserByKey($key);
$active = ($user) ? 'active' : '';

?>

<!--add condition is user not login return false -->
<div class="popup-login <?=$active?>">
    <div class="overlay-popup"></div>

    <div class="content-popup popup-auto-height">
        <button class="close-popup">
            <i class="fa fa-times"></i>
        </button>
        <nav class="tabs">
            <ul>
                <li><a class="tab-login active" data-tab="sl_login_form" href="#">התחברות</a></li>
                <li><a class="tab-login" data-tab="sl_register_form" href="#">הרשמה</a></li>
                <li><a class="tab-login" data-tab="sl_forgot_pass" href="#">איפוס סיסמה</a></li>
            </ul>
        </nav>
        <div class="popup-content">
            <div id="sl_login_form" class="content-tab active ">
                <?=SLTemplates::getLoginFormHtml();?>
            </div>
            <div id="sl_register_form" class="content-tab">
                <?=SLTemplates::getRegisterFormHtml();?>
            </div>
            <div id="sl_forgot_pass" class="content-tab">
                <?=SLTemplates::getForgotPassFormHtml();?>
            </div>
            <div class="reset_pass">
                <?=SLTemplates::getResetPassFormHtml();?>
            </div>
        </div>
    </div>


</div>