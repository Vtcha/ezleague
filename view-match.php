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
							<i class="fa fa-angle-right"></i>
						</li>
						<li>
							<a href="#">Match Results</a>
							<i class="fa fa-angle-right"></i>
						</li>
						<li>
							<a href="#">Result</a>
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
						<?php if( isset( $_GET['league'] ) && is_numeric( $_GET['league'] ) && isset( $_GET['id'] ) && is_numeric( $_GET['id'] ) ) { ?>
						<?php 
							$league_id = trim( $_GET['league'] );
							$match_id = trim( $_GET['id'] );
						?>
							<h1><?php echo $league['game']; ?></h1>
							<h2><?php echo $league['league']; ?> Match Result Details</h2>
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
							<?php $match_details = $ez_league->get_match_details( $match_id ); ?>
							<?php if( $match_details ) { ?>
							<?php
									if( isset( $profile ) ) { 
										$prediction_check = $ez_league->check_if_predicted( $profile['username'], $match_details['id'] );
									} else {
										$prediction_check = false;
									}
							?>
							<!-- MATCHUP -->
								<div class="col-md-6">
									<div class="news-blocks">
										<h3 class="title">Matchup</h3>
											<div class="row match_details">
												<div class="col-md-5">
													<a href="view-team.php?id=<?php echo $match_details['home_id']; ?>">
														<img class="featured_match" src="logos/<?php echo $ez_team->get_logo( $match_details['home_id'] ); ?>" alt="">
													</a>
													<h4><a href="view-team.php?id=<?php echo $match_details['home_id']; ?>"><?php echo $match_details['home_team']; ?></a></h4>
													<button type="button" 
														<?php 
															if( isset( $profile ) && $prediction_check == false ) { ?>
																onclick="makePrediction('<?php echo $match_details['home_id']; ?>', '<?php echo $match_details['id']; ?>', '<?php echo $profile['username']; ?>')"
														<?php } else { ?>
																disabled
														<?php } ?>
															class="btn blue prediction btn-block">
																predict <i class="fa fa-check"></i> <br/>(<?php echo $match_details['predictions']['home_percent']; ?>) 
													</button>
												</div>
												<div class="col-md-2">
													<h4 class="versus">vs</h4>
												</div>
												<div class="col-md-5">
													<a href="view-team.php?id=<?php echo $match_details['away_id']; ?>">
														<img class="featured_match" src="logos/<?php echo $ez_team->get_logo( $match_details['away_id'] ); ?>" alt="">
													</a>
													<h4><a href="view-team.php?id=<?php echo $match_details['away_id']; ?>"><?php echo $match_details['away_team']; ?></a></h4>
													<button type="button" 
														<?php 
															if( isset( $profile ) && $prediction_check == false ) { ?>
																onclick="makePrediction('<?php echo $match_details['away_id']; ?>', '<?php echo $match_details['id']; ?>', '<?php echo $profile['username']; ?>')"
														<?php } else { ?>
																disabled
														<?php } ?>
															class="btn blue prediction btn-block">
																predict <i class="fa fa-check"></i> <br/>(<?php echo $match_details['predictions']['away_percent']; ?>) 
													</button>
												</div>
											</div>
									</div>
								</div>
							<!-- /. Matchup -->
							<!-- MATCH SCREENSHOTS -->
								<div class="col-md-6">
									<div class="news-blocks">
										<h3 class="title">Match Details</h3>
										<table class="table league-information">
											<tr>
												<th>Date</th>
												<td><?php echo ( $match_details['date'] == '' ? 'Not Set' : date( 'F d, Y', strtotime( $match_details['date'] ) ) ); ?></td>
											</tr>
											<tr>
												<th>Time</th>
												<td><?php echo $match_details['time'];?> <?php echo $match_details['zone']; ?></td>
											</tr>
											<tr>
												<th>Map</th>
												<td>de_dust2</td>
											</tr>
											<tr>
												<th>Watch</th>
												<td><?php if( isset( $match_details['stream_url'] ) ) { ?>
														<a href="<?php echo $match_details['stream_url']; ?>" target="_blank">Stream URL</a>
													<?php } else { ?>
														Stream URL Not Set
													<?php } ?>
												</td>
											</tr>
										</table>
									</div>
									<div class="success"><span class="success_text"></span></div>
								</div>
							<!-- /. Match Screenshots -->
							<?php } else { ?>
							<h3>Invalid Match ID</h3>
							<?php } ?>
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
<div id="make-prediction-confirm" title="Make game prediction" style="display:none;">
	<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Confirm your prediction.</p>
</div>