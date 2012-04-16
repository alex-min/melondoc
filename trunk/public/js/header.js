 $(document).ready( function() {
    $('#tree2').fileTree({
	root: '',
	script: '/home/getList',
	folderEvent: 'click',
	expandSpeed: 0,
	collapseSpeed: 0,
	multiFolder: false
    }, function(file){});    
});

function		fill_search(str, id)
{
    var id = parseInt(id);
    $("#suggestions_user_"+id).hide();
    $("#autoSuggestionsList_user_"+id+" li").removeClass("hide");
    $("input[name=rights_user_"+id+"]").val("");
    if (str.length > 0)
	$.post("/home/addUserRights", {user_id: str, doc_id: id, right: $("select[name=rights_"+id+"]").find("option:selected").val()},
	       function(data){
		   addRightsUser(data, id);
		   return false;
	       }, "json");
    return false;
}

function		fill_search_group(str, id)
{
    var id = parseInt(id);
    $("#suggestions_group_"+id).hide();
    $("#autoSuggestionsList_group_"+id+" li").removeClass("hide");
    $("input[name=rights_group_"+id+"]").val("");
    if (str.length > 0)
	$.post("/home/addGroupRights", {group_id: str, doc_id: id, right: $("select[name=rights_"+id+"]").find("option:selected").val()},
	       function(data){
		   addRightsGroup(data, id);
		   return false;
	       }, "json");
    return false;
}

function	addRightsUser(data, id)
{
    $("#rights_"+id+" .modal-body #u_rights").after("<p><span class='help-inline'>"+data.login+"</span> <select name='"+data.user_id+"' doc_id='"+id+"' change='header:changeRights'><option value='read'>Lecture</option><option value='write'>Ecriture</option><option value='null'>Supprimer les droits</option></select></p>");
}

function	addRightsGroup(data, id)
{
    $("#rights_"+id+" .modal-body #g_rights").after("<p><span class='help-inline'>"+data.group_name+"</span> <select name='"+data.id_group+"' doc_id='"+id+"' change='header:changeRightsGroups'><option value='read'>Lecture</option><option value='write'>Ecriture</option><option value='null'>Supprimer les droits</option></select></p>");
}


$f.header = {
    completion_user:function(e){
	var name = e.val();
	var doc_id = e.attr("doc_id");
	if (name.length == 1)
	{
	    $.post("/home/getUsersCompletion", {id: doc_id, letter: name},
		   function(data){
		       $("#suggestions_user_"+doc_id).show();
		       $("#autoSuggestionsList_user_"+doc_id).html(data.html);
		   }, "json");
	}
	else if (name.length > 1)
	{
	    $("#autoSuggestionsList_user_"+doc_id+" li").removeClass("hide");
	    $("#autoSuggestionsList_user_"+doc_id+" li").find(".label:not(:contains("+name+"))").parent().addClass("hide");
	}
	else
	{
	    $("#suggestions_user_"+doc_id).hide();
	    $("#autoSuggestionsList_user_"+doc_id+" li").removeClass("hide");
	}
    },
    completion_group:function(e){
	var name = e.val();
	var doc_id = e.attr("doc_id");
	if (name.length == 1)
	{
	    $.post("/home/getGroupsCompletion", {id: doc_id, letter: name},
		   function(data){
		       $("#suggestions_group_"+doc_id).show();
		       $("#autoSuggestionsList_group_"+doc_id).html(data.html);
		   }, "json");
	}
	else if (name.length > 1)
	{
	    $("#autoSuggestionsList_group_"+doc_id+" li").removeClass("hide");
	    $("#autoSuggestionsList_group_"+doc_id+" li").find(".label:not(:contains("+name+"))").parent().addClass("hide");
	}
	else
	{
	    $("#suggestions_group_"+doc_id).hide();
	    $("#autoSuggestionsList_group_"+doc_id+" li").removeClass("hide");
	}
    },
    changeRights:function(e){
	var right = e.find("option:selected").val();
	var doc_id = e.attr("doc_id");
	var user_id = e.attr("name");

	$.post('/home/changeRightsUser', {doc_id: doc_id, user_id: user_id, right: right},
	       function(data){
		   if (data.error)
		       ;
		   if (data.success)
		       ;
		   if (data.success_del)
		   {
		       e.prev('span').remove();
		       e.remove();
		   }
		   //throw une erreure data.error ou data.success
	       }, "json");
    },
    changeRightsGroups:function(e){
	var right = e.find("option:selected").val();
	var doc_id = e.attr("doc_id");
	var user_id = e.attr("name");
	
	$.post('/home/changeRightsGroup', {doc_id: doc_id, group_id: user_id, right: right},
	       function(data){
		   if (data.error)
		       ;
		   if (data.success)
		       ;
		   if (data.success_del)
		   {
		       e.prev('span').remove();
		       e.remove();
		   }
		   //throw une erreure data.error ou data.success
	       }, "json");
    }
};


function addError(data)
{
    var html = "";
    if (data._error_ != undefined)
    {
	html += '<div class="alert alert-error">';
  	html += '<a class="close" data-dismiss="alert" href="#">x</a>';
	html += data._error_;
  	html += '</div>';
	$("#start_site").prepend(html);
    }
}

function addSuccess(data)
{
    var html = "";
    if (data._success_ != undefined)
    {
	html += '<div class="alert alert-success">';
  	html += '<a class="close" data-dismiss="alert" href="#">x</a>';
	html += data._success_;
  	html += '</div>';
	$("#start_site").prepend(html);
    }
}