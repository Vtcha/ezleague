/**
 * Edit match score
 */
$('#editScore').submit(function(e) {

	var match_id		= $("#match_id").val();
		home	  		= $("#home").val();
		away			= $("#away").val();
		home_score		= $("#home-score").val();
		away_score		= $("#away-score").val();
		
	 e.preventDefault();

 $.ajax({
     type: "POST",
     url: "lib/submit/submit-matches.php",
     async:true,
     crossbrowser:true,
     data: { form: 'edit-score', match_id: '' + match_id + '', home: '' + home + '', home_score: '' + home_score + '', away: '' + away + '', away_score: '' + away_score + '' }
   }).success(function( msg ) {
	   		$('.success').css("display", "");
	   		$(".success").fadeIn(1000, "linear");
	   		$('.success_text').fadeIn("slow");
	   		$('.success_text').html(msg);
	   		setTimeout(function(){location.reload()},3000);
  });
 
});

function updateFeatured(match_id, week, league_id, method) {

	$.ajax({
     type: "POST",
     url: "lib/submit/submit-matches.php",
     async:true,
     crossbrowser:true,
     data: { form: 'update-featured-match', match_id: '' + match_id + '', week: '' + week + '', league_id: '' + league_id + '', method: '' + method + '' }
   }).success(function( msg ) {
	   		$('.success').css("display", "");
	   		$(".success").fadeIn(1000, "linear");
	   		$('.success_text').fadeIn("slow");
	   		$('.success_text').html(msg);
	   		setTimeout(function(){location.reload()},3000);
  });

}