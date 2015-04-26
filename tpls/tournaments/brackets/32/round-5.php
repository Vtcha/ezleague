<?php $round5 = $ez_tournament->get_tournament_matchups( $tournament_id, '5' ); ?>
<?php $round_map = $ez_tournament->get_round_map( $tournament_id, 5 ); ?>
<?php if( $round5 ) { ?>
		<li class="spacer round-name">Championship<br/><span class="map-name text-info"><?php echo $round_map; ?></span></li>
		<!-- wrap score inside span element -->
		<li class="game game-top <?php echo ( $round5[0]['winner'] == $round5[0]['home_team_id'] ? 'winner' : '' ); ?>"><?php echo $round5[0]['home_team'] . ' - ' . $round5[0]['home_score']; ?></li>
		<li class="game game-spacer"><a href="view-tournaments.php?p=matchup&id=<?php echo $round5[0]['id'];  ?>">View Details</a></li>
		<li class="game game-bottom <?php echo ( $round5[0]['winner'] == $round5[0]['away_team_id'] ? 'winner' : '' ); ?>"><?php echo $round5[0]['away_team'] . ' - ' . $round5[0]['away_score']; ?></li>

		<li class="spacer">&nbsp;</li>
<?php } else { ?>
		<li class="spacer round-name">Championship</li>
				
		<li class="game game-top"></li>
		<li class="game game-spacer">&nbsp;</li>
		<li class="game game-bottom "></li>

		<li class="spacer">&nbsp;</li>
<?php } ?>