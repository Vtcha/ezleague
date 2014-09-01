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
					My Settings <small>profile, password, teams.</small>
					</h3>
					<ul class="page-breadcrumb breadcrumb">
						<li>
							<i class="fa fa-home"></i>
							<a href="index.php">Home</a>
							<i class="fa fa-angle-right"></i>
						</li>
						<li>
							<a href="#">My Profile</a>
						</li>
					</ul>
					<!-- END PAGE TITLE & BREADCRUMB-->
				</div>
			</div>
			<!-- END PAGE HEADER-->
			<!-- BEGIN PAGE CONTENT-->
			<div class="row">
				<div class="col-md-12 blog-page">
					<div class="tab-pane" id="tab_1_3">
						<div class="row profile-account">
						<?php if( isset( $_SESSION['ez_username'] ) ) { ?>
							<div class="col-md-3">
								<ul class="ver-inline-menu tabbable margin-bottom-10">
									<li class="active">
										<a data-toggle="tab" href="#info">
										<i class="fa fa-cog"></i> Personal info </a>
										<span class="after">
										</span>
									</li>
									<li>
										<a data-toggle="tab" href="#avatar">
										<i class="fa fa-picture-o"></i> Change Avatar </a>
									</li>
									<li>
										<a data-toggle="tab" href="#password">
										<i class="fa fa-lock"></i> Change Password </a>
									</li>
									<li>
										<a data-toggle="tab" href="#friend">
										<i class="fa fa-users"></i> Friend List </a>
									</li>
									<li>
										<a data-toggle="tab" href="#team">
										<i class="fa fa-trophy"></i> Team &amp; Invites </a>
									</li>
								</ul>
							</div>
							<div class="col-md-9">
								<div class="tab-content">
									<div id="info" class="tab-pane active">
										<?php include('tpls/settings/user/user-profile.php'); ?>
									</div>
									<div id="avatar" class="tab-pane">
										<?php include('tpls/settings/user/user-avatar.php'); ?>
									</div>
									<div id="password" class="tab-pane">
										<?php include('tpls/settings/user/user-password.php'); ?>
									</div>
									<div id="friend" class="tab-pane">
										<?php include('tpls/settings/user/user-friends.php'); ?>
									</div>
									<div id="team" class="tab-pane">
										<?php include('tpls/settings/user/user-team.php'); ?>
									</div>
									<div class="success"><span class="success_text"></span></div>
								</div>
							</div>
							<!--end col-md-9-->
						<?php } else { ?>
						<h3>You are not logged in.</h3>
						<?php } ?>
						</div>
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
<script src="assets/global/scripts/users.js"></script>
<script src="assets/global/scripts/normal.js"></script>
<div id="accept-invite-confirm" title="Join this team?" style="display:none;">
	<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Team invites will be cleared if accepted.</p>
</div>
<div id="leave-team-confirm" title="Leave this team?" style="display:none;">
	<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Confirm leaving team.</p>
</div>
<div id="remove-friend-confirm" title="Remove user as friend?" style="display:none;">
	<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Confirm removing user as friend.</p>
</div>