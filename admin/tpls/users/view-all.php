<?php 
$total_members = $ez_user->count_users();
$pages = ceil($total_members/15);

if( isset( $_GET['search'] ) ) {
	$search = trim( $_GET['search'] );
	$users = $ez_user->search_user( $search );
} else {
	if( isset( $_GET['p'] ) && is_numeric( $_GET['p'] ) ) {
		$page = $_GET['p'] - 1;
	} else {
		$page = 0;
	}
	
	$position = $page * 15;

	$users = $ez_user->get_users($position, 'id', 'ASC');
} 
?>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">View Site Users</h1>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-sitemap"></i> Site Users (<?php echo $total_members; ?> total users)
                
                <form class="form-inline pull-right search-user" id="search-user" name="search-user" method="POST" role="form">
				  <input type="hidden" name="page" value="all" />
				  <div class="form-group">
				    <input type="text" class="form-control input-sm" id="search" name="search" placeholder="Username">
				  </div>
				  <button type="submit" name="submit" class="btn btn-primary btn-sm">Search</button>
				  <a href="users.php?page=all" class="btn btn-info btn-sm">Clear</a>
				</form>
            </div>
            <div class="panel-body">
            <small class="user_suspended suspended">Account Suspended</small>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                            	<th>Username</th>
                                <th>E-Mail</th>
                                <th>Joined</th>
                                <th>Role</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
              <?php foreach( $users as $user ) { ?>
                            <tr <?php echo ( $user['status'] == 1 ? 'class="user_suspended"' : '' ); ?>>
                                <td><?php echo $user['username'] ?></td>
                                <td><?php echo str_replace( '@', '[at]', $user['email'] ); ?></td>
                                <td><?php echo date( 'F d, Y', strtotime( $user['date'] ) ); ?></td>
                                <td><?php echo $user['role'] ?></td>
                                <td><button onclick="getUser('<?php echo $user['id']; ?>');" data-toggle="modal" data-target="#editUserModal" class="btn btn-primary btn-xs">Edit User</button></td>
                            </tr>
               <?php } ?>
                        </tbody>
                     </table>
                 </div>
               <?php
               if( !isset( $_GET['search'] ) ) { 
	               $pagination = '';
	               if($pages > 1) {
	               		$pagination .= '<ul class="pagination pagination-sm">';
	               	for( $i = 1; $i<=$pages; $i++ ) {
		               	if( $i == $page + 1 ) {
		               		$pagination .= '<li><a href="users.php?page=all&p=' . $i . '"><strong>'.$i.'</strong></a></li>';
		               	} else {
		               		$pagination .= '<li><a href="users.php?page=all&p=' . $i . '">'.$i.'</a></li>';
		               	}
	               	}
	               		$pagination .= '</ul>';
	               }
	               echo $pagination;
               }
               ?>
            </div>
        </div>
    </div>
</div>
<div id="editUserModal" class="modal">
  
</div>