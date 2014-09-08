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
     data: { form: 'edit-league', start: '' + start_date + '', end: '' + end_date + '', max_teams: '' + max_teams + '', total_games: '' + total_games + '', max_roster: '' + max_roster + '', league_id: '' + league_id + '' }
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