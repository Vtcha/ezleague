<?php session_start();
date_default_timezone_set('America/Chicago');
include('./lib/class-db.php');
include('./lib/objects/class-league.php');

$ez_league = new ezAdmin_League();
    
     if(!isset($_SESSION['ez_admin'])) {
     	header("Location: login.php");
     } else {
     	$username = $_SESSION['ez_admin'];
     }
     
//get an individual league season item
if(isset($_POST['season_id']) && isset($_POST['league_id'])) {
	$season_id = $_POST['season_id'];
	$league_id = $_POST['league_id'];
	 $season = $ez_league->get_season( $season_id );
	 $league = $ez_league->get_league( $league_id );
?>

<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			<h4 class="modal-title" id="myModalLabel">Viewing Season Date Details</h4>
		</div>
		<div class="modal-body">
		 <div class="row">
		  <div class="col-lg-12">
            <div class="panel panel-default">
              <div class="panel-heading">
                <h3 class="panel-title text-info"><em><?php echo $league['league']; ?></em> Season <?php echo $season_id; ?> Dates</h3>
              </div>
              <div style="height: auto;" id="collapseOne" class="panel-collapse">
                <div class="panel-body">
					<form method="POST" id="editSeason">
                      <input type="hidden" id="season-id" value="<?php echo $season_id; ?>" />
                        <div class="form-group">
                            <label>Start Date</label>
                            <small>(<strong>Current Start Date</strong> <?php echo date( 'F d, Y', strtotime( $season['start'] ) ); ?>)</small><br/>
                            <input class="form-control" id="start" placeholder="Start Date" />
                        </div>
                        <div class="form-group">
                            <label>End Date</label>
                            <small>(<strong>Current End Date</strong> <?php echo date( 'F d, Y', strtotime( $season['end'] ) ); ?>)</small><br/>
                            <input class="form-control" id="end" placeholder="End Date" />
                        </div>
                        <div class="form-group">
                            <label>Registration Date</label>
                            <small>(<strong>Current Registration End Date</strong> <?php echo date( 'F d, Y', strtotime( $season['registration'] ) ); ?>)</small><br/>
                            <input class="form-control" id="registration" placeholder="End Date" />
                        </div>
                        <div class="form-group">
                            <button class="btn btn-success" type="submit">Edit Season Dates</button>
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