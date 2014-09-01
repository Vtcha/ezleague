<?php $news_id = trim( $_GET['id'] ); ?>
<?php $news_item = $ez_news->get_news_item( $news_id );?>
<?php $comments = $ez_news->get_news_comments( $news_id ); ?>
<h3><?php echo $news_item['title']; ?></h3>
<div class="blog-tag-data">
	<?php if( $news_item['media'] != '' ) { ?>
		<img src="./media/<?php echo $news_item['media']; ?>" class="img-responsive post-image" alt="">
	<?php } ?>
	<div class="row">
		<div class="col-md-6">
			<ul class="list-inline blog-tags">
				<li>
					<i class="fa fa-tags"></i>
					<?php $post_categories = explode( ',', $news_item['categories'] ); ?>
					<?php foreach( $post_categories as $category ) { ?>
						<a href="#">
						<?php echo $category; ?> 
						</a>
					<?php } ?>
				</li>
			</ul>
		</div>
		<div class="col-md-6 blog-tag-data-inner">
			<ul class="list-inline">
				<li>
					<i class="fa fa-calendar"></i>
					<a href="#">
					<?php echo date( 'F d, Y h:ia', strtotime( $news_item['created'] ) ); ?> </a>
				</li>
				<li>
					<i class="fa fa-comments"></i>
					<a href="#">
					<?php echo count( $comments ); ?> Comments </a>
				</li>
			</ul>
		</div>
	</div>
</div>
<!--end news-tag-data-->
<div>
		<?php echo $news_item['body']; ?>
</div>
<hr>