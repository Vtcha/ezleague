<div class="col-md-12">
<h1>Tournament Details</h1>
<?php 
if( isset( $_GET['id'] ) ) { 
	$tournament_id = trim( $_GET['id'] );
	if( is_numeric( $tournament_id ) ) {
		$tournament = $ez_tournament->get_tournament( $tournament_id ); 
?>
		<h2>Tournament Information &amp; Bracket</h2>
		<?php include( 'tpls/tournaments/tournaments-sub-navigation.php' ); ?>
		<div class="row">
			<?php if( $tournament ) { ?>
			<div class="col-md-4">
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
					</table>
				</div>

				<div class="news-blocks">
					<h3 class="title"><?php echo $tournament['tournament']; ?> Registered Teams</h3>
					<?php $tournament_teams = $ez_tournament->get_tournament_teams( $tournament_id ); ?>
					<?php if( $tournament_teams ) { ?>
						<table class="table league-information">
							<tr>
								<th>Team</th>
								<th></th>
							</tr>
							<tbody>
						<?php foreach( $tournament_teams as $team ) { ?>
								<tr>
									<td><?php echo $team['guild']; ?></td>
									<td><a href="view-team.php?id=<?php echo $team['id']; ?>" class="btn btn-info btn-sm"><i class="fa fa-search"></i> View Team</a>
								</tr>
						<?php } ?>
							</tbody>
						</table>
					<?php } else { ?>
						No teams have registered
					<?php } ?>
				</div>
			</div>
			<div class="col-md-8">
				<div class="news-blocks">
					<h3 class="title">Tournament Bracket</h3>
					<?php
                		$max_teams = $tournament['teams'];
		                switch( $max_teams ) {
		                    case 4:
		                        include( 'tpls/tournaments/brackets/view-tournament-bracket-04.php' );
		                        break;
		                    case 8:
		                        include( 'tpls/tournaments/brackets/view-tournament-bracket-08.php' );
		                        break;
		                    case 16:
		                        include( 'tpls/tournaments/brackets/view-tournament-bracket-16.php' );
		                        break;
		                    case 32:
		                        include( 'tpls/tournaments/brackets/view-tournament-bracket-32.php' );
		                        break;
		                    default:
		                        break;
		                }
		                
		            ?>
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