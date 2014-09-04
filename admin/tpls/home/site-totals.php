<div class="panel panel-default">
<div class="panel-heading">
    <i class="fa fa-bar-chart-o fa-fw"></i> Site Totals
</div>
<div class="panel-body">
    <div class="list-group">
        <a href="#" class="list-group-item">
            <i class="fa fa-user fa-fw"></i> Users
            <span class="pull-right text-muted small"><em><?php echo $ez_frontend->get_total( 'users' ); ?></em>
            </span>
        </a>
        <a href="#" class="list-group-item">
            <i class="fa fa-group fa-fw"></i> Teams
            <span class="pull-right text-muted small"><em><?php echo $ez_frontend->get_total( 'teams' ); ?></em>
            </span>
        </a>
        <a href="#" class="list-group-item">
            <i class="fa fa-sitemap fa-fw"></i> Matches
            <span class="pull-right text-muted small"><em><?php echo $ez_frontend->get_total( 'matches' ); ?></em>
            </span>
        </a>
        <a href="#" class="list-group-item">
            <i class="fa fa-trophy fa-fw"></i> Leagues
            <span class="pull-right text-muted small"><em><?php echo $ez_frontend->get_total( 'leagues' ); ?></em>
            </span>
        </a>
        <a href="#" class="list-group-item">
            <i class="fa fa-gamepad fa-fw"></i> Games
            <span class="pull-right text-muted small"><em><?php echo $ez_frontend->get_total( 'games' ); ?></em>
            </span>
        </a>
    </div>
</div>
</div>