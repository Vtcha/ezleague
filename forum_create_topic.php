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
                  <h3 class="panel-title"><strong><?php print $site_name; ?></strong> - <em>Create Topic</em></h3>
                </div> 
                <div class="panel-body">
                 <a href="<?php print $site_url; ?>/forum/home" class="btn btn-info btn-sm"><i class="fa fa-search"></i> Back to Topics</a>
                 <?php if(isset($_GET['id'])) { ?>
                  <?php $section_id = trim($_GET['id']); ?>
                   <h4>Create New Topic in <em><?php print $forum->getSectionName($section_id); ?></em></h4>
                  <div class="col-lg-8">
                   <?php if(isset($_SESSION['ez_username'])) { ?>
                   <form role="form" name="forumCreateTopic" id="forumCreateTopic" method="POST">
 	 		   	      <input type="hidden" name="topic-section" id="topic-section" value="<?php print $section_id; ?>" />
 	 		   	    <div class="form-group">
 	 		   	     <label>Title</label>
 	 		   	     <input type="text" name="topic-title" id="topic-title" class="form-control text" placeholder="Topic Title" />
 	 		   	    </div>
		            <div class="form-group">
		              <label>Message</label>
		              <textarea id="topic-body" class="ckeditor form-control textarea" placeholder="Message" name="topic-body" type="text"></textarea>
		            </div>
		            <div class="form-group">
		        	  <button type="submit" class="btn btn-primary">Create Topic</button>
		        	  <button type="reset" class="btn btn-default">Cancel</button>
		        	</div>
	     	       </form> 
	     	        <div class="success">
                     <span class="success_text"></span>
                    </div>
                   <?php } else { ?>
                   	<h4>Sorry, you must be logged in to create a topic</h4>
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