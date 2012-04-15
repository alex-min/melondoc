window.$f  = {

	config:{
		separator			: 	':',
		split				: 	';',
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

function dispatcher(e){
	console.log($(this));
	var attr = $(this).attr(e.type);
	var stack = attr.split($f.config.split);
	$.each(stack , function(index, value) {
	    $f.exec(value, $(this))
	});
};

$("[click]").live("click", dispatcher);
$("[dbclick]").live("dbclick", dispatcher);
$("[mouseenter]").live("mouseenter", dispatcher);
$("[mouseleave]").live("mouseleave", dispatcher);
$("[focusin]").live("focusin", dispatcher);
$("[keyup]").live("keyup", dispatcher);
$("[focusout]").live("focusout", dispatcher);
$("[change]").live("change", dispatcher);
