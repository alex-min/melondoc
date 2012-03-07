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
   }
   
};