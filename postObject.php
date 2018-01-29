<?php

   class post {
   	  private $postId;
      private $name;
      private $title;
      private $shortDescription;
      private $longDescription;
      private $datePosted;
      

		
		function __construct(){		


		}
		/*
	function __construct1( $title, $shortDescription,$longDescription) { 
        $this->title     = $title;
        $this->shortDescription = $shortDescription;
        $this->longDescription  = $longDescription;
        
    }
    
    function __construct2( $title, $shortDescription,$longDescription,$postId) {
    	$this->title     = $title;
        $this->shortDescription = $shortDescription;
        $this->longDescription  = $longDescription;
        $this->postId = $postId;
		
		}

*/
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
      public function getTitle() {
         return $this->title;
      }

      // Setter
      public function setTitle($title) {
         $this->title = $title;
      }
      
            // Getter
      public function getShortDescription() {
         return $this->shortDescription;
      }

      // Setter
      public function setShortDescription($shortDescription) {
         $this->shortDescription = $shortDescription;
      }
      
            // Getter
      public function getLongDescription() {
         return $this->longDescription;
      }

      // Setter
      public function setLongDescription($longDescription) {
         $this->longDescription = $longDescription;
      }
      
      
            // Getter
      public function getDatePosted() {
         return $this->datePosted;
      }

      // Setter
      public function setDatePosted($datePosted) {
         $this->datePosted = $datePosted;
      }
      
   }
?>