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
	// ici la requete ajax vers homeController -> 
	$("#delete_doc input[type=checkbox]:checked").parent().parent().remove();	
}

$f.addmodule({
	
	_name_:"home",
	
	checkDeleteDocs:function(e){
		home_checkDeleteDocs(e);
	}

});