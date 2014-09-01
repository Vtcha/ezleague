<?php session_start();
include('../class-db.php');
include('../objects/class-inbox.php');

$ez_inbox = new ezLeague_Inbox();

	if(isset($_POST['form'])) {
		$form = $_POST['form'];
		 switch($form) {
		 		
		 	case 'add-reply':
		 		$sender			= $_POST['author'];
		 		$message_id		= $_POST['id'];
		 		$message		= $_POST['message'];
		 			$ez_inbox->send_response($message_id, $message, $sender);
		 		break;
		 		
		 	case 'send-message':
		 		$sender 		= $_POST['from'];
		 		$receiver		= $_POST['to'];
		 		$message		= $_POST['message'];
		 		$subject		= $_POST['subject'];
		 			$ez_inbox->send_message($subject, $message, $receiver, $sender);
		 		break;
		 	
		 	default:
		 		break;
		 	
		 }
		 
	} else {
		print "nothing was submitted";
	}
?>