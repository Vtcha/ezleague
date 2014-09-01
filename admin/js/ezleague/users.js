/**
 * Get user details for the modal
 * @param user_id
 */
function getUser(user_id) {
	
	$.ajax({
	     type: "POST",
	     async: false,
	     url: "get_user.php",
	     data: { id: '' + user_id + '' }
	   }).success(function( msg ) {
		   $('#editUserModal').html(msg);
	  });
	
}

/**
 * Suspend a user account
 * @param id
 * @param status
 */
function toggleSuspendUser(id, status) {
	$.ajax({
	     type: "POST",
	     async: false,
	     url: "lib/submit/submit-user.php",
	     data: { form: 'suspend-user', id: '' + id + '', status: '' + status + '' }
	   }).success(function( msg ) {
		      $('.success').css("display", "");
		      $(".success").fadeIn(1000, "linear");
		      $('.success_text').fadeIn("slow");
		      $('.success_text').html(msg);
		      setTimeout(function(){window.location='users.php?page=all'},3000);
	  });
}

/**
 * Toggle a user role between admin and user
 * @param id
 * @param role
 */
function toggleRoleUser(id, role) {
	$.ajax({
	     type: "POST",
	     async: false,
	     url: "lib/submit/submit-user.php",
	     data: { form: 'toggle-role-user', id: '' + id + '', role: '' + role + '' }
	   }).success(function( msg ) {
		      $('.success').css("display", "");
		      $(".success").fadeIn(1000, "linear");
		      $('.success_text').fadeIn("slow");
		      $('.success_text').html(msg);
		      setTimeout(function(){window.location='users.php?page=all'},3000);
	  });
}

/**
 * Permanently delete a users' account
 * @param id
 */	
function deleteAccount(id) {
	$.ajax({
	     type: "POST",
	     async: false,
	     url: "lib/submit/submit-user.php",
	     data: { form: 'delete-user', id: '' + id + '' }
	   }).success(function( msg ) {
		      $('.success').css("display", "");
		      $(".success").fadeIn(1000, "linear");
		      $('.success_text').fadeIn("slow");
		      $('.success_text').html(msg);
		      setTimeout(function(){window.location='users.php?page=all'},3000);
	  });
}