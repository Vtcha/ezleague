<?php $teams = $ez_tournament->get_tournament_teams( $tournament_id ); ?>
<?php $current_teams_amount = count( $teams ); ?>
<div class="panel panel-default">
    <div class="panel-heading">
        <i class="fa fa-sitemap"></i> <span class="tournament-teams-heading" data-max-teams="<?php echo $max_teams; ?>">Tournament Teams (<?php echo $current_teams_amount . ' of ' . $max_teams; ?>)</span>
        <?php if( $public == 0 ) { ?>
                <div class="pull-right">
                    <button <?php echo ( $current_teams_amount == $max_teams ? 'disabled' : '' ); ?> onclick="getAvailableTournamentTeams('<?php echo $tournament_id; ?>');" data-toggle="modal" data-target="#addTournamentTeamsModal" class="btn btn-info btn-xs tournament-add-team">Add Teams</button>
                </div>
        <?php } ?>
    </div>
    <div class="panel-body">
        <div class="table-responsive">
        <?php if( $teams ) { ?>
            <table class="table table-hover tournament-teams">
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
            <?php if( $public == 0 ) { ?>
                    No teams have been added to this tournament
        <?php     } else { ?>
                    Sorry, no teams have registered for this tournament yet
        <?php     } ?>
        <?php } ?>
                <div class="success team">
                  <span class="success_text team_text"></span>
                </div>
            </div>
    </div>
</div>