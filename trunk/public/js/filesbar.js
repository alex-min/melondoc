$f.filesbar = {

   toggle:function(e){

   		var el = $("#filesbar");
	    anim = {
			ml : -440
		};
        
        if(el.hasClass('toggle_close')){
	        var anim    = {
            	ml : 80
        	};
        }
        
        $("#filesbar").stop().animate({'top': anim.ml},'fast', function(){
		   		el.toggleClass('toggle_close toggle_open');
		   		return false;
	   	});
	   	return false;
   }

};