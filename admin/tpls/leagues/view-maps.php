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
        <i class="fa fa-file-o"></i> Viewing Map Rotation
    </div>
    <!-- /.panel-heading -->
    <div class="panel-body">
     <?php if( isset($_GET['id'] ) ) { 
            $league_id = $_GET['id'];
             $league = $ez_league->get_league( $league_id );
             $season = $ez_league->get_current_season( $league_id );
             $current_season = $season['season'];

     ?>
        
        <div class="col-lg-4">
        <!-- Add Maps -->
            <?php include('tpls/leagues/maps/maps-add.php'); ?>
        <div class="success"><span class="success_text"></span></div>    
        </div>
        
        <div class="col-lg-8">
        <!-- Current Map Rotation -->
        	<?php include('tpls/leagues/maps/maps-current.php'); ?>
        </div>
    </div>
</div>

      <?php } else { ?>
        No league was selected to view
      <?php } ?>
</div>
</div>