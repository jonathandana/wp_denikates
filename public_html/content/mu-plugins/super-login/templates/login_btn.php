<?php defined('ABSPATH') or die(); ?>
<?php
$current_user = SLConfig::$current_user;
$class_css = $current_user->ID === 0 ? '' : 'logged-in';
$name = $current_user->ID === 0 ? 'החשבון שלי' : $current_user->first_name.' '.$current_user->last_name;
?>
<div class="sl-login <?=$class_css?>">
    <button type="button" class="btn-user">
        <span class="icon-user"><i class="fa fa-user-circle"></i></span>
        <span class="name"><?=$name?></span>
    </button>
</div>

