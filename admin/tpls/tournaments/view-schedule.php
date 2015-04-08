<div class="row">
<div class="col-lg-12">
<h1 class="page-header">View Leagues</h1>
</div>
<!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row">
<div class="col-lg-12">
<div class="panel panel-default">
    <div class="panel-heading">
        <i class="fa fa-file-o"></i> Viewing League Schedule
    </div>
    <!-- /.panel-heading -->
    <div class="panel-body">
     <?php if( isset($_GET['id'] ) ) { 
            $league_id = $_GET['id'];
             $league = $ez_league->get_league( $league_id );
             $season = $ez_league->get_current_season( $league_id );
             $current_season = $season['season'];
             $teams = $ez_league->get_league_teams( $league_id );
             $total_teams = count( $teams );
     ?>
        
        <div class="col-lg-4">
        <!-- Generate Match Schedule Form -->
            <?php include('tpls/leagues/schedules/schedule-generate_form.php'); ?>
            
        <!-- Registered Teams -->
			<?php include('tpls/leagues/schedules/schedule-teams.php'); ?>
        </div>
        
        <div class="col-lg-8">
        <!-- Generated Schedule -->
        <?php if( isset( $_GET['week'] ) && is_numeric( $_GET['week'] ) && !isset( $_GET['a'] ) ) { ?>
        	<?php include('tpls/leagues/schedules/schedule-generated.php'); ?>
        <?php } ?> 
        
        <!-- Reject Matches -->
        <?php if( isset( $_GET['a'] ) && $_GET['a'] == 'reject' ) { ?>
        	<?php include('tpls/leagues/schedules/schedule-reject.php'); ?>
        <?php }?>
         
         <!-- Full Schedule -->
        	<?php include('tpls/leagues/schedules/schedule-full.php'); ?>
        </div>
    </div>
</div>
<div class="success"><span class="success_text"></span></div>
      <?php } else { ?>
        No league was selected to view
      <?php } ?>
</div>
</div>