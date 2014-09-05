<?php include('header.php'); ?>
<!-- BEGIN CONTAINER -->
<div class="page-container">
	<?php include('navbar.php'); ?>
	<!-- BEGIN CONTENT -->
	<div class="page-content-wrapper">
		<div class="page-content">
			<div class="row">
				<div class="col-md-12">
					<!-- BEGIN PAGE TITLE & BREADCRUMB-->
					<h3 class="page-title">
					Leagues <small>register, compete, game.</small>
					</h3>
					<ul class="page-breadcrumb breadcrumb">
						<li>
							<i class="fa fa-home"></i>
							<a href="index.php">Home</a>
							<i class="fa fa-angle-right"></i>
						</li>
						<li>
							<a href="#">Leagues</a>
						</li>
					</ul>
					<!-- END PAGE TITLE & BREADCRUMB-->
				</div>
			</div>
			<!-- END PAGE HEADER-->
			<!-- BEGIN PAGE CONTENT-->
			<div class="row">
				<div class="col-md-12 blog-page">
					<div class="row">
						<div class="col-md-12">
						<?php if( isset( $_GET['id'] ) && is_numeric( $_GET['id'] ) ) {
							$league_id = trim( $_GET['id'] );
							$league = $ez_league->get_league( $league_id ); 
							$season = $ez_league->get_current_season( $league_id );
							$current_season = $season['season'];	
						?>
							<h1><?php echo $league['game']; ?></h1>
							<h2><?php echo $league['league']; ?></h2>
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
							<!-- EVENT INFO -->
								<div class="col-md-6">
									<div class="success"><span class="success_text"></span></div>
									<div class="news-blocks">
										<h3 class="title"><a href="#">League Information </a></h3>
										<table class="table league-information">
											<tr>
												<th>Registration</th>
												<td>
												<?php if( $league['status'] == '1' ) { ?>
														<span class="text-success bolder">Open</span>
														<?php if( isset( $profile ) ) { ?>
															<?php if( $profile['team_admin'] == true ) { ?>
																<?php $exist = $ez_league->check_for_team( $profile['guild_id'], $league_id ); ?>
																<?php if( $exist == false ) { ?>
																		<button type="button" class="btn green btn-sm" onclick="registerTeam('<?php echo $profile['guild_id']; ?>', '<?php echo $league_id; ?>')">Register Team</button>
																<?php } else { ?>
																		<button disabled class="btn danger btn-sm">Already Registered</button>
																<?php } ?>
															<?php } ?>
														<?php } ?>
												<?php } else { ?>
														<span class="text-danger">Closed</span>
												<?php } ?>
												</td>
											</tr>
											<tr>
												<th>Rosters</th>
												<td>
												<?php if( $league['rosters'] == '1' ) { ?>
														<span class="text-success bolder">Unlocked</span>
												<?php } else { ?>
														<span class="text-danger">Locked</span>
												<?php } ?>
												</td>
											</tr>
											<tr>
												<th>Dates</th>
												<td><?php echo date( 'F d, Y', strtotime( $season['start'] ) ); ?></td>
											</tr>
											<tr>
												<th></th>
												<td><?php echo date( 'F d, Y', strtotime( $season['end'] ) ); ?></td>
											</tr>
											<tr>
												<th>Totals</th>
												<td><?php echo count( $ez_league->get_league_teams( $league_id ) ); ?> of <?php echo $league['teams']; ?> Max Teams</td>
											</tr>
											<tr>
												<th></th>
												<td><?php echo $league['games']; ?> Weeks</td>
											</tr>
											<tr>
												<th>Rules</th>
												<td><a href="view-rules.php?league=<?php echo $league_id; ?>">View Rules</a></td>
											</tr>
										</table>
									</div>
								</div>
							<!-- /. Event Info -->
							
							<!-- FEATURED MATCH -->
								<div class="col-md-6">
								<?php $featured_match = $ez_league->get_featured_match( 'random', $league_id ); ?>
									<div class="news-blocks">
										<h3 class="title"><a href="#">Featured Match </a></h3>
									<?php if( $featured_match ) { ?>
										<div class="news-block-tags">
											<h4>Week <?php echo $featured_match['week']; ?></h4>
											<strong><?php echo date( 'F d', strtotime( $featured_match['date'] ) ) . ', ' . $featured_match['time'] . '' . $featured_match['zone']; ?></strong>
											<em><?php echo $featured_match['map']; ?></em>
										</div>
											<div class="row featured_match">
												<div class="col-md-5">
													<img class="featured_match" src="logos/<?php echo $featured_match['home_logo']; ?>" alt="">
													<h4><?php echo $featured_match['home']; ?></h4>
													<a href="#" class="btn blue prediction btn-block">predict <i class="fa fa-check"></i></a>
												</div>
												<div class="col-md-2">
													<h4 class="versus">vs</h4>
												</div>
												<div class="col-md-5">
													<img class="featured_match" src="logos/<?php echo $featured_match['away_logo']; ?>" alt="">
													<h4><?php echo $featured_match['away']; ?></h4>
													<a href="#" class="btn blue prediction btn-block">predict <i class="fa fa-check"></i></a>
												</div>
											</div>
									<?php } else { ?>
										No featured matches
									<?php } ?>
									</div>
								</div>
							<!-- /. Featured Match -->
							</div>
						<?php } else { ?>
						<h3>League IDs must be integers</h3>
						<?php } ?>
						</div>
						<!--end col-md-12-->
					</div>
				</div>
			</div>
			<!-- END PAGE CONTENT-->
		</div>
	</div>
	<!-- END CONTENT -->
</div>
<!-- END CONTAINER -->
<?php include('footer.php'); ?>
<script src="assets/global/scripts/normal.js" type="text/javascript"></script>
<div id="register-team-confirm" title="Join this team?" style="display:none;">
	<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Confirm league registration.</p>
</div>