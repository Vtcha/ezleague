<?php 
        if( $current_teams_amount == $max_teams ) {
            $round_1_started    = $ez_tournament->check_if_started( $tournament_id );
            if( $round_1_started == false ) { ?>
                <div class="pull-right">
                    <button id="generateRound1Matches" style="margin-right:5px;" data-tournament-id="<?php echo $tournament_id; ?>" data-tournament-teams="<?php echo $tournament['teams']; ?>" class="btn btn-primary btn-xs">Generate Round 1 Matchups</a></button>
                    <button id="clearRound1Matches" class="btn btn-warning btn-xs" style="display:none;">Clear Matches</button> 
                </div>
        <?php 
            } else {
                $round_1_completed = $ez_tournament->check_if_round_completed( $tournament_id, '1' );

                if( $round_1_completed ) {
                    $round_2_exists    = $ez_tournament->check_if_round_exists( $tournament_id, '2' );
                    if( ! $round_2_exists ) {
                    ?>
                        <div class="pull-right">
                            <button id="generateRound2Matches" style="margin-right:5px;" data-tournament-id="<?php echo $tournament_id; ?>" class="btn btn-primary btn-xs">Generate Round 2 Matchups</a></button>
                        </div>
                <?php
                    } else {
                        $round_2_completed = $ez_tournament->check_if_round_completed( $tournament_id, '2' );
                        if( $round_2_completed ) {
                        	$round_3_exists = $ez_tournament->check_if_round_exists( $tournament_id, '3' );
                        	if( ! $round_3_exists ) {
                            ?>
                                <div class="pull-right">
                                    <button id="generateRound3Matches" style="margin-right:5px;" data-tournament-id="<?php echo $tournament_id; ?>" class="btn btn-primary btn-xs">Generate Round 3 Matchups</a></button>
                                </div> 
                        <?php
                        	} else {
                        		$round_3_completed = $ez_tournament->check_if_round_completed( $tournament_id, '3' );
                        		if( $round_3_completed ) {
                        			$round_4_exists = $ez_tournament->check_if_round_exists( $tournament_id, '4' );
                        			if( ! $round_4_exists ) {
        		                    ?>
        		                        <div class="pull-right">
        		                            <button id="generateRound4Matches" style="margin-right:5px;" data-tournament-id="<?php echo $tournament_id; ?>" class="btn btn-primary btn-xs">Generate Round 4 Matchups</a></button>
        		                        </div> 
        		                <?php
        		                	} else {
        		                		$round_4_completed = $ez_tournament->check_if_round_completed( $tournament_id, '4' );
		                        		if( $round_4_completed ) {
		                        			$round_5_exists = $ez_tournament->check_if_round_exists( $tournament_id, '5' );
		                        			if( ! $round_5_exists ) {
		                        			?>
		                        				<div class="pull-right">
		        		                            <button id="generateRound5Matches" style="margin-right:5px;" data-tournament-id="<?php echo $tournament_id; ?>" class="btn btn-primary btn-xs">Generate Round 5 Matchups</a></button>
		        		                        </div>
		                        		<?php
		                        			}
		                        		}
        		                	}
                        		}
                        	}
                        }
                    }
                }
                
            } 
        } else { ?>
            <div class="pull-right">
                <em><?php echo $max_teams . ' teams needed to generate matches'; ?></em>
            </div>
  <?php } ?>
</div>
<div class="panel-body">
<small>* <em>Round 1</em> matchups can be generated up until a <em>Round 1</em> Match has been completed</small>
	<main id="tournament">
		<ul class="round round-1">
			<?php include( '32/round-1.php' ); ?>
		</ul>
		<ul class="round round-2">
			<?php include( '32/round-2.php' ); ?>
		</ul>
		<ul class="round round-3">
			<?php include( '32/round-3.php' ); ?>
		</ul>
		<ul class="round round-4">
			<?php include( '32/round-4.php' ); ?>
		</ul>
		<ul class="round round-5">
			<?php include( '32/round-5.php' ); ?>
		</ul>
		<ul class="round round-6">
		<?php if( $round4 && $round4[0]['winner'] != 0 ) { ?>
			<?php $champion = $ez_tournament->get_tournament_champion( $tournament_id ); ?>
			<li class="champion-spacer">&nbsp;</li>
			<li class="game game-top champion-team"><?php echo $champion['guild']; ?></li>
			<li class="game spacer champion">Tournament Champion</li>
		<?php } else { ?>
			<li class="spacer">&nbsp;</li>
			<li class="game game-top"></li>
			<li class="game spacer champion">Tournament Champion</li>
		<?php }	?>
		</ul>
	</main>
</div>