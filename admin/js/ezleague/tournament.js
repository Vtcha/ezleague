/**
 * Create tournament date pickers
 */
$(function() {
	$( "#start" ).datepicker( "option", "dateFormat", "yy-mm-dd" );	
	$( "#start" ).datepicker();
});

$(function() {
	$( "#end" ).datepicker( "option", "dateFormat", "yy-mm-dd" );
	$( "#end" ).datepicker();
});

$(function() {
	$( "#registration" ).datepicker( "option", "dateFormat", "yy-mm-dd" );
	$( "#registration" ).datepicker();
});

/**
 * Create tournament
 */
$('#createTournament').submit(function(e) {
	var game			= $("#game").val();
		max_teams  		= $("#max-teams").val();
		tournament		= $("#tournament").val();
		start_date 		= $("#start").val();
		registration 	= $("#registration").val();
		format 			= $("#format").val();
		pub 			= $("#public").val();
		
	 e.preventDefault();

 $.ajax({
     type: "POST",
     url: "lib/submit/submit-tournament.php",
     async:true,
     crossbrowser:true,
     data: { form: 'create-tournament', start: '' + start_date + '', registration: '' + registration + '', max_teams: '' + max_teams + '', tournament: '' + tournament + '', game: '' + game + '', format: '' + format + '', pub: '' + pub + '' }
   }).success(function( msg ) {
	   		$('.success').css("display", "");
	   		$(".success").fadeIn(1000, "linear");
	   		$('.success_text').fadeIn("slow");
	   		$('.success_text').html(msg);
	   		setTimeout(function(){location.reload()},3000);
  });
});

/**
 * Edit tournament
 */
$('#editTournament').submit(function(e) {
	var tournament_id	= $("#tournament-id").val();
		tournament 		= $("#tournament").val();
		max_teams  		= $("#max-teams").val();
		format 			= $("#format").val();
		start_date 		= $("#start").val();
		registration 	= $("#registration").val();
		
	 e.preventDefault();

 $.ajax({
     type: "POST",
     url: "lib/submit/submit-tournament.php",
     async:true,
     crossbrowser:true,
     data: { form: 'edit-tournament', start: '' + start_date + '', registration: '' + registration + '', max_teams: '' + max_teams + '', format: '' + format + '', tournament_id: '' + tournament_id + '', tournament: '' + tournament + '' }
   }).success(function( msg ) {
	   		$('.success').css("display", "");
	   		$(".success").fadeIn(1000, "linear");
	   		$('.success_text').fadeIn("slow");
	   		$('.success_text').html(msg);
	   		setTimeout(function(){location.reload()},3000);
  });
});

/**
 * Delete tournament
 * @param tournament_id
 */
function deleteTournament(tournament_id) {
	
	 $(function() {
		 $( "#delete-tournament-confirm" ).dialog({
			 resizable: false,
			 height:200,
			 modal: true,
			 buttons: {
				 "Delete Tournament": function() {
					 $.ajax({
					     type: "POST",
					     url: "lib/submit/submit-tournament.php",
					     data: { form: 'delete-tournament', tournament_id: '' + tournament_id + ''}
					   }).success(function( msg ) {
								    $(".success").css("display", "");
							   		$(".success").fadeIn(1000, "linear");
							   		$(".success_text").fadeIn("slow");
							   		$(".success").html(msg);
							   		setTimeout(function(){location.reload()},3000);
					  });
					 
					 $( this ).dialog( "close" );
				 },
				 Cancel: function() {
					 $( this ).dialog( "close" );
				 }
			 }
		 });
	});
	 
}

/**
 * Set map for a league week
 * @param league_id
 * @param week
 * @param map
 */
function setMap(league_id, week, map) {

	$.ajax({
	     type: "POST",
	     url: "lib/submit/submit-tournament.php",
	     async:true,
	     crossbrowser:true,
	     data: { form: 'set-map', league: '' + league_id + '', week: '' + week + '', map: '' + map + '' }
	   }).success(function( msg ) {
		   		$('.success').css("display", "");
		   		$(".success").fadeIn(1000, "linear");
		   		$('.success_text').fadeIn("slow");
		   		$('.success_text').html(msg);
		   		setTimeout(function(){location.reload()},3000);
	  });
	
}

