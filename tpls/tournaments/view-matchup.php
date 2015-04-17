<?php $match_id = $tournament_id; ?>
<?php $match_result = $ez_tournament->get_tournament_match( $match_id ); ?>
<?php if( $match_result ) { ?>
<?php $screenshots = $ez_league->get_screenshots( $match_id ); ?>
<!-- MATCHUP -->
	<div class="col-md-6">
		<div class="news-blocks">
			<h3 class="title">Matchup</h3>
				<div class="row match_result">
					<div class="col-md-5">
						<a href="view-team.php?id=<?php echo $match_result['home_id']; ?>">
							<img class="featured_match" src="logos/<?php echo $ez_team->get_logo( $match_result['home_id'] ); ?>" alt="">
						</a>
						<h4><a href="view-team.php?id=<?php echo $match_result['home_id']; ?>"><?php echo $match_result['home']; ?></a></h4>
						<a href="#" class="btn <?php echo ( $match_result['winner'] == $match_result['home_id'] ? 'green' : 'red' ); ?> result btn-xs">
							<?php echo $match_result['home_score']; ?> <i class="fa <?php echo ( $match_result['winner'] == $match_result['home_id'] ? 'fa-check' : 'fa-times' ); ?>"></i>
						</a>
					</div>
					<div class="col-md-2">
						<h4 class="versus">vs</h4>
					</div>
					<div class="col-md-5">
						<a href="view-team.php?id=<?php echo $match_result['away_id']; ?>">
							<img class="featured_match" src="logos/<?php echo $ez_team->get_logo( $match_result['away_id'] ); ?>" alt="">
						</a>
						<h4><a href="view-team.php?id=<?php echo $match_result['away_id']; ?>"><?php echo $match_result['away']; ?></a></h4>
						<a href="#" class="btn <?php echo ( $match_result['winner'] == $match_result['away_id'] ? 'green' : 'red' ); ?> result btn-xs">
							<?php echo $match_result['away_score']; ?> <i class="fa <?php echo ( $match_result['winner'] == $match_result['away_id'] ? 'fa-check' : 'fa-times' ); ?>"></i>
						</a>
					</div>
				</div>
		</div>
	</div>
<!-- /. Matchup -->
<!-- MATCH DETAILS -->
	<div class="col-md-6">
		<div class="news-blocks">
			<h3 class="title">Match Details</h3>
			<table class="table league-information">
				<tr>
					<th>Date</th>
					<td><?php echo date( 'F d, Y', strtotime( $match_result['date'] ) ); ?></td>
				</tr>
				<tr>
					<th>Time</th>
					<td><?php echo $match_result['time'];?> <?php echo $match_result['zone']; ?></td>
				</tr>
				<tr>
					<th>Home Score</th>
					<td><?php echo $match_result['home_score']; ?></td>
				</tr>
				<tr>
					<th>Away Score</th>
					<td><?php echo $match_result['away_score']; ?></td>
				</tr>
				<tr>
					<th>Map</th>
					<td>de_dust2</td>
				</tr>
				<tr>
					<th>Watch</th>
					<td><?php if( $match_result['stream_url'] != '' ) { ?>
							<a href="<?php echo $match_result['stream_url']; ?>" target="_blank">Stream URL</a>
						<?php } else { ?>
							Stream URL Not Set
						<?php } ?>
					</td>
				</tr>
			</table>
		</div>
	</div>
<!-- /. Match Details -->
<?php } else { ?>
<h3>Invalid Match ID</h3>
<?php } ?>