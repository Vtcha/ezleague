<?php session_start();
date_default_timezone_set('America/Chicago');
include('./lib/class-db.php');
include('./lib/objects/class-news.php');

$ez_news = new ezAdmin_News();
    
     if(!isset($_SESSION['ez_admin'])) {
     	header("Location: login.php");
     } else {
     	$username = $_SESSION['ez_admin'];
     }
     
//get an individual media item
if(isset($_POST['id'])) {
	$media_id = $_POST['id'];
	 $media = $ez_news->get_media_upload( $media_id );
?>

<div class="modal-dialog media-modal">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			<h4 class="modal-title" id="myModalLabel">Viewing Media Upload</h4>
		</div>
		<div class="modal-body">
		 <div class="row">
		  <div class="col-lg-12">
            <div class="panel panel-default">
              <div class="panel-heading">
                <h3 class="panel-title text-info">Added <em><?php echo date( 'F d, Y h:ia', strtotime( $media['date'] ) ); ?></em> &#8212; Filename <em><?php echo $media['file']; ?></em></h3>
              </div>
              <div style="height: auto;" id="collapseOne" class="panel-collapse">
                <div class="panel-body">
					<img src="../media/<?php echo $media['file']; ?>" class="img-responsive" />
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

<?php } ?>