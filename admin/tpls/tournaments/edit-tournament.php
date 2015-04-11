<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Edit Tournament</h1>
    </div>
</div>
<div class="row">
    <div class="col-lg-4">
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-file-o"></i> Edit Tournament Details
            </div>
            <div class="panel-body">
            <?php if( isset( $_GET['id'] ) && $_GET['id'] != '' ) { 
                    $tournament_id = $_GET['id'];
                     $tournament = $ez_tournament->get_tournament( $tournament_id );
             ?>
                <div class="row">
                    <div class="col-lg-12">
                     <form method="POST" id="editTournament">
                      <input type="hidden" id="tournament-id" value="<?php echo $tournament_id; ?>" />
                        <div class="form-group">
                            <label>Type <small>(only single elimination is currently available)</small></label>
                            <input disabled class="form-control" id="type" placeholder="Single Elimination" value="Single Elimination" />
                        </div>
                        <div class="form-group">
                            <label>Tournament</label>
                            <input class="form-control" id="tournament" value="<?php echo $tournament['tournament']; ?>" placeholder="Tournament Name" />
                        </div>
                        <div class="form-group">
                            <label>Status</label>
                            <select class="form-control" id="status">
                                <option <?php echo ( $tournament['status'] == 1 ? 'selected' : '' ); ?> value="1">Running</option>
                                <option <?php echo ( $tournament['status'] == 0 ? 'selected' : '' ); ?> value="0">Closed</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Max Teams</label>
                            <select class="form-control" id="max-teams">
                                <option <?php echo ( $tournament['teams'] == 4 ? 'selected' : '' ); ?> value="4">4</option>
                                <option <?php echo ( $tournament['teams'] == 8 ? 'selected' : '' ); ?> value="8">8</option>
                                <option <?php echo ( $tournament['teams'] == 16 ? 'selected' : '' ); ?> value="16">16</option>
                                <option <?php echo ( $tournament['teams'] == 32 ? 'selected' : '' ); ?> value="32">32</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Format</label>
                            <select class="form-control" id="format">
                             <?php for( $i=1; $i <= 16; $i = $i + 1 ) { ?>
                                <option <?php echo ( $tournament['format'] == $i ? 'selected' : '' ); ?> value="<?php echo $i . 'v' . $i; ?>"><?php echo $i . 'v' . $i; ?></option>
                             <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Game</label>
                            <select disabled class="form-control" id="game">
                                <option></option>
                             <?php $games = $ez_settings->get_settings_game(); ?>
                              <?php foreach( $games as $game ) { ?> 
                                <option <?php echo ( $tournament['game'] == $game['slug'] ? 'selected' : '' ); ?> value="<?php echo $game['game']; ?>"><?php echo $game['game']; ?></option>
                              <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Start Date</label>
                            <input class="form-control" id="start" value="<?php echo $tournament['start_date']; ?>" placeholder="Start Date" />
                        </div>
                        <div class="form-group">
                            <label>Registration End Date</label>
                            <input class="form-control" id="registration" value="<?php echo $tournament['registration']; ?>" placeholder="Registration End Date" />
                        </div>
                        <div class="form-group">
                            <button class="btn btn-success" type="submit">Edit Tournament</button>
                            <button class="btn btn-warning" type="reset">Reset</button>
                        </div>
                        <div class="success">
                          <span class="success_text"></span>
                        </div>
                      </form>
                    </div>
                </div>
		<?php } else { ?>
		<h3>Not a valid tournament id</h3>
		<?php } ?>                
            </div>
        </div>
    </div>
    <div class="col-lg-8">
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-sitemap"></i> Tournament Teams
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                <?php $teams = $ez_tournament->get_tournament_teams( $tournament_id ); ?>
                <?php if( $teams ) { ?>
                    <table class="table table-hover current_leagues">
                        <thead>
                            <tr>
                                <th>Team</th>
                                <th>Options</th>
                            </tr>
                        </thead>
                        <tbody>
            <?php foreach( $teams as $team ) { ?>
                            <tr>
                                <td><?php echo $team['guild']; ?></td>
                                <td>
                                    <button type="button" onclick="kickTeam('<?php echo $team['id']; ?>', '<?php echo $tournament['id']; ?>')" class="btn btn-danger btn-xs">Kick Team</button>
                                </td>
                            </tr>
            <?php } ?>
                        </tbody>
                     </table>
                <?php } else { ?>
                    Sorry, no open tournaments were found, try <a href="tournaments.php?page=create">creating one</a>
                <?php } ?>
                        <div class="success team">
                          <span class="success_text team_text"></span>
                        </div>
                    </div>
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-sitemap"></i> Tournament Bracket
                <?php 
                    $round_1_started    = $ez_tournament->check_if_started( $tournament_id );
                    if( $round_1_started == false ) { ?>
                        <div class="pull-right">
                            <button id="generateRound1Matches" style="margin-right:5px;" data-tournament-id="<?php echo $tournament_id; ?>" data-tournament-teams="<?php echo $tournament['teams']; ?>" class="btn btn-primary btn-xs">Generate Round 1 Matchups</a>
                            <button id="clearRound1Matches" class="btn btn-warning btn-xs" style="display:none;">Clear Matches</button> 
                        </div>
                <?php 
                    } else {
                        $round_1_completed = $ez_tournament->check_if_round_completed( $tournament_id, '1' );
                        if( $round_1_completed ) {
                        ?>
                            <div class="pull-right">
                                <button id="generateRound2Matches" style="margin-right:5px;" data-tournament-id="<?php echo $tournament_id; ?>" class="btn btn-primary btn-xs">Generate Round 2 Matchups</a>
                            </div>
                        <?php
                        }
                    } 
                ?>
            </div>
            <div class="panel-body">
            <small>* <em>Round 1</em> matchups can be generated up until a <em>Round 1</em> Match has been completed</small>
            <?php
                $max_teams = $tournament['teams'];
                switch( $max_teams ) {
                    case 4:
                        include( 'tpls/tournaments/brackets/view-tournament-bracket-04.php' );
                        break;
                    case 8:
                        include( 'tpls/tournaments/brackets/view-tournament-bracket-08.php' );
                        break;
                    case 16:
                        include( 'tpls/tournaments/brackets/view-tournament-bracket-16.php' );
                        break;
                    case 32:
                        include( 'tpls/tournaments/brackets/view-tournament-bracket-32.php' );
                        break;
                    default:
                        break;
                }
                
            ?>
            </div>
        </div>
     </div>
    </div>