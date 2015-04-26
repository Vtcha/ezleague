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
        // clear any previously generated matchups first
        $ez_tournament->clear_tournament_matchups( $tournament_id );

        // randomize tournament matchups and store them
        $tournament_max_teams = trim( $_POST['max_teams'] );
        $teams = $ez_tournament->get_tournament_teams( $tournament_id );
        shuffle( $teams );
    ?>

        <li class="spacer">&nbsp;</li>
        <!-- wrap score inside span element -->
        <li class="game game-top"><?php echo $teams[0]['guild']; ?></li>
        <li class="game game-spacer">&nbsp;</li>
        <li class="game game-bottom "><?php echo $teams[1]['guild']; ?></li>
        <?php $ez_tournament->set_tournament_matchups($tournament_id, $teams[0]['guild'], $teams[0]['id'], $teams[1]['guild'], $teams[1]['id'], '1'); ?>
        <li class="spacer">&nbsp;</li>
        
        <li class="game game-top"><?php echo $teams[2]['guild']; ?></li>
        <li class="game game-spacer">&nbsp;</li>
        <li class="game game-bottom "><?php echo $teams[3]['guild']; ?></li>
        <?php $ez_tournament->set_tournament_matchups($tournament_id, $teams[2]['guild'], $teams[2]['id'], $teams[3]['guild'], $teams[3]['id'], '1'); ?>
        <li class="spacer">&nbsp;</li>
        <?php if( $tournament_max_teams >= 8 ) { ?>
        <li class="game game-top "><?php echo $teams[4]['guild']; ?></li>
        <li class="game game-spacer">&nbsp;</li>
        <li class="game game-bottom"><?php echo $teams[5]['guild']; ?></li>
        <?php $ez_tournament->set_tournament_matchups($tournament_id, $teams[4]['guild'], $teams[4]['id'], $teams[5]['guild'], $teams[5]['id'], '1'); ?>
        <li class="spacer">&nbsp;</li>
        
        <li class="game game-top"><?php echo $teams[6]['guild']; ?></li>
        <li class="game game-spacer">&nbsp;</li>
        <li class="game game-bottom "><?php echo $teams[7]['guild']; ?></li>
        <?php $ez_tournament->set_tournament_matchups($tournament_id, $teams[6]['guild'], $teams[6]['id'], $teams[7]['guild'], $teams[7]['id'], '1'); ?>
        <li class="spacer">&nbsp;</li>
        <?php } 

        if( $tournament_max_teams >= 16 ) { ?>
        <li class="game game-top "><?php echo $teams[8]['guild']; ?></li>
        <li class="game game-spacer">&nbsp;</li>
        <li class="game game-bottom"><?php echo $teams[9]['guild']; ?></li>
        <?php $ez_tournament->set_tournament_matchups($tournament_id, $teams[8]['guild'], $teams[8]['id'], $teams[9]['guild'], $teams[9]['id'], '1'); ?>
        <li class="spacer">&nbsp;</li>
        
        <li class="game game-top"><?php echo $teams[10]['guild']; ?></li>
        <li class="game game-spacer">&nbsp;</li>
        <li class="game game-bottom "><?php echo $teams[11]['guild']; ?></li>
        <?php $ez_tournament->set_tournament_matchups($tournament_id, $teams[10]['guild'], $teams[10]['id'], $teams[11]['guild'], $teams[11]['id'], '1'); ?>
        <li class="spacer">&nbsp;</li>

        <li class="game game-top "><?php echo $teams[12]['guild']; ?></li>
        <li class="game game-spacer">&nbsp;</li>
        <li class="game game-bottom"><?php echo $teams[13]['guild']; ?></li>
        <?php $ez_tournament->set_tournament_matchups($tournament_id, $teams[12]['guild'], $teams[12]['id'], $teams[13]['guild'], $teams[13]['id'], '1'); ?>
        <li class="spacer">&nbsp;</li>
        
        <li class="game game-top"><?php echo $teams[14]['guild']; ?></li>
        <li class="game game-spacer">&nbsp;</li>
        <li class="game game-bottom "><?php echo $teams[15]['guild']; ?></li>
        <?php $ez_tournament->set_tournament_matchups($tournament_id, $teams[14]['guild'], $teams[14]['id'], $teams[15]['guild'], $teams[15]['id'], '1'); ?>
        <li class="spacer">&nbsp;</li>

        <?php } 

        if( $tournament_max_teams >= 32 ) { ?>
        <li class="game game-top "><?php echo $teams[16]['guild']; ?></li>
        <li class="game game-spacer">&nbsp;</li>
        <li class="game game-bottom"><?php echo $teams[17]['guild']; ?></li>
        <?php $ez_tournament->set_tournament_matchups($tournament_id, $teams[16]['guild'], $teams[16]['id'], $teams[17]['guild'], $teams[17]['id'], '1'); ?>
        <li class="spacer">&nbsp;</li>
        
        <li class="game game-top"><?php echo $teams[18]['guild']; ?></li>
        <li class="game game-spacer">&nbsp;</li>
        <li class="game game-bottom "><?php echo $teams[19]['guild']; ?></li>
        <?php $ez_tournament->set_tournament_matchups($tournament_id, $teams[18]['guild'], $teams[18]['id'], $teams[19]['guild'], $teams[19]['id'], '1'); ?>
        <li class="spacer">&nbsp;</li>

        <li class="game game-top "><?php echo $teams[20]['guild']; ?></li>
        <li class="game game-spacer">&nbsp;</li>
        <li class="game game-bottom"><?php echo $teams[21]['guild']; ?></li>
        <?php $ez_tournament->set_tournament_matchups($tournament_id, $teams[20]['guild'], $teams[20]['id'], $teams[21]['guild'], $teams[21]['id'], '1'); ?>
        <li class="spacer">&nbsp;</li>
        
        <li class="game game-top"><?php echo $teams[22]['guild']; ?></li>
        <li class="game game-spacer">&nbsp;</li>
        <li class="game game-bottom "><?php echo $teams[23]['guild']; ?></li>
        <?php $ez_tournament->set_tournament_matchups($tournament_id, $teams[22]['guild'], $teams[22]['id'], $teams[23]['guild'], $teams[23]['id'], '1'); ?>
        <li class="spacer">&nbsp;</li>

        <li class="game game-top "><?php echo $teams[24]['guild']; ?></li>
        <li class="game game-spacer">&nbsp;</li>
        <li class="game game-bottom"><?php echo $teams[25]['guild']; ?></li>
        <?php $ez_tournament->set_tournament_matchups($tournament_id, $teams[24]['guild'], $teams[24]['id'], $teams[25]['guild'], $teams[25]['id'], '1'); ?>
        <li class="spacer">&nbsp;</li>
        
        <li class="game game-top"><?php echo $teams[26]['guild']; ?></li>
        <li class="game game-spacer">&nbsp;</li>
        <li class="game game-bottom "><?php echo $teams[27]['guild']; ?></li>
        <?php $ez_tournament->set_tournament_matchups($tournament_id, $teams[26]['guild'], $teams[26]['id'], $teams[27]['guild'], $teams[27]['id'], '1'); ?>
        <li class="spacer">&nbsp;</li>

        <li class="game game-top "><?php echo $teams[28]['guild']; ?></li>
        <li class="game game-spacer">&nbsp;</li>
        <li class="game game-bottom"><?php echo $teams[29]['guild']; ?></li>
        <?php $ez_tournament->set_tournament_matchups($tournament_id, $teams[28]['guild'], $teams[28]['id'], $teams[29]['guild'], $teams[29]['id'], '1'); ?>
        <li class="spacer">&nbsp;</li>
        
        <li class="game game-top"><?php echo $teams[30]['guild']; ?></li>
        <li class="game game-spacer">&nbsp;</li>
        <li class="game game-bottom "><?php echo $teams[31]['guild']; ?></li>
        <?php $ez_tournament->set_tournament_matchups($tournament_id, $teams[30]['guild'], $teams[30]['id'], $teams[31]['guild'], $teams[31]['id'], '1'); ?>
        <li class="spacer">&nbsp;</li>

        <?php } ?>
<?php
    }

    if( $form == 'clear-matches' ) {
        $ez_tournament->clear_tournament_matchups( $tournament_id );
    }
}
?>