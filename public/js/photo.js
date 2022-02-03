var initedColums = [];
$('document').ready(function () {

    var arts;
    var win = $(window);
    var colmn_number = 1;
    var sizes = [800,1200,1600]
    var w = win.width()

    sizes.forEach(function (v,k) {
        if(v <= w){
            colmn_number = k +2;
        }
    })
    var tmp = colmn_number;
    photo_res();
    lazyLoad();
    function photo_res(){
        $('.colmn').addClass('remove')
        $.each($('.column'),function () {
            arts = $(this.getElementsByClassName('art-con'))

            arts.remove()
            let i;

            for(i = 0 ; i< colmn_number; i++){
                let col = document.createElement('div')
                col = $(col);
                col.addClass('colmn');
                col.css('width',Math.floor(100/colmn_number).toString()+'%')
                col.css('height','fit-content')
                let j;
                let index = 0;
                for(j = 0; j< arts.length;j++){
                    index = j% colmn_number
                    if( index === i){
                        col.append(arts[j])
                    }
                }

                $(this).children('ul').append(col)
            }
        })
        $('.remove').remove()
    }

    $(window).resize(function () {

        var w = win.width()
        colmn_number = 1;
        sizes.forEach(function (v,k) {
            if(v <= w){
                colmn_number = k +2;
            }
        })
        if(tmp !== colmn_number){
            photo_res()
            tmp = colmn_number;
        }

    });

})
function lazyLoad(column ='.column:first'){
    let tmpHeight = 0

    $.each($(column).find('.colmn'),function (){
    if($(window).width() > 1200){
        tmpHeight = $(column).find('ul').scrollTop() + $(column).height() + 200;
    }else {
        // console.log($(window).scrollTop())
        tmpHeight = $(window).scrollTop() + $('.body').height() - 100;
    }
        if($(this).height() < tmpHeight ){
           console.log('alsdkfjlsadf')
            if($(this).children().find('img[link]').length === 0)return 0;

                addImage(this)
            setTimeout(function (){lazyLoad(column)},10)

        }
    })
    if (!initedColums.includes(column)) {
        if ($(window).width() > 1200) {
            $('.column:first ul').scroll(function () {
                lazyLoad(column)
            })
        } else {
            $(window).scroll(function () {
                lazyLoad(column)
            })
        }
        initedColums.push(column);
    }
}
function addImage(column){
    let art = $(column).children().find('img[link]').first()
    art.attr('src',art.attr('link'))
    art.removeAttr('link')
    art.parent().parent().css('display','block')
}

