<div class="panel panel-default">
<div class="panel-heading">
    <i class="fa fa-file-o"></i> Add Maps for <em><?php echo $league['league']; ?></em>
</div>
<div class="panel-body">
    <form id="addMap" method="POST">
    <input type="hidden" id="league_id" value="<?php echo $league_id; ?>" />
        <div class="form-group">    
            <label>League</label>
            <input disabled class="form-control" value="<?php echo $league['league']; ?>" />
        </div>
        <div class="form-group">
            <label>Map Name <small>(ex: de_dust2)</small></label>
            <input type="text" class="form-control" id="map" />
        </div>
        <button type="submit" class="btn btn-success">Add Map</button>
    </form>
</div>
</div>