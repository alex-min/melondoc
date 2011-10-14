<div id="sidebar">
  <div class="content" style="display: none">
    <ul>
    <?php if ($isLogged == FALSE) :?>
      <li name="index" style="display: none;">
	<div class="bloc right" style="width: 49%; text-align: center;">
	  <div style="text-align: left; width: 250px; margin: 25px auto;">
	    <h3><?php echo $_lang['header_inscription'];?></h3>
	    <form method="POST" action="/login/inscription">
	      <label for="insc_log"><?php echo $_lang['header_login'];?> : </label><input id="insc_log" type="text" name="login"/><br/>
	      <label for="insc_ema"><?php echo $_lang['header_password'];?> : </label><input id="insc_ema" type="text" name="email" /><br/><br/>
	      <div style="display: block; height: 20px; width: 100%; text-align: center;">
		<a  style="margin-left: 50px;" class="button" href="/inscription"><?php echo $_lang['header_inscription']; ?></a>
	      </div>
	    </form>
	  </div>
	</div>
	<div class="bloc" style="width: 49%">
	  <div style="text-align: left;width: 250px; margin: 25px auto;">
	    <h3><?php echo $_lang['header_connexion'];?></h3>
	    <form method="POST" action="/login/index">
	      <label for="log_log"><?php echo $_lang['header_login'];?> :</label> <input id="log_log" type="text" name="login"/><br/>
	      <label for="log_pass"><?php echo $_lang['header_password'];?> :</label> <input id="log_pass" type="password" name="password"/><br/><br/>
	      <div style="display: block; height: 20px; width: 100%; text-align: center;">
		<a  style="margin-left: 50px;" class="button" href="/login/index"><?php echo $_lang['header_connexion'];?></a>
		</div>
	    </form>
	  </div>
	</div>
      </li>
      <?php endif;?>
      <li name="media" style="display: none;">CONTENT MEDIA</li>
      <li name="forum" style="display: none;">CONTENT FORUM</a></li>
</ul>
</div>
<div class="tab">
  <ul>
    <li>
      <a href="#" name="index" style="display: none;" class="open">Index</a>
      <a href="#" name="index" style="display: inline;" class="close">Index</a>
      </li>
    <li><span class="separator"></span></li>
    <li>
      <a href="#" name="media" style="display: inline;" class="close">Media</a>
      <a href="#" name="media" style="display: none;" class="open">Media</a>
      </li>
    <li><span class="separator"></span></li>
    <li>
      <a href="/forum" name="forum">Forum</a>
      </li>
    </ul>
  </div>
</div>
