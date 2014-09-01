<!-- TEAM SETTINGS -->
<div class="portlet box blue">
<div class="portlet-title">
	<div class="caption">
		<i class="fa fa-clog"></i>Update User Password
	</div>
	<div class="tools">
		<a href="javascript:;" class="collapse">
		</a>
	</div>
</div>
<div class="portlet-body form">
	<form id="userPassword" method="POST" class="form-horizontal">
		<div class="form-body">
			<div class="form-group">
				<label class="col-md-3 control-label">New Password</label>
				<div class="col-md-4">
					<input class="form-control" id="user-password" type="password" autocomplete="off">
					<div class="error password">
						<span class="error_text password"></span>
					</div>
					<span class="help-block">
					must be at least 6 characters </span>
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-3 control-label">Confirm Password</label>
				<div class="col-md-4">
					<input class="form-control" id="user-confirm" type="password" autocomplete="off">
					<div class="error confirm">
						<span class="error_text confirm"></span>
					</div>
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
				<button type="submit" class="btn blue">Change Password</button>
				<button type="button" class="btn default">Cancel</button>
			</div>
		</div>
	</form>
</div>
</div>
<!-- /.Team Settings -->