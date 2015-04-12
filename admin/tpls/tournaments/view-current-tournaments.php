<div class="panel panel-default">
    <div class="panel-heading">
        <i class="fa fa-sitemap"></i> Current Tournaments
        <div class="pull-right">
            <a href="tournaments.php?page=create" class="btn btn-primary btn-xs">Create Tournament</a>
        </div>
    </div>
    <div class="panel-body">
        <div class="table-responsive">
    <?php $tournaments = $ez_tournament->get_open_tournaments(); ?>
    <?php if( $tournaments ) { ?>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Game</th>
                        <th>Name</th>
                        <th>Total Teams</th>
                        <th>Max Teams</th>
                        <th>Start</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
      <?php foreach( $tournaments as $tournament ) {
             $total_teams = $ez_tournament->get_total_teams( $tournament['tid'] ); 
      ?>
                    <tr>
                        <td><a href="tournaments.php?page=edit&id=<?php echo $tournament['tid']; ?>"><?php echo $tournament['ggame']; ?></a></td>
                        <td><?php echo $tournament['tournament']; ?></td>
                        <td><?php echo $total_teams; ?></td>
                        <td><?php echo $tournament['max_teams']; ?></td>
                        <td><?php echo date( 'F d, Y', strtotime( $tournament['start_date'] ) ); ?></td>
                        <td>
                            <a href="tournaments.php?page=rules&id=<?php echo $tournament['tid']; ?>" class="btn btn-primary btn-xs">Rules</a>
                            <a href="tournaments.php?page=edit&id=<?php echo $tournament['tid']; ?>" class="btn btn-success btn-xs">Edit / View</a>
                        </td>
                    </tr>
       <?php } ?>
                </tbody>
             </table>
    <?php } else { ?>
        Sorry, no open tournaments were found, try <a href="tournaments.php?page=create">creating one</a>
    <?php } ?>
         </div>
    </div>
</div>