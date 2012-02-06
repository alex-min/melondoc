$(document).ready(function(){
    $('#checkAll').click(function() { // clic sur la case cocher/decocher  
	var cases = $("#table_doc").find(':checkbox');
        if (this.checked)
            cases.attr('checked', true);
        else
            cases.attr('checked', false);
    });
    
});

function home_checkDeleteDocs(e)
{
    var value_box = $("#delete_doc input[type=checkbox]:checked").not("#checkAll");
    var checked_box = value_box.parent().parent();
    var res = "id=";

    checked_box.fadeOut('slow', function(){
	value_box.each(function(i, e) {
	    res += e.attr("name");
	    res += "/"
	});
	checked_box.remove();
	$("#checkAll").removeAttr("checked");
    });
    // ici la requete ajax vers homeController -> 
}

$f.addmodule({
    _name_:"home",
    checkDeleteDocs:function(e){
	home_checkDeleteDocs(e);
    }
});