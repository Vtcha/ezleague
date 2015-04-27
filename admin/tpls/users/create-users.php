<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Create New Account</h1>
    </div>
</div>
<div class="row">
    <div class="col-lg-4">
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-file-o"></i> Create User
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
                     <form method="POST" id="createUser">
                        <small>* a randomly generated password will be set for the account</small>
                        <div class="form-group">
                            <label>Username</label>
                            <input class="form-control" id="create-username" placeholder="Username" />
                        </div>
                        <div class="form-group">
                            <label>First Name</label>
                            <input class="form-control" id="create-first-name" placeholder="First Name" />
                        </div>
                        <div class="form-group">
                            <label>Last Name</label>
                            <input class="form-control" id="create-last-name" placeholder="Last Name" />
                        </div>
                        <div class="form-group">
                            <label>E-Mail</label>
                            <input class="form-control" id="create-email" placeholder="E-Mail" />
                        </div>
                        <div class="checkbox">
                            <label>
                              <input type="checkbox" id="create-details"> E-Mail Account Details
                            </label>
                        </div>
                        <div class="form-group">
                            <label>Site Role</label>
                            <select class="form-control" id="create-role">
                                <option value="user">User</option>
                                <option value="admin">Site Admin</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Team <small>(<a href="teams.php?page=create">create new team</a>)</small></label>
                            <select class="form-control" id="create-team-id">
                                <option value="">- No Team -</option>
                        <?php $teams = $ez_team->get_all_teams(); ?>
                        <?php 
                            foreach( $teams as $team ) {
                                $team_id = $team['id'];
                                if( strlen( $team_id ) == 1 ) {
                                    $team_id = '0' . $team['id'];
                                }
                            ?>
                                <option value="<?php echo $team['id']; ?>">#<?php echo $team_id . ' - ' . $team['team'] . ' (' . $team['abbr'] . ')'; ?></option>
                            }
                        <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-success" type="submit">Create User</button>
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