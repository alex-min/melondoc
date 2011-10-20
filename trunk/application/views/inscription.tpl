<form method="POST" action="/login/inscription">
<table>
<tr><td><label for="form_login"><?php echo $_lang['login_login'];?></label></td><td><input type="text" name="form_login" /></td></tr>
<tr><td><label for="form_first_name"><?php echo $_lang['login_first_name'];?></label></td><td><input type="text" name="form_first_name" /></td></tr>
<tr><td><label for="form_last_name"><?php echo $_lang['login_last_name'];?></label></td><td><input type="text" name="form_last_name" /></td></tr>
<tr><td><label for="form_email"><?php echo $_lang['login_email'];?></label></td><td><input type="text" name="form_email" /></td></tr>
<tr><td><label for="form_mdp"><?php echo $_lang['login_mdp'];?></label></td><td><input type="password" name="form_mdp" /></td></tr>
<tr><td><label for="form_mdp2"><?php echo $_lang['login_mdp2'];?></label></td><td><input type="password" name="form_mdp2" /></td></tr>
<tr><td colspan="2"><input type="submit" value="OK" /></td></tr>
</table>
</form>
