<ul class="widget-accessibility">
    <li>
        <button class="main-btn skip-to-content">
            <i class="fa fa-fast-backward"></i>
            <span>מעבר לתוכן מרכזי</span>
        </button>
    </li>

    <li>
        <button data-aw="contrast" class="main-btn btn-aw">
            <i class="fa fa-adjust" aria-hidden="true"></i>
            <span>ניגודיות צבע</span>
        </button>
    </li>

    <li class="li-font-size">
        <i class="fa fa-arrows" aria-hidden="true"></i>
        <span>גודל גופן</span>
        <ul>
            <li><button data-aw="font-normal" class="normal btn-aw">א</button></li>
            <li><button data-aw="font-medium" class="medium btn-aw">א</button></li>
            <li><button data-aw="font-large" class="large btn-aw">א</button></li>
        </ul>
    </li>

    <li>
        <button data-aw="mark-links" class="main-btn btn-aw">
            <i class="fa fa-link" aria-hidden="true"></i>
            <span>הדגשה קישורים</span>
        </button>
    </li>

    <li>
        <button data-aw="mark-heading" class="main-btn btn-aw">
            <i class="fa fa-underline" aria-hidden="true"></i>
            <span>הדגשה כותרות</span>
        </button>
    </li>

    <li>
        <button data-aw="font-readable" class="main-btn btn-aw">
            <i class="fa fa-font" aria-hidden="true"></i>
            <span>פונט קריא</span>
        </button>
    </li>

    <li>
        <button data-aw="big-cursor" class="main-btn btn-aw">
            <i class="fa fa-mouse-pointer" aria-hidden="true"></i>
            <span>הגדל סמן עכבר</span>
        </button>
    </li>

    <?php if($url = get_field('negishut_url','options')):?>
        <li>
            <a class="negishut" href="<?=$url?>">הצהרת נגישות</a>
        </li>
    <?php endif;?>

    <li>
        <button class="main-btn off-accessibility">
            <i class="fa fa-power-off" aria-hidden="true"></i>
            <span>כבה נגישות</span>
        </button>
    </li>

    <li>
        <button class="main-btn close-menu-accessibility">
            <i class="fa fa-times" aria-hidden="true"></i>
            <span>סגור תפריט נגישות</span>
        </button>
    </li>

</ul>