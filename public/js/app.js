$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});


$('document').ready(function () {

    var url = window.location.href;
    var tmpScroll = window.scrollY;
    var menu = $('.panel-menu');
    var panelPositionStatus = 'abs';
    var isShow = true;
    var windowStatus = ''
    var menuOffset = 16


    $('.items li a[href="' + url + '"]').parent().addClass('activate')

    resposive()

    $(window).resize(function () {

        resposive()


    })
    $(window).on('scroll resize',function () {
        function absPosition() {
            if (panelPositionStatus !== 'abs') {
                menu.css('position', 'absolute')
                if (panelPositionStatus === 'upfixed') {
                    menu.css('top', window.scrollY + menuOffset)
                } else {
                    menu.css('top', window.scrollY + $('body').height() - menu.height() - menuOffset)
                }
                panelPositionStatus = 'abs';
            }
        }

        function fixedPosition(direct) {
            if (panelPositionStatus === 'abs') {
                menu.css('position', 'fixed')
                menu.css('top', (direct === 'upfixed') ? menuOffset : $('body').height() - menu.height() - menuOffset)
                panelPositionStatus = direct
            }
        }

        if (window.scrollY < tmpScroll) {
            if (menu.offset().top - menuOffset >= window.scrollY) {
                fixedPosition('upfixed')
            } else {
                absPosition()
            }
        } else if (window.scrollY > tmpScroll) {
            if (menu.offset().top + menu.height() < window.scrollY + $('body').height() - menuOffset) {
                fixedPosition('downfixed')
            } else {
                absPosition()
            }
        }
        tmpScroll = window.scrollY;
    })


    $('.bar-btn').click(function () {
        if (isShow) {
            $('main').hide();
            $('.panel-menu-mobile').css('display','flex');
            $('.menubar').hide();
            $('.exit').show();
        } else {
            $('main').show();
            $('.panel-menu-mobile').hide();
            $('.menubar').show();
            $('.exit').hide();
        }
        isShow = !isShow;
    })


    function resposive() {
/*        if(window.isMobileOrTablet()) {
            $('.body').height($(window).height())
        }*/
        if ($(window).width() > 1200) {
            if (windowStatus === 'mobile' || windowStatus === 'tablet') {
                menu.css('position', 'absolute')
                menu.css('top', menuOffset)
            }

            windowStatus = 'pc'
        } else {
            if (windowStatus === 'mobile' || windowStatus === 'pc') {
                menu.css('position', 'absolute')
                menu.css('top', menuOffset)
            }





            windowStatus = 'tablet'

        }
        if ($(window).width() >= 785) {
            $('main').show();
            $('.panel-menu-mobile').hide();
            $('.menubar').show();
            $('.exit').hide();
            isShow = true;


        } else {
            windowStatus = 'mobile'
        }
    }


});
