window.$f  = {

	config:{
		separator			: 	':',
		path				: 	"/public/js",
		debug				: 	true
	},

	alert		: 	$f_alert,
	exec		: 	$f_exec,
	getform		: 	$f_getform,
	sendform	: 	$f_sendform,

	// Fonctions de logs
	log			: 	$f_log, 
	info		: 	$f_info, 
	warn		: 	$f_warn, 
	error		: 	$f_error, 
}

/*
** <div click="module:action"></div>
** <div mouseenter="module:action"></div>
** <div mouseleave="module:action"></div>
** <div focusin="module:action"></div>
** <div focusout="module:action"></div>
*/

function dispatcher(e){$f.exec($(this).attr(e.type), $(this))};
	
	$("[click]").live("click", dispatcher);
	$("[mouseenter]").live("mouseenter", dispatcher);
	$("[mouseleave]").live("mouseleave", dispatcher);
	$("[focusin]").live("focusin", dispatcher);
	$("[focusout]").live("focusout", dispatcher);