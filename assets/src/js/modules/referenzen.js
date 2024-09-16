(function ($, root, undefined) {

    $(document).ready(function () {

        function initFilterReferenzen(){
            const ajaxurl           = '/wp-admin/admin-ajax.php';
            const formReferenzen    = $('#filter_referenzen');
            const category          = formReferenzen.find('.category');
            const einsatzgebiet     = formReferenzen.find('.einsatzgebiet');
            const mark              = formReferenzen.find('.mark');

            let  categoryInputs      = category.find('input');
            let  einsatzgebietInputs = einsatzgebiet.find('input');
            let  markInputs          = mark.find('input');

            //Category
            categoryInputs.each(function (index) {
                $(this).click(function () {
                    if ($(this).is(":checked")) {
                        // console.log(index + ": " + $(this).val());
                        $('.btn-form').trigger("click");
                    }
                });
            });

            //einsatzgebiet
            einsatzgebietInputs.each(function (index) {
                $(this).click(function () {
                    if ($(this).is(":checked")) {
                        // console.log(index + ": " + $(this).val());
                        $('.btn-form').trigger("click");
                    }
                });
            });

            //makr
            markInputs.each(function (index) {
                $(this).click(function () {
                    if ($(this).is(":checked")) {
                        // console.log(index + ": " + $(this).val());
                        $('.btn-form').trigger("click");
                    }
                });
            });

            formReferenzen.on('submit ', function (e) {
                e.preventDefault();
                let selectCategory;
                let selectEinsatzgebiet;
                let selectMark;
                let post_type = $(document).find("#posts_type").val();
                let offset = $(document).find("#posts_offset_default").val();
                let all_post_count = $(document).find("#posts_count").val();

                //selectCategory
                categoryInputs.each(function (index) {
                    if ($(this).is(":checked")) {
                        selectCategory = $(this).val();
                    }
                });

                //selectEinsatzgebiet
                einsatzgebietInputs.each(function (index) {
                    if ($(this).is(":checked")) {
                        selectEinsatzgebiet = $(this).val();
                    }
                });

                //selectMark
                markInputs.each(function (index) {
                    if ($(this).is(":checked")) {
                        selectMark = $(this).val();
                    }
                });


                $.ajax({
                    url: ajaxurl,
                    type: 'POST',
                    data: {
                        action:         'filter_referenzen_ajax',
                        category:       selectCategory,
                        einsatzgebiet:  selectEinsatzgebiet,
                        mark:           selectMark,
                        post_type:      post_type,

                    },
                    beforeSend: function () {
                        $(document).find('.render_this').empty();
                        $(document).find('.preload').show();
                    },
                }).done(function (data) {
                    if( data ) {
                        let answer = JSON.parse(data);
                        $(document).find('.preload').hide();
                        $(document).find('.render_this').append(answer.render);
                        $("#posts_count_with_filter").val(answer.post_count);
                        $("#offset_with_filter").val(offset);
                        if(answer.post_count > offset){
                            $('.post_nav,.with_filter_load_more').removeClass('hidden');
                            $('.wrap_load_more').addClass('hidden');
                        }else{
                            $('.post_nav,.with_filter_load_more').addClass('hidden');
                        }
                    }else{
                        $('.post_nav').addClass('hidden');
                    }
                });
            });

            $('.post_load_more').click(function(e){
                e.preventDefault();
                let button = $(this);
                let offset = $(document).find("#posts_offset").val();
                let post_count = $(document).find("#posts_count").val();
                let post_type = $(document).find("#posts_type").val();

                $.ajax({
                    url : ajaxurl,
                    data: {
                        action: 'post_load_more',
                        offset: offset,
                        post_type: post_type,
                    },
                    type : 'POST',
                    beforeSend : function ( xhr ) {
                        button.text('Wird Geladen...');
                    },
                    success : function( data ){
                        if( data ) {
                            let answer = JSON.parse(data);
                            button.text( 'Weitere Beiträge' );
                            $(document).find("#posts_offset").val(answer.new_offset);
                            $(document).find('.render_this').append(answer.render);
                            if(answer.new_offset >= post_count ){
                                button.remove();
                                $('.post_nav').addClass('hidden');
                            }
                        } else {
                            button.remove();
                        }
                    }
                });
            });

            $('#post_load_more_with_filter').click(function(e){
                e.preventDefault();
                let button = $(this);
                let selectCategory;
                let selectEinsatzgebiet;
                let selectMark;
                let offset = $(document).find("#offset_with_filter").val();
                let post_count = $(document).find("#posts_count_with_filter").val();
                let post_type = $(document).find("#posts_type").val();

                //selectCategory
                categoryInputs.each(function (index) {
                    if ($(this).is(":checked")) {
                        selectCategory = $(this).val();
                    }
                });
                console.log("Category  " + selectCategory);

                //selectEinsatzgebiet
                einsatzgebietInputs.each(function (index) {
                    if ($(this).is(":checked")) {
                        selectEinsatzgebiet = $(this).val();
                    }
                });
                console.log("Einsatzgebiet  " + selectEinsatzgebiet);

                //selectMark
                markInputs.each(function (index) {
                    if ($(this).is(":checked")) {
                        selectMark = $(this).val();
                    }
                });
                console.log("selectMark  " + selectMark);

                $.ajax({
                    url : ajaxurl,
                    data: {
                        action: 'post_load_more_with_filter',
                        offset: offset,
                        post_type: post_type,
                        category:       selectCategory,
                        einsatzgebiet:  selectEinsatzgebiet,
                        mark:           selectMark
                    },
                    type : 'POST',
                    beforeSend : function ( xhr ) {
                        button.text('Wird Geladen...');
                    },
                    success : function( data ){
                        if( data ) {
                            let answer = JSON.parse(data);
                            button.text( 'Weitere Beiträge' );
                            $(document).find("#offset_with_filter").val(answer.new_offset);
                            $(document).find('.render_this').append(answer.render);
                            console.log(answer.new_offset, answer.post_count )
                            if(answer.new_offset > post_count ){
                                button.addClass('hidden');
                                $('.post_nav').addClass('hidden');
                            }
                        } else {
                            button.addClass('hidden');
                        }
                    }
                });
            });
        }
        function clickFilter() {
            $(".category-label").on('click', function () {
                $('form .category').toggle();
                $(this).find('.caret').toggleClass('open');
            });
            $(".einsatzgebiet-label").on('click', function () {
                $('form .einsatzgebiet').toggle();
                $(this).find('.caret').toggleClass('open');
            });
            $(".mark-label").on('click', function () {
                $('form .mark').toggle();
                $(this).find('.caret').toggleClass('open');
            });
        }
        initFilterReferenzen();
        clickFilter();
    });
})(jQuery);