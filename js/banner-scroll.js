(function($) {
    $(window).scroll(function(e) {
        if($(window).width() < 991) {
        $('.banner').css({'position': 'relative'});
            return;
        } else {
            $el = $('.banner');
            if ($(this).scrollTop() > 50 && $el.css('position') != 'fixed'){
            $('.banner').css({'position': 'fixed', 'top': '0px', 'padding-top': '24px'});
                $('.banner').addClass('drop-shadow');
            }
            if ($(this).scrollTop() < 50 && $el.css('position') == 'fixed')
            {
            $('.banner').css({'position': 'absolute', 'top': '50px', 'padding-top': '30px'});
            $('.banner').removeClass('drop-shadow');

            }
        }
    })
})(jQuery)