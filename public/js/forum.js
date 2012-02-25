$f.forum = {
   
   checkboxAll:function(e){
   		
   		var checkboxs = e.parent('form').children('input[type=checkbox]');
   		if ( e.is(":checked") ){
   			checkboxs.each(function(){
	   			$(this).attr('checked', true);
	   		});
   		} else {
   			checkboxs.each(function(){
	   			$(this).attr('checked', false);
	   		});
   		}
   }
   
};