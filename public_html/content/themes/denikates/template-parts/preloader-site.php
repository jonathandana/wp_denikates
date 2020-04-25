<?php if($logo = get_field('logo','options')): ?>
    <div class="bg-preloader">
       <div class="inner-preloader">
           <img alt="לוגו האתר" src="<?=$logo['sizes']['logo']?>"/>

           <div class="loader">
               <span class="inner1"></span>
               <span class="inner2"></span>
               <span class="inner3"></span>
           </div>

        </div>
    </div>
    <script>
        jQuery(window).load(function() {
            jQuery(".bg-preloader").delay(1000).fadeOut();
        });
    </script>
<?php endif;?>