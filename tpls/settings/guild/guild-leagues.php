<!-- TEAM MEMBERS -->
<div class="portlet box blue">
	<div class="portlet-title">
		<div class="caption">
			<i class="fa fa-picture"></i>Participating Leagues
		</div>
		<div class="tools">
			<a href="javascript:;" class="collapse">
			</a>
		</div>
	</div>
	<div class="portlet-body">
	<?php $team_leagues = $ez_team->get_team_leagues( $profile['guild_id'] ); ?>
		<div class="table-scrollable">
			<table class="table table-condensed table-hover">
			<thead>
			<tr>
				<th>League</th>
				<th>Start</th>
				<th>Status</th>
				<th>Rosters</th>
				<th></th>
			</tr>
			</thead>
			<tbody>
			<?php foreach( $team_leagues as $league ) { ?>
			<tr>
				<td><?php echo $league['league']; ?></td>
				<td><?php echo $league['start']; ?></td>
				<td><?php echo ( $league['status'] == '1' ? '<span class="text-success bolder">Running</span>' : '<span class="text-danger">Season Over</span>' ); ?></td>
				<td><?php echo ( $league['rosters'] == '1' ? '<span class="text-success bolder">Unlocked</span>' : '<span class="text-danger">Locked</span>' ); ?></td>
				<td>
				<?php if( $league['status'] == '1' ) { ?>
					<a class="btn blue btn-xs" href="settings-guild.php?page=leagues&id=<?php echo $league['league_id']; ?>&view=schedule">View Schedule</a>
					<a class="btn btn-primary btn-xs" href="settings-guild.php?page=leagues&id=<?php echo $league['league_id']; ?>&view=roster">View Roster</a>
				<?php } ?>
				</td>
			</tr>
			<?php } ?>
			</tbody>
			</table>
			
			<div class="success"><span class="success_text"></span></div>
		</div>
	</div>
</div>
<!-- /.TEAM MEMBERS -->