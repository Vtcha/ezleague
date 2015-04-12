<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Edit Tournament Rules</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row">
    <div class="col-lg-10">
    	<?php if( isset($_GET['id'] ) ) { 
            $tournament_id = $_GET['id'];
             $tournament = $ez_tournament->get_tournament( $tournament_id );
             $rules  = $ez_tournament->get_rules( $tournament_id );
     ?>
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-sitemap"></i> <em><?php $ez_tournament->get_tournament_name( $tournament_id ); ?></em> Tournament Rules
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
				<form id="editRules" method="POST">
				 <input type="hidden" id="tournament_id" value="<?php echo $tournament_id; ?>" />
		       	  <textarea class="ckeditor form-control" id="body"><?php echo $tournament['rules']; ?></textarea>
		      	   <hr/>	
		      		<button type="submit" class="btn btn-primary">Edit</button>
		        	<button type="button" class="btn btn-default">Cancel</button>
		          <div class="success">
		          <span class="success_text"></span>
		          </div>
		       </form>
	    <?php } else { ?>
	    	<h3>No Tournament was selected</h3>
	    <?php } ?>
            </div>
            <!-- /.panel-body -->
        </div>
            <!-- /.panel -->
    </div>
     	<!-- /.col-lg-8 -->
</div>
<!-- /.row -->