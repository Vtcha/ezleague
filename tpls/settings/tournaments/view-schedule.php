<div class="portlet box blue">
	<div class="portlet-title">
		<div class="caption">
			<i class="fa fa-picture"></i><?php echo $tournament_details['tournament']; ?> Match Schedule
		</div>
		<div class="tools">
			<a href="javascript:;" class="collapse">
			</a>
		</div>
	</div>
	<div class="portlet-body">
	<?php $matches = $ez_team->get_team_tournament_matches( $tournament_id, $profile['guild_id'] ); ?>
		<div class="table-scrollable">
			<table class="table table-condensed table-hover">
			<thead>
			<tr>
				<th>Round</th>
				<th>Home Team</th>
				<th>Away Team</th>
				<th></th>
			</tr>
			</thead>
			<tbody>
			<?php foreach( $matches as $match ) { ?>
				<?php 
					$home_team = $ez_team->get_team_name( $match['home_team_id'] );
					$away_team = $ez_team->get_team_name( $match['away_team_id'] );
				?>
			<tr <?php if( $match['completed'] == '1' ) { ?> style="text-decoration:line-through;" <?php } ?>>
				<td>Round <?php echo $match['round']; ?></td>
				<td <?php echo ( $match['home_team_id'] == $profile['guild_id'] ? 'class="text-success bolder"' : '' ); ?>>
					<?php echo ( $match['winner'] == $match['home_team_id'] ? '<span class="text-primary">' . $home_team['team'] . '</span>' : $home_team['team'] ); ?>
					(<?php echo $match['home_score']; ?>)
				</td>
				<td <?php echo ( $match['away_team_id'] == $profile['guild_id'] ? 'class="text-success bolder"' : '' ); ?>>
					<?php echo ( $match['winner'] == $match['away_team_id'] ? '<span class="text-primary">' . $away_team['team'] . '</span>' : $away_team['team'] ); ?>
					(<?php echo $match['away_score']; ?>)
				</td>
				<td>
					<a class="btn blue btn-xs" href="settings-guild.php?page=tournament_match&view=details&mid=<?php echo $match['id']; ?>">View Details</a>
				</td>
			</tr>
			<?php } ?>
			</tbody>
			</table>
			
			<div class="success"><span class="success_text"></span></div>
		</div>
	</div>
</div>