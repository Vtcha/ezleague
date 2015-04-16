<?php $round3 = $ez_tournament->get_tournament_matchups( $tournament_id, '3' ); ?>
<?php if( $round3 ) { ?>
		<li class="spacer">&nbsp;</li>
		<!-- wrap score inside span element -->
		<li class="game game-top <?php echo ( $round3[0]['winner'] == $round3[0]['home_team_id'] ? 'winner' : '' ); ?>"><?php echo $round3[0]['home_team'] . ' - ' . $round3[0]['home_score']; ?></li>
		<li class="game game-spacer">&nbsp;</li>
		<li class="game game-bottom <?php echo ( $round3[0]['winner'] == $round3[0]['away_team_id'] ? 'winner' : '' ); ?>"><?php echo $round3[0]['away_team'] . ' - ' . $round3[0]['away_score']; ?></li>

		<li class="spacer">&nbsp;</li>
		
		<li class="game game-top <?php echo ( $round3[1]['winner'] == $round3[1]['home_team_id'] ? 'winner' : '' ); ?>"><?php echo $round3[1]['home_team'] . ' - ' . $round3[1]['home_score']; ?></li>
		<li class="game game-spacer">&nbsp;</li>
		<li class="game game-bottom <?php echo ( $round3[1]['winner'] == $round3[1]['away_team_id'] ? 'winner' : '' ); ?>"><?php echo $round3[1]['away_team'] . ' - ' . $round3[1]['away_score']; ?></li>

		<li class="spacer">&nbsp;</li>
<?php } else { ?>
		<li class="spacer">&nbsp;</li>
				
		<li class="game game-top"></li>
		<li class="game game-spacer">&nbsp;</li>
		<li class="game game-bottom "></li>

		<li class="spacer">&nbsp;</li>

		<li class="game game-top"></li>
		<li class="game game-spacer">&nbsp;</li>
		<li class="game game-bottom "></li>

		<li class="spacer">&nbsp;</li>
<?php } ?>