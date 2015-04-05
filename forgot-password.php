<?php include('header.php'); ?>
<?php 
	$num1 = rand(1,10);
	$num2 = rand(1,10);
	$captcha = $num1 + $num2;
?>
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
					Forgot Password <small>input, confirm, recover.</small>
					</h3>
					<ul class="page-breadcrumb breadcrumb">
						<li>
							<i class="fa fa-home"></i>
							<a href="index.php">Home</a>
							<i class="fa fa-angle-right"></i>
						</li>
						<li>
							<a href="#">Forgot Password</a>
						</li>
					</ul>
					<!-- END PAGE TITLE & BREADCRUMB-->
				</div>
			</div>
			<!-- END PAGE HEADER-->
			<!-- BEGIN PAGE CONTENT-->
			<div class="row">
				<div class="col-md-12 blog-page">
					<div class="row">
					<?php 
						if( isset( $_GET['reset'] ) ) {
							include( 'tpls/users/users-reset-password.php' );
						} else {
							include( 'tpls/users/users-forgot-password.php' );
						}
					?>
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
<script src="assets/global/scripts/users.js" type="text/javascript"></script>