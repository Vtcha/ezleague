<!-- Sidebar -->
<div class="block span4 cf">
	<div>
		<!-- START RECENT MATCHES -->
		<div class="widget">
			<div class="title-wrapper">
				<h3 class="widget-title">Latest matches</h3>
				<div class="clear"></div>
			</div>
			<div class="wcontainer">
				<ul class="clanwar-list">
					<li>
						<ul class="tabs">
							<li class="selected">
								<a href="#all" title="All">All</a>
								<div class="clear"></div>
							</li>
							<?php foreach( $games as $game ) { ?>
							<li>
								<a href="<?php echo "#" . $game['slug']; ?>" title="<?php echo $game['game']; ?>"><?php echo $game['short_name']; ?></a>
								<div class="clear"></div>
							</li>
							<?php } ?>
						</ul>
						<div class="clear"></div>
					</li>
					<li class="clanwar-item">
						<a href="#" title="Pro league semifinal">
							<div class="wrap">
								<div class="upcoming">Upcoming</div>
								<div class="match-wrap">
									<img src="./img/defaults/25x25.jpg" class="clan1img">
									<!--<div class="home-team"></div>-->
									<span class="vs">vs.</span>
									<div class="opponent-team">
										Aliance
									</div>
									<div class="clear"></div>
								</div>
								<div class="date">CS:GO - March 1, 2015, 9:12 pm</div>
								<div class="clear"></div>
							</div>
						</a>
					</li>
					<li class="clanwar-item alt counter-strike">
						<a href="#" title="Snipers only 5v5">
							<div class="wrap">
								<div class="scores draw">0:0</div>
								<div class="match-wrap">
									<img src="./img/defaults/25x25.jpg" class="clan1img">
									<!--<div class="home-team"></div>-->
									<span class="vs">vs.</span>
									<div class="opponent-team">
										SK Gaming
									</div>
									<div class="clear"></div>
								</div>
								<div class="date">BF4 - February 15, 2014, 11:10 pm</div>
								<div class="clear"></div>
							</div>
						</a>
					</li>
				</ul>
			</div>
		</div>
		<!-- END RECENT -->
		<!-- UPCOMING MATCHES -->
		<div class="widget">
			<div class="title-wrapper">
				<h3 class="widget-title">Upcoming matches</h3>
				<div class="clear"></div>
			</div>
			<div class="wcontainer">
				<ul class="clanwar-list">
					<li>
						<ul class="tabs">
							<li class="selected">
								<a href="#all" title="All">All</a>
								<div class="clear"></div>
							</li>
							<?php foreach( $games as $game ) { ?>
							<li>
								<a href="<?php echo "#" . $game['slug']; ?>" title="<?php echo $game['game']; ?>"><?php echo $game['short_name']; ?></a>
								<div class="clear"></div>
							</li>
							<?php } ?>
						</ul>
						<div class="clear"></div>
					</li>
					<li class="clanwar-item">
						<a href="#" title="Pro league semifinal">
							<div class="wrap">
								<div class="upcoming">Upcoming</div>
								<div class="match-wrap">
									<img src="./img/defaults/25x25.jpg" class="clan1img">
									<!--<div class="home-team"></div>-->
									<span class="vs">vs.</span>
									<div class="opponent-team">
										Aliance
									</div>
									<div class="clear"></div>
								</div>
								<div class="date">CS:GO - March 1, 2015, 9:12 pm</div>
								<div class="clear"></div>
							</div>
						</a>
					</li>
					<li class="clanwar-item alt counter-strike">
						<a href="#" title="Snipers only 5v5">
							<div class="wrap">
								<div class="scores draw">0:0</div>
								<div class="match-wrap">
									<img src="./img/defaults/25x25.jpg" class="clan1img">
									<!--<div class="home-team"></div>-->
									<span class="vs">vs.</span>
									<div class="opponent-team">
										SK Gaming
									</div>
									<div class="clear"></div>
								</div>
								<div class="date">BF4 - February 15, 2014, 11:10 pm</div>
								<div class="clear"></div>
							</div>
						</a>
					</li>
				</ul>
			</div>
		</div>
		<!-- END UPCOMING -->
	</div>
	<!-- Sidebar -->
				</div>
			</div>
		</div>
	</div>
</div>