var couponCtrl = {
    init: function(){
        
        gapage('2_coupon');
        
        $('.fb_btn').on('click',function(event){
            event.preventDefault();
            menu.shareFb('coupon');
        });
    }
}

$(function(){
    couponCtrl.init();
});