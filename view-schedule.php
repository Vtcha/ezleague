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
							<a href="#">Schedule</a>
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
						<?php if( isset( $_GET['league'] ) && is_numeric( $_GET['league'] ) ) { ?>
						<?php 
							$league_id = trim( $_GET['league'] );
							$league = $ez_league->get_league( $league_id ); 
							$season = $ez_league->get_current_season( $league_id );
							$current_season = $season['season'];
							
							if( isset( $_GET['week'] ) && is_numeric( $_GET['week'] ) ) {
								$week = trim( $_GET['week'] );
								$featured_week = $week;
								$current_schedule = $ez_schedule->get_week_schedule($league_id, $current_season, $week);
							} else {
								$week = 0;
								$featured_week = 'all';
								$current_schedule = $ez_schedule->get_schedule( $league_id, $current_season );
							}
						?>
							<h1><?php echo $league['game']; ?></h1>
							<h2><?php echo $league['league']; ?> Match Schedule</h2>
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
							<!-- FEATURED MATCH -->
								<div class="col-md-4">
									<?php $featured_match = $ez_league->get_featured_match( $featured_week, $league_id ); ?>
									<div class="news-blocks">
										<h3 class="title"><a href="#">Featured Match </a></h3>
									<?php if( $featured_match ) { ?>
									<?php
											if( isset( $profile ) ) { 
												$prediction_check = $ez_league->check_if_predicted( $profile['username'], $featured_match['id'] );
											} else {
												$prediction_check = false;
											}
									?>
										<div class="news-block-tags">
											<strong><?php echo date( 'F d', strtotime( $featured_match['date'] ) ) . ', ' . $featured_match['time'] . '' . $featured_match['zone']; ?></strong>
											<em><?php echo $featured_match['map']; ?></em><br/>
											<strong>Watch</strong> 
											<?php if( isset( $featured_match['stream_url'] ) ) { ?>
												<a href="<?php echo $featured_match['stream_url']; ?>" target="_blank">Stream URL</a>
											<?php } else { ?>
												No Stream URL
											<?php } ?>
										</div>
											<div class="row featured_match">
												<div class="col-md-5">
													<img class="featured_match" src="logos/<?php echo $featured_match['home_logo']; ?>" alt="">
													<h4><?php echo $featured_match['home']; ?></h4>
													<button type="button" 
														<?php 
															if( isset( $profile ) && $prediction_check == false ) { ?>
																onclick="makePrediction('<?php echo $featured_match['home_id']; ?>', '<?php echo $featured_match['id']; ?>', '<?php echo $profile['username']; ?>')"
														<?php } else { ?>
																disabled
														<?php } ?>
															class="btn blue prediction btn-block">
																predict <i class="fa fa-check"></i><br/>(<?php echo $featured_match['predictions']['home_percent']; ?>) 
													</button>
												</div>
												<div class="col-md-2">
													<h4 class="versus">vs</h4>
												</div>
												<div class="col-md-5">
													<img class="featured_match" src="logos/<?php echo $featured_match['away_logo']; ?>" alt="">
													<h4><?php echo $featured_match['away']; ?></h4>
													<button type="button" 
														<?php 
															if( isset( $profile ) && $prediction_check == false ) { ?>
																onclick="makePrediction('<?php echo $featured_match['away_id']; ?>', '<?php echo $featured_match['id']; ?>', '<?php echo $profile['username']; ?>')"
														<?php } else { ?>
																disabled
														<?php } ?>
															class="btn blue prediction btn-block">
																predict <i class="fa fa-check"></i><br/>(<?php echo $featured_match['predictions']['away_percent']; ?>) 
													</button>
												</div>
											</div>
									<?php } else { ?>
										No featured matches
									<?php } ?>
									</div>
								</div>
							<!-- /. Featured Match -->
							<!-- EVENT INFO -->
								<div class="col-md-8">
									<div class="news-blocks">
									  <div class="col-lg-6">
										<h3 class="title"><a href="#">Season <?php echo $current_season; ?> Schedule </a></h3>
									  </div>
									  <div class="col-lg-6">
										   <form class="form-inline pull-right" id="getSchedule" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="GET">
										    <input type="hidden" name="league" value="<?php echo $league_id; ?>" />
										        <div class="form-group">
										            <select name="week" class="form-control">
										                <option value="all">All Matches</option>
										        <?php for ($i=1; $i<=$league['games']; $i++) { ?>
										            <?php if( isset( $_GET['week'] ) ) { ?>
										                <option <?php echo ( $_GET['week'] == $i ? 'selected' : '' ); ?> value="<?php echo $i; ?>">Week <?php echo $i; ?></option>
										            <?php } else { ?>
										                <option value="<?php echo $i; ?>">Week <?php echo $i; ?></option>
										            <?php } ?>      
										        <?php } ?>
										            </select>
										        </div>
										        <button type="submit" class="btn btn-success">Get Schedule</button>
										    </form>
										</div>
										<table class="table league-information">
											<tr>
												<th>Week</th>
												<th>Home Team</th>
												<th>Away Team</th>
												<th>Map</th>
												<th>Match Date</th>
												<th></th>
											</tr>
											<tbody>
									<?php foreach( $current_schedule as $matchup ) { ?>
									            <tr>
									             <td><strong><?php echo $matchup['week']; ?></strong></td>
									             <td>
									             	<a href="view-team.php?id=<?php echo $matchup['home_id']; ?>">
									             		<?php echo $matchup['home_team']; ?>
									             	</a>
									             </td>
									             <td>
									             	<a href="view-team.php?id=<?php echo $matchup['away_id']; ?>">
									             		<?php echo $matchup['away_team']; ?>
									             	</a>
									             </td>
									             <td><?php echo $matchup['map']; ?></td>
									             <td>
									             	<?php 
									             		if( $matchup['match_date'] != '' ) { 		
									             			echo date( 'F d, Y', strtotime( $matchup['match_date'] ) );
									             		} else {
									             			echo 'Not Set';
									             		} 
									             	?>
									             </td>
									             <td>
									             <?php if( $matchup['completed'] == 1 ) { ?>
									                <a href="view-result.php?league=<?php echo $league_id; ?>&id=<?php echo $matchup['id']; ?>" class="btn btn-info btn-xs"><i class="fa fa-search"></i> Result</a>
									             <?php } else { ?>
									             	<a href="view-match.php?league=<?php echo $league_id; ?>&id=<?php echo $matchup['id']; ?>" class="btn btn-primary btn-xs"><i class="fa fa-search"></i> Details</a>
									         	<?php } ?>
									             </td>
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