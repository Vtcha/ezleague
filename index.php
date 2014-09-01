<?php include('header.php'); ?>
<?php 
$total_posts = $ez_frontend->count_posts();
$pages = ceil( $total_posts/3 );

if( isset( $_GET['page'] ) && is_numeric( $_GET['page'] ) ) {
	$page = $_GET['page'] - 1;
} else {
	$page = 0;
}

$position = $page * 3;
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
				<div class="col-md-12 blog-page">
					<div class="row">
						<div class="col-md-9 col-sm-8 article-block">
							<h1>Latest News</h1>
							<div class="row">
							<?php $news = $ez_news->get_news( $position ); ?>
							<?php foreach( $news as $item ) { ?>
								<div class="col-md-4 blog-img blog-tag-data">
									<?php if( $item['media'] ) { ?>	
										<img src="./media/<?php echo $item['media']; ?>" alt="" class="img-responsive">
									<?php } ?>
									<ul class="list-inline">
										<li>
											<i class="fa fa-calendar"></i>
											<a href="#">
											<?php echo date('M j h:ia', strtotime($item['created'])); ?> </a>
										</li>
										<li>
											<i class="fa fa-comments"></i>
											<a href="#">
											<?php echo count( $ez_news->get_news_comments( $item['id'] ) ); ?> Comments </a>
										</li>
									</ul>
									<ul class="list-inline blog-tags">
										<li>
										<?php $post_categories = explode( ',', $item['categories'] ); ?>
											<i class="fa fa-tags"></i>
										<?php foreach( $post_categories as $category ) { ?>
											<a href="#">
											<?php echo $category; ?> 
											</a>
										<?php } ?>
										</li>
									</ul>
								</div>
								<div class="col-md-8 blog-article">
									<h3>
									<a href="view-news.php?id=<?php echo $item['id']; ?>">
									<?php echo $item['title']; ?></a>
									</h3>
									<p>
										 <?php echo $item['body']; ?>
									</p>
									<a class="btn blue" href="view-news.php?id=<?php echo $item['id']; ?>">
									Read more <i class="m-icon-swapright m-icon-white"></i>
									</a>
								</div>
								
								<div style="clear:both;"></div>
								<hr>
							<?php } ?>
							<?php 
									$pagination = '';
									if($pages > 1)
									{
										$pagination .= '<ul class="pagination pagination-sm">';
										for($i = 1; $i<=$pages; $i++)
										{
											if( $i == $page + 1 ) {
												$pagination .= '<li><a href="index.php?page=' . $i . '"><strong>'.$i.'</strong></a></li>';
											} else {
												$pagination .= '<li><a href="index.php?page=' . $i . '">'.$i.'</a></li>';	
											}
										
										}
										$pagination .= '</ul>';
									}
									echo $pagination;
							?>
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