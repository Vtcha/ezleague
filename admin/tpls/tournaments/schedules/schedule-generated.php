<div class="panel panel-default">
<div class="panel-heading">
    <i class="fa fa-file-o"></i> Generated Schedule (Week <?php echo $_GET['week']; ?>)</em>
</div>
<div class="panel-body">
  <?php 
    $week = trim( $_GET['week'] );
    $random_teams = $ez_league->get_league_random_teams( $league_id );
    shuffle( $random_teams );
    shuffle( $random_teams );
    $total_matchups = ( $total_teams / 2 );
    $y=$total_teams-1;
    for( $i=0; $i<=$total_matchups-1; $i++ ) {
      
       $home = $i;
       $away = $y;
       echo "<p>";
       echo $random_teams[$home]['guild'] . " vs " . $random_teams[$away]['guild'] . "<br>";
       $ez_schedule->match_exists($random_teams[$home]['guild'], $random_teams[$home]['id'], $random_teams[$away]['guild'], $random_teams[$away]['id'], $league_id, $current_season, $week);
 echo "</p>";
       $y=$y-1;
 
    }
  ?>
    <hr/>
    <a href="leagues.php?page=schedule&id=<?php echo $league_id; ?>" class="btn btn-success">Approve Matches</a>
    <a href="leagues.php?page=schedule&id=<?php echo $league_id; ?>&week=<?php echo $week; ?>&a=reject" class="btn btn-danger">Reject</a>
  
</div>
</div>