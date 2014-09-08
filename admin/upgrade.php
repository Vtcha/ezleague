<?php session_start();
date_default_timezone_set('America/Chicago');
include('lib/class-db.php');
include('lib/class-ezadmin.php');
$ez = new ezAdmin();

/**
 * Upgrades include: Recent Twitter Tweets, Site Favorite Icon v2, Prediction System, Installation v3, Game Edit Short Name, Max League Roster
 */    
     if( isset($_SESSION['ez_admin'] ) ) {
     	$ez->run_upgrade();
     	unlink('upgrade.php');
     } else {
     	echo 'You are not an admin';
     }
?>