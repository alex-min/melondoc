var lv_view = 0;

function createError(title, text) {
    var err = document.createElement("div");
    var t = "";
    for (i in text) {
	t += text[i];
    }    
    err.innerHTML = "<h1>" + title + "</h1>" 
	+ "<p>" + t + "</p>"
	+ "<h2><a href=\"/index/index\">Retourner a l'acceuil</a></h2>";
    err.id = "block_erreur";
    return (err);
}

function createPages(pages)
{
    var cur = document.createElement("div");
    cur.innerHTML = "";
    cur.id = "lv_pagelist";
    for (x in pages) {
	cur.innerHTML += "<img class=\"lv_page\" onmouseover=\"return false;\" alt=\"page\" src=\"/" + pages[x] + "\" />\n";
    }
    return (cur);
}

document.onmousedown = function () {
    console.debug($("#lv_block").is(":focus"));
    var e=arguments[0]||event;
    var x = e.pageX;
    var y = e.pageY;
    var leftOffset = $("#lv_render").css("left");
    if (lv_view == 0) {
	lv_updateview(); }
    document.onmousemove = function(){
	$("#lv_block").css({cursor : "-moz-grabbing"});
	var e=arguments[0]||event;
	var e1 = $("#lv_render").css("left");
	if (parseInt($("#lv_render").css("top")) == NaN)
	    $("#lv_render").css({"top":"1px"});
	if (parseInt($("#lv_render").css("left")) == NaN)
	    $("#lv_render").css({"left":"1px"});	
	var moveX = parseInt($("#lv_render").css("left")) - ((x - e.pageX) * 0.03);
	var moveY = $("#lv_block").scrollTop() + ((y - e.pageY) * 0.03);
	if (lv_view == 1)
	{
	    if (moveX != NaN
		&& moveX < $(".lv_page")[0].width / 5 && moveX > - ($(".lv_page")[0].width * 1.5))
		$("#lv_render").css({left: moveX});
	}
	else
	{
	    if (moveX != NaN
		&& moveX < $(".lv_page")[0].width / 5 && moveX > - ($(".lv_page")[0].width * 0.5)
		&& $(".lv_page")[0].width > $(window).width() )
		$("#lv_render").css({left: moveX});
	}
	document.getElementById("lv_render").style.top = '0px';
	$("#lv_block").scrollTop(moveY)
	document.getElementById("lv_render").scrollTop = 500;
	return false;
    }
    document.onmouseup = function(){
	document.onmousemove=null;
	$("#lv_block").css({cursor : "-moz-grab"});
    }
    return false;
}


function loadPage() {

    var stat = document.getElementById("lv_latexcontent");
    $.post(
	"/index/index",
	{tek : stat.innerHTML},
	function(data) {
	    var lv_s = document.getElementById("lv_status");
	    lv_s.style.display = "none";
	    var res = eval(data);
	    if (res[0] == 0) {		
		var pages = createPages(res[1]);
		lv_s.parentNode.insertBefore(pages, lv_s);		
		lv_updateview();
		document.getElementById("lv_render").onscroll = function() {
		    var scroll = document.getElementById("lv_render").scrollTop;		    
		    var page = parseInt((scroll / 
					document.getElementsByClassName("lv_page")[0].height) * 1.2) + 1;
		    lv_updatepagenumber(page);
		}
		$("#lv_block").css({cursor : "-moz-grab"});
		console.debug("here");
	    } else { 
		$("#lv_block").css({overflow : "hidden"});
		var err = createError("Viewer error", res[1]);
		lv_s.parentNode.insertBefore(err, lv_s);
	    }
	}
    );
}

function lv_single() {
    lv_view = 0;
    $("#lv_render").css(
	{ 'width':'100%', 'position':'relative', 'left':'0px'});
    $(".lv_page").each(function() {
	$(this).css({'float':'none'});
    });
}

function lv_updateview() {
    if (lv_view == 0)
    {
	$("#lv_render").height(($(".lv_page").length ) * ($(".lv_page")[0].width + 10));
	lv_single();
    }
    else
    {
	$("#lv_render").height((($(".lv_page").length - 1) / 2) * ($(".lv_page")[0].width + 10));
	lv_multiple();
    }
}

function lv_multiple() {
   console.debug($(document).width());
    lv_view = 1;
    var left = ($(window).width() - $(".lv_page")[0].width * 2 + 10) / 2;
    var wi = $(".lv_page")[0].width * 2 + 10;
    $("#lv_render").css({'width': $(".lv_page")[0].width * 2 + 10,
	  'position':'relative', 'left':left});
    $(".lv_page").each(function() {$(this).css({'float':'left'});});
}

function lv_updatepagenumber(page) {
    document.getElementById("lv_pagenumber").innerHTML = "Page " + page;    
}

function lv_getpagenumber() {
    var scroll = document.getElementById("lv_render").scrollTop;		    
    return (parseInt((scroll / 
		      document.getElementsByClassName("lv_page")[0].height) * 1.2) + 1);
}

function lv_nextpage() {
    var page = lv_getpagenumber();
    
    document.getElementById("lv_render").scrollTop = 
	page * document.getElementsByClassName("lv_page")[0].height -
	(page * 10 + 30);

}

function lv_prevpage() {
    var page = lv_getpagenumber();
    
    page -= 2;
    if (page == undefined || page < 0)
	return ;
    document.getElementById("lv_render").scrollTop = 
	page * document.getElementsByClassName("lv_page")[0].height;
    - (page * 10 + 30);

}

function lv_zoomin() {
    var listPages = document.getElementsByClassName("lv_page");
    for (i = 0; i < listPages.length; i++)
    {
	listPages[i].width *= 1.2;
    }
    lv_updateview();
}

function lv_zoomout() {
    var listPages = document.getElementsByClassName("lv_page");
    for (i = 0; i < listPages.length; i++)
    {
	listPages[i].width *= 0.8;
    }
    lv_updateview();
}
