<div class="panel panel-default">
<div class="panel-heading">
    <i class="fa fa-group fa-fw"></i> Recent Team Registrations
     <a href="teams_view.php" class="btn btn-success btn-xs pull-right">View All Teams</a>
</div>
<div class="panel-body">
    <div class="row">
        <div class="col-lg-12">
            <div class="table-responsive">
                <table class="table table-bordered table-hover table-striped recent_users">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Guild</th>
                            <th>GM</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
        <?php $recent_teams = $ez_frontend->get_recent_teams(5); ?>
        <?php foreach($recent_teams as $team) { ?>
                        <tr>
                            <td>#<?php echo $team['id']; ?></td>
                            <td><?php echo $team['guild']; ?> (<?php echo $team['abbreviation']; ?>)</td>
                            <td><?php echo $team['gm']; ?></td>
                            <td><a href="teams_view.php?id=<?php echo $team['id']; ?>" class="btn btn-info btn-xs">View</a></td>
                        </tr>
        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</div>