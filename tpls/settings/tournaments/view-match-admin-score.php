<h4>Match Score</h4>
	<form id="tournamentMatchReport" method="POST" role="form">
	 <input type="hidden" id="match-id" value="<?php echo $match_details['id']; ?>" />
	 <input type="hidden" id="match-home-team" value="<?php echo $match_details['home_id']; ?>" />
	 <input type="hidden" id="match-away-team" value="<?php echo $match_details['away_id']; ?>" />
	 <input type="hidden" id="match-reporter" value="<?php echo $profile['username']; ?>" />
	 <div class="form-group col-lg-12">
	 	<label class="control-label">Reported By <span class="text-primary"><?php echo $match_details['reporter']; ?></span></label>
	 </div>
	 <div class="form-group col-lg-12">
	 	<label class="control-label"><em><?php echo $match_details['home']; ?></em></label>
	 	<div class="col-lg-6">
	 		<input <?php echo ( $match_details['dispute'] == 'pending' ? 'disabled' : '' ); ?> id="match-home-score" type="text" class="form-control" value="<?php echo $match_details['home_score']; ?>" />
	 	</div>
	 </div>
	 <div class="form-group  col-lg-12">
	 	<label class="control-label"><em><?php echo $match_details['away']; ?></em></label>
	 	<div class="col-lg-6">
	 		<input <?php echo ( $match_details['dispute'] == 'pending' ? 'disabled' : '' ); ?> id="match-away-score" type="text" class="form-control" value="<?php echo $match_details['away_score']; ?>" />
	 	</div>
	 </div>
	 <div class="form-group">
	 <small>* Scores cannot be modified while a match dispute is pending</small>
	 	<button <?php echo ( $match_details['dispute'] == 'pending' ? 'disabled' : '' ); ?> type="submit" class="btn btn-success">Submit</button>
<?php if( $match_details['status'] == 1 ) { ?>
		<a href="#disputeMatch" <?php echo ( $match_details['dispute'] == 'pending' ? 'disabled' : '' ); ?> class="btn btn-danger" data-toggle="modal">Dispute Match</a>
<?php } ?>
	 </div>
	</form>