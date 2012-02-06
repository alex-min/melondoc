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
	$f.ajax({
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

// Fonction qui fais une requete ajax pour le single framework
function $f_ajax(options){
	var url = new Object();
	url.controller = options.url.slice(1).split("/")[0];
	url.action = options.url.slice(1).split("/")[1];
	if (!options.type) options.type = "get";
	if (!options.success) options.success = ajax_success;
	if (!options.error) options.error = ajax_error;
	if (options.action == true || options.action == undefined)
		url.action += "Action";
	jQuery.extend(options.data, url);
	if (options.rewrite == true){
		$.ajax({
			url: "/ajax/index",
			type: options.type,
			data: options.data,
			success: function(data, textStatus){
				options.success(data, textStatus);
			},
			error: function(xhr, ajaxOptions, thrownError){
				options.error(xhr, ajaxOptions, thrownError);
			}
		});
	}
	else{
		$.ajax({
			url: options.url,
			type: options.type,
			data: options.data,
			success: function(data, textStatus){
				options.success(data, textStatus);
			},
			error: function(xhr, ajaxOptions, thrownError){
				options.error(xhr, ajaxOptions, thrownError);
			}
		});
	}
}

// Fonction qui renvoie un obj contenant les elements d'un formulaire
function $f_getform(id)
{
	console.info($("form #"+id).first().serialize());
	return false;
}

function $f_sendform(id){
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
		path				: 	"/public/js",
		identifier			: 	"myaction",
		eventType			: 	"click"
	},

	alert		: 	$f_alert,
	exec		: 	$f_exec,
	require		: 	$f_require,
	ajax		: 	$f_ajax,
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

	class="framework" rel="mouseover-module:action"



	/* Tous les éléments qui possède l'identifiant requis reagisse a l'eventType
	$("["+$f.config.identifier+"]").bind($f.config.eventType, function(){
		$f.exec("module:action", $(this));

		console.log("old");
		var value = $(this).attr($f.config.identifier);
		var module = value.split($f.config.separator, 2)[0];
		var action = value.split($f.config.separator, 2)[1];
		
		var mod,act,funct;
		eval("mod = $f."+module);
		if (mod != undefined){
			eval("act = mod."+action);
			if (act != undefined){
				console.log("its ok")
				eval("funct = $f."+module+"."+action);
				funct();
			}
		}
		if (window.functions[module] && window.functions[module][action]){
			window.functions[module][action]($(this));
			$f.module.action();
		}
		else{
			loadComponent({
				type: "js",																					
				module: module,																		
				action: action,																			
				path: $f.config.path,														
				target: $(this),																			
				callback: function(e){
					$f.dispatch({module: module, action: action, target: e});
				}
			});
		}
	});*/
