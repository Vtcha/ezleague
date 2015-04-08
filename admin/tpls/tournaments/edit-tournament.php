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
                                <option value="5000">Unlimited</option>
                             <?php for( $i=2; $i <= 64; $i = $i + 2 ) { ?>
                                <option <?php echo ( $tournament['teams'] == $i ? 'selected' : '' ); ?> value="<?php echo $i; ?>"><?php echo $i; ?></option>
                             <?php } ?>
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
                                    <button type="button" onclick="kickTeam('<?php echo $team['id']; ?>', '<?php echo $tournament['tid']; ?>')" class="btn btn-danger btn-xs">Kick Team</button>
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

        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-sitemap"></i> Current Tournaments
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                <?php $tournaments = $ez_tournament->get_open_tournaments(); ?>
                <?php if( $tournaments ) { ?>
                    <table class="table table-hover current_leagues">
                        <thead>
                            <tr>
                                <th>Game</th>
                                <th>Tournament</th>
                                <th>Max Teams</th>
                                <th>Start</th>
                                <th>Options</th>
                            </tr>
                        </thead>
                        <tbody>
            <?php foreach( $tournaments as $tournament ) { ?>
                            <tr>
                                <td><?php echo $tournament['ggame']; ?></td>
                                <td><?php echo $tournament['tournament']; ?></td>
                                <td><?php echo ( $tournament['max_teams'] == 5000 ? 'Unlimited' : $tournament['max_teams'] ); ?></td>
                                <td><?php echo date( 'F d, Y', strtotime( $tournament['start_date'] ) ); ?></td>
                                <td>
                                    <a href="tournaments.php?page=edit&id=<?php echo $tournament['tid']; ?>" class="btn btn-primary btn-xs">Edit</a>
                                    <button type="button" onclick="deleteTournament('<?php echo $tournament['tid']; ?>')" class="btn btn-danger btn-xs">Delete</button>
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
     </div>
    </div>