
/*Copyright © <2011> <singler> <julien>

This program is free software; you can redistribute it and/or
modify it under the terms of the GNU Lesser General Public
License as published by the Free Software Foundation; either
version 2.1 of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
Lesser General Public License for more details.

You should have received a copy of the GNU Lesser General Public
License along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA 02110-1301 US
*/

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
  <p>Un problème lié à la BDD est survenue. S'il persiste veuillez contacter une administrateur. </p>
<?php if (DEBUG == 1)
  echo '<p class="help">'.$err.'</p>'
?>
  <h2><a href="/index/index">Retour à l'accueil</a></h2>
</div>
</body>
</html>

