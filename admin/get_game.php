<?php session_start();
date_default_timezone_set('America/Chicago');
include('lib/class-db.php');
include('lib/objects/class-settings.php');
$ez_settings = new ezAdmin_Settings();
    
     if(!isset($_SESSION['ez_admin'])) {
     	header("Location: login.php");
     } else {
     	$username = $_SESSION['ez_admin'];
     }
     
//get an individual user
if(isset($_POST['id'])) {
	$game_id = $_POST['id'];
	 $game = $ez_settings->get_game( $game_id );
?>

<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			<h4 class="modal-title" id="myModalLabel">Viewing Game Details</h4>
		</div>
		<div class="modal-body">
		 <div class="row">
		  <div class="col-lg-6">
            <div class="panel panel-default">
              <div class="panel-heading">
                <h3 class="panel-title text-info">Game Details</h3>
              </div>
              <div style="height: auto;" id="collapseOne" class="panel-collapse">
                <div class="panel-body">
					<form id="editGame" method="POST" role="form">
					 <input type="hidden" id="game-id" value="<?php echo $game['id']; ?>" />
						<div class="form-group">
							<label>Name</label>
							<input disabled type="text" class="form-control" id="game-name" value="<?php echo $game['game']; ?>" />
						</div>
						<div class="form-group">
							<label>Short Name</label>
							<input type="text" class="form-control" id="game-short-name" value="<?php echo $game['short']; ?>" />
						</div>
						<div class="form-group">
							<label>Slug</label>
							<input disabled type="text" class="form-control" id="game-slug" value="<?php echo $game['slug']; ?>" />
						</div>
						<div class="form-group">
							<button type="submit" class="btn btn-success">Update Details</button>
							<button type="reset" class="btn btn-warning">Reset</button>
						</div>
					</form>
					<div class="success">
					  <span class="success_text"></span>
					 </div>
                </div>
              </div>
            </div>
           </div>
           
           <div class="col-lg-6"> 
            <div class="panel panel-default">
              <div class="panel-heading">
                <h3 class="panel-title text-info">Game Logo</h3>
              </div>
              <div style="height: auto;" id="collapseOne" class="panel-collapse">
                <div class="panel-body">
              
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
</div>
<script src="js/ezleague/settings.js"></script>
<?php } ?>