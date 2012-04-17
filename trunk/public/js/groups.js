$f.groups = {
    delGroups:function(e)
    {
	$.post("/home/delGroups", {id: e.attr("id_group")},
	       function(data)
	       {
		   addError(data);
		   addSuccess(data);
		   $(e).parent().parent().remove();
	       }, "json");
    },
    createGroup:function(e)
    {
	$.post("/home/createGroup", {name: $("#group_create_button").val()},
	       function(data)
	       {
		   $("#groups_array").prepend(data.html);
	       },"json");
    },
    showSearch:function(e)
    {
	$(".input_search_group").hide();
	$(".btn_search_group").hide();
	var i = e.attr("search_id");
	$("#searchB_"+i).show();
	$("#searchG_"+i).show();
    },
    searchUser:function(e)
    {
	var i = e.attr("search_id");
	$.post("/home/getUsersGroupsCompletion", {letter: $("#searchG_"+i).val(), group_id: $("#searchG_"+i).attr("group_id")}, function(data){
	    $("#search_result_"+i).html(data.html);
	}, "json");
    },
    addUserGroup:function(e)
    {
	var user_id = e.attr("user_id");
	var group_id = e.attr("group_id");
	$.post("/home/addUserToGroup", {user_id: user_id, group_id: group_id}, function(data)
	       {
		   $(".search_result_group").html("");
		   $(".input_search_group").hide();
		   $(".btn_search_group").hide();
		   addError(data);
		   addSuccess(data);
	       }, "json");
    }
};