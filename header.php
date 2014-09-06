<?php session_start();
define( 'EZL_VERSION', '3.2.1' );
date_default_timezone_set('America/Chicago');
include('lib/class-db.php');
include('lib/class-ezleague.php');

$ez = new ezLeague();
$ez->setup_ezleague();
$ez->test_connection();
$ez_news 	 = new ezLeague_News();
$ez_frontend = new ezLeague_Frontend();
$ez_users    = new ezLeague_User();
$ez_team	 = new ezLeague_Team();
$ez_league	 = new ezLeague_League();
$ez_inbox	 = new ezLeague_Inbox();
$ez_schedule = new ezLeague_Schedule();

if( isset( $_SESSION['ez_username'] ) ) {
	$profile = $ez_users->get_user( $_SESSION['ez_username'] );
}

$site_settings 		= $ez_frontend->get_site_settings();
$social_networks 	= $ez_frontend->get_social_networks();

if( $site_settings['handle'] != '' ) { 
	require_once dirname( __FILE__ ) . '/lib/codebird.php';
	\Codebird\Codebird::setConsumerKey('' . $site_settings['api'] . '', '' . $site_settings['secret'] . '');

	$cb = \Codebird\Codebird::getInstance();
	$cb->setToken('' . $site_settings['token'] . '', '' . $site_settings['token_secret'] . '');

	$params = array(
	            'screen_name' => '' . $site_settings['handle'] . '',
	            'count' => $site_settings['count'],
	        );

	$tweets = (array) $cb->statuses_userTimeline($params);
}

?>
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<?php include('tpls/system/head.php'); ?>
<!-- BEGIN BODY -->
<body class="page-header-fixed page-quick-sidebar-over-content ">
<!-- BEGIN HEADER -->
<div class="page-header navbar navbar-fixed-top">
	<!-- BEGIN HEADER INNER -->
	<div class="page-header-inner">
		<!-- BEGIN LOGO -->
		<div class="page-logo">
			<a href="index.php">
			<img src="logos/<?php echo $site_settings['logo']; ?>" alt="logo" class="logo-default"/>
			</a>
			<div class="menu-toggler sidebar-toggler hide">
				<!-- DOC: Remove the above "hide" to enable the sidebar toggler button on header -->
			</div>
		</div>
		<!-- END LOGO -->
		<!-- BEGIN RESPONSIVE MENU TOGGLER -->
		<a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">
		</a>
		<!-- END RESPONSIVE MENU TOGGLER -->
		<!-- BEGIN TOP NAVIGATION MENU -->
		<ul class="nav navbar-nav">
				<li class="main-nav">
					<a href="members.php" class="btn blue">Members</a>
				</li>
				<li class="main-nav">
					<a href="#" class="btn blue-hoki">Forums</a>
				</li>
				<li class="main-nav">
					<a href="about.php" class="btn blue-steel">About</a>
				</li>
				<li class="main-nav">
					<a href="contact-us.php" class="btn blue-madison">Contact</a>
				</li>
			</ul>
		<div class="top-menu">
			<ul class="nav navbar-nav pull-right">
				<!-- BEGIN USER LOGIN DROPDOWN -->
				<?php if( !empty( $_SESSION['ez_username'] ) ) { ?>
				<li class="dropdown dropdown-user">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
					<?php if( $profile['avatar'] != '' ) { ?>
					<img alt="" class="img-circle" src="avatars/<?php echo $profile['avatar']; ?>"/>
					<?php } ?>
					<span class="username">
					<?php echo $profile['username']; ?> </span>
					<i class="fa fa-angle-down"></i>
					</a>
					<ul class="dropdown-menu">
					<?php if( $profile['guild_id'] != '' ) { ?>
						<li>
							<a href="settings-guild.php">
							<i class="icon-user"></i> My Team </a>
						</li>
					<?php } else { ?>
						<li>
							<a href="create-team.php">
							<i class="icon-user"></i> Create Team </a>
						</li>
					<?php } ?>
						<li class="divider">
						<li>
							<a href="settings-profile.php">
							<i class="icon-user"></i> My Profile </a>
						</li>
						<li>
							<a href="view-inbox.php">
							<i class="icon-envelope-open"></i> My Inbox <span class="badge badge-danger">
							<?php echo $ez_inbox->count_new_inbox( $profile['username'] ); ?> </span>
							</a>
						</li>
						<li class="divider">
						</li>
						<li>
							<a href="logout.php">
							<i class="icon-key"></i> Log Out </a>
						</li>
					</ul>
				</li>
				<?php } else { ?>
				<!-- END USER LOGIN DROPDOWN -->
				<!-- BEGIN QUICK SIDEBAR TOGGLER -->
				<li class="main-nav">
					<a class="btn green" data-toggle="modal" href="#login">Login</a>
				</li>
				<li class="main-nav">
					<a class="btn green-meadow" data-toggle="modal" href="#register">Register</a>
				</li>
				<?php } ?>
				<!-- END QUICK SIDEBAR TOGGLER -->
			</ul>
		</div>
		<!-- END TOP NAVIGATION MENU -->
	</div>
	<!-- END HEADER INNER -->
</div>
<!-- END HEADER -->
<div class="clearfix">
</div>