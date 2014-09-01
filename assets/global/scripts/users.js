(function( $ ){

	var EZL_Users = {

		/**
		 * Initialize basic theme JavaScript
		 */
		init: function() {

			this.cacheElements();
			this.updateProfile();
			this.updatePassword();

		},

		/**
		 * Cache elements to object-level variables
		 */
		cacheElements: function() {

			this.update_user_form = $('#userProfile');
			this.update_password_form = $('#userPassword');

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
					$(".password").css("display", "");
			   		$(".password").fadeIn(1000, "linear");
			   		$(".password").fadeIn("slow");
					$(".password").html('<strong>Error</strong> must be at least 6 characters ');
					errors++;
				} else {
					$(".password").css("display", "");
				}
				
				if( password != confirm ) {
					$(".confirm").css("display", "");
			   		$(".confirm").fadeIn(1000, "linear");
			   		$(".confirm").fadeIn("slow");
					$(".confirm").html('<strong>Error</strong> Passwords do not match ');
					errors++;
				} else {
					$(".confirm").css("display", "");
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
							   		setTimeout(function(){location.reload()},3000);
					  });
					 
				}
				
			});
			
		}

	};

	/**
	 * Wait until the document is ready before initializing the js
	 */
	$(document).ready(function(){
		
		EZL_Users.init();

	});

}( jQuery ) );