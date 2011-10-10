var ed_focus = undefined;
var ed_cut = 0;
var ed_begin_content = '<div class="ed_content ed_item">'
	    + '<a href="#" onclick="ed_removeItem(this);">'
	    + '<img class="ed_cross" alt="title" src="/public/images/ed_delete_mini.png" />'
        + '</a>'
	    + '<a href="#" onclick="ed_removeItem(this);">'
	    + '<img class="ed_cross" alt="title" src="/public/images/ed_arrow_down.png" />'
        + '</a>';

var ed_end_content = '</div>';
var ed_spacer = '<div class="spacer"></div>';
var ed_textzone = '<textarea class="ed_area" onclick="ed_rememberFocus();"></textarea>';
var ed_button_header = '<div class="ed_block_menu">'
	+ '<a href="#" onclick="ed_removeBlock(this);">'
        + '<img class="ed_menu_icon" alt="title" src="/public/images/ed_delete.png" />'
        + '</a>'
	+ '</div>';
var ed_begin_block = '<div class="ed_block">';
var ed_end_block = '</div><div class="spacer"></div>';
var ed_slide_menu = '<div class="ed_menu_container"><div class="ed_insidemenu">'
    + '<img onclick="ed_appendToBlock(\'\', this, false);" class="ed_menu_icon" alt="title" src="/public/images/ed_title.png" />'
    + '<img onclick="ed_appendToBlock(\'bullets\', this, false);" class="ed_menu_icon" alt="title" src="/public/images/ed_bullets.png" />'
    + '</div>'
    + '<img onclick="ed_insideMenuSlide(this);" class="ed_slide_scroll" alt="show menu" src="/public/images/ed_arrow.png" /></div>';
var ed_begin_block_content = '<div class="ed_block_content">';
var ed_end_block_content = '</div>';

function ed_cleanTree() {
    $("li").each(function() { 	
	
	if ($(this).children().length == 1)
	{
	    if ($($(this).children()[0]).attr("class") == "spacer")
		$(this).remove();
	}
	if ($(this).children().length == 0)
	    $(this).remove();
    });
    $(".ed_block_content").each(function () {
	if ($(this).children().length == 0)
	{
	    $(this).closest(".ed_block").remove();	    
	}
    });
}

function ed_removeBlock(element) {
    $(element).closest(".ed_block").remove();
    ed_cleanTree();
}

function ed_removeItem(element) {
    $(element).closest(".ed_content").remove();
    ed_cleanTree();
}

function ed_insideMenuSlide(element) {
    var menu = $(element.parentNode).find(".ed_insidemenu");
    console.debug(menu.css("width"));
    if (menu.css("width") != "0px") {
	menu.animate({width : "0%"}, 100);
    }
    else {
	menu.animate({width : "100%"}, 100);
    }
}


function getTextareaCursorPos(el) { 
    if (el.selectionStart) { 
	return el.selectionStart; 
    } else if (document.selection) { 
	el.focus(); 
	var r = document.selection.createRange(); 
	if (r == null) { 
	    return 0; 
	} 
	var re = el.createTextRange(), 
        rc = re.duplicate(); 
	re.moveToBookmark(r.getBookmark()); 
	rc.setEndPoint('EndToStart', re);
	return rc.text.length; 
    }  
    return 0; 
}

function ed_rememberFocus()
{
    ed_focus = document.activeElement;
    if (ed_focus.tagName == "TEXTAREA")
	ed_cut = getTextareaCursorPos(ed_focus);
}

function ed_getBlockFocus()
{
    console.log(ed_focus);
    if (ed_focus == undefined)  { return undefined; }
    return (ed_focus.parentNode.parentNode);
}

function ed_createBulletContent(htmlContent)
{
    return (ed_begin_content + '<ul>'
	    + '<li class="ed_item">' + ed_createContent(htmlContent) + ed_spacer
	    + '<li class="ed_item">' + ed_slide_menu + ed_spacer
	    + '</ul>' + ed_end_content);
}

function ed_createContent(htmlContent)
{
    console.log("here");
    return (ed_begin_content + htmlContent + ed_end_content);	    
}

function ed_divideAndCreateBlock()
{
    if (ed_focus != undefined && ed_focus.tagName == "TEXTAREA")
    {
	var cursorPos = getTextareaCursorPos(ed_focus)
	var str = $(ed_focus).val();
	var beginString = str.substring(0, cursorPos);
	var endString = str.substring(cursorPos, str.length);
	if (beginString != "" && endString != "") {
	    $(ed_focus).val(beginString);
	    return (ed_createContent('<textarea class="ed_area" onclick="ed_rememberFocus();">'
				     + endString
				     + '</textarea>'));
	}
	return ("");
	console.debug(beginString);
	console.debug(endString);
    }
    return ("");
}

