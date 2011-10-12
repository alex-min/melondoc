$(document).ready(function(){

	$(".close").click(function(){

		$(".current .close, .current .open").toggle();
		
		$(".current").removeClass("current");
		$(this).parent("li").addClass("current");
			
		$(".current .close, .current .open").toggle();
			
			
		var name = $(this).attr("name");
		$("#sidebar .content li").hide('fast', function(){
			$("#sidebar .content li[name="+name+"]").show();
			$("#sidebar .content").slideDown('fast');
		});
	});

	$(".open").click(function(){
		$(".current .close, .current .open").toggle();
		
		var name = $(this).attr("name");
		$("#sidebar .content").slideUp('fast', function(){
			$("#sidebar .content li[name="+name+"]").hide();
		});
		$(".current").removeClass("current");
	});

});