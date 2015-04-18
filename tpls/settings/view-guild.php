<div class="tab-pane" id="tab_1_3">
	<div class="row profile-account">
	<?php if( isset( $_SESSION['ez_username'] ) ) { ?>
		<div class="col-md-3">
			<ul class="ver-inline-menu tabbable margin-bottom-10">
			<?php if( $team_settings['admin'] == $profile['username'] ) { ?>
				<li>
					<a data-toggle="tab" href="#team-settings">
					<i class="fa fa-cog"></i> Settings </a>
					<span class="after">
					</span>
				</li>
				<li>
					<a data-toggle="tab" href="#team-password">
					<i class="fa fa-lock"></i> Password </a>
				</li>
				<li>
					<a data-toggle="tab" href="#team-logo">
					<i class="fa fa-file-image-o"></i> Logo </a>
				</li>
			<?php } ?>
				<li>
					<a data-toggle="tab" href="#team-leagues">
					<i class="fa fa-trophy"></i> Leagues </a>
				</li>
				<li>
					<a data-toggle="tab" href="#team-tournaments">
					<i class="fa fa-trophy"></i> Tournaments </a>
				</li>
				<li class="active">
					<a data-toggle="tab" href="#team-members">
					<i class="fa fa-users"></i> Members </a>
				</li>
			</ul>
		</div>
		<div class="col-md-9">
			<div class="tab-content">
			<?php if( $team_settings['admin'] == $profile['username'] ) { ?>
				<div id="team-settings" class="tab-pane">
					<?php include('tpls/settings/guild/guild-settings.php'); ?>
				</div>
				<div id="team-password" class="tab-pane">
					<?php include('tpls/settings/guild/guild-password.php'); ?>
				</div>
				<div id="team-logo" class="tab-pane">
					<?php include('tpls/settings/guild/guild-logo.php'); ?>
				</div>
			<?php } ?>
				<div id="team-leagues" class="tab-pane">
					<?php include('tpls/settings/guild/guild-leagues.php'); ?>
				</div>
				<div id="team-tournaments" class="tab-pane">
					<?php include('tpls/settings/guild/guild-tournaments.php'); ?>
				</div>
				<div id="team-members" class="tab-pane active">
					<?php include('tpls/settings/guild/guild-members.php'); ?>
				</div>
			</div>
		</div>
		<!--end col-md-9-->
	<?php } else { ?>
	<h3>You are not logged in.</h3>
	<?php } ?>
	</div>
</div>