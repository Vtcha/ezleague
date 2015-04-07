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
					Tournaments <small>register, compete, game.</small>
					</h3>
					<ul class="page-breadcrumb breadcrumb">
						<li>
							<i class="fa fa-home"></i>
							<a href="index.php">Home</a>
							<i class="fa fa-angle-right"></i>
						</li>
						<li>
							<a href="#">tournaments</a>
							<i class="fa fa-angle-right"></i>
						</li>
						<li>
							<a href="#">Standings</a>
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
						<?php if( isset( $_GET['tournament'] ) && is_numeric( $_GET['tournament'] ) ) { ?>
						<?php 
							$tournament_id = trim( $_GET['tournament'] );
							$tournament = $ez_tournament->get_tournament( $tournament_id );
							$season = $ez_tournament->get_current_season( $tournament_id );
							$current_season = $season['season'];
							if( isset( $_GET['search'] ) ) {
								$search = trim( $_GET['search'] );
								$teams = $ez_team->search_teams( $search );
							} else { 
								$teams = $ez_tournament->get_tournament_teams( $tournament_id );
							} 
						?>
							<h1><?php echo $tournament['game']; ?></h1>
							<h2><?php echo $tournament['tournament']; ?> Standings</h2>
							<div class="row">
							<!-- tournament TEAMS -->
								<div class="col-md-12">
									<div class="news-blocks">
										<h3 class="title">Open Tournaments</h3>
									  <?php $standings = $ez_tournament->get_standings( $tournament_id ); ?>
										<table class="table league-information">
											<tr>
												<th>Game</th>
												<th>Registered Teams</th>
												<th>Max Teams</th>
												<th>Start</th>
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
						<h3>tournament IDs must be integers</h3>
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