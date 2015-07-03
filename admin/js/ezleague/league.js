/**
 * Create season date pickers
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
 * Create league
 */
$('#createLeague').submit(function(e) {
	var game			= $("#game").val();
		max_teams  		= $("#max-teams").val();
		total_games		= $("#total-games").val();
		league			= $("#league").val();
		max_roster 		= $("#max-roster").val();
		start_date 		= $("#start").val();
		end_date 		= $("#end").val();
		
	 e.preventDefault();

 $.ajax({
     type: "POST",
     url: "lib/submit/submit-league.php",
     async:true,
     crossbrowser:true,
     data: { form: 'create-league', start: '' + start_date + '', end: '' + end_date + '', max_teams: '' + max_teams + '', total_games: '' + total_games + '', max_roster: '' + max_roster + '', league: '' + league + '', game: '' + game + '' }
   }).success(function( msg ) {
	   		$('.success').css("display", "");
	   		$(".success").fadeIn(1000, "linear");
	   		$('.success_text').fadeIn("slow");
	   		$('.success_text').html(msg);
	   		setTimeout(function(){location.reload()},3000);
  });
});

/**
 * Edit league
 */
$('#editLeague').submit(function(e) {
	var league_id		= $("#league-id").val();
		league 			= $("#league").val();
		max_teams  		= $("#max-teams").val();
		total_games		= $("#total-games").val();
		max_roster 		= $("#max-roster").val();
		start_date 		= $("#start").val();
		end_date 		= $("#end").val();
		
	 e.preventDefault();

 $.ajax({
     type: "POST",
     url: "lib/submit/submit-league.php",
     async:true,
     crossbrowser:true,
     data: { form: 'edit-league', start: '' + start_date + '', end: '' + end_date + '', max_teams: '' + max_teams + '', total_games: '' + total_games + '', max_roster: '' + max_roster + '', league_id: '' + league_id + '', league: '' + league + '' }
   }).success(function( msg ) {
	   		$('.success').css("display", "");
	   		$(".success").fadeIn(1000, "linear");
	   		$('.success_text').fadeIn("slow");
	   		$('.success_text').html(msg);
	   		setTimeout(function(){location.reload()},3000);
  });
});

/**
 * Delete league
 * @param league_id
 */
