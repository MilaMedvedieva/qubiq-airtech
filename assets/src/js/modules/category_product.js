(function ($, root, undefined) {

    $(document).ready(function () {

        function initFilterCategory(){
            const ajaxurl           = '/wp-admin/admin-ajax.php';
            const formCategory    = $('#filter_product_category');
            const einsatzgebiet     = formCategory.find('.einsatzgebiet');


            let  einsatzgebietInputs = einsatzgebiet.find('input');

            //einsatzgebiet
            einsatzgebietInputs.each(function (index) {
                $(this).click(function () {
                    if ($(this).is(":checked")) {
                        // console.log(index + ": " + $(this).val());
                        $('.btn-form').trigger("click");
                    }
                });
            });

            formCategory.on('submit ', function (e) {
                e.preventDefault();
                let selectEinsatzgebiet;
                let cat_id = $(document).find("#current_category_product_id").val();

                //selectEinsatzgebiet
                einsatzgebietInputs.each(function (index) {
                    if ($(this).is(":checked")) {
                        selectEinsatzgebiet = $(this).val();
                    }
                });

                console.log(selectEinsatzgebiet,cat_id);

                $.ajax({
                    url: ajaxurl,
                    type: 'POST',
                    data: {
                        action:         'filter_category_ajax',
                        einsatzgebiet:  selectEinsatzgebiet,
                        cat_id:         cat_id,
                    },
                    beforeSend: function () {
                        $(document).find('.render_filter_category').empty();
                        $(document).find('.preload').show();
                    },
                }).done(function (data) {
                    if( data ) {
                        let answer = JSON.parse(data);
                        $(document).find('.preload').hide();
                        $(document).find('.render_filter_category').append(answer.render);
                    }else{
                       console.log('404...!');
                    }
                });
            });

        }

        initFilterCategory();
    });
})(jQuery);