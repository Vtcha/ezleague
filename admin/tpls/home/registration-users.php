<div class="panel panel-default">
<div class="panel-heading">
    <i class="fa fa-user fa-fw"></i> Recent User Registrations
     <a href="user_all.php" class="btn btn-success btn-xs pull-right">View All Users</a>
</div>
<div class="panel-body">
    <div class="row">
        <div class="col-lg-12">
            <div class="table-responsive">
                <table class="table table-bordered table-hover table-striped recent_users">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Username</th>
                            <th>E-Mail</th>
                            <th>Registered</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
        <?php $recent_users = $ez_frontend->get_recent_users(5); ?>
        <?php foreach( $recent_users as $user ) { ?>
                        <tr>
                            <td>#<?php echo $user['id']; ?></td>
                            <td><?php echo $user['username']; ?></td>
                            <td><?php echo $user['email']; ?></td>
                            <td><small><?php echo date('M d h:ia', strtotime($user['created'])); ?></small></td>
                        	<td><a href="users_view.php?id=<?php echo $user['id']; ?>" class="btn btn-info btn-xs">View</a></td>
                        </tr>
        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</div>