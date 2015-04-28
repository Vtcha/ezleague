<?php include('header.php'); ?>

<?php include('sidebar.php'); ?>

        <div id="page-wrapper">
        <?php 
        	if( isset( $_GET['page'] ) ) {
        		$page = trim( $_GET['page'] );
        		
        		switch( $page ) {
        			case 'view':
        				include('tpls/news/news-view.php');
        				break;
        				
        			case 'add':
        				include('tpls/news/news-add.php');
        				break;
        				
        			case 'categories':
        				include('tpls/news/news-categories.php');
        				break;
        				
        			case 'edit':
        				include('tpls/news/news-edit.php');
        				break;
        				
        			case 'media':
        				include('tpls/news/news-media.php');
        				break;
        			
        			default:
        				break;
        		}
        		
        	} else {
        		include('tpls/news/news-view.php');
        	}
        ?>
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <div id="delete-category-confirm" title="Delete category" style="display:none;">
		<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Please update all corresponding posts after deletion</p>
	</div>
	<div id="delete-media-confirm" title="Delete media" style="display:none;">
		<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>This media will be permanently deleted.</p>
	</div>
	
    
    <!-- Core Scripts - Include with every page -->
    <script src="js/jquery-1.10.2.js"></script>
    <link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.0/themes/smoothness/jquery-ui.css" />
    <link rel="stylesheet" href="js/plugins/lightbox/bootstrap-lightbox.min.css" />
	<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.0/jquery-ui.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/plugins/metisMenu/jquery.metisMenu.js"></script> 
    <script src="js/plugins/lightbox/bootstrap-lightbox.min.js"></script>

    <!-- SB Admin Scripts - Include with every page -->
    <script src="js/sb-admin.js"></script>
    <script src="js/ezleague/news.js"></script>
    <script src="//cdn.ckeditor.com/4.4.7/standard/ckeditor.js"></script>
	<script>
	CKEDITOR.replace( 'body', {
		toolbar: [
			[ 'Bold', 'Italic', '-', 'NumberedList', 'BulletedList', '-', 'Link', 'Unlink' ]
			[ 'FontSize', 'TextColor', 'BGColor' ]
			[ 'Format', 'Font', 'FontSize' ]
		]
	});
	</script>
	<div id="viewMediaModal" class="modal"></div>
    <div id="mediaExplorerModal" class="modal"></div>
</body>

</html>
