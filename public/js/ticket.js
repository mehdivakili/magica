$('document').ready(function () {
    $.each($('.tickets li'),function (){
        let id =$(this).attr('data-id')
        let li = $(this)
        $($(this).attr('data-target')).on('hidden.bs.modal', function () {
            console.log()
            $.ajax({
                type: 'POST',
                url: 'set_ticket_read',
                data: {ticket_id: id},
                success: function (data) {
                    console.log(data)
                    if(data === 'saved') {
                        li.css('background', 'none')
                        li.css('background-color', 'rgba(255,255,255,0.6)')
                        li.css('color', '#333')

                        li.children('span').children('span').text('خوانده شد');
                    }
                },
                error: function (data) {
                    console.log(data)
                }
            });
        });

    })

});
