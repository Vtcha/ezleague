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
							<a href="#">Results</a>
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
								$results = $ez_league->get_results( $league_id, $week );
							} else { 
								$results = $ez_league->get_results( $league_id, 'all' );
							} 
						?>
							<h1><?php echo $league['game']; ?></h1>
							<h2><?php echo $league['league']; ?> Match Results</h2>
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
									  <div class="col-lg-6">
										<h3 class="title">Season <?php echo $current_season; ?> Match Results</h3>
									  </div>
									  <div class="col-lg-6">
										   <form class="form-inline pull-right" id="teamSearch" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="GET">
										    <input type="hidden" name="league" value="<?php echo $league_id; ?>" />
										        <div class="form-group">
										            <select name="week" class="form-control">
										            	<option value="all">All Weeks</option>
										      <?php for ($i=1; $i<=$league['games']; $i++) { ?>
										            <?php if( isset( $_GET['week'] ) ) { ?>
										                <option <?php echo ( $_GET['week'] == $i ? 'selected' : '' ); ?> value="<?php echo $i; ?>">Week <?php echo $i; ?></option>
										            <?php } else { ?>
										                <option value="<?php echo $i; ?>">Week <?php echo $i; ?></option>
										            <?php } ?>      
										      <?php } ?>
										            </select>
										        </div>
										        <button type="submit" class="btn btn-success">Get Results</button>
										    </form>
										</div>
										<table class="table league-information">
											<tr>
												<th>Week</th>
												<th>Home Team</th>
												<th>Away Team</th>
												<th>Score</th>
												<th>Map</th>
												<th></th>
											</tr>
											<tbody>
									<?php foreach( $results as $result ) { ?>
									            <tr>
									             <td><?php echo $result['week']; ?></td>
									             <td><?php echo $result['home']; ?></td>
									             <td><?php echo $result['away']; ?></td>
									             <td><?php echo $result['home_score'] . "-" . $result['away_score']; ?></td>
									             <td><?php echo $result['map']; ?></td>
									             <td><a href="view-result.php?league=<?php echo $league_id; ?>&id=<?php echo $result['id']; ?>" class="btn btn-primary btn-sm"><i class="fa fa-search"></i> View Details</a>
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