/**
 * Add map to league
 */
$('#addMap').submit(function(e) {
	var map				= $("#map").val();
		league_id  		= $("#league_id").val();
		
	 e.preventDefault();

 $.ajax({
     type: "POST",
     url: "lib/submit/submit-tournament.php",
     async:true,
     crossbrowser:true,
     data: { form: 'add-map', map: '' + map + '', league_id: '' + league_id + '' }
   }).success(function( msg ) {
	   		$('.success').css("display", "");
	   		$(".success").fadeIn(1000, "linear");
	   		$('.success_text').fadeIn("slow");
	   		$('.success_text').html(msg);
	   		setTimeout(function(){location.reload()},3000);
  });
});

/**
 * Edit tournament rules
 */
$('#editRules').submit(function(e) {
	var body			= CKEDITOR.instances['body'].getData();
		tournament_id  	= $("#tournament_id").val();
		
		e.preventDefault();
		body = str_replace("&#39;", "\'", body);

 $.ajax({
     type: "POST",
     url: "lib/submit/submit-tournament.php",
     async:true,
     crossbrowser:true,
     data: { form: 'edit-rules', body: '' + body + '', tournament_id: '' + tournament_id + '' }
   }).success(function( msg ) {
	   		$('.success').css("display", "");
	   		$(".success").fadeIn(1000, "linear");
	   		$('.success_text').fadeIn("slow");
	   		$('.success_text').html(msg);
	   		setTimeout(function(){location.reload()},3000);
  });
});

/**
 * Lock league rosters
 */
 function rostersLock(league_id) {

 	$.ajax({
	     type: "POST",
	     url: "lib/submit/submit-tournament.php",
	     async:true,
	     crossbrowser:true,
	     data: { form: 'lock-rosters', league_id: '' + league_id + '' }
	   }).success(function( msg ) {
		   		$('.success').css("display", "");
		   		$(".success").fadeIn(1000, "linear");
		   		$('.success_text').fadeIn("slow");
		   		$('.success_text').html(msg);
		   		setTimeout(function(){location.reload()},3000);
	  });

 }

/**
 * Lock league rosters
 */
 function rostersUnLock(league_id) {

 	$.ajax({
	     type: "POST",
	     url: "lib/submit/submit-tournament.php",
	     async:true,
	     crossbrowser:true,
	     data: { form: 'unlock-rosters', league_id: '' + league_id + '' }
	   }).success(function( msg ) {
		   		$('.success').css("display", "");
		   		$(".success").fadeIn(1000, "linear");
		   		$('.success_text').fadeIn("slow");
		   		$('.success_text').html(msg);
		   		setTimeout(function(){location.reload()},3000);
	  });

 }

/**
 * Kick team from tournament modal popup
 * @param league_id
 * @param team_id
 */
function kickTeam(team_id, tournament_id) {

	$(function() {
		 $( "#kick-team-confirm" ).dialog({
			 resizable: false,
			 height:220,
			 width:375,
			 modal: true,
			 buttons: {
				 "Kick Team": function() {
					 $.ajax({
					     type: "POST",
					     url: "lib/submit/submit-tournament.php",
					     data: { form: 'kick-team', team_id: '' + team_id + '', tournament_id: '' + tournament_id + '' }
					   }).success(function( msg ) {
								    $(".team").css("display", "");
							   		$(".team").fadeIn(1000, "linear");
							   		$(".team_text").fadeIn("slow");
							   		$(".team").html(msg);
							   		setTimeout(function(){location.reload()},3000);
					  });
					 
					 $( this ).dialog( "close" );
				 },
				 Cancel: function() {
				 	$('.modal').css('z-index', '1050');
	 				$('.modal-backdrop').css('position', 'relative');
					 $( this ).dialog( "close" );
				 }
			 }
		 });
	});
	
}

 /**
 * Generate tournament round 1 matches
 * @param tournament_id
 */
