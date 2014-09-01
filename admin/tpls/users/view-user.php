<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">View Site Users</h1>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <?php if( isset( $_GET['id'] ) && is_numeric( $_GET['id'] ) ) { 
        		$user_id	= trim( $_GET['id'] );
        		$user = $ez_user->get_user( $user_id ); 
        ?>
        <div class="col-lg-5">
         <div class="col-lg-12">
	        <div class="panel panel-default">
	            <div class="panel-heading">
	                <i class="fa fa-cogs"></i> User Details <em><?php echo $user['username']; ?></em>
	            </div>
	            <div class="panel-body">
	                <div class="table-responsive">
	                    <table class="table">
             				<tr>
             					<td><strong>Username</strong></td>
             					<td><?php echo $user['username']; ?></td>
             				</tr>
	                     </table>
	                 </div>
	            </div>
	        </div>
	      </div>
	      <div class="col-lg-12">
	        <div class="panel panel-default">
	            <div class="panel-heading">
	                Match Score
	            </div>
	            <div class="panel-body">
	                <form id="updatePassword" role="form" method="POST">
	                 <input type="hidden" id="user-id" value="<?php echo $user['id']; ?>" />
	                	<div class="form-group col-lg-6">
	                		<label>Password</label>
	                		<input type="password" class="form-control" id="home-score" />
	                	</div>
	                	<div class="form-group col-lg-6">
	                		<label>Confirm Password</label>
	                		<input type="password" class="form-control" id="away-score" />
	                	</div>
	                	<div class="form-group col-lg-12">
	                		<button type="submit" class="btn btn-success">Update Password</button>
	                		<button type="reset" class="btn btn-warning">Reset</button>
	                	</div>
	                </form>
	                <div class="success col-lg-12"><span class="success_text"></span></div>
	            </div>
	        </div>
	      </div>
	    </div>
	    <div class="col-lg-5">
	        <div class="panel panel-default">
	            <div class="panel-heading">
	                <i class="fa fa-comment"></i> Chat Log
	            </div>
	            <div class="panel-body">
	                
	            </div>
	        </div>
	    </div>
         <?php } else { ?>
         <h3>Not a valid match id</h3>
         <?php } ?>
    </div>
</div>
<!-- /.row -->