<div class="panel panel-default">
<div class="panel-heading">
    <i class="fa fa-file-o"></i> Teams in <em><?php echo $league['league']; ?> (<?php echo $total_teams; ?>)</em>
</div>
<div class="panel-body">
    <div class="table-responsive">
       <table class="table table-hover">
        <thead>
            <tr>
              <th>Team</th>
              <th></th>
            </tr>
        </thead>
        <tbody>
         <?php foreach($teams as $team) { ?>
            <tr>
             <td><?php echo $team['guild']; ?></td>
             <td>
                <a href="teams_view.php?id=<?php echo $team['id']; ?>" class="btn btn-info btn-xs"><i class="fa fa-search"></i> View Team</a>
             </td>
            </tr>
         <?php } ?>
        </tbody>
       </table>
    </div>
</div>
</div>