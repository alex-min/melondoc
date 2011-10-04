<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr">
	<head>
   <title><?php echo $_lang['title']; ?></title>
   <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
   <?php echo $cssArray;?>
   <?php echo $jsArray;?>
   <link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />
   </head>
<body>
<div id="wrapper">
<div class="error">
  <?php
if (isset($__error))
echo $__error;
?>
</div>
<div class="success">
  <?php
if (isset($__success))
echo $__success;
?>
</div>