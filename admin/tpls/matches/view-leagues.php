<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">View League Matches</h1>
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
                                <th>Total Matches</th>
                                <th>Current Season</th>
                            </tr>
                        </thead>
            <?php $leagues = $ez_league->get_all_leagues(); ?>
                        <tbody>
              <?php foreach( $leagues as $league ) {
                     $total_teams = $ez_league->get_total_teams( $league['lid'] ); 
                     $current_season = $ez_league->get_current_season( $league['lid'] );
                     $total_matches = $ez_match->count_league_matches( $league['lid'] );
              ?>
                            <tr>
                                <td><a href="matches.php?page=view&id=<?php echo $league['lid']; ?>"><?php echo $league['league']; ?></a></td>
                                <td><?php echo $total_matches; ?></td>
                                    <?php 
                                    	if( $current_season ) {
                                    		echo "<td style='background:#E4E4E4;'>Season " . $current_season['season'] . '</td>';
                                    	} else {
                                    		echo "<td></td>";
                                    	}
                                    ?>
                                <td>
                                	<a <?php echo ($total_matches == 0 ? 'disabled' : '' ); ?> class="btn btn-primary btn-xs" href="matches.php?page=view&id=<?php echo $league['lid']; ?>">
                                    	View Matches
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