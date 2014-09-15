<div class="col-md-12">
<span class="text-success"><strong>NOTE</strong> both teams must <em>accept</em> the match details below before reporting match outcome</span>
<hr style="margin-top:10px !important;" />	
	<h4>
		<em><?php echo $match_details['home_team']; ?></em> 
		<small>(<?php echo ( $match_details['home_accept'] == 0 ? '<span class="text-danger">unaccepted</span>' : '<span class="text-success bolder">accepted</span>' ); ?>)</small>	
		vs 
		<em><?php echo $match_details['away_team']; ?></em>
		<small>(<?php echo ( $match_details['away_accept'] == 0 ? '<span class="text-danger">unaccepted</span>' : '<span class="text-success bolder">accepted</span>' ); ?>)</small>
	</h4>
</div>
	<div class="col-md-4">
		<?php if( $match_details['status'] == '1' ) { ?>
		Match Completed
		<?php } else {
				include('tpls/settings/leagues/view-match-user-details.php');
			  } ?>
	</div>
	<div class="col-md-8">
		<h4>Match Information</h4>
		<div class="form-group">
			<label>Server IP</label>
			<input disabled type="text" id="match-server-ip" class="form-control" value="<?php echo $match_details['server_ip']; ?>" />
		</div>
		<div class="form-group">
			<label>Server Password</label>
			<input disabled type="text" id="match-server-password" class="form-control" value="<?php echo $match_details['server_password']; ?>" />
		</div>
		<?php $match_roster = $ez_league->get_match_rosters( $match_details['league_id'], $match_details['home_id'], $match_details['away_id'] ); ?>
		<div class="form-group">
			<label>Match Moderator</label>
			<select id="match-server-moderator" class="form-control" disabled>
				<option>- Select Moderator</option>
			<?php if( $match_roster ) { ?>
			<?php foreach( $match_roster as $username ) { ?>
				<option <?php echo ( $match_details['moderator'] == $username['username'] ? 'selected' : '' ); ?> value="<?php echo $username['username']; ?>"><?php echo $username['username']; ?></option>
			<?php } ?>
			<?php } ?>
			</select>
		</div>

		<h4>Chat Log</h4>
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