<?php session_start();
date_default_timezone_set('America/Chicago');
include('../class-db.php');
include('../objects/class-tournament.php');

$ez_tournament = new ezAdmin_Tournament();
    
     if(!isset($_SESSION['ez_admin'])) {
        header("Location: login.php");
     } else {
        $username = $_SESSION['ez_admin'];
     }
if( isset( $_POST['form'] ) && isset( $_POST['tournament_id'] ) && isset( $_POST['team_id'] ) ) {
    $form = trim( $_POST['form'] );
    $tournament_id  = trim( $_POST['tournament_id'] );
    $team_id        = trim( $_POST['team_id'] );

        if( $form == 'add-tournament-team' ) {

            $ez_tournament->register_tournament_team( $team_id, $tournament_id );

            $tournament_teams = $ez_tournament->get_tournament_teams( $tournament_id );
        ?>

                <table class="table table-hover tournament-teams">
                    <thead>
                        <tr>
                            <th>Team</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
          <?php foreach( $tournament_teams as $team ) { ?>
                        <tr>
                            <td><?php echo $team['guild']; ?></td>
                            <td><button type="button" onclick="kickTeam('<?php echo $team['id']; ?>', '<?php echo $tournament['id']; ?>')" class="btn btn-danger btn-xs">Kick Team</button></td>
                        </tr>
           <?php } ?>
                    </tbody>
                </table>

  <?php } ?>
<?php
    }
?>