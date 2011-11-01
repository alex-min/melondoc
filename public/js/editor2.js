var txt_area = '<div contenteditable="true" class="ed_area" title="Title"></div>\n';
var ed_switch_dialog = '<div class="ed_switch_dialog">'
+  '<img class="ed_menu_icon draggable" alt="title" src="/public/images/ed_title.png" />'
+   '<img class="ed_menu_icon draggable" alt="bullets" src="/public/images/ed_bullets.png" />'
'</div>';
var ed_switch_dialog_begin = '<div class="ed_switch_dialog">';
var ed_switch_dialog_end = '</div>';
var ed_switch_dialog = '';
var ed_inside_title = '<img class="ed_switch" src="/public/images/ed_arrow_down.png" />' +  
    '<img class="ed_delete" src="/public/images/ed_delete.png" alt="delete" />\n' + txt_area;
var ed_inside_paragraph = '<img class="ed_delete" src="/public/images/ed_delete.png" alt="delete"></img>\n' + txt_area;
var ed_droppable = '<div class="droppable"></div>\n';
var ed_bullets_begin = '<img class="ed_delete ed_bullets" src="/public/images/ed_delete_bullets.png"/><ul>\n';
var ed_bullets_end = '</ul>\n';
var latex_assoc = new Array();
var ed_begin_document_demo = "\n\\documentclass{article}\n\n\\begin{document}\n\\title{This is a titlw}\n\\author{Alexandre MINETTE \\\\\n  \\texttt{\\dddddfdf{email:andyr@comp.leeds.ac.uk}}}\n\\date{Mai 2011}\n\n\\section{Introduction}\nMath XXX                               %%%(class number and section) \n\\hfill vjdioguiiuih ihsio osoh \\\\\n\\hfill oshfh osf hsoh sfoh sofh sfo hs fosfh. \\\\\n\\hfill sdihf i o s h f ohsfoho hsfos fhos fhohfo shohsfofhs. \\\\\n\\hfill jfospfj osfho shsof hsofh soh ososfhso. \\\\\n\\hfill shfo sjhfosf oshfoshf oshshf oshf osh sofjsofh sofhsofh snfosjfoshfs sofhsofh. \\\\\n\n\\paragraph{\nMdr.}\n\n\\newpage\n\nodfjposdjfpsdjfp spjf psjfps jpsjfp jpjf pj p jp pfj\n\n\\end{document}\n\n";
var doc_x = 0;
var doc_y = 0;
var ed_menu_spacer = '<div style="ed_menu_spacer"></div>';

latex_assoc['ed_title'] = new Array('<title>', '</title>\n');
latex_assoc['ed_paragraph'] = new Array('<paragraph>', '</paragraph>\n');
latex_assoc['ed_bullets'] = new Array('<bullets>\n', '</bullets>\n');
latex_assoc['li'] = new Array('<item> ', '</item>\n');

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
    lineLen = lines.length + 1;
    t.rows = lineLen;
    t.cols = maxLen;
}

function resizeAllTextArea() {    
    $("textarea").each(function () {
	resizeTextarea(this);
    });
}

function html_to_latex(html) {
    var replace = html.replace(/<br *\/?>/g, "\n");
    return (replace);
}

function rec_extract(elem) {
    var txt = '';
    var child = elem.children();	
    for (var t = 0; t < child.length; t++) {
	if (!($(child[t]).hasClass('droppable'))) {
	    if ($(child[t]).hasClass('ed_title'))
	    {
		txt += latex_assoc['ed_title'][0] 
		    +  html_to_latex($($(child[t]).find('div')[0]).html())
		    + latex_assoc['ed_title'][1];
	    }
	   else if ($(child[t]).hasClass('ed_paragraph'))
	    {
		txt += latex_assoc['ed_paragraph'][0] 
		    +  html_to_latex($($(child[t]).find('div')[0]).html())
		    + latex_assoc['ed_paragraph'][1];
	    }
	   else if ($(child[t]).hasClass('ed_bullets'))
	    {
		txt += rec_extract($(child[t]));
	    }
	    else if ($(child[t]).get(0).tagName.toLowerCase() == "ul")
		txt += latex_assoc['ed_bullets'][0] + rec_extract($(child[t])) + latex_assoc['ed_bullets'][1];
	    else if ($(child[t]).get(0).tagName.toLowerCase() == "li")
	    {
		var tmp = rec_extract($(child[t]));
		if (tmp != '')
		    txt += latex_assoc['li'][0] + tmp + latex_assoc['li'][1];
	    }
	    else
		rec_extract($(child[t]));
	}
    }
    return (txt);
}
	
