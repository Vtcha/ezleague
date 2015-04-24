<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Edit Tournament Match</h1>
    </div>
</div>
<div class="row">
<?php $match_details = $ez_tournament->get_tournament_match( $match_id ); ?>
<?php if( $match_details ) { 
        $tournament_details = $ez_tournament->get_tournament( $match_details[0]['tid'] );
        $tournament_max_teams = $tournament_details['teams'];
        $tournament_round = $match_details[0]['round'];
?>
    <div class="col-lg-4">
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-file-o"></i> Edit Tournament Match Details #<?php echo $match_id; ?>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
                     <form method="POST" id="editTournamentMatch">
                      <input type="hidden" id="match-id" value="<?php echo $match_id; ?>" />
                      <input type="hidden" id="home-id" value="<?php echo $match_details[0]['home_team_id']; ?>" />
                      <input type="hidden" id="away-id" value="<?php echo $match_details[0]['away_team_id']; ?>" />
                      <input type="hidden" id="max-teams" value="<?php echo $tournament_max_teams; ?>" />
                      <input type="hidden" id="match-round" value="<?php echo $tournament_round; ?>" />
                      <input type="hidden" id="tournament-id" value="<?php echo $match_details[0]['tid']; ?>" />
                        <div class="form-group">
                            <label>Tournament</label><br/>
                            <a href="tournaments.php?page=edit&id=<?php echo $match_details[0]['tid']; ?>"><?php $ez_tournament->get_tournament_name( $match_details[0]['tid'] ); ?></a>,
                            Round <?php echo $tournament_round; ?>
                            <?php
                                switch( $tournament_max_teams ) {
                                    case 4:
                                        if( $tournament_round == 1 ) { ?>
                                            - <span class="label label-info">Semi-finals</span>
                                  <?php } elseif( $tournament_round == 2 ) { ?>
                                            - <span class="label label-warning">Championship</span>
                                  <?php }
                                        break;
                                    case 8:
                                        if( $tournament_round == 1 ) { ?>
                                            - <span class="label label-primary">Quarter-finals</span>
                                  <?php } elseif( $tournament_round == 2 ) { ?>
                                            - <span class="label label-info">Semi-finals</span>
                                  <?php } elseif( $tournament_round == 3 ) { ?>
                                            - <span class="label label-warning">Championship</span>
                                  <?php }
                                        break;
                                    case 16:
                                        if( $tournament_round == 1 ) { ?>
                                            - <span class="label label-default">Round 1</span>
                                  <?php } elseif( $tournament_round == 2 ) { ?>
                                            - <span class="label label-primary">Quarter-finals</span>
                                  <?php } elseif( $tournament_round == 3 ) { ?>
                                            - <span class="label label-info">Semi-finals</span>
                                  <?php } elseif( $tournament_round == 4 ) { ?>
                                            - <span class="label label-warning">Championship</span>
                                  <?php } 
                                        break;
                                    case 32:
                                        if( $tournament_round == 1 ) { ?>
                                            - <span class="label label-default">Round 1</span>
                                  <?php } elseif( $tournament_round == 2 ) { ?>
                                            - <span class="label label-default">Round 2</span>
                                  <?php } elseif( $tournament_round == 3 ) { ?>
                                            - <span class="label label-primary">Quarter-finals</span>
                                  <?php } elseif( $tournament_round == 4 ) { ?>
                                            - <span class="label label-info">Semi-finals</span>
                                  <?php } elseif( $tournament_round == 5 ) { ?>
                                            - <span class="label label-warning">Championship</span>
                                  <?php }
                                        break;
                                    default:
                                        break;
                                }
                            ?>
                        </div>
                        <div class="form-group">
                            <label>Home Team</label>
                            <input disabled class="form-control" id="home-team" value="<?php echo $match_details[0]['home_team']; ?>" placeholder="Home Team" />
                        </div>
                        <div class="form-group">
                            <label>Home Team Score</label>
                            <input class="form-control" id="home-team-score" value="<?php echo $match_details[0]['home_score']; ?>" placeholder="Home Team Score" />
                        </div>
                        <div class="form-group">
                            <label>Home Team Accepted</label>
                            <select class="form-control" id="home-team-accepted">
                                <option <?php echo ( $match_details[0]['home_accept'] == 0 ? 'selected' : '' ); ?> value="0">Pending</option>
                                <option <?php echo ( $match_details[0]['home_accept'] == 1 ? 'selected' : '' ); ?> value="1">Accepted</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Away Team</label>
                            <input disabled class="form-control" id="away-team" value="<?php echo $match_details[0]['away_team']; ?>" placeholder="Away Team" />
                        </div>
                        <div class="form-group">
                            <label>Away Team Score</label>
                            <input class="form-control" id="away-team-score" value="<?php echo $match_details[0]['away_score']; ?>" placeholder="Away Team Score" />
                        </div>
                        <div class="form-group">
                            <label>Away Team Accepted</label>
                            <select class="form-control" id="away-team-accepted">
                                <option <?php echo ( $match_details[0]['away_accept'] == 0 ? 'selected' : '' ); ?> value="0">Pending</option>
                                <option <?php echo ( $match_details[0]['away_accept'] == 1 ? 'selected' : '' ); ?> value="1">Accepted</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Match Date</label><br/>
                            <?php echo date( 'F d, Y h:ia', strtotime( $match_details[0]['match_date'] ) ); ?>
                        </div>
                        <div class="form-group">
                            <label>Match Status</label>
                            <select class="form-control" id="match-status">
                                <option <?php echo ( $match_details[0]['completed'] == 0 ? 'selected' : '' ); ?> value="0">Pending</option>
                                <option <?php echo ( $match_details[0]['completed'] == 1 ? 'selected' : '' ); ?> value="1">Completed</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-success" type="submit">Edit Match Details</button>
                            <button class="btn btn-warning" type="reset" onclick="location.reload();">Cancel</button>
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
                <i class="fa fa-file-o"></i> Match Chat Log #<?php echo $match_id; ?>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12 match-log">
                     <?php 
                        $chat = (array) json_decode( $match_details['0']['match_log'], TRUE );
                        $chat_reversed = array_reverse( $chat );
                        foreach( $chat_reversed as $message ) {
                            echo '<p><small><em>' . $message['date'] . '</em></small> <strong>' . $message['username'] . '</strong>: ' . $message['message'] . '</p><hr/>';
                        }
                    ?>
                    </div>
                </div>               
            </div>
        </div>
    </div>
<?php } else { ?>
    That match does not exist.
<?php } ?>
</div>