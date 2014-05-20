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
                  <h3 class="panel-title"><strong><?php print $site_name; ?></strong> - <em>Forum</em></h3>
                </div> 
                <div class="panel-body">
                  <?php $sections = $forum->getSections(); ?>
                   <?php foreach($sections as $section) { ?>
                    <h4><?php print $section['section_name']; ?></h4>
                     <a href="<?php print $site_url; ?>/forum/create_topic/id/<?php print $section['id']; ?>" class="forum-topic"><i class="fa fa-pencil"></i> Create Topic</a>
                     <?php $topics = $forum->getTopics($section['id']); ?>
                          <table class="table table-striped table-hover ">
						   <thead>
						    <tr>	
						      <th>Topic</th>
						      <th>Views</th>
						      <th>Replies</th>
						      <th>Last Activity</th>
						      <th></th>
						    </tr>
						   </thead>
						   <tbody>			   
					 <?php foreach($topics as $topic) { ?>
						    <tr>
						      <td><a href="<?php print $site_url; ?>/forum/topic/id/<?php print $topic['id']; ?>" class="forum-topic"><?php print $topic['topic']; ?></a></td>
						      <td><?php print $topic['view']; ?></td>
						      <td><?php print $topic['reply']; ?></td>
						      <td><small>by <?php print $topic['recent_username'] . " " . date('F d, Y h:ia', strtotime($topic['recent_modified'])); ?></small></td>
						      <td></td>
						    </tr>	
					 <?php } ?>		    
						   </tbody>
						 </table>
                   <?php } ?>
                </div>
              </div>
          </div>
        
	</div>


<?php include('footer.php'); ?>