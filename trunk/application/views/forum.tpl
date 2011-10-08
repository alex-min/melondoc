	<?php
	$cat = 0;
	foreach ($ret->rows as $data)
	{
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
		?>
		<tr><td>[]</td>
    <td class="titre"><strong>
    <a href="./voirforum.php?f='<?php echo $data['id_forum'];?>'">
    <?php echo stripslashes(htmlspecialchars($data['name_forum']));?></a></strong>
    <br /><?php echo nl2br(stripslashes(htmlspecialchars($data['desc'])));?></td>
    <td class="nombresujets"><?php echo $data['nb_topics'];?></td>
    <td class="nombremessages"><?php echo $data['nb_reponses']; ?></td>
	    <?php
	}
	?>