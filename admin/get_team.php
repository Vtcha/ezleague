<?php session_start();
date_default_timezone_set('America/Chicago');
include('lib/class-db.php');
include('lib/objects/class-team.php');
$ez_team = new ezAdmin_Team();
    
     if(!isset($_SESSION['ez_admin'])) {
     	header("Location: login.php");
     } else {
     	$username = $_SESSION['ez_admin'];
     }
     
//get an individual user
if(isset($_POST['id'])) {
	$team_id = $_POST['id'];
	 $team = $ez_team->get_team( $team_id );
?>

<div class="modal-dialog">
	<div class="modal-team">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			<h4 class="modal-title" id="myModalLabel">Viewing Team Profile</h4>
		</div>
		<div class="modal-body">
		 <div class="row">
		  <div class="col-lg-6">
		   <div class="col-lg-12">
            <div class="panel panel-default">
              <div class="panel-heading">
                <h3 class="panel-title text-info">Team Logo</h3>
              </div>
              <div style="height: auto;" id="collapseOne" class="panel-collapse">
                <div class="panel-body">
					<img class="img-responsive" src="../logos/<?php echo $team['logo']; ?>" />
                </div>
              </div>
            </div>
           </div>
           
		   <div class="col-lg-12">
            <div class="panel panel-default">
              <div class="panel-heading">
                <h3 class="panel-title text-info">Leader Details</h3>
              </div>
              <div style="height: auto;" id="collapseOne" class="panel-collapse">
                <div class="panel-body">
					<strong>Leader</strong> <?php echo $team['leader']; ?><br/>
					<strong>Co-Leader</strong> <?php echo $team['coleader']; ?><br/>
					<strong>Team Admin</strong> <?php echo $team['admin']; ?>
					<div class="success">
					  <span class="success_text"></span>
					 </div>
                </div>
              </div>
            </div>
           </div>
           
           <div class="col-lg-12">
            <div class="panel panel-default">
              <div class="panel-heading">
                <h3 class="panel-title text-info">Completed Matches</h3>
              </div>
              <div style="height: auto;" id="collapseOne" class="panel-collapse">
                <div class="panel-body">
                <?php $matches = $ez_team->get_team_matches( $team_id ); ?>
					<div class="table-responsive">
	                    <table class="table table-hover">
	                        <thead>
	                            <tr>
	                            	<th>Home</th>
	                            	<th>Away</th>
	                                <th></th>
	                            </tr>
	                        </thead>
	                        <tbody>
	              <?php foreach( $matches as $match ) { ?>
	                            <tr>
	                                <td><?php echo $match['home']; ?> (<?php echo $match['home_score']; ?>)</td>
	                                <td><?php echo $match['away']; ?> (<?php echo $match['away_score']; ?>)</td>
	                                <td><a href="matches.php?page=match&id=<?php echo $match['id']; ?>" class="btn btn-primary btn-xs">View Match</a></td>
	                            </tr>
	               <?php } ?>
	                        </tbody>
	                     </table>
                    </div>
                </div>
              </div>
            </div>
           </div>
           
          </div>
           
           <div class="col-lg-6"> 
            <div class="panel panel-default">
              <div class="panel-heading">
                <h3 class="panel-title text-info">Team Roster</h3>
              </div>
              <div style="height: auto;" id="collapseOne" class="panel-collapse">
                <div class="panel-body">
              		<div class="table-responsive">
	                    <table class="table table-hover">
	                        <thead>
	                            <tr>
	                            	<th>Username</th>
	                                <th></th>
	                            </tr>
	                        </thead>
	                        <tbody>
	              <?php $roster = $ez_team->get_team_roster( $team_id ); ?>
	              <?php foreach( $roster as $member ) { ?>
	                            <tr>
	                                <td><?php echo $member['username']; ?></td>
	                                <td><a onclick="getUser('<?php echo $member['id']; ?>');" data-toggle="modal" data-target="#editUserModal" class="btn btn-primary btn-xs">View User</a></td>
	                            </tr>
	               <?php } ?>
	                        </tbody>
	                     </table>
                    </div>
                </div>
              </div>
            </div>
           </div>
          </div>
		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		</div>
	</div>
	<!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->

<?php } ?>