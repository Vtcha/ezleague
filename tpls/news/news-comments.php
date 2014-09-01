<div class="media">
	<h3>Comments</h3>
	<?php $now = date('Y-m-d H:i:s', time()); ?>
	<?php foreach( $comments as $comment ) { ?>
	<?php $comment_avatar = $ez_users->get_user_avatar( $comment['author_id'] ); ?>
	<a href="#" class="pull-left">
	<?php if( $comment_avatar ) { ?>
	<img alt="" src="avatars/<?php echo $comment_avatar; ?>" class="media-object">
	<?php } else { ?>
	<img alt="" src="../../assets/admin/pages/media/blog/9.jpg" class="media-object">
	<?php } ?>
	</a>
	<div class="media-body">
		<h4 class="media-heading">
			<a href="view-user.php?id=<?php echo $comment['author_id']; ?>">
				<?php echo $comment['author']; ?> 
			</a>
			<span>posted</span> <span class="text-primary"><?php echo $ez->dateDiff($comment['created'], $now) . "\n"; ?></span><span>ago</span> 
		</h4>
		<p>
			<?php echo $comment['comment']; ?>
		</p>
		<hr>
	</div>
	<?php } ?>
</div>