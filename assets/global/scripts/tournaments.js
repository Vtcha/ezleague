(function( $ ){

	var EZL_Tournaments = {

		/**
		 * Initialize basic theme JavaScript
		 */
		init: function() {

			this.cacheElements();
			this.updateMatchDetails();
			this.updateChatLog();
			this.reportMatch();
			this.disputeMatch();
			this.updateMatchInformation();
			this.bindEvents();

		},

		/**
		 * Cache elements to object-level variables
		 */
		cacheElements: function() {

			this.accept_details = $('#acceptDetails');
			this.reject_details = $('#rejectDetails');
			this.update_match_form = $('#matchDetails');
			this.update_chat_form = $('#matchChat');
			this.report_match_form = $('#tournamentMatchReport');
			this.dispute_match_form = $('#disputeMatch');
			this.match_info_form = $('#matchInformation');

		},
		
		/**
		 * Update a matchs' details
		 */
		updateMatchDetails: function() {

			this.update_match_form.submit(function(e) {

				var match_id	= $("#match-id").val();
					date	    = $("#match-date").val();
					time	    = $("#match-time").val();
					zone		= $("#match-zone").val();
					stream_url  = $("#match-stream-url").val();

				 e.preventDefault();
				 
			 $.ajax({
			     type: "POST",
			     url: "lib/submit/submit-tournament.php",
			     data: { form: 'update-match-details', id: '' + match_id + '', date: '' + date + '', time: '' + time + '', zone: '' + zone + '', stream_url: '' + stream_url + '' }
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
		 * Update a matchs' server information
		 */
		updateMatchInformation: function() {

			this.match_info_form.submit(function(e) {

				var match_id	= $("#match-id").val();
					ip		    = $("#match-server-ip").val();
					password    = $("#match-server-password").val();
					moderator   = $("#match-server-moderator").val();

				 e.preventDefault();
				 
			 $.ajax({
			     type: "POST",
			     url: "lib/submit/submit-tournament.php",
			     data: { form: 'update-match-information', id: '' + match_id + '', ip: '' + ip + '', password: '' + password + '', moderator: '' + moderator + '' }
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
		 * Add message to match chat log
		 */
		updateChatLog: function() {

			this.update_chat_form.submit(function(e) {

				var match_id	= $("#log-id").val();
					username    = $("#log-username").val();
					message	    = $("textarea#log-message").val();

				 e.preventDefault();

			 $.ajax({
			     type: "POST",
			     url: "lib/submit/submit-tournament.php",
			     data: { form: 'add-chat-message', id: '' + match_id + '', username: '' + username + '', message: '' + message + '' }
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
		 * Report match score
		 */
		reportMatch: function() {

			this.report_match_form.submit(function(e) {

				var match_id	= $("#match-id").val();
					home_score  = $("#match-home-score").val();
					home_team	= $("#match-home-team").val();
					away_score	= $("#match-away-score").val();
					away_team	= $("#match-away-team").val();
					reporter	= $("#match-reporter").val();

				 e.preventDefault();
				 
			 $.ajax({
			     type: "POST",
			     url: "lib/submit/submit-tournament.php",
			     data: { form: 'report-score', id: '' + match_id + '', home_team: '' + home_team + '', home_score: '' + home_score + '', away_team: '' + away_team + '', away_score: '' + away_score + '', reporter: '' + reporter + '' }
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
		 * Dispute match
		 */
		disputeMatch: function() {

			this.dispute_match_form.submit(function(e) {

				var match_id	= $("#dispute-match-id").val();
					reporter    = $("#dispute-reporter").val();
					reason		= $("textarea#dispute-reason").val();
					category	= $("#dispute-category").val();

				 e.preventDefault();
				 
			 $.ajax({
			     type: "POST",
			     url: "lib/submit/submit-tournament.php",
			     data: { form: 'dispute-match', id: '' + match_id + '', reporter: '' + reporter + '', dispute: '' + reason + '', category: '' + category + '' }
			   }).success(function( msg ) {
						    $(".dispute").css("display", "");
					   		$(".dispute").fadeIn(1000, "linear");
					   		$(".success_text").fadeIn("slow");
					   		$(".success").html(msg);
					   		setTimeout(function(){location.reload()},3000);
			  });
			});
			
		},
		
		bindEvents: function() {

			this.accept_details.on( "click", $.proxy( function (e) {
					
				e.preventDefault();
				var match_side = $('#match-side').val();
					match_id   = $('#match-id').val();
				$.ajax({
				     type: "POST",
				     url: "lib/submit/submit-tournament.php",
				     data: { form: 'accept-match-details', id: '' + match_id + '', side: '' + match_side + '' }
				   }).success(function( msg ) {
							    $(".success").css("display", "");
						   		$(".success").fadeIn(1000, "linear");
						   		$(".success_text").fadeIn("slow");
						   		$(".success").html(msg);
						   		setTimeout(function(){location.reload()},3000);
				  });

			}, this ) );
			
			this.reject_details.on( "click", $.proxy( function (e) {
				
				e.preventDefault();
				var match_side = $('#match-side').val();
					match_id   = $('#match-id').val();
				$.ajax({
				     type: "POST",
				     url: "lib/submit/submit-tournament.php",
				     data: { form: 'reject-match-details', id: '' + match_id + '', side: '' + match_side + '' }
				   }).success(function( msg ) {
							    $(".success").css("display", "");
						   		$(".success").fadeIn(1000, "linear");
						   		$(".success_text").fadeIn("slow");
						   		$(".success").html(msg);
						   		setTimeout(function(){location.reload()},3000);
				  });

			}, this ) );

		},

	};

	/**
	 * Wait until the document is ready before initializing the js
	 */
	$(document).ready(function(){
		
		EZL_Tournaments.init();

	});

}( jQuery ) );