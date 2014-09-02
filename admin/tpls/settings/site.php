<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Site Settings</h1>
    </div>
</div>
<div class="row">
    <div class="col-lg-8">
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-gear"></i> Modify Basic Site Settings
            </div>
            <div class="panel-body">
                <ul class="nav nav-pills">
                    <li class="active">
                        <a data-toggle="tab" href="#site-name">Name</a>
                    </li>
                    <li class="">
                        <a data-toggle="tab" href="#site-url">URL</a>
                    </li>
                    <li class="">
                        <a data-toggle="tab" href="#site-contact">Contact E-Mail</a>
                    </li>
                    <li class="">
                        <a data-toggle="tab" href="#site-about">About Content</a>
                    </li>
                    <li class="">
                        <a data-toggle="tab" href="#site-logo">Logo</a>
                    </li>
                </ul>
                
                <div class="tab-content">
            <?php $site_settings = $ez_settings->get_settings(); ?>      
                    <div class="tab-pane fade active in" id="site-name">
                        <h4>Web Site Name</h4>
                         <form method="POST" id="siteName">
                            <div class="form-group">
                                <input class="form-control" id="name" placeholder="Site Name" value="<?php echo $site_settings['name']; ?>" />
                            </div>
                            <div class="form-group">
                                <button class="btn btn-success" type="submit">Save</button>
                            </div>
                            <div class="success">
                              <span class="success_text"></span>
                            </div>
                          </form>
                    </div>
                    <div class="tab-pane fade" id="site-url">
                        <h4>Web Site URL</h4>
                         <form method="POST" id="siteURL">
                            <div class="form-group">
                                <input class="form-control" id="url" placeholder="ex: http://www.mdloring.com/ezleague" value="<?php echo $site_settings['url']; ?>" />
                            </div>
                            <div class="form-group">
                                <button class="btn btn-success" type="submit">Save</button>
                            </div>
                            <div class="success">
                              <span class="success_text"></span>
                            </div>
                          </form>
                    </div>
                    <div class="tab-pane fade" id="site-contact">
                        <h4>Web Site Contact E-Mail</h4>
                         <form method="POST" id="siteContact">
                            <div class="form-group">
                                <input class="form-control" id="email" placeholder="ex: you@domain.com" value="<?php echo $site_settings['email']; ?>" />
                            </div>
                            <div class="form-group">
                                <button class="btn btn-success" type="submit">Save</button>
                            </div>
                            <div class="success">
                              <span class="success_text"></span>
                            </div>
                          </form>
                    </div>
                    <div class="tab-pane fade" id="site-about">
                        <h4>Web Site About Content</h4>
                         <form method="POST" id="siteAbout">
                            <div class="form-group">
                                <textarea class="ckeditor form-control" id="content" placeholder="About your site"><?php echo $site_settings['about']; ?></textarea>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-success" type="submit">Save</button>
                            </div>
                            <div class="success">
                              <span class="success_text"></span>
                            </div>
                          </form>
                    </div>
                    <div class="tab-pane fade" id="site-logo">
                        <h4>Web Site Logo</h4>
                        <div class="col-lg-8">
                         <form role="form" id="siteLogo" action="./lib/submit/logo-upload.php" method="POST" enctype="multipart/form-data">
                           <div class="form-group">
                            <label>Choose image</label>
                            <small>extensions: jpg, jpeg, gif, png accepted</small>
                            <input type="file" name="file">
                           </div>                 
                           <div class="form-group">
                            <button type="submit" class="btn btn-primary">Update Logo</button>
                           </div> 
                         </form>
                         <div class="success">
                           <span class="success_text"></span>
                         </div>
                        </div>
                        <div class="col-lg-4">
                          <a href="../logos/<?php echo $site_settings['logo']; ?>">
                            <img src="../logos/<?php echo $site_settings['logo']; ?>" class="img-responsive" />
                          </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>