<?php
    if(function_exists('yoast_breadcrumb') && !is_front_page()) {
        echo '<div class="container">';
            yoast_breadcrumb('<div id="breadcrumbs">', '</div>');
        echo '</div>';
    }

