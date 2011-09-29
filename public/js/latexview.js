
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
    for (x in pages) {
	cur.innerHTML += "<img onmousedown=\"return false\" class=\"lv_page\" alt=\"page\" src=\"/" + pages[x] + "\" />\n"
         + "<div class=\"lv_spacer\"></div>\n";
    }
    return (cur);
}



window.onload = function() {

    document.getElementById("lv_render").onscroll = function() {
	console.debug(window.pageYOffset);
    }

    var stat = document.getElementById("lv_latexcontent");
    $.post(
	"/index/index",
	{tek : stat.innerHTML},
	function(data) {
	    var lv_s = document.getElementById("lv_status");
	    lv_s.style.display = "none";
	    var res = eval(data);
	    if (res[0] == 0)
	    {		
		var pages = createPages(res[1]);
		lv_s.parentNode.insertBefore(pages, lv_s);		
	    }
	    else
	    { 
		var err = createError("Viewer error", res[1]);
		lv_s.parentNode.insertBefore(err, lv_s);
	    }
	}
    );
}

function lv_zoomin() {
    var listPages = document.getElementsByClassName("lv_page");
    for (i = 0; i < listPages.length; i++)
    {
	listPages[i].width *= 1.2;
	listPages[i].height *= 1.2;
    }
}

function lv_zoomout() {
    var listPages = document.getElementsByClassName("lv_page");
    for (i = 0; i < listPages.length; i++)
    {
	listPages[i].width *= 0.8;
	listPages[i].height *= 0.8;
    }
}
