<?php include('header.php'); ?>

<?php include('sidebar.php'); ?>

        <div id="page-wrapper">
        <?php 
        	if( isset( $_GET['page'] ) ) {
        		$page = trim( $_GET['page'] );
        		
        		switch( $page ) {
        			case 'leagues':
        				include('tpls/matches/view-leagues.php');
        				break;
        				
        			case 'view':
        				include('tpls/matches/view-matches.php');
        				break;
        				
        			case 'match':
        				include('tpls/matches/view-match.php');
        				break;
        				
        			case 'disputes':
        				include('tpls/matches/view-disputes.php');
        				break;
        			
        			case 'dispute':
        				include('tpls/matches/view-dispute.php');
        				break;
        				
        			default:
        				break;
        		}
        		
        	} else {
        		include('tpls/matches/view-leagues.php');
        	}
        ?>
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- Core Scripts - Include with every page -->
    <script src="js/jquery-1.10.2.js"></script>
    <link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.0/themes/smoothness/jquery-ui.css" />
	<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.0/jquery-ui.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>

    <!-- SB Admin Scripts - Include with every page -->
    <script src="js/sb-admin.js"></script>
    <script src="js/ezleague/matches.js"></script>
</body>

</html>