$('#generateRound1Matches').click(function() {

	var tournament_id = $('#generateRound1Matches').data('tournament-id');
		tournament_teams = $('#generateRound1Matches').data('tournament-teams');

	$.ajax({
		type: "POST",
		url: "generate-round-01-bracket.php",
		data: { form: 'generate-matches', tournament_id: '' + tournament_id + '', max_teams: '' + tournament_teams + '' }
	}).success(function( msg ) {
		$("#clearRound1Matches").removeAttr('style');
		$(".round-1").fadeIn(1000, "linear");
		$(".round-1").html(msg);
	});

});

 /**
 * Generate tournament round 2 matches
 * @param tournament_id
 */
$('#generateRound2Matches').click(function() {

	var tournament_id = $('#generateRound2Matches').data('tournament-id');

	$.ajax({
		type: "POST",
		url: "generate-round-02-bracket.php",
		data: { form: 'generate-matches', tournament_id: '' + tournament_id + '' }
	}).success(function( msg ) {
		$(".round-2").fadeIn(1000, "linear");
		$(".round-2").html(msg);
	});

});

 /**
 * Generate tournament round 3 matches
 * @param tournament_id
 */
$('#generateRound3Matches').click(function() {

	var tournament_id = $('#generateRound3Matches').data('tournament-id');

	$.ajax({
		type: "POST",
		url: "generate-round-03-bracket.php",
		data: { form: 'generate-matches', tournament_id: '' + tournament_id + '' }
	}).success(function( msg ) {
		$(".round-3").fadeIn(1000, "linear");
		$(".round-3").html(msg);
	});

});

 /**
 * Generate tournament round 4 matches
 * @param tournament_id
 */
$('#generateRound4Matches').click(function() {

	var tournament_id = $('#generateRound4Matches').data('tournament-id');

	$.ajax({
		type: "POST",
		url: "generate-round-04-bracket.php",
		data: { form: 'generate-matches', tournament_id: '' + tournament_id + '' }
	}).success(function( msg ) {
		$(".round-4").fadeIn(1000, "linear");
		$(".round-4").html(msg);
	});

});

 /**
 * Generate tournament round 5 matches
 * @param tournament_id
 */
$('#generateRound5Matches').click(function() {

	var tournament_id = $('#generateRound5Matches').data('tournament-id');

	$.ajax({
		type: "POST",
		url: "generate-round-05-bracket.php",
		data: { form: 'generate-matches', tournament_id: '' + tournament_id + '' }
	}).success(function( msg ) {
		$(".round-5").fadeIn(1000, "linear");
		$(".round-5").html(msg);
	});

});

 /**
 * Clear previously generated round 1 matches
 * @param tournament_id
 */
$('#clearRound1Matches').click(function() {

	var tournament_id = $('#generateRound1Matches').data('tournament-id');

	$.ajax({
		type: "POST",
		url: "generate-round-01-bracket.php",
		data: { form: 'clear-matches', tournament_id: '' + tournament_id + '' }
	}).success(function( msg ) {
		$(".round-1").fadeIn(1000, "linear");
		$("#clearRound1Matches").css('display', 'none');
		$(".game-top").text('');
		$(".game-bottom").text('');
	});

});

 /**
  * Edit a tournament match details
  * @param match_id, home_score, home_accept, away_score, away_accept, match_status
  */
