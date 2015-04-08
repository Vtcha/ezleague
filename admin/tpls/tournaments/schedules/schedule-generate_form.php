<div class="panel panel-default">
<div class="panel-heading">
    <i class="fa fa-file-o"></i> Generate Matches for <em><?php echo $league['league']; ?></em>
</div>
<div class="panel-body">
    <form id="generateSchedule" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="GET">
    <input type="hidden" name="page" value="schedule" />
    <input type="hidden" name="id" value="<?php echo $league_id; ?>" />
    <input type="hidden" name="action" value="generate" />
        <div class="form-group">    
            <label>League</label>
            <input disabled class="form-control" value="<?php echo $league['league']; ?>" />
        </div>
        <div class="form-group">
            <label>Week <small>(must have no matches)</small></label>
            <select name="week" class="form-control">
                <option></option>
        <?php for ($i=1; $i<=$league['games']; $i++) { ?>
          <?php $matches_exist = $ez_schedule->check_week_matches( $league_id, $current_season, $i );?>
          <?php if( !$matches_exist ) { ?>
            <?php if( isset( $_GET['week'] ) ) { ?>
                <option <?php echo ( $_GET['week'] == $i ? 'selected' : '' ); ?> value="<?php echo $i; ?>">Week <?php echo $i; ?></option>
            <?php } else { ?>
                <option value="<?php echo $i; ?>">Week <?php echo $i; ?></option>
            <?php } ?>      
          <?php } else { ?>
          		<option disabled>Week <?php echo $i; ?> Matches Exist</option>
          <?php } ?>
        <?php } ?>
            </select>
        </div>
        <button <?php if( isset( $_GET['action'] ) && $_GET['action'] == 'generate' ) { echo 'disabled'; } ?> type="submit" class="btn btn-success">Generate Matches</button>
        <a href="leagues.php?page=schedule&id=<?php echo $league_id; ?>" class="btn btn-primary">Start Over</a>
    </form>
</div>
</div>