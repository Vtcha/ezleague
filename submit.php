<?php session_start();
include('lib/db.class.php');
include('lib/ezleague.class.php');

$ez = new ezLeaguePub();
$ez_username = $_SESSION['ez_username'];

	if(isset($_POST['form'])) {
		$form = $_POST['form'];
		
		 switch($form) {
		 	
/*
 * LOGIN, REGISTRATION & INSTALLATION
 */		 
		 	case 'login':
		 		$username = $_POST['username'];
		 		$password = $_POST['password'];
		 		 $ez->login($username, $password);
		 		break;
		 	
		 	case 'register':
		 		$username	= $_POST['username'];
		 		$password	= $_POST['password'];
		 		$confirm	= $_POST['confirm'];
		 		$email		= $_POST['email'];
		 		 $ez->register($username, $password, $email);
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
		 		
		 	case 'installer':
		 		$site_name  = $_POST['site_name'];
		 		 $ez->runInstaller($site_name);
		 		break;
		 		
		 	case 'makePrediction':
		 		$cid		= $_POST['challenge_id'];
		 		$winner		= $_POST['winner'];
		 		$comment	= $_POST['comment'];
		 		 $ez->makePrediction($ez_username, $cid, $winner, $comment);
		 		break;
		 		
		 	case 'sendMessage':
		 		$recipients		= $_POST['recipients'];
		 		$subject		= $_POST['subject'];
		 		$message		= $_POST['message'];
		 		 $ez->sendMessage($subject, $message, $recipients, $ez_username);
		 		break;
		 		
	 		case 'sendReply':
	 			$message		= $_POST['message'];
	 			$message_id		= $_POST['message_id'];
	 			 $ez->sendResponse($message_id, $message, $ez_username);
	 		    break;
	 		    
	 		case 'contactEmail':
	 			$name			= $_POST['name'];
	 			$to 			= $_POST['to'];
	 			$from 			= $_POST['from'];
	 			$message		= $_POST['message'];
	 			 $ez->sendEmail($to, $from, $name, $message);
	 			break;
		 		
/*
 * LEAGUES & CHALLENGES
 */		 
		 	case 'joinLeague':
		 		$guild		= $_POST['guild'];
		 		$league		= $_POST['league'];
		 		 $ez->joinLeague($guild, $league);
		 		break;
		 		
		 	case 'leaveLeague':
		 		$team_id	= $_POST['team_id'];
		 		$league_id  = $_POST['league_id'];		 		
		 		 $ez->leaveLeague($league_id, $team_id);
		 		break;
		 		
		 	case 'makeChallenge':
		 		$guild			= $_POST['guild'];
		 		$challenger		= $_POST['challenger'];
		 		$league_id		= $_POST['league'];
		 		 $ez->makeChallenge($challenger, $guild, $league_id);
		 		break;
		 		
		 	case 'challengeStatus':
		 		$team 			= $_POST['team'];
		 		$status			= $_POST['status'];
		 		$match_id		= $_POST['id'];
		 		 $ez->updateChallengeStatus($match_id, $team, $status);
		 		break;
		 		
		 	case 'matchSettings':
		 		$id				= $_POST['id'];
		 		$date			= $_POST['date'];
		 		$hour			= $_POST['hour'];
		 		$mins			= $_POST['mins'];
		 		$zone			= $_POST['zone'];
		 		$pod			= $_POST['pod'];
		 		 $ez->updateChallenge($id, $date, $hour, $mins, $zone, $pod);
		 		break;
		 		
		 	case 'submitScore':
		 		$challenger 	= $_POST['challenger'];
		 		$challengee		= $_POST['challengee'];
		 		$match_id		= $_POST['id'];
		 		 $ez->submitChallengeScore($match_id, $challenger, $challengee);
		 		break;
		 		
		 	case 'addResponse':
		 		$body			= $_POST['body'];
		 		$id				= $_POST['id'];
		 		$date = date('m/d/y h:ia', strtotime('now'));
		 		 $response = "[<em>" . $date . "</em>] " . "<strong>" . $ez_username . "</strong> " . $body;
		 		 $ez->updateChallengeResponse($id, $response, $ez_username);
		 		break;
		 		
		 	case 'dispute':
		 		$id				= $_POST['id'];
		 		$description 	= $_POST['description'];
		 		$filer			= $_POST['filer'];
		 		 $ez->addDispute($id, $description, $filer);
		 		break;
		 		
/*
 * TEAMS
 */		 		
		 		
		 	case 'createTeam':
		 		$team		= $_POST['team'];
		 		$abbr 		= $_POST['abbr'];
		 		$game		= $_POST['game'];
		 		 $ez->createTeam($team, $abbr, $game, $ez_username);
		 		break;
		 		
		 	case 'teamSettings':
		 		$id			= $_POST['id'];
		 		$gm 		= $_POST['gm'];
		 		$agm		= $_POST['agm'];
		 		$site		= $_POST['site'];
		 		$admin		= $_POST['admin'];
		 		 $ez->updateTeamSettings($id, $gm, $agm, $site, $admin);
		 		break;
		 		
		 	case 'teamInvite':
		 		$user_id	= $_POST['user_id'];
		 		$team_id	= $_POST['team_id'];
		 		 $ez->sendTeamInvite($user_id, $team_id);
		 		break;
		 		
		 	case 'joinTeam':
		 		$username	= $_POST['username'];
		 		$team_id	= $_POST['team_id'];
		 		 $ez->joinTeam($team_id, $username);
		 		break;
		 	
		 	default:
		 		break;
		 }
		 
	} else {
		print "nothing was submitted";
	}
?>