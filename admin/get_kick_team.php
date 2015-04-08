<?php session_start();
date_default_timezone_set('America/Chicago');
include('./lib/class-db.php');
include('./lib/objects/class-league.php');

$ez_league = new ezAdmin_league();
    
     if(!isset($_SESSION['ez_admin'])) {
     	header("Location: login.php");
     } else {
     	$username = $_SESSION['ez_admin'];
     }
     
//get an individual league season item
if(isset($_POST['team_id']) && isset($_POST['league_id'])) {
    $team_id   = trim( $_POST['team_id'] );
    $league_id = trim( $_POST['league_id'] );
?>

<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			<h4 class="modal-title" id="myModalLabel">Kick Team Confirmation</h4>
		</div>
		<div class="modal-body">
		 <div class="row">
		  <div class="col-lg-12">
            <div class="panel panel-default">
              <div class="panel-heading">
                <h3 class="panel-title text-info">Team Kick Details</h3>
              </div>
              <div style="height: auto;" id="collapseOne" class="panel-collapse">
                <div class="panel-body">
					          <form method="POST" id="kickTeam">
                      <input type="hidden" id="league-id" value="<?php echo $league_id; ?>" />
                      <input type="hidden" id="team-id" value="<?php echo $team_id; ?>" />
                        <div class="form-group">
                            <label>Why is this team being kicked?</label>
                            <small>(message will be sent to team's leader)</small><br/>
                            <textarea class="form-control" id="reason" placeholder="Kick details"></textarea>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-success" type="submit">Kick Team</button>
                            <button class="btn btn-warning" type="reset">Reset</button>
                        </div>
                        <div class="success">
                          <span class="success_text"></span>
                        </div>
                      </form>
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
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.0/themes/smoothness/jquery-ui.css" />
	<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.0/jquery-ui.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>

    <!-- SB Admin Scripts - Include with every page -->
    <script src="js/sb-admin.js"></script>
    <script src="js/ezleague/league.js"></script>