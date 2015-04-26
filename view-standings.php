<?php include('header.php'); ?>
<!-- BEGIN CONTAINER -->
<div class="page-container">
	<?php include('navbar.php'); ?>
	<!-- BEGIN CONTENT -->
	<div class="page-content-wrapper">
		<div class="page-content">
			<div class="row">
				<div class="col-md-12">
					<div class="col-lg-4">
						<h3 class="page-title">
						Leagues <small>register, compete, game.</small>
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
								<a href="#">Leagues</a>
								<i class="fa fa-angle-right"></i>
							</li>
							<li>
								<a href="#">Standings</a>
							</li>
						</ul>
					</div>
				</div>
			</div>
			<!-- END PAGE HEADER-->
			<!-- BEGIN PAGE CONTENT-->
			<div class="row">
				<div class="col-md-12 blog-page">
					<div class="row">
						<div class="col-md-12">
						<?php if( isset( $_GET['league'] ) && is_numeric( $_GET['league'] ) ) { ?>
						<?php 
							$league_id = trim( $_GET['league'] );
							$league = $ez_league->get_league( $league_id );
							$season = $ez_league->get_current_season( $league_id );
							$current_season = $season['season'];
							if( isset( $_GET['search'] ) ) {
								$search = trim( $_GET['search'] );
								$teams = $ez_team->search_teams( $search );
							} else { 
								$teams = $ez_league->get_league_teams( $league_id );
							} 
						?>
							<h1><?php echo $league['game']; ?></h1>
							<h2><?php echo $league['league']; ?> Standings</h2>
							<div class="row">
								
								<div class="col-md-2">
									<div class="top-news">
										<a href="view-league.php?id=<?php echo $league_id; ?>" class="btn grey">
											<span>Information </span>
											<i class="fa fa-cogs top-news-icon"></i>
										</a>
									</div>
								</div>
								<div class="col-md-2">
									<div class="top-news">
										<a href="view-standings.php?league=<?php echo $league_id; ?>" class="btn red">
											<span>Standings </span>
											<i class="fa fa-trophy top-news-icon"></i>
										</a>
									</div>
								</div>
								<div class="col-md-2">
									<div class="top-news">
										<a href="view-schedule.php?league=<?php echo $league_id; ?>" class="btn green">
											<span>Schedule </span>
											<i class="fa fa-calendar top-news-icon"></i>
										</a>
									</div>
								</div>
								<div class="col-md-2">
									<div class="top-news">
										<a href="view-results.php?league=<?php echo $league_id; ?>" class="btn blue">
										<span>Results </span>
										<i class="fa fa-gamepad top-news-icon"></i>
										</a>
									</div>
								</div>
								<div class="col-md-2">
									<div class="top-news">
										<a href="view-teams.php?league=<?php echo $league_id; ?>" class="btn yellow">
										<span>Teams </span>
										<i class="fa fa-users top-news-icon"></i>
										</a>
									</div>
								</div>
								<div style="clear:both;"></div>
								<hr/>
							</div>
							<div class="row">
							<!-- LEAGUE TEAMS -->
								<div class="col-md-12">
									<div class="news-blocks">
										<h3 class="title">Season <?php echo $current_season; ?> League Standings</h3>
									  <?php $standings = $ez_league->get_standings( $league_id ); ?>
										<table class="table league-information">
											<tr>
												<th>Team</th>
												<th>Wins</th>
												<th>Losses</th>
												<th></th>
											</tr>
											<tbody>
									<?php foreach( $standings as $team ) { ?>
									            <tr>
									             <td>
									             	<a href="view-team.php?id=<?php echo $team['guild_id']; ?>">
									             		<?php echo $team['guild']; ?>
									             	</a>
									             </td>
									             <td><?php echo $team['wins']; ?></td>
									             <td><?php echo $team['losses']; ?></td>
									             <td><a href="view-team.php?id=<?php echo $team['guild_id']; ?>" class="btn btn-primary btn-sm"><i class="fa fa-search"></i> View Team</a>
									            </tr>
									<?php } ?>
											</tbody>
										</table>
									</div>
								</div>
							<!-- /. Event Info -->
							
							</div>
						<?php } else { ?>
						<h3>League IDs must be integers</h3>
						<?php } ?>
						</div>
						<!--end col-md-12-->
					</div>
				</div>
			</div>
			<?php include( 'tpls/system/bottom-leaderboard.php' ); ?>
		</div>
	</div>
	<!-- END CONTENT -->
</div>
<!-- END CONTAINER -->
<?php include('footer.php'); ?>