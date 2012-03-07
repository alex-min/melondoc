function openFile(file) {
    
}
 
$(document).ready( function() {
    $('#tree').fileTree({
	root: '',
	script: '/home/getList',
	folderEvent: 'click',
	expandSpeed: 0,
	collapseSpeed: 0,
	multiFolder: false
    }, function(file){});
});

$f.header = {
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