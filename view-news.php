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
					Current News <small>read, stay updated, contribute.</small>
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
				<div class="col-md-12 blog-page">
					<div class="row">
						<div class="col-md-9 article-block">
						<?php if( isset($_GET['id'] ) && is_numeric( $_GET['id'] ) ) { ?>
							<?php include('tpls/news/news-single.php'); ?>
							<?php include('tpls/news/news-comments.php'); ?>
							<?php if( isset( $_SESSION['ez_username'] ) ) { ?>
								<?php include('tpls/news/news-add_comment.php'); ?>
							<?php } ?>
						<?php } else { ?>
						<h3>Not a valid news item</h3>
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
<script src="assets/global/scripts/news.js" type="text/javascript"></script>