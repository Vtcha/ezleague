<?php session_start();
include('../class-db.php');
include('../class-ezadmin.php');
include('../objects/class-news.php');
$ez 	   = new ezAdmin();
$ez_news   = new ezAdmin_News();
    
    if(isset($_POST['form'])) {
    	$form = strip_tags($_POST['form']);
    	 switch($form) {
    	 	case 'add-news':
    	 		$title 		  = $_POST['title'];
    	 		$body	 	  = $_POST['body'];
    	 		$author		  = $_POST['author'];
    	 		$game		  = $_POST['game'];
    	 		$categories	  = $_POST['categories'];
    	 		$media		  = $_POST['media'];
    	 		 $ez_news->add_news( $title, $body, $author, $categories, $game, $media );
    	 	 	break;
    	 	 	
    	 	case 'save-draft':
    	 		$title 		  = $_POST['title'];
    	 		$body	 	  = $_POST['body'];
    	 		$author		  = $_POST['author'];
    	 		$game		  = $_POST['game'];
    	 		$categories	  = $_POST['categories'];
    	 		$media		  = $_POST['media'];
    	 		 $ez_news->save_draft( $title, $body, $author, $categories, $game, $media );
    	 		break;
    	 		
    	 	case 'update-draft':
    	 		$post_id	  = $_POST['post_id'];
    	 		$title 		  = $_POST['title'];
    	 		$body	 	  = $_POST['body'];
    	 		$author		  = $_POST['author'];
    	 		$game		  = $_POST['game'];
    	 		$categories	  = $_POST['categories'];
    	 		$media		  = $_POST['media'];
    	 		 $ez_news->update_draft( $post_id, $title, $body, $author, $categories, $game, $media );
    	 		break;
    	 		
    	 	case 'publish-post':
    	 		$post_id	  = $_POST['post_id'];
    	 		$title 		  = $_POST['title'];
    	 		$body	 	  = $_POST['body'];
    	 		$author		  = $_POST['author'];
    	 		$game		  = $_POST['game'];
    	 		$categories	  = $_POST['categories'];
    	 		$media		  = $_POST['media'];
    	 		 $ez_news->publish_post( $post_id, $title, $body, $author, $categories, $game, $media );
    	 		break;
    	 		
    	 	case 'unpublish-post':
    	 		$post_id	  = $_POST['post_id'];
    	 		 $ez_news->unpublish_post( $post_id );
    	 		break;
    	 	 	
    	 	case 'add-category':
    	 		$category	  = $_POST['category'];
    	 		 $ez_news->add_category( $category );
    	 		break;
    	 		
    	 	case 'delete-category':
    	 		$cat_id		  = $_POST['cat_id'];
    	 		 $ez_news->delete_category( $cat_id );
    	 		break;
    	 		
    	 	case 'delete-media':
    	 		$media_id	  = $_POST['media_id'];
    	 		 $ez_news->delete_media( $media_id );
    	 		break;
    	
    	 	default:
    	 		break;
    	 }
    	
    }
?>