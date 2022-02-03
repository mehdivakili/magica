var submittedFirst = false;
$(document).ready(function () {

    $.each($('img'),function () {

            if ($(this).width() / $(this).height() > $('.image-bg').width() / $('.image-bg').height()) {
                $(this).css("width", "100%")
            } else {
                $(this).css("height", "100%")
            }



        $(window).resize(function () {

                $.each($('img'), function () {
                    if($(window).width() >= 1200) {

                        if ($(this).width() / $(this).height() > $('.image-bg').width() / $('.image-bg').height()) {
                            $(this).css("width", "100%")
                            $(this).css("height", "")
                        } else {
                            $(this).css("height", "100%")
                            $(this).css("width", "")
                        }
                    }else {
                        $(this).css("width", "100%")
                        $(this).css("height", "")
                    }
                })

        })
    })
/*$('#form_submin_button').click(function (){get_token()})*/
$('.form form').on('submit',function (){get_token();})

    function get_token (){
        if(submittedFirst){
            return true;
        }

        let id = $(this).attr('data_id');
        $.ajax({
            type: 'POST',
            url: '../get_order_token',
            data: {art_id: id},
            success: function (data) {
                let token_input = $(document.createElement('input'))
                token_input.attr('type','hidden')
                token_input.attr('name','order_token')
                token_input.attr('value',data.token)
                let form = $('.order-panel form')

                form.append(token_input)
                $('.order-panel').hide()
                let addPage = null;
                $.ajax({
                    type: 'POST',
                    url: '../get_ad_page',
                    data: {
                        confirmType:'form',
                        form:".order-panel form",
                        text:"Submit order"
                    },
                    success: function (data) {
                        addPage = $(data)
                        $('main').append(addPage);
                        setTimeout(function (){console.log('now')},12000)
                    }
                });



            submittedFirst = true;


            },
            error: function (data) {
                console.log(data)
            }
        });

    }

})
