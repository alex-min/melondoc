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