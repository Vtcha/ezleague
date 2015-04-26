<?php session_start();
include('../class-db.php');
include('../class-ezadmin.php');
include('../objects/class-tournament.php');
$ez 	       = new ezAdmin();
$ez_tournament = new ezAdmin_Tournament();
    
    if(isset($_POST['form'])) {
    	$form = strip_tags($_POST['form']);
    	 switch($form) {
    	 	case 'add-map':
    	 		$map			= $_POST['map'];
    	 		$tournament_id	= $_POST['tournament_id'];
    	 		 $ez_tournament->add_map( $map, $tournament_id );
    	 		break;
    	 		
    	 	case 'set-map':
    	 		$map			= $_POST['map'];
    	 		$week			= $_POST['week'];
    	 		$tournament_id 	= $_POST['league'];
    	 		 $ez_tournament->set_map( $tournament_id, $week, $map );
    	 		break;
    	 		
    	 	case 'edit-rules':
    	 		$tournament_id  = $_POST['tournament_id'];
    	 		$rules          = $_POST['body'];
    	 		 $ez_tournament->edit_rules( $tournament_id, $rules );
    	 		break;
    	 		
    	 	case 'edit-tournament':
    	 		$tournament_id  = $_POST['tournament_id'];
                $tournament     = $_POST['tournament'];
    	 		$max_teams		= $_POST['max_teams'];
                $format         = $_POST['format'];
                $start          = strtotime( $_POST['start'] );
                $registration   = strtotime( $_POST['registration'] );
    	 		 $ez_tournament->edit_tournament($max_teams, $tournament_id, $tournament, $format, $start, $registration);
    	 		break;

            case 'edit-match':
                $match_id       = $_POST['match_id'];
                $home_id        = $_POST['home_id'];
                $away_id        = $_POST['away_id'];
                $home_score     = $_POST['home_score'];
                $home_accept    = $_POST['home_accept'];
                $away_score     = $_POST['away_score'];
                $away_accept    = $_POST['away_accept'];
                $match_status   = $_POST['match_status'];
                $round          = $_POST['round'];
                $tid            = $_POST['tournament_id'];
                $max_teams      = $_POST['max_teams'];
                $date           = $_POST['match_date'];
                $time           = $_POST['match_time'];
                $zone           = $_POST['match_zone'];
                $stream_url     = $_POST['stream_url'];
                $ip             = $_POST['server_ip'];
                $password       = $_POST['server_password'];
                $moderator      = $_POST['match_moderator'];
                 $ez_tournament->edit_tournament_match( $match_id, $home_id, $home_score, $home_accept, $away_id, $away_score, $away_accept, $match_status, $tid, $max_teams, $date, $time, $zone, $stream_url, $ip, $password, $moderator, $round );
                break;

            case 'add-chat-message':
                $match_id   = $_POST['id'];
                $username   = $_POST['username'];
                $message    = $_POST['message'];
                    $ez_tournament->update_chat_log($match_id, $username, $message);
                break;

    	 	case 'delete-tournament':
    	 		$tournament_id	= $_POST['tournament_id'];
    	 		 $ez_tournament->delete_tournament( $tournament_id );
    	 		break;
    	 		
    	 	case 'create-tournament':
    	 		$tournament		= $_POST['tournament'];
    	 		$teams			= $_POST['max_teams'];
    	 		$game			= $_POST['game'];
                $start          = strtotime( $_POST['start'] );
                $registration   = strtotime( $_POST['registration'] );
                $format         = $_POST['format'];
                $public         = $_POST['pub'];
    	 		 $ez_tournament->create_tournament( $tournament, $game, $teams, $start, $registration, $format, $public );
    	 		break;
    	 	
            case 'kick-team':
                $tournament_id  = $_POST['tournament_id'];
                $team_id        = $_POST['team_id'];
                 $ez_tournament->kick_team( $tournament_id, $team_id );
                break;

            case 'unkick-team':
                $tournament_id  = $_POST['league_id'];
                $team_id        = $_POST['team_id'];
                 $ez_tournament->unsuspend_team( $tournament_id, $team_id );
                break;

            case 'add-tournament-map':
                $tournament_id  = $_POST['tournament_id'];
                $map            = $_POST['map'];
                 $ez_tournament->add_tournament_map( $tournament_id, $map );
                break;

            case 'set-round-map':
                $tournament_id  = $_POST['tournament_id'];
                $round          = $_POST['round'];
                $map            = $_POST['map'];
                 $ez_tournament->set_round_map( $tournament_id, $round, $map );
                break;

            case 'delete-map':
                $tournament_id  = $_POST['tournament_id'];
                $map            = $_POST['map'];
                 $ez_tournament->delete_map( $tournament_id, $map );
                break;

    	 	default:
    	 		break;
    	 }
    	
    }
?>