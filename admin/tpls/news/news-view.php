<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">View All News</h1>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-file-o"></i> Viewing News
            </div>
            <div class="panel-body">
                  <div class="table-responsive">
        <?php $all_news = $ez_news->get_news(); ?>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Author</th>
                                <th class="hidden-xs">Game</th>
                                <th class="hidden-xs">Category</th>
                                <th>Status</th>
                                <th>Created</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
             <?php foreach($all_news as $news) { ?> 
               <?php if($news['published'] == 1) { ?>
                            <tr class="success">
               <?php } else { ?>
                            <tr class="info">
               <?php } ?>
                                <td><?php echo $news['title']; ?></td>
                                <td><?php echo $news['author']; ?></td>
                                <td class="hidden-xs"><?php echo $news['game']; ?></td>
                                <td class="hidden-xs"><?php echo implode( ',', $news['cat'] ); ?></td>
                                <td><?php echo ($news['published'] == 1 ? 'published' : 'draft'); ?></td>
                                <td><?php echo date('M d, Y h:ia', strtotime( $news['date'] ) ); ?></td>
                                <td>
                                    <a href="news.php?page=edit&id=<?php echo $news['id']; ?>" class="btn btn-info btn-xs">Edit</a>
                                </td>
                            </tr>
              <?php } ?>
                        </tbody>
                     </table>
                    </div>
            </div>
        </div>
    </div>
  </div>