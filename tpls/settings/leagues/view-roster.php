<div class="portlet box blue">
	<div class="portlet-title">
		<div class="caption">
			<i class="fa fa-picture"></i><?php echo $league_details['league']; ?> Team Roster
		</div>
		<div class="tools">
			<a href="javascript:;" class="collapse">
			</a>
		</div>
	</div>
	<div class="portlet-body">
	<div class="row">
		<div class="col-md-4">
	<?php $team_roster = $ez_team->get_full_roster( $profile['guild_id'] ); ?>
			<form id="addLeagueMember" method="POST" role="form">
			 <input type="hidden" id="league-id" value="<?php echo $league_id; ?>" />
			 <input type="hidden" id="team-id" value="<?php echo $profile['guild_id']; ?>" />
			 <input type="hidden" id="roster-id" value="<?php echo $ez_team->get_roster_id( $profile['guild_id'], $league_id ); ?>" />
			 	<div class="col-md-12">
					 <div class="form-group">
					 	<select id="user-id" class="form-control">
					 		<option>- Select Member -</option>
					<?php foreach( $team_roster as $member ) { ?>
							<option value="<?php echo $member['id']; ?>"><?php echo $member['username']; ?></option>	
					<?php } ?>
						</select>
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-primary btn-block">Add Member</button>
					</div>
					<div class="success"><span class="success_text"></span></div>
				</div>
			</form>
		</div>
		<div class="col-md-8">
	<?php $league_roster = $ez_team->get_league_roster( $league_id, $profile['guild_id'] ); ?>
			<div class="table-scrollable">
		<?php if( !empty( $league_roster ) ) { ?>
				<table class="table table-condensed table-hover">
				<thead>
				<tr>
					<th>Username</th>
					<th></th>
				</tr>
				</thead>
				<tbody>
				<?php foreach( $league_roster as $member ) { ?>
				<?php if( $member['username'] != '' ) { ?>
				<tr>
					<td><?php echo $member['username']; ?></td>
					<td>
						<a class="btn btn-danger btn-xs" href="settings-guild.php?page=matches&id=<?php echo $match['id']; ?>"><i class="fa fa-times"></i> Remove User</a>
					</td>
				</tr>
				<?php } ?>
				<?php } ?>
				</tbody>
				</table>
		<?php } else { ?>
			<h3>No league roster members. Please add some</h3>
		<?php } ?>
			</div>
		</div>
	</div>
	</div>
</div>