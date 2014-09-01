<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">View Leagues</h1>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-file-o"></i> Viewing League
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
             <?php if(isset($_GET['id'])) { 
                    $league_id = $_GET['id'];
                     $league = $ez_league->get_league( $league_id );
                     $season = $ez_league->get_current_season( $league_id );
                      $start_date = strtotime( $league['start_date'] );
                      $now        = strtotime( 'now' );
                      $started = true;
                       if( $start_date > $now ) {
                            $started = false;
                       }
             ?>
                
                <div class="col-lg-6">
                   <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="fa fa-file-o"></i> Details for <em><?php echo $league['league']; ?></em>
                        <div class="pull-right">
                        	<a href="leagues.php?page=edit&id=<?php echo $league['id']; ?>" class="btn btn-primary btn-xs">Edit Details</a>
                        </div>
                    </div>
                    <div class="panel-body">
                        <strong>League</strong> <span class="gm"><?php echo $league['league']; ?></span><br/>
                        <strong>Total Teams</strong> <span class="gm"><?php echo $league['teams']; ?></span><br/>
                        <strong>Game</strong> <span class="gm"><?php echo $league['game']; ?></span><br/>
                        <strong>Start Date</strong> <span class="gm"><?php echo date( 'F d, Y', strtotime( $season['start'] ) ); ?></span><br/>
                        <strong>End Date</strong> <span class="gm"><?php echo date( 'F d, Y', strtotime( $season['end'] ) ); ?></span><br/>
                        <strong>Status</strong> <span class="gm"><?php echo ($league['status'] == 1 ? '<span class=\'text-success bolder\'>Running</span>' : '<span class=\'text-danger\'>Completed</span>'); ?></span><br/>
                    </div>
                   </div>
                   
                   <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="fa fa-bullhorn fa-fw"></i> More
                    </div>
                    <div class="panel-body">
                        <a href="leagues.php?page=rules&id=<?php echo $league['id']; ?>" class="btn btn-success btn-xs btn-block">Rules</a>
                        <a href="leagues.php?page=schedule&id=<?php echo $league['id']; ?>" class="btn btn-primary btn-xs btn-block">Schedule</a>
                        <a href="leagues.php?page=maps&id=<?php echo $league['id']; ?>" class="btn btn-info btn-xs btn-block">Map Rotation</a>
                    </div>
                </div>
                </div>
                
                <div class="col-lg-6">
                   <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="fa fa-file-o"></i> Teams in <em><?php echo $league['league']; ?></em>
                    </div>
                    <div class="panel-body">
                     <?php $teams = $ez_league->get_league_teams($league_id); ?>
                        <div class="table-responsive">
                           <table class="table table-hover">
                            <thead>
                                <tr>
                                  <th>Team</th>
                                  <th></th>
                                </tr>
                            </thead>
                            <tbody>
                             <?php foreach($teams as $team) { ?>
                                <tr>
                                 <td><?php echo $team['guild']; ?></td>
                                 <td>
                                    <a href="teams_view.php?id=<?php echo $team['id']; ?>" class="btn btn-info btn-xs"><i class="fa fa-search"></i> View Team</a>
                                    <button onclick="kickTeam('<?php echo $league_id; ?>', '<?php echo $team['id']; ?>')" data-toggle="modal" data-target="#kickTeamModal" class="btn btn-danger btn-xs"><i class="fa fa-times"></i> Kick Team</button>
                                 </td>
                                </tr>
                             <?php } ?>
                            </tbody>
                           </table>
                         </div>
                        </div>
                       </div>
                    </div>
                </div>
                    <div class="success">
                     <span class="success_text"></span>
                    </div>
              <?php } else { ?>
                No league was selected to view
              <?php } ?>
            </div>
        </div>
    </div>