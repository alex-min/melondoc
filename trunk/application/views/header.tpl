<div id="sidebar">
     	<div class="content" style="display: none">
	     <?php if ($isLogged == FALSE) :?>
		<ul>
			<li name="index" style="display: none;">
				<div class="bloc left" style="width: 49%; text-align: center;">
					<div style="text-align: left; width: 250px; margin: 25px auto;">
						<h3>Inscription</h3>
						<form method="POST" action="/login/inscription">
							<label for="insc_log"><?php echo $_lang['header_login'];?> : </label><input id="insc_log" type="text" name="login"/><br/>
							<label for="insc_ema"><?php echo $_lang['header_password'];?> : </label><input id="insc_ema" type="text" name="email" /><br/><br/>
							<a  style="margin-left: 50px;" class="button" href="/inscription"><?php echo $_lang['header_inscription']; ?></a>
						</form>
					</div>
				</div>
				<div class="bloc left right" style="width: 49%">
					<div style="text-align: left;width: 250px; margin: 25px auto;">
						<h3>Login</h3>
						<form method="POST" action="/login/index">
						<label for="log_log"><?php echo $_lang['header_login'];?> :</label> <input id="log_log" type="text" name="login"/><br/>
						<label for="log_pass"><?php echo $_lang['header_password'];?> :</label> <input id="log_pass" type="password" name="password"/><br/><br/>
						<a  style="margin-left: 50px;" class="button" href="/login/index"><?php echo $_lang['header_connexion'];?></a>
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
				<a class="open" style="display: none;" name="index" href="#">Index</a>
				<a class="close" style="display: inline;" name="index" href="#">Index</a>
			</li>
			<li><span class="separator"></span></li>
			<li>
				<a class="close" style="display: inline;" name="media" href="#">Media</a>
				<a class="open" style="display: none;" name="media" href="#">Media</a>
			</li>
			<li><span class="separator"></span></li>
			<li>
				<a name="forum" href="/forum">Forum</a>
			</li>
		</ul>
	</div>
</div>