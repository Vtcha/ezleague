<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Site Profile Settings</h1>
    </div>
</div>
<div class="row">
    <div class="col-lg-5">
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-cogs"></i> Update Profile Settings
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
                     <form method="POST" id="updateEmail">
                      <input type="hidden" id="user-id" value="<?php echo $user_settings['id']; ?>" />
						<div class="form-group">
						    <label>E-Mail</label>
						    <input type="text" class="form-control" id="admin-email" name="admin-email" value="<?php echo $user_settings['email']; ?>"  />
						</div>
						<div class="form-group">
							<button type="submit" class="btn btn-success">Update E-Mail</button>
							<button type="reset" class="btn btn-warning">Reset</button>
						</div>
						<div class="success success-email">
	                      <span class="success_text"></span>
	                    </div>
					  </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-7">
    	<div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-lock"></i> Update Profile Password
            </div>
            <div class="panel-body">
            	<form method="POST" id="updatePassword">
            	 <input type="hidden" id="user-id" value="<?php echo $user_settings['id']; ?>" />
				    <div class="form-group">
				        <label>Password</label>
				        <input type="password" class="form-control" id="admin-password" name="admin-password" value="" autocomplete="off" autocorrect="off" />
				    </div>
				    <div class="form-group">
				        <label>Confirm Password</label>
				        <input type="password" class="form-control" id="admin-confirm" name="admin-confirm" value="" autocomplete="off" autocorrect="off" />
				    </div>
				    <div class="form-group">
				        <button type="submit" class="btn btn-success">Update Password</button>
				        <button type="reset" class="btn btn-warning">Reset</button>
				    </div>
				    <div class="success password">
				      <span class="success_text"></span>
				    </div>
				</form>
            </div>
        </div>
     </div>
  </div>