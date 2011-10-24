<div id="sidebar" class="topbar">
  <div class="content" style="display: none">
    <ul>
      <li name="index" style="display: none;">
	<div class="bloc" style="width: 49%">
	  <div style="text-align: left;width: 250px; margin: 25px auto;">
	    <h3><?php echo $_lang['header_connexion'];?></h3>
	    <form method="POST" action="/login/index">
	      <label for="log_log"><?php echo $_lang['header_login'];?> :</label> <input id="log_log" type="text" name="login" /><br/>
	      <label for="log_pass"><?php echo $_lang['header_password'];?> :</label> <input id="log_pass" type="password" name="password"/><br/><br/>
	      <div style="display: block; height: 20px; width: 100%; text-align: center;">
		<input type="submit" class="button" value="<?php echo $_lang['header_connexion'];?>" />
		</div>
	    </form>
	  </div>
	</div>
      </li>
    <!--<li name="forum" style="display: none;">CONTENT FORUM</a></li>-->
</ul>
</div>
<div class="tab">
  <ul>
    <?php if ($isLogged == FALSE) :?>
    <li>
      <a href="#" name="index" style="display: none;" class="open"><?php echo $_lang['header_connexion'];?></a>
      <a href="#" name="index" style="display: inline;" class="close"><?php echo $_lang['header_connexion'];?></a>
      </li>
    <li><span class="separator"></span></li>
    <li>
      <a href="/login/inscription"><?php echo $_lang['header_inscription'];?></a>
      </li>
    <li><span class="separator"></span></li>
    <?php endif;?>
    <li>
      <a href="/forum/index"><?php echo $_lang['header_forum'];?></a>
    </li>
    <?php if ($isLogged == TRUE) :?>
    <li><span class="separator"></span></li>
    <li>
      <a href="#" name="files" style="display: none;" class="open"><?php echo $_lang['header_files'];?></a>
      <a href="#" name="files" style="display: inline;" class="close"><?php echo $_lang['header_files'];?></a>
      </li>
    <li><span class="separator"></span></li>
    <li>
      <a href="/login/deconnexion"><?php echo $_lang['header_deconnexion'];?></a>
      </li>
    <?php endif;?>
    </ul>
  </div>
</div>
