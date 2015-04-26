<?php session_start();
date_default_timezone_set('America/Chicago');
include('./lib/class-db.php');
include('./lib/objects/class-tournament.php');

$ez_tournament = new ezAdmin_Tournament();
    
     if(!isset($_SESSION['ez_admin'])) {
     	header("Location: login.php");
     } else {
     	$username = $_SESSION['ez_admin'];
     }
if( isset( $_POST['form'] ) && isset( $_POST['tournament_id'] ) ) {
    $form = trim( $_POST['form'] );
    $tournament_id = trim( $_POST['tournament_id'] );

    if( $form == 'generate-matches' ) {

        $teams = $ez_tournament->get_round_winners( $tournament_id, 1 );
        $total_teams = count( $teams );

    ?>

        <li class="spacer">&nbsp;</li>
        <!-- wrap score inside span element -->
        <li class="game game-top"><?php echo $teams[0]['guild']; ?></li>
        <li class="game game-spacer">&nbsp;</li>
        <li class="game game-bottom "><?php echo $teams[1]['guild']; ?></li>
        <?php $ez_tournament->set_tournament_matchups($tournament_id, $teams[0]['guild'], $teams[0]['guild_id'], $teams[1]['guild'], $teams[1]['guild_id'], '2'); ?>
        <li class="spacer">&nbsp;</li>

        <?php if( $total_teams >= 4 ) { ?>
        <li class="game game-top "><?php echo $teams[2]['guild']; ?></li>
        <li class="game game-spacer">&nbsp;</li>
        <li class="game game-bottom"><?php echo $teams[3]['guild']; ?></li>
        <?php $ez_tournament->set_tournament_matchups($tournament_id, $teams[2]['guild'], $teams[2]['guild_id'], $teams[3]['guild'], $teams[3]['guild_id'], '2'); ?>
        <li class="spacer">&nbsp;</li>
        
        <?php } 

        if( $total_teams >= 8 ) { ?>
        <li class="game game-top "><?php echo $teams[4]['guild']; ?></li>
        <li class="game game-spacer">&nbsp;</li>
        <li class="game game-bottom"><?php echo $teams[5]['guild']; ?></li>
        <?php $ez_tournament->set_tournament_matchups($tournament_id, $teams[4]['guild'], $teams[4]['guild_id'], $teams[5]['guild'], $teams[5]['guild_id'], '2'); ?>
        <li class="spacer">&nbsp;</li>
        
        <li class="game game-top"><?php echo $teams[6]['guild']; ?></li>
        <li class="game game-spacer">&nbsp;</li>
        <li class="game game-bottom "><?php echo $teams[7]['guild']; ?></li>
        <?php $ez_tournament->set_tournament_matchups($tournament_id, $teams[6]['guild'], $teams[6]['guild_id'], $teams[7]['guild'], $teams[7]['guild_id'], '2'); ?>
        <li class="spacer">&nbsp;</li>

        <?php } 

        if( $total_teams >= 16 ) { ?>
        <li class="game game-top "><?php echo $teams[8]['guild']; ?></li>
        <li class="game game-spacer">&nbsp;</li>
        <li class="game game-bottom"><?php echo $teams[9]['guild']; ?></li>
        <?php $ez_tournament->set_tournament_matchups($tournament_id, $teams[8]['guild'], $teams[8]['guild_id'], $teams[9]['guild'], $teams[9]['guild_id'], '2'); ?>
        <li class="spacer">&nbsp;</li>
        
        <li class="game game-top"><?php echo $teams[10]['guild']; ?></li>
        <li class="game game-spacer">&nbsp;</li>
        <li class="game game-bottom "><?php echo $teams[11]['guild']; ?></li>
        <?php $ez_tournament->set_tournament_matchups($tournament_id, $teams[10]['guild'], $teams[10]['guild_id'], $teams[11]['guild'], $teams[11]['guild_id'], '2'); ?>
        <li class="spacer">&nbsp;</li>

        <li class="game game-top "><?php echo $teams[12]['guild']; ?></li>
        <li class="game game-spacer">&nbsp;</li>
        <li class="game game-bottom"><?php echo $teams[13]['guild']; ?></li>
        <?php $ez_tournament->set_tournament_matchups($tournament_id, $teams[12]['guild'], $teams[12]['guild_id'], $teams[13]['guild'], $teams[13]['guild_id'], '2'); ?>
        <li class="spacer">&nbsp;</li>
        
        <li class="game game-top"><?php echo $teams[14]['guild']; ?></li>
        <li class="game game-spacer">&nbsp;</li>
        <li class="game game-bottom "><?php echo $teams[15]['guild']; ?></li>
        <?php $ez_tournament->set_tournament_matchups($tournament_id, $teams[14]['guild'], $teams[14]['guild_id'], $teams[15]['guild'], $teams[15]['guild_id'], '2'); ?>
        <li class="spacer">&nbsp;</li>

        <?php } ?>
<?php
    }
}
?>