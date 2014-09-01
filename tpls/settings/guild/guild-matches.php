<!-- TEAM MEMBERS -->
<div class="portlet box blue">
	<div class="portlet-title">
		<div class="caption">
			<i class="fa fa-picture"></i>Team Match Schedule
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
				<th>Week</th>
				<th></th>
				<th>Rank</th>
				<th></th>
			</tr>
			</thead>
			<tbody>
			<?php foreach( $members as $member ) { ?>
			<tr>
				<td><?php echo $member['id']; ?></td>
				<td><?php echo $member['username']; ?></td>
				<td><?php echo $member['email']; ?></td>
				<td>
					<?php if( $team_settings['leader'] == $member['username'] ) { ?>
					<span class="label label-sm label-success">
					Leader </span>
					<?php } elseif( $team_settings['coleader'] == $member['username'] ) { ?>
					<span class="label label-sm label-primary">
					Co-Leader </span>
					<?php } else { ?>
					<span class="label label-sm label-default">
					Member </span>
					<?php } ?>
				</td>
				<td>
					<button class="btn btn-danger btn-xs" onclick="javascript:kickMember('<?php echo $member['username']; ?>');">Kick</button>
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