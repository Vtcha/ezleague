<?php include('header.php'); ?>
<?php $team_settings = $ez_team->get_team( $profile['guild_id'] ); ?>
<?php $members = $ez_team->get_team_members( $profile['guild_id'] ); ?>
<div class="page-container">
	<?php include('navbar.php'); ?>
	<!-- BEGIN CONTENT -->
	<div class="page-content-wrapper">
		<div class="page-content">
			<div class="row">
				<div class="col-md-12">
					<div class="col-lg-4">
						<h3 class="page-title">
						Team Settings <small>manage your team.</small>
						</h3>
					</div>
					<div class="col-lg-8">
						<?php include( 'tpls/system/top-leaderboard.php' ); ?>
					</div>
					<div class="col-lg-12">
						<ul class="page-breadcrumb breadcrumb">
							<li>
								<i class="fa fa-home"></i>
								<a href="index.php">Home</a>
								<i class="fa fa-angle-right"></i>
							</li>
							<li>
								<a href="#">Team Settings</a>
							</li>
						</ul>
					</div>
				</div>
			</div>
			<!-- BEGIN PAGE CONTENT-->
			<div class="row">
				<div class="col-md-12 blog-page">
				<?php 
				if( isset( $profile['guild_id'] ) ) {
					if( isset( $_GET['page'] ) && isset( $_GET['view'] ) ) {
						$page = trim( $_GET['page'] );
						$view = trim( $_GET['view'] );
						if( isset( $_GET['id'] ) && $page == 'leagues' ) {
							$league_id = trim( $_GET['id'] );
							$league_details = $ez_team->get_league_details( $league_id );
						} else if( isset( $_GET['id'] ) && $page == 'tournaments' ) {
							$tournament_id = trim( $_GET['id'] );
							$tournament_details = $ez_team->get_tournament_details( $tournament_id );
						}
						
						if( isset( $_GET['mid'] ) && $page == 'match' ) {
							$match_id = trim( $_GET['mid'] );
							$match_details = $ez_league->get_match_details( $match_id );
							$league_id = $match_details['league_id'];
						} else if( isset( $_GET['mid'] ) && $page == 'tournament_match' ) {
							$match_id = trim( $_GET['mid'] );
							$match_details = $ez_tournament->get_tournament_match( $match_id );
							$tournament_id = $match_details['tid'];
						}

						include('tpls/settings/view-sidebar.php');
				?>
				<div class="col-md-9">
				<?php 
						switch( $page ) {
							case 'leagues':
								include('tpls/settings/leagues/view-' . $view . '.php');
								break;
							case 'match':
								include('tpls/settings/leagues/view-match.php');
								break;
							case 'tournaments':
								include('tpls/settings/tournaments/view-' . $view . '.php');
								break;
							case 'tournament_match':
								include('tpls/settings/tournaments/view-match.php');
								break;
							default:
								break;
						}
				
					include( 'tpls/system/bottom-leaderboard.php' ); 
				?>
				</div>
				<?php 
					} else {
						include('tpls/settings/view-guild.php');
						include( 'tpls/system/bottom-leaderboard.php' );
					} 
				} else {
					echo '<h3>You have not joined a team</h3>';
				}
				?>
				</div>
			</div>
			<!-- END PAGE CONTENT-->
		</div>
	</div>
	<!-- END CONTENT -->
</div>
<!-- END CONTAINER -->
<?php include('footer.php'); ?>
<div id="kick-member-confirm" title="Kick team member?" style="display:none;">
	<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>This action cannot be undone. Are you sure?</p>
</div>
<div id="remove-logo-confirm" title="Remove team logo?" style="display:none;">
	<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>This action cannot be undone. Are you sure?</p>
</div>
<div id="remove-league-member-confirm" title="Remove league member?" style="display:none;">
	<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Confirm removing member from league roster.</p>
</div>
<script src="assets/global/scripts/teams.js"></script>
<script src="assets/global/scripts/leagues.js"></script>
<script src="assets/global/scripts/tournaments.js"></script>
<script src="assets/global/scripts/normal.js"></script>
<script>
$(function() {
	$( "#match-date" ).datepicker();
	$( "#match-date" ).datepicker( "option", "dateFormat", "yy-mm-dd" );
	$( "#match-date" ).datepicker({
        dateFormat: 'yy-mm-dd'
    }).val('<?php echo $match_details['date']; ?>');
});
</script>
<script type="text/javascript" src="assets/global/plugins/fancybox/source/jquery.fancybox.pack.js"></script>
<script>$('.fancybox').fancybox();</script>