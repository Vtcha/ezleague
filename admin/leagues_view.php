<?php include('header.php'); ?>

<?php include('sidebar.php'); ?>

        <div id="page-wrapper">
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
                            <i class="fa fa-file-o"></i> Viewing League
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                         <?php if(isset($_GET['id'])) { 
                         		$league_id = $_GET['id'];
                         		 $league = $ez->getLeague($league_id);
                         		  $start_date = strtotime($league['start_date']);
                         		  $now		  = strtotime('now');
                         		  $started = true;
                         		   if($start_date > $now) {
                         		   		$started = false;
                         		   }
                         ?>
				            
				            <div class="col-lg-6">
                         	   <div class="panel panel-default">
                         	    <div class="panel-heading">
		                            <i class="fa fa-file-o"></i> Details for <em><?php print $league['league']; ?></em>
		                        </div>
								<div class="panel-body">
				                 	<strong>League</strong> <span class="gm"><?php print $league['league']; ?></span><br/>
				                 	<strong>Total Teams</strong> <span class="gm"><?php print $league['teams']; ?></span><br/>
				                 	<strong>Game</strong> <span class="gm"><?php print $league['game']; ?></span><br/>
				                 	<strong>Start Date</strong> <span class="gm"><?php print $league['start_date']; ?></span><br/>
				                 	<strong>End Date</strong> <span class="gm"><?php print $league['end_date']; ?></span><br/>
				                 	<strong>Status</strong> <span class="gm"><?php print ($league['status'] == 1 ? '<span class=\'text-success bolder\'>Running</span>' : '<span class=\'text-danger\'>Completed</span>'); ?></span><br/>
				                </div>
				               </div>
				               
				               <div class="panel panel-default">
		                        <div class="panel-heading">
		                            <i class="fa fa-bullhorn fa-fw"></i> League Rules
		                             <a href="leagues_rules.php?id=<?php print $league['id']; ?>" class="btn btn-success btn-xs pull-right">Edit Rules</a>
		                        </div>
		                        <!-- /.panel-heading -->
		                        <div class="panel-body">
		                            <?php print $league['rules']; ?>
		                        </div>
		                    </div>
				            </div>
				            
				            <div class="col-lg-6">
                         	   <div class="panel panel-default">
                         	    <div class="panel-heading">
		                            <i class="fa fa-file-o"></i> Teams in <em><?php print $league['league']; ?></em>
		                        </div>
								<div class="panel-body">
								 <?php $teams = $ez->getLeagueTeams($league_id); ?>
				                 	<div class="table-responsive">
	                                   <table class="table table-hover">
	                                    <thead>
	                                        <tr>
										      <th>Team</th>
										      <th></th>
										    </tr>
	                                    </thead>
	                                    <tbody>
	                                     <?php foreach($teams as $team) { ?>
	                                     	<tr>
	                                     	 <td><?php print $team['guild']; ?></td>
	                                     	 <td>
	                                     	 	<a href="teams_view.php?id=<?php print $team['id']; ?>" class="btn btn-info btn-xs"><i class="fa fa-search"></i> View Team</a>
	                                     	 	<button onclick="kickTeam('<?php print $league_id; ?>', '<?php print $team['id']; ?>')" data-toggle="modal" data-target="#kickTeamModal" class="btn btn-danger btn-xs"><i class="fa fa-times"></i> Kick Team</button>
	                                     	 </td>
	                                     	</tr>
	                                     <?php } ?>
	                                    </tbody>
	                                   </table>
	                                 </div>
				                </div>
				               </div>
				            </div>
                        </div>
                                <div class="success">
                                 <span class="success_text"></span>
                                </div>
                                <!-- /.col-lg-4 (nested) -->
                          <?php } else { ?>
                       		Select the Team below to view their details
                       		   <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Team</th>
                                            <th>Game</th>
                                            <th>Website</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                        <?php $teams = $ez->getTeams(); ?>
                                    <tbody>
                          <?php foreach($teams as $team) { ?>
                                        <tr>
                                            <td><?php print $team['guild']; ?> (<?php print $team['abbreviation']; ?>)</td>
                                            <td><?php print $team['game'] ?></td>
                                            <td><a class="btn btn-success btn-xs" href="<?php print $team['website']; ?>">View Site</a></td>
                                            <td>
                                            	<a href="teams_view.php?id=<?php print $team['id']; ?>" class="btn btn-primary btn-xs">View Team</a>
							            	</td>
                                        </tr>
                           <?php } ?>
                                    </tbody>
                                 </table>
                          <?php } ?>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->

                </div>
                <!-- /.col-lg-8 -->
                </div>
                <!-- /.col-lg-4 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
	<div id="kickTeamModal" class="modal"></div>
	
    <!-- Core Scripts - Include with every page -->
    <script src="js/jquery-1.10.2.js"></script>
    <link rel="stylesheet" href="<?php print $site_url; ?>/ezleague/admin/css/redmond/jquery-ui-1.10.4.custom.min.css" />
	<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>

    <!-- Page-Level Plugin Scripts - Dashboard -->
    <script src="js/plugins/morris/raphael-2.1.0.min.js"></script>
    <script src="js/plugins/morris/morris.js"></script>

    <!-- SB Admin Scripts - Include with every page -->
    <script src="js/sb-admin.js"></script>
    <script src="js/ezleague.js"></script>

    <!-- Page-Level Demo Scripts - Dashboard - Use for reference -->
    <script src="js/demo/dashboard-demo.js"></script>

</body>

</html>
