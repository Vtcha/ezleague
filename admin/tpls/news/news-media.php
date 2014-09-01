<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">View News Media</h1>
    </div>
</div>
<div class="row">
<div class="col-lg-4">
    <div class="panel panel-default">
        <div class="panel-heading">
            <i class="fa fa-file-o"></i> Upload New Media
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-lg-12">
                 <form action="./lib/submit/media-upload.php" id="addMedia" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Choose image</label>
                        <small>extensions: jpg, jpeg, gif, png accepted</small>
                        <input type="file" name="file">
                    </div>
                    <div class="form-group">
                    	<button type="submit" class="btn btn-success">Upload</button>
                    	<button type="reset" class="btn btn-warning">Reset</button>
                    </div>
                    <div class="success">
                      <span class="success_text"></span>
                    </div>
                  </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-lg-8">
    <div class="panel panel-default">
        <div class="panel-heading">
            <i class="fa fa-sitemap"></i> Current Media
        </div>
        <div class="panel-body">
            <?php $media = $ez_news->get_media(); ?>
            <?php 
            	if( $media ) { 
            		foreach( $media as $item ) {
            ?>
            <div class="col-lg-3">
            	<a href="#" onclick="getMedia('<?php echo $item['id']; ?>');" data-toggle="modal" data-target="#viewMediaModal">
            		<img src="../media/<?php echo $item['file']; ?>" class="img-responsive news-media">
            	</a>
            	<button class="btn btn-danger btn-xs delete-media" onclick="deleteMedia('<?php echo $item['id']; ?>')">Delete</button>
            </div>
            <?php 			
            		}
            	}
            ?>
        </div>
    </div>
 </div>
</div>