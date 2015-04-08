<div class="panel panel-default">
<div class="panel-heading">
<?php 
	if( isset( $_GET['wk'] ) && is_numeric( $_GET['wk'] ) ) {
		$wk = trim( $_GET['wk'] );
		$current_schedule = $ez_schedule->get_week_schedule( $league_id, $current_season, $wk );
		$maps			  = $ez_league->get_week_map( $league_id, $wk );
	} else {
		$wk = 0;
		$current_schedule = $ez_schedule->get_schedule( $league_id, $current_season );
		$maps			  = $ez_league->get_league_maps( $league_id );
	} 
?>
    <i class="fa fa-file-o"></i> Current Full Schedule (<?php echo count( $current_schedule ); ?> matches)</em>
</div>
<div class="panel-body">
 	<?php 
 		if( $current_schedule ) { ?>
 		<form id="weekSchedule" name="weekSchedule" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="GET">
 		 <input type="hidden" name="page" value="schedule" />
 		 <input type="hidden" name="id" value="<?php echo $league_id; ?>" />
 			<select name="wk" class="form-control" onchange="this.form.submit()">
 				<option value="full">Full Schedule</option>
 		<?php for ($i=1; $i<=$league['games']; $i++) { ?>
				<option <?php echo ( $wk == $i ? 'selected' : '' ); ?> value="<?php echo $i; ?>">Week <?php echo $i; ?></option>  
		<?php } ?>
 			</select>
 		</form>
 		<div class="table-responsive">
	       <table class="table table-hover">
	        <thead>
	            <tr>
	              <th>Week</th>
	              <th>Home</th>
	              <th>Away</th>
	              <th>Map</th>
	              <th></th>
	            </tr>
	        </thead>
	        <tbody>
	<?php foreach( $current_schedule as $matchup ) { ?>
		<?php $week_map = $ez_league->get_week_map( $league_id, $matchup['week'] ); ?>
	            <tr>
	             <td><strong><?php echo $matchup['week']; ?></strong></td>
	             <td><?php echo $matchup['home_team']; ?></td>
	             <td><?php echo $matchup['away_team']; ?></td>
	             <td><?php echo $week_map; ?></td>
	             <td>
	                <a href="teams_view.php?id=<?php echo $matchup['id']; ?>" class="btn btn-info btn-xs"><i class="fa fa-search"></i> View Details</a>
	             </td>
	            </tr>
	<?php } ?>
	        </tbody>
	       </table>
	     </div>	
 <?php } else { ?>
 	<h3>No match schedules have been generated</h3>
 <?php } ?>
</div>
</div>