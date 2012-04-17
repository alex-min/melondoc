$f.editor22 = {
    changeName:function(e)
    {
	$.post("/editor2/changeName",
	       {name: $("#doc_name_change").val(), doc_id: e.attr("doc_id")}
	       , function(e){
		   addError(e);
		   addSuccess(e);
	       }, "json");
    }
};