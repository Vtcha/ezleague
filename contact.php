<?php include('header.php'); ?>

	<div class="row">
		  
          <?php include('sidebar.php'); ?>
           <?php $settings = $ez->getSiteSettings(); ?>
          <div class="col-lg-10">
              <div class="panel panel-primary">
                <div class="panel-heading">
                  <h3 class="panel-title"><span class="bolder"><?php echo $site_name; ?></span> - <span class="italic">Contact Us</span></h3>
                </div>
                <div class="panel-body">    
 	 		   	 <div class="col-lg-5"> 
 	 		   	 	<div class="success">
	                  <span class="success_text"></span>
	                </div>
 	 		   	      <h3>Contact Us</h3>
 	 		     		<small>Send us an email below</small>
                        <form role="form" id="contactEmail" name="contactEmail" method="POST">
                         <input type="hidden" name="contact-to" id="contact-to" value="<?php print $settings['email']; ?>" />
                            <fieldset>
                                <div class="form-group">
					              <h5>Name</h5>
					              <input id="contact-name" class="form-control password placeholder" placeholder="Your Name" name="contact-name" autocomplete="off" type="text">
					            </div>
					            <div class="form-group">
					              <h5>E-Mail</h5>
					              <input id="contact-email" class="form-control password placeholder" placeholder="Your E-Mail" name="contact-email" autocomplete="off" type="text">
					            </div>
					            <div class="form-group">
					              <h5>Message</h5>
					              <textarea id="contact-message" class="form-control textarea" name="contact-message"></textarea>
					            </div>
					            <div class="form-group">
					              <h5>What is 2 + 2?</h5>
					              <input id="contact-captcha" class="form-control password placeholder" placeholder="CAPTCHA" name="contact-captcha" autocomplete="off" type="text">
					            </div>
                                <!-- Change this to a button or input when using this as a form -->
                                <button type="submit" class="btn btn-lg btn-primary btn-sm">Send Message</button>
                            </fieldset>
                        </form>
				 </div>		  
				 <div class="col-lg-5"> 
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


<?php include('footer.php'); ?>