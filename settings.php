<?php include('header.php'); ?>

	<div class="row">
		  
          <?php include('sidebar.php'); ?>
           <?php $settings = $ez->getUserSettings($ez_username); ?>
          <div class="col-lg-10">
              <div class="panel panel-primary">
                <div class="panel-heading">
                  <h3 class="panel-title"><span class="bolder"><?php echo $site_name; ?></span> - <span class="italic">My Settings</span></h3>
                </div>
                <div class="panel-body">    
 	 		   	 <div class="col-lg-5"> 
 	 		   	 	<div class="success">
	                  <span class="success_text"></span>
	                </div>
 	 		   	      <h3>Change Password</h3>
 	 		     		<small>Passwords must be at least 6 characters long</small>
                        <form role="form" id="ezLeagueNewPassword" name="ezLeagueNewPassword" method="POST">
                         <input type="hidden" name="user_id" id="user_id" value="<?php print $settings['id']; ?>" />
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
                                <button type="submit" class="btn btn-lg btn-primary btn-sm">Change Password</button>
                            </fieldset>
                        </form>
                        
                       <h3>Change E-Mail Address</h3>
                        <form role="form" id="ezLeagueNewEmail" name="ezLeagueNewEmail" method="POST">
                         <input type="hidden" name="user_id" id="user_id" value="<?php print $settings['id']; ?>" />
                            <fieldset>
                                <div class="form-group">
					              <h5>New E-Mail</h5>
					              <input id="new-email" value="<?php print $settings['email']; ?>" class="form-control password placeholder" name="new-email" autocomplete="off" type="text">
					            </div>
                                <!-- Change this to a button or input when using this as a form -->
                                <button type="submit" class="btn btn-lg btn-primary btn-sm">Change E-Mail</button>
                            </fieldset>
                        </form>
				 </div>		  
				 <div class="col-lg-7"> 
				 	  <h3>Forum Signature</h3>
				 	   <form role="form" id="updateUserSignature" name="updateUserSignature" method="POST">
                         <input type="hidden" name="user-id" id="user-id" value="<?php print $settings['id']; ?>" />
                            <fieldset>
                                <div class="form-group">
					              <textarea name="user-signature" id="user-signature" class="form-control ckeditor"><?php print $settings['signature']; ?></textarea>
					            </div>
                                <!-- Change this to a button or input when using this as a form -->
                                <button type="submit" class="btn btn-lg btn-primary btn-sm">Update Signature</button>
                            </fieldset>
                        </form>
                        
	             <?php if($ez_guild_id == '') { ?>
 	 		   	      <h3>Team Invites</h3>
 	 		   	   <?php $invites = $ez->getUsernameInvites($ez_username); ?>
 	 		   	    <?php if($invites != '') { ?>
 	 		     		<small>You have been invited to the following teams</small>
 	 		     		<table class="table">
                        <?php 
                        	 $team_invites = explode(",", $invites);
                        	  foreach($team_invites as $invite) {
                        	  	$team = $ez->getTeam($invite);
                        	  ?>
                        	  	<tr>
                        	  	 <td><a href="game/<?php print $team['0']['game']; ?>/teams/id/<?php print $team['0']['id']; ?>"><?php print $team['0']['guild']; ?></a></td>
                        	  	 <td><button onclick="joinTeam('<?php print $ez_username; ?>', '<?php print $team['0']['id']; ?>')" class="btn btn-info btn-sm">Join Team</button></td>
                        	  	</tr>
                        <?php } ?>
                    <?php } else { ?>
                    	<small>Sorry, you have not received any team invites yet</small>
                    <?php } ?>
                 <?php } ?>
                        </table>
				 </div>		  
                </div>
              </div>

          </div>
        
	</div>

<script src="<?php print $site_url; ?>/js/ckeditor/ckeditor.js"></script>
<?php include('footer.php'); ?>