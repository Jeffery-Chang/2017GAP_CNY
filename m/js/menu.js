var menu = {
    init: function(){
        var $this = this;

        $('.bur').on('click',function(event){
            event.preventDefault();
            $(this).toggleClass('open');
            $('.menubox').toggleClass('active');
        });

        $('.menubox li').on('click', function(event){
            event.preventDefault();

            var menuIndex = $(this).index();
            switch (menuIndex){
                case 0:
                    location.href = 'index.php';
                    break;
                case 1:
                    trackWaitJump('meun_regulations','rule.php');
                    break;
                case 2:
                    trackWaitJump('meun_stores','store.php');
                    break;
                case 3:
                    $this.shareFb();
                    break;
            }
        });
    },
    shareFb: function(page){
        
        if(page === undefined || page === null || page === ''){
            page = 'index';
        }
        
        var app_id = '1237255769644437';
        var link = 'http://gaptaiwan.com.tw/cny/index.php?fb_back=1';
        var name = '和GAP一起雞吉向上，領取新春優惠！';
        var description = '迎接金雞年，只要保持積極向上的態度，就能獲得意想不到的驚喜優惠，GAP新年賀歲遊戲等你來挑戰！';
        var picture = 'http://gaptaiwan.com.tw/cny/m/img/600x315.png';
        var redirect_uri = 'http://gaptaiwan.com.tw/cny/m/'+page+'.php';

        var share_fb = 'https://www.facebook.com/dialog/feed?' +
            "app_id=" + app_id +
            "&display=popup&caption" + 
            "&link=" + encodeURIComponent(link) +
            "&name=" + encodeURIComponent(name) +
            "&description=" + encodeURIComponent(description) +
            "&picture=" + encodeURIComponent(picture) +
            "&redirect_uri=" + encodeURIComponent(redirect_uri);

        trackWaitJump('fb_share', share_fb);
    }
}

$(function(){
    menu.init();
});