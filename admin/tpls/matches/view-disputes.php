<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">View League Match Disputes</h1>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-sitemap"></i> Current Match Disputes</em>
            </div>
            <div class="panel-body">
            <?php 
	            if( isset( $_GET['status'] ) ) {
	            	$status = trim( $_GET['status'] );
	            } else {
	            	$status = 'all';
	            }
	            
	            if( isset( $_GET['category'] ) ) {
	            	$category = trim( $_GET['category'] );
	            } else {
	            	$category = 'all';
	            }
            ?>
            	<form class="form-inline" id="sortDisputes" name="sortDisputes" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="GET" role="form">
            	 <input type="hidden" name="page" value="disputes" />
            		<label>Status</label>
            		<select class="form-control" name="status" onchange="this.form.submit();">
            			<option <?php echo ( $status == '' ? 'selected' : '' ); ?> value="">All</option>
            			<option <?php echo ( $status == 'open' ? 'selected' : '' ); ?> value="open">Open</option>
            			<option <?php echo ( $status == 'closed' ? 'selected' : '' ); ?> value="closed">Closed</option>
            		</select>
            		
            		<label>Category</label>
            		<select class="form-control" name="category" onchange="this.form.submit();">
            			<option <?php echo ( $category == '' ? 'selected' : '' ); ?> value="">All</option>
            			<option <?php echo ( $category == 'cheating' ? 'selected' : '' ); ?> value="cheating">Cheating</option>
            			<option <?php echo ( $category == 'player' ? 'selected' : '' ); ?> value="player">Player</option>
            			<option <?php echo ( $category == 'other' ? 'selected' : '' ); ?> value="other">Other</option>
            		</select>
            	</form>
            	<?php $disputes = $ez_match->get_disputes( $status, $category ); ?>
                <?php if( $disputes ) { ?>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                            	<th>Match ID</th>
                                <th>League</th>
                                <th>Category</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
              
                        <tbody>
              <?php foreach( $disputes as $dispute ) { ?>
                            <tr>
                                <td><?php echo $dispute['match'] ?></td>
                                <td><?php echo $dispute['league']; ?></td>
                                <td><?php echo $dispute['cat']; ?></td>
                                <td><?php echo ( $dispute['status'] == 1 ? '<span class="text-success">Closed</span>' : '<span class="text-danger bolder">Open</span>' ); ?></td>
                                <td><a href="matches.php?page=dispute&id=<?php echo $dispute['id']; ?>" class="btn btn-primary btn-xs">View Dispute</a></td>
                            </tr>
               <?php } ?>
                        </tbody>
                     </table>
                 </div>
                <?php } else { ?>
                    No disputes found
                <?php } ?>
            </div>
        </div>
    </div>
</div>
<!-- /.row -->