$('#editTournamentMatch').submit(function(e) {
	var match_id		= $("#match-id").val();
		home_id 		= $("#home-id").val();
		away_id 		= $("#away-id").val();
		home_score  	= $("#home-team-score").val();
		away_score  	= $("#away-team-score").val();
		home_accept  	= $("#home-team-accepted").val();
		away_accept  	= $("#away-team-accepted").val();
		match_status 	= $("#match-status").val();
		max_teams 		= $("#max-teams").val();
		round 			= $("#match-round").val();
		date 			= $("#match-date").val();
		time 			= $("#match-time").val();
		zone 			= $("#match-zone").val();
		ip 				= $("#match-server-ip").val();
		password 		= $("#match-server-password").val();
		moderator 		= $("#match-server-moderator").val();
		stream_url 		= $("#match-stream-url").val();
		tid 			= $("#tournament-id").val();

		e.preventDefault();

	 $.ajax({
	     type: "POST",
	     url: "lib/submit/submit-tournament.php",
	     async:true,
	     crossbrowser:true,
	     data: { form: 'edit-match', match_id: '' + match_id + '', tournament_id: '' + tid + '', home_id: '' + home_id + '', away_id: '' + away_id + '', home_score: '' + home_score + '', away_score: '' + away_score + '', home_accept: '' + home_accept + '', away_accept: '' + away_accept + '', match_status: '' + match_status + '', max_teams: '' + max_teams + '', round: '' + round + '', match_date: '' + date + '', match_time: '' + time + '', match_zone: '' + zone + '', server_ip: '' + ip + '', server_password: '' + password + '', match_moderator: '' + moderator + '', stream_url: '' + stream_url + '' }
	   }).success(function( msg ) {
		   		$('.success').css("display", "");
		   		$(".success").fadeIn(1000, "linear");
		   		$('.success_text').fadeIn("slow");
		   		$('.success_text').html(msg);
		   		setTimeout(function(){location.reload()},3000);
	  });
});

/**
 * Edit tournament rules
 */
$('#addChatMessage').submit(function(e) {
	var message			= $("#chat-message").val();
		match_id  		= $("#chat-match-id").val();
		username 		= $("#chat-username").val();
		
		e.preventDefault();

	 $.ajax({
	     type: "POST",
	     url: "lib/submit/submit-tournament.php",
	     data: { form: 'add-chat-message', id: '' + match_id + '', username: '' + username + '', message: '' + message + '' }
	   }).success(function( msg ) {
				    $(".chat").css("display", "");
			   		$(".chat").fadeIn(1000, "linear");
			   		$(".chat_text").fadeIn("slow");
			   		$(".chat").html(msg);
			   		setTimeout(function(){location.reload()},3000);
	  });
});

/**
 * Edit tournament rules
 */
$('#addTournamentMap').submit(function(e) {
	var map					= $("#map").val();
		tournament_id  		= $("#tournament_id").val();
		
		e.preventDefault();

	 $.ajax({
	     type: "POST",
	     url: "lib/submit/submit-tournament.php",
	     data: { form: 'add-tournament-map', tournament_id: '' + tournament_id + '', map: '' + map + '' }
	   }).success(function( msg ) {
				    $('.maps_success').css("display", "");
			   		$(".maps_success").fadeIn(1000, "linear");
			   		$('.maps_text').fadeIn("slow");
			   		$('.maps_text').html(msg);
			   		setTimeout(function(){location.reload()},3000);
	  });
});

/**
 * Get available tournament teams for the modal
 * @param tournament_id
 */
function getAvailableTournamentTeams(tournament_id) {

	$.ajax({
	     type: "POST",
	     async: false,
	     url: "get_add_tournament_team.php",
	     data: { id: '' + tournament_id + '' }
	   }).success(function( msg ) {
		   $('#addTournamentTeamsModal').html(msg);
	  });
	
}

/**
 * Set the map for a tournament round
 * @param tournament_id
 * @param round
 * @param map
 */
 function setMap(tournament_id, round, map) {

 	$.ajax({
	     type: "POST",
	     url: "lib/submit/submit-tournament.php",
	     data: { form: 'set-round-map', tournament_id: '' + tournament_id + '', round: '' + round + '', map: '' + map + '' }
	   }).success(function( msg ) {
				    $('.maps_success').css("display", "");
			   		$(".maps_success").fadeIn(1000, "linear");
			   		$('.maps_text').fadeIn("slow");
			   		$('.maps_text').html(msg);
			   		setTimeout(function(){location.reload()},3000);
	  });
 }

 /**
 * Delete a map from a tournament
 * @param tournament_id
 * @param map
 */
 function deleteMap(tournament_id, map) {

 	$.ajax({
	     type: "POST",
	     url: "lib/submit/submit-tournament.php",
	     data: { form: 'delete-map', tournament_id: '' + tournament_id + '', map: '' + map + '' }
	   }).success(function( msg ) {
				    $('.maps_success').css("display", "");
			   		$(".maps_success").fadeIn(1000, "linear");
			   		$('.maps_text').fadeIn("slow");
			   		$('.maps_text').html(msg);
			   		setTimeout(function(){location.reload()},3000);
	  });
 }

