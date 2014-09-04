<?php include('header.php'); ?>
<link href="assets/admin/pages/css/inbox.css" rel="stylesheet" type="text/css"/>
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
							<a href="#">My Inbox</a>
						</li>
					</ul>
					<!-- END PAGE TITLE & BREADCRUMB-->
				</div>
			</div>
			<!-- END PAGE HEADER-->
			<!-- BEGIN PAGE CONTENT-->
			<div class="row inbox">
			<?php if( isset( $_SESSION['ez_username'] ) ) { ?>
			<?php $inbox = $ez_inbox->get_inbox( $profile['username'] ); ?>
			<?php $total_inbox = count( $inbox ); ?>
				<div class="col-md-2">
					<ul class="inbox-nav margin-bottom-10">
						<li class="compose-btn">
							<a href="view-inbox.php?page=compose" data-title="Compose" class="btn green">
							<i class="fa fa-edit"></i> Compose </a>
						</li>
						<li class="inbox active">
							<a href="view-inbox.php" class="btn" data-title="Inbox">
							Inbox (<?php echo $total_inbox; ?>) </a>
						</li>
					</ul>
				</div>
				<div class="col-md-10">
					<?php 
						if( isset( $_GET['page'] ) ) { 
							$page = trim( $_GET['page'] );
							switch( $page ) {
								case 'inbox':
									include('tpls/inbox/inbox.php');
								break;
								
								case 'compose':
									include('tpls/inbox/compose.php');
								break;
								
								case 'view':
									include('tpls/inbox/view.php');
								break;
								
								default:
									include('tpls/inbox/inbox.php');
								break;
							}
						} else {
							include('tpls/inbox/inbox.php');
						}
					?>
				</div>
			<?php } else { ?>
				<h3>You must be logged in to view your inbox</h3>
			<?php } ?>
			</div>
			<!-- END PAGE CONTENT-->
		</div>
	</div>
	<!-- END CONTENT -->
</div>
<!-- END CONTAINER -->
<?php include('footer.php'); ?>
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
<div id="accept-invite-confirm" title="Join this team?" style="display:none;">
	<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Team invites will be cleared if accepted.</p>
</div>
<div id="leave-team-confirm" title="Leave this team?" style="display:none;">
	<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Confirm leaving team.</p>
</div>