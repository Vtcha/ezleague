<div class="panel panel-default">
    <div class="panel-heading">
        <i class="fa fa-sitemap"></i> Completed Tournaments
    </div>
    <div class="panel-body">
        <div class="table-responsive">
    <?php $tournaments = $ez_tournament->get_closed_tournaments(); ?>
    <?php if( $tournaments ) { ?>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Game</th>
                        <th>Name</th>
                        <th>Total Teams</th>
                        <th>Champion</th>
                        <th>Runner Up</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
      <?php foreach( $tournaments as $tournament ) {
             $total_teams           = $ez_tournament->get_total_teams( $tournament['tid'] ); 
             $tournament_champion   = $ez_tournament->get_tournament_champion( $tournament['tid'] );
             $tournament_runner_up  = $ez_tournament->get_tournament_runner_up( $tournament['tid'] );
      ?>
                    <tr>
                        <td><a href="tournaments.php?page=edit&id=<?php echo $tournament['tid']; ?>"><?php echo $tournament['ggame']; ?></a></td>
                        <td><?php echo $tournament['tournament']; ?></td>
                        <td><?php echo $total_teams; ?></td>
                        <td><?php echo $tournament_champion['guild']; ?></td>
                        <td><?php echo $tournament_runner_up['guild']; ?></td>
                        <td>
                            <a href="tournaments.php?page=edit&id=<?php echo $tournament['tid']; ?>" class="btn btn-success btn-xs">Edit / View</a>
                        </td>
                    </tr>
       <?php } ?>
                </tbody>
             </table>
    <?php } else { ?>
        Sorry, no tournaments have completed yet.
    <?php } ?>
         </div>
    </div>
</div>