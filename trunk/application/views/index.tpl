
<div id="sidebar">
	
	<div id="content" style="display: none">
		<ul>
			<li name="index" style="display: none;">
				CONTENT INDEX :
				<input type="text" />
				<input type="text" />
			</li>
			<li name="media" style="display: none;">CONTENT MEDIA</li>
			<li name="forum" style="display: none;">CONTENT FORUM</a></li>
		</ul>
	</div>
	<div class="tab">
		<ul>
			<li>
				<a class="open" style="display: none;" name="index" href="#">Index</a>
				<a class="close" style="display: inline;" name="index" href="#">Index</a>
			</li>
			<li>
				<a class="close" style="display: inline;" name="media" href="#">Media</a>
				<a class="open" style="display: none;" name="media" href="#">Media</a>
			</li>
			<li>
				<a name="forum" href="/forum">Forum</a>
			</li>
		</ul>
	</div>
</div>

<script type="text/javascript">

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
			$("#content").slideUp('medium');
			$(".current").removeClass("current");
		});
		
</script>
<script type="text/javascript">

function log_resultat(value){
	if (value)
		console.info("Validate");
	else
		console.info("Cancel");
}


function myalert(value){

	function getObject(obj, recursion){
		if (typeof(obj) == "object"){
			var value = "{<br/>";
			for (variable in obj){
				for (var i = 0; i <= recursion; i++)
					value += "&nbsp;&nbsp;";
				value +=  variable + " : ";
				value += getObject(obj[variable], recursion+1)
				console.info(variable);
				console.info(obj[variable]);
			}
			value += "<br/>"
			for (var i = 0; i < recursion; i++)
				value += "&nbsp;&nbsp;";
			value += "}";
			return value
		}
		else
			return obj;
	}

	value = getObject(value, 0);
	dialog({
		content : value,
		callback : alert
	});
}
window.$alert = myalert;

obj = new Object();
obj.toto = new Object();
obj.toto.test = "plop"

//$alert(obj);

</script>