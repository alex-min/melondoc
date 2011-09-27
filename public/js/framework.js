$(document).ready(function(){

	function fetchForm(e){
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

	function dispatch(options)	{
		try			{	functions[options.module][options.action](options.target);	}
		catch(e)	{	error("Erreur survenue dans le dispatch:"+e);							}
	}
	
	/* Fonction de debugug (affiche les infos dans la console)*/
	function info(msg)			{	console.info(msg)			}
	window.info = info;
	
	function warn(msg)		{	console.warn(msg);		}
	window.warn = warn;
	
	function error(msg)		{	console.error(msg);		}
	window.error = error;
	
	function debug(msg)	{	console.debug(msg);	}
	window.debug = debug;

	/*
	 * 		ajax({
	 * 			url: "/index/action",
	 * 			data: obj,
	 * 			
	 * 		});
	 */
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


	$("#test").click(function(){
		ajax({
			url: "/index/testAction",
			data: { test: "toto", plop: 1}
		});
	});
		
	/* Fonction qui charge un fichier js*/
	function loadComponent(options){
	
		var url = options.path+"/"+options.module+"."+options.type;
		$.ajax({
			type: "GET",
			url: url,
			dataType: "script",
			success: function() {
				info("Chargement de ["+url+"] termine.")
				if (!functions[options.module])
					error("["+options.module+"] introuvable dans ["+url+"]");
				else if (!functions[options.module][options.action])
					error("Le module ["+options.module+"] ne contient aucune définition de ["+options.action+"] dans ["+url+"]");
				else
					options.callback(options.target);
			},
			error: function(xhr, ajaxOptions, thrownError){
				error("loadComponent : type["+ajaxOptions+"], erreur["+thrownError+"], impossible d'atteindre ["+url+"]");
			}
		});
	
	}

	/* Tous les éléments qui possède l'identifiant requis reagisse a l'eventType*/
	$("["+window.config.identifier+"]").bind(window.config.eventType, function(){
		/* On récupère les différentes données de l'attribut*/
		var value = $(this).attr(window.config.identifier);
		var module = value.split(window.config.separator, 2)[0];
		var action = value.split(window.config.separator, 2)[1];
		
		/* Si on trouve une action qui correspond a celle voulu dans un module donnée on l execute*/
		if (window.functions[module] && window.functions[module][action])
			window.functions[module][action]($(this));
		/* Sinon on charge le fichier et ses composants puis on execute*/
		else
			loadComponent({
				type: "js",																					/* On précise l'extension du fichier (pour le moment seul le  'js' fonctionne)*/
				module: module,																		/* On passe le module (qui est aussi le nom du fichier)*/
				action: action,																			/* On passe l'action (qui correspond a une fonction du module)*/
				path: window.config.path,														/* On passe le path qui donne le repertoire ou sont stock les js*/
				target: $(this),																			/* On passe l'élément qui a réagit à l' eventType*/
				callback: function(e){																/* Le dispatch sera appelé en callback si le chargement réussit */
					dispatch({module: module, action: action, target: e});
				}
			});
		
	});
});