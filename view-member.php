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
					Members <small>view, search, invite.</small>
					</h3>
					<ul class="page-breadcrumb breadcrumb">
						<li>
							<i class="fa fa-home"></i>
							<a href="index.php">Home</a>
							<i class="fa fa-angle-right"></i>
						</li>
						<li>
							<a href="#">Members</a>
						</li>
					</ul>
					<!-- END PAGE TITLE & BREADCRUMB-->
				</div>
			</div>
			<!-- END PAGE HEADER-->
			<!-- BEGIN PAGE CONTENT-->
			<div class="row profile">
				<div class="col-md-12 blog-page">
					<div class="row">
						<div class="col-md-9 col-sm-8 article-block">
						<?php if( !isset( $_GET['id'] ) || is_numeric( $_GET['id'] ) ) { ?>
							<?php include('tpls/members/member-view.php'); ?>
						<?php } else { ?>
							<h5>Members IDs <em>must be numeric</em></h5>
						<?php } ?>
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
<div id="team-invite-confirm" title="Send team invite?" style="display:none;">
	<p style="line-height:16px;margin:0;padding:0;"><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Confirm sending team invite. <br/><small class="text-danger">Invites take up to 10 seconds to send.</em></p>
</div>
<div id="add-friend-confirm" title="Add user as friend?" style="display:none;">
	<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Confirm adding user as friend.</p>
</div>
<div id="remove-friend-confirm" title="Remove user as friend?" style="display:none;">
	<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Confirm removing user as friend.</p>
</div>
<script src="assets/global/scripts/inbox.js"></script>
<script src="assets/global/scripts/normal.js"></script>
<script src="assets/global/plugins/ckeditor/ckeditor.js" type="text/javascript"></script>
<script>
CKEDITOR.replace( 'inbox_message', {
	toolbar: [
		[ 'Bold', 'Italic', '-', 'NumberedList', 'BulletedList', '-', 'Link', 'Unlink' ],
		[ 'FontSize', 'TextColor', 'BGColor' ]
	]
});
</script>