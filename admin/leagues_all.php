<?php include('header.php'); ?>

<?php include('sidebar.php'); ?>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">View All Leagues</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-sitemap"></i> Current Leagues
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                        	<div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>League</th>
                                            <th>Game</th>
                                            <th>Total Teams</th>
                                            <th>Max Teams</th>
                                            <th>Start</th>
                                            <th>End</th>
                                            <th>Current Season</th>
                                        </tr>
                                    </thead>
                        <?php $leagues = $ez_league->get_all_leagues(); ?>
                                    <tbody>
                          <?php foreach( $leagues as $league ) {
                          		 $total_teams = $ez_league->get_total_teams( $league['lid'] ); 
                          ?>
                                        <tr>
                                            <td><a href="leagues_view.php?id=<?php echo $league['lid']; ?>"><?php echo $league['league']; ?></a></td>
                                            <td><?php echo $league['ggame']; ?></td>
                                            <td><?php echo $total_teams; ?></td>
                                            <td><?php echo ($league['teams'] == 5000 ? 'Unlimited' : $league['teams']); ?></td>
                                            <td><?php echo date('F d, Y', strtotime($league['start_date'])); ?></td>
                                            <td><?php echo date('F d, Y', strtotime($league['end_date'])); ?></td>
                                            <td>
                                            	Season 1
							            	</td>
                                        </tr>
                           <?php } ?>
                                    </tbody>
                                 </table>
                                    <!-- /.table-hover -->
                             </div>
                              <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                        <!-- /.panel -->
                </div>
                 	<!-- /.col-lg-8 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <div id="viewRulesModal" class="modal"></div>
    
    <!-- Core Scripts - Include with every page -->
    <script src="js/jquery-1.10.2.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>

    <!-- SB Admin Scripts - Include with every page -->
    <script src="js/sb-admin.js"></script>
    <script src="js/ezleague.js"></script>
    <script src="js/ckeditor/ckeditor.js"></script>

</body>

</html>
