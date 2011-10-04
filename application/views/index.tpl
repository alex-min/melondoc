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