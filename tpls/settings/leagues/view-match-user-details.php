<h4>Match Details</h4>
<div class="form-group">
	<label class="control-label">Match Date</label><br/>
	<?php echo date( 'F d, Y', strtotime( $match_details['date'] ) ); ?>
</div>
<div class="form-group">
	<label class="control-label">Match Time [24-hour Format]</label><br/>
	<?php echo $match_details['time']; ?> <?php echo $match_details['zone']; ?>
</div>