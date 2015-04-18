<?php session_start();
include('../class-db.php');
include('../objects/class-tournament.php');

$ez_tournament = new ezLeague_Tournament();

	if(isset($_POST['form'])) {
		$form = $_POST['form'];
		 switch($form) {
 
		 	case 'update-match-details':
		 		$match_id	= $_POST['id'];
		 		$date	 	= $_POST['date'];
		 		$time		= $_POST['time'];
		 		$zone		= $_POST['zone'];
		 		$stream_url = $_POST['stream_url'];
		 			$ez_tournament->update_match_details($match_id, $date, $time, $zone, $stream_url);
		 		break;

		 	case 'update-match-information':
		 		$match_id 	= $_POST['id'];
		 		$ip 		= $_POST['ip'];
		 		$password 	= $_POST['password'];
		 		$moderator 	= $_POST['moderator'];
		 			$ez_tournament->update_match_information($match_id, $ip, $password, $moderator);
		 		break;
		 		
		 	case 'accept-match-details':
		 		$match_id	= $_POST['id'];
		 		$match_side = $_POST['side'];
		 			$ez_tournament->toggle_match_details($match_id, $match_side, 'accept');
		 		break;
		 		
	 		case 'reject-match-details':
	 			$match_id	= $_POST['id'];
	 			$match_side = $_POST['side'];
	 				$ez_tournament->toggle_match_details($match_id, $match_side, 'reject');
	 			break;
	 			
	 		case 'add-chat-message':
	 			$match_id	= $_POST['id'];
	 			$username	= $_POST['username'];
	 			$message	= $_POST['message'];
	 				$ez_tournament->update_chat_log($match_id, $username, $message);
	 			break;
	 			
	 		case 'report-score':
	 			$match_id	= $_POST['id'];
	 			$home_score	= $_POST['home_score'];
	 			$away_score	= $_POST['away_score'];
	 			$reporter	= $_POST['reporter'];
	 				$ez_tournament->report_match($match_id, $home_score, $away_score, $reporter);
	 			break;
	 			
	 		case 'delete-screenshot':
	 			$screenshot_id	= $_POST['id'];
	 				$ez_tournament->delete_screenshot($screenshot_id);
	 			break;
	 			
	 		case 'dispute-match':
	 			$match_id		= $_POST['id'];
	 			$category		= $_POST['category'];
	 			$dispute		= $_POST['dispute'];
	 			$reporter		= $_POST['reporter'];
	 				$ez_tournament->dispute_match($match_id, $category, $dispute, $reporter);
	 			break;

	 		case 'make-prediction':
	 			$match_id 		= $_POST['match_id'];
	 			$team_id 		= $_POST['team_id'];
	 			$username 		= $_POST['user'];
	 			 $ez_tournament->make_prediction($team_id, $match_id, $username);
	 			break;
		 		
		 	default:
		 		break;
		 	
		 }
		 
	} else {
		print "nothing was submitted";
	}
?>