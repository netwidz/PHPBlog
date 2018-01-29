<?php
require_once ('../postObject.php');
require_once ('../DAO.php');
require_once ('../commentObject.php');
if(isset($_POST)){

      

    //add new item
    if(isset($_POST['_task']) && ($_POST['_task']=='add')){

		$title = addslashes(trim($_POST['title']));
		$shortDsc = addslashes(trim($_POST['short_description']));
		$longDsc = addslashes(trim($_POST['long_description']));
		
		
		
		$ObjPost = new post();
		$ObjPost->setTitle($title);
		$ObjPost->setShortDescription($shortDsc);
		$ObjPost->setLongDescription($longDsc);
		$dataAccess = new DAO();
        $result = $dataAccess->savePost($ObjPost);
      	if($result)
		   header("Location:./");
		        		
      		else echo 'failure';
      		
		  echo $dataAccess->num_Posts();
        
        

    }
    if(isset($_POST['_task']) && ($_POST['_task']=='commentSave')){

		$name = addslashes(trim($_POST['name']));
		$email = addslashes(trim($_POST['email']));
		$comment = addslashes(trim($_POST['comment']));
		$postId = $_POST['theID'];
		$ObjComment = new comment($name,$email,$comment,$postId);
		$dataAccess = new DAO();
        $dataAccess->saveComment($ObjComment);   
       ?>
       
       <li class="box"><br />
	   <img src="http://www.gravatar.com/avatar.php?gravatar_id=<?php echo $image; ?>"/>
	   <b><?php echo $name?>&nbsp;says :</b><?php echo $comment?></li>


<?php
	
       // header("Location: ../more.php?postid=$postId");
         //echo "<div class='success'>deleted successfully</div>";
      	//echo $dataAccess->num_Posts();
        
        

    }

    if(isset($_POST['_task']) && ($_POST['_task']=='edit')){
		echo 'edit';
        $title = addslashes(trim($_POST['title']));
        echo $title;
		$shortDsc = addslashes(trim($_POST['short_description']));
		$longDsc = addslashes(trim($_POST['long_description']));
		$postId = $_POST['postId'];
		
		$ObjPost = new post();
		$ObjPost->setTitle($title);
		$ObjPost->setShortDescription($shortDsc);
		$ObjPost->setLongDescription($longDsc);
		$ObjPost->setPostId($postId);
		
       	$dataAccess = new DAO();
        $dataAccess->updatePost($ObjPost);
         header("Location: ./index.php");
        
        
        
    }   
        
    if(isset($_POST['_task']) && ($_POST['_task']=='delete')){
      echo 'delete';
        $postId = $_POST['pid'];
        	$dataAccess = new DAO();
        	
    
        if($dataAccess->deletePost($postId)){
            echo "<div class='success'>deleted successfully</div>";
            header("Location: ../more.php?postid=$postId");
        }
        else echo "<div class='warning'>Unable to delete the user</div>";
        
    }
     if(isset($_POST['_task']) && ($_POST['_task']=='deleteComment')){
      echo 'delete';
        $commentId = $_POST['cid'];
        	$dataAccess = new DAO();
        	
    
        if($dataAccess->deleteComment($commentId)){
            echo "<div class='success'>deleted successfully</div>";
           // header("Location: ../more.php?postid=$commentId");
        }
        else echo "<div class='warning'>Unable to delete the user</div>";
        
    }
    
    
    
    
}
else{
	
 header("Location: www.google.com");
}
 
?>
