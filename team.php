<?php include('header.php'); ?>

	<div class="row">
		  
          <?php include('sidebar.php'); ?>
          <div class="col-lg-10">
              <div class="panel panel-primary">
               <?php 
               		if(isset($_GET['id'])) { 
               			$id = $_GET['id']; 
               			 $team_details = $ez->getTeam($id);
               	?>
                <div class="panel-heading">
                  <h3 class="panel-title"><span class="bolder"><?php echo $current_game; ?></span> - <span class="italic"><?php echo $team_details['0']['guild']; ?></span></h3>
                </div>
                <div class="panel-body">
                 <div class="col-sm-3">
                  <h3 class="center">Details</h3>
                  <div class="well">
                   <img src="<?php print $site_url; ?>/img/team_logos/<?php print $team_details['0']['logo']; ?>" class="img-responsive" />
                 	<h4 class="left">GM <span class="gm"><?php print $team_details['0']['gm']; ?></span></h4>
                 	<h4 class="left">AGM <span class="agm"><?php print $team_details['0']['agm']; ?></span></h4>
                 	<h4 class="left">URL <span class="website"><a href="<?php print $team_details['0']['website']; ?>">team site</a></span></h4>
                 	<hr/>
                 	<h4 class="left">Record <span class="website"><?php print $wins . "-" . $losses; ?></span></h4>
                  </div>
                 </div>
                 <div class="col-sm-4">
                  <h3 class="center">Recent Matches</h3>
                  <div class="well">
                 	<table class="table table-striped table-hover ">
					   <thead>
					    <tr>
					      <th></th>
					      <th>vs</th>
					      <th></th>
					    </tr>
					   </thead>
					   <tbody>			 
					    <?php $matches = $ez->getTeamRecentMatches($id); 
								 $wins   = 0;
							 	 $losses = 0;
							 foreach($matches as $match) { 	
						 		 if($match['challenger'] == $id) {
						 		 	if($match['challenger_score'] > $match['challengee_score']) {
						 		 		$result = 'win';	
						 		 		 $wins++;
						 		 	} else {
						 		 		$result = 'loss';	
						 		 		 $losses++;
						 		 	}
						 		 } elseif($match['challengee'] == $id) {
						 		 	if($match['challengee_score'] > $match['challenger_score']) {
						 		 		$result = 'win';
						 		 		 $wins++;
						 		 	} else {
						 		 		$result = 'loss';
						 		 		 $losses++;
						 		 	}	 	
						 		 }
						 ?>
							    <tr>
							      <td class="<?php print $result; ?>"><?php print substr(ucfirst($result), 0, 1); ?></td>
							      <td><?php print ($match['challenger'] == $id ? $match['g_challengee'] : $match['g_challenger']); ?></td>
							      <td><?php print date('m/d/y', strtotime($match['match_date'])); ?> <a href="<?php print $site_url; ?>/challenges/view/id/<?php print $match['id']; ?>" class="btn btn-info btn-xs"><i class="fa fa-search"></i> View Match</a></td>
							    </tr>
						 <?php } ?>
					   </tbody>
					  </table>
                  </div>
                 </div>
                 <div class="col-sm-5">
                  <h3 class="center">Roster</h3>
	                 <table class="table table-striped table-hover ">
					   <thead>
					    <tr>
					      <th class="hidden-xs">#</th>
					      <th>Username</th>
					      <th></th>
					    </tr>
					   </thead>
					   <tbody>
	<?php $team_members = $ez->getTeamMembers($id); ?>
	<?php foreach($team_members as $member) { ?>				 
					    <tr>
					      <td class="hidden-xs"><?php print $member['id']; ?></td>
					      <td><?php print $member['username']; ?></td>
					      <td><a href="<?php echo $site_url; ?>/users/id/<?php echo $member['id']; ?>" class="btn btn-info btn-xs"><i class="fa fa-search"></i> View</a></td>
					    </tr>
	<?php } ?>				    
					   </tbody>
					  </table>
					 </div>
                </div>
                <?php } else { ?>
                 <h3>Please select a news post to View</h3>
                <?php } ?>
              </div>

          </div>
        
	</div>


<?php include('footer.php'); ?>