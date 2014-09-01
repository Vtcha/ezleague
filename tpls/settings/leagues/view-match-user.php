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