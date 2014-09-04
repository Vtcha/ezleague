<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Recent Tweets Settings</h1>
    </div>
</div>
<div class="row">
    <div class="col-lg-5">
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-file-o"></i> Update Twitter App Settings
            </div>
            <?php $twitter_app = $ez_settings->get_twitter_app_settings(); ?>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
                     <form method="POST" id="updateTwitterApp">
                        <div class="form-group">
                            <label># of Tweets to Display</label>
                            <select id="twitter-count" class="form-control">
                                <?php for( $i=0 ; $i <= 5; $i++ ) { ?>
                                <option <?php echo ( $twitter_app['count'] == $i ? 'selected' : '' ); ?> value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Twitter Handle <small>(the handle tweets are being displayed from)</small></label>
                            <input type="text" class="form-control" id="twitter-handle" value="<?php echo $twitter_app['handle']; ?>" placeholder="Twitter Handle" />
                        </div>
                    	<div class="form-group">
						    <label>API Key</label>
						    <input type="text" class="form-control" id="twitter-api" value="<?php echo $twitter_app['api']; ?>" placeholder="API Key" />
						</div>
						<div class="form-group">
						    <label>API Secret</label>
						    <input type="text" class="form-control" id="twitter-secret" value="<?php echo $twitter_app['secret']; ?>" placeholder="API Secret" />
						</div>
						<div class="form-group">
						    <label>Token</label>
						    <input type="text" class="form-control" id="twitter-token" value="<?php echo $twitter_app['token']; ?>" placeholder="Token" />
						</div>
                        <div class="form-group">
                            <label>Token Secret</label>
                            <input type="text" class="form-control" id="twitter-token-secret" value="<?php echo $twitter_app['token_secret']; ?>" placeholder="Token Secret" />
                        </div>
						<div class="form-group">
							<button class="btn btn-success" type="submit">Update Settings</button>
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
    <div class="col-lg-5">
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-file-o"></i> How to setup your Twitter App
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
                        <ol>
                            <li>
                                <a href="./twitter/step-1.png" target="_blank">
                                    <img src="./twitter/step-1.png" class="img-responsive" />
                                </a>
                            </li>
                            <li>
                                <a href="./twitter/step-2.png" target="_blank">
                                    <img src="./twitter/step-2.png" class="img-responsive" />
                                </a>
                            </li>
                            <li>
                                <a href="./twitter/step-3.png" target="_blank">
                                    <img src="./twitter/step-3.png" class="img-responsive" />
                                </a>
                            </li>
                            <li>
                                <a href="./twitter/step-4.png" target="_blank">
                                    <img src="./twitter/step-4.png" class="img-responsive" />
                                </a>
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>