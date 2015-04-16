<?php $round2 = $ez_tournament->get_tournament_matchups( $tournament_id, '2' ); ?>
<?php if( $round2 ) { ?>
		<li class="spacer">&nbsp;</li>
		<!-- wrap score inside span element -->
		<li class="game game-top <?php echo ( $round2[0]['winner'] == $round2[0]['home_team_id'] ? 'winner' : '' ); ?>"><?php echo $round2[0]['home_team'] . ' - ' . $round2[0]['home_score']; ?></li>
		<li class="game game-spacer">&nbsp;</li>
		<li class="game game-bottom <?php echo ( $round2[0]['winner'] == $round2[0]['away_team_id'] ? 'winner' : '' ); ?>"><?php echo $round2[0]['away_team'] . ' - ' . $round2[0]['away_score']; ?></li>

		<li class="spacer">&nbsp;</li>
<?php } else { ?>
		<li class="spacer">&nbsp;</li>
				
		<li class="game game-top"></li>
		<li class="game game-spacer">&nbsp;</li>
		<li class="game game-bottom "></li>

		<li class="spacer">&nbsp;</li>
<?php } ?>