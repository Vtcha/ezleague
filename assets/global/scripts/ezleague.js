(function( $ ){

	var EZL = {

		/**
		 * Initialize basic theme JavaScript
		 */
		init: function() {

			this.cacheElements();
			this.userLogin();
			this.userRegister();
			this.sendMessage();

		},

		/**
		 * Cache elements to object-level variables
		 */
		cacheElements: function() {
			
			this.login_form = $('#ezLeagueLogin');
			this.register_form = $('#ezLeagueRegister');
			this.create_team_form = $('#createTeam');
			this.send_message_form = $('#sendMessage');

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
				 		  setTimeout(function(){location.reload()},3000);
				  });
				} else {
						$(".register_success").css("display", "");
				   		$(".register_success").fadeIn(1000, "linear");
				   		$(".register_success_text").fadeIn("slow");
				   		$(".register_success_text").html('<strong>Error</strong> Passwords do not match, or is less than 6 characters');
				}
				});
			
		},

		sendMessage: function() {
			
			this.send_message_form.submit(function(e) {

				var to 		    = $("#to").val();
					from	    = $("#from").val();
					name 		= $("#name").val();
					subject     = $("#subject").val();
					message     = $("textarea#message").val();
					captcha     = $("#captcha").val();
					captchaa    = $("#captcha-answer").val();

				 e.preventDefault();

				if(captcha == captchaa) {
				 $.ajax({
				     type: "POST",
				     url: "submit.php",
				     data: { form: 'send-message', to: '' + to + '', from: '' + from + '', name: '' + name + '', subject: '' + subject + '', message: '' + message + '' }
				   }).success(function( msg ) {
					   		$(".success").css("display", "");
					   		$(".success").fadeIn(1000, "linear");
					   		$(".success_text").fadeIn("slow");
					   		$(".success_text").html(msg);
				 		  	setTimeout(function(){location.reload()},3000);
				  });
				} else {
						$(".success").css("display", "");
				   		$(".success").fadeIn(1000, "linear");
				   		$(".success_text").fadeIn("slow");
				   		$(".success_text").html('<strong>Error</strong> CAPTCHA was incorrect');
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