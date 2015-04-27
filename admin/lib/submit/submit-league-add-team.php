<?php session_start();
date_default_timezone_set('America/Chicago');
include('../class-db.php');
include('../objects/class-league.php');

$ez_league = new ezAdmin_League();
    
     if(!isset($_SESSION['ez_admin'])) {
        header("Location: login.php");
     } else {
        $username = $_SESSION['ez_admin'];
     }
if( isset( $_POST['form'] ) && isset( $_POST['league_id'] ) && isset( $_POST['team_id'] ) ) {
    $form = trim( $_POST['form'] );
    $league_id  = trim( $_POST['league_id'] );
    $league     = $ez_league->get_league( $league_id );
    $team_id    = trim( $_POST['team_id'] );

        if( $form == 'add-league-team' ) {
            $max_teams      = trim( $_POST['max_teams'] );
            $league_teams = $ez_league->get_league_teams( $league_id );
            $current_team_amount = count( $league_teams );
            if( $max_teams != $current_team_amount ) {
                $ez_league->register_league_team( $team_id, $league_id );
            }

            $league_teams = $ez_league->get_league_teams( $league_id );
        ?>

                <table class="table table-hover league-teams">
                    <thead>
                        <tr>
                            <th>Team</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
          <?php foreach( $league_teams as $team ) { ?>
                        <tr>
                            <td><?php echo $team['guild']; ?></td>
                            <td><button type="button" onclick="kickTeam('<?php echo $team['id']; ?>', '<?php echo $league['id']; ?>')" class="btn btn-danger btn-xs">Kick Team</button></td>
                        </tr>
           <?php } ?>
                    </tbody>
                </table>

  <?php } ?>
<?php
    }
?>