/**
 * Add a team to a private tournament
 * @param tournament_id
 * @param team_id
 */
 function addTournamentTeam(tournament_id, team_id) {
	
	var max_teams   = $('.tournament-teams-heading').data('max-teams');
		total_teams = $('.current-teams-amount').data('total-teams');

	$.ajax({
	     type: "POST",
	     url: "lib/submit/submit-tournament-add-team.php",
	     async:true,
	     crossbrowser:true,
	     data: { form: 'add-tournament-team', tournament_id: '' + tournament_id + '', team_id: '' + team_id + '', max_teams: '' + max_teams + '' }
	   }).success(function( msg ) {
	   		var new_total_teams = total_teams + 1;
	   			$('.team-' + team_id).remove();
	   			$('.current-teams-amount').attr('data-total-teams', '' + new_total_teams + '');
	   			$('.current-teams-amount').html('Current Teams (' + new_total_teams + ')');
	   			$('.tournament-teams-heading').html('Tournament Teams (' + new_total_teams + ' of ' + max_teams + ')');
		   		$('.tournament-teams').fadeIn("slow");
		   		$('.tournament-teams').html(msg);
		   		if( new_total_teams == max_teams ) {
		   			$('.tournament-add-team').prop('disabled', true);
		   		}
	  });
	
}

/**
 * Unkick a team from a league
 * @param league_id
 * @param team_id
 */
 function unkickTeam(league_id, team_id) {
	
	$.ajax({
	     type: "POST",
	     url: "lib/submit/submit-tournament.php",
	     async:true,
	     crossbrowser:true,
	     data: { form: 'unkick-team', league_id: '' + league_id + '', team_id: '' + team_id + '' }
	   }).success(function( msg ) {
		   		$('.success').css("display", "");
		   		$(".success").fadeIn(1000, "linear");
		   		$('.success_text').fadeIn("slow");
		   		$('.success_text').html(msg);
		   		setTimeout(function(){location.reload()},3000);
	  });
	
}

 /**
 * Set the status of a tournament match dispute
 * @param dispute_id
 * @param status
 */
 function disputeStatus(status, dispute_id) {

 	$.ajax({
	     type: "POST",
	     url: "lib/submit/submit-tournament.php",
	     data: { form: 'edit-dispute', dispute_id: '' + dispute_id + '', status: '' + status + '' }
	   }).success(function( msg ) {
				    $('.success').css("display", "");
			   		$(".success").fadeIn(1000, "linear");
			   		$('.success_text').fadeIn("slow");
			   		$('.success_text').html(msg);
			   		setTimeout(function(){location.reload()},3000);
	  });
 }

/**
 * Search and replace specifically used for CKEDITOR values to handle single quotes
 * 
 * @param search
 * @param replace
 * @param subject
 * @param count
 * @returns
 */		
function str_replace(search, replace, subject, count) {
	  var i = 0,
	    j = 0,
	    temp = '',
    repl = '',
    sl = 0,
    fl = 0,
    f = [].concat(search),
    r = [].concat(replace),
    s = subject,
    ra = Object.prototype.toString.call(r) === '[object Array]',
    sa = Object.prototype.toString.call(s) === '[object Array]';
  s = [].concat(s);
  if (count) {
    this.window[count] = 0;
  }
  for (i = 0, sl = s.length; i < sl; i++) {
    if (s[i] === '') {
      continue;
    }
    for (j = 0, fl = f.length; j < fl; j++) {
      temp = s[i] + '';
      repl = ra ? (r[j] !== undefined ? r[j] : '') : r[0];
      s[i] = (temp)
        .split(f[j])
        .join(repl);
      if (count && s[i] !== temp) {
        this.window[count] += (temp.length - s[i].length) / f[j].length;
      }
    }
  }
  return sa ? s : s[0];
}