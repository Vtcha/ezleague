<?php include('header.php'); ?>
<?php unset($_SESSION['ez_game']); ?>
<?php 
	include ('./lib/forum.class.php');
	$forum = new ezForum(); 
?>
	<div class="row">
		  
          <?php include('sidebar.php'); ?>
          <div class="col-lg-10">
              <div class="panel panel-primary">
                <div class="panel-heading">
                  <h3 class="panel-title"><strong><?php print $site_name; ?></strong> - <em>View Topic</em></h3>
                </div> 
                <div class="panel-body">
                 <a href="<?php print $site_url; ?>/forum/home" class="btn btn-info btn-sm"><i class="fa fa-search"></i> Back to Topics</a>
                 <hr/>
                 <?php if(isset($_GET['id'])) { ?>
                  <?php $topic_id = trim($_GET['id']); ?>
                   <?php $forum->updateTopicViews($topic_id); ?>
                  <div class="col-lg-12">
                  	<?php $replies = $forum->getTopicResponses($topic_id); ?>
                  	 <table class="table table-striped table-hover" style="border-radius:5px;">
                  	  <?php $original = $forum->getTopicMessage($topic_id); ?>
                  	  	<?php $section_id = $original['0']['section']; ?>
                  	  	<tr>
						  <td style="background:#EDEDED !important;border-radius:5px;" colspan="2">#1 <em>Original Post</em></td>
						</tr>
                  	 	<tr>
                  	 	  <td style="border-right:1px dashed #CCCCCC;width:25%;">
                  	 	  	<small><strong><a href="<?php print $site_url; ?>/users/id/<?php print $original['0']['starter_user_id']; ?>"><?php print $original['0']['starter_username']; ?></a></strong></small><br/>
                  	 	  	<small><em>post count <?php print $forum->getUserPostCount($original['0']['starter_username']); ?></em></small><br/>
                  	 	  	<small><em><?php print date('F d, Y h:ia', strtotime($original['0']['datetime'])); ?></em></small>	
                  	 	  </td>
                  	 	  <td>
                  	 	  	<?php print $original['0']['detail']; ?>
                  	 	  	<hr class="signature" />
                  	 	  	<?php print $forum->getUserSignature($original['0']['starter_user_id']); ?>	
                  	 	  </td>
                  	 	 </tr>
                  	   <?php $i=1; foreach($replies as $reply) { $i++; ?> 
                  	     <tr>
						  <td style="background:#CCCCCC !important;border-radius:5px;" colspan="2"><?php print "#" . $i; ?></td>
						 </tr>
						 <?php if($i % 2 == 0){ ?>
                  	 	 <tr style="background:#EDEDED;">
                  	 	 <?php } else { ?> 
                  	 	 <tr>
                  	 	 <?php } ?>
                  	 	  <td style="border-right:1px dashed #CCCCCC;width:25%;">
                  	 	  	<small><strong><a href="<?php print $site_url; ?>/users/id/<?php print $reply['a_user_id']; ?>"><?php print $reply['a_username']; ?></a></strong></small><br/>
                  	 	  	<small><em>post count <?php print $forum->getUserPostCount($reply['a_username']); ?></em></small><br/>
                  	 	  	<small><em><?php print date('F d, Y h:ia', strtotime($reply['a_datetime'])); ?></em></small>
                  	 	  </td>
                  	 	  <td>
                  	 	  	<?php print $reply['a_answer']; ?>
                  	 	  	<hr class="signature" />
                  	 	  	<?php print $forum->getUserSignature($reply['a_user_id']); ?>	
                  	 	  </td>
                  	 	 </tr>
                  	   <?php } ?>
                  	 </table>
                  	 
                  	 <hr class="signature" />
                  </div>
                  
                  <div class="col-lg-8">
                  
                   <?php if(isset($_SESSION['ez_username'])) { ?>
                   <form role="form" name="forumReply" id="forumReply" method="POST">
 	 		   	      <input type="hidden" name="topic-id" id="topic-id" value="<?php print $topic_id; ?>" />
 	 		   	      <input type="hidden" name="section-id" id="section-id" value="<?php print $section_id; ?>" />
		            <div class="form-group">
		              <label>Message</label>
		              <textarea id="topic-body" class="ckeditor form-control textarea" placeholder="Message" name="topic-body" type="text"></textarea>
		            </div>
		            <div class="form-group">
		        	  <button type="submit" class="btn btn-primary">Add Response</button>
		        	  <button type="reset" class="btn btn-default">Cancel</button>
		        	</div>
	     	       </form> 
	     	        <div class="success">
                     <span class="success_text"></span>
                    </div>
                   <?php } ?>
	     	      </div>
	     	     <?php } else { ?> 
	     	       <h4>Sorry, no Section ID was given</h4>
	     	     <?php } ?>
                </div>
              </div>
          </div>
        
	</div>

<script src="<?php print $site_url; ?>/js/ckeditor/ckeditor.js"></script>
<?php include('footer.php'); ?>