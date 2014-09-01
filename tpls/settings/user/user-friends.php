<?php $friends = $ez_users->get_friend_list( $profile['id'] ); ?>
<?php $total_friends = count( $friends ); ?>
<div class="portlet box blue">
<div class="portlet-title">
	<div class="caption">
		<i class="fa fa-clog"></i>View Friend List (<?php echo $total_friends; ?>)
	</div>
	<div class="tools">
		<a href="javascript:;" class="collapse">
		</a>
	</div>
</div>
<div class="portlet-body">
<?php if( $friends ) { ?>
	<table class="table table-hover">
		<thead>
		<tr>
			<th>ID</th>
			<th>Username</th>
			<th>E-Mail</th>
			<th></th>
		</tr>
		</thead>
		<tbody>
	<?php foreach( $friends as $friend ) { ?>
		<tr>
			<td><?php echo $friend['id']; ?></td>
			<td><?php echo $friend['username']; ?></td>
			<td><?php echo str_replace('@', '[at]', $friend['email']); ?>
			<td>
				<a class="label label-sm label-success" href="view-member.php?id=<?php echo $friend['id']; ?>">View </a>
				<a class="label label-sm label-danger" style="margin-left:10px;" onclick="removeFriend('<?php echo $friend['id']; ?>','<?php echo $profile['id']; ?>');">Remove Friend </a>
			</td>
		</tr>
	<?php } ?>
		</tbody>
	</table>
<?php } else { ?>
	<h3>You have no friends! Try being more social.</h3>
<?php } ?>
</div>	
</div>