<?php include('header.php'); ?>
<?php unset($_SESSION['ez_game']); ?>
	<div class="row">
		  
          <?php include('sidebar.php'); ?>
          <div class="col-lg-10">
              <div class="panel panel-primary">
                <div class="panel-heading">
                  <h3 class="panel-title">Create New Password</h3>
                </div> 
                <div class="panel-body">
                 <div class="col-lg-7">
                  <?php if(isset($_GET['f'])) { 
                  			$f = addslashes($_GET['f']);
                  			 $valid = $ez->validateCode($f);
                  			  if($valid != '') {
                  ?>
                      <small>Passwords must be at least 6 characters long</small>
                        <form role="form" id="ezLeagueNewPassword" name="ezLeagueNewPassword" method="POST">
                         <input type="hidden" name="user_id" id="user_id" value="<?php print $valid; ?>" />
                            <fieldset>
                                <div class="form-group">
					              <h5>Password</h5>
					              <input id="new-password" class="form-control password placeholder" placeholder="Password" name="new-password" autocomplete="off" type="password">
					            </div>
					            <div class="form-group">
					              <h5>Confirm</h5>
					              <input id="new-confirm" class="form-control password placeholder" placeholder="Password" name="new-confirm" autocomplete="off" type="password">
					            </div>
                                <!-- Change this to a button or input when using this as a form -->
                                <button type="submit" class="btn btn-lg btn-primary btn-sm">Reset Password</button>
                                <div class="success">
				                  <span class="success_text"></span>
				                </div>
                            </fieldset>
                        </form>
                     <?php } else {
                     		print "Reset code is not valid";
                     	   }
                  		}
                     ?>
                      
                  </div>
                 </div>
              </div>

          </div>
        
	</div>


<?php include('footer.php'); ?>