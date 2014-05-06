<?php include('header.php'); ?>

<?php include('sidebar.php'); ?>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Edit League Points</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-10">
                	<?php 
                		if(isset($_GET['id'])) { 
	                        $id = $_GET['id'];
	                         $league = $ez->getLeaguePoints($id);
                    ?>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-sitemap"></i> League Points
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                        <?php if(!empty($id)) {  print "<h3>" . $league['league'] . "</h3>"; ?>
                         <div class="col-lg-3">
							<form id="editLeaguePoints" name="editLeaguePoints" method="POST">
							 <input type="hidden" name="league_id" id="league_id" value="<?php print $id; ?>" />
					       	   <label>Wins</label>
					       	   <input type="text" name="points_win" id="points_win" class="form-control text" value="<?php print $league['win']; ?>" />
					       	   <label>Losses</label>
					       	   <input type="text" name="points_loss" id="points_loss" class="form-control text" value="<?php print $league['loss']; ?>" />
					       	   <label>Ties</label>
					       	   <input type="text" name="points_tie" id="points_tie" class="form-control text" value="<?php print $league['tie']; ?>" />
					      	   <hr/>	
					      		<button type="submit" class="btn btn-primary">Update Points</button>
					          <div class="success">
					           <span class="success_text"></span>
					          </div>
					       </form>
					     </div>
					    <?php } else { ?>
					    	<h3>No League was selected</h3>
					    <?php } ?>
					<?php } ?>
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
