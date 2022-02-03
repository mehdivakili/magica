$(document).ready(function () {

    let t = $(".timer").countdown360({
        radius: 60,
        seconds: 12,
        strokeStyle: 'blue',
        strokeWidth: 7,
        fontColor: 'black',
        fontFamily:'vazir',
        fillStyle: "rgba(0,0,0,0)",
        autostart: false,
        label: [null],
        onComplete: function () {
            free_link()
        }
    })

    t.start()
    // setTimer(12)



})

function free_link() {

            $('.download-panel a').removeClass('btn-off')
            $('.download-panel a').addClass('btn-gradient');
            $('.download-panel a').click(function (){
                $($('.download-panel a').attr('target')).submit()
            })



}

function setTimer(time) {
    var timer = $('.timer span')
    if (time === 0) {
        free_link()
        return;
    }
    timer.text(time.toString());
    setTimeout(setTimer, 1000, time - 1)
}
