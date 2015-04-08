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
     
//get an individual league season item
if(isset($_POST['tournament_id'])) {
    $team_id   = trim( $_POST['team_id'] );
    $tournament_id = trim( $_POST['tournament_id'] );
    $tournament_max_teams = trim( $_POST['max_teams'] );
    $teams = $ez_tournament->get_tournament_teams( $tournament_id );
    shuffle( $teams );
?>

    <li class="spacer">&nbsp;</li>
    <!-- wrap score inside span element -->
    <li class="game game-top"><?php echo $teams[0]['guild']; ?></li>
    <li class="game game-spacer">&nbsp;</li>
    <li class="game game-bottom "><?php echo $teams[1]['guild']; ?></li>

    <li class="spacer">&nbsp;</li>
    
    <li class="game game-top"><?php echo $teams[2]['guild']; ?></li>
    <li class="game game-spacer">&nbsp;</li>
    <li class="game game-bottom "><?php echo $teams[3]['guild']; ?></li>

    <li class="spacer">&nbsp;</li>
    <?php if( $tournament_max_teams >= 8 ) { ?>
    <li class="game game-top "><?php echo $teams[4]['guild']; ?></li>
    <li class="game game-spacer">&nbsp;</li>
    <li class="game game-bottom"><?php echo $teams[5]['guild']; ?></li>

    <li class="spacer">&nbsp;</li>
    
    <li class="game game-top"><?php echo $teams[6]['guild']; ?></li>
    <li class="game game-spacer">&nbsp;</li>
    <li class="game game-bottom "><?php echo $teams[7]['guild']; ?></li>

    <li class="spacer">&nbsp;</li>
    <?php } 

    if( $tournament_max_teams >= 16 ) { ?>
    <li class="game game-top "><?php echo $teams[8]['guild']; ?></li>
    <li class="game game-spacer">&nbsp;</li>
    <li class="game game-bottom"><?php echo $teams[9]['guild']; ?></li>

    <li class="spacer">&nbsp;</li>
    
    <li class="game game-top"><?php echo $teams[10]['guild']; ?></li>
    <li class="game game-spacer">&nbsp;</li>
    <li class="game game-bottom "><?php echo $teams[11]['guild']; ?></li>

    <li class="spacer">&nbsp;</li>

    <li class="game game-top "><?php echo $teams[12]['guild']; ?></li>
    <li class="game game-spacer">&nbsp;</li>
    <li class="game game-bottom"><?php echo $teams[13]['guild']; ?></li>

    <li class="spacer">&nbsp;</li>
    
    <li class="game game-top"><?php echo $teams[14]['guild']; ?></li>
    <li class="game game-spacer">&nbsp;</li>
    <li class="game game-bottom "><?php echo $teams[15]['guild']; ?></li>

    <li class="spacer">&nbsp;</li>

    <?php } 

    if( $tournament_max_teams >= 32 ) { ?>
    <li class="game game-top "><?php echo $teams[16]['guild']; ?></li>
    <li class="game game-spacer">&nbsp;</li>
    <li class="game game-bottom"><?php echo $teams[17]['guild']; ?></li>

    <li class="spacer">&nbsp;</li>
    
    <li class="game game-top"><?php echo $teams[18]['guild']; ?></li>
    <li class="game game-spacer">&nbsp;</li>
    <li class="game game-bottom "><?php echo $teams[19]['guild']; ?></li>

    <li class="spacer">&nbsp;</li>

    <li class="game game-top "><?php echo $teams[20]['guild']; ?></li>
    <li class="game game-spacer">&nbsp;</li>
    <li class="game game-bottom"><?php echo $teams[21]['guild']; ?></li>

    <li class="spacer">&nbsp;</li>
    
    <li class="game game-top"><?php echo $teams[22]['guild']; ?></li>
    <li class="game game-spacer">&nbsp;</li>
    <li class="game game-bottom "><?php echo $teams[23]['guild']; ?></li>

    <li class="spacer">&nbsp;</li>

    <li class="game game-top "><?php echo $teams[24]['guild']; ?></li>
    <li class="game game-spacer">&nbsp;</li>
    <li class="game game-bottom"><?php echo $teams[25]['guild']; ?></li>

    <li class="spacer">&nbsp;</li>
    
    <li class="game game-top"><?php echo $teams[26]['guild']; ?></li>
    <li class="game game-spacer">&nbsp;</li>
    <li class="game game-bottom "><?php echo $teams[27]['guild']; ?></li>

    <li class="spacer">&nbsp;</li>

    <li class="game game-top "><?php echo $teams[28]['guild']; ?></li>
    <li class="game game-spacer">&nbsp;</li>
    <li class="game game-bottom"><?php echo $teams[29]['guild']; ?></li>

    <li class="spacer">&nbsp;</li>
    
    <li class="game game-top"><?php echo $teams[30]['guild']; ?></li>
    <li class="game game-spacer">&nbsp;</li>
    <li class="game game-bottom "><?php echo $teams[31]['guild']; ?></li>

    <li class="spacer">&nbsp;</li>

    <?php } ?>
<?php } ?>