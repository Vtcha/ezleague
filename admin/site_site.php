<?php include('header.php'); ?>

<?php include('sidebar.php'); ?>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Site Settings</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-8">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-gear"></i> Modify Basic Site Settings
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <ul class="nav nav-pills">
							    <li class="active">
							    	<a data-toggle="tab" href="#site-name">Name</a>
							    </li>
							    <li class="">
							    	<a data-toggle="tab" href="#site-url">URL</a>
							    </li>
							    <li class="">
							    	<a data-toggle="tab" href="#site-contact">Contact E-Mail</a>
							    </li>
							    <li class="">
							    	<a data-toggle="tab" href="#site-about">About Content</a>
							    </li>
							    <li class="">
							    	<a data-toggle="tab" href="#site-logo">Logo</a>
							    </li>
							</ul>
							
							<div class="tab-content">
						<?php 
							$site_settings = $ez->getSiteSettings(); 
						?>		
                                <div class="tab-pane fade active in" id="site-name">
                                    <h4>Web Site Name</h4>
                                     <form method="POST" id="siteSettingsName" name="siteSettingsName">
	                                  <input type="hidden" name="form" value="siteSettingsName" />
	                                	<div class="form-group">
										    <input class="form-control" id="name" name="name" placeholder="Site Name" value="<?php echo $site_settings['name']; ?>" />
										</div>
										<div class="form-group">
											<button class="btn btn-success" type="submit">Save</button>
										</div>
										<div class="success">
					                      <span class="success_text"></span>
					                    </div>
									  </form>
                                </div>
                                <div class="tab-pane fade" id="site-url">
                                    <h4>Web Site URL</h4>
                                     <form method="POST" id="siteSettingsURL" name="siteSettingsURL">
	                                  <input type="hidden" name="form" value="siteSettingsURL" />
	                                	<div class="form-group">
										    <input class="form-control" id="url" name="url" placeholder="ex: http://www.mdloring.com/ezleague" value="<?php echo $site_settings['url']; ?>" />
										</div>
										<div class="form-group">
											<button class="btn btn-success" type="submit">Save</button>
										</div>
										<div class="success">
					                      <span class="success_text"></span>
					                    </div>
									  </form>
                                </div>
                                <div class="tab-pane fade" id="site-contact">
                                    <h4>Web Site Contact E-Mail</h4>
                                     <form method="POST" id="siteSettingsContact" name="siteSettingsContact">
	                                  <input type="hidden" name="form" value="siteSettingsContact" />
	                                	<div class="form-group">
										    <input class="form-control" id="email" name="email" placeholder="ex: you@domain.com" value="<?php echo $site_settings['email']; ?>" />
										</div>
										<div class="form-group">
											<button class="btn btn-success" type="submit">Save</button>
										</div>
										<div class="success">
					                      <span class="success_text"></span>
					                    </div>
									  </form>
                                </div>
                                <div class="tab-pane fade" id="site-about">
                                    <h4>Web Site About Content</h4>
                                     <form method="POST" id="siteSettingsAbout" name="siteSettingsAbout">
	                                  <input type="hidden" name="form" value="siteSettingsAbout" />
	                                	<div class="form-group">
										    <textarea class="ckeditor form-control" id="content" name="content" placeholder="About your site"><?php echo $site_settings['about']; ?></textarea>
										</div>
										<div class="form-group">
											<button class="btn btn-success" type="submit">Save</button>
										</div>
										<div class="success">
					                      <span class="success_text"></span>
					                    </div>
									  </form>
                                </div>
                                <div class="tab-pane fade" id="site-logo">
                                    <h4>Web Site Logo</h4>
                                    <div class="col-lg-8">
                                     <form role="form" id="siteSettingsLogo" name="siteSettingsLogo" action="lib/uploadLogo.php" method="POST">
				                 	   <div class="form-group">
				                        <label>Choose image</label>
				                        <small>extensions: jpg, jpeg, gif, png accepted</small>
				                        <input type="file" name="file">
				                       </div>                 
				                       <div class="form-group">
				                 	    <button type="submit" class="btn btn-primary">Update Logo</button>
				                 	   </div> 
				                 	 </form>
				                 	 <div class="success">
					                   <span class="success_text"></span>
					                 </div>
				                 	</div>
				                 	<div class="col-lg-4">
				                 	 <img src="../img/<?php print $site_settings['logo']; ?>" class="img-responsive" />
				                 	</div>
                                </div>
                            
							</div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->

                </div>
                <!-- /.col-lg-8 -->
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
    <script src="js/jquery.form.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>

    <!-- Page-Level Plugin Scripts - Dashboard -->
    <script src="js/plugins/morris/raphael-2.1.0.min.js"></script>
    <script src="js/plugins/morris/morris.js"></script>

    <!-- SB Admin Scripts - Include with every page -->
    <script src="js/sb-admin.js"></script>
    <script src="js/ezleague.js"></script>
    <script src="js/ckeditor/ckeditor.js"></script>

    <!-- Page-Level Demo Scripts - Dashboard - Use for reference -->
    <script src="js/demo/dashboard-demo.js"></script>

</body>

</html>
