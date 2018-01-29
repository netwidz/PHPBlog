


<table  width="100%" cellspacing="0" class="mytable" >
 <tr class="title" bgcolor="grey">
          <th width="20%" >Author</td>
          <th width="60%">Comment</td>
          <th width="20%">In Response To</td>
          
        </tr>

<?php
require_once('../DAO.php');

$DAO = new DAO();
$page = $_REQUEST['page'];
$rows_per_page = 5;


$limitPage = 'LIMIT '.($page - 1) * $rows_per_page .','.$rows_per_page;
$result = $DAO->retriveComments($limitPage);



while ($array = mysql_fetch_assoc($result))
{?>



<tr class="del">
<td width="20%" class="spec"><b>Name</b><br/><?php echo $array['cname']?><br />
<b>E-mail</b><br/><?php echo $array['email']?></td>
<td width="60%"><font style="font-size:0.80em;"> <?php echo $array['thedate']?></font><br /><br /><?php echo $array['comment']?><br /><br />	<div id="grey-button"><a href="javascript:void(0)" id="<?php echo $array['comment_id']?>" class="delete grey-button pcb"><span>DELETE</span></a></div> </td>
<td width="20%"><a href="../more.php?postid=<?php echo $array['post_id']; ?>" target="_blank"><?php echo $array['title']?></a></td>

</tr>
<?php
}?>
          
</table>

