<?php 
$total_teams = $ez_team->count_teams();
$pages = ceil($total_teams/15);

if( isset( $_GET['search'] ) ) {
	$search = trim( $_GET['search'] );
	$teams = $ez_team->search_teams( $team_name );
} else {
	if( isset( $_GET['p'] ) && is_numeric( $_GET['p'] ) ) {
		$page = $_GET['p'] - 1;
	} else {
		$page = 0;
	}
	
	$position = $page * 15;

	$teams = $ez_team->get_teams($position, 'id', 'ASC');
} 
?>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">View Site Teams</h1>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-sitemap"></i> Team List (<?php echo $total_teams; ?> total teams)
                
                <form class="form-inline pull-right search-user" id="search-teams" name="search-teams" method="POST" role="form">
				  <input type="hidden" name="page" value="all" />
				  <div class="form-group">
				    <input type="text" class="form-control input-sm" id="search" name="search" placeholder="Team Name">
				  </div>
				  <button type="submit" name="submit" class="btn btn-primary btn-sm">Search</button>
				  <a href="users.php?page=all" class="btn btn-info btn-sm">Clear</a>
				</form>
            </div>
            <div class="panel-body">
            <small class="user_suspended suspended">Team Suspended</small>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                            	<th>Team</th>
                                <th>Leader</th>
                                <th>Co-Leader</th>
                                <th>Admin</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
              <?php foreach( $teams as $team ) { ?>
                            <tr>
                                <td><?php echo $team['team']; ?></td>
                                <td><?php echo $team['leader']; ?></td>
                                <td><?php echo $team['coleader']; ?></td>
                                <td><?php echo $team['admin']; ?></td>
                                <td><button onclick="getTeam('<?php echo $team['id']; ?>');" data-toggle="modal" data-target="#editTeamModal" class="btn btn-primary btn-xs">Edit Team</button></td>
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
		               		$pagination .= '<li><a href="teams.php?page=all&p=' . $i . '"><strong>'.$i.'</strong></a></li>';
		               	} else {
		               		$pagination .= '<li><a href="teams.php?page=all&p=' . $i . '">'.$i.'</a></li>';
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
<div id="editTeamModal" class="modal"></div>
<div id="editUserModal" class="modal"></div>