<div class="col-md-3">
	<ul class="ver-inline-menu tabbable margin-bottom-10">
		<li>
			<a href="settings-guild.php">
			<i class="fa fa-cog"></i> Back to Settings </a>
			<span class="after">
			</span>
		</li>
<?php if( $_GET['page'] == 'leagues' || $_GET['page'] == 'match' ) { ?>
		<li>
			<a href="settings-guild.php?page=leagues&id=<?php echo $league_id; ?>&view=schedule">
			<i class="fa fa-calendar"></i> Match Schedule </a>
		</li>
		<li>
			<a href="settings-guild.php?page=leagues&id=<?php echo $league_id; ?>&view=roster">
			<i class="fa fa-users"></i> Roster </a>
		</li>
<?php } elseif( $_GET['page'] == 'tournaments' || $_GET['page'] == 'tournament_match' ) { ?>
		<li>
			<a href="settings-guild.php?page=tournaments&id=<?php echo $tournament_id; ?>&view=schedule">
			<i class="fa fa-calendar"></i> Match Schedule </a>
		</li>
<?php } ?>
	</ul>
</div>
