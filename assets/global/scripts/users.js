(function( $ ){

	var EZL_Users = {

		/**
		 * Initialize basic theme JavaScript
		 */
		init: function() {

			this.cacheElements();
			this.updateProfile();
			this.updatePassword();
			this.forgotPassword();

		},

		/**
		 * Cache elements to object-level variables
		 */
		cacheElements: function() {

			this.update_user_form = $('#userProfile');
			this.update_password_form = $('#userPassword');
			this.forgot_password_form = $('#ezLeagueForgotPassword');

		},
		
		/**
		 * Update user profile
		 */
		updateProfile: function() {

			this.update_user_form.submit(function(e) {
				
				var first		= $("#user-first-name").val();
					last	    = $("#user-last-name").val();
					email	    = $("#user-email").val();
					website		= $("#user-website").val();
					bio			= $("textarea#user-bio").val();
					hobbies	    = $("#user-hobbies").val();
					from		= $("#user-from").val();
					occupation	= $("#user-occupation").val();
					signature	= $("textarea#user-signature").val();
					id			= $("#user-id").val();
				 e.preventDefault();
				 
			 $.ajax({
			     type: "POST",
			     url: "lib/submit/submit-user.php",
			     data: { form: 'update-profile', id: '' + id + '', first: '' + first + '', last: '' + last + '', email: '' + email + '', bio: '' + bio + '', hobbies: '' + hobbies + '', from: '' + from + '', occupation: '' + occupation + '', website: '' + website + '', signature: '' + signature + ''}
			   }).success(function( msg ) {
						    $(".success").css("display", "");
					   		$(".success").fadeIn(1000, "linear");
					   		$(".success_text").fadeIn("slow");
					   		$(".success").html(msg);
					   		setTimeout(function(){location.reload()},3000);
			  });
			});
			
		},
		
		/**
		 * Update user password
		 */
		updatePassword: function() {

			this.update_password_form.submit(function(e) {
				
				var password	= $("#user-password").val();
					confirm	    = $("#user-confirm").val();
					id			= $("#user-id").val();
					errors		= 0;
				 e.preventDefault();
				 
				 if( password.length < 6  || confirm.length < 6) {
					$(".succes").css("display", "");
			   		$(".succes").fadeIn(1000, "linear");
			   		$(".success_text").fadeIn("slow");
					$(".success").html('<strong>Error</strong> must be at least 6 characters ');
					errors++;
				} else {
					$(".success").css("display", "");
				}
				
				if( password != confirm ) {
					$(".succes").css("display", "");
			   		$(".succes").fadeIn(1000, "linear");
			   		$(".success_text").fadeIn("slow");
					$(".success").html('<strong>Error</strong> Passwords do not match ');
					errors++;
				} else {
					$(".success").css("display", "");
				}

				if(errors == 0) {
				 
					 $.ajax({
					     type: "POST",
					     url: "lib/submit/submit-user.php",
					     data: { form: 'update-password', id: '' + id + '', password: '' + password + ''}
					   }).success(function( msg ) {
								    $(".success").css("display", "");
							   		$(".success").fadeIn(1000, "linear");
							   		$(".success_text").fadeIn("slow");
							   		$(".success").html(msg);
							   		setTimeout(function(){window.location='index.php'},3000);
					  });
					 
				}
				
			});
			
		},

		/**
		 * Reset forgotten password
		 */
		forgotPassword: function() {

			this.forgot_password_form.submit(function(e) {
				
				var username		= $("#account-username").val();
					email	    	= $("#account-email").val();
					captcha			= $("#account-captcha").val();
					captcha_answer	= $("#captcha-answer").val();
				 e.preventDefault();

				 if( captcha == captcha_answer ) {
					 if( username.length >= 1 && email.length >= 1 ) {
					 	$(".success").css("display", "");
				   		$(".success").fadeIn(1000, "linear");
				   		$(".success_text").fadeIn("slow");
				   		$(".success").html('<strong>Error</strong> Only enter either the username or email');
					 } else if( username.length < 1 && email.length < 1 ) {
					 	$(".success").css("display", "");
				   		$(".success").fadeIn(1000, "linear");
				   		$(".success_text").fadeIn("slow");
				   		$(".success").html('<strong>Error</strong> Either the username or email must be entered');
				   	} else {
					 
						 $.ajax({
						     type: "POST",
						     url: "lib/submit/submit-user.php",
						     data: { form: 'forgot-password', username: '' + username + '', email: '' + email + ''}
						   }).success(function( msg ) {
									    $(".success").css("display", "");
								   		$(".success").fadeIn(1000, "linear");
								   		$(".success_text").fadeIn("slow");
								   		$(".success").html(msg);
								   		setTimeout(function(){location.reload()},3000);
						  });
					}
				} else {
					$(".success").css("display", "");
			   		$(".success").fadeIn(1000, "linear");
			   		$(".success_text").fadeIn("slow");
			   		$(".success").html('<strong>Error</strong> Incorrect CAPTCHA answer');	
				}
			});
			
		},

	};

	/**
	 * Wait until the document is ready before initializing the js
	 */
	$(document).ready(function(){
		
		EZL_Users.init();

	});

}( jQuery ) );