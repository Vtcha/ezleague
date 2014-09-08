<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Add News</h1>
    </div>
</div>
<div class="row">
    <div class="col-lg-8">
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-file-o"></i> Add News Post
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
                     <form role="form" id="addNews" method="POST">
                        <div class="form-group">
                            <label>Title</label>
                            <input class="form-control" id="title" placeholder="Post Title" />
                        </div>
                        <div class="form-group">
                            <label>Body</label>
                            <textarea class="ckeditor form-control" id="body"></textarea>
                        </div>
                        <div class="form-group">
                            <button id="publish-btn" class="btn btn-success" type="submit">Publish Post</button>
                            <button id="save-draft-btn" class="btn btn-warning" type="button" onclick="saveDraft();">Save as Draft</button>
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
                     <input type="hidden" id="media" />
                     <div class="media-select"></div>
                     <button type="button" onclick="mediaExplorer();" class="btn btn-primary btn-block" data-toggle="modal" data-target="#mediaExplorerModal">Choose Media</button>
                     <a href="news.php?page=media" class="btn btn-info btn-block" target="_blank">Upload Media</a>
                   </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-sitemap"></i> Post Author
            </div>
            <div class="panel-body">
                  <div class="form-group">
                    <select class="form-control" id="author">
                        <option></option>
                     <?php $news_authors = $ez_news->get_authors(); ?>
                      <?php foreach( $news_authors as $author ) { ?>
                        <option <?php echo ( $author['username'] == $username ? 'selected' : '' ); ?> value="<?php echo $author['username']; ?>"><?php echo $author['username']; ?></option>
                      <?php } ?>
                    </select>
                   </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-sitemap"></i> Game
            </div>
            <div class="panel-body">
             <?php $games = $ez_settings->get_settings_game(); ?>
                 <div class="form-group">
                    <div class="radio">
                        <label>
                            <input type="radio" id="game" value="all"></input> All
                        </label>
                    </div>
                  </div>
              <?php foreach( $games as $game ) { ?>
                  <div class="form-group">
                    <div class="radio">
                        <label>
                            <input type="radio" id="game" value="<?php echo $game['slug']; ?>"></input> <?php echo $game['game']; ?>
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
             <?php if( $news_categories ) { ?>
              <?php foreach( $news_categories as $category ) { ?>
                  <div class="form-group">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" id="category" value="<?php echo $category['category']; ?>"></input> <?php echo $category['category']; ?>
                        </label>
                    </div>
              <?php } ?>
            <?php } else { ?>
            <script type="text/javascript">
              var publish = document.getElementById('publish-btn');
                  draft   = document.getElementById('save-draft-btn');
              publish.disabled = true;
              draft.disabled = true;
            </script>
              No categories found, please <a href="news.php?page=categories" target="_blank">add categories</a>
            <?php } ?>
                   </div>
                 </form>
            </div>
        </div>
     </div>
    </div>