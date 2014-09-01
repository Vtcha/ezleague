<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Add Season</h1>
    </div>
</div>
<div class="row">
<?php if( isset( $_GET['id'] ) && is_numeric( $_GET['id'] ) ) { ?>
<?php 
		$league_id = trim( $_GET['id'] ); 
		$league = $ez_league->get_league( $league_id );		
?>
    <div class="col-lg-4">
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-file-o"></i> Create New <em><?php echo $league['league']; ?></em> Season
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
                     <form method="POST" id="createSeason">
                     <input type="hidden" id="league_id" value="<?php echo $league_id; ?>" />
                        <div class="form-group">
                            <label>Start Date</label>
                            <input class="form-control" id="start" placeholder="Start Date" />
                        </div>
                        <div class="form-group">
                            <label>End Date</label>
                            <input class="form-control" id="end" placeholder="End Date" />
                        </div>
                        <div class="form-group">
                            <label>End Registration</label>
                            <input class="form-control" id="registration" placeholder="End Registration" />
                        </div>
                        <div class="form-group">
                            <button class="btn btn-success" type="submit">Create Season</button>
                            <button class="btn btn-primary" type="reset">Clear Form</button>
                        </div>
                        <div class="success">
                          <span class="success_text"></span>
                        </div>
                      </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="col-lg-8">
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-sitemap"></i> Past <em><?php echo $league['league']; ?></em> Seasons
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-hover current_leagues">
                        <thead>
                            <tr>
                                <th>Season</th>
                                <th>Start</th>
                                <th>End</th>
                                <th>Registration End</th>
                                <th>Options</th>
                            </tr>
                        </thead>
            <?php $seasons = $ez_league->get_past_seasons( $league_id ); ?>
                        <tbody>
              <?php foreach( $seasons as $season ) { ?>
                            <tr>
                                <td><?php echo $season['season']; ?></td>
                                <td><?php echo date( 'F d, Y', strtotime( $season['start'] ) ); ?></td>
                                <td><?php echo date( 'F d, Y', strtotime( $season['end'] ) ); ?></td>
                                <td><?php echo date( 'F d, Y', strtotime( $season['register_end'] ) ); ?></td>
                                <td>
                                    <button type="button" onclick="deleteSeason('<?php echo $season['id']; ?>')" class="btn btn-danger btn-xs">Delete</button>
                                </td>
                            </tr>
               <?php } ?>
                        </tbody>
                     </table>
                    </div>
            </div>
        </div>
     </div>
<?php } else { ?>
<h3>That is not a valid league id</h3>
<?php } ?>
</div>