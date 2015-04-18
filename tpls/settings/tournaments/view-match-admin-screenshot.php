<h4>Match Screen Shots</h4>
	<form id="matchScreenshot" method="POST" action="lib/submit/screenshot-upload.php" role="form" enctype="multipart/form-data">
	 <input type="hidden" id="match-id" name="match-id" value="<?php echo $match_details['id']; ?>" />
	 <input type="hidden" id="match-uploader" name="match-uploader" value="<?php echo $profile['username']; ?>" />
	 <label class="control-label">Size <em>limited to 1MB</em></label>
	 <div class="form-group fileinput fileinput-new" data-provides="fileinput">
		<input class="form-control" type="file" name="file"/>
	 </div>
	 <div class="form-group">
	 	<br/>
	 	<button type="submit" class="btn btn-success">Upload</button>
	 </div>
	</form>
	 <div class="row">
	  <div class="col-md-12">
	  	<div class="success screens">
	  		<span class="success"></span>
	  	</div>
<h4>Current Screenshots</h4>
	  </div>
	  <div class="col-md-12">
	 	<?php $screenshots = $ez_league->get_match_screenshots( $match_details['id'] ); ?>
	 	<?php $total_screenshots = count( $screenshots ); ?>
	 	<?php if( $total_screenshots > 0 ) { ?>
	 		<?php foreach( $screenshots as $screenshot ) { ?>
	 			<div class="col-md-4 screenshot">
			 		<a href="screenshots/<?php echo $screenshot['file']; ?>">
			 			<img src="screenshots/<?php echo $screenshot['file']; ?>" width="50px" height="50px" />
			 		</a><br/>
			 		<span class="text-success"><span class="bolder">by</span> <?php echo $screenshot['uploader']; ?></span>
			 		<?php if( $screenshot['uploader'] == $profile['username'] ) { ?>
			 			<button onclick="deleteScreenshot('<?php echo $screenshot['id']; ?>')" class="btn btn-warning btn-xs">Delete</button>
			 		<?php } ?>
			 	</div>
	 		<?php } ?>
	 	<?php } else { ?>
	 		<p>No screenshots, please upload some.</p>
	 	<?php } ?>
	   </div>
	 </div>