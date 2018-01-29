<?php
session_start();
	require_once('DAO.php');
//retrieve the main article 
if(isset($_GET['postid'])){
	$id = $_GET['postid'];
	
$_SESSION['postid']=$_GET['postid'];

$getMore = new DAO();
$result = $getMore->retriveMore($id);
	if($result->getTitle()==null){
			header('Location: index.php');
		}

}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/BlogTpl.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>MyBlog::<?php echo $result->getTitle()?></title>
<!-- InstanceEndEditable -->
<!-- InstanceBeginEditable name="head" -->
<style type="text/css">
<!--
li{display:none}
.style1 {color: #999999}
-->
</style>
<style type="text/css">
<!--
.style2 {color: #CCCCCC}
-->
</style>
<style type="text/css">
<!--
.style3 {color: #333333}
-->
</style>
<!-- InstanceEndEditable -->
<link href="css/style.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="css/validationEngine.jquery.css" type="text/css" media="screen" title="no title" charset="utf-8" />
        <script type="text/javascript" src="admin/js/jquery-1.3.2.js"></script>
        <script type="text/javascript" src="admin/js/jquery.validate.js"></script>
        <script type="text/javascript" src="admin/js/jquery.form.js"></script>
        <script type="text/javascript" src="admin/js/tinymce/jscripts/tiny_mce/jquery.tinymce.js"></script>
        <script type="text/javascript" src="admin/js/tinyrte.js"></script>
        
<script src="admin/js/validator/jquery.js" type="text/javascript"></script>

<script src="admin/js/validator/jquery.validationEngine-en.js" type="text/javascript"></script>

<script src="admin/js/validator/jquery.validationEngine.js" type="text/javascript"></script>
<script type="text/javascript">
   
      $(document).ready(function() {
   
       $("#postadd").validationEngine()
   
      })




</script>
<script type="text/javascript" >
$(function() {
$(".submit").click(function()
{
var name = $("#name").val();
var email = $("#email").val();
var comment = $("#comment").val();
var post_id = $("#theID").val();

var dataString = 'name='+ name + '&email=' + email + '&comment=' + comment+ '&theID=' + post_id+'&_task=commentSave';
alert(dataString);
//if(name=='' || email=='' || comment=='')
if( validationEngine({returnIsValid:false})))
{
alert('Please Give Valid Details');
}
else if(validationEngine({returnIsValid:true})))
{
$("#flash").show();
$("#flash").fadeIn(600).html('<img src="ajaxLoader.gif" />Loading Comment...');
$("#messageDisp").show();
$("#messageDisp").fadeIn(1200).html('Thank you for the comment!');
$.ajax({
type: "POST",
url: "admin/ajax.inc.php",
data: dataString,
cache: false,
success: function(html){
$("ol#update").append(html);
$("ol#update li:none").fadeIn("slow");
$("#flash").hide();
$("#messageDisp").fadeOut(500);
$("#noPost").remove();

}
});

}return false;
}); });
</script>



</head>

<body>
<table width="100%" border="0" cellspacing="1">
  <tr>
    <td colspan="2" class="temptitle">MyBlog</td>
  </tr>
  <tr>
    <td width="74%" valign="top"><!-- InstanceBeginEditable name="EditRegion3" --><table width="100%" border="0" cellspacing="1">
        <tr>
          <td>&nbsp;</td>
        </tr>
		<?php
		
	
		//while($array=mysql_fetch_assoc($result)){
		?>
        <tr>
          <td>&nbsp;</td>
        </tr>
        <tr class="title">
          <td><?php echo $result->getTitle()?></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
        <tr class="tbody">
          <td><?php echo $result->getLongDescription()?> </td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
        
        <?php
		//}
		
		?>
		</table>
	  <br />
	  <br />
	  
      <div class="commentsheader"><b>COMMENTS</b></div>
      <div style="width=100%">

	  
		  <?php 
		
		
		require_once('DAO.php');
		$comments = new DAO();
	  $resultComment =	$comments->retriveComment($id);
		if(mysql_num_rows($resultComment)>0){
		
            ?>	<li class="box">
	  <?php
        while($arrayComment = mysql_fetch_assoc($resultComment)){?>
        <img src="http://www.gravatar.com/avatar.php?gravatar_id=<?php echo $image; ?>"/>
		<b>
		<?php echo $arrayComment['name']?>&nbsp;says : 
      </b>
				
      
      <?php echo $arrayComment['comment']?><br /><br />
        </li><br /><br />      
        
        
        	<?php	}
				}else{
				?>  
			<div id="noPost">This article does not have any comments.</div>
				<?php
			}	?>
        
			<ol id="update" ></ol>
			
		<div id="flash"></div>
	  
	  
	  
	  
	  </div>
	  
	  <br />

	  <form action="#" method="post" name="postadd" id="postadd">
	  <table width="100%" border="0" cellspacing="1">
        <tr class="commentsheader">
          <td width="21%">Post a comment </td>
          <td width="79%">&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td><span class="style3">Name</span></td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td colspan="2"><input name="name" type="text" class="validate[required,custom[onlyLetter],length[0,100]]"  id="name" size="60" />
            <input type="hidden" name="theID" id="theID" value="<?php echo $_SESSION['postid']?>" />
		
          </tr>
           <tr>
          <td><span class="style3">E-Mail</span></td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td colspan="2"><input name="email" type="text" class="input" id="email" size="60" />
            
		
          </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td><span class="style1 style2 style3">Comment</span></td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td colspan="2"><textarea name="comment" cols="60" rows="9" class="input" id="comment"></textarea></td>
          </tr>
        <tr>
          <td colspan="2">&nbsp;</td>
        </tr>
        <tr>
          <td colspan="2">
		  <input name="_task" id="_task" type="hidden" value="commentSave" />
                            
		 <!-- <input name="submit" type="submit" class="input" id="theComment" value="Post Comment" /></td>-->
		 <input type="submit" class="submit input" value=" Submit Comment " /><div id="messageDisp"></div>
		  
        </tr>
        <tr><td></td></tr>
      </table>
	  
	  </form>
	  
	  <!-- InstanceEndEditable --></td>
    <td width="26%" valign="top"><!-- InstanceBeginEditable name="EditRegion4" --> <table width="100%" border="0" cellspacing="1">
        <tr class="navbot">
          <td bgcolor="#CCCCFF" class="navbot">Recent Topics </td>
        </tr>
		<tr>
          <td>&nbsp;</td>
        </tr>
	
        <?php 
		
		
	
	  $resultRecent =	$comments->recentTopic(3);
		
		if(mysql_num_rows($resultRecent)>0){
		while($arrayrecent = mysql_fetch_assoc($resultRecent)){
            ?>
        <tr>
          <td class="listtopics"><b><a href="more.php?postid=<?php echo $arrayrecent['post_id']; ?>"><?php echo $arrayrecent['title']; } ?></a></b> </td>
        </tr>
	<?php }else{ ?>
		<tr>
		<td><p>No topics to list</p></td>
		</tr>
	<?php } ?>
      </table><!-- InstanceEndEditable --></td>
  </tr>
  <tr>
    <td colspan="2" class="copyright">Copyright&copy;2010</td>
  </tr>
</table>
</body>
<!-- InstanceEnd --></html>
