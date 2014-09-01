<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">View League Matches</h1>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
        <?php if( isset( $_GET['id'] ) && is_numeric( $_GET['id'] ) ) { 
        		$league_id	= trim( $_GET['id'] );
        		$league = $ez_league->get_league( $league_id );
        ?>
            <div class="panel-heading">
                <i class="fa fa-sitemap"></i> Current Matches for <em><?php echo $league['league']; ?></em>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                            	<th>Week</th>
                                <th>Home</th>
                                <th>Away</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
            <?php $matches = $ez_match->get_matches( $league_id ); ?>
                        <tbody>
              <?php foreach( $matches as $match ) { ?>
                            <tr>
                                <td><?php echo $match['week']; ?></td>
                                <td>
                                	<?php 
                                		if( $match['status'] == 1 ) {
                                			if( $match['winner'] == $match['home_id'] ) {
                                				echo '<span class="text-success bolder">' . $match['home'] . '</span>';
                                			} else {
                                				echo '<span class="text-danger">' . $match['home'] . '</span>';
                                			}
                                		} else {
                                			echo $match['home'];
                                		}
                                	?>
                                </td>
                                <td>
                                	<?php 
                                		if( $match['status'] == 1 ) {
                                			if( $match['winner'] == $match['away_id'] ) {
                                				echo '<span class="text-success bolder">' . $match['away'] . '</span>';
                                			} else {
                                				echo '<span class="text-danger">' . $match['away'] . '</span>';
                                			}
                                		} else {
                                			echo $match['away'];
                                		}
                                	?>
                                </td>
                                <td>
                                	<?php echo ( $match['status'] == 1 ? '<span class="text-success bolder">completed</span>' : '<span class="text-warning italic">pending</span>' ); ?>
                                </td>
                                <td><a href="matches.php?page=match&id=<?php echo $match['id']; ?>" class="btn btn-primary btn-xs">View Match</a></td>
                            </tr>
               <?php } ?>
                        </tbody>
                     </table>
                 </div>
            </div>
         <?php } else { ?>
         <h3>Not a valid league id</h3>
         <?php } ?>
        </div>
    </div>
</div>
<!-- /.row -->