<?php $search = trim( $_GET['search'] ); ?>
<?php $members = $ez_frontend->members_search($search); ?>
	<table class="table table-hover">
		<thead>
		<tr>
			<th>ID</th>
			<th>Username</th>
			<th>Contact</th>
			<th>Guild</th>
			<th>Role</th>
			<th></th>
		</tr>
		</thead>
		<tbody>
	<?php foreach( $members as $member ) { ?>
		<tr>
			<td><?php echo $member['id']; ?></td>
			<td><?php echo $member['username']; ?></td>
			<td><?php echo str_replace('@', '[at]', $member['email']); ?>
			<td><?php echo $member['guild_name']; ?></td>
			<td><?php echo $member['role']; ?></td>
			<td>
				<a class="label label-sm label-success" href="view-member.php?id=<?php echo $member['id']; ?>">View </a>
			</td>
		</tr>
	<?php } ?>
		</tbody>
	</table>