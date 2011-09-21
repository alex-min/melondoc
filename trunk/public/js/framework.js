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
			deb(obj);
		}
		else{
			$("body").children("input,textarea,select").each(function(index){
				var name = $(this).attr("name");
				var value = $(this).val();
				obj[name] = value;
			})
			deb(obj);
		}
	}
	window.fetchForm = fetchForm;

	function dispatch(options)	{
		try			{	functions[options.module][options.action](options.target);	}
		catch(e)	{	deb("Erreur survenue dans le dispatch:"+e);									}
	}
	
	/* Fonction de debug (affiche les infos dans la console)*/
	function deb(msg)	{
		console.log(msg);
	}
	window.deb = deb;
	
	/* Fonction d'erreur de loadComponent*/
	function loadComponentError(ajaxOptions, thrownError, url)	{
		deb("----------< loadComponent >----------")
		deb("Type: "+ajaxOptions);
		deb("Erreur: "+thrownError);
		deb("Une erreur est survenue, impossible d'atteindre le fichier a l'emplacement [" + url + "]");
		deb("-------------------------------------")
	}
	
	/* Fonction qui charge un fichier js*/
	function loadComponent(options){
	
		var url = options.path+"/"+options.module+"."+options.type;
		$.ajax({
			type: "GET",
			url: url,
			dataType: "script",
			success: function() {
				deb("Chargement de ["+url+"] termine.")
				if (!functions[options.module])
					deb("["+options.module+"] introuvable dans ["+url+"]");
				else if (!functions[options.module][options.action])
					deb("Le module ["+options.module+"] ne contient aucune définition de ["+options.action+"] dans ["+url+"]");
				else
					options.callback(options.target);
			},
			error: function(xhr, ajaxOptions, thrownError){
				loadComponentError(ajaxOptions, thrownError, url);
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