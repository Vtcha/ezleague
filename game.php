<?php include('header.php'); ?>
<?php 
	if( isset( $_GET['game'])) { 
		$game = trim( $_GET['game'] );
		$data = $ez_frontend->get_game( $game );
		$leagues = $ez_frontend->get_game_leagues( $game );
		$i=0;
?>
		<div class="container">
			<div class="row">
				<div class="title_wrapper">
					<div class="span6">
						<h1><?php echo $data['game']; ?></h1>
					</div>
					<div class="breadcrumbs">
						<strong><a href="index.php">Home</a> / <a href="games.php">Games</a> / <?php echo $data['game']; ?></strong>
					</div>
				</div>
			</div>
		</div>
		<div class="page normal-page container">
			<div class="row">
				<div class="span12">
					<div class="template-wrapper">
						<div class="block block-column_block span8 first cf">
						<?php foreach( $leagues as $league ) { $i++; ?>
							<div class="block block-text_block span4 <?php echo ( $i % 2 != 0 ? 'first' : '' ); ?> cf">
								<div class="title-wrapper">
									<h3 class="widget-title"><?php echo $league['league']; ?></h3>
									<div class="clear"></div>
								</div>
								<div class="wcontainer league-links">
									<a href="#">Results</a>
									<a href="#">Schedule</a>
									<a href="#">Standings</a>
									<a href="teams.php?league=<?php echo $league['id']; ?>">Teams</a>
								</div>
							</div>
						<?php } ?>
						</div>
<?php include('sidebar_game.php'); ?>
						<div class="clear"></div>
					</div>
				</div>
			</div>

		</div>
<?php } else { echo "No game was selected"; } ?>
<?php include('footer.php'); ?>