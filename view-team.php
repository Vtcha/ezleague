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
					Teams <small>create, join, compete.</small>
					</h3>
					<ul class="page-breadcrumb breadcrumb">
						<li>
							<i class="fa fa-home"></i>
							<a href="index.php">Home</a>
							<i class="fa fa-angle-right"></i>
						</li>
						<li>
							<a href="#">Teams</a>
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
							$team_id = trim( $_GET['id'] );
							$team = $ez_team->get_team( $team_id );
						?>
							<h1>View Team</h1>
							<h2><?php echo $team['team']; ?> &ndash; Profile</h2>
							<div class="row">
							<!-- TEAM INFO -->
								<div class="col-md-6">
									<div class="success"><span class="success_text"></span></div>
									<div class="news-blocks">
										<h3 class="title"><a href="#">Team Information </a></h3>
										<table class="table league-information">
											<tr>
												<th>Leader</th>
												<td><?php echo ( $team['leader'] == '-Choose Leader-' ? '' : $team['leader'] ); ?></td>
											</tr>
											<tr>
												<th>Co-Leader</th>
												<td><?php echo ( $team['coleader'] == '-Choose Co-Leader-' ? '' : $team['coleader'] ); ?></td>
											</tr>
											<tr>
												<th>Admin</th>
												<td><?php echo $team['admin']; ?></td>
											</tr>
											<tr>
												<th>Web Site</th>
												<td><?php echo ( $team['website'] == '' ? 'Not Listed' : '<a href=' . $team['website'] . ' target="_blank">' . $team['website'] . '</a>' ); ?></td>
											</tr>
											<tr>
												<th>Abbreviation</th>
												<td><?php echo $team['abbrev']; ?></td>
											</tr>
											<tr>
												<th>Leagues</th>
												<td>
													<?php 
														$team_leagues = explode( ',', $team['leagues'] );
														if( $team_leagues ) {
															foreach( $team_leagues as $league_id ) {
																$league_details = $ez_league->get_league( $league_id );
																echo '<a href="view-league.php?id=' . $league_id . '" target="_blank">' . $league_details['league'] . '</a><br>';
															}
														}
													 ?>
												</td>
											</tr>
										</table>
									</div>
								</div>
							<!-- /. Event Info -->
							
							<!-- FEATURED MATCH -->
								<div class="col-md-6">
									<div class="news-blocks">
										<h3 class="title"><a href="#">Team Details </a></h3>
										<div class="row featured_match">
											<div class="col-md-6">
												<table class="table league-information">
													<thead>
														<tr>
															<th>Username</th>
															<th></th>
														</tr>
													</thead>
													<tbody>
													<?php $team_members = $ez_team->get_team_members( $team_id ); ?>
													<?php foreach( $team_members as $member ) { ?>
														<tr>
															<th><?php echo $member['username']; ?></th>
															<td><a class="label label-sm label-success" href="view-member.php?id=<?php echo $member['id']; ?>">View </a></td>
														</tr>
													<?php } ?>
													</tbody>
												</table>
											</div>
											<div class="col-md-6">
												<img src="logos/<?php echo ( $team['logo'] == '' ? 'team-logo.png' : $team['logo'] ); ?>" class="view-team-logo">
											</div>
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