function ed_generateLatex() {
    var txt = '<xml>\n';
    $('.ed_documentarea').each(function () {
//	console.log($(this));
	txt += rec_extract($(this));
    });
    txt += '\n</xml>';
    alert(txt);
}

function ed_renderToLatex()
{
    $.post("/latexview/index",
	   {tek : ed_begin_document_demo},
	   function (data) {
	       console.log($('.ed_frame'));
	       $('.ed_frame').html(data);
	       $('.ed_popup').css({display: 'block'});
	       console.log(data);
	       loadPage();	       
	   });    
}


$('.ed_viewer').click(function () {
    if ($('.ed_popup').css('display') == 'none') {
	ed_renderToLatex();
	$('.ed_popup').css({display:'block'});
    }
    else {
	$('.ed_popup').css({display:'none'});
    }
});

$('.ed_area').live('keydown', function () {
    var cur_area = $(this);
    $(".ed_area").each(function () {
	if ($(this).attr("_moz_dirty") !== undefined) {
	    console.log($(this));
	    $(this).remove();
//	    cur_area.remove();
//	console.log("here !!");
	    cur_area.text(cur_area.text() + 'lol');
	}
    });
       
});

$('.ed_area').live('click', function () {

});

$(".ed_documentarea").live('click', function (event) {    

});


$(".ed_delete").live('click', function () {
    $(this).parent().remove();
    $('.ed_block').each(function () {
	if ($(this).children().length == 0)
	    $(this).remove();
    });
    var c = 1;
    while (c) {
	c = 0;
	$(".droppable").each(function () {
	    if ($(this) != undefined &&
		$(this).parent() != undefined &&
		$(this).parent().get(0) != undefined &&
		$(this).parent().get(0).tagName.toLowerCase() == "li") {
		if ($($(this).parent().next().children()[0]).hasClass('droppable')) {
		    $($(this).parent().next().children()[0]).remove();			
		}
	    }
	    if ($(this).next().hasClass('droppable')) {
		$(this).remove();
		c = 1;
	    }
	});
    }
    $('li').each(function () {
	if ($(this).children().length == 0)
	    $(this).remove();
    });
    $('li').each(function () {	
	// if they are two droppable 
	if ($(this).next().length == 1 && $(this).next().get(0).tagName.toLowerCase() == "li"
	   && $(this).length == 1 && $(this).children().hasClass("droppable") && 
	    $(this).next().children().hasClass("droppable"))
	    $(this).remove();
    });
});


function ed_switchHandler (event) {
    $(this).die();
    console.log("HELLO WORLD\n");
   $(".ed_switch_dialog").css({
	visibility:'visible',
	position:'absolute',
	top:$(this).position().top + $(this).height() + 5 + 'px',
	left:$(this).position().left + parseInt($(this).css("margin-left")) + 'px'
    });
    $(".ed_switch_dialog").slideToggle(800);    
    return (false);
}


$("#ed_textzone").append('<div ieclass="ed_documentarea" class="ed_documentarea"></div>');
$('.ed_documentarea').css({display: 'block', width: doc_x + 'px', height: doc_y + 'px'});

$("#ed_menu").live('click', function () {
    // remove draggable propertie
    $('.ed_menu_icon').each(function() {$(this).removeClass('draggable');});    
//    console.debug("here");
    
});

function dropTable(active_element) {
    $("#ed_table_menu").css({top: active_element.position().top + 'px',
			     left: active_element.position().left + 'px',
			     display : 'block'
			    });
}

function dropEvent(event, ui) {
    console.log(ui);
    var active_element = $($('.dr_active')[0]);
    switch(ui.draggable.attr('alt')) {
    case 'title':
	droppable_to_title(active_element);	  
	break;
    case 'bullets':
	droppable_to_bullets(active_element);
	break;
    case 'paragraph':
	droppable_to_paragraph(active_element);
	break;
    case 'table':	
	dropTable(active_element);
	break;
    default:
	alert('Draggable element ' + ui.draggable.attr('alt') + ' not implemented yet !');
	break;
    }
    $('.dr_active').each(function () {
	$(this).removeClass('dr_active');
    });
    $('.ed_switch').bind('click', ed_switchHandler);
}


