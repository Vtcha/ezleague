<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Create League</h1>
    </div>
</div>
<div class="row">
    <div class="col-lg-4">
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-file-o"></i> Create New League
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
                     <form method="POST" id="createLeague">
                        <div class="form-group">
                            <label>League</label>
                            <input class="form-control" id="league" placeholder="League Name" />
                        </div>
                        <div class="form-group">
                            <label>Max Teams</label>
                            <select class="form-control" id="max-teams">
                             <?php for( $i=2; $i <= 64; $i = $i + 2 ) { ?>
                                <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                             <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Total Games</label>
                            <select id="total-games" class="form-control select">
                             <?php for ( $i = 2; $i <= 20; $i = $i + 2 ) { ?>
                                <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                             <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Max Roster</label>
                            <select class="form-control" id="max-roster">
                              <?php for( $i = 1; $i <= 12; $i++ ) { ?> 
                                <option <?php echo ( $i == 8 ? 'selected' : '' ); ?> value="<?php echo $i; ?>"><?php echo $i; ?></option>
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
                            <label>End Date</label>
                            <input class="form-control" id="end" placeholder="End Date" />
                        </div>
                        <div class="form-group">
                            <button class="btn btn-success" type="submit">Create League</button>
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
                <i class="fa fa-sitemap"></i> Current Leagues
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-hover current_leagues">
                        <thead>
                            <tr>
                                <th>League</th>
                                <th>Game</th>
                                <th>Max Teams</th>
                                <th>Options</th>
                            </tr>
                        </thead>
            <?php $leagues = $ez_league->get_all_leagues(); ?>
                        <tbody>
              <?php foreach( $leagues as $league ) { ?>
                            <tr>
                                <td><?php echo $league['league']; ?></td>
                                <td><?php echo $league['ggame']; ?></td>
                                <td><?php echo ($league['teams'] == 5000 ? 'Unlimited' : $league['teams']); ?></td>
                                <td>
                                	<a href="leagues.php?page=edit&id=<?php echo $league['lid']; ?>" class="btn btn-primary btn-xs">Edit</a>
                                    <button type="button" onclick="deleteLeague('<?php echo $league['lid']; ?>')" class="btn btn-danger btn-xs">Delete</button>
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