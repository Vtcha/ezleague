<!-- USER PROFILE -->
<div class="portlet box blue">
<div class="portlet-title">
	<div class="caption">
		<i class="fa fa-clog"></i>Update User Profile
	</div>
	<div class="tools">
		<a href="javascript:;" class="collapse">
		</a>
	</div>
</div>
<div class="portlet-body form">
	<form id="userProfile" method="POST" class="form-horizontal">
	 <input type="hidden" id="user-id" value="<?php echo $profile['id']; ?>">
		<div class="form-body">
			<div class="form-group">
				<label class="col-md-3 control-label">First Name</label>
				<div class="col-md-4">
					<input class="form-control" id="user-first-name" value="<?php echo $profile['first']; ?>" type="text" autocomplete="off">
					<div class="error first">
						<span class="error_text first"></span>
					</div>
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-3 control-label">Last Name</label>
				<div class="col-md-4">
					<input class="form-control" id="user-last-name" value="<?php echo $profile['last']; ?>" type="text" autocomplete="off">
					<div class="error last">
						<span class="error_text last"></span>
					</div>
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-3 control-label">E-Mail</label>
				<div class="col-md-4">
					<input class="form-control" id="user-email" value="<?php echo $profile['email']; ?>" type="text" autocomplete="off">
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-3 control-label">Web Site</label>
				<div class="col-md-4">
					<input class="form-control" id="user-website" value="<?php echo $profile['website']; ?>" type="text" autocomplete="off">
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-3 control-label">Bio</label>
				<div class="col-md-6">
					<textarea class="form-control" id="user-bio"><?php echo $profile['bio']; ?></textarea>
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-3 control-label">Hobbies</label>
				<div class="col-md-4">
					<input class="form-control" id="user-hobbies" value="<?php echo $profile['hobbies']; ?>" type="text" autocomplete="off">
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-3 control-label">Occupation</label>
				<div class="col-md-4">
					<input class="form-control" id="user-occupation" value="<?php echo $profile['occupation']; ?>" type="text" autocomplete="off">
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-3 control-label">Location</label>
				<div class="col-md-4">
					<input class="form-control" id="user-from" value="<?php echo $profile['location']; ?>" type="text" autocomplete="off">
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-3 control-label">Forum Signature</label>
				<div class="col-md-6">
					<textarea class="form-control" id="user-signature"><?php echo html_entity_decode($profile['signature']); ?></textarea>
				</div>
				<span class="help-block">
					HTML allowed </span>
			</div>
			<div class="form-group">
				<div class="success">
					<span class="success_text"></span>
				</div>
			</div>
		</div>
		<div class="form-actions fluid">
			<div class="col-md-offset-3 col-md-9">
				<button type="submit" class="btn blue">Update Profile</button>
				<button type="button" class="btn default">Cancel</button>
			</div>
		</div>
	</form>
</div>
</div>
<!-- /.User Profile -->