<?php session_start();
date_default_timezone_set('America/Chicago');
include('lib/class-db.php');
include('lib/objects/class-league.php');
$ez_league = new ezAdmin_League();
    
     if(!isset($_SESSION['ez_admin'])) {
     	header("Location: login.php");
     } else {
     	$username = $_SESSION['ez_admin'];
     }
     
//get an individual user
if(isset($_POST['id'])) {
	$league_id = $_POST['id'];
	 $league = $ez_league->get_league( $league_id );
	 $max_teams = $league['teams'];
	 $available_teams = $ez_league->get_available_teams( $league_id );
	 $current_teams   = $ez_league->get_league_teams( $league_id );
	 $current_teams_count = count( $current_teams );
?>

<div class="modal-dialog">
	<div class="modal-team">
		<div class="modal-header">
			<button type="button" onclick="javascript:location.reload();" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			<h4 class="modal-title" id="myModalLabel">Add League Teams</h4>
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
	                            <tr class="team-<?php echo $available_team_id; ?>">
	                                <td><?php echo $team['guild']; ?></td>
	                                <td><button onClick="addLeagueTeam('<?php echo $league_id; ?>', '<?php echo $available_team_id; ?>');" data-league-id="<?php echo $league_id; ?>" data-team-id="<?php echo $available_team_id; ?>" class="btn btn-primary btn-xs league-add-team-modal">Add Team</a></td>
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
                <h3 class="panel-title text-info current-teams-amount" data-total-teams="<?php echo $current_teams_count; ?>">Current Teams (<?php echo $current_teams_count; ?>)</h3>
              </div>
              <div style="height: auto;" id="collapseOne" class="panel-collapse">
                <div class="panel-body">
              		<div class="table-responsive">
	                    <table class="table table-hover league-teams" data-max-teams="<?php echo $max_teams; ?>">
	                        <thead>
	                            <tr>
	                            	<th>Team</th>
	                            </tr>
	                        </thead>
	                        <tbody>
	              <?php foreach( $current_teams as $team ) { ?>
	                            <tr>
	                                <td><?php echo $team['guild']; ?></td>
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
			<button type="button" onclick="javascript:location.reload();" class="btn btn-default" data-dismiss="modal">Close</button>
		</div>
	</div>
	<!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->

<?php } ?>