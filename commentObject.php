<?php

   class comment {
   	  private $commentId;
      private $name;
      private $email;
      private $comment;
      private $postId;
      private $dateCommented;
      

	 function __construct($name,$email,$comment,$postId) { 
        $this->name     = $name;
        $this->email    = $email;
		$this->comment  = $comment;
        $this->postId   = $postId;
    }
    
    	// Getter
      public function getCommentId() {
         return $this->commentId;
      }

      // Setter
      public function setCommentId($commentId) {
         $this->commentId = $commentId;
      }

		// Getter
      public function getPostId() {
         return $this->postId;
      }

      // Setter
      public function setPostId($postId) {
         $this->postId = $postId;
      }

      // Getter
      public function getName() {
         return $this->name;
      }

      // Setter
      public function setName($name) {
         $this->name = $name;
      }
      
            // Getter
      public function getEmail() {
         return $this->email;
      }

      // Setter
      public function setEmail($email) {
         $this->email = $email;
      }
      
            // Getter
      public function getComment() {
         return $this->comment;
      }

      // Setter
      public function setComment($comment) {
         $this->comment = $comment;
      }
      
      
            // Getter
      public function getDateCommented() {
         return $this->dateCommented;
      }

      // Setter
      public function setDatePosted($dateCommented) {
         $this->datePosted = $dateCommented;
      }
      
   }
?>