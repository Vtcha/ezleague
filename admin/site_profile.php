<?php include('header.php'); ?>

<?php include('sidebar.php'); ?>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Site User Profile</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
             <?php $settings = $ez->getUserSettings($username); ?>
                <div class="col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-user"></i> Change Password
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                 <form role="form" id="ezLeagueNewPassword" name="ezLeagueNewPassword" method="POST">
		                         <input type="hidden" name="user_id" id="user_id" value="<?php print $settings['id']; ?>" />
		                            <fieldset>
		                                <div class="form-group">
							              <h5>Password</h5>
							              <input id="new-password" class="form-control password placeholder" placeholder="Password" name="new-password" autocomplete="off" type="password">
							            </div>
							            <div class="form-group">
							              <h5>Confirm</h5>
							              <input id="new-confirm" class="form-control password placeholder" placeholder="Password" name="new-confirm" autocomplete="off" type="password">
							            </div>
		                                <!-- Change this to a button or input when using this as a form -->
		                                <button type="submit" class="btn btn-lg btn-primary btn-sm">Change Password</button>
		                            </fieldset>
		                            <div class="success">
		                             <span class="success_text"></span>
		                            </div>
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
                <div class="col-lg-6">
                	<div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-users"></i> Change E-Mail
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                                <form role="form" id="ezLeagueNewEmail" name="ezLeagueNewEmail" method="POST">
		                         <input type="hidden" name="user_id" id="user_id" value="<?php print $settings['id']; ?>" />
		                            <fieldset>
		                                <div class="form-group">
							              <h5>New E-Mail</h5>
							              <input id="new-email" value="<?php print $settings['email']; ?>" class="form-control password placeholder" name="new-email" autocomplete="off" type="text">
							            </div>
		                                <!-- Change this to a button or input when using this as a form -->
		                                <button type="submit" class="btn btn-lg btn-primary btn-sm">Change E-Mail</button>
		                            </fieldset>
		                        </form>
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
