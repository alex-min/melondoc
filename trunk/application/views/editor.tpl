<form name="input" action="http://v2intra.local.epitech-nancy.fr/susie/index/unsubscribe?json" method="post">
Username: <input type="hidden" name="id" value="237" />
<input type="submit" value="Submit" />
</form> 

<div id="ed_menu">
        <img onclick="ed_createNewBlock('', undefined);" class="ed_menu_icon" alt="title" src="/public/images/ed_title.png" />
   	<img onclick="ed_createNewBlock('bullets', undefined);" class="ed_menu_icon" alt="title" src="/public/images/ed_bullets.png" />
   	<img onclick="ed_createNewBlock('paragraph', undefined);" class="ed_menu_icon" alt="paragraph" src="/public/images/ed_paragraph.png" />
   	<img onclick="ed_createNewBlock('upper', undefined);" class="ed_menu_icon" alt="paragraph" src="/public/images/ed_upper.png" />
</div>
<div id="ed_body">
</div>
<div id="ed_bottommenu">
        <img onclick="ed_createNewBlock('', this);" class="ed_menu_icon" alt="title" src="/public/images/ed_title.png" />
   	<img onclick="ed_createNewBlock('bullets', this);" class="ed_menu_icon" alt="title" src="/public/images/ed_bullets.png" />
   	<img onclick="ed_createNewBlock('paragraph', undefined);" class="ed_menu_icon" alt="paragraph" src="/public/images/ed_paragraph.png" />
   	<img onclick="ed_createNewBlock('upper', undefined);" class="ed_menu_icon" alt="paragraph" src="/public/images/ed_upper.png" />
</div>
<script>
document.onload = resizeAllTextArea();
</script>