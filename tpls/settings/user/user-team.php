<!-- USER TEAM SETTINGS -->
<div class="portlet box blue">
<div class="portlet-title">
	<div class="caption">
		<i class="fa fa-clog"></i>View Team Information
	</div>
	<div class="tools">
		<a href="javascript:;" class="collapse">
		</a>
	</div>
</div>
<div class="portlet-body form">
	<form id="userTeam" method="POST" class="form-horizontal">
		<div class="form-body">
		<?php if( $profile['guild_id'] != '' ) { ?>
			<div class="form-group">
				<label class="col-md-3 control-label">Current Team</label>
				<div class="col-md-4">
					<span class="form-control-static">
						<a href="view-guild.php?id=<?php echo $profile['guild_id']; ?>">
							<?php echo $ez_frontend->get_guild_name( $profile['guild_id'] ); ?>
						</a>
					</span>
					<a onclick="leaveTeam('<?php echo $profile['id']; ?>')" class="btn red btn-sm pull-right leave-team">Leave Team</a>
				</div>
			</div>
		<?php } else { ?>
			<div class="form-group">
				<label class="col-md-3 control-label">Team Invites</label>
				<div class="col-md-8">
				<?php $invites = $ez_users->get_team_invites( $profile['id'] ); ?>
				<?php if( count( $invites ) > 0 ) { ?>
				<div class="table-scrollable">
					<table class="table table-hover">
						<thead>
							<tr>
								<th>Guild</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
						<?php foreach( $invites as $invite ) { ?>
							<tr>
								<td><h4><a href="view-team.php?id=<?php echo $invite['id']; ?>"><?php echo $invite['team']; ?></a></h4></td>
								<td>
									<a href="#" onclick="acceptTeamInvite('<?php echo $invite['id']; ?>', '<?php echo $profile['id']; ?>')" class="btn btn-success btn-sm">Accept</a>
								</td>
							</tr>
						<?php } ?>
						</tbody>
					</table>
				</div>
				<?php } else { ?>
				<h3>Sorry, you have no team invites</h3>
				<?php } ?>
				</div>
			<?php } ?>
			</div>
			</form>
			<div class="form-group">
				<div class="success">
					<span class="success_text"></span>
				</div>
			</div>
		</div>
</div>
</div>
<!-- /.User Team -->