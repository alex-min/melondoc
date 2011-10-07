<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr">
<head>
   <title><?php echo $title;?></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" media="screen" type="text/css" title="Design" href="<?php echo $link_css;?>" />
<link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />
</head>
<body>
	<div id="error_block">
		<h1><?php echo utf8_decode("Erreur 404: Page Introuvable.") ?></h1>
		<p><?php echo utf8_decode("Désolé cette page semble ne pas exister."); ?></p>
		<div style="text-align: center; padding: 10px;">
			<a  class="button" href="/">Retourner a l'acceuil</a>
		</div>
	</div>
</body>
</html>
