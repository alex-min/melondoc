var ed_focus = undefined;
var ed_cut = 0;

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

function ed_createContent(htmlContent)
{
    return ('<div class="ed_content">'
	    + '<a href="#" onclick="lv_zoomin();">'
	    + '<img class="ed_cross" alt="title" src="/public/images/ed_delete_mini.png" />'
            + '</a>'
	    + htmlContent
	    + '</div>');
}

function ed_divideAndCreateBlock()
{
    if (ed_focus.tagName == "TEXTAREA")
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
}

function ed_createNewBlock()
{
    var begin = '<div class="ed_block">';
    var end = '</div><div class="spacer"></div>';
    var header = '<div class="ed_block_menu">'
	+ '<a href="#" onclick="lv_zoomin();">'
        + '<img class="ed_menu_icon" alt="title" src="/public/images/ed_delete.png" />'
        + '</a>'
	+ '<a href="#" onclick="lv_zoomin();">'
        + '<img class="ed_menu_icon" alt="change type" src="/public/images/ed_arrow_down.png" />'
	+ '</a>'
	+ '</div>';
    var begin_content = '<div class="ed_block_content">';
    var end_content = '</div>';
    if (ed_getBlockFocus() != undefined) {
	var addToBlock = ed_divideAndCreateBlock();
	var new_block = $(ed_focus.parentNode).after(ed_createContent(
 	    '<textarea class="ed_area" onclick="ed_rememberFocus();"></textarea>') + addToBlock);
	console.debug("hello");
	console.debug(new_block.next());
	new_block.next().find(".ed_area").focus();
	ed_focus = new_block.next().find(".ed_area")[0];
    }
    else {
	var new_content = ed_createContent('<textarea class="ed_area" onclick="ed_rememberFocus();"></textarea>');
	console.debug(ed_getBlockFocus());
	var new_block = $("#ed_body").append(begin + header +
			       begin_content + new_content
			       + end_content + end);
    }
	resizeAllTextArea();

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
    console.debug(getTextareaCursorPos(document.activeElement));
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
