<table>
<tr>
<th class = "titre">Titre du topic</th>
<th class = "nombremessages">createur</th>
<th class = "nombremessages">nombre de reponses</th>
<th class = "nombremessages">nombre de vues</th>
<th class = "derniermessage">dernier message</th></tr>
<?php 
$i = 0;
foreach ($topics->rows as $value)
{
if (empty($value['id']))
continue;
if ($i % 2)
{

?>
<tr>
<?php if ($value['genre'] == "annonce"){ ?>
<td class = "annonce">Annonce : <a href="/forum/viewTopic?id=<?php echo $value['id'];?>"><strong><?php echo stripslashes($value['name']);?></a></strong></td>\
<td class = "nombremessagesAnnonce"><?php echo $value['creator'];?></td>
<td class = "nombremessagesAnnonce"><?php echo $value['reponses']; ?></td>
<td class = "nombremessagesAnnonce"><?php echo $value['views'];?></td>
<td class = "derniermessageAnnonce"><a href = "/forum/viewTopic?id=<?php echo $value['id'];?>&amp;post=<?php echo $value['id_last_post'];?>">last message</a><br />
at <?php echo date("Y/M/D", $value['date']);?></td>
<?php }else if ($value['genre'] == "admin"){ ?>
<td class = "Admin">Admin : <a href="/forum/viewTopic?id=<?php echo $value['id'];?>"><strong><?php echo stripslashes($value['name']);?></a></strong></td>\
<td class = "nombremessagesAdmin"><?php echo $value['creator'];?></td>
<td class = "nombremessagesAdmin"><?php echo $value['reponses']; ?></td>
<td class = "nombremessagesAdmin"><?php echo $value['views'];?></td>
<td class = "derniermessageAdmin"><a href = "/forum/viewTopic?id=<?php echo $value['id'];?>&amp;post=<?php echo $value['id_last_post'];?>">last message</a><br />
at <?php echo date("Y/M/D", $value['date']);?></td>
<?php }else{ ?>
<td class = "titre"><a href="/forum/viewTopic?id=<?php echo $value['id'];?>"><strong><?php echo stripslashes($value['name']);?></a></strong></td>

<td class = "nombremessages"><?php echo $value['creator'];?></td>
<td class = "nombremessages"><?php echo $value['reponses']; ?></td>
<td class = "nombremessages"><?php echo $value['views'];?></td>
<td class = "derniermessage"><a href = "/forum/viewTopic?id=<?php echo $value['id'];?>&amp;post=<?php echo $value['id_last_post'];?>">last message</a><br />
at <?php echo date("Y/M/D", $value['date']);?></td>
<?php }?>
</tr>
<?php 
}
else
{?>
<tr>
<?php if ($value['genre'] == "annonce"){ ?>
<td class = "Annonce">Annonce : <a href="/forum/viewTopic?id=<?php echo $value['id'];?>"><strong><?php echo stripslashes($value['name']);?></a></strong></td>\
<td class = "nombremessagesAnnonce"><?php echo $value['creator'];?></td>
<td class = "nombremessagesAnnonce"><?php echo $value['reponses']; ?></td>
<td class = "nombremessagesAnnonce"><?php echo $value['views'];?></td>
<td class = "derniermessageAnnonce"><a href = "/forum/viewTopic?id=<?php echo $value['id'];?>&amp;post=<?php echo $value['id_last_post'];?>">last message</a><br />
at <?php echo date("Y/M/D", $value['date']);?></td><?php }else if ($value['genre'] == "admin"){ ?>
<td class = "Admin">Admin : <a href="/forum/viewTopic?id=<?php echo $value['id'];?>"><strong><?php echo stripslashes($value['name']);?></a></strong></td>\
<td class = "nombremessagesAdmin"><?php echo $value['creator'];?></td>
<td class = "nombremessagesAdmin"><?php echo $value['reponses']; ?></td>
<td class = "nombremessagesAdmin"><?php echo $value['views'];?></td>
<td class = "derniermessageAdmin"><a href = "/forum/viewTopic?id=<?php echo $value['id'];?>&amp;post=<?php echo $value['id_last_post'];?>">last message</a><br />
at <?php echo date("Y/M/D", $value['date']);?></td>
<?php }else{ ?>
<td class = "titre2"><a href="/forum/viewTopic?id=<?php echo $value['id'];?>"><strong><?php echo stripslashes($value['name']);?></a></strong></td>
<td class = "nombremessages2"><?php echo $value['creator'];?></td>
<td class = "nombremessages2"><?php echo $value['reponses']; ?></td>
<td class = "nombremessages2"><?php echo $value['views'];?></td>
<td class = "derniermessage2"><a href = "/forum/viewTopic?id=<?php echo $value['id'];?>&amp;post=<?php echo $value['id_last_post'];?>">last message</a><br />
at <?php echo date("Y/M/D", $value['date']);?></td>
<?php }?>
</tr>
<?php }
$i++;
}
?>
</table
