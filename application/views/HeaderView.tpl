<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr">
	<head>
   <title><?php if (isset($_lang['title']))
   echo $_lang['title']; 
else
   echo "MelonDoc"; ?></title>
   <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
   <?php echo $cssArray;?>
   <?php echo $jsArray;?>
   <link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />
   </head>
<body>
<div id="wrapper">
  <?php if (isset($__error)) :?>
  <div class="error">
    <?php echo $__error;?>
  </div>
  <?php endif;?>
  <?php if (isset($__success)) : ?>
  <div class="success">
    <?php echo $__success; ?>
  </div>
<?php endif;?>
