<!-- TEAM SETTINGS -->
<div class="portlet box blue">
<div class="portlet-title">
	<div class="caption">
		<i class="fa fa-clog"></i>Modify Team Settings
	</div>
	<div class="tools">
		<a href="javascript:;" class="collapse">
		</a>
	</div>
</div>
<div class="portlet-body form">
	<form id="teamSettings" method="POST" class="form-horizontal">
	 <input type="hidden" name="form" id="form" value="teamSettings">
	 <input type="hidden" id="team-id" value="<?php echo $profile['guild_id']; ?>">
		<div class="form-body">
			<div class="form-group">
				<label class="col-md-3 control-label">Site Admin</label>
				<div class="col-md-4">
					<select class="form-control" id="team-admin">
						<option>-Choose Site Admin-</option>
						<?php foreach( $members as $member ) { ?>
							<option <?php echo ( $team_settings['admin'] == $member['username'] ? 'selected' : '' ); ?> value="<?php echo $member['username']; ?>">
								<?php echo $member['username']; ?>
							</option>
						<?php } ?>
					</select>
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-3 control-label">Leader</label>
				<div class="col-md-4">
					<select class="form-control" id="team-leader">
						<option>-Choose Leader-</option>
						<?php foreach( $members as $member ) { ?>
							<option <?php echo ( $team_settings['leader'] == $member['username'] ? 'selected' : '' ); ?> value="<?php echo $member['username']; ?>">
								<?php echo $member['username']; ?>
							</option>
						<?php } ?>
					</select>
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-3 control-label">Co-Leader</label>
				<div class="col-md-4">
					<select class="form-control" id="team-coleader">
						<option>-Choose Co-Leader-</option>
						<?php foreach( $members as $member ) { ?>
							<option <?php echo ( $team_settings['coleader'] == $member['username'] ? 'selected' : '' ); ?> value="<?php echo $member['username']; ?>">
								<?php echo $member['username']; ?>
							</option>
						<?php } ?>
					</select>
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-3 control-label">Web Site</label>
				<div class="col-md-4">
					<input class="form-control" id="team-website" value="<?php echo $team_settings['website']; ?>" type="text">
					<span class="help-block">
					ex: http://www.your-team-site.com </span>
				</div>
			</div>
			<div class="form-group">
				<div class="success">
					<span class="success_text"></span>
				</div>
			</div>
		</div>
		<div class="form-actions fluid">
			<div class="col-md-offset-3 col-md-9">
				<button type="submit" class="btn blue">Update Settings</button>
				<button type="button" class="btn default">Cancel</button>
			</div>
		</div>
	</form>
</div>
</div>
<!-- /.Team Settings -->