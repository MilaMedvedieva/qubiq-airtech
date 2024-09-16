(function ($, root, undefined) {

    $(document).ready(function () {

        function hoverMenuItem(){
            if ( window.matchMedia( "(min-width: 768px)" )) {
                $(".menu-item-has-children").hover(function () {
                    $(this).addClass('show');
                },
                function () {
                  $(this).removeClass('show');
                });
            }
            $("ul.menu a[href='#']").click(function (e) {
                e.preventDefault();
            });
        }
        function btnMenu(){
            $('.menuBtn').click(function() {
                $(this).toggleClass('act');
                if($(this).hasClass('act')) {
                    $('.mobile_menu').addClass('act');
                    $('body').addClass('pushed');
                }
                else {
                    $('.mobile_menu').removeClass('act');
                    $('body').removeClass('pushed');
                }
            });
        }
        function setCaretMenu() {
            let item = $('.mobile_menu li.menu-item-has-children > a');
            item.append('<div class="caret_wrap"><span class="caret"><svg width="10" height="13" viewBox="0 0 10 13" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M10 6.5L0.25 12.1292V0.870835L10 6.5Z" fill="#EDF0F2"/></svg></span></div>');
        }
        function openSubMobilMenu() {
            $("ul.menu a[href='#']").click(function (e) {
                $(this).parent().toggleClass('show_sub_menu');
            });

            $("li.menu-item-has-children .caret").on('click', function (e) {
                e.preventDefault();
                $(this).parent().next().toggleClass('show_sub_menu');

            });

        }

        openSubMobilMenu();
        setCaretMenu();
        btnMenu();
        hoverMenuItem();
    });
})(jQuery);