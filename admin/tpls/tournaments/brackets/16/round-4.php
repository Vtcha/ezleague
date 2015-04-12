<?php $round4 = $ez_tournament->get_tournament_matchups( $tournament_id, '4' ); ?>
<?php if( $round4 ) { ?>
		<li class="spacer">&nbsp;</li>
		<!-- wrap score inside span element -->
		<li class="game game-top <?php echo ( $round4[0]['winner'] == $round4[0]['home_team_id'] ? 'winner' : '' ); ?>"><?php echo $round4[0]['home_team'] . ' - ' . $round4[0]['home_score']; ?></li>
		<li class="game game-spacer"><a href="tournament-match.php?id=<?php echo $round4[0]['id']; ?>">Edit Match</a></li>
		<li class="game game-bottom <?php echo ( $round4[0]['winner'] == $round4[0]['away_team_id'] ? 'winner' : '' ); ?>"><?php echo $round4[0]['away_team'] . ' - ' . $round4[0]['away_score']; ?></li>

		<li class="spacer">&nbsp;</li>
<?php } else { ?>
		<li class="spacer">&nbsp;</li>
				
		<li class="game game-top"></li>
		<li class="game game-spacer">&nbsp;</li>
		<li class="game game-bottom "></li>

		<li class="spacer">&nbsp;</li>
<?php } ?>