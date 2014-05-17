<?php include('header.php'); ?>

	<div class="row">
		  
          <?php include('sidebar.php'); ?>
           <?php $settings = $ez->getSiteSettings(); ?>
          <div class="col-lg-10">
              <div class="panel panel-primary">
                <div class="panel-heading">
                  <h3 class="panel-title"><span class="bolder"><?php echo $site_name; ?></span> - <span class="italic">About <?php print $site_name; ?></span></h3>
                </div>
                <div class="panel-body">    
 	 		   	 <div class="col-lg-8"> 
 	 		   	      <h3>About</h3>
 	 		     		<small>A brief history of our story</small>
                        <?php print $settings['about']; ?>
				 </div>		  		  
                </div>
              </div>

          </div>
        
	</div>


<?php include('footer.php'); ?>