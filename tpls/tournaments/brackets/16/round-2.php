<?php $round2 = $ez_tournament->get_tournament_matchups( $tournament_id, '2' ); ?>
<?php $round_map = $ez_tournament->get_round_map( $tournament_id, 2 ); ?>
<?php if( $round2 ) { ?>
		<li class="spacer round-name">Round 2<br/><span class="map-name text-info"><?php echo $round_map; ?></span></li>
		<!-- wrap score inside span element -->
		<li class="game game-top <?php echo ( $round2[0]['winner'] == $round2[0]['home_team_id'] ? 'winner' : '' ); ?>"><?php echo $round2[0]['home_team'] . ' - ' . $round2[0]['home_score']; ?></li>
		<li class="game game-spacer"><a href="view-tournaments.php?p=matchup&id=<?php echo $round2[0]['id'];  ?>">View Details</a></li>
		<li class="game game-bottom <?php echo ( $round2[0]['winner'] == $round2[0]['away_team_id'] ? 'winner' : '' ); ?>"><?php echo $round2[0]['away_team'] . ' - ' . $round2[0]['away_score']; ?></li>

		<li class="spacer">&nbsp;</li>
		
		<li class="game game-top <?php echo ( $round2[1]['winner'] == $round2[1]['home_team_id'] ? 'winner' : '' ); ?>"><?php echo $round2[1]['home_team'] . ' - ' . $round2[1]['home_score']; ?></li>
		<li class="game game-spacer"><a href="view-tournaments.php?p=matchup&id=<?php echo $round2[1]['id'];  ?>">View Details</a></li>
		<li class="game game-bottom <?php echo ( $round2[1]['winner'] == $round2[1]['away_team_id'] ? 'winner' : '' ); ?>"><?php echo $round2[1]['away_team'] . ' - ' . $round2[1]['away_score']; ?></li>

		<li class="spacer">&nbsp;</li>

		<li class="game game-top <?php echo ( $round2[2]['winner'] == $round2[2]['home_team_id'] ? 'winner' : '' ); ?>"><?php echo $round2[2]['home_team'] . ' - ' . $round2[2]['home_score']; ?></li>
		<li class="game game-spacer"><a href="view-tournaments.php?p=matchup&id=<?php echo $round2[2]['id'];  ?>">View Details</a></li>
		<li class="game game-bottom <?php echo ( $round2[2]['winner'] == $round2[2]['away_team_id'] ? 'winner' : '' ); ?>"><?php echo $round2[2]['away_team'] . ' - ' . $round2[2]['away_score']; ?></li>

		<li class="spacer">&nbsp;</li>
		
		<li class="game game-top <?php echo ( $round2[3]['winner'] == $round2[3]['home_team_id'] ? 'winner' : '' ); ?>"><?php echo $round2[3]['home_team'] . ' - ' . $round2[3]['home_score']; ?></li>
		<li class="game game-spacer"><a href="view-tournaments.php?p=matchup&id=<?php echo $round2[3]['id'];  ?>">View Details</a></li>
		<li class="game game-bottom <?php echo ( $round2[3]['winner'] == $round2[3]['away_team_id'] ? 'winner' : '' ); ?>"><?php echo $round2[3]['away_team'] . ' - ' . $round2[3]['away_score']; ?></li>

		<li class="spacer">&nbsp;</li>
<?php } else { ?>
		<?php $round_map = $ez_tournament->get_round_map( $tournament_id, 2 ); ?>
		<li class="spacer round-name">Round 2<br/><span class="map-name text-info"><?php echo $round_map; ?></span></li>
				
		<li class="game game-top"></li>
		<li class="game game-spacer">&nbsp;</li>
		<li class="game game-bottom "></li>

		<li class="spacer">&nbsp;</li>

		<li class="game game-top"></li>
		<li class="game game-spacer">&nbsp;</li>
		<li class="game game-bottom "></li>

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