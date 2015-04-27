/**
 * Get team details for modal
 * @param team_id
 */
function getTeam(team_id) {
	
	$.ajax({
	     type: "POST",
	     async: false,
	     url: "get_team.php",
	     data: { id: '' + team_id + '' }
	   }).success(function( msg ) {
		   $('#editTeamModal').html(msg);
	  });
	
}

/**
 * Set team leader
 * @param team_id
 * @param username
 */
function setTeamLeader(team_id, username) {

	$.ajax({
	     type: "POST",
	     url: "lib/submit/submit-team.php",
	     async:true,
	     crossbrowser:true,
	     data: { form: 'set-team-leader', team_id: '' + team_id + '', username: '' + username + '' }
	   }).success(function( msg ) {
		   		$('.success').css("display", "");
		   		$(".success").fadeIn(1000, "linear");
		   		$('.success_text').fadeIn("slow");
		   		$('.success_text').html(msg);
		   		setTimeout(function(){location.reload()},3000);
	  });
	
}

/**
 * Set team co-leader
 * @param team_id
 * @param username
 */
function setTeamCoLeader(team_id, username) {

	$.ajax({
	     type: "POST",
	     url: "lib/submit/submit-team.php",
	     async:true,
	     crossbrowser:true,
	     data: { form: 'set-team-coleader', team_id: '' + team_id + '', username: '' + username + '' }
	   }).success(function( msg ) {
		   		$('.success').css("display", "");
		   		$(".success").fadeIn(1000, "linear");
		   		$('.success_text').fadeIn("slow");
		   		$('.success_text').html(msg);
		   		setTimeout(function(){location.reload()},3000);
	  });
	
}

/**
 * Set team admin
 * @param team_id
 * @param username
 */
function setTeamAdmin(team_id, username) {

	$.ajax({
	     type: "POST",
	     url: "lib/submit/submit-team.php",
	     async:true,
	     crossbrowser:true,
	     data: { form: 'set-team-admin', team_id: '' + team_id + '', username: '' + username + '' }
	   }).success(function( msg ) {
		   		$('.success').css("display", "");
		   		$(".success").fadeIn(1000, "linear");
		   		$('.success_text').fadeIn("slow");
		   		$('.success_text').html(msg);
		   		setTimeout(function(){location.reload()},3000);
	  });
	
}

/**
 * Change a team name
 */
$('#changeTeamName').submit(function(e) {
	var team_id			= $("#team-id").val();
		team_name  		= $("#team-name").val();

	e.preventDefault();

	$.ajax({
		 type: "POST",
		 url: "lib/submit/submit-team.php",
		 async:true,
		 crossbrowser:true,
		 data: { form: 'change-team-name', team_id: '' + team_id + '', team_name: '' + team_name + '' }
	}).success(function( msg ) {
		$('.success').css("display", "");
		$(".success").fadeIn(1000, "linear");
		$('.success_text').fadeIn("slow");
		$('.success_text').html(msg);
		setTimeout(function(){location.reload()},3000);
	});
});