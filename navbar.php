<!-- BEGIN SIDEBAR -->
	<div class="page-sidebar-wrapper">
		<!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
		<!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
		<div class="page-sidebar navbar-collapse collapse">
			<!-- BEGIN SIDEBAR MENU -->
			<ul class="page-sidebar-menu" data-auto-scroll="true" data-slide-speed="200">
				<!-- DOC: To remove the sidebar toggler from the sidebar you just need to completely remove the below "sidebar-toggler-wrapper" LI element -->
				<li class="sidebar-toggler-wrapper">
					<!-- BEGIN SIDEBAR TOGGLER BUTTON -->
					<div class="sidebar-toggler">
					</div>
					<!-- END SIDEBAR TOGGLER BUTTON -->
				</li>
				<li class="start ">
					<a href="index.php">
					<i class="fa fa-home"></i>
					<span class="title">Dashboard</span>
					</a>
				</li>
				<?php $games = $ez_frontend->get_games(); ?>
				<?php foreach( $games as $game ) { ?>
				<li>
					<a href="javascript:;">
				<?php if( $game['logo'] != '' ) { ?>
					<img src="logos/<?php echo $game['logo']; ?>" class="game-icon" />
				<?php } else { ?>
					<i class="fa fa-gamepad"></i>
				<?php } ?>
					<span class="title"><?php echo $game['game']; ?></span>
					<span class="arrow "></span>
					</a>
					<ul class="sub-menu">
					<?php $leagues = $ez_frontend->get_game_leagues( $game['slug'] ); ?>
					<?php if( $leagues ) { ?>
					<?php foreach( $leagues as $league ) { ?>
						<li>
							<a href="view-league.php?id=<?php echo $league['id']; ?>">
							<?php echo $league['league']; ?></a>
						</li>
					<?php } ?>
					<?php } else { ?>
						<li><span class="no-leagues">No Leagues Found</span></li>
					<?php } ?>
					</ul>
				</li>
				<?php } ?>
				<li class="last "></li>
			</ul>
			<!-- END SIDEBAR MENU -->
		</div>
	</div>
	<!-- END SIDEBAR -->