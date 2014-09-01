<?php session_start();
include('lib/class-db.php');
include('lib/class-ezadmin.php');
$ez = new ezAdmin();
    
    if(isset($_POST['form'])) {
    	$form = strip_tags($_POST['form']);
    	 switch($form) {
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
    	 	 	
    	 	 case 'install':
    	 	 	$site_name	= $_POST['site_name'];
    	 	 	 $ez->run_installer( $site_name );
    	 	 	break;

    	 	default:
    	 		break;
    	 }
    	
    }
?>