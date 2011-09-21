<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr">
<head>
<title>DBLINK - Erreur SQL</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" media="screen" type="text/css" title="Design" href="/public/css/error.css" />
<link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />
</head>
<body>
<div id="block_erreur">
  <h1>Erreur SQL</h1>
  <p>Un probl�me li� � la BDD est survenue. S'il persiste veuillez contacter une administrateur. </p>
<?php if (DEBUG == 1)
  echo '<p class="help">'.$err.'</p>'
?>
  <h2><a href="/index/index">Retour � l'accueil</a></h2>
</div>
</body>
</html>

