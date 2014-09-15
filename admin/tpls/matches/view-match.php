<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">View League Matches</h1>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <?php if( isset( $_GET['id'] ) && is_numeric( $_GET['id'] ) ) { 
        		$match_id	= trim( $_GET['id'] );
        		$match = $ez_match->get_match( $match_id );
        ?>
        <div class="col-lg-5">
         <div class="col-lg-12">
	        <div class="panel panel-default">
	            <div class="panel-heading">
	                <i class="fa fa-cogs"></i> Match Details <em><?php echo $match['home']; ?></em> vs <em><?php echo $match['away']; ?></em>
	            </div>
	            <div class="panel-body">
	                <div class="table-responsive">
	                    <table class="table">
             				<tr>
             					<td><strong>Home</strong></td>
             					<td><?php echo $match['home']; ?></td>
             				</tr>
             				<tr>
             					<td><strong>Away</strong></td>
             					<td><?php echo $match['away']; ?></td>
             				</tr>
             				<tr>
             					<td><strong>Match Date</strong></td>
             					<td><?php echo date( 'F d, Y', strtotime( $match['date'] ) ); ?></td>
             				</tr>
             				<tr>
             					<td><strong>Match Time</strong></td>
             					<td><?php echo $match['time']; ?> <?php echo $match['zone']; ?></td>
             				</tr>
             				<tr>
             					<td><strong>Stream URL</strong></td>
             					<td>
             					<?php if( isset( $match['stream_url'] ) ) { ?>
             						<a href="<?php echo $match['stream_url']; ?>" target="_blank"><?php echo $match['stream_url']; ?></a>
             					<?php } else { ?>
             						Not Set
             					<?php } ?>
             					</td>
             				</tr>
             				<tr>
             					<td><strong>Status</strong></td>
             					<td>
             					<?php echo ( $match['status'] == 1 ? '<span class="text-success bolder">completed</span>' : '<span class="text-warning">pending</span>' ); ?>
             					</td>
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
	                <form id="editScore" role="form" method="POST">
	                 <input type="hidden" id="match_id" value="<?php echo $match_id; ?>" />
	                 <input type="hidden" id="home" value="<?php echo $match['home_id']; ?>" />
	                 <input type="hidden" id="away" value="<?php echo $match['away_id']; ?>" />
	                	<div class="form-group">
	                		<small class="italic">modifying the score will update the <strong>winner</strong> and <strong>loser</strong></small>
	                	</div>
	                	<div class="form-group col-lg-6">
	                		<label>Home Score</label>
	                		<input type="text" class="form-control" id="home-score" value="<?php echo $match['home_score'] ?>" />
	                	</div>
	                	<div class="form-group col-lg-6">
	                		<label>Away Score</label>
	                		<input type="text" class="form-control" id="away-score" value="<?php echo $match['away_score'] ?>" />
	                	</div>
	                	<div class="form-group col-lg-12">
	                		<button type="submit" class="btn btn-success">Edit Score</button>
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
	                <i class="fa fa-comment"></i> Match Information
	            </div>
	            <div class="panel-body">
	               <div class="table-responsive">
	                    <table class="table">
             				<tr>
             					<td><strong>Server IP</strong></td>
             					<td><?php echo $match['server_ip']; ?></td>
             				</tr>
             				<tr>
             					<td><strong>Server Password</strong></td>
             					<td><?php echo $match['server_password']; ?></td>
             				</tr>
             				<tr>
             					<td><strong>Match Moderator</strong></td>
             					<td><?php echo $match['moderator']; ?></td>
             				</tr>
	                     </table>
	                 </div>
	            </div>
	        </div>

	        <div class="panel panel-default">
	            <div class="panel-heading">
	                <i class="fa fa-comment"></i> Chat Log
	            </div>
	            <div class="panel-body">
	                <?php 
				 		$chat = (array) json_decode( $match['chat'], TRUE ); 
				 		foreach( $chat as $message ) {
							echo '<p><em>' . $message['date'] . '</em><br><strong>' . $message['username'] . '</strong>: ' . $message['message'] . '</p>';
				 		}
				 	?>
	            </div>
	        </div>
	    </div>
         <?php } else { ?>
         <h3>Not a valid match id</h3>
         <?php } ?>
    </div>
</div>
<!-- /.row -->