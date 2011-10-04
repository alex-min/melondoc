$(document).ready(function(){

	var close = $(".close");
	var open = $(".open");
	
	close.click(function(){
	
		$(".current .close").toggle();
		$(".current .open").toggle();
		$(".current").removeClass("current");
		$(this).parent("li").addClass("current");
			
			
		$(".current .open").toggle();
		$(this).toggle();
			
		var name = $(this).attr("name");
		$("#content li").hide('fast', function(){
			$("#content li[name="+name+"]").show('fast');
		});
		$("#content").slideDown('medium');
	});
		
	open.click(function(){
		$(".current .close").toggle();
		$(this).toggle();
		$("#content li").hide('fast');
		$("#content").slideUp('medium');
		$(".current").removeClass("current");
	});

});