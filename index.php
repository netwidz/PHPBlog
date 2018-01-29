<?php
if (isset($_GET['pageno'])) {
   $pageno = $_GET['pageno'];
} else {
   $pageno = 1;
}

require_once('DAO.php');
$DAO = new DAO();
$num_of_post = $DAO->num_Posts();
$rows_per_page = 5;
$lastPage = ceil($num_of_post/$rows_per_page);

$pageno=(int)$pageno;
if($pageno > $lastPage)
{
	$pageno = $lastPage;
	
	
}else if($pageno < 1){
	$pageno =1;
}

$limitPage = 'LIMIT '.($pageno - 1) * $rows_per_page .','.$rows_per_page;

$result = $DAO->num_post_limit($limitPage);


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<title>Blog::</title>
<link href="css/style.css" rel="stylesheet" type="text/css" />
</head>

<body>
<table width="100%" border="0" cellspacing="1">
  <tr>
    <td colspan="2" class="temptitle">MyBlog</td>
  </tr>
  <tr>
    <td width="74%" valign="top"><!-- InstanceBeginEditable name="EditRegion3" -->
      <table width="100%" border="0" cellspacing="1">
	  <tr>
          <td>&nbsp;</td>
        </tr>
	  <tr>
          <td>&nbsp;</td>
        </tr>
        <?php 
		
		
	//	require_once('DAO.php');
		//$postContent = new DAO();
	  //$result =	$postContent->retrivePost();
		if($DAO->num_Posts()>0){
		while($array = mysql_fetch_assoc($result)){
            ?>

           
		
		
		 <tr class="title">
		   <td><a href="more.php?postid=<?php  echo $array['post_id']?>"><?php echo $array['title']?></a> </td>
        </tr> 
        <tr>
          <td>&nbsp;</td>
        </tr>
        <tr class="tbody">
          <td><?php echo $array['short_description']?><br/><br /><a href="more.php?postid=<?php  echo $array['post_id']?>">more</a></td>
        </tr>
		
        <tr class="links">
        <td>Date posted : <?php echo $array['thedate']?> &nbsp; | &nbsp; Comments(<?php echo $DAO->count_comment($array['post_id'])?>)</td>
        </tr>
        <tr class="links">
          <td>&nbsp;</td>
        </tr>
        <tr class="links">
          <td>&nbsp;</td>
        </tr>
         <?php
        }
        ?>
        	<tr><td bgcolor="gray"><?php if ($pageno == 1) {
   					echo " FIRST PREV ";
				} else {
  					 echo " <a href='{$_SERVER['PHP_SELF']}?pageno=1'>FIRST</a> ";
   					$prevpage = $pageno-1;
   					echo " <a href='{$_SERVER['PHP_SELF']}?pageno=$prevpage'>PREV</a> ";
				}  
					echo " ( Page $pageno of $lastPage ) ";

				if ($pageno == $lastPage) {
  					 echo " NEXT LAST ";
				} else {
  					 $nextpage = $pageno+1;
   						echo " <a href='{$_SERVER['PHP_SELF']}?pageno=$nextpage'>NEXT</a> ";
   						echo " <a href='{$_SERVER['PHP_SELF']}?pageno=$lastPage'>LAST</a> ";
					} 
				}else{
				?>  <tr>
          				<td><td><p>There are no articles available at present</p></td></td>
        			</tr>
				<?php
			}	?>



</td>		</tr>
        	
        	
      </table>
        <td width="26%" valign="top"><!-- InstanceBeginEditable name="EditRegion4" -->
	<br />
      <table width="100%" border="0" cellspacing="1">
        <tr class="navbot">
          <td bgcolor="#CCCCFF" class="navbot">Recent Topics </td>
        </tr>
		<tr>
          <td>&nbsp;</td>
        </tr>
        <?php 
		
		
	
	  $resultRecent =	$DAO->recentTopic(5);
		
		if(mysql_num_rows($resultRecent)>0){
		while($arrayrecent = mysql_fetch_assoc($resultRecent)){
            ?>
        
         <tr>
          <td class="listtopics"><b><a href="more.php?postid=<?php echo $arrayrecent['post_id']; ?>"><?php echo $arrayrecent['title']; } ?></a></b>  </td>
        </tr>
        	<?php }else{ ?>
		<tr>
		<td><p>No topics to list</p></td>
		</tr>
	<?php } ?>
         </table>
         
         </body>
<!-- InstanceEnd --></html>
        