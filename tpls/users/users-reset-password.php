<?php 
	$reset = trim( $_GET['reset'] ); 
	$user = $ez_users->get_user_by_reset_code( $reset );
	$user_id 	= $user['user_id'];
	$username 	= $user['username'];
?>
<div class="col-md-9 col-sm-8 article-block">
	<h1>Reset Account Password</h1>
	<div class="row">
		<div class="col-md-5">
		<?php if( ! empty( $user_id ) ) { ?>
			<p>Reset the password for the account listed below.</p>
				<form role="form" name="userPassword" id="userPassword" method="POST">
					<input type="hidden" name="captcha_answer" id="captcha-answer" value="<?php echo $captcha; ?>" />
					<input type="hidden" name="user-id" id="user-id" value="<?php echo $user_id; ?>" />
		            <div class="form-group">
						<div class="input-icon">
							<i class="fa fa-user"></i>
							<input disabled type="text" id="account-username" class="form-control" placeholder="Your Username" value="<?php echo $username; ?>">
						</div>
					</div>
					<div class="form-group">
						Enter your new password twice
					</div>
					<div class="form-group">
						<div class="input-icon">
							<i class="fa fa-lock"></i>
							<input type="password" id="user-password" class="form-control" placeholder="New Password">
						</div>
					</div>
					<div class="form-group">
						<div class="input-icon">
							<i class="fa fa-lock"></i>
							<input type="password" id="user-confirm" class="form-control" placeholder="Confirm New Password">
						</div>
					</div>
					<div class="success" style="margin-bottom:12px;">
						<span class="success_text"></span>
					</div>
					<div class="form-group">
						<button type="submit" class="btn green">Reset Password</button>
					</div>
		     	</form>
		<?php } else { ?>
			<h3><strong>ERROR</strong> Invalid reset code</h3>
		<?php } ?>
	     </div>
	</div>
</div>