<div class="panel panel-default">
  <div class="panel-heading">
      <i class="fa fa-file-o"></i> Matches Rejected</em>
  </div>
  <div class="panel-body">
     <h3>Matches have been rejected. Please regenerate.</h3>
  </div>
</div>
	
	<?php 
		$total_matchups = ( $total_teams / 2 );
		$ez_schedule->delete_generated_matches( $total_matchups );
	?>