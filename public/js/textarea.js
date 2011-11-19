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
		//res1 = epur_balise("<strong></strong><strong> </strong><strong>Salut</strong><strong><italic>toto</italic></strong><strong>titi<italic></italic><br /><strong><strong>toto</strong></strong></strong><strong><strong>titi</strong>toto</strong>");
		//console.log(res1);
		console.log(res1);
		res1 = epur_balise(res1);
		console.log(res1);
		$(current_obj).html(res1);
		window.getSelection().getRangeAt(0).startOffset = 0;
		window.getSelection().getRangeAt(0).endOffset = 0;
	}
});

$(".italic").live('click', function () {
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
		var res = "<i>" + tmp + "</i>";
		var res1 = debut + res + fin;
		//res1 = epur_balise("<strong></strong><strong> </strong><strong>Salut</strong><strong><italic>toto</italic></strong><strong>titi<italic></italic><br /><strong><strong>toto</strong></strong></strong><strong><strong>titi</strong>toto</strong>");
		//console.log(res1);
		console.log(res1);
		res1 = epur_balise(res1);
		console.log(res1);
		$(current_obj).html(res1);
		window.getSelection().getRangeAt(0).startOffset = 0;
		window.getSelection().getRangeAt(0).endOffset = 0;
	}
});

var			tab = new Array;

function	check_balise(i, balise)
{
	var		nb_strong_fermante = 0;
	var		j;
	
	if (tab[i] != undefined)	{
		var test = tab[i].indexOf(balise, 0);
		for (i++; test != 1; )	{
			if (tab[i] != undefined)	{
				if (tab[i].search(balise) == 0)	{
					tab.splice(i, 1);
					nb_strong_fermante++;
					i++;
				}
				else if (tab[i].search("\"") == 0)
					i = epur_multiple_balise(i, 1, 0, balise);
				else
					i++;
				if (tab[i] == undefined)
					break;
				test = tab[i].indexOf(balise, 0)
			}
		}
		for (; nb_strong_fermante > 0; i++)	{
			if (tab[i] != undefined)
				if (tab[i].search(balise) == 1)	{
					tab.splice(i, 1);
					nb_strong_fermante--;
				}
		}
		if (tab[i] != undefined)	{
			if (tab[i].search(balise) == 1)	{
				i++;
				if (tab[i] != undefined)	{
					i = epur_multiple_balise(i, 0, 1, balise);
				}
			}
		}
	}
	return (i);
}

function	epur_multiple_balise(i, start, end, balise)
{
	var		string_empty;

	for (j = 0, string_empty = 0; tab[i][j]; j++)
		if (tab[i][j] != ' ' && tab[i][j] != "\"")
			string_empty = 1;
	i++;
	if 	(tab[i] != undefined) //pensez a faire une condition avec le start et le end pour differencier les 2 cas possibles du splice soit <strong>""</strong> et </strong>""<strong>
		if (tab[i].search(balise) == start && tab[i - 2].search(balise) == end && string_empty == 0)	{
			tab.splice(i, 1);
			tab.splice(i - 1, 1);
			tab.splice(i - 2, 1);
		}
	return (i);
}

function	epur_balise(res1)	{
	res1 = res1.replace(/"/g, "&\"");
	res1 = res1.replace(/<strong>/g, "\"<strong>\"");
	res1 = res1.replace(/<\/strong>/g, "\"</strong>\"");
	res1 = res1.replace(/<i>/g, "\"<italic>\"");
	res1 = res1.replace(/<\/i>/g, "\"</italic>\"");
	res1 = res1.replace(/<br>/g, "\"<br>\"");
	console.log(res1);
	var reg = new RegExp("[<>]+", "g");
	tab = res1.split(reg);

	for (i = 0; i < tab.length; i++)
		if (tab[i] != undefined)	{
			if (tab[i].search("strong") == 0)
				i = check_balise(i, "strong");
		}
		
	for (i = 0; i < tab.length; i++)
		if (tab[i] != undefined)	{
			if (tab[i].search("italic") == 0)
				i = check_balise(i, "italic");
		}
	res1 = "";
	for (i = 0; i < tab.length; i++)	{
		if (tab[i] != undefined)
			res1 += tab[i];
	}
	var		res = "";
	var		j;
	console.log("res1 = " + res1);
	res1 = res1.replace(/\"br\"/g, "<br>");
	res1 = res1.replace(/\"strong\"/g, "<strong>");
	res1 = res1.replace(/"\/strong"/g, "</strong>");
	res1 = res1.replace(/"italic"/g, "<i>");
	res1 = res1.replace(/"\/italic"/g, "</i>");
	for (i = 0, j = 0; res1[i]; )	{
		if (res1[i] == '&' && res1[i + 1] == '"')	{
			res += res1.substring(i, i + 1);
			i++;
		}
		else if (res1[i] == '"')
			i++;
		else	{
			res += res1.substring(i, i + 1);
			i++;
		}
	}
	console.log(res);
	res1 = res;
	res1 = res1.replace(/&\"/, "\"");
	console.log(res1);
	return (res1);
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