function ed_appendToBlock(type, from)
{
    ed_createAppendNewBlock(from, type);
}

function ed_createAppendNewBlock(node, blocktype, returnVal)
{
    var additional_begin = "";
    var additional_end = "";
    switch (blocktype) {
    case "bullets":
	var createElemFunc = ed_createBulletContent;
	break;
    case "paragraph":
	console.debug("hello world (miam)");
	var createElemFunc = ed_createBulletContent;	
	break;
    case "upper":
	var createElemFunc = ed_createContent;
	break;
    default:
	var createElemFunc = ed_createContent;
	break;
    }
    var content = createElemFunc(ed_textzone);
    if (node == undefined)
	return (content);
    var parent_item = $(node).closest('.ed_item');
    var balise_name = $(parent_item).get(0).tagName.toLowerCase();
    switch (balise_name)
    {
    case 'li':
	content = '<li>' + content + ed_spacer;
	if (!returnVal)
	    $(parent_item[0]).before(content);
	break;
    default:
	break;
    }
    resizeAllTextArea();
    return (content);
}

function ed_createNewBlock(type, from)
{
    if (ed_focus == undefined || from != undefined)
    {
	var new_content = ed_createAppendNewBlock(undefined, type, true);
	console.debug(new_content);
	var new_block = $("#ed_body").append(ed_begin_block +
					     ed_button_header + ed_begin_block_content
					     + new_content
					     + ed_end_block_content
					     + ed_end_block);
	
	console.log();
	resizeAllTextArea();
    }
    else
    {
	var new_content = ed_createAppendNewBlock(undefined, type, true);
	var addToBlock = ed_divideAndCreateBlock();
	var new_block = $(ed_focus.parentNode).after(new_content + addToBlock);
	new_block.next().find(".ed_area").focus();
	ed_focus = new_block.next().find(".ed_area")[0];	
    }
    resizeAllTextArea();

/*    var bullet_begin = "";
    var bullet;
    var bullet_end = "";
    switch (type) {
    case "bullets":
	bullet_begin = '<ul>';
	var createElemFunc = ed_createBulletContent;
	break;
    default:
	var createElemFunc = ed_createContent;
	break;
    }
    var begin_content = '<div class="ed_block_content">';
    var end_content = '</div>';
    if (from == undefined) {
	if (ed_getBlockFocus() != undefined) {	
		var addToBlock = ed_divideAndCreateBlock();
		var new_block = $(ed_focus.parentNode).after(createElemFunc(
 		    ed_textzone) + addToBlock);
		new_block.next().find(".ed_area").focus();
		ed_focus = new_block.next().find(".ed_area")[0];
	}
	else {
	    var new_content = createElemFunc(ed_textzone);
	    var new_block = $("#ed_body").append(ed_begin_block + ed_button_header +
						 begin_content + new_content
						 + end_content + ed_end_block);
	}
    }
    else
    {
	var cur_elm = $(from).closest('li');
	var addToBlock = ed_divideAndCreateBlock();
	var new_block = $(cur_elm).after(createElemFunc(
 	    ed_textzone) + addToBlock);
	new_block.next().find(".ed_area").focus();
	ed_focus = new_block.next().find(".ed_area")[0];
    }
	resizeAllTextArea();
*/
}

function resizeTextarea(t) {
    lines = t.value.split('\n');
    lineLen = 0;
    var maxLen = 3;
    for (x = 0; x < lines.length; ++x)
    {
	if (lines[x].length > maxLen)
	    maxLen = lines[x].length;
    }
    for (x = 0; x < lines.length; ++x) {
	if (lines[x].length >= t.cols) {
	    lineLen += Math.floor(lines[x].length / t.cols);
	}
    }
    lineLen += lines.length + 1;
    t.rows = lineLen;
    t.cols = maxLen;
}

function resizeAllTextArea() {    $("textarea").each(function () {
    resizeTextarea(this);
    });
		}

document.onkeydown = function checkTextareaSize(e) {
    if (e.which == 9) {
	console.log(document.activeElement.tagName);
	if (document.activeElement.tagName == "TEXTAREA") {
	    document.activeElement.value += '\t';
	}
    }
    if (document.activeElement.tagName == "TEXTAREA") {
	resizeTextarea(document.activeElement);
    }

}
