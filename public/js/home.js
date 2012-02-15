$(document).ready(function(){
    $('#checkAll').click(function() { // clic sur la case cocher/decocher  
	var cases = $("#table_doc").find(':checkbox');
        if (this.checked)
            cases.attr('checked', true);
        else
            cases.attr('checked', false);
    });
    
});
