function getUrlParameter(sParam)
{
    var sPageURL = window.location.search.substring(1);
    var sURLVariables = sPageURL.split('&');
    for (var i = 0; i < sURLVariables.length; i++) 
    {
        var sParameterName = sURLVariables[i].split('=');
        if (sParameterName[0] == sParam) 
        {
            return sParameterName[1];
        }
    }
}

if(getUrlParameter("posts") > 0) {
    var offset = 50;
    var width = $( window ).width();
    if(width < 993) { 
        offset = 0;   
    }
    (function($) {$('html, body').animate({
        scrollTop: $(".news-article-stub:nth-child("+(getUrlParameter("posts")-4)+")").offset().top-offset
    }, 1000);})(jQuery)
}