<div class="portlet box blue">
	<div class="portlet-title">
		<div class="caption">
			<i class="fa fa-picture"></i><?php echo $league_details['league']; ?> Match Schedule
		</div>
		<div class="tools">
			<a href="javascript:;" class="collapse">
			</a>
		</div>
	</div>
	<div class="portlet-body">
	<?php $matches = $ez_team->get_team_schedule( $profile['guild_id'], $league_id ); ?>
		<div class="table-scrollable">
			<table class="table table-condensed table-hover">
			<thead>
			<tr>
				<th>Week</th>
				<th>Home Team</th>
				<th>Away Team</th>
				<th></th>
			</tr>
			</thead>
			<tbody>
			<?php foreach( $matches as $match ) { ?>
			<tr <?php if( $match['completed'] == '1' ) { ?> class="strikehout" <?php } ?>>
				<td>Week <?php echo $match['week']; ?></td>
				<td <?php echo ( $match['homeTeamID'] == $profile['guild_id'] ? 'class="text-success bolder"' : '' ); ?>>
					<?php echo $match['homeTeam']; ?>
				</td>
				<td <?php echo ( $match['awayTeamID'] == $profile['guild_id'] ? 'class="text-success bolder"' : '' ); ?>>
					<?php echo $match['awayTeam']; ?>
				</td>
				<td>
					<a class="btn blue btn-xs" href="settings-guild.php?page=match&view=details&mid=<?php echo $match['id']; ?>">View Details</a>
				</td>
			</tr>
			<?php } ?>
			</tbody>
			</table>
			
			<div class="success"><span class="success_text"></span></div>
		</div>
	</div>
</div>