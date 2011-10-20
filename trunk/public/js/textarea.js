var current_obj;

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

var start2;
var end2;

$(".bold").live('click', function () {
	if (window.ActiveXObject) { // C'est IE
        var textRange = document.selection.createRange();            
        var currentSelection = textRange.text;
        textRange.text =  currentSelection ;
    }
	else { // Ce n'est pas IE
		var count = getCharacterOffsetWithin(window.getSelection().getRangeAt(0), current_obj);
		var start = window.getSelection().getRangeAt(0).startOffset;
		var end = window.getSelection().getRangeAt(0).endOffset;
		end = count + (end - start);
		start = count;
		var html = $(current_obj).html();
		if (start == end)
			return;
		checkHTML(html, start, end);
		var debut = html.slice(0, start2);
		var tmp = html.slice(start2, end2);
		var fin = html.slice(end2, html.length);
		var res = "<strong>" + tmp + "</strong>";
		var res1 = debut + res + fin;
//		console.log("debut = " + debut);
//		console.log("tmp = " + tmp);
//		console.log("fin = " + fin);
//		console.log("res1 = " + res1);
		res1 = epur_balise("<strong></strong><strong> </strong><strong>Salut</strong><strong><italic>toto</italic></strong><strong>titi<italic></italic><br /><strong><strong>toto</strong></strong><strong><strong>titi</strong>toto</strong>");
		console.log(res1);
		//$(current_obj).html(res1);
		//window.getSelection().getRangeAt(0).startOffset = 0;
		//window.getSelection().getRangeAt(0).endOffset = 0;
	}
});

function	epur_balise(res1)	{
	res1 = res1.replace(/<strong>/g, "<strong>\"");
	res1 = res1.replace(/<\/strong>/g, "\"</strong>");
	res1 = res1.replace(/<italic>/g, "<italic>\"");
	res1 = res1.replace(/<\/italic>/g, "\"</italic>");
	console.log(res1);
	var reg = new RegExp("[<>]+", "g");
	var tab = res1.split(reg);

//	for (i = 0; i < tab.length; i++)
	//	console.log(tab[i].search("strong"));
	for (i = 0; i < tab.length; i++)	{
		console.log(tab[i]);
	}
}

function	checkHTML(html, start, end)	{
	var tmp = "";
	var len = 0;
	for (var i = 0; html[i]; i++, len++)	{
		if (html[i] == '<')	{
			var j = 1;
			while (html[i] && html[i] != '>')	{
				i++;
				j++;
			}
			start += j;
			end += j;
		}
		if (i >= start)
			break;
	}
	start2 = start;
	end2 = end;
}

$(".ed_area").live('click', function () {
	current_obj = this;
});