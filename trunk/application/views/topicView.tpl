<table>
<?php foreach($posts as $value)
{
if (empty($value['id']))
continue;
?>
<td id="<?php echo $value['id'];?>"><?php echo $value['id'].' '.$value['auteur'];?></td>
<td class = "titlebox"><?php echo date("y/m/d", $value['date']);?><span style = "float : right;"><a href = "/forum/deletePost?id=<?php echo $value['id'];?>">supprimer le post</a></span></td>
</tr>
<tr>
<td class = "autorbox">jsuis pas un pd</td>
<td class = "messagebox"><?php echo nl2br($value['message']);?></td></tr>
<?php } ?>
</table>	
<div style="text-align:center;"><?php echo $next;?></div>