(function ($, root, undefined) {

    $(document).ready(function () {

        function initFilterProduktmarke(){
            const ajaxurl           = '/wp-admin/admin-ajax.php';
            const formProduktmarke    = $('#filter_produktmarke');
            const einsatzgebiet     = formProduktmarke.find('.einsatzgebiet');
            const category     = formProduktmarke.find('.category');


            let  einsatzgebietInputs = einsatzgebiet.find('input');
            let  categoryInputs = category.find('input');

            //einsatzgebiet
            einsatzgebietInputs.each(function (index) {
                $(this).click(function () {
                    if ($(this).is(":checked")) {
                        // console.log(index + ": " + $(this).val());
                        $('.btn-form').trigger("click");
                    }
                });
            });

            //category
            categoryInputs.each(function (index) {
                $(this).click(function () {
                    if ($(this).is(":checked")) {
                        //console.log(index + ": " + $(this).val());
                        $('.btn-form').trigger("click");
                    }
                });
            });

            formProduktmarke.on('submit ', function (e) {
                e.preventDefault();
                let selectEinsatzgebiet;
                let selectCategory;
                let current_tax_id = $(document).find("#current_tax").val();

                //selectEinsatzgebiet
                einsatzgebietInputs.each(function (index) {
                    if ($(this).is(":checked")) {
                        selectEinsatzgebiet = $(this).val();
                    }
                });

                //selectCategory
                categoryInputs.each(function (index) {
                    if ($(this).is(":checked")) {
                        selectCategory = $(this).val();
                    }
                });

                console.log('einsatzgebiet', selectEinsatzgebiet);
                console.log('category', selectCategory);
                console.log('current_tax_id', current_tax_id);

                $.ajax({
                    url: ajaxurl,
                    type: 'POST',
                    data: {
                        action:         'filter_produktmarke_ajax',
                        einsatzgebiet:  selectEinsatzgebiet,
                        category:       selectCategory,
                        current_tax_id: current_tax_id,
                    },
                    beforeSend: function () {
                        $(document).find('.render_res').empty();
                        $(document).find('.preload').show();
                    },
                }).done(function (data) {
                    if( data ) {
                        let answer = JSON.parse(data);
                        $(document).find('.preload').hide();
                        $(document).find('.render_res').append(answer.render);
                    }else{
                       console.log('404...!');
                    }
                });
            });

        }

        initFilterProduktmarke();
    });
})(jQuery);