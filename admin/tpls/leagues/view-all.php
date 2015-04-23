<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">View All Leagues</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-sitemap"></i> Current Leagues
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>League</th>
                                <th>Game</th>
                                <th>Total Teams</th>
                                <th>Max Teams</th>
                                <th>Ssn Start</th>
                                <th>Ssn End</th>
                                <th>Current Season</th>
                                <th></th>
                            </tr>
                        </thead>
            <?php $leagues = $ez_league->get_all_leagues(); ?>
                        <tbody>
              <?php foreach( $leagues as $league ) {
                     $total_teams = $ez_league->get_total_teams( $league['lid'] ); 
                     $current_season = $ez_league->get_current_season( $league['lid'] );
              ?>
                            <tr>
                                <td><a href="leagues.php?page=view&id=<?php echo $league['lid']; ?>"><?php echo $league['league']; ?></a></td>
                                <td><?php echo $league['ggame']; ?></td>
                                <td><?php echo $total_teams; ?></td>
                                <td><?php echo ( $league['teams'] == 5000 ? 'Unlimited' : $league['teams'] ); ?></td>
                                <td><?php 
                                		if( $current_season ) {
                                			echo date( 'F d, Y', strtotime( $current_season['start'] ) ); 
                                		}
                                	?>
                                </td>
                                <td><?php 
                                		if( $current_season ) {
                                			echo date( 'F d, Y', strtotime( $current_season['end'] ) ); 
                                		}
                                	?>
                                </td>
                                    <?php 
                                    	if( $current_season ) {
                                    		echo "<td style='background:#E4E4E4;'><span class='text-success'><strong>Season " . $current_season['season'] . '</strong></span></td>';
                                    	} else {
                                    		echo "<td><span class='text-danger'><em>No Season Found</em></span></td>";
                                    	}
                                    ?>
                                <td>
                                	<a class="btn btn-primary btn-xs" href="leagues.php?page=create_season&id=<?php echo $league['lid']; ?>">
                                    	Create New
                                    </a>
                                </td>
                            </tr>
               <?php } ?>
                        </tbody>
                     </table>
                        <!-- /.table-hover -->
                 </div>
                  <!-- /.table-responsive -->
            </div>
            <!-- /.panel-body -->
        </div>
            <!-- /.panel -->
    </div>
        <!-- /.col-lg-8 -->
</div>
<!-- /.row -->