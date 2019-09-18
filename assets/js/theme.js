(function($) {
    $(document).ready( function() {
        var ajax_flag = null;

        window.meta_sharing = function(href) {
            window.open( href, 'Northern Valley Locavore Store Sharing', 'toolbar=0,status=0,width=666,height=353' );
        };

        $('div.product-slider').slick({
            slidesToShow: 3,
            slidesToScroll: 1,
            dots: false,
            arrows: true,
            autoplay: false,
            prevArrow: '<button type="button" class="slick-prev"><</button>',
            nextArrow: '<button type="button" class="slick-next">></button>',
            responsive: [
                {
                    breakpoint: 767,
                    settings: {
                        slidesToShow: 2
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 1
                    }
                }
            ]
        });

        $('.button-quickview').on('click', function(e) {
            e.preventDefault();
            var id = $(this).attr('data-id');

            if( id ) {
                if( ajax_flag ) {
                    ajax_flag.abort();
                }
                
                ajax_flag = $.ajax({  
                    type: "POST",
                    url: meta_data.ajaxurl,  
                    data : {
                        action: '_quick_view',
                        _id: id
                    },
                    beforeSend: function() {
                    },
                    success:function(response) {
                        if( response ) {
                            $('div#quick-view-content').html( response );
                            $('div#quick-view').modal('toggle');
                        }
                    } 
                });
            }
        });

        $('body').magnificPopup({
            delegate: 'a.zoom',
            type: 'image'
        });


        $(document).on('submit','form.form-cart',function(e) {
            e.preventDefault();
            var id = $(this).find('input[name="product_id"]').val();
            var qty = $(this).find('input[name="qty"]').val();

            if( id && qty ) {
                if( ajax_flag ) {
                    ajax_flag.abort();
                }
                
                ajax_flag = $.ajax({  
                    type: "POST",
                    url: meta_data.ajaxurl,  
                    data : {
                        action: 'item_add_cart',
                        _id: id,
                        _qty: qty
                    },
                    beforeSend: function() {
                    },
                    success:function(response) {
                        if( !response ) {
                            return;
                        }
        
                        if( response.error && response.product_url ) {
                            window.location = response.product_url;
                            return;
                        }
                        
                        if( wc_add_to_cart_params.cart_redirect_after_add === 'yes' ) {
                            window.location = wc_add_to_cart_params.cart_url;
                            return;
                        }
    
                        $( document.body ).trigger( 'added_to_cart', [ response.fragments, response.cart_hash ] );
                    } 
                });
            }
        });

        $('form.form-cart').on('submit', function(e) {
            
        });
    });
})(jQuery);