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