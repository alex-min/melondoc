$f.module = {
    connexion:function(e){
	var	email = $("input[name=email]").val();
	var	password = $("input[name=password]").val();
	var	data = new Object();

	data.email = email;
	data.password = password;
	$f.ajax({
	    url: "/user/connexion",
	    type: "POST",
	    datatype: "JSON",
	    data: data,
	    success: checkConnexion
	});
    }
};

function		checkConnexion(data)
{
    
}