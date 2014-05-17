<?php include('header.php'); ?>

	<div class="row">
		  
          <?php include('sidebar.php'); ?>
           <?php if(isset($_GET['view']) && !isset($_GET['id'])) { ?>
          <div class="col-lg-10">
              <div class="panel panel-primary">
                <div class="panel-heading">
                  <h3 class="panel-title"><span class="bolder"><?php echo $site_name; ?></span> - <span class="italic">My Inbox</span></h3>
                </div>
                <div class="panel-body">    
 	 		   	 <div class="col-lg-10"> 
 	 		   	      <h3>Message Inbox</h3>
 	 		   	       <?php $messages = $ez->getInbox($ez_username); ?>
 	 		   	       <a href="../inbox/send" class="btn btn-success btn-sm"><i class="fa fa-pencil"></i> Compose New</a>
 	 		   	       <hr/>
 	 		     		<table class="table table-striped table-hover ">
						   <thead>
						    <tr>
						      <th>Date</th>
						      <th>Sender</th>
						      <th>Subject</th>
						      <th>Status</th>
						      <th></th>
						    </tr>
						   </thead>
						   <tbody>			   
			 <?php foreach($messages as $message) { ?>		 
						    <tr>
						      <td class="italic"><?php print date('F d, Y h:ia', strtotime($message['date'])); ?></td>
						      <td><?php print $message['sender']; ?></td>
						      <td><?php print $message['subject']; ?></td>
						      <td><?php print ($message['status'] == 'unread' ? '<span class=\'text-success bolder\'>unread</span>' : '<span class=\'text-primary\'>read</span>'); ?></td>
						      <td><a href="id/view/<?php print $message['msg_id']; ?>" class="btn btn-info btn-sm"><i class="fa fa-search"></i> View</a></td>
						    </tr>
			<?php unset($msg_user_status); } ?>				    
						   </tbody>
						  </table>
				 </div>		  	  
                </div>
              </div>
          </div>
           <?php } elseif(isset($_GET['send'])) { ?>
           <div class="col-lg-10">
              <div class="panel panel-primary">
                <div class="panel-heading">
                  <h3 class="panel-title"><span class="bolder"><?php echo $site_name; ?></span> - <span class="italic">My Inbox</span></h3>
                </div>
                <div class="panel-body">    
 	 		   	 <div class="col-lg-5"> 
 	 		   	  <a href="view" class="btn btn-info btn-sm">Back to Inbox</a>
 	 		   	 	<div class="success">
	                  <span class="success_text"></span>
	                </div>
 	 		   	      <h3>Send Message</h3>
 	 		     		<form role="form" name="ezLeagueMessage" id="ezLeagueMessage" method="POST">
				            <div class="form-group">
				              <h5>Recipients</h5>
				              <small>separate users by command (ex: stoop, stoop2)</small>
				              <input id="message-recipients" class="form-control text placeholder" placeholder="Recipient Usernames" name="recipients" type="text">
				            </div>
				            <div class="form-group">
				              <h5>Subject</h5>
				              <input id="message-subject" class="form-control text placeholder" placeholder="Subject" name="subject" type="text">
				            </div>
				            <div class="form-group">
				              <h5>Message</h5>
				              <textarea id="message-message" class="form-control textarea" placeholder="Message" name="message" type="text"></textarea>
				            </div>
				            <div class="form-group">
				        	  <button type="submit" class="btn btn-primary">Send</button>
				        	  <button type="reset" class="btn btn-default">Cancel</button>
				        	</div>
				        </form>
				 </div>		  	  
                </div>
              </div>
          </div>
           <?php } elseif(isset($_GET['id']) && isset($_GET['view'])) { $id = trim($_GET['id']); ?>
          <div class="col-lg-10">
              <div class="panel panel-primary">
                <div class="panel-heading">
                  <h3 class="panel-title"><span class="bolder"><?php echo $site_name; ?></span> - <span class="italic">My Inbox</span></h3>
                </div>
                <div class="panel-body">    
 	 		   	 <div class="col-lg-10"> 
 	 		   	      <h3>Viewing Message #<?php print $id; ?></h3>
 	 		   	      <?php 
 	 		   	       $access = $ez->checkMessageAccess($id, $ez_username);
 	 		   	        if($access == true) {
 	 		   	      		$message = $ez->getMessage($id); 
							 //mark the message as read
 	 		   	      		  $ez->markRead($id, $ez_username);
 	 		   	       ?>
 	 		   	       <a href="#reply" class="btn btn-success btn-sm"><i class="fa fa-mail-reply"></i> Reply</a>
 	 		   	      <hr/>
 	 		   	       <div class="panel panel-primary">
		                <div class="panel-heading">
		                  <h3 class="panel-title">
		                  	<span class="bolder"><?php echo $message['0']['subject']; ?></span> 
		                  	<span class="pull-right">sent by <span class="italic"><?php print $message['0']['sender']; ?></span> <?php print date('F d, Y h:ia', strtotime($message['0']['date'])); ?></span>
		                  </h3>
		                </div>
		                <div class="panel-body">    
		 	 		   	 <div class="col-lg-12"> 
		 	 		   	     <?php print $message['0']['message']; ?>
						 </div>		  	  
		                </div>
		               </div>
		               
		              <?php $replies = $ez->getMessageReplies($id, $ez_username); $i = 0; ?>
		               <?php foreach ($replies as $reply) { $i++; ?>
		                 <?php if($i % 2 ==0) { ?>
                  		  		<div class="panel panel-primary">
				                 <div class="panel-heading">
				                  <h3 class="panel-title">
				                  	<span><span class="italic"><?php print $reply['sender']; ?></span> replied  <?php print date('F d, Y h:ia', strtotime($reply['date'])); ?></span> 
				                  	<span class="pull-right">#<?php print $i; ?></span>
				                  </h3>
				                </div>
                  		   <?php } else { ?> 
                  		   		<div class="panel panel-default">
				                 <div class="panel-heading">
				                  <h3 class="panel-title">
				                  	<span class="text-primary"><span class="italic"><?php print $reply['sender']; ?></span> replied <?php print date('F d, Y h:ia', strtotime($reply['date'])); ?></span> 
				                    <span class="pull-right text-primary">#<?php print $i; ?></span>
				                  </h3>
				                </div>
                  		   <?php } ?>
			                <div class="panel-body">    
			 	 		   	 <div class="col-lg-12"> 
			 	 		   	     <?php print $reply['message']; ?>
							 </div>		  	  
			                </div>
			               </div>
			           <?php } ?>
			               
		               <hr/>
		               
		               <div class="panel panel-default">
		                <div class="panel-heading">
		                  <h3 class="panel-title">
		                  	<a name="reply"><span class="bolder text-primary">Send Response</span></a> 
		                  </h3>
		                </div>
		                <div class="panel-body">    
		 	 		   	 <div class="col-lg-12"> 
		 	 		   	     <form role="form" name="ezLeagueReply" id="ezLeagueReply" method="POST">
		 	 		   	      <input type="hidden" name="message-id" id="message-id" value="<?php print $message['0']['id']; ?>" />
		 	 		   	      <input type="hidden" name="message-subject" id="message-subject" value="<?php print $message['0']['subject']; ?>" />
					            <div class="form-group">
					              <h5>Message</h5>
					              <textarea id="message-message" class="form-control textarea" placeholder="Message" name="message" type="text"></textarea>
					            </div>
					            <div class="form-group">
					        	  <button type="submit" class="btn btn-primary">Send</button>
					        	  <button type="reset" class="btn btn-default">Cancel</button>
					        	</div>
				     	      </form>
				     	      
				     	      <div class="success">
			                   <span class="success_text"></span>
			                  </div>
	                
						 </div>		  	  
		                </div>
		               </div>
 	 		     	 <?php } else { ?>
 	 		     	  <h3>Sorry, you do not have access to this message</h3>
 	 		     	 <?php } ?>
				 </div>		  	  
                </div>
              </div>
          </div>
          <?php } ?>
	</div>


<?php include('footer.php'); ?>