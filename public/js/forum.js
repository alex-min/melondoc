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


insert_text:function(open, close)
{
   msgfield = $("[name=answer]")[0];
   console.log(msgfield);
   // IE support
   if (document.selection && document.selection.createRange)
   {
      msgfield.focus();
      sel = document.selection.createRange();
      sel.text = open + sel.text + close;
      msgfield.focus();
   }

   // Moz support
   else if (msgfield.selectionStart || msgfield.selectionStart == '0')
   {
      var startPos = msgfield.selectionStart;
      var endPos = msgfield.selectionEnd;
      var old_top = msgfield.scrollTop;
      msgfield.value = msgfield.value.substring(0, startPos) + open + msgfield.value.substring(startPos, endPos) + close + msgfield.value.substring(endPos, msgfield.value.length);
      msgfield.selectionStart = msgfield.selectionEnd = endPos + open.length + close.length;
      msgfield.scrollTop = old_top;
      msgfield.focus();
   }

   // Fallback support for other browsers
   else
   {
      msgfield.value += open + close;
      msgfield.focus();
   }

 },
 
 insert_link:function()
{
   msgfield = $("[name=answer]")[0];
  
   var link = prompt("adresse du lien : ");
   var text = prompt("Text du lien : ");

   var open = "[url=" + link + "]";
   var close = text + "[/url]";

   var startPos = msgfield.selectionStart;
   var endPos = msgfield.selectionEnd;
   var old_top = msgfield.scrollTop;
   msgfield.value = msgfield.value.substring(0, startPos) + open + msgfield.value.substring(startPos, endPos) + close + msgfield.value.substring(endPos, msgfield.value.length);
   msgfield.selectionStart = msgfield.selectionEnd = endPos + open.length + close.length;
   msgfield.scrollTop = old_top;
   msgfield.focus();
 },

 quote:function(message, author) {
     msgfield = $("[name=answer]")[0];
   open = "[quote=" + author + "]" + message;
   close = "[/quote]";

   if (document.selection && document.selection.createRange)
   {
      msgfield.focus();
      sel = document.selection.createRange();
      sel.text = open + sel.text + close;
      msgfield.focus();
   }

   // Moz support
   else if (msgfield.selectionStart || msgfield.selectionStart == '0')
   {
      var startPos = msgfield.selectionStart;
      var endPos = msgfield.selectionEnd;
      var old_top = msgfield.scrollTop;
      msgfield.value = msgfield.value.substring(0, startPos) + open + msgfield.value.substring(startPos, endPos) + close + msgfield.value.substring(endPos, msgfield.value.length);
      msgfield.selectionStart = msgfield.selectionEnd = endPos + open.length + close.length;
      msgfield.scrollTop = old_top;
      msgfield.focus();
   }

   // Fallback support for other browsers
   else
   {
      msgfield.value += open + close;
      msgfield.focus();
   }
 }

};

