
$f.filesbar = {

   open:function(e){

   		var el = $("#filesbar");

        if(el.hasClass('toggle_close')){
	        var anim    = {
            	ml : -20
        	};
        	$("#filesbar").stop().animate({'margin-left': anim.ml},'fast', function(){
		   		el.toggleClass('toggle_close toggle_open');
		   		return false;
	   		});
        }
	   	return false;
   },

   close:function(e){
		
		var el = $("#filesbar");
        
   		if(!el.hasClass('toggle_close')){
	        anim = {
	        	ml : -330
	        };
       	
	       	$("#filesbar").stop().animate({'margin-left': anim.ml},'fast', function(){
		   		 el.toggleClass('toggle_close toggle_open');
		   		 return false;
		   	});
	   }
	   return false;
   }

};