$(document).ready(function () {
    var x = $(document).width() - $(document).width() / 3;
  //  var y = $(document).height();
    var y = 5000;
    if (navigator.appVersion.match(/MSIE/) || 1) { // FIX IE8 BUG
	$('.ed_documentarea').css({display: 'block', width: x + 'px', height: y + 'px'});
	doc_x = x;
	doc_y = y;
/*	$("style").append('<div inside=".ed_documentarea {display:block'
			  + ';width:' + x + 'px'
			  + ';height:' + y + 'px' + '}"></div>');*/
    }
    else {
	$("style").append('.ed_documentarea {display:block'
			  + ';width:' + x + 'px'
			  + ';height:' + y + 'px' + '}');
    }
    $('.draggable').each(function () { $(this).draggable(
	{
	    cursor : 'move',
	    helper: draggableHelper,
	    drag : dragCall,
	    drop : dropEvent
	}
    );});

    $('.droppable').droppable( {
	drop: dropEvent,
	over: overEvent,
	out: outEvent
    } );
    resizeAllTextArea();
    $('.ed_documentarea').css({display: 'block', width: doc_x + 'px', height: doc_y + 'px'});
    if ($(".ed_switch_dialog").length == 0) {
	ed_switch_dialog += ed_switch_dialog_begin;
	$('.ed_switchable').each(function () {
	    if ($(this).hasClass("ed_switchable")) {
		ed_switch_dialog += ed_menu_spacer + $(this).clone().wrap('<div>').parent().html();
	    }
	});
	ed_switch_dialog += ed_switch_dialog_end;
	$("body").html(ed_switch_dialog + $("body").html());
	$(".ed_switch_dialog").slideToggle(800);
    }
});

function droppable_to_title(drop) {
    var type = drop.parent().get(0).tagName.toLowerCase();
    var add_before_title = '';
    var add_before_droppabe = '';
    var add_after_title = '';
    var add_after_droppable = '';    

    if (type == 'li') {
	add_before_title = '<li>';
	add_before_droppabe = '<li>';
	add_after_droppable = '</li>\n';
	add_after_title = '</li>\n';
    }
    
    drop.removeClass('droppable dr_active ui-droppable');
    drop.addClass("ed_block ed_title");
    drop.html(add_before_title + ed_inside_title);
    if (type == 'li')
	drop = drop.parent();
    drop.before(add_before_droppabe + ed_droppable + add_after_droppable);
    drop.after(add_before_droppabe + ed_droppable + add_after_droppable);
    $('.droppable').droppable( {
	drop: dropEvent,
	over: overEvent,
	out: outEvent
    } );
}


function droppable_to_paragraph(drop) {
    var type = drop.parent().get(0).tagName.toLowerCase();
    var add_before_title = '';
    var add_before_droppabe = '';
    var add_after_title = '';
    var add_after_droppable = '';    

    if (type == 'li') {
	add_before_title = '<li>';
	add_before_droppabe = '<li>';
	add_after_droppable = '</li>\n';
	add_after_title = '</li>\n';
    }
    
    drop.removeClass('droppable dr_active ui-droppable');
    drop.addClass("ed_block ed_paragraph");
    drop.html(add_before_title + ed_inside_title);
    if (type == 'li')
	drop = drop.parent();
    drop.before(add_before_droppabe + ed_droppable + add_after_droppable);
    drop.after(add_before_droppabe + ed_droppable + add_after_droppable);
    $('.droppable').droppable( {
	drop: dropEvent,
	over: overEvent,
	out: outEvent
    } );
}

function droppable_to_bullets(drop) {
    var type = drop.parent().get(0).tagName.toLowerCase();
    var add_before_title = '';
    var add_before_droppabe = '';
    var add_after_title = '';
    var add_after_droppable = '';    
    if (type == 'li') {
	add_before_title = '\n';
	add_before_droppabe = '<li>\n';
	add_after_droppable = '</li>\n';
	add_after_title = '</li>\n';
    }
    drop.droppable({disabled: true});
    drop.removeClass('droppable dr_active ui-droppable');
    drop.addClass("ed_block ed_bullets");
    drop.html(ed_bullets_begin
	      + '<li>\n' + ed_droppable + '</li>\n'
	      + ed_bullets_end);    
    if (type == 'li')
	drop = drop.parent();
    drop.before(add_before_droppabe + ed_droppable + add_after_droppable);
    drop.after(add_before_droppabe + ed_droppable + add_after_droppable);
    $('.droppable').droppable( {
	drop: dropEvent,
	over: overEvent,
	out: outEvent
    } );
}

