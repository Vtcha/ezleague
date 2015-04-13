<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Create Tournament</h1>
    </div>
</div>
<div class="row">
    <div class="col-lg-4">
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-file-o"></i> Create New Tournament
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
                     <form method="POST" id="createTournament">
                        <div class="form-group">
                            <label>Type <small>(only single elimination is currently available)</small></label>
                            <input disabled class="form-control" id="type" placeholder="Single Elimination" value="Single Elimination" />
                        </div>
                        <div class="form-group">
                            <label>Name</label>
                            <input class="form-control" id="tournament" placeholder="Tournament Name" />
                        </div>
                        <div class="form-group">
                            <label>Public or Private</label>
                            <select class="form-control" id="public">
                                <option value="1" selected>Public</option>
                                <option value="0">Private</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Max Teams</label>
                            <select class="form-control" id="max-teams">
                                <option value="4">4</option>
                                <option value="8">8</option>
                                <option value="16">16</option>
                                <option value="32">32</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Format</label>
                            <select class="form-control" id="format">
                             <?php for( $i=1; $i <= 16; $i = $i + 1 ) { ?>
                                <option <?php echo ( $i == 5 ? 'selected' : '' ); ?> value="<?php echo $i . 'v' . $i; ?>"><?php echo $i . 'v' . $i; ?></option>
                             <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Game</label>
                            <select class="form-control" id="game">
                                <option></option>
                             <?php $games = $ez_settings->get_settings_game(); ?>
                              <?php foreach( $games as $game ) { ?> 
                                <option value="<?php echo $game['slug']; ?>"><?php echo $game['game']; ?></option>
                              <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Start Date</label>
                            <input class="form-control" id="start" placeholder="Start Date" />
                        </div>
                        <div class="form-group">
                            <label>Registration End Date</label>
                            <input class="form-control" id="registration" placeholder="Registration End Date" />
                        </div>
                        <div class="form-group">
                            <button class="btn btn-success" type="submit">Create Tournament</button>
                        </div>
                        <div class="success">
                          <span class="success_text"></span>
                        </div>
                      </form>
                    </div>
                </div>               
            </div>
        </div>
    </div>
    <div class="col-lg-8">
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