function deleteLeague(league_id) {
	
	 $(function() {
		 $( "#delete-league-confirm" ).dialog({
			 resizable: false,
			 height:200,
			 modal: true,
			 buttons: {
				 "Delete League": function() {
					 $.ajax({
					     type: "POST",
					     url: "lib/submit/submit-league.php",
					     data: { form: 'delete-league', league_id: '' + league_id + ''}
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
 * Create season
 */
$('#createSeason').submit(function(e) {
	var start			= $("#start").val();
		end	    		= $("#end").val();
		registration	= $("#registration").val();
		league_id		= $("#league_id").val();
		
	 e.preventDefault();

 $.ajax({
     type: "POST",
     url: "lib/submit/submit-league.php",
     async:true,
     crossbrowser:true,
     data: { form: 'create-season', start: '' + start + '', end: '' + end + '', registration: '' + registration + '', league_id: '' + league_id + '' }
   }).success(function( msg ) {
	   		$('.success').css("display", "");
	   		$(".success").fadeIn(1000, "linear");
	   		$('.success_text').fadeIn("slow");
	   		$('.success_text').html(msg);
	   		setTimeout(function(){location.reload()},3000);
  });
});

/**
 * Edit season
 */
 $('#editSeason').submit(function(e) {
	var start			= $("#start").val();
		end	    		= $("#end").val();
		registration	= $("#registration").val();
		season_id 		= $("#season-id").val();
		
	 e.preventDefault();

 $.ajax({
     type: "POST",
     url: "lib/submit/submit-league.php",
     async:true,
     crossbrowser:true,
     data: { form: 'edit-season', start: '' + start + '', end: '' + end + '', registration: '' + registration + '', season_id: '' + season_id + '' }
   }).success(function( msg ) {
	   		$('.success').css("display", "");
	   		$(".success").fadeIn(1000, "linear");
	   		$('.success_text').fadeIn("slow");
	   		$('.success_text').html(msg);
	   		setTimeout(function(){location.reload()},3000);
  });
});

/**
 * Get season details for modal
 * @param league_id
 * @param season_id
 */
function getSeason(league_id, season_id) {
	
	$.ajax({
	     type: "POST",
	     async: false,
	     url: "get_season.php",
	     data: { league_id: '' + league_id + '', season_id: '' + season_id + '' }
	   }).success(function( msg ) {
		   $('#editSeasonModal').html(msg);
	  });
	
}

/**
 * Delete a season
 * @param league_id
 * @param season
 */
function deleteSeason(season) {
	
	$.ajax({
	     type: "POST",
	     url: "lib/submit/submit-league.php",
	     async:true,
	     crossbrowser:true,
	     data: { form: 'delete-season', season: '' + season + '' }
	   }).success(function( msg ) {
		   		$('.success').css("display", "");
		   		$(".success").fadeIn(1000, "linear");
		   		$('.success_text').fadeIn("slow");
		   		$('.success_text').html(msg);
		   		setTimeout(function(){location.reload()},3000);
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
	     url: "lib/submit/submit-league.php",
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
     url: "lib/submit/submit-league.php",
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
 * Edit league rules
 */
$('#editRules').submit(function(e) {
	var body			= CKEDITOR.instances['body'].getData();
		league_id  		= $("#league_id").val();
		
		e.preventDefault();
		body = str_replace("&#39;", "\'", body);

 $.ajax({
     type: "POST",
     url: "lib/submit/submit-league.php",
     async:true,
     crossbrowser:true,
     data: { form: 'edit-rules', body: '' + body + '', league_id: '' + league_id + '' }
   }).success(function( msg ) {
	   		$('.success').css("display", "");
	   		$(".success").fadeIn(1000, "linear");
	   		$('.success_text').fadeIn("slow");
	   		$('.success_text').html(msg);
	   		setTimeout(function(){location.reload()},3000);
  });
});

/**
 * Add a team to a league
 * @param league_id
 * @param team_id
 */
 function addLeagueTeam(league_id, team_id) {
	
	var max_teams   = $('.league-teams').data('max-teams');
		total_teams = $('.current-teams-amount').data('total-teams');

	$.ajax({
	     type: "POST",
	     url: "lib/submit/submit-league-add-team.php",
	     async:true,
	     crossbrowser:true,
	     data: { form: 'add-league-team', league_id: '' + league_id + '', team_id: '' + team_id + '', max_teams: '' + max_teams + '' }
	   }).success(function( msg ) {
	   		var new_total_teams = total_teams + 1;
	   			$('.team-' + team_id).remove();
	   			$('.current-teams-amount').attr('data-total-teams', '' + new_total_teams + '');
	   			$('.current-teams-amount').html('Current Teams (' + new_total_teams + ')');
	   			$('.league-teams-heading').html('League Teams (' + new_total_teams + ' of ' + max_teams + ')');
		   		$('.league-teams').fadeIn("slow");
		   		$('.league-teams').html(msg);
		   		if( new_total_teams == max_teams ) {
		   			$('.league-add-team').prop('disabled', true);
		   		}
	  });
	
}

/**
 * Get available league teams for the modal
 * @param league_id
 */
function getAvailableLeagueTeams(league_id) {

	$.ajax({
	     type: "POST",
	     async: false,
	     url: "get_add_league_team.php",
	     data: { id: '' + league_id + '' }
	   }).success(function( msg ) {
		   $('#addLeagueTeamsModal').html(msg);
	  });
	
}

/**
 * Lock league rosters
 */
 function rostersLock(league_id) {

 	$.ajax({
	     type: "POST",
	     url: "lib/submit/submit-league.php",
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
	     url: "lib/submit/submit-league.php",
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
 * Kick team from league modal popup
 * @param league_id
 * @param team_id
 */
function kickTeam(league_id, team_id) {
	
	$.ajax({
	     type: "POST",
	     async: false,
	     url: "get_kick_team.php",
	     data: { league_id: '' + league_id + '', team_id: '' + team_id + '' }
	   }).success(function( msg ) {
		   $('#kickTeamModal').html(msg);
	  });
	
}

 /**
 * Kick team from league form
 */
$('#kickTeam').submit(function(e) {
	var league_id		= $("#league-id").val();
		team_id  		= $("#team-id").val();
		reason			= $("textarea#reason").val();

	 e.preventDefault();
	 
	 $('.modal').css('z-index', '100');
	 $('.modal-backdrop').css('position', 'relative');
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
					     url: "lib/submit/submit-league.php",
					     data: { form: 'kick-team', team_id: '' + team_id + '', league_id: '' + league_id + '', reason: '' + reason + '' }
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
				 	$('.modal').css('z-index', '1050');
	 				$('.modal-backdrop').css('position', 'relative');
					 $( this ).dialog( "close" );
				 }
			 }
		 });
	});
});

/**
 * Unkick a team from a league
 * @param league_id
 * @param team_id
 */
 function unkickTeam(league_id, team_id) {
	
	$.ajax({
	     type: "POST",
	     url: "lib/submit/submit-league.php",
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