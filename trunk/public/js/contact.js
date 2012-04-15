$f.contact = {
   
   enable_precise:function(e){
      var precise = $('#contact input[name=precise]');
      precise.removeAttr('disabled');
   },

   disable_precise:function(e){
      var precise = $('#contact input[name=precise]');
      precise.attr('disabled', 'true');
   },

   send_formulaire:function(e){
      $f.sendform('#contact');
   },

   precise_fonction:function(e){
      var precise = $('#contact input[name=precise]');
      if (e.val() == "other")
         precise.removeAttr('disabled');
      else
         precise.attr('disabled', 'true');
   }
   
};