<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Site Social Network Settings</h1>
    </div>
</div>
<div class="row">
    <div class="col-lg-8">
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-gear"></i> Modify Social Network Settings
            </div>
            <div class="panel-body">
                <ul class="nav nav-pills">
                    <li class="active">
                        <a data-toggle="tab" href="#site-facebook">Facebook</a>
                    </li>
                    <li class="">
                        <a data-toggle="tab" href="#site-twitter-handle">Twitter Handle</a>
                    </li>
                    <li class="">
                        <a data-toggle="tab" href="#site-youtube">YouTube</a>
                    </li>
                    <li class="">
                        <a data-toggle="tab" href="#site-google-plus">Google+</a>
                    </li>
                </ul>
                
                <div class="tab-content">
            <?php $site_settings = $ez_settings->get_social_networks(); ?>      
                    <div class="tab-pane fade active in" id="site-facebook">
                        <h4>Facebook URL</h4>
                         <form method="POST" id="updateFacebook">
                            <div class="form-group">
                                <input class="form-control" id="facebook" placeholder="Facebook URL" value="<?php echo $site_settings['facebook']; ?>" />
                            </div>
                            <div class="form-group">
                                <button class="btn btn-success" type="submit">Save</button>
                            </div>
                            <div class="success">
                              <span class="success_text"></span>
                            </div>
                          </form>
                    </div>
                    <div class="tab-pane fade" id="site-twitter-handle">
                        <h4>Twitter Handle</h4>
                         <form method="POST" id="updateTwitter">
                            <div class="form-group">
                                <input class="form-control" id="twitter" placeholder="Twitter URL" value="<?php echo $site_settings['twitter-handle']; ?>" />
                            </div>
                            <div class="form-group">
                                <button class="btn btn-success" type="submit">Save</button>
                            </div>
                            <div class="success">
                              <span class="success_text"></span>
                            </div>
                          </form>
                    </div>
                    <div class="tab-pane fade" id="site-youtube">
                        <h4>YouTube URL</h4>
                         <form method="POST" id="updateYouTube">
                            <div class="form-group">
                                <input class="form-control" id="youtube" placeholder="YouTube URL" value="<?php echo $site_settings['youtube']; ?>" />
                            </div>
                            <div class="form-group">
                                <button class="btn btn-success" type="submit">Save</button>
                            </div>
                            <div class="success">
                              <span class="success_text"></span>
                            </div>
                          </form>
                    </div>
                    <div class="tab-pane fade" id="site-google-plus">
                        <h4>Google+ URL</h4>
                         <form method="POST" id="updateGoogle">
                            <div class="form-group">
                                <input class="form-control" id="google" placeholder="Google+ URL" value="<?php echo $site_settings['google-plus']; ?>" />
                            </div>
                            <div class="form-group">
                                <button class="btn btn-success" type="submit">Save</button>
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
  </div>