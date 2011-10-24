<table>
<?php
   $cat = 0;
   $mess = 0;
   foreach ($ret->rows as $data)
{
if (empty($data['name_forum']))
continue;
if ($cat != $data['id_categorie'])
{
$cat = $data['id_categorie'];?>
<tr>
  <th class="titre"><strong><?php echo stripslashes(htmlspecialchars($data['name_cat']));?>
  </strong></th>             
  <th class="nombremessages"><strong>Sujets</strong></th>       
  <th class="nombresujets"><strong>Messages</strong></th>       
  <th class="derniermessage"><strong>Dernier message</strong></th>   
</tr><br>
<?php
   }
   $mess += $data['nb_reponses'] + $data['nb_topics'];
   $modo = unserialize($data['moderators']);
   $mod ="";
   ?>
<tr>
  <td class="titre"><strong>
      <a href="/forum/voirForum?id=<?php echo $data['id_forum'];?>">
	<?php echo stripslashes(htmlspecialchars($data['name_forum']));?></a></strong>
    <br /><?php echo nl2br(stripslashes(htmlspecialchars($data['desc']))); ?><?php if (!empty($modo)) { ?><br />moderateurs :<?php  
	$mod = implode(", ", $modo);
	echo $mod;
	} ?></td>
  <td class="nombresujets"><?php echo $data['nb_topics'];?></td>
  <td class="nombremessages"><?php echo $data['nb_reponses']; ?></td>
  <td class="derniermessage"><a href="/forum/viewTopic?id=<?php echo $data['id_topic'];?>&amp;post=<?php echo $data['last_post'];?>">last message</a></td>
  </tr><?php
     }
     ?>
</table>
