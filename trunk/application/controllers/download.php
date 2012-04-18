<?php
class			downloadController extends controller
{
	function curPageURL() {
 $pageURL = 'http';
 if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
 $pageURL .= "://";
 if ($_SERVER["SERVER_PORT"] != "80") {
  $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
 } else {
  $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
 }
 return $pageURL;
}
		function indexAction() { return false;}
		function __get($name) {
			//var_dump($_SERVER['REDIRECT_URL']);
			$file = str_replace('.', '', $_GET['file']);
			header('Content-type: application/pdf');
			echo file_get_contents('/tmp/' . $file . '.dvi');
			die();
		}
}
?>