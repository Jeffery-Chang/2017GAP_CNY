var storeCtrl = {
    init: function(){
        
        gapage('stores_stores');
        
        $('.tab li').on('click', function(event){
            event.preventDefault();
            storeCtrl.scrollClick($(this));
        });
    },
    scrollClick: function(event){
        var hash = event.attr('class');
        $('html,body').stop().animate({
            scrollTop: $('.store_block.' + hash).offset().top
        }, 750);
    }
}

$(function(){
    storeCtrl.init();
});