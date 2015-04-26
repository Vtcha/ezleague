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
								<a href="#">Rules</a>
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
						<?php $league_id = trim( $_GET['league'] ); ?>
						<?php $league = $ez_league->get_league( $league_id ); ?>
							<h1><?php echo $league['game']; ?></h1>
							<h2><?php echo $league['league']; ?> Rules</h2>
							<div class="row">
								
								<div class="col-md-3">
									<div class="top-news">
										<a href="view-standings.php?league=<?php echo $league_id; ?>" class="btn red">
											<span>Standings </span>
											<i class="fa fa-trophy top-news-icon"></i>
										</a>
									</div>
								</div>
								<div class="col-md-3">
									<div class="top-news">
										<a href="view-schedule.php?league=<?php echo $league_id; ?>" class="btn green">
											<span>Schedule </span>
											<i class="fa fa-calendar top-news-icon"></i>
										</a>
									</div>
								</div>
								<div class="col-md-3">
									<div class="top-news">
										<a href="view-results.php?league=<?php echo $league_id; ?>" class="btn blue">
										<span>Results </span>
										<i class="fa fa-gamepad top-news-icon"></i>
										</a>
									</div>
								</div>
								<div class="col-md-3">
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
								<div class="col-md-12">
									<div class="news-blocks">
										<h3 class="title"><a href="#">League Rules </a></h3>
											<div class="rules">
												<?php $rules = $ez_league->get_rules( $league_id ); ?>
												<?php echo $rules['rules']; ?>
											</div>
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
			<?php include( 'tpls/system/bottom-leaderboard.php' ); ?>
		</div>
	</div>
	<!-- END CONTENT -->
</div>
<!-- END CONTAINER -->
<?php include('footer.php'); ?>