$('document').ready(function () {

    var heightSetter = $('.available');
    var menu = $('.panel-menu');
    var minHeight = parseInt(menu.css('min-height').slice(0, -2))
    var tryTime = 0
    var height = 0
    resposiveSize()

    $(window).resize(function () {

        resposiveSize()


    })

    function resposiveSize(firstTime = false) {

        if ($(window).width() > 1200) {
            if ($('body').height() > minHeight) {
                // console.log(heightSetter.length)
                height = 0
                $.each(heightSetter, function () {
                    height += $(this).height()

                })
                height = (height + $('body').height() - $('#panel-app').height()) / heightSetter.length

                $.each(heightSetter, function () {
                    $(this).height(height)
                })

            }
            if (res.length !== 0) {
                res.forEach(function (v) {
                    $("." + v['source']).attr('style', 'height: calc(100vh - ' + v['dest'] + ' - ' + v['px'] + ')');
                    // $("." + v['source'] + " ul").height($("." + v['dest']).height() + v['px'] - v["ul_px"]);
                })
            }
            if (Math.round($('#panel-app').height()) !== Math.round($(window).height())) {
                if (tryTime++ !== 10) {
                    resposiveSize()

                } else {
                    tryTime = 0
                }
            }
        } else {
            heightSetter.css('height', '')
            res.forEach(function (v) {
                $("." + v['source']).height('');
                $("." + v['source'] + " ul").height('');
            })

            if (firstTime) {


                if ($(window).height() > $('#panel-app').height()) {
                    $.each(heightSetter, function () {
                        height += $(this).height()

                    })
                    height = (height + $('body').height() - $('#panel-app').height()) / heightSetter.length

                    $.each(heightSetter, function () {
                        this.style = 'min-height:' + height + 'px !important'
                    })
                }
            } else {
                $.each(heightSetter, function () {
                    this.style = 'min-height:' + height + 'px'
                })
            }
        }
    }
})
