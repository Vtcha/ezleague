<?php include('header.php'); ?>

<?php include('sidebar.php'); ?>

        <div id="page-wrapper">
        <?php 
        	if( isset( $_GET['page'] ) ) {
        		$page = trim( $_GET['page'] );
        		
        		switch( $page ) {
        			case 'all':
        				include('tpls/users/view-all.php');
        				break;
        				
        			case 'view':
        				include('tpls/users/view-user.php');
        				break;
        				
        			case 'edit':
        				include('tpls/users/edit-users.php');
        				break;
        				
        			case 'create':
        				include('tpls/users/create-users.php');
        				break;
        			
        			default:
        				break;
        		}
        		
        	} else {
        		include('tpls/users/view-all.php');
        	}
        ?>
        </div>
    </div>
    
    <!-- Core Scripts - Include with every page -->
    <script src="js/jquery-1.10.2.js"></script>
    <link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.0/themes/smoothness/jquery-ui.css" />
	<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.0/jquery-ui.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>

    <!-- SB Admin Scripts - Include with every page -->
    <script src="js/sb-admin.js"></script>
    <script src="js/ezleague/users.js"></script>
</body>

</html>
