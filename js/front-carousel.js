(function($) {
    function change_background() {
        curImg++;
        $(".header-image").css({"background-image" : "url(" +ImageArray[curImg%ImageArray.length] + ")"});
        $("#feature-title").html("<i>" + titleArray[curImg%captionArray.length] + "</i>");
        $("#feature-caption").html(captionArray[curImg%captionArray.length]);
    }
    //setInterval(change_background, 4000);

	header_url = $("a.title").attr("href");
	$(".header-image").wrap("<a href='" + header_url + "'/>");
})(jQuery)