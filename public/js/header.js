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
			$("#sidebar .content li").hide('fast', function(){
				$("#sidebar .content li[name="+name+"]").show('fast', function(){
					$("#sidebar .content").slideDown('fast');
				});
			});
	});

	open.click(function(){
		$(".current .close").toggle();
		$(this).toggle();
		$("#sidebar .content li").hide('fast', function(){
			$("#sidebar .content").slideUp('fast');
		});
		$(".current").removeClass("current");
	});

});