function outEvent(event, ui) {    
    $('.droppable').each(function () {
	$(this).removeClass('dr_active');

    });
    $('.dr_active').each(function () {
	$(this).removeClass('dr_active');
    });
}

function overEvent(event, ui) {    
    $(this).addClass('dr_active');    
}

function dragCall(event, ui)  {
}

function draggableHelper () {    
    var img = '<img id="drag_elm" src="/public/images/ed_content.png" width="50" height="50"/>';
    
    if ( navigator.appVersion.match(/MSIE 8.0/) || navigator.appVersion.match(/MSIE 7.0/)) {
	$(document).append(img);
	console.log('hello world');
	$(document).mousemove(function (e) {
	    $('#drag_elm').css({diplay:'block', position:'fixed', top: e.pageY + 'px', left: e.pageX + 'px'});
	});
	document.onmouseup = function () {
	    $('#drag_elm').css({display:'none'});
//	    document.onmousedown = undefined;
//	    document.onmouseup = undefined;
	}
    }
    return ('<img id="drag_elm" src="./public/images/ed_content.png" width="50" height="50"/>');
}

function loadXMLDoc(XMLname)
{
    var xmlDoc;
    if (window.XMLHttpRequest)
    {
	xmlDoc=new window.XMLHttpRequest();
	xmlDoc.open("GET",XMLname,false);
	xmlDoc.send("");
	return xmlDoc.responseXML;
    }
// IE 5 and IE 6
    else if (ActiveXObject("Microsoft.XMLDOM"))
    {
	xmlDoc=new ActiveXObject("Microsoft.XMLDOM");
	xmlDoc.async=false;
	xmlDoc.load(XMLname);
	return xmlDoc;
    }
    alert("Error loading document!");
    return null;
}

function ed_table_menu_add_col(number) {
    if ($("#ed_table_menu table tr").first().children().length > 20)
	return ;
     $("#ed_table_menu table").each(function () {
	for (var i = 0; i < number; ++i) {	    
	    $("#ed_table_menu tr").append('<td class="inactive"></td>');
	    $("#ed_table_menu td").hover(ed_table_menu_td_hover_in, function(){});
	}
    });
}

function ed_table_menu_add_line(number) {
    console.log(number);
    if ($("#ed_table_menu table tr").length > 20)
	return ;
    $("#ed_table_menu table").each(function () {
	for (var i = 0; i < number; ++i) {
	    console.log(new String($("#ed_table_menu table")[0]));
	    var line = $('<div>').append($('#ed_table_menu tr').first().clone()).remove().html();
	    $("#ed_table_menu table").append(line);
	    $("#ed_table_menu td").hover(ed_table_menu_td_hover_in, function(){});
	}
    });
}

var ed_table_menu_td_hover_in = function (){};
$("#ed_table_menu td").hover(
    function table_menu_td_hover_in (){
	ed_table_menu_td_hover_in = table_menu_td_hover_in;
	$(this).addClass("active");$(this).removeClass("inactive");
	var y = $(this).parent().index();
	var x = $(this).index();	
	$("#ed_table_menu caption").html((x + 1) + ' x ' + (y + 1));
	if (x >= 2 || y >= 2) {
	    if (x > $(this).parent().children().length - 3) {
		ed_table_menu_add_col($(this).parent().children().length - 1 - x);
	    }
	    else if (x > 2) {
		$("#ed_table_menu td").each(function () {
		    if ($(this).index() > x + 2)
			$(this).remove();
		});
		console.log("need to delete");
	    }
	    if (y > $(this).parent().parent().children().length - 3) {
		ed_table_menu_add_line($(this).parent().parent().children().length - 1 - y);
	    }
	    else if (y > 2) {
		$("#ed_table_menu tr").each(function () {
		    if ($(this).index() > y + 2)
			$(this).remove();
		});
	    }
	}
	$("#ed_table_menu td").each(function () {
	    var cur_x = $(this).index();
	    var cur_y = $(this).parent().index();
	    if (cur_x <= x && cur_y <= y) {
		$(this).addClass("active");$(this).removeClass("inactive");
	    }
	    else {
		$(this).addClass("inactive");$(this).removeClass("active");
	    }
	    
	});
    },
    function(){
	}
);

/* function xml_to_block(content)
{
    var doc = HTMLtoDOM(content);
    $(doc).each(function () { console.log($(this).get(0).tagName);});
//    console.log(xml2array(content));
}


xml_to_block("<html><head></head><body><p>hello</p></body></html>"); */