function	addButtonTextArea()
{
	$('.img_textarea').html("<img src=\"/public/images/bold.png\" class=\"bold\" alt=\"bold\" title=\"bold\" />");
	$('.img_textarea').append("<img src=\"/public/images/separator.png\" alt=\"bold\" title=\"separator\" />");
	$('.img_textarea').append("<img src=\"/public/images/italic.png\" alt=\"bold\" title=\"italic\" />");
}

$(".bold").live('click', function () {
	selectedText = '';
	// Gecko, Webkit
	var field  = document.getElementById('textarea');
	if (window.ActiveXObject) { // C'est IE
        var textRange = document.selection.createRange();            
        var currentSelection = textRange.text;
        textRange.text =  currentSelection ;
    } else { // Ce n'est pas IE
		var test = document.getElementsByTagName('textarea');
		
		for (i = 0, c = test.length; i < c; i++)
		{
			if (test[i].selectionStart != test[i].selectionEnd)	{
				selectedText = test[i].value.substring(test[i].selectionStart, test[i].selectionEnd);
				test[i].focus();
				var start = test[i].selectionStart;
				var end = test[i].selectionEnd;
				test[i].selectionStart = 0;
				test[i].selectionEnd = 0;
				break;
			}
		}
		var text = test[i].value;
		var res = text.slice(0, start);
		var res1 = text.slice(start, end);
		res += "&lt;strong&gt;" + res1 + "&lt;/strong&gt;" + text.slice(end, text.length);
		//alert(res);
		res = $(test[i]).html(res).text();
		test[i].value = res;
		//test[i].value = res;
		alert(res);
        //selectedText = field.value.substring(field.selectionStart, field.selectionEnd);
    }
});