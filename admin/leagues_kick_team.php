<?php session_start();
include('lib/db.class.php');
include('lib/ezleague.class.php');

$ez = new ezLeague();
	if(isset($_POST['league_id']) && isset($_POST['team_id'])) {
		$league_id = $_POST['league_id'];
		$team_id   = $_POST['team_id'];
		
			$league = $ez->getLeague($league_id);
			$team	= $ez->getTeam($team_id);
?>
	   <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
	        <h4 class="modal-title">Kick Team From League - <?php print $league['league']; ?></h4>
	      </div>
	      <div class="modal-body">
	       <p>Are you sure you want to kick <em><?php print $team['name']; ?></em>? This action cannot be undone.</p>
	        <div class="row">
	         <div class="col-lg-12">
	       		<div id="kickTeam">
	       		  <div class="col-lg-6">
	       			<form id="confirmKickTeam" name="confirmKickTeam" method="POST">
	       			 <input type="hidden" name="team_id" id="team_id" value="<?php print $team['id']; ?>" />
	       			 <input type="hidden" name="league_id" id="league_id" value="<?php print $league['id']; ?>" />
	       			 <div class="form-group">
					    <label>League</label>
					    <?php print $league['league']; ?>
					 </div>
					 <div class="form-group">
					    <label>Team</label>
					    <?php print $team['name']; ?>
					 </div>
					 <div class="form-group">
					    <label>Why are they being kicked? <br/><small>message will be sent to team gm</small></label>
					    <textarea class="form-control textarea" id="reason" name="reason"></textarea>
					 </div>
					 <div class="form-group">
					 	<button type="submit" class="btn btn-primary">Confirm Kick</button>
	       				<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
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
	   </div>

		<!-- Core Scripts - Include with every page -->
    <script src="js/jquery-1.10.2.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>

    <!-- Page-Level Plugin Scripts - Dashboard -->
    <script src="js/plugins/morris/raphael-2.1.0.min.js"></script>
    <script src="js/plugins/morris/morris.js"></script>

    <!-- SB Admin Scripts - Include with every page -->
    <script src="js/sb-admin.js"></script>
    <script src="js/ezleague.js"></script>
    <script src="//cdn.ckeditor.com/4.4.7/standard/ckeditor.js"></script>
<?php
	}
?>