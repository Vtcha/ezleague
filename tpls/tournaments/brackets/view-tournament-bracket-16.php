<main id="tournament">
	<ul class="round round-1">
		<?php include( '16/round-1.php' ); ?>
	</ul>
	<ul class="round round-2">
		<?php include( '16/round-2.php' ); ?>
	</ul>
	<ul class="round round-3">
		<?php include( '16/round-3.php' ); ?>
	</ul>
	<ul class="round round-4">
		<?php include( '16/round-4.php' ); ?>
	</ul>
	<ul class="round round-5">
	<?php if( $round4 && $round4[0]['winner'] != 0 ) { ?>
		<?php $champion = $ez_tournament->get_tournament_champion( $tournament_id ); ?>
		<li class="champion-spacer">&nbsp;</li>
		<li class="game game-top champion-team"><?php echo $champion['guild']; ?></li>
		<li class="game spacer champion">Tournament Champion</li>
	<?php } else { ?>
		<li class="spacer">&nbsp;</li>
		<li class="game game-top"></li>
		<li class="game spacer champion">Tournament Champion</li>
	<?php }	?>
	</ul>
</main>