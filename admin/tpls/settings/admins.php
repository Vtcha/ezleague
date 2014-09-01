<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Site Admin Users</h1>
    </div>
</div>
<div class="row">
    <div class="col-lg-5">
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-file-o"></i> Create Admin Account
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
                     <form method="POST" id="createAdmin">
                    	<div class="form-group">
						    <label>Username</label>
						    <input type="text" class="form-control" id="admin-username" name="admin-username" value="" autocomplete="off" autocorrect="off"  />
						</div>
						<div class="form-group">
						    <label>E-Mail</label>
						    <input type="text" class="form-control" id="admin-email" name="admin-email" value="" autocomplete="off" autocorrect="off"  />
						</div>
						<div class="form-group">
						    <label>Password</label>
						    <input type="password" class="form-control" id="admin-password" name="admin-password" value="" autocomplete="off" autocorrect="off" />
						</div>
						<div class="form-group">
						    <label>Confirm Password</label>
						    <input type="password" class="form-control" id="admin-confirm" name="admin-confirm" value="" autocomplete="off" autocorrect="off" />
						</div>
						<div class="form-group">
							<button type="submit" class="btn btn-success">Create Account</button>
							<button type="reset" class="btn btn-warning">Reset</button>
						</div>
						<div class="success">
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
                <i class="fa fa-sitemap"></i> Current Admins
            </div>
            <div class="panel-body">
            	<div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Game</th>
                                <th>E-Mail</th>
                                <th>Options</th>
                            </tr>
                        </thead>
            <?php $admins = $ez_settings->get_admins(); ?>
                        <tbody>
              <?php foreach( $admins as $admin ) { ?>
                            <tr>
                                <td><?php echo $admin['username']; ?></td>
                                <td><?php echo $admin['email']; ?></td>
                                <td>
				            		<button <?php echo ( $admin['username'] == 'admin' ? 'disabled' : '' ); ?> type="button" onclick="getUser('<?php echo $admin['id']; ?>')" data-toggle="modal" data-target="#editUserModal" class="btn btn-primary btn-xs">Edit</button>
				            		<button <?php echo ( $admin['username'] == 'admin' ? 'disabled' : '' ); ?> type="button" onclick="deleteAdmin('<?php echo $admin['id']; ?>')" class="btn btn-danger btn-xs">Delete</button>
				            	</td>
                            </tr>
               <?php } ?>
                        </tbody>
                     </table>
                    </div>
            </div>
        </div>
     </div>
  </div>
<div id="editUserModal" class="modal"></div>    