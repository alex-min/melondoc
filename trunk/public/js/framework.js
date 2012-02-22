/*
 * New framewrok
 */


// Fonction qui remplace alert(); plus jolie ...
function $f_alert(value)
{
	function getObject(obj, recursion){
		if (typeof(obj) == "object"){
			var value = "{<br/>";
			for (variable in obj){
				for (var i = 0; i <= recursion; i++)
					value += " ; ;";
				value +=  variable + " : ";
				value += getObject(obj[variable], recursion+1)
			}
			value += "\n"
			for (var i = 0; i < recursion; i++)
				value += " ; ;";
			value += "}";
			return value
		}
		else
			return obj;
	}

	value = getObject(value, 0);
    //alert(value);
	dialog({
		content : value,
		callback : function(){}
	});
};

function $f_loadmodule(module, callback) {
	var url = $f.config.path+"/"+module+".js";
	$.ajax({
		type: "GET",
		url: url,
		dataType: "script",
		success: function(data, textStatus) {
			if (callback){
				callback();
			}
		},
		error: function(xhr, ajaxOptions, thrownError){
			console.error("loadComponent : type["+ajaxOptions+"], erreur["+thrownError+"], impossible d'atteindre ["+url+"]");
		}
	});
}

// Fonction qui permet d'executer une fonction autre que $f.myModule.myAction()
function $f_exec(value, el){
	var module = value.split($f.config.separator, 2)[0];
	var action = value.split($f.config.separator, 2)[1];
	var success =
		$f_dispatch({
			'module': module,
			'action': action,
			'target': el
		});
	if (!success){
		$f_loadmodule(module, function(){
			$f_dispatch({
				'module': module,
				'action': action,
				'target': el,
				'error': true
			});
		});
	}
}

// Fonction qui permet d'executer une fonction apres le chargement d'un script
function $f_require(value, callback){	
}



// Fonction qui renvoie un obj contenant les elements d'un formulaire
function $f_getform(id)
{
	var elem = $("form#"+id).first();
	var obj = new Object();
	var count = 0;
	elem.children("input,textarea,select").each(function(index){
		var name = $(this).attr("name");
		if (name == undefined){
			name = "no_name_"+count++;
			console.warn("Attribut `name` non definie. Valeur attribue {"+name+"}");
		}
		var value = $(this).val();
		obj[name] = value;
	});
	var info = {
		"_url_": elem.attr("action"),	
		"_type_": (elem.attr("type") != undefined)?(elem.attr("type")):("POST")
	}
	jQuery.extend(obj, info);
	return obj;
}

function $f_sendform(id, csuccess, cerror)
{
	var obj = $f.getform(id);
	$.ajax({
		type: obj._type_,
		url: obj._url_,
		dataType: "JSON",
		data: obj,
		success: csuccess,
		error: cerror
	});
}

function $f_dispatch(options){
	var mod,act,funct;
	eval("mod = $f."+options.module);
	if (mod != undefined)
	{
		eval("act = mod."+options.action);
		if (act != undefined)
		{
			eval("funct = $f."+options.module+"."+options.action);
			funct();
		}
		else if (options.error)
			console.warn("La fonction ["+options.action+"] n'est pas definie dans le module ["+options.module+"].");
		else
			return false;
	}
	else if (options.error)
		console.warn("Le module ["+options.module+"] n'existe pas.");
	else
		return false;
	return true;
}

window.$f  = {

	config:{
		separator			: 	':',
		path				: 	"/public/js"
	},

	alert		: 	$f_alert,
	exec		: 	$f_exec,
	getform		: 	$f_getform,
	sendform	: 	$f_sendform
}

	/*function fetchForm(e){
		var elem = e.parent("form");
		var obj = new Object();
		if (elem.length > 0){
			elem.children("input,textarea,select").each(function(index){
				var name = $(this).attr("name");
				var value = $(this).val();
				obj[name] = value;
			})
			debug(obj);
		}
		else{
			$("body").children("input,textarea,select").each(function(index){
				var name = $(this).attr("name");
				var value = $(this).val();
				obj[name] = value;
			})
			debug(obj);
		}
		return obj;
	}
	window.fetchForm = fetchForm;

	function ajax_success()	{	info("La requete a bien reussit");	}
	function ajax_error()			{	error("La requete a échouée");		}
	function ajax(obj){
		var url = new Object();
		url.controller = obj.url.slice(1).split("/")[0];
		url.action = obj.url.slice(1).split("/")[1];
		info("Requete ajax: "+url.controller+"/"+url.action);
		if (!obj.type) obj.type = "get";
		if (!obj.success) obj.success = ajax_success;
		if (!obj.error) obj.error = ajax_error;
		jQuery.extend(obj.data, url);
		info(obj.data);
		$.ajax({
			url: "/ajax/index",
			type: obj.type,
			data: obj.data,
			success: obj.success(),
			error: obj.error()
		});
	}




	/*
	** <div click="module:action"></div>
	** <div mouseenter="module:action"></div>
	** <div mouseleave="module:action"></div>
	** <div focusin="module:action"></div>
	** <div focusout="module:action"></div>
	*/

	function dispatcher(e){$f.exec($(this).attr(e.type))};
	$("[click]").live("click", dispatcher);
	$("[mouseenter]").live("mouseenter", dispatcher);
	$("[mouseleave]").live("mouseleave", dispatcher);
	$("[focusin]").live("focusin", dispatcher);
	$("[focusout]").live("focusout", dispatcher);