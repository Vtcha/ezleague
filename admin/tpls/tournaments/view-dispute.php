<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">View Tournament Matches</h1>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <?php if( isset( $_GET['id'] ) && is_numeric( $_GET['id'] ) ) { 
        		$dispute_id	= trim( $_GET['id'] );
        		$dispute = $ez_tournament->get_dispute( $dispute_id );
        ?>
        <div class="col-lg-5">
	        <div class="panel panel-default">
	            <div class="panel-heading">
	                <i class="fa fa-cogs"></i> Dispute Details
	            </div>
	            <div class="panel-body">
	                <div class="table-responsive">
	                    <table class="table">
             				<tr>
             					<td><strong>Match ID</strong></td>
             					<td><a href="tournament-match.php?id=<?php echo $dispute['match']; ?>"><?php echo $dispute['match']; ?></a></td>
             				</tr>
             				<tr>
             					<td><strong>Category</strong></td>
             					<td><?php echo $dispute['cat']; ?></td>
             				</tr>
             				<tr>
             					<td><strong>Filed By</strong></td>
             					<td><?php echo $dispute['filed']; ?></td>
             				</tr>
             				<tr>
             					<td><strong>Tournament</strong></td>
             					<td><a href="tournaments.php?page=edit&id=<?php echo $dispute['tid']; ?>"><?php echo $dispute['tournament']; ?></a></td>
             				</tr>
             				<tr>
             					<td><strong>Status</strong></td>
             					<td>
             					<?php echo ( $dispute['status'] == 1 ? '<span class="text-success bolder">Resolved</span>' : '<span class="text-warning">Open</span>' ); ?>
             					</td>
             				</tr>
	                     </table>
	                 </div>
	            </div>
	        </div>
	    </div>
	    <div class="col-lg-5">
	        <div class="panel panel-default">
	            <div class="panel-heading">
	                <i class="fa fa-comment"></i> Description
	            </div>
	            <div class="panel-body">
	                <?php echo $dispute['desc']; ?>
	            </div>
	        </div>
	    </div>
         <?php } else { ?>
         <h3>Not a valid tournament match id</h3>
         <?php } ?>
    </div>
</div>
<!-- /.row -->