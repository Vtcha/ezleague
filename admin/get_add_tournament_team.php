<?php session_start();
date_default_timezone_set('America/Chicago');
include('lib/class-db.php');
include('lib/objects/class-tournament.php');
$ez_tournament = new ezAdmin_Tournament();
    
     if(!isset($_SESSION['ez_admin'])) {
     	header("Location: login.php");
     } else {
     	$username = $_SESSION['ez_admin'];
     }
     
//get an individual user
if(isset($_POST['id'])) {
	$tournament_id = $_POST['id'];
	 $available_teams = $ez_tournament->get_available_teams( $tournament_id );
	 $current_teams   = $ez_tournament->get_tournament_teams( $tournament_id );
?>

<div class="modal-dialog">
	<div class="modal-team">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			<h4 class="modal-title" id="myModalLabel">Add Tournament Teams</h4>
		</div>
		<div class="modal-body">
		 <div class="row">
           
           <div class="col-lg-6"> 
            <div class="panel panel-default">
              <div class="panel-heading">
                <h3 class="panel-title text-info">Available Teams</h3>
              </div>
              <div style="height: auto;" id="collapseOne" class="panel-collapse">
                <div class="panel-body">
              		<div class="table-responsive">
	                    <table class="table table-hover">
	                        <thead>
	                            <tr>
	                            	<th>Team</th>
	                                <th></th>
	                            </tr>
	                        </thead>
	                        <tbody>
	              <?php foreach( $available_teams as $team ) { ?>
	              	<?php $available_team_id = $team['id']; ?>
	                            <tr>
	                                <td><?php echo $team['guild']; ?></td>
	                                <td><a onClick="addTournamentTeam('<?php echo $tournament_id; ?>', '<?php echo $available_team_id; ?>');" class="btn btn-primary btn-xs">Add Team</a></td>
	                            </tr>
	               <?php } ?>
	                        </tbody>
	                     </table>
                    </div>
                </div>
              </div>
            </div>
           </div>

           <div class="col-lg-6"> 
            <div class="panel panel-default">
              <div class="panel-heading">
                <h3 class="panel-title text-info">Current Teams</h3>
              </div>
              <div style="height: auto;" id="collapseOne" class="panel-collapse">
                <div class="panel-body">
              		<div class="table-responsive">
	                    <table class="table table-hover tournament-teams">
	                        <thead>
	                            <tr>
	                            	<th>Team</th>
	                                <th></th>
	                            </tr>
	                        </thead>
	                        <tbody>
	              <?php foreach( $current_teams as $team ) { ?>
	                            <tr>
	                                <td><?php echo $team['guild']; ?></td>
	                                <td><button type="button" onclick="kickTeam('<?php echo $team['id']; ?>', '<?php echo $tournament['id']; ?>')" class="btn btn-danger btn-xs">Kick Team</button></td>
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