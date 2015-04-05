<div class="col-md-9 col-sm-8 article-block">
	<h1>Request Password Reset</h1>
	<div class="row">
		<div class="col-md-5">
		<p>Enter either your username or email address, and reset password instructions will be emailed to you.</p>
			<form role="form" name="ezLeagueForgotPassword" id="ezLeagueForgotPassword" method="POST">
				<input type="hidden" name="captcha_answer" id="captcha-answer" value="<?php echo $captcha; ?>" />
	            <div class="form-group">
					<div class="input-icon">
						<i class="fa fa-user"></i>
						<input type="text" id="account-username" class="form-control" placeholder="Your Username">
					</div>
				</div>
				<div class="form-group">
					<h3 style="text-align:center;">OR</h3>
				</div>
				<div class="form-group">
					<div class="input-icon">
						<i class="fa fa-envelope"></i>
						<input type="text" id="account-email" class="form-control" placeholder="Your Email">
					</div>
				</div>
				<div class="form-group">
					<label>What is <?php echo $num1 . ' + ' . $num2; ?>?</label>
					<div class="input-icon">
						<i class="fa fa-lock"></i>
						<input type="text" id="account-captcha" class="form-control" placeholder="CAPTCHA">
					</div>
				</div>
				<div class="success" style="margin-bottom:12px;">
					<span class="success_text"></span>
				</div>
				<div class="form-group">
					<button type="submit" class="btn green">Request Reset Code</button>
				</div>
	     	</form>
	     </div>
	</div>
</div>