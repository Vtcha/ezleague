<?php $user_id = trim( $_GET['id'] ); ?>
<?php $user_profile = $ez_users->get_user_profile( $user_id ); ?>
	<div class="col-md-3">
		<ul class="list-unstyled profile-nav profile-actions">
			<li>
			<?php if( $user_profile['avatar'] ) { ?>
				<img src="avatars/<?php echo $user_profile['avatar']; ?>" class="img-responsive" alt="">
			<?php } else { ?>
				<img src="avatars/unknown.png" class="img-responsive" alt="">
			<?php } ?>
			</li>
	<?php if( $profile ) { ?>
			<li>
				<a href="#">
				Send Message </a>
			</li>
			<li>
		<?php $check_friend = $ez_users->check_friend( $user_profile['id'], $profile['id'] ); ?>
		<?php if( $check_friend ) { ?>
				<a onclick="removeFriend('<?php echo $user_profile['id']; ?>', '<?php echo $profile['id']; ?>')">
				Remove Friend </a>
		<?php } else { ?>
				<a onclick="addFriend('<?php echo $user_profile['id']; ?>', '<?php echo $profile['id']; ?>')">
				Add as Friend </a>
			</li>
		<?php } ?>
	<?php } ?>
	<?php if( $user_profile['guild_id'] == '' && $profile['team_admin'] ) { ?>
			<li>
				<a onclick="sendTeamInvite('<?php echo $profile['guild_id']; ?>', '<?php echo $user_profile['id']; ?>')">
				Send Guild Invite </a>
			</li>
	<?php } ?>
		</ul>
	</div>
	<div class="col-md-9">
		<div class="row">
			<div class="col-md-8 profile-info">
				<h1><?php echo $user_profile['username']; ?></h1>
				<p>
					 <?php echo $user_profile['bio']; ?>
				</p>
				<p>
					<a href="<?php echo $user_profile['website']; ?>">
					<?php echo $user_profile['website']; ?> </a>
				</p>
				<ul class="list-inline">
					<li>
						<i class="fa fa-map-marker"></i> <?php echo $user_profile['location']; ?>
					</li>
					<li>
						<i class="fa fa-briefcase"></i> <?php echo $user_profile['occupation']; ?>
					</li>
					<li>
						<i class="fa fa-heart"></i> <?php echo $user_profile['hobbies']; ?>
					</li>
					<div class="success"><span class="success_text"></span></div>
				</ul>
			</div>
			<!--end col-md-3-->
			<div class="col-md-4">
				<div class="portlet profile-summary">
					<div class="portlet-title">
						<div class="caption">
							 Profile Summary
						</div>
					</div>
					<div class="portlet-body">
						<ul class="list-unstyled">
							<li>
								<span class="profile-info">
								DATE JOINED <i class="fa fa-img-up"></i>
								</span><br/>
								<span class="profile-num">
								<?php echo date( 'F d, Y', strtotime( $user_profile['created'] ) ); ?> </span>
							</li>
							<li>
								<span class="profile-info">
								FORUM POSTS <i class="fa fa-img-down"></i>
								</span><br/>
								<span class="profile-num">
								<?php echo $user_profile['post_count']; ?> </span>
							</li>
							<li>
								<span class="profile-info">
								TEAM </span><br/>
								<span class="profile-num">
								<?php echo $ez_users->get_user_team( $user_profile['guild_id'] ); ?> </span>
							</li>
						</ul>
					</div>
				</div>
			</div>
			<!--end col-md-4-->
		</div>
		<!--end row-->
</div>