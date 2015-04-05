<?php session_start();
include('../class-db.php');
include('../objects/class-user.php');

$ez_user = new ezLeague_User();

	if(isset($_POST['form'])) {
		$form = $_POST['form'];
		 switch($form) {
		 	
		 	case 'update-profile':
		 		$first_name		= $_POST['first'];
		 		$last_name		= $_POST['last'];
		 		$email			= $_POST['email'];
		 		$website		= $_POST['website'];
		 		$bio 			= $_POST['bio'];
		 		$hobbies		= $_POST['hobbies'];
		 		$location		= $_POST['from'];
		 		$occupation		= $_POST['occupation'];
		 		$signature		= htmlspecialchars( $_POST['signature'], ENT_QUOTES );
		 		$user_id		= $_POST['id'];
		 			$ez_user->update_profile($first_name, $last_name, $email, $website, $bio, $hobbies, $location, $occupation, $signature, $user_id);
		 		break;	
		 		
		 	case 'update-password':
		 		$password		= $_POST['password'];
		 		$user_id		= $_POST['id'];
		 			$ez_user->update_password($password, $user_id);
		 		break;

		 	case 'forgot-password':
		 		$username 		= $_POST['username'];
		 		$email 			= $_POST['email'];
		 			$ez_user->forgot_password($username, $email);
		 		break;
		 		
		 	case 'remove-avatar':
		 		$user_id		= $_POST['id'];
		 			$ez_user->remove_avatar($user_id);
		 		break;
		 		
		 	case 'send-team-invite':
		 		$team_id		= $_POST['tid'];
		 		$user_id		= $_POST['uid'];
		 			$ez_user->send_team_invite($team_id, $user_id);
		 		break;
		 		
		 	case 'accept-team-invite':
		 		$team_id		= $_POST['tid'];
		 		$user_id		= $_POST['uid'];
		 			$ez_user->accept_team_invite($team_id, $user_id);
		 		break;
		 		
		 	case 'leave-team':
		 		$user_id 		= $_POST['uid'];
		 			$ez_user->leave_team($user_id);
		 		break;
		 		
		 	case 'add-friend':
		 		$user_id		= $_POST['id'];
		 		$friend_id		= $_POST['friend_id'];
		 			$ez_user->add_friend($friend_id, $user_id);
		 		break;
		 		
		 	case 'remove-friend':
		 		$user_id		= $_POST['id'];
		 		$friend_id		= $_POST['friend_id'];
		 			$ez_user->remove_friend($friend_id, $user_id);
		 		break;
		 	
		 	default:
		 		break;
		 	
		 }
		 
	} else {
		print "nothing was submitted";
	}
?>