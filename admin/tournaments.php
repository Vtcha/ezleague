<?php include('header.php'); ?>

<?php include('sidebar.php'); ?>

        <div id="page-wrapper">
        <?php 
        	if( isset( $_GET['page'] ) ) {
        		$page = trim( $_GET['page'] );
        		
        		switch( $page ) {
        			case 'maps':
        				include('tpls/tournaments/view-maps.php');
        				break;
        				
        			case 'rules':
        				include('tpls/tournaments/view-rules.php');
        				break;
        				
        			case 'edit':
        				include('tpls/tournaments/edit-tournament.php');
        				break;
        				
        			case 'create':
        				include('tpls/tournaments/create-tournament.php');
        				break;

                    case 'disputes':
                        include('tpls/tournaments/view-disputes.php');
                        break;

                    case 'dispute':
                        include('tpls/tournaments/view-dispute.php');
                        break;
        			
        			default:
        				break;
        		}
        		
        	} else {
        		include('tpls/tournaments/view-all.php');
        	}
        ?>
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <div id="delete-tournament-confirm" title="Delete tournament?" style="display:none;">
		<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>All corresponding tournament <em>matches, schedule &amp; other</em> data will be permanently deleted.</p>
	</div>
    <div id="kick-team-confirm" title="Kick Team" style="display:none;">
        <p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>All future team matches will be forfeited. This cannot be undone.</p><p> Are you sure you want to take this action?</p>
    </div>
    
    <!-- Core Scripts - Include with every page -->
    <script src="js/jquery-1.10.2.js"></script>
    <link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.0/themes/smoothness/jquery-ui.css" />
	<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.0/jquery-ui.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>

    <!-- SB Admin Scripts - Include with every page -->
    <script src="js/sb-admin.js"></script>
    <script src="js/ezleague/tournament.js"></script>
    <script src="js/ezleague/teams.js"></script>
    <script src="//cdn.ckeditor.com/4.4.7/standard/ckeditor.js"></script>
	<script>
	CKEDITOR.replace( 'body', {
		toolbar: [
			[ 'Bold', 'Italic', '-', 'NumberedList', 'BulletedList', '-', 'Link', 'Unlink' ],
			[ 'FontSize', 'TextColor', 'BGColor' ]
		]
	});
	</script>
</body>

</html>
