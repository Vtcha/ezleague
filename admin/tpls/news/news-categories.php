<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Add News Category</h1>
    </div>
</div>
<div class="row">
    <div class="col-lg-4">
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-file-o"></i> Create New News Category
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
                     <form method="POST" id="addCategory" name="addCategory">
                        <div class="form-group">
                            <label>Category</label>
                            <input class="form-control" id="category" name="category" placeholder="News Category" />
                        </div>
                        <div class="form-group">
                            <button class="btn btn-success" type="submit">Add Category</button>
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
    <div class="col-lg-4">
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-sitemap"></i> Current Categories
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Category</th>
                                <th>Options</th>
                            </tr>
                        </thead>
            <?php $categories = $ez_news->get_categories(); ?>
                        <tbody>
              <?php foreach($categories as $category) { ?>
                            <tr>
                                <td><?php echo $category['category']; ?></td>
                                <td>
                                    <button type="button" onclick="deleteCategory('<?php echo $category['id']; ?>')" class="btn btn-danger btn-xs">Delete</button>
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