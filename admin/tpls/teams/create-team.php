<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Create New Team</h1>
    </div>
</div>
<div class="row">
    <div class="col-lg-4">
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-file-o"></i> Create Team
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
                     <form method="POST" id="createTeam">
                        <div class="form-group">
                            <label>Team Name</label>
                            <input class="form-control" id="create-team" placeholder="Username" />
                        </div>
                        <div class="form-group">
                            <label>Abbreviation <small>(5 char max)</small></label>
                            <input class="form-control" id="create-abbreviation" placeholder="Abbreviation" />
                        </div>
                        <div class="form-group">
                            <label>Team Admin <small>(<a href="users.php?page=create">create new user</a>)</small></label>
                            <select class="form-control" id="create-admin">
                                <option value="">- Set Later -</option>
                        <?php $users = $ez_user->get_all_users(); ?>
                        <?php foreach( $users as $user ) { ?>
                                <option value="<?php echo $user['username']; ?>"><?php echo $user['username']; ?></option>
                        <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-success" type="submit">Create Team</button>
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
    </div>