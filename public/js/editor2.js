
$(".ed_documentarea").live('click', function () {    

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

});

function dropEvent(event, ui) {
    
}

function outEvent(event, ui) {
    $('.droppable').each(function () {
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


