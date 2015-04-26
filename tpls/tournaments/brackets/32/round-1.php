<?php $round1 = $ez_tournament->get_tournament_matchups( $tournament_id, '1' ); ?>
<?php $round_map = $ez_tournament->get_round_map( $tournament_id, 1 ); ?>
<?php if( $round1 ) { ?>
		<li class="spacer round-name">Round 1<br/><span class="map-name text-info"><?php echo $round_map; ?></span></li>
		<!-- wrap score inside span element -->
		<li class="game game-top <?php echo ( $round1[0]['winner'] == $round1[0]['home_team_id'] ? 'winner' : '' ); ?>"><?php echo $round1[0]['home_team'] . ' - ' . $round1[0]['home_score']; ?></li>
		<li class="game game-spacer"><a href="view-tournaments.php?p=matchup&id=<?php echo $round1[0]['id'];  ?>">View Details</a></li>
		<li class="game game-bottom <?php echo ( $round1[0]['winner'] == $round1[0]['away_team_id'] ? 'winner' : '' ); ?>"><?php echo $round1[0]['away_team'] . ' - ' . $round1[0]['away_score']; ?></li>

		<li class="spacer">&nbsp;</li>
		
		<li class="game game-top <?php echo ( $round1[9]['winner'] == $round1[9]['home_team_id'] ? 'winner' : '' ); ?>"><?php echo $round1[9]['home_team'] . ' - ' . $round1[9]['home_score']; ?></li>
		<li class="game game-spacer"><a href="view-tournaments.php?p=matchup&id=<?php echo $round1[9]['id']; ?>">View Details</a></li>
		<li class="game game-bottom <?php echo ( $round1[9]['winner'] == $round1[9]['away_team_id'] ? 'winner' : '' ); ?>"><?php echo $round1[9]['away_team'] . ' - ' . $round1[9]['away_score']; ?></li>

		<li class="spacer">&nbsp;</li>
		
		<li class="game game-top <?php echo ( $round1[2]['winner'] == $round1[2]['home_team_id'] ? 'winner' : '' ); ?>"><?php echo $round1[2]['home_team'] . ' - ' . $round1[2]['home_score']; ?></li>
		<li class="game game-spacer"><a href="view-tournaments.php?p=matchup&id=<?php echo $round1[2]['id']; ?>">View Details</a></li>
		<li class="game game-bottom <?php echo ( $round1[2]['winner'] == $round1[2]['away_team_id'] ? 'winner' : '' ); ?>"><?php echo $round1[2]['away_team'] . ' - ' . $round1[2]['away_score']; ?></li>

		<li class="spacer">&nbsp;</li>
		
		<li class="game game-top <?php echo ( $round1[3]['winner'] == $round1[3]['home_team_id'] ? 'winner' : '' ); ?>"><?php echo $round1[3]['home_team'] . ' - ' . $round1[3]['home_score']; ?></li>
		<li class="game game-spacer"><a href="view-tournaments.php?p=matchup&id=<?php echo $round1[3]['id']; ?>">View Details</a></li>
		<li class="game game-bottom <?php echo ( $round1[3]['winner'] == $round1[3]['away_team_id'] ? 'winner' : '' ); ?>"><?php echo $round1[3]['away_team'] . ' - ' . $round1[3]['away_score']; ?></li>

		<li class="spacer">&nbsp;</li>

		<li class="game game-top <?php echo ( $round1[4]['winner'] == $round1[4]['home_team_id'] ? 'winner' : '' ); ?>"><?php echo $round1[4]['home_team'] . ' - ' . $round1[4]['home_score']; ?></li>
		<li class="game game-spacer"><a href="view-tournaments.php?p=matchup&id=<?php echo $round1[4]['id']; ?>">View Details</a></li>
		<li class="game game-bottom <?php echo ( $round1[4]['winner'] == $round1[4]['away_team_id'] ? 'winner' : '' ); ?>"><?php echo $round1[4]['away_team'] . ' - ' . $round1[4]['away_score']; ?></li>

		<li class="spacer">&nbsp;</li>
		
		<li class="game game-top <?php echo ( $round1[5]['winner'] == $round1[5]['home_team_id'] ? 'winner' : '' ); ?>"><?php echo $round1[5]['home_team'] . ' - ' . $round1[5]['home_score']; ?></li>
		<li class="game game-spacer"><a href="view-tournaments.php?p=matchup&id=<?php echo $round1[5]['id']; ?>">View Details</a></li>
		<li class="game game-bottom <?php echo ( $round1[5]['winner'] == $round1[5]['away_team_id'] ? 'winner' : '' ); ?>"><?php echo $round1[5]['away_team'] . ' - ' . $round1[5]['away_score']; ?></li>

		<li class="spacer">&nbsp;</li>
		
		<li class="game game-top <?php echo ( $round1[6]['winner'] == $round1[6]['home_team_id'] ? 'winner' : '' ); ?>"><?php echo $round1[6]['home_team'] . ' - ' . $round1[6]['home_score']; ?></li>
		<li class="game game-spacer"><a href="view-tournaments.php?p=matchup&id=<?php echo $round1[6]['id']; ?>">View Details</a></li>
		<li class="game game-bottom <?php echo ( $round1[6]['winner'] == $round1[6]['away_team_id'] ? 'winner' : '' ); ?>"><?php echo $round1[6]['away_team'] . ' - ' . $round1[6]['away_score']; ?></li>

		<li class="spacer">&nbsp;</li>
		
		<li class="game game-top <?php echo ( $round1[7]['winner'] == $round1[7]['home_team_id'] ? 'winner' : '' ); ?>"><?php echo $round1[7]['home_team'] . ' - ' . $round1[7]['home_score']; ?></li>
		<li class="game game-spacer"><a href="view-tournaments.php?p=matchup&id=<?php echo $round1[7]['id']; ?>">View Details</a></li>
		<li class="game game-bottom <?php echo ( $round1[7]['winner'] == $round1[7]['away_team_id'] ? 'winner' : '' ); ?>"><?php echo $round1[7]['away_team'] . ' - ' . $round1[7]['away_score']; ?></li>

		<li class="spacer">&nbsp;</li>

		<li class="game game-top <?php echo ( $round1[8]['winner'] == $round1[8]['home_team_id'] ? 'winner' : '' ); ?>"><?php echo $round1[8]['home_team'] . ' - ' . $round1[8]['home_score']; ?></li>
		<li class="game game-spacer"><a href="view-tournaments.php?p=matchup&id=<?php echo $round1[8]['id'];  ?>">View Details</a></li>
		<li class="game game-bottom <?php echo ( $round1[8]['winner'] == $round1[8]['away_team_id'] ? 'winner' : '' ); ?>"><?php echo $round1[8]['away_team'] . ' - ' . $round1[8]['away_score']; ?></li>

		<li class="spacer">&nbsp;</li>
		
		<li class="game game-top <?php echo ( $round1[9]['winner'] == $round1[9]['home_team_id'] ? 'winner' : '' ); ?>"><?php echo $round1[9]['home_team'] . ' - ' . $round1[9]['home_score']; ?></li>
		<li class="game game-spacer"><a href="view-tournaments.php?p=matchup&id=<?php echo $round1[9]['id']; ?>">View Details</a></li>
		<li class="game game-bottom <?php echo ( $round1[9]['winner'] == $round1[9]['away_team_id'] ? 'winner' : '' ); ?>"><?php echo $round1[9]['away_team'] . ' - ' . $round1[9]['away_score']; ?></li>

		<li class="spacer">&nbsp;</li>
		
		<li class="game game-top <?php echo ( $round1[10]['winner'] == $round1[10]['home_team_id'] ? 'winner' : '' ); ?>"><?php echo $round1[10]['home_team'] . ' - ' . $round1[10]['home_score']; ?></li>
		<li class="game game-spacer"><a href="view-tournaments.php?p=matchup&id=<?php echo $round1[10]['id']; ?>">View Details</a></li>
		<li class="game game-bottom <?php echo ( $round1[10]['winner'] == $round1[10]['away_team_id'] ? 'winner' : '' ); ?>"><?php echo $round1[10]['away_team'] . ' - ' . $round1[10]['away_score']; ?></li>

		<li class="spacer">&nbsp;</li>
		
		<li class="game game-top <?php echo ( $round1[11]['winner'] == $round1[11]['home_team_id'] ? 'winner' : '' ); ?>"><?php echo $round1[11]['home_team'] . ' - ' . $round1[11]['home_score']; ?></li>
		<li class="game game-spacer"><a href="view-tournaments.php?p=matchup&id=<?php echo $round1[11]['id']; ?>">View Details</a></li>
		<li class="game game-bottom <?php echo ( $round1[11]['winner'] == $round1[11]['away_team_id'] ? 'winner' : '' ); ?>"><?php echo $round1[11]['away_team'] . ' - ' . $round1[11]['away_score']; ?></li>

		<li class="spacer">&nbsp;</li>

		<li class="game game-top <?php echo ( $round1[12]['winner'] == $round1[12]['home_team_id'] ? 'winner' : '' ); ?>"><?php echo $round1[12]['home_team'] . ' - ' . $round1[12]['home_score']; ?></li>
		<li class="game game-spacer"><a href="view-tournaments.php?p=matchup&id=<?php echo $round1[12]['id']; ?>">View Details</a></li>
		<li class="game game-bottom <?php echo ( $round1[12]['winner'] == $round1[12]['away_team_id'] ? 'winner' : '' ); ?>"><?php echo $round1[12]['away_team'] . ' - ' . $round1[12]['away_score']; ?></li>

		<li class="spacer">&nbsp;</li>
		
		<li class="game game-top <?php echo ( $round1[13]['winner'] == $round1[13]['home_team_id'] ? 'winner' : '' ); ?>"><?php echo $round1[13]['home_team'] . ' - ' . $round1[13]['home_score']; ?></li>
		<li class="game game-spacer"><a href="view-tournaments.php?p=matchup&id=<?php echo $round1[13]['id']; ?>">View Details</a></li>
		<li class="game game-bottom <?php echo ( $round1[13]['winner'] == $round1[13]['away_team_id'] ? 'winner' : '' ); ?>"><?php echo $round1[13]['away_team'] . ' - ' . $round1[13]['away_score']; ?></li>

		<li class="spacer">&nbsp;</li>
		
		<li class="game game-top <?php echo ( $round1[14]['winner'] == $round1[14]['home_team_id'] ? 'winner' : '' ); ?>"><?php echo $round1[14]['home_team'] . ' - ' . $round1[14]['home_score']; ?></li>
		<li class="game game-spacer"><a href="view-tournaments.php?p=matchup&id=<?php echo $round1[14]['id']; ?>">View Details</a></li>
		<li class="game game-bottom <?php echo ( $round1[14]['winner'] == $round1[14]['away_team_id'] ? 'winner' : '' ); ?>"><?php echo $round1[14]['away_team'] . ' - ' . $round1[14]['away_score']; ?></li>

		<li class="spacer">&nbsp;</li>
		
		<li class="game game-top <?php echo ( $round1[15]['winner'] == $round1[15]['home_team_id'] ? 'winner' : '' ); ?>"><?php echo $round1[15]['home_team'] . ' - ' . $round1[15]['home_score']; ?></li>
		<li class="game game-spacer"><a href="view-tournaments.php?p=matchup&id=<?php echo $round1[15]['id']; ?>">View Details</a></li>
		<li class="game game-bottom <?php echo ( $round1[15]['winner'] == $round1[15]['away_team_id'] ? 'winner' : '' ); ?>"><?php echo $round1[15]['away_team'] . ' - ' . $round1[15]['away_score']; ?></li>

		<li class="spacer">&nbsp;</li>
<?php } else { ?>
		<?php $round_map = $ez_tournament->get_round_map( $tournament_id, 1 ); ?>
		<li class="spacer round-name">Round 1<br/><span class="map-name text-info"><?php echo $round_map; ?></span></li>
		<!-- wrap score inside span element -->
		<li class="game game-top"></li>
		<li class="game game-spacer">&nbsp;</li>
		<li class="game game-bottom "></li>

		<li class="spacer">&nbsp;</li>
		
		<li class="game game-top"></li>
		<li class="game game-spacer">&nbsp;</li>
		<li class="game game-bottom "></li>

		<li class="spacer">&nbsp;</li>
		
		<li class="game game-top "></li>
		<li class="game game-spacer">&nbsp;</li>
		<li class="game game-bottom"></li>

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
		
		<li class="game game-top "></li>
		<li class="game game-spacer">&nbsp;</li>
		<li class="game game-bottom"></li>

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
		
		<li class="game game-top "></li>
		<li class="game game-spacer">&nbsp;</li>
		<li class="game game-bottom"></li>

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
		
		<li class="game game-top "></li>
		<li class="game game-spacer">&nbsp;</li>
		<li class="game game-bottom"></li>

		<li class="spacer">&nbsp;</li>
		
		<li class="game game-top"></li>
		<li class="game game-spacer">&nbsp;</li>
		<li class="game game-bottom "></li>

		<li class="spacer">&nbsp;</li>
<?php } ?>