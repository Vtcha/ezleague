<?php include('header.php'); ?>

<?php include('sidebar.php'); ?>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Site Admin Users</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-user"></i> Create Admin User
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                 <form role="form" id="ezLeagueAdmin" name="ezLeagueAdmin" method="POST">
		                            <fieldset>
		                            	<div class="form-group">
		                                  <label>Username</label>
		                                    <input class="form-control" id="admin-username" name="username" type="text">
		                                </div>
		                                <div class="form-group">
		                                  <label>E-Mail Address</label>
		                                    <input class="form-control" id="admin-email" name="email" type="text">
		                                </div>
		                                <div class="form-group">
		                                  <label>Password</label>
		                                    <input class="form-control" id="admin-password" name="password" type="password">
		                                </div>
		                                
		                                <div class="form-group">
		                                  <label>Confirm Password</label>
		                                    <input class="form-control" id="admin-confirm" name="confirm" type="password">
		                                </div>
		                                <!-- Change this to a button or input when using this as a form -->
		                                <button type="submit" class="btn btn-lg btn-success btn-block">Create Account</button>
		                                <div class="success">
						                  <span class="success_text"></span>
						                </div>
		                            </fieldset>
		                         </form>
                                    <!-- /.table-responsive -->
                                </div>
                                <!-- /.col-lg-4 (nested) -->
                            </div>
                            <!-- /.row -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->

                </div>
                <!-- /.col-lg-8 -->
                <div class="col-lg-8">
                	<div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-users"></i> Current Admins
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                              <div class="table-responsive">
                    			<table class="table table-hover recent_teams">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Username</th>
                                            <th>E-Mail</th>
                                            <th>Options</th>
                                        </tr>
                                    </thead>
                        <?php $admins = $ez->getAdmins(); ?>
                                    <tbody>
									 <?php foreach($admins as $admin) { ?>
										<tr>
										 <td><?php print $admin['id']; ?></td>
										 <td><?php print $admin['username']; ?></td>
										 <td><?php print $admin['email']; ?></td>
										 <td>
										  <a href="#" onclick="getUser('<?php print $admin['id']; ?>');" data-toggle="modal" data-target="#editUserModal" class="btn btn-success btn-xs">Edit</a>
										 </td>
										</tr>	 
									 <?php } ?>
                           			</tbody>
                          	 	</table>
                          	  </div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->

                    
                 </div>
                    <!-- /.panel .chat-panel -->
                </div>
                <!-- /.col-lg-4 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
    
    <div id="editUserModal" class="modal">
  
	</div>

    <!-- Core Scripts - Include with every page -->
    <script src="js/jquery-1.10.2.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>

    <!-- Page-Level Plugin Scripts - Dashboard -->
    <script src="js/plugins/morris/raphael-2.1.0.min.js"></script>
    <script src="js/plugins/morris/morris.js"></script>

    <!-- SB Admin Scripts - Include with every page -->
    <script src="js/sb-admin.js"></script>
    <script src="js/ezleague.js"></script>

    <!-- Page-Level Demo Scripts - Dashboard - Use for reference -->
    <script src="js/demo/dashboard-demo.js"></script>

</body>

</html>
