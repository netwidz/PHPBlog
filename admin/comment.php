<?php
session_start();
	require_once('../DAO.php');
//retrieve the main article 
if (isset($_GET['pageno'])) {
   $pageno = $_GET['pageno'];
} else {
   $pageno = 1;
}


$DAO = new DAO();
//$result = $DAO->retriveAllComment();
$num_of_comments = $DAO->retrive_num_Comment();
$rows_per_page = 5;
$lastPage = ceil($num_of_comments/$rows_per_page);

$pageno=(int)$pageno;
if($pageno > $lastPage)
{
	$pageno = $lastPage;
	
	
}else if($pageno < 1){
	$pageno =1;
}

$limitPage = 'LIMIT '.($pageno - 1) * $rows_per_page .','.$rows_per_page;

$result = $DAO->retriveComments($limitPage);






?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/BlogTpl.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>MyBlog::</title>
<!-- InstanceEndEditable -->
<!-- InstanceBeginEditable name="head" -->
<style type="text/css">
a {
	color: #c75f3e;
}

#mytable {
	width: 700px;
	padding: 0;
	margin: 0;
}

caption {
	padding: 0 0 5px 0;
	width: 700px;	 
	font: italic 11px "Trebuchet MS", Verdana, Arial, Helvetica, sans-serif;
	text-align: right;
}

th {
	font: bold 11px "Trebuchet MS", Verdana, Arial, Helvetica, sans-serif;
	color: #4f6b72;
	border-right: 1px solid #C1DAD7;
	border-bottom: 1px solid #C1DAD7;
	border-top: 1px solid #C1DAD7;
	letter-spacing: 2px;
	text-transform: uppercase;
	text-align: left;
	padding: 6px 6px 6px 12px;
	background: #CAE8EA url(images/bg_header.jpg) no-repeat;
}

th.nobg {
	border-top: 0;
	border-left: 0;
	border-right: 1px solid #C1DAD7;
	background: none;
}

td {
	border-right: 1px solid #C1DAD7;
	border-bottom: 1px solid #C1DAD7;
	background: #fff;
	padding: 6px 6px 6px 12px;
	color: #4f6b72;
}


td.alt {
	background: #F5FAFA;
	color: #797268;
}

th.spec {
	border-left: 1px solid #C1DAD7;
	border-top: 0;
	background: #fff url(images/bullet1.gif) no-repeat;
	font: bold 10px "Trebuchet MS", Verdana, Arial, Helvetica, sans-serif;
}

th.specalt {
	border-left: 1px solid #C1DAD7;
	border-top: 0;
	background: #f5fafa url(images/bullet2.gif) no-repeat;
	font: bold 10px "Trebuchet MS", Verdana, Arial, Helvetica, sans-serif;
	color: #797268;
}





<!--
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
<link href="../css/style.css" rel="stylesheet" type="text/css" />
<link href="../css/buttons.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="admin/js/jquery-1.3.2.js"></script>
        <script type="text/javascript" src="admin/js/jquery.validate.js"></script>
        <script type="text/javascript" src="admin/js/jquery.form.js"></script>
        <script type="text/javascript" src="admin/js/tinymce/jscripts/tiny_mce/jquery.tinymce.js"></script>
        <script type="text/javascript" src="admin/js/tinyrte.js"></script>
        <script types="text/javascript" src="js/jquery-1.3.2.js"></script>
        <script types="text/javascript" src="js/jquery.validate.js"></script>
        <script types="text/javascript" src="js/jquery.form.js"></script>
        <script types="text/javascript" src="js/jquery.livequery.js"></script>
        <script type="text/javascript" src="js/comment.js"></script>
        
<script src="js/jquery.ui.draggable.js" type="text/javascript"></script>
<!-- Core files -->
<script src="js/jquery.alerts.js" type="text/javascript"></script>
<link href="js/jquery.alerts.css" rel="stylesheet" type="text/css" media="screen" />

<script type="text/javascript">




</script>


          
        



</head>

<body>
<div align="center">
	<h1>COMMENTS</h1>
	<div id="container">
	
		<div class="search-background">
			<label><img src="loader.gif" alt="" /></label>
		</div>
	
		<div id="content"></div>
		<div id="removed">
		</div>
	</div>
	<div id="paging_button">
		<ul>
		<?php
		//Show page links
		for($i=1; $i<=$lastPage; $i++)
		{
			echo '<li id="'.$i.'">'.$i.'</li>';
		}?>
		</ul>
	</div>
</div>


</div>





</body></html>