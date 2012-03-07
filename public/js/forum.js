$f.forum = {
   
   checkboxAll:function(e){
   		var checkboxs = $("#form .check");
         $f.log(checkboxs);
   		if ( e.is(":checked") ){
   			checkboxs.each(function(){
	   			$(this).attr('checked', true);
	   		});
   		} else {
   			checkboxs.each(function(){
	   			$(this).attr('checked', false);
	   		});
   		}
   },

   supCat:function(e){
      $.ajax({
         url: '/adminForum/manageCat',
         type: 'POST',
         dataType: 'json',
         data: 'sup='+e.attr('name'),
         success: function(data, textStatus) {
            $f.log(data);
         },
         error: function () { $f.alert('error'); }
      });
   }
   
};