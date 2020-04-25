(function($){
    //Callback after remove product and update card.
    // jQuery( document.body ).on( 'updated_cart_totals', function() {
    //     location.reload();
    // });
    // jQuery( document.body ).on( 'updated_wc_div', function() {
    //     location.reload();
    // });

    // get data to document ready.

    function open_info_car() {
        $('.wrap-icon-cart').click(function(){
            $('.info-cart').toggleClass('active');
        });
    }

    // add product to cart
    function add_to_cart(){
        var $form = $(".add-to-cart");

        $form.submit(function(e){
            var $form = $(this);
            var form = $form.get(0);
            var $card_elem = $form.closest('.card');
            var $wrap_form  = $form.closest('.form-add-to-cart-page');


            var $top_element_form = !$card_elem.length ? $wrap_form : $card_elem;


            var $preloader = $top_element_form.find('.preloader-card');

            if(!is_valid_add_to_cart_form($top_element_form)){
                return false
            }

            $preloader.removeClass('hide');

            $.ajax({
                type:'post',
                url :obj_WooJD.add_to_cart,
                data:$form.serialize(),

                success:function(data){
                    $('.wrap-icon-cart .count-product span').text(data.get_cart_contents_count);
                    $('.wrap-shop-cart .insert_template').html(data.get_content);
                    $preloader.find('.message-product').removeClass('hide');
                    form.reset();

                    setTimeout(function(){
                        $preloader.addClass('hide');
                        $preloader.find('.message-product').addClass('hide');
                    },3000);


                },

                error:function(data){
                    alert('try again');
                    $preloader.addClass('hide');
                }

            });


            e.preventDefault();
        });
    }


    function is_valid_add_to_cart_form($top_card){
        var $quantity = $top_card.find('.quantity');
        $('.quantity.error').removeClass('error');

        if(!parseInt($quantity.val())){
            $quantity.addClass('error');
            return false;
        }


        return true;
    }


    //remove products from the cart.

    $(document).on('click','.info-cart .remove-product',function(e){
        //e.preventDefault();
        var $self = $(e.currentTarget);
        var $top_li = $self.closest('li');
        // var product_id   = $self.attr('data-product-id');
        // var cart_item_key = $self.attr('data-product-item');
        $top_li.find('.preloader-card').removeClass('hide');

        // $.ajax({
        //     type:'post',
        //     url :obj_WooJD.remove_from_the_cart,
        //     data:{
        //         "product_id":product_id,
        //         "cart_item_key":cart_item_key,
        //     },
        //
        //     success:function(data){
        //         $top_li.fadeOut(function(){
        //             $('.wrap-icon-cart .count-product span').text(data.get_cart_contents_count);
        //             $('.info-cart .total-amount span').html(data.get_cart_total);
        //             $top_li.find('.preloader-card').addClass('hide');
        //             if(!parseInt(data.get_cart_contents_count)){
        //                 $('.info-cart').removeClass('active');
        //             }
        //         });
        //     },
        //
        //     error:function(data){
        //         alert('try again');
        //         $top_li.find('.preloader-card').addClass('hide');
        //
        //     }
        // });

    });





    open_info_car();
    add_to_cart();

    $.get(obj_WooJD.get_data_cart+'?'+new Date().getTime(),function(data){
        $('.wrap-icon-cart .count-product span').text(data.get_cart_contents_count);
        $('.wrap-shop-cart .insert_template').html(data.get_content);
        $('.wrap-shop-cart').addClass('active');
    })

})(jQuery);