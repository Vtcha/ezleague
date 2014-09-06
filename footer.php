<!-- BEGIN FOOTER -->
<div class="page-footer">
	<div class="page-footer-inner">
		 2013-2014 &copy; <a href="http://www.mdloring.com/ezleague-free-php-online-gaming-league-script/" target="_blank"><em>ezLeague</em></a> is Developed &amp; Maintained by <a href="http://www.mdloring.com" target="_blank">Michael Loring</a>. 
		 Logo Design by <a href="http://www.arma3.ru">Alexey</a>.
		 Currently running <em>ezLeague v<?php echo EZL_VERSION; ?></em>
	</div>
	<div class="page-footer-tools">
		<span class="go-top">
		<i class="fa fa-angle-up"></i>
		</span>
	</div>
</div>
<!-- END FOOTER -->

<!-- LOGIN MODAL -->
<div class="modal fade" id="login" tabindex="-1" role="basic" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h4 class="modal-title">Account Login</h4>
			</div>
			<div class="modal-body">
				 <form role="form" name="ezLeagueLogin" id="ezLeagueLogin" method="POST">
		            <div class="form-group">
		              <h5>Username</h5>
		              <input id="login-username" class="form-control text placeholder" placeholder="Username" name="username" type="text" autofocus>
		            </div>
		            <div class="form-group">
		              <h5>Password</h5>
		              <input id="login-password" class="form-control password placeholder" placeholder="Password" name="password" autocomplete="off" type="password">
		              <small><a href="http://mdloring.com/ezleague/forget.php">Forgot Password?</a></small>
		            </div>
		         	<div class="login_success">
					 <span class="login_success_text"></span>
					</div>
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-primary">Login</button>
		        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		    </div> 
		     	</form>
		</div>
	</div>
</div>
<!-- ./LOGIN MODAL -->

<!-- REGISTER MODAL -->
<div class="modal fade" id="register" tabindex="-1" role="basic" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h4 class="modal-title">Account Registration</h4>
			</div>
			<div class="modal-body">
				 <form role="form" name="ezLeagueRegister" id="ezLeagueRegister" method="POST">
		           <input type="hidden" name="register-answer" id="register-answer" value="7" />
		            <div class="form-group">
		              <h5>Username</h5>
		              <input id="register-username" class="form-control text placeholder" placeholder="Username" name="username" type="text">
		            </div>
		            <div class="form-group">
		              <h5>Email</h5>
		              <input id="register-email" class="form-control email placeholder" placeholder="Email" name="email" type="email">
		            </div>
		            <div class="form-group">
		              <h5>Password</h5>
		              <input id="register-password" class="form-control password placeholder" placeholder="Password" name="password" autocomplete="off" type="password">
		              <small>must be at least 6 characters</small>
		            </div>
		            <div class="form-group">
		              <h5>Confirm</h5>
		              <input id="register-confirm" class="form-control password placeholder" placeholder="Password" name="confirm" autocomplete="off" type="password">
		            </div>
		            <div class="register_success">
					 <span class="register_success_text"></span>
					</div>
		         </div>
		      <div class="modal-footer">
		        <button type="submit" class="btn btn-primary">Register</button>
		        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		      </div>
		     </form>
		</div>
	</div>
</div>
<!-- ./REGISTER MODAL -->
<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<!--[if lt IE 9]>
<script src="assets/global/plugins/respond.min.js"></script>
<script src="assets/global/plugins/excanvas.min.js"></script> 
<![endif]-->
<script src="assets/global/plugins/jquery-1.11.0.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/jquery-migrate-1.2.1.min.js" type="text/javascript"></script>
<!-- IMPORTANT! Load jquery-ui-1.10.3.custom.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.0/jquery-ui.min.js"></script>
<script src="assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/jquery.cokie.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<script src="assets/global/scripts/metronic.js" type="text/javascript"></script>
<script src="assets/global/scripts/ezleague.js" type="text/javascript"></script>
<script src="assets/admin/layout/scripts/layout.js" type="text/javascript"></script>
<script src="assets/admin/layout/scripts/quick-sidebar.js" type="text/javascript"></script>
<script>
jQuery(document).ready(function() {    
	Metronic.init(); // init metronic core components
	Layout.init(); // init current layout
	QuickSidebar.init() // init quick sidebar
});
</script>
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>