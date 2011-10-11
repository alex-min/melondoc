var txt_area = '<div contenteditable="true" class="ed_area" title="Title"></textarea>\n';
var ed_inside_title = '<img class="ed_delete" src="/public/images/ed_delete.png" alt="delete"></img>\n' + txt_area;
var ed_inside_paragraph = '<img class="ed_delete" src="/public/images/ed_delete.png" alt="delete"></img>\n' + txt_area;
var ed_droppable = '<div class="droppable"></div>\n';
var ed_bullets_begin = '<ul>\n';
var ed_bullets_end = '</ul>\n';
var latex_assoc = new Array();
latex_assoc['ed_title'] = new Array('\\title\{', '\}');
latex_assoc['ed_paragraph'] = new Array('\\paragraph\{', '\}');

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

function rec_extract(elem) {
    var txt = '';
    var child = elem[0].children;	
    for (t = 0; t < child.length; t++) {
	if (!($(child[t]).hasClass('droppable'))) {
	    if ($(child[t]).hasClass('ed_title'))
	    {
		txt += latex_assoc['ed_title'][0] 
			+  $($(child[t]).find('textarea')[0]).attr('value')
		    + latex_assoc['ed_title'][1];
	    }
	    if ($(child[t]).hasClass('ed_paragraph'))
	    {
		txt += latex_assoc['ed_paragraph'][0] 
			+  $($(child[t]).find('textarea')[0]).attr('value')
		    + latex_assoc['ed_paragraph'][1];
	    }
	    console.log($(child[t]));
	}
    }
    return (txt);
}

function ed_generateLatex() {
    var txt = '';
    $('.ed_documentarea').each(function () {
	console.log($(this));
	txt += rec_extract($(this));
    });
    alert(txt);
}

$(".ed_documentarea").live('click', function () {    

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
});

$("#ed_textzone").append('<div class="ed_documentarea"></div>');


$("#ed_menu").live('click', function () {
    // remove draggable propertie
    $('.ed_menu_icon').each(function() {$(this).removeClass('draggable');});    
    console.debug("here");
});

$(document).ready(function () {
    var x = $(document).width() - $(document).width() / 3;
    var y = $(document).height();
    $("style").append('.ed_documentarea {display:block'
		     + ';width:' + x + 'px'
		     + ';height:' + y + 'px' + '}');
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
    if (type == 'li') {
	add_before_title = '<li>';
	add_before_droppabe = '<li>';
    }
    
    drop.removeClass('droppable dr_active ui-droppable');
    drop.addClass("ed_block ed_paragraph");
    drop.html(add_before_title + ed_inside_title);
    drop.before(add_before_droppabe + ed_droppable);
    drop.after(add_before_droppabe + ed_droppable);
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
    console.debug(ed_bullets_begin
	      + '<li>\n' + ed_droppable + '</li>\n'
		  + ed_bullets_end);
    console.debug(add_before_droppabe + ed_droppable + add_after_droppable);
    console.log(add_after_title + 
		add_before_droppabe + ed_droppable + add_after_droppable);
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

function dropEvent(event, ui) {
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
    default:
	alert('Draggable element' + ui.draggable.attr('alt') + ' not implemented yet !');
	break;
    }
    $('.dr_active').each(function () {
	$(this).removeClass('dr_active');
    });
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
    return ('<img id="drag_elm" src="./public/images/ed_content.png" width="50" height="50"/>');
}


