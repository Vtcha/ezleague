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
	<?php if( isset( $profile ) ) { ?>
			<li>
				<a data-toggle="modal" href="#send-message">
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
	<?php if( $user_profile['guild_id'] == '' && isset( $profile['team_admin'] ) ) { ?>
			<li>
				<a onclick="sendTeamInvite('<?php echo $profile['guild_id']; ?>', '<?php echo $user_profile['id']; ?>')">
				Send Team Invite </a>
			</li>
	<?php } ?>
		</ul>
	</div>
	<div class="col-md-9">
		<div class="row">
			<div class="col-md-8 profile-info">
				<h1><?php echo $user_profile['username']; ?></h1>
				<h2><?php echo $user_profile['first'] . ' ' . $user_profile['last']; ?></h2>
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
								<p class="profile-info">
								DATE JOINED<br/>
								<span class="profile-num">
								<?php echo date( 'F d, Y', strtotime( $user_profile['created'] ) ); ?></span> </p>
							</li>
							<li>
								<p class="profile-info">
								FORUM POSTS<br/>
								<span class="profile-num">
								<?php echo $user_profile['post_count']; ?></span> </p>
							</li>
							<li>
								<p class="profile-info">
								TEAM<br/>
								<span class="profile-num">
								<?php echo $ez_users->get_user_team( $user_profile['guild_id'] ); ?></span> </p>
							</li>
						</ul>
					</div>
				</div>
			</div>
			<!--end col-md-4-->
		</div>
		<!--end row-->
</div>
<div class="modal fade" id="send-message" tabindex="-1" role="basic" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h4 class="modal-title">Send User Message</h4>
			</div>
			<div class="modal-body">
				 <form role="form" id="sendMessage" method="POST">
		           <input type="hidden" id="from" value="<?php echo $profile['username']; ?>" />
		           <input type="hidden" id="to" value="<?php echo $user_profile['username']; ?>" />
		            <div class="form-group">
		              <h5>Recipient</h5>
		              <input disabled type="text" class="form-control text placeholder" value="<?php echo $user_profile['username']; ?>" />
		            </div>
		            <div class="form-group">
		              <h5>Subject</h5>
		              <input id="subject" class="form-control text placeholder" placeholder="Subject" type="text">
		            </div>
		            <div class="form-group">
		              <h5>Message</h5>
		              <textarea id="inbox_message" class="form-control email placeholder" placeholder="Message"></textarea>
		            </div>
		            <div class="success">
					 <span class="success_text"></span>
					</div>
		         </div>
		      <div class="modal-footer">
		        <button type="submit" class="btn btn-primary">Send Message</button>
		        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		      </div>
		     </form>
		</div>
	</div>
</div>