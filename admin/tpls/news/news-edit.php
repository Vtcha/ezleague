<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Edit News</h1>
    </div>
</div>
<div class="row">
    <div class="col-lg-8">
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-file-o"></i> Edit News Post
            </div>
            <div class="panel-body">
             <?php 
             	if( isset( $_GET['id'] ) ) { 
             		$post_id = $_GET['id']; 
             		 $post = $ez_news->get_post( $post_id );
             		 $post_cat = explode( ',', $post['cat'] );
             ?>
                <div class="row">
                    <div class="col-lg-12">
                     <form role="form" id="editNews" name="editNews" method="POST">
                      <input type="hidden" name="news_id" id="news_id" value="<?php echo $post_id; ?>" />
                    	<div class="form-group">
						    <label>Title</label>
						    <input class="form-control" id="title" name="title" placeholder="Post Title" value="<?php echo $post['title']; ?>" />
						</div>
                        <div class="form-group">
						    <label>Body</label>
						    <textarea class="ckeditor form-control" id="body" name="body" rows="3"><?php echo $post['body']; ?></textarea>
						</div>
						<div class="form-group">
						<?php if( $post['published'] == 0 ) { ?>
							<button class="btn btn-success" type="button" onclick="publishPost()">Publish Post</button>
							<button class="btn btn-warning" type="button" onclick="updateDraft()">Update Draft</button>
						<?php } elseif( $post['published'] == 1 ) { ?>
							<button class="btn btn-success" type="submit">Update Post</button>
						<?php } ?>
						
						<?php if( $post['published'] == 1 ) { ?>
							<button class="btn btn-info pull-right" type="button" onclick="unpublishPost('<?php echo $post_id; ?>')">Unpublish Post</button>
						<?php } ?>
						</div>
					<div class="success">
						<span class="success_text"></span>
					</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
	<div class="col-lg-4">
		<div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-camera"></i> Post Image
            </div>
            <div class="panel-body">
                  <div class="form-group">
                     <input type="hidden" id="media" value="<?php echo $post['media']; ?>" />
                     <div class="media-select">
                     <?php if( $post['media'] != '' && $post['media'] != 0 ) { ?>
                     	<img src="../media/<?php echo $post['media_image']; ?>" />
                     <?php } ?>
                     </div>
                     <button type="button" onclick="mediaExplorer();" class="btn btn-primary btn-block" data-toggle="modal" data-target="#mediaExplorerModal">Choose Media</button>
                     <a href="news.php?page=media" class="btn btn-info btn-block" target="_blank">Upload Media</a>
                   </div>
            </div>
        </div>
    	<div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-sitemap"></i> Post Author
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
            	<div class="form-group">
				    <select class="form-control" name="author" id="author">
				    	<option></option>
				     <?php $authors = $ez_news->get_authors(); ?>
				      <?php foreach( $authors as $author ) { ?>
				      	<option <?php echo ( $author['username'] == $post['author'] ? 'selected' : '' ); ?> value="<?php echo $author['username']; ?>"><?php echo $author['username']; ?></option>
				      <?php } ?>
				    </select>
	   			</div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-sitemap"></i> Game
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
             <?php $games = $ez_settings->get_settings_game(); ?>
             	 <div class="form-group">
				    <div class="radio">
				        <label>
				            <input <?php echo ( $post['game'] == 'all' ? 'checked' : '' ); ?> type="radio" name="game" id="game" value="all"></input> All
				        </label>
				    </div>
				 </div>
              <?php foreach( $games as $game ) { ?>
                  <div class="form-group">
				    <div class="radio">
				        <label>
				            <input <?php echo ( $game['slug'] == $post['game'] ? 'checked' : '' ); ?> type="radio" name="game" id="game" value="<?php echo $game['slug']; ?>"></input> <?php echo $game['game']; ?>
				        </label>
				    </div>
				  </div>
 			 <?php } ?>
	   
            </div>
        </div>
    	<div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-sitemap"></i> Post Category
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
             <?php $news_categories = $ez_news->get_categories(); ?>
              <?php foreach( $news_categories as $category ) { ?>
			       <div class="form-group">
				   	<div class="checkbox">
				        <label>
				            <input <?php echo ( in_array( strtolower( $category['category'] ), $post_cat ) ? 'checked' : '' ); ?> type="checkbox" name="category" id="category" value="<?php echo $category['category']; ?>"></input> <?php echo $category['category']; ?>
				        </label>
					</div>
			  <?php } ?>
				   </div>
	 </form>
<?php } else { ?>
<h3>No News item selected</h3>
<?php } ?>
			</div>
		</div>
	</div>
</div>