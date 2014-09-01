(function( $ ){

	var EZL = {

		/**
		 * Initialize basic theme JavaScript
		 */
		init: function() {

			this.cacheElements();
			this.userLogin();
			this.userRegister();

		},

		/**
		 * Cache elements to object-level variables
		 */
		cacheElements: function() {
			
			this.login_form = $('#ezLeagueLogin');
			this.register_form = $('#ezLeagueRegister');
			this.create_team_form = $('#createTeam');

		},

		/**
		* User login
		*/
		userLogin: function() {

			this.login_form.submit(function(e) {
				
				var username	= $("#login-username").val();
					password    = $("#login-password").val();
				 e.preventDefault();
			 $.ajax({
			     type: "POST",
			     url: "submit.php",
			     data: { form: 'login', username: '' + username + '', password: '' + password + ''}
			   }).success(function( msg ) {
				   		$(".login_success").css("display", "");
				   		$(".login_success").fadeIn(1000, "linear");
				   		$(".login_success_text").fadeIn("slow");
				   		$(".login_success").html(msg);
				      setTimeout(function(){location.reload()},3000);
			  });
			});
			
		},
		
		/**
		 * User register
		 */
		userRegister: function() {
			
			this.register_form.submit(function(e) {

				var username    = $("#register-username").val();
					email	    = $("#register-email").val();
					password    = $("#register-password").val();
					confirm     = $("#register-confirm").val();

				 e.preventDefault();

				if(password == confirm && password != '' && password.length >= 6) {
				 $.ajax({
				     type: "POST",
				     url: "submit.php",
				     data: { form: 'register', username: '' + username + '', email: '' + email + '', password: '' + password + '', confirm: '' + confirm + '' }
				   }).success(function( msg ) {
					   		$(".register_success").css("display", "");
					   		$(".register_success").fadeIn(1000, "linear");
					   		$(".register_success_text").fadeIn("slow");
					   		$(".register_success_text").html(msg);
				 	   if(msg == "<strong>Success!</strong> Account has been created. You may now login.") {
				 		  setTimeout(function(){location.reload()},3000);
				 	   }
				  });
				} else {
						this.register_success.css("display", "");
						this.register_success.fadeIn(1000, "linear");
				        this.register_text.fadeIn("slow");
				        this.register_text.html('<strong>Error</strong> Passwords do not match, or is less than 6 characters');
				}
				});
			
		}
		
	};

	/**
	 * Wait until the document is ready before initializing the js
	 */
	$(document).ready(function(){

		EZL.init();

	});

}( jQuery ) );