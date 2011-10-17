document.getElementByClassName = function(className, elmt)
{
   var selection = new Array();
   var regex = new RegExp("\\b" + className + "\\b");

   // le second argument, facultatif
   if(!elmt)
      elmt = document;
   else if(typeof elmt == "string")
      elmt = document.getElementById(elmt);
   
   // on sélectionne les éléments ayant la bonne classe
   var elmts = elmt.getElementsByTagName("*");
   for(var i=0; i<elmts.length; i++)
      if(regex.test(elmts[i].className))	{
			test = elmts[i].firstChild;
			console.log(test.anchorOffset);
			selection.push(elmts[i].innerHTML);
		 }

   return selection;
}

function	addButtonTextArea()
{
	$('.img_textarea').html("<img src=\"/public/images/bold.png\" class=\"bold\" alt=\"bold\" title=\"bold\" />");
	$('.img_textarea').append("<img src=\"/public/images/separator.png\" alt=\"bold\" title=\"separator\" />");
	$('.img_textarea').append("<img src=\"/public/images/italic.png\" alt=\"bold\" title=\"italic\" />");
}

function getCharacterOffsetWithin(range, node) {
    var treeWalker = document.createTreeWalker(
        node,
        NodeFilter.SHOW_TEXT,
        function(node) {
            var nodeRange = document.createRange();
            nodeRange.selectNode(node);
            return nodeRange.compareBoundaryPoints(Range.END_TO_END, range) < 1 ?
                NodeFilter.FILTER_ACCEPT : NodeFilter.FILTER_REJECT;
        },
        false
    );

    var charCount = 0;
    while (treeWalker.nextNode()) {
        charCount += treeWalker.currentNode.length;
    }
    if (range.startContainer.nodeType == 3) {
        charCount += range.startOffset;
    }
    return charCount;
}

$(".ed_area").live('click', function () {
	selectedText = '';
	var field  = document.getElementById('div');
	
	if (window.ActiveXObject) { // C'est IE
        var textRange = document.selection.createRange();            
        var currentSelection = textRange.text;
        textRange.text =  currentSelection ;
    } else { // Ce n'est pas IE
		var count = getCharacterOffsetWithin(window.getSelection().getRangeAt(0), this);
		var start = window.getSelection().getRangeAt(0).startOffset;
		var end = window.getSelection().getRangeAt(0).endOffset;
		end = count + (end - start);
		start = count;
		var text2 = document.getSelection();
		var text = $(this).text();
		var html = $(this).html();
		
		var debut = text.slice(0, start);
		var tmp = text.slice(start, end);
		var fin = text.slice(end, text.length);
		var res = "<strong>" + tmp + "</strong>";
		var res1 = debut + res + fin;
		console.log(window.getSelection().getRangeAt(0).startOffset);
		console.log(window.getSelection().getRangeAt(0).endOffset);
		console.log(res1);
		$(this).html(res1);
		//window.getSelection().getRangeAt(0).startOffset = 0;
		//window.getSelection().getRangeAt(0).endOffset = 0;
    }
});