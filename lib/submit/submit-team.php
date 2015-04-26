<?php session_start();
include('../class-db.php');
include('../objects/class-team.php');

$ez_team = new ezLeague_Team();

	if(isset($_POST['form'])) {
		$form = $_POST['form'];
		 switch($form) {
 
		 	case 'create-team':
		 		$team		= $_POST['team'];
		 		$abbr		= $_POST['abbr'];
		 		$website	= $_POST['website'];
		 		$admin		= $_POST['admin'];
		 		$password	= $_POST['password'];
		 			$ez_team->create_team($team, $abbr, $website, $password, $admin);
		 		break;
		 		
		 	case 'team-settings':
		 		$id			= $_POST['id'];
		 		$admin		= $_POST['admin'];
		 		$leader		= $_POST['leader'];
		 		$coleader	= $_POST['coleader'];
		 		$website	= $_POST['website'];
		 			$ez_team->update_team_settings($admin, $leader, $coleader, $website, $id);
		 		break;
		 		
		 	case 'team-password':
		 		$password	= $_POST['password'];
		 		$id 		= $_POST['id'];
		 			$ez_team->update_team_password($password, $id);
		 		break;
		 		
		 	case 'team-kick-member':
		 		$member		= $_POST['member'];
		 			$ez_team->kick_team_member( $member );
		 		break;
		 		
		 	case 'add-league-roster':
		 		$team_id	= $_POST['team'];
		 		$user_id	= $_POST['user'];
		 		$league_id	= $_POST['league'];
		 		$roster_id	= $_POST['roster'];
		 			$ez_team->add_league_member($league_id, $team_id, $roster_id, $user_id);
		 		break;

		 	case 'remove-league-roster':
		 		$team_id	= $_POST['team_id'];
		 		$user_id	= $_POST['user_id'];
		 		$league_id	= $_POST['league_id'];
		 			$ez_team->remove_league_member($league_id, $team_id, $user_id);
		 		break;
		 		
		 	case 'remove-logo':
		 		$team_id	= $_POST['id'];
		 			$ez_team->update_logo($team_id, '');
		 		break;

		 	case 'register-league':
		 		$team_id 	= $_POST['tid'];
		 		$league_id  = $_POST['lid'];
		 		 $ez_team->register_league($team_id, $league_id);
		 		break;

		 	case 'register-tournament':
		 		$team_id 		= $_POST['tid'];
		 		$tournament_id  = $_POST['tournament_id'];
		 		 $ez_team->register_tournament($team_id, $tournament_id);
		 		break;
		 	
		 	default:
		 		break;
		 	
		 }
		 
	} else {
		print "nothing was submitted";
	}
?>