<?php include('header.php'); ?>

	<div class="row">
		  
          <?php include('sidebar.php'); ?>
          <div class="col-lg-10">
              <div class="panel panel-primary">
                <div class="panel-heading">
                  <h3 class="panel-title"><span class="bolder"><?php echo $current_game; ?></span> - <span class="italic">Predictions</span></h3>
                </div>
                <div class="panel-body">
                 <div class="col-lg-12">
                  	<?php if(isset($_GET['id'])) {
                  			$challenge_id = $_GET['id'];
                  			 $challenge_data = $ez->getChallenge($challenge_id);
                  			 $league_data = $ez->getLeague($challenge_data['league_id']);
                  			  $league_name = $league_data['0']['league'];
                  	?>
                  		
                  		<div class="col-lg-6">
                  		<h3>Make Prediction</h3>
                  		 <form name="matchPredicion" id="matchPrediction" method="POST">
                  		  <input type="hidden" name="predictionChallenge" id="predictionChallenge" value="<?php print $challenge_id; ?>" />
                  		 <div class="form-group">
                  		 <span class="text-primary bolder"><?php print $challenge_data['challenger']; ?></span> (+<?php print $ez->countPredictions($challenge_id, $challenge_data['challenger_id']); ?>)
                  		  <input type="radio" name="predictionWinner" id="predictionChallenger" value="<?php print $challenge_data['challenger_id']; ?>" />
                  		 vs
                  		 <span class="text-info bolder"><?php print $challenge_data['challengee']; ?></span> (+<?php print $ez->countPredictions($challenge_id, $challenge_data['challengee_id']); ?>)
                  		 <input type="radio" name="predictionWinner" id="predictionChallengee" value="<?php print $challenge_data['challengee_id']; ?>" />
                  		 </div>
                  		 <div class="form-group">
                  		  <strong>Match Date</strong> <?php print $challenge_data['match_date']; ?><br/>
                  		  <strong>League</strong> <?php print $league_name; ?>
                  		 </div>
                  		 <hr/>
                  		 <div class="form-group">
                  		  <label>Comment</label>
                  		   <textarea class="form-control" name="predictionComment" id="predictionComment"></textarea>
                  		 </div>
                  		 <div class="form-group">
                  		 	<button type="submit" name="submit" class="btn btn-primary btn-sm">Make Prediction</button>
                  		 </div>
                  		 </form>
                  		 </div>
                  		 
                  		 <div class="col-lg-6">
                  		<h3>Current Predictions</h3>
                  		 <?php $predictions = $ez->getPredictions($challenge_id); $i=0; ?>
                  		  <?php foreach($predictions as $prediction) { $i++; ?>
                  		   <?php if($i % 2 ==0) { ?>
                  		  		<p style="background:#F4F2F2;border-radius:5px;padding:5px;">
                  		   <?php } else { ?> 
                  		   		<p style="border-radius:5px;padding:5px;">
                  		   <?php } ?>
                  		  			<span class="text-primary bolder">#<?php print $i; ?></span> 
                  		  			<em><?php print date('F d, Y h:ia', strtotime($prediction['date'])); ?></em> 
                  		  			<span class="text-primary bolder">by</span> <strong><?php print $prediction['user']; ?></strong>
                  		  		    <small class="text-success">(+1 <?php print $ez->getTeamName($prediction['team']); ?>)</small>
                  		  			<br/>
                  		  			<?php print $prediction['comment']; ?>
                  		  				
                  		  		</p>
                  		  <?php } ?>
                  		 </div>
                  	  
                  	<?php 
                  		  } else { 
                  	?>
                  		<h3>No Challenge was selected</h3>  
                  		  	
                  	<?php } ?>
                  </div>
                </div>
                <div class="success">
				  <span class="success_text"></span>
				 </div>
              </div>

          </div>
	</div>


<?php include('footer.php'); ?>