<?php session_start();
include('../class-db.php');
include('../objects/class-settings.php');
$ez_settings = new ezAdmin_Settings();
    
    if(isset($_POST['form'])) {
    	$form = strip_tags($_POST['form']);
    	 switch($form) {
    	 	case 'delete-game':
    	 		$game_id	= $_POST['game_id'];
    	 		 $ez_settings->delete_game( $game_id );
    	 		break;
    	 		
    	 	case 'add-game':
    	 		$game		= $_POST['game'];
    	 		$short_name = $_POST['short'];
    	 		$slug		= $_POST['slug'];
    	 		 $ez_settings->add_game( $game, $short_name, $slug );
    	 		break;
    	 		
    	 	case 'edit-game':
    	 		$game_id	= $_POST['game_id'];
    	 		$short_name = $_POST['short_name'];
    	 		 $ez_settings->edit_game( $game_id, $short_name );
    	 		break;
    	 		
    	 	case 'create-admin':
    	 		$username	= $_POST['username'];
    	 		$password	= $_POST['password'];
    	 		$email		= $_POST['email'];
    	 		 $ez_settings->create_admin( $username, $password, $email );
    	 		break;
    	 		
    	 	case 'update-facebook':
    	 		$facebook	= $_POST['facebook'];
    	 		 $ez_settings->update_social_network( 'facebook', $facebook );
    	 		break;
    	 		
    	 	case 'update-twitter':
    	 		$twitter	= $_POST['twitter'];
    	 		 $ez_settings->update_social_network( 'twitter', $twitter );
    	 		break;
    	 	
    	 	case 'update-youtube':
    	 		$youtube	= $_POST['youtube'];
    	 		 $ez_settings->update_social_network( 'youtube', $youtube );
    	 		break;
    	 		
    	 	case 'update-google':
    	 		$google		= $_POST['google'];
    	 		 $ez_settings->update_social_network( 'google', $google );
    	 		break;
    	 		
    	 	case 'update-settings':
    	 		$setting	= $_POST['setting'];
    	 		$value		= $_POST['value'];
    	 		 $ez_settings->update_site_settings( $setting, $value );
    	 		break;
    	 		
    	 	case 'delete-admin':
    	 		$user_id	= $_POST['user_id'];
    	 		 $ez_settings->delete_admin( $user_id );
    	 		break;

            case 'update-twitter-app':
                $count        = $_POST['count'];
                $handle       = $_POST['handle'];
                $api          = $_POST['api'];
                $secret       = $_POST['secret'];
                $token        = $_POST['token'];
                $token_secret = $_POST['token_secret'];
                 $ez_settings->update_twitter_app_settings( $count, $handle, $api, $secret, $token, $token_secret );
                break;

            case 'update-mandrill':
                $username      = $_POST['username'];
                $password      = $_POST['password'];
                 $ez_settings->update_mandrill( $username, $password );
                break;
    	 	
    	 	default:
    	 		break;
    	 }
    	
    }
?>