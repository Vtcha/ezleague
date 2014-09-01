<?php session_start();
include('lib/class-db.php');
include('lib/objects/class-user.php');

$ez_user = new ezLeague_User();

	if(isset($_POST['form'])) {
		$form = $_POST['form'];
		 switch($form) {
/*
 * LOGIN, REGISTRATION & INSTALLATION
 */		 
		 	case 'login':
		 		$username = $_POST['username'];
		 		$password = $_POST['password'];
		 		 $ez_user->login($username, $password);
		 	break;
		 	case 'register':
		 		$username	= $_POST['username'];
		 		$password	= $_POST['password'];
		 		$confirm	= $_POST['confirm'];
		 		$email		= $_POST['email'];
		 		 $ez_user->register($username, $password, $email);
		 	break;
		 	case 'reset_password':
		 		$email 		= $_POST['email'];
		 		 $ez->resetPassword($email);
		 	break;
		 	case 'new_password':
		 		$id 		= $_POST['user_id'];
		 		$password	= $_POST['password'];
		 		 $ez->changePassword($id, $password);
		 	break;
		 	case 'new_email':
		 		$id 		= $_POST['user_id'];
		 		$email		= $_POST['email'];
		 		 $ez->updateEmail($id, $email);
		 	break;
		 	
		 }
		 
	} else {
		print "nothing was submitted";
	}
?>