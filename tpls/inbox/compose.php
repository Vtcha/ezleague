<form id="sendMessage" class="inbox-compose form-horizontal" method="POST">
<input type="hidden" id="from" value="<?php echo $profile['username']; ?>" />
	<div class="inbox-compose-btn">
		<button type="submit" class="btn blue"><i class="fa fa-check"></i>Send</button>
	</div>
	<div class="inbox-form-group mail-to">
		<label class="control-label">To:</label>
		<div class="controls controls-to">
			<input type="text" class="form-control" id="to">
		</div>
	</div>
	<div class="inbox-form-group">
		<label class="control-label">Subject:</label>
		<div class="controls">
			<input type="text" class="form-control" id="subject">
		</div>
	</div>
	<div class="inbox-form-group">
		<textarea class="inbox-editor form-control" id="inbox_message" rows="12"></textarea>
	</div>
	<div class="inbox-compose-btn">
		<button type="submit" class="btn blue"><i class="fa fa-check"></i>Send</button>
	</div>
</form>
<div class="success"><span class="success_text"></span></div>