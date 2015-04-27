<?php session_start();
include('../class-db.php');
include('../objects/class-team.php');
$ez_team = new ezAdmin_Team();
    
    if(isset($_POST['form'])) {
    	$form = strip_tags($_POST['form']);
    	 switch($form) {
    	 	case 'set-team-leader':
    	 		$username	= $_POST['username'];
                $team_id    = $_POST['team_id'];
    	 		 $ez_team->set_team_leader( $team_id, $username );
    	 		break;

            case 'set-team-coleader':
                $username   = $_POST['username'];
                $team_id    = $_POST['team_id'];
                 $ez_team->set_team_coleader( $team_id, $username );
                break;

            case 'set-team-admin':
                $username   = $_POST['username'];
                $team_id    = $_POST['team_id'];
                 $ez_team->set_team_admin( $team_id, $username );
                break;

            case 'change-team-name':
                $team_name  = $_POST['team_name'];
                $team_id    = $_POST['team_id'];
                 $ez_team->change_team_name( $team_id, $team_name );
                break;
    	 	
    	 	default:
    	 		break;
    	 }
    	
    }
?>