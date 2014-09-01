<?php include('header.php'); ?>
<!-- BEGIN CONTAINER -->
<div class="page-container">
	<?php include('navbar.php'); ?>
	<!-- BEGIN CONTENT -->
	<div class="page-content-wrapper">
		<div class="page-content">
			<div class="row">
				<div class="col-md-12">
					<!-- BEGIN PAGE TITLE & BREADCRUMB-->
					<h3 class="page-title">
					Welcome <small>create, manage, game.</small>
					</h3>
					<ul class="page-breadcrumb breadcrumb">
						<li>
							<i class="fa fa-home"></i>
							<a href="index.php">Home</a>
							<i class="fa fa-angle-right"></i>
						</li>
						<li>
							<a href="#">News</a>
						</li>
					</ul>
					<!-- END PAGE TITLE & BREADCRUMB-->
				</div>
			</div>
			<!-- END PAGE HEADER-->
			<!-- BEGIN PAGE CONTENT-->
			<div class="row">
				<div class="col-md-12">
					<div class="row">
						<div class="col-md-9 col-sm-8 article-block">
							<div class="portlet box blue">
								<div class="portlet-title">
									<div class="caption">
										<i class="fa fa-users"></i>Create New Team
									</div>
									<div class="tools">
										<a href="javascript:;" class="collapse">
										</a>
									</div>
								</div>
								<div class="portlet-body form">
									<!-- BEGIN FORM-->
									<form id="createTeam" method="POST" class="form-horizontal">
									 <input type="hidden" id="team-admin" value="<?php echo $_SESSION['ez_username']; ?>">
										<div class="form-body">
											<div class="form-group">
												<label class="col-md-3 control-label">Team Name</label>
												<div class="col-md-4">
													<input class="form-control" name="team_name" id="team-name" type="text">
													<div class="error name">
														<span class="error_text name"></span>
													</div>
													<span class="help-block">
													must be 3-30 characters </span>
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-3 control-label">Abbreviation</label>
												<div class="col-md-4">
													<input class="form-control" id="team-abbreviation" type="text">
													<div class="error abbr">
														<span class="error_text abbr"></span>
													</div>
													<span class="help-block">
													must be 3-5 characters </span>
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-3 control-label">Web Site</label>
												<div class="col-md-4">
													<input class="form-control" id="team-website" type="text">
													<span class="help-block">
													ex: http://www.your-team-site.com </span>
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-3 control-label">Join Password</label>
												<div class="col-md-4">
													<input class="form-control" id="team-password" type="password">
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
													<input class="form-control" id="team-confirm" type="password">
													<div class="error confirm">
														<span class="error_text confirm"></span>
													</div>
												</div>
											</div>
											<div class="form-group last">
												<label class="col-md-3 control-label">Notes</label>
												<div class="col-md-4">
													<span class="form-control-static">
													* you will be marked as the team admin * </span>
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
												<button type="submit" class="btn blue">Create Team</button>
												<button type="button" class="btn default">Cancel</button>
											</div>
										</div>
									</form>
									<!-- END FORM-->
								</div>
							</div>
						</div>
						<!--end col-md-9-->
						<?php include('sidebar.php'); ?>
					</div>
				</div>
			</div>
			<!-- END PAGE CONTENT-->
		</div>
	</div>
	<!-- END CONTENT -->
</div>
<!-- END CONTAINER -->
<?php include('footer.php'); ?>
<script src="assets/global/scripts/teams.js"></script>