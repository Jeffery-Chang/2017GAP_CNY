var indexCtrl = {
    init: function(){
        var $this = this;
        var part1 = $('.part1');
        var startBtn = $('.start');

        $('body').on('touchmove', function (event) {
            event.preventDefault();
        });

        startBtn.on('click',function(event){
            event.preventDefault();
            var $btn = $(this);

            TweenMax.to(part1, .5, {
                display: 'none',
                y: '-=' + $(window).height(),
                ease: Power1.easeOut,
                onComplete: function () {
                    location.href = 'game.php';
                }
            });
            $btn.off('click');
        });

        gapage('0_index');

        /* 2017-01-16 Jeffery 調整loading關閉延遲 */
        setTimeout(function(){
            $('.loading').fadeOut('fast');
        }, 2500);
    }
}

$(function(){
    indexCtrl.init();
});