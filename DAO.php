<?php

	require_once('postObject.php');
	require_once('commentObject.php');

   class DAO {
   	public $host = 'localhost';
   	public $username = 'root';
   	public $password = '';
   	public $database = 'blog';
   	
   		public function dB_Connect(){
   			
   			$connect =	mysql_connect($this->host,$this->username,$this->password) or die(mysql_error());
   			 mysql_select_db($this->database, $connect) or die(mysql_error());
   			
   			
   		}
   		
   		function num_Posts(){
   				
				$this->dB_Connect();
   				$query = "SELECT * From post";
   				$postAll = mysql_query($query);
   				$num = mysql_num_rows($postAll);
   				return $num;
   			
   			
   		}
   		
   		function num_post_limit($limit){
   			$this->dB_Connect();
   				$query = "SELECT * ,DATE_FORMAT(date_posted,'%W,%d %b %Y') as thedate From post WHERE DATE_SUB(CURDATE(),INTERVAL 30 DAY)ORDER BY date_posted DESC, post_id DESC ".$limit;
   				
   				$postAll = mysql_query($query);
   			
   				return $postAll;
   			
   		}
   		
   			function num_post_limitV2($rows_per_page,$pageno){
   			$this->dB_Connect();
   			$num_of_post = $this->num_Posts();
   			$lastPage = ceil($num_of_post/$rows_per_page);
   			$limitPage = 'LIMIT '.($pageno - 1) * $rows_per_page .','.$rows_per_page;
   				$query = "SELECT * ,DATE_FORMAT(date_posted,'%W,%d %b %Y') as thedate From post WHERE DATE_SUB(CURDATE(),INTERVAL 30 DAY)ORDER BY date_posted DESC, post_id DESC ".$limitPage;
   				
   				$postAll = mysql_query($query);
   			
   				return $postAll;
   			
   		}
   		
   		function savePost(&$objPost){
   			
   		 	
   		 		
			$title =	$objPost->getTitle();
   			$shortDsc = $objPost->getShortDescription();
		    $longDsc = $objPost->getLongDescription();	
		 	$query = "INSERT INTO post SET name='admin',title='".$title."',short_description='".$shortDsc."',";
			$query .="date_posted=NOW(),long_description='".$longDsc."'";
	
			$this->dB_Connect();
			
			$result =  mysql_query($query);
			if($result==1)
				return true;
			else
				return false;
   			
   			
   		}
   		
   		function retrivePost(){
   			
   		//$post = new post();
   			
			$this->dB_Connect();
   			$query = "Select *,DATE_FORMAT(date_posted,'%W,%d %b %Y') as thedate FROM post WHERE DATE_SUB(CURDATE(),INTERVAL 30 DAY)ORDER BY date_posted DESC, post_id DESC" ;
   			$result = mysql_query($query);
   			
   		//	$postArray = new ArrayObject();
   			
   			return $result;
   			
   			
   			
   			
   			
   		
   			
   		}
   		
   		function retriveMore($id){
   			
   			$this->dB_Connect();
   			$query = "Select *,DATE_FORMAT(date_posted,'%W,%d %b %Y') as thedate FROM post WHERE post_id='".$id."'" ;
   			$postData = new post();
   			$result = mysql_query($query);
   			while($array=mysql_fetch_assoc($result)){
   				$postData->setDatePosted($array['date_posted']);
   				$postData->setPostId($array['post_id']);
   				$postData->setShortDescription($array['short_description']);
				 $postData->setTitle($array['title']);
				 $postData->setLongDescription($array['long_description']);  
				   }
   			
   			return $postData;	
   			
   		}
   		
   		function updatePost(&$objPost){
   			
   			$postId = $objPost->getPostId();
   		//	echo $postId;
   			$title = $objPost->getTitle();
   			$shortDsc =$objPost->getShortDescription();
   			$longDsc = $objPost->getLongDescription();
   			$query = "UPDATE post SET title='".$title."', short_description='".$shortDsc."', long_description='".$longDsc."' WHERE post_id=".$postId;
   			echo $query;
   			$this->dB_Connect();
   				mysql_query($query);
   			
   		}
   		
   		
   		function saveComment(&$objComment){
   			
   			$name = $objComment->getName();
   			$email = $objComment->getEmail();
   			$comment = $objComment->getComment();
   			$postId = $objComment->getPostId();
   			
   			
   			$query = "INSERT INTO comment SET name='".$name."',email='".$email."',comment='".$comment."',";
			$query .="date_commented=NOW(),post_id='".$postId."'";
			$this->dB_Connect();
			mysql_query($query);
   			
   			
   			
   		}
   		
   		function retriveComment($idComment){
   			$this->dB_Connect();
   			$query = "Select *,DATE_FORMAT(date_commented,'%W,%d %b %Y') as thedate FROM comment WHERE post_id='".$idComment."' ORDER BY date_commented ASC, comment_id ASC" ;
   		
   			return mysql_query($query);	
   			
   			
   		}
   		function retrive_num_Comment(){
   			$this->dB_Connect();
   			$query = "Select *,DATE_FORMAT(date_commented,'%W,%d %b %Y') as thedate FROM comment ORDER BY date_commented DESC, comment_id ASC" ;
   		
   			return mysql_num_rows(mysql_query($query));	
   			
   			
   		}
   		
   		function retriveComments($limit){
   			$this->dB_Connect();
   				$query = "SELECT * ,DATE_FORMAT(date_posted,'%W,%d %b %Y') as thedate, comment.name as cname From comment INNER JOIN post ON post.post_id=comment.post_id   WHERE DATE_SUB(CURDATE(),INTERVAL 30 DAY)ORDER BY date_commented DESC, comment_id ASC ".$limit;
   				
   				$result = mysql_query($query);
   			
   				return $result;
   		}
   		
   		
   		
   		
   		function recentTopic($limit){
   			$this->dB_Connect();
   				$query = "Select *,DATE_FORMAT(date_posted,'%W,%d %b %Y') as thedate FROM post ORDER BY date_posted DESC, post_id DESC  LIMIT ".$limit."" ;
   			
   		
   			return mysql_query($query);	
   		}
   		
   		function count_comment($postId){
   				$this->dB_Connect();
   				$query = "Select * FROM comment WHERE post_id='".$postId."'" ;
   				$result = mysql_query($query);
   				return mysql_num_rows($result);	
   			
   		}
   		
   		function deletePost($postId)
   		{
   			$this->dB_Connect();
   			
   			$query1 = "DELETE FROM post WHERE post_id='".$postId."'";
   			//$query2 = "DELETE FROM comment WHERE post_id=".$postId;
   			$result1 = mysql_query($query1);
   		//	$result2 = mysql_query($query2);
   			if($result1 == 1 ){
   				return true;
   				
   			}else{
   				return false;
   			}
   			
   			
   			
   		}
   			function deleteComment($commentId)
   		{
   			$this->dB_Connect();
   			
   			$query1 = "DELETE FROM comment WHERE comment_id='".$commentId."'";
   			//$query2 = "DELETE FROM comment WHERE post_id=".$postId;
   			$result1 = mysql_query($query1);
   		//	$result2 = mysql_query($query2);
   			if($result1 == 1 ){
   				return true;
   				
   			}else{
   				return false;
   			}
   			
   			
   			
   		}
   		
   		
   		
   		
   		
   		
   		
   		
   	
   	
   	
   	
   }
   
   ?>