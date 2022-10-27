(function($){
    function filter(year) {
        $(".exhibit-prev").addClass("hidden");
        $(".exhibit-prev-link").removeClass("selected-year");
        $("#select-"+year).addClass("selected-year");
        if(year == 0) {
            var exhibits = new Array();
            var current = new Array();
            
            $(".exhibit-prev").each(function(i,obj) {
                if(new Date(obj.getAttribute('enddate')) >= new Date()){ 
                    if(new Date(obj.getAttribute('startdate')) <= new Date()) {
                        current.push({id: "#"+obj.getAttribute("id"), date : new Date(obj.getAttribute("startdate"))});
                    } else {
                        exhibits.push({id: "#"+obj.getAttribute("id"), date : new Date(obj.getAttribute("startdate"))});
                    }
                }
                
            });
            
            exhibits.sort(function(a, b) {
                return a.date>b.date ? -1 : a.date<b.date ? 1 : 0;
            });
            current.sort(function(a, b) {
                return a.date>b.date ? -1 : a.date<b.date ? 1 : 0;
            });
            
            for(var key in exhibits) {
                $("#main").prepend($(exhibits[key].id));
                $(exhibits[key].id).removeClass("hidden");
            }
            for(var key in current) {
                $("#main").prepend($(current[key].id));
                $(current[key].id).removeClass("hidden");
            }
                        
        } else if(year == 1) {
            $(".exhibit-prev").removeClass("hidden");
        }else {
            var exhibits = new Array();
            
            $("."+year).each(function(i,obj) {
                exhibits.push({id: "#"+obj.getAttribute("id"), date : new Date(obj.getAttribute("startdate"))});             
            });
            
            exhibits.sort(function(a, b) {
                return a.date>b.date ? -1 : a.date<b.date ? 1 : 0;
            });
            
            exhibits.reverse();
            for(var key in exhibits) {
                $("#main").prepend($(exhibits[key].id));
                $(exhibits[key].id).removeClass("hidden");
            }
        }
    }
    filter(0);
})(jQuery)