<div class="col-md-12">
<h1>Tournament Rules</h1>
<?php 
if( isset( $_GET['id'] ) ) { 
	$tournament_id = trim( $_GET['id'] );
	if( is_numeric( $tournament_id ) ) {
		$tournament = $ez_tournament->get_tournament( $tournament_id ); 
?>
		<h2>Current Private Tournaments</h2>
		<?php include( 'tpls/tournaments/tournaments-sub-navigation.php' ); ?>
		<div class="row">
			<?php if( $tournament ) { ?>
			<div class="col-md-6">
				<div class="news-blocks">
					<h3 class="title"><?php echo $tournament['tournament']; ?></h3>
					<table class="table league-information">
					<?php 
						$total_registered = $ez_tournament->get_total_teams( $tournament['id'] );
						$game 	= $ez_frontend->get_game( $tournament['game'] );
					?>
						<tr>
							<th>Game</th>
							<td><?php echo $game['game']; ?></td>
						</tr>
						<tr>
							<th>Tournament</th>
							<td>
								<em><?php echo $tournament['tournament']; ?></em>
								<?php echo ( $tournament['teams'] == $total_registered ? '<span class="label label-danger">FULL</span>' : '' ); ?>
							</td>
						</tr>
						<tr>
							<th>Format</th>
							<td><?php echo $tournament['format']; ?></td>
						</tr>
						<tr>
							<th># Team Registered</th>
							<td><?php echo $total_registered; ?></td>
						</tr>
						<tr>
							<th>Max Teams</th>
							<td><?php echo $tournament['teams']; ?></td>
						</tr>
						<tr>
							<th>Bracket</th>
							<td><a href="view-tournaments.php?p=bracket&id=<?php echo $tournament_id; ?>" class="btn btn-primary btn-sm"><i class="fa fa-search"></i> View Bracket</a></td>						
					</table>
				</div>
			</div>
			<div class="col-md-6">
				<div class="news-blocks">
					<h3 class="title"><?php echo $tournament['tournament']; ?> Rules</h3>
				<?php echo $tournament['rules']; ?>
				</div>
			</div>
			<?php } else { ?>
				Sorry, there is no tournament with that id
			<?php } ?>
		</div>
<?php
	} else {
		echo 'Sorry, <em>tournament ids</em> must be numeric';
	}
} else {
	echo 'No <em>tournament id</em> was given';
}
?>