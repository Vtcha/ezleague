<?php include('header.php'); ?>
<?php unset($_SESSION['ez_game']); ?>
	<div class="row">
		  
          <?php include('sidebar.php'); ?>
          <div class="col-lg-10">
              <div class="panel panel-primary">
                <div class="panel-heading">
                  <h3 class="panel-title">Password Reset</h3>
                </div> 
                <div class="panel-body">
                 <div class="col-lg-7">
                      <small>Enter the account email to receive instructions on how to reset your password..</small>
                        <form role="form" id="ezLeagueResetPassword" name="ezLeagueResetPassword" method="POST">
                            <fieldset>
                                <div class="form-group">
                                  <label>E-Mail Address</label>
                                    <input class="form-control" id="reset-email" name="reset-email" type="text">
                                </div>
                                <!-- Change this to a button or input when using this as a form -->
                                <button type="submit" class="btn btn-lg btn-primary btn-sm">Send Instructions</button>
                                <div class="success">
				                  <span class="success_text"></span>
				                </div>
                            </fieldset>
                        </form>
                  </div>
                 </div>
              </div>

          </div>
        
	</div>


<?php include('footer.php'); ?>