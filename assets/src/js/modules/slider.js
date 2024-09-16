(function ($, root, undefined) {

    $(document).ready(function () {
        function initHomeSlider(){
            if($('.home-slider').length){
                $('.home-slider').slick({
                    dots: false,
                    speed: 500,
                    fade: true,
                    cssEase: 'linear',
                    autoplay: true,
                    arrows: false,
                    autoplaySpeed: 2000,
                    pauseOnHover: false,
                    pauseOnFocus: false,
                });
            }

        }

        function initProductSlider(){
            $('.woocommerce-product-slider-view').slick({
                slidesToShow: 1,
                slidesToScroll: 1,
                arrows: false,
                fade: true,
                asNavFor: '.woocommerce-product-slider-nav'
            });
            $('.flex-control-nav').slick({
                slidesToShow: 5,
                slidesToScroll: 1,
                infinite: false,
                loop: false,
                dots: false,
                vertical:true,
                centerMode: false,
                focusOnSelect: false,
                verticalSwiping:false,
                responsive: [
                    {
                        breakpoint: 992,
                        settings: {
                            slidesToShow: 4,
                            slidesToScroll: 1,
                            vertical: false
                        }
                    }
                ]
            });

            if ($('.slick-arrow').length){
                $('.flex-control-nav').addClass('has-arrows');
            }
        }



        initHomeSlider();
        initProductSlider();
    });

})(jQuery);