<?php include('header.php'); ?>

<?php include('sidebar.php'); ?>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Add Forum</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-file-o"></i> Create New Forum Section
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                 <form method="POST" id="addNewForum" name="addNewForum">
                                  <input type="hidden" name="form" value="addNewForum" />
                                	<div class="form-group">
									    <label>Section</label>
									    <input class="form-control" id="forumName" name="forumName" placeholder="Section Name" />
									</div>
									<div class="form-group">
										<label>Type</label>
										<select class="form-control" name="forumType" id="forumType">
											<option></option>
											<option value="public">Public</option>
											<option value="team">Guild</option>
										</select>
									</div>
									<div class="form-group">
										<button class="btn btn-success" type="submit">Create Section</button>
									</div>
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
                <div class="col-lg-8">
                	<div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-sitemap"></i> Current Forum Sections
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                        	<div class="table-responsive">
                                <table class="table table-hover current_leagues">
                                    <thead>
                                        <tr>
                                            <th>Forum</th>
                                            <th>Type</th>
                                            <th>Options</th>
                                        </tr>
                                    </thead>
                        <?php $sections = $ez->getForumSections(); ?>
                                    <tbody>
                          <?php foreach($sections as $section) { ?>
                                        <tr>
                                            <td><?php print $section['section_name']; ?></td>
                                            <td><?php print $section['type']; ?></td>
                                            <td>
                                              <?php if($section['status'] == 'enabled') { ?>
							            		<button type="button" onclick="updateForum('<?php echo $section['id']; ?>', 'disabled')" class="btn btn-danger btn-xs">Disable</button>
							            	  <?php } else { ?>	
							            		<button type="button" onclick="updateForum('<?php echo $section['id']; ?>', 'enabled')" class="btn btn-success btn-xs">Enable</button>
							            	  <?php } ?>
							            	</td>
                                        </tr>
                           <?php } ?>
                                    </tbody>
                                 </table>
                                    <!-- /.table-responsive -->
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

    <!-- Core Scripts - Include with every page -->
    <script src="js/jquery-1.10.2.js"></script>
    <script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
    <link rel="stylesheet" href="css/redmond/jquery-ui-1.10.4.custom.min.css" />
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
