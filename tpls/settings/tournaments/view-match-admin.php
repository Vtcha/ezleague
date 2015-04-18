<div class="col-md-12">
<?php 
	if( $match_details['home_accept'] != 1 || $match_details['away_accept'] != 1 ) { 
?>
<span class="text-success"><strong>NOTE</strong> both teams must <em>accept</em> the match details below before reporting match outcome</span>
<hr style="margin-top:10px !important;" />	
	<h4>
		<em><?php echo $match_details['home']; ?></em> 
		<small>(<?php echo ( $match_details['home_accept'] == 0 ? '<span class="text-danger">unaccepted</span>' : '<span class="text-success bolder">accepted</span>' ); ?>)</small>	
		vs 
		<em><?php echo $match_details['away']; ?></em>
		<small>(<?php echo ( $match_details['away_accept'] == 0 ? '<span class="text-danger">unaccepted</span>' : '<span class="text-success bolder">accepted</span>' ); ?>)</small>
	</h4>
<?php } ?>
</div>
<div class="col-md-5">
<?php 

	if( $match_details['home_accept'] == 1 && $match_details['away_accept'] == 1) {
		include('tpls/settings/tournaments/view-match-admin-score.php');
		include('tpls/settings/tournaments/view-match-admin-screenshot.php');
	}

	if( $match_details['status'] == '0' ) {
			if( $match_details['home_id'] == $profile['guild_id'] ) { 
				$match_side = 'homeTeam_accept';
			} else {
				$match_side = 'awayTeam_accept';
			}
			
			include('tpls/settings/tournaments/view-match-admin-details.php');
				
	} 
?>
</div>	
	<div class="col-md-7">
		<form id="matchInformation" method="POST" role-"form">
		<h4>Match Information</h4>
		<div class="form-group">
			<label>Server IP</label>
			<input type="text" id="match-server-ip" class="form-control" value="<?php echo $match_details['server_ip']; ?>" />
		</div>
		<div class="form-group">
			<label>Server Password</label>
			<input type="text" id="match-server-password" class="form-control" value="<?php echo $match_details['server_password']; ?>" />
		</div>
		<div class="form-group">
			<label>Match Moderator</label>
			<input type="text" id="match-server-moderator" class="form-control" value="<?php echo $match_details['moderator']; ?>" />
		</div>
		<div class="form-group">
 			<button type="submit" class="btn btn-success">Update Information</button>
 		</div>
		</form>

		<form id="matchChat" method="POST" role="form" disabled>
		<h4>Chat Log</h4>
		 <input type="hidden" id="log-id" value="<?php echo $match_details['id']; ?>" />
		 <input type="hidden" id="log-username" value="<?php echo $profile['username']; ?>" />
		 <div class="form-group">
		 	<textarea id="log-message" class="form-control"></textarea>
		 </div>
		 <div class="form-group">
		 	<button type="submit" class="btn btn-success">Add Message</button>
		 </div>
		 <div class="form-group">
		 	<?php 
		 		$chat = (array) json_decode( $match_details['chat'], TRUE ); 
		 		foreach( $chat as $message ) {
					echo '<p><em>' . $message['date'] . '</em><br><strong>' . $message['username'] . '</strong>: ' . $message['message'] . '</p>';
		 		}
		 	?>
		 </div>
		</form>
	</div>

<div id="delete-screenshot-confirm" title="Delete match screenshot?" style="display:none;">
	<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Confirm deleting match screenshot.</p>
</div>	
<!-- DISPUTE MODAL -->
<div class="modal fade" id="disputeMatch" tabindex="-1" role="basic" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h4 class="modal-title">Match Dispute (<?php echo $match_details['home_team'] . ' vs ' . $match_details['away_team']; ?>)</h4>
			</div>
			<div class="modal-body">
				 <form role="form" id="disputeMatch" method="POST">
				  <input type="hidden" id="dispute-match-id" value="<?php echo $match_details['id']; ?>" />
				  <input type="hidden" id="dispute-reporter" value="<?php echo $profile['username']; ?>" />
		            <div class="form-group">
		              <h5>Reason for Dispute</h5>
		              <textarea class="form-control" id="dispute-reason" rows="5" cols="10"></textarea>
		            </div>
		            <div class="form-group">
		              <h5>Category</h5>
		              <select id="dispute-category" class="form-control">
		              	<option>Select Category</option>
		              	<option value="cheating">Cheating</option>
		              	<option value="player">Non-Roster Player</option>
		              	<option value="other">Other</option>
		              </select>
		            </div>
		         	<div class="success dispute">
					 <span class="success_text"></span>
					</div>
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-primary">Report Dispute</button>
		        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		    </div> 
		     	</form>
		</div>
	</div>
</div>
<!-- ./DISPUTE MODAL -->