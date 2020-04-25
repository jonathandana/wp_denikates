<?php if($logo = get_field('logo','options')): ?>
    <div class="logo s-wrap-logo">
        <a href="<?= home_url()?>">
            <img alt="לוגו האתר" src="<?=$logo['sizes']['logo']?>"/>
        </a>
    </div>
<?php endif;?>