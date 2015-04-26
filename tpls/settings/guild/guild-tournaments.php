<!-- TEAM MEMBERS -->
<div class="portlet box blue">
	<div class="portlet-title">
		<div class="caption">
			<i class="fa fa-picture"></i>Participating Tournaments
		</div>
		<div class="tools">
			<a href="javascript:;" class="collapse">
			</a>
		</div>
	</div>
	<div class="portlet-body">
	<?php $team_tournaments = $ez_team->get_team_tournaments( $profile['guild_id'] ); ?>
		<div class="table-scrollable">
			<table class="table table-condensed table-hover">
			<thead>
			<tr>
				<th>Tournament</th>
				<th>Game</th>
				<th>Max Teams</th>
				<th>Status</th>
				<th></th>
			</tr>
			</thead>
			<tbody>
			<?php foreach( $team_tournaments as $tournament ) { ?>
			<tr>
				<td><?php echo $tournament['tournament']; ?></td>
				<td><?php echo $tournament['game']; ?></td>
				<td><?php echo $tournament['teams']; ?></td>
				<td><?php echo ( $tournament['status'] == '1' ? '<span class="text-success bolder">Running</span>' : '<span class="text-danger">Season Over</span>' ); ?></td>
				<td>
				<?php if( $tournament['status'] == '1' ) { ?>
					<a class="btn blue btn-xs" href="settings-guild.php?page=tournaments&id=<?php echo $tournament['tournament_id']; ?>&view=schedule">View Schedule</a>
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