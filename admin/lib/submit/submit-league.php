<?php session_start();
include('../class-db.php');
include('../class-ezadmin.php');
include('../objects/class-league.php');
$ez 	   = new ezAdmin();
$ez_league = new ezAdmin_League();
    
    if(isset($_POST['form'])) {
    	$form = strip_tags($_POST['form']);
    	 switch($form) {
    	 	case 'create-season':
    	 		$start 		  = $_POST['start'];
    	 		$end	 	  = $_POST['end'];
    	 		$registration = $_POST['registration'];
    	 		$league_id	  = $_POST['league_id'];
    	 		 $ez_league->create_season( $league_id, $start, $end, $registration );
    	 	 	break;
    	 	 
    	 	case 'delete-season':
    	 		$season_id		= $_POST['season'];
    	 		 $ez_league->delete_season( $season_id );
    	 		break;
    	 		
    	 	case 'add-map':
    	 		$map			= $_POST['map'];
    	 		$league_id		= $_POST['league_id'];
    	 		 $ez_league->add_map( $map, $league_id );
    	 		break;
    	 		
    	 	case 'set-map':
    	 		$map			= $_POST['map'];
    	 		$week			= $_POST['week'];
    	 		$league_id 		= $_POST['league'];
    	 		 $ez_league->set_map( $league_id, $week, $map );
    	 		break;
    	 		
    	 	case 'edit-rules':
    	 		$league_id		= $_POST['league_id'];
    	 		$rules			= $_POST['body'];
    	 		 $ez_league->edit_rules( $league_id, $rules );
    	 		break;
    	 		
    	 	case 'edit-league':
    	 		$league_id		= $_POST['league_id'];
    	 		$total_games	= $_POST['total_games'];
    	 		$max_teams		= $_POST['max_teams'];
                $max_roster     = $_POST['max_roster'];
                $start          = strtotime( $_POST['start'] );
                $end            = strtotime( $_POST['end'] );
    	 		 $ez_league->edit_league( $max_teams, $total_games, $league_id, $max_roster, $start, $end );
    	 		break;
    	 		
    	 	case 'delete-league':
    	 		$league_id		= $_POST['league_id'];
    	 		 $ez_league->delete_league( $league_id );
    	 		break;
    	 		
    	 	case 'create-league':
    	 		$league			= $_POST['league'];
    	 		$teams			= $_POST['max_teams'];
    	 		$games			= $_POST['total_games'];
                $max_roster     = $_POST['max_roster'];
    	 		$game			= $_POST['game'];
                $start          = strtotime( $_POST['start'] );
                $end            = strtotime( $_POST['end'] );
    	 		 $ez_league->create_league( $league, $game, $teams, $games, $max_roster, $start, $end );
    	 		break;

            case 'edit-season':
                $start          = strtotime( $_POST['start'] );
                $end            = strtotime( $_POST['end'] );    
                $registration   = strtotime( $_POST['registration'] ); 
                $season_id      = $_POST['season_id'];
                 $ez_league->edit_season( $season_id, $start, $end, $registration );
                break;

            case 'lock-rosters':
                $league_id      = $_POST['league_id'];
                 $ez_league->lock_rosters( $league_id );
                break;

            case 'unlock-rosters':
                $league_id      = $_POST['league_id'];
                 $ez_league->unlock_rosters( $league_id );
                break;
    	 	
            case 'kick-team':
                $league_id      = $_POST['league_id'];
                $team_id        = $_POST['team_id'];
                 $ez_league->kick_team( $league_id, $team_id );
                break;

    	 	default:
    	 		break;
    	 }
    	
    }
?>