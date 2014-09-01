<?php if( isset( $_GET['id'] ) && is_numeric( $_GET['id'] ) ) { ?>
<?php $message_id = trim( $_GET['id'] ); ?>
<?php 
		$access = $ez_inbox->check_message_access( $message_id, $profile['username'] );
		if( $access ) {
			$message = $ez_inbox->get_message( $message_id );
			$ez_inbox->mark_read( $message_id, $profile['username'] )
?>
	<div class="inbox-header inbox-view-header">
		<h1 class="pull-left"><?php echo $message['subject']; ?></h1>
		<!-- 
		<div class="pull-right">
			<a class="btn btn-danger btn-sm" onclick="deleteMessage('<?php echo $message_id; ?>', '<?php echo $profile['username']; ?>')">
				<i class="fa fa-times"></i> Delete Message
			</a>
		</div>
		-->
	</div>
	<div class="inbox-view-info">
		<div class="row">
			<div class="col-md-7">
				<img class="inbox-avatar" src="avatars/<?php echo $message['avatar']; ?>">
				<span class="bold">
				<?php echo $message['sender']; ?> </span>
				on <em><?php echo date( 'F d, Y h:ia', strtotime( $message['date'] ) ); ?></em>
			</div>
			<div class="col-md-5 inbox-info-btn">
			<div class="btn-group">
				<a href="#reply" class="btn blue reply-btn">
				<i class="fa fa-reply"></i> Reply </a>
				</div>
			</div>
		</div>
		<div class="inbox-view">
			<?php echo $message['body']; ?>
		</div>
	</div>
	<?php $replies = $ez_inbox->get_message_replies( $message_id ); ?>
	<?php foreach ($replies as $reply) { ?>
	<div class="inbox-view-info">
		<div class="row">
			<div class="col-md-7">
				<img class="inbox-avatar" src="avatars/<?php echo $reply['avatar']; ?>">
				<span class="bold">
				<?php echo $reply['sender']; ?> </span>
				on <em><?php echo date( 'F d, Y h:ia', strtotime( $reply['date'] ) ); ?></em>
			</div>
			<div class="col-md-5 inbox-info-btn">
			<div class="btn-group">
				<a href="#reply" class="btn blue reply-btn">
				<i class="fa fa-reply"></i> Reply </a>
				</div>
			</div>
		</div>
		<div class="inbox-view">
			<?php echo $reply['message']; ?>
		</div>
	</div>
	<?php } ?>
	<h3 id="reply">Reply</h3> 
	<form id="addResponse" class="inbox-compose form-horizontal" method="POST">
		<input type="hidden" id="reply-id" value="<?php echo $message['id']; ?>" />
		<input type="hidden" id="reply-author" value="<?php echo $profile['username']; ?>" />
	<div class="inbox-form-group">
		<textarea class="inbox-editor form-control" id="inbox_message" name="inbox_message" rows="12"></textarea>
	</div>
	<div class="inbox-compose-btn">
		<button type="submit" class="btn blue"><i class="fa fa-check"></i>Reply</button>
		<div class="success"><span class="success_text"></span></div>
	</div>
</form>
	<?php } else { ?>
		<h3>You do not have access to this message</h3>
	<?php } ?>
<?php } else { ?>
	<h3>This is not a valid message</h3>
<?php } ?>