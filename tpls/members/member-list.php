<?php 
$total_members = $ez_frontend->count_members();
$pages = ceil( $total_members/15 );

	if( isset( $_GET['by'] ) ) {
		$order_by = $_GET['by'];
		switch( $order_by ) {
			case 'username':
				$order_by = 'username';
				break;
			case 'guild':
				$order_by = 'guild';
				break;
			case 'role':
				$order_by = 'role';
				break;
			case 'id':
				$order_by = 'id';
				break;
			default:
				$order_by = 'id';
				break;
		}
	} else {
		$order_by = 'id';
	}
	
	if( isset( $_GET['order'] ) ) {
		$order = $_GET['order'];
		switch( $order ) {
			case 'DESC':
				$order_text = 'ASC';
				break;
			case 'ASC':
				$order_text = 'DESC';
				break;
			default:

				break;
		}
	} else {
		$order_text = 'ASC';
	}
	
	if( isset( $_GET['page'] ) && is_numeric( $_GET['page'] ) ) {
		$page = $_GET['page'] - 1;
	} else {
		$page = 0;
	}
		
	$position = $page * 15;

$members = $ez_frontend->get_members($position, $order_by, $order_text); ?>
	<table class="table table-hover">
		<thead>
		<tr>
			<th><a href="members.php?page=<?php echo $page; ?>&by=id&order=<?php echo $order_text; ?>">ID</a></th>
			<th><a href="members.php?page=<?php echo $page; ?>&by=username&order=<?php echo $order_text; ?>">Username</a></th>
			<th>Contact</th>
			<th><a href="members.php?page=<?php echo $page; ?>&by=guild&order=<?php echo $order_text; ?>">Guild</a></th>
			<th><a href="members.php?page=<?php echo $page; ?>&by=role&order=<?php echo $order_text; ?>">Role</a></th>
			<th></th>
		</tr>
		</thead>
		<tbody>
	<?php foreach( $members as $member ) { ?>
		<tr>
			<td><?php echo $member['id']; ?></td>
			<td><?php echo $member['username']; ?></td>
			<td><?php echo str_replace('@', '[at]', $member['email']); ?>
			<td><?php echo ( $member['guild_name'] == '' ? 'No Team' : $member['guild_name'] ); ?></td>
			<td><?php echo $member['role']; ?></td>
			<td>
				<a class="label label-sm label-success" href="view-member.php?id=<?php echo $member['id']; ?>">View </a>
			</td>
		</tr>
	<?php } ?>
		</tbody>
	</table>
	<?php 
	$pagination = '';
	if($pages > 1)
	{
		$pagination .= '<ul class="pagination pagination-sm">';
		for($i = 1; $i<=$pages; $i++)
		{
			if( $i == $page + 1 ) {
				$pagination .= '<li><a href="members.php?page=' . $i . '&by=' . $order_by . '&order=' . $order . '"><strong>'.$i.'</strong></a></li>';
			} else {
				$pagination .= '<li><a href="members.php?page=' . $i . '&by=' . $order_by . '&order=' . $order . '">'.$i.'</a></li>';	
			}
		
		}
		$pagination .= '</ul>';
	}
	echo $pagination;
	?>