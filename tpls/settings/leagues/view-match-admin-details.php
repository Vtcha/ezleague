<h4>Match Details</h4>
<form id="matchDetails" method="POST" role="form">
 <input type="hidden" id="match-id" value="<?php echo $match_details['id']; ?>" />
 <input type="hidden" id="match-team" value="<?php echo $profile['guild_id']; ?>" />
 <input type="hidden" id="match-side" value="<?php echo $match_side; ?>" />
 <div class="form-group">
 	<label class="control-label">Match Date</label>
 	<input id="match-date" type="text" class="form-control" value="<?php echo $match_details['date']; ?>" />
 </div>
 <div class="form-group">
 	<label class="control-label">Match Time [24-hour Format] <small>(ex: 15:37)</small></label>
 	<input id="match-time" type="text" class="form-control" value="<?php echo $match_details['time']; ?>" />
 </div>
 <div class="form-group">
 	<label class="control-label">Match Zone</label>
 	<select id="match-zone" class="form-control">
 	 <option value=""></option>
 	 <option <?php echo ( $match_details['zone'] == 'EST' ? 'selected' : '' ); ?> value="EST">Eastern Standard (EST)</option>
 	 <option <?php echo ( $match_details['zone'] == 'CST' ? 'selected' : '' ); ?> value="CST">Central Standard (CST)</option>
 	 <option <?php echo ( $match_details['zone'] == 'MST' ? 'selected' : '' ); ?> value="MST">Mountain Standard (MST)</option>
 	 <option <?php echo ( $match_details['zone'] == 'PST' ? 'selected' : '' ); ?> value="PST">Pacific Standard (PST)</option>
 	</select>
 </div>
 <div class="form-group">
 	<label class="control-label">Stream URL</label>
 	<input type="text" class="form-control" id="match-stream-url" value="<?php echo $match_details['stream_url']; ?>" />
 </div>
 <div class="form-group">
 	<button type="submit" class="btn btn-success">Update Details</button>
 <?php 
	 if( $match_details['home_id'] == $profile['guild_id'] ) {
	 	if( $match_details['home_accept'] == 0 ) { ?>
	 		<button type="button" id="acceptDetails" class="btn btn-primary">Accept</button>
<?php 	} else { ?>
	 		<button type="button" id="rejectDetails" class="btn btn-danger">Reject</button>
<?php  	}
	 } else {
	 	if( $match_details['away_accept'] == 0 ) { ?>
	 		<button type="button" id="acceptDetails" class="btn btn-primary">Accept</button>
<?php  	} else { ?>
	 		<button type="button" id="rejectDetails" class="btn btn-danger">Reject</button>
<?php  	}
	 }
 ?>
 </div>
</form>