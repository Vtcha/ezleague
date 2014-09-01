<?php session_start();
include('../class-db.php');
include('../objects/class-news.php');

$ez_news = new ezLeague_News();

	if(isset($_POST['form'])) {
		$form = $_POST['form'];
		 switch($form) {
		 		
		 	case 'add-comment':
		 		$post_id		= $_POST['post_id'];
		 		$author			= $_POST['author'];
		 		$author_id		= $_POST['author_id'];
		 		$comment		= $_POST['comment'];
		 			$ez_news->add_comment($author, $author_id, $comment, $post_id);
		 		break;
		 	
		 	default:
		 		break;
		 	
		 }
		 
	} else {
		print "nothing was submitted";
	}
?>