<?php session_start();
date_default_timezone_set('America/Chicago');
include('./lib/class-db.php');
include('./lib/objects/class-news.php');

$ez_news = new ezAdmin_News();
    
     if( ! isset( $_SESSION['ez_admin'] ) ) {
     	header("Location: login.php");
     } else {
     	$username = $_SESSION['ez_admin'];
     }

	 $media = $ez_news->get_media();
?>

<div class="modal-dialog media-modal">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			<h4 class="modal-title" id="myModalLabel">Viewing Media Explorer</h4>
		</div>
		<div class="modal-body">
		 <div class="row">
		  <div class="col-lg-12">
            <div class="panel panel-default">
              <div class="panel-heading">
                <h3 class="panel-title text-info">Choose Post Image</h3>
              </div>
              <div style="height: auto;" id="collapseOne" class="panel-collapse">
                <div class="panel-body">
                <?php foreach( $media as $item ) { ?>
					<div class="col-lg-2">
		            	<img src="../media/<?php echo $item['file']; ?>" class="img-responsive select-media">
		            	<button class="btn btn-primary btn-block" onclick="selectMedia('<?php echo $item['id']; ?>', '<?php echo $item['file']; ?>')">Select</button>
		            </div>
		        <?php } ?>
                </div>
              </div>
            </div>
           </div>
          </div>
		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		</div>
	</div>
	<!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->