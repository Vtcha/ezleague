<?php $round2 = $ez_tournament->get_tournament_matchups( $tournament_id, '2' ); ?>
<?php if( $round2 ) { ?>
		<li class="spacer">&nbsp;</li>
				
		<li class="game game-top"></li>
		<li class="game game-spacer">&nbsp;</li>
		<li class="game game-bottom "></li>

		<li class="spacer">&nbsp;</li>
<?php } else { ?>
		<li class="spacer">&nbsp;</li>
				
		<li class="game game-top"></li>
		<li class="game game-spacer">&nbsp;</li>
		<li class="game game-bottom "></li>

		<li class="spacer">&nbsp;</li>
<?php } ?>