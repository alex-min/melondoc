function openFile(file) {
    alert(file);
}
 
$(document).ready( function() {
    $('#tree').fileTree({
	root: '',
	script: '/home/getList',
	folderEvent: 'click',
	expandSpeed: 750,
	collapseSpeed: 750,
	multiFolder: false
    }, function(file) {
        openFile(file);
    });
});