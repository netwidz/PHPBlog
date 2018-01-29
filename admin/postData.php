


<table  width="100%" cellspacing="0" class="mytable" >
 <tr class="title" bgcolor="grey">
          <th width="30%" >Title</td>
          <th width="40%">Short Discription</td>
          <th width="10%">Comments</td>
          <th width="10%">Date</td>
        </tr>

<?php
require_once('../DAO.php');

$DAO = new DAO();
$page = $_REQUEST['page'];
$rows_per_page = 5;


$limitPage = 'LIMIT '.($page - 1) * $rows_per_page .','.$rows_per_page;
$result = $DAO->num_post_limit($limitPage);


if ($DAO->num_Posts() > 0) {
while ($array = mysql_fetch_assoc($result))
{?>



<tr class="del">
<td width="30%" class="spec"><b><?php echo
$array['title'] ?></b>
<br/><br />
		<div id="grey-button"><a href="edit.php?postid=<?php echo $array['post_id'] ?>" class="grey-button pcb"><span>EDIT</span></a>  <a href="javascript:void(0)" id="<?php echo $array['post_id'] ?>" class="delete grey-button pcb"><span>DELETE</span></a>
	</div>
		
		
		

</td>
<td width="40%"><?php echo $array['short_description'] ?></td>
<td width="10%">(<?php echo $DAO->count_comment($array['post_id']) ?>)</td>
<td width="20%"> <?php echo $array['thedate']?></td>
</tr>
<?php
}
?>


</table>
<?php


}else{
	
	echo 'There are no posts!';
	
}

?>
          


