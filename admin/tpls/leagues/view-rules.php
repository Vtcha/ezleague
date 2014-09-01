<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Edit League Rules</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row">
    <div class="col-lg-10">
    	<?php if( isset($_GET['id'] ) ) { 
            $league_id = $_GET['id'];
             $league = $ez_league->get_league( $league_id );
             $season = $ez_league->get_current_season( $league_id );
             $current_season = $season['season'];
             $rules  = $ez_league->get_rules( $league_id );
     ?>
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-sitemap"></i> <em><?php echo $league['league']; ?></em> League Rules
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
				<form id="editRules" method="POST">
				 <input type="hidden" id="league_id" value="<?php echo $league_id; ?>" />
		       	  <textarea class="ckeditor form-control" id="body"><?php echo $league['rules']; ?></textarea>
		      	   <hr/>	
		      		<button type="submit" class="btn btn-primary">Edit</button>
		        	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		          <div class="success">
		           <span class="success_text"></span>
		          </div>
		       </form>
	    <?php } else { ?>
	    	<h3>No League was selected</h3>
	    <?php } ?>
            </div>
            <!-- /.panel-body -->
        </div>
            <!-- /.panel -->
    </div>
     	<!-- /.col-lg-8 -->
</div>
<!-- /.row -->