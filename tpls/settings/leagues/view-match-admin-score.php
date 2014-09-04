<h4>Match Score</h4>
	<form id="matchReport" method="POST" role="form">
	 <input type="hidden" id="match-id" value="<?php echo $match_details['id']; ?>" />
	 <input type="hidden" id="match-home-team" value="<?php echo $match_details['home_id']; ?>" />
	 <input type="hidden" id="match-away-team" value="<?php echo $match_details['away_id']; ?>" />
	 <input type="hidden" id="match-reporter" value="<?php echo $profile['username']; ?>" />
	 <div class="form-group col-lg-12">
	 	<label class="control-label">Reported By <span class="text-primary"><?php echo $match_details['reporter']; ?></span></label>
	 </div>
	 <div class="form-group col-lg-12">
	 	<label class="control-label"><em><?php echo $match_details['home_team']; ?></em></label>
	 	<div class="col-lg-6">
	 		<input id="match-home-score" type="text" class="form-control" value="<?php echo $match_details['home_score']; ?>" />
	 	</div>
	 </div>
	 <div class="form-group  col-lg-12">
	 	<label class="control-label"><em><?php echo $match_details['away_team']; ?></em></label>
	 	<div class="col-lg-6">
	 		<input id="match-away-score" type="text" class="form-control" value="<?php echo $match_details['away_score']; ?>" />
	 	</div>
	 </div>
	 <div class="form-group">
	 	<button type="submit" class="btn btn-success">Submit</button>
<?php if( $match_details['status'] == 1 ) { ?>
		<a href="#disputeMatch" class="btn btn-danger" data-toggle="modal">Dispute Match</a>
<?php } ?>
	 </div>
	</form>