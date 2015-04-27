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

/**
 * Create new user
 */
$('#createUser').submit(function(e) {

	var username		= $("#create-username").val();
		first_name 		= $("#create-first-name").val();
		last_name 		= $("#create-last-name").val();
		email	  		= $("#create-email").val();
		role			= $("#create-role").val();
		team 			= $("#create-team-id").val();
		notification 	= $('#create-details').prop('checked');
		send_email 		= '';
		if( notification == true ) {
			send_email = 'yes';
		} else {
			send_email = 'no';
		}

	 e.preventDefault();

 $.ajax({
     type: "POST",
     url: "lib/submit/submit-user.php",
     async:true,
     crossbrowser:true,
     data: { form: 'create-user', username: '' + username + '', email: '' + email + '', role: '' + role + '', team: '' + team + '', first_name: '' + first_name + '', last_name: '' + last_name + '', notification: '' + send_email + '' }
   }).success(function( msg ) {
	   		$('.success').css("display", "");
	   		$(".success").fadeIn(1000, "linear");
	   		$('.success_text').fadeIn("slow");
	   		$('.success_text').html(msg);
	   		setTimeout(function(){location.reload()},3000);
  });
});