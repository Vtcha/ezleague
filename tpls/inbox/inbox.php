	<div class="inbox-header">
		<h1 class="pull-left">Inbox</h1>
	</div>
	<div class="inbox-content">
	<table class="table table-striped table-advance table-hover">
	<thead>
		<tr>
			<th></th>
			<th>Sender</th>
			<th colspan="2">Subject</th>
			<th class="pagination-control" colspan="2">
				<!-- <span class="pagination-info">
				1-30 of <?php echo $total_inbox; ?> </span>
				<a class="btn btn-sm blue">
				<i class="fa fa-angle-left"></i>
				</a>
				<a class="btn btn-sm blue">
				<i class="fa fa-angle-right"></i>
				</a> 
				-->
			</th>
		</tr>
	</thead>
	<tbody>
	<?php foreach( $inbox as $message ) { ?>
		<tr class="<?php echo $message['status']; ?>" data-messageid="1">
			<td class="inbox-small-cells">
				<i class="fa fa-times"></i>
			</td>
			<td class="view-message hidden-xs">
				 <a href="view-inbox.php?page=view&id=<?php echo $message['msg_id']; ?>"><?php echo $message['sender']; ?></a>
			</td>
			<td class="view-message" colspan="2">
				 <a href="view-inbox.php?page=view&id=<?php echo $message['msg_id']; ?>"><?php echo $message['subject']; ?></a>
			</td>
			<td class="view-message text-right" colspan="2">
				 <?php echo date('F d, Y h:ia', strtotime($message['date'])); ?>
			</td>
		</tr>
	<?php } ?>
	</tbody>
</table>
</div>