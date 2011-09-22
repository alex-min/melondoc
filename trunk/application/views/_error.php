<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr">
<head>
   <title><?php echo $title;?></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" media="screen" type="text/css" title="Design" href="<?php echo $link_css;?>" />
<link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />
</head>
<body>
<div id="block_erreur">
   <h1><?php echo $title_h1;?></h1>
   <p><?php echo $text_erreur; ?></p>
   <h2><a href="/index/index"><?php echo $text_ret;?></a></h2>
   <?php if (DEBUG) :?>
   <?php echo $query;?>
   <?php endif; ?>
</div>
</body>
</html>
