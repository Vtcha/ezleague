<hr>
<div class="post-comment">
	<h3>Leave a Comment</h3>
	<form id="addComment" role="form" method="POST">
	<input type="hidden" id="author" value="<?php echo $profile['username']; ?>">
	<input type="hidden" id="author_id" value="<?php echo $profile['id']; ?>">
	<input type="hidden" id="post_id" value="<?php echo $news_id; ?>">
		<div class="form-group">
			<label class="control-label">Message <span class="required">
			* </span>
			</label>
			<textarea id="comment" class="col-md-10 form-control" rows="8"></textarea>
		</div>
		<button class="margin-top-20 btn blue" type="submit">Post a Comment</button>
	</form>
	<div class="success"><span class="success_text"></span></div>
</div>