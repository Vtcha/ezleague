(function( $ ){

	var EZL_Teams = {

		/**
		 * Initialize basic theme JavaScript
		 */
		init: function() {

			this.cacheElements();
			this.createTeam();
			this.teamSettings();
			this.teamPassword();
			this.updateLeagueRoster();
			this.bindEvents();

		},

		/**
		 * Cache elements to object-level variables
		 */
		cacheElements: function() {

			this.create_team_form = $('#createTeam');
			this.team_settings_form = $('#teamSettings');
			this.team_password_form = $('#teamPassword');
			this.kick_member = $('.kickMember');
			this.league_member_form = $('#addLeagueMember');

		},
		
		/**
		 * Create team
		 */
		createTeam: function() {

			this.create_team_form.submit(function(e) {
				
				var team	 = $("#team-name").val();
					abbr     = $("#team-abbreviation").val();
					website  = $("#team-website").val();
					password = $("#team-password").val();
					confirm  = $("#team-confirm").val();
					admin	 = $("#team-admin").val();
					errors = 0;
				 e.preventDefault();
			
			if( team.length < 3 ) {
				$(".name").css("display", "");
		   		$(".name").fadeIn(1000, "linear");
		   		$(".name").fadeIn("slow");
				$(".name").html('<strong>Error</strong> must be 3-30 characters ');
				errors++;
			} else {
				$(".name").css("display", "");
			}
			
			if( abbr.length < 3 || abbr.length > 5 ) {
				$(".abbr").css("display", "");
		   		$(".abbr").fadeIn(1000, "linear");
		   		$(".abbr").fadeIn("slow");
				$(".abbr").html('<strong>Error</strong> must be 3-5 characters ');
				errors++;
			} else {
				$(".abbr").css("display", "");
			}
			
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
				     url: "lib/submit/submit-team.php",
				     data: { form: 'create-team', team: '' + team + '', abbr: '' + abbr + '', website: '' + website + '', admin: '' + admin + '', password: '' + password + ''}
				   }).success(function( msg ) {
					   		$(".success").css("display", "");
					   		$(".success").fadeIn(1000, "linear");
					   		$(".success_text").fadeIn("slow");
					   		$(".success").html(msg);
					   		if(msg == '<strong>Success!</strong> Team has been created') {
					   			setTimeout(function(){window.location = 'index.php'},3000);
					   		}
				  });
			}
			
			});
			
		},
		
		/**
		 * Update team settings
		 */
		teamSettings: function() {

			this.team_settings_form.submit(function(e) {
				
				var admin		= $("#team-admin").val();
					leader	    = $("#team-leader").val();
					coleader    = $("#team-coleader").val();
					website		= $("#team-website").val();
					id			= $("#team-id").val();
				 e.preventDefault();
				 
			 $.ajax({
			     type: "POST",
			     url: "lib/submit/submit-team.php",
			     data: { form: 'team-settings', admin: '' + admin + '', leader: '' + leader + '', coleader: '' + coleader + '', website: '' + website + '', id: '' + id + ''}
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
		 * Update team join password
		 */
		teamPassword: function() {

			this.team_password_form.submit(function(e) {

				var password	= $("#team-join").val();
					confirm	    = $("#team-confirm").val();
					id			= $("#team-id").val();
					errors 		= 0;

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
				     url: "lib/submit/submit-team.php",
				     data: { form: 'team-password', password: '' + password + '', id: '' + id + ''}
				   }).success(function( msg ) {
							    $(".success").css("display", "");
						   		$(".success").fadeIn(1000, "linear");
						   		$(".success_text").fadeIn("slow");
						   		$(".success").html(msg);
						   		setTimeout(function(){location.reload()},3000);
				  });
			 
			}
		
			});
			
		},
		
		/**
		 * Add or update member to league roster
		 */
		updateLeagueRoster: function() {

			this.league_member_form.submit(function(e) {
				
				var league		= $("#league-id").val();
					user	    = $("#user-id").val();
					team	    = $("#team-id").val();
					roster		= $("#roster-id").val();

				 e.preventDefault();
				 
			 $.ajax({
			     type: "POST",
			     url: "lib/submit/submit-team.php",
			     data: { form: 'add-league-roster', league: '' + league + '', user: '' + user + '', team: '' + team + '', roster: '' + roster + '' }
			   }).success(function( msg ) {
						    $(".success").css("display", "");
					   		$(".success").fadeIn(1000, "linear");
					   		$(".success_text").fadeIn("slow");
					   		$(".success").html(msg);
					   		setTimeout(function(){location.reload()},3000);
			  });
			});
			
		},
		
		bindEvents: function() {

			this.kick_member.on( "click", $.proxy( function (e) {

				e.preventDefault();
				alert('yes');
			}, this ) );

		},

	};

	/**
	 * Wait until the document is ready before initializing the js
	 */
	$(document).ready(function(){
		
		EZL_Teams.init();

	});

}( jQuery ) );