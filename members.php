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
			<div class="row">
				<div class="col-md-12 blog-page">
					<div class="row">
						<div class="col-md-9 col-sm-8 article-block">
						<div class="row search-form-default">
							<div class="col-md-12">
								<form class="form-inline" action="members.php">
									<div class="input-group">
										<div class="input-cont">
											<input placeholder="Member..." name="search" value="<?php echo trim( $_GET['search'] ); ?>" class="form-control" type="text">
										</div>
										<span class="input-group-btn">
										<button type="submit" class="btn green">
										Search &nbsp; <i class="m-icon-swapright m-icon-white"></i>
										</button>
										</span>
									</div>
								</form>
							</div>
						</div>
						<?php if( !isset( $_GET['search'] ) || $_GET['search'] == '' ) { ?>
							<?php include('tpls/members/member-list.php'); ?>
						<?php } elseif( isset( $_GET['search'] ) && strlen( $_GET['search'] ) >= 3 ) { ?>
							<?php include('tpls/members/member-search.php'); ?>
						<?php } elseif( isset( $_GET['search'] ) && strlen( $_GET['search'] ) < 3 ) { ?>
							<h5>Search string must be at least <em>3 characters</em></h5>
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