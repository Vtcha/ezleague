<div class="panel panel-default">
    <div class="panel-heading">
        <i class="fa fa-sitemap"></i> Closed Tournaments
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