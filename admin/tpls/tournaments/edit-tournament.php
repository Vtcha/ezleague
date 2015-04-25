<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Edit Tournament</h1>
    </div>
</div>
<div class="row">
    <div class="col-lg-4">
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-file-o"></i> Edit Tournament Details
            </div>
            <div class="panel-body">
            <?php if( isset( $_GET['id'] ) && $_GET['id'] != '' ) { 
                    $tournament_id = $_GET['id'];
                     $tournament = $ez_tournament->get_tournament( $tournament_id );
                     $max_teams = $tournament['teams'];
                     $public    = $tournament['public'];
                     $public_text = 'Public';
                     if( $public == 0 ) {
                        $public_text = 'Private';
                     }
             ?>
                <div class="row">
                    <div class="col-lg-12">
                    <?php include( 'tpls/tournaments/edit-tournament-form.php' ); ?>
                    </div>
                </div>
		<?php } else { ?>
		<h3>Not a valid tournament id</h3>
		<?php } ?>                
            </div>
        </div>
    </div>
    <div class="col-lg-8">
        <?php include( 'tpls/tournaments/edit-tournament-teams.php' ); ?>
    </div>
</div>
<div class="row">
    <div class="col-lg-4">
        <?php include( 'tpls/tournaments/edit-tournament-maps.php' ); ?>
    </div>
    <div class="col-lg-8">
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-sitemap"></i> Tournament Bracket
                
            <?php
                
                switch( $max_teams ) {
                    case 4:
                        include( 'tpls/tournaments/brackets/view-tournament-bracket-04.php' );
                        break;
                    case 8:
                        include( 'tpls/tournaments/brackets/view-tournament-bracket-08.php' );
                        break;
                    case 16:
                        include( 'tpls/tournaments/brackets/view-tournament-bracket-16.php' );
                        break;
                    case 32:
                        include( 'tpls/tournaments/brackets/view-tournament-bracket-32.php' );
                        break;
                    default:
                        break;
                }
                
            ?>
            </div>
        </div>
    </div>
</div>
    <div id="addTournamentTeamsModal" class="modal"></div>