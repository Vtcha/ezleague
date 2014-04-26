<?php session_start();
include('lib/db.class.php');
include('lib/ezleague.class.php');

$ez = new ezLeague();
if(isset($_SESSION['ez_admin'])) {
	$ez->upgrade();} else {	print "Admins Only.";}
	
?>