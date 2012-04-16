$f.document = {

	toggle:function(e){
		$(".selected").removeAttr("class");
		e.attr("class", "selected");
	}

}