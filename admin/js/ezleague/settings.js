/**
 * Get game details for modal
 * @param game_id
 */
function getGame(game_id) {
	
	$.ajax({
	     type: "POST",
	     async: false,
	     url: "get_game.php",
	     data: { id: '' + game_id + '' }
	   }).success(function( msg ) {
		   $('#editGameModal').html(msg);
	  });
	
}

/**
 * Add a new game to the system
 */
$('#addGame').submit(function(e) {
	var game			= $("#game").val();
		short_name		= $("#short-name").val();
		slug	  		= $("#slug").val();
		
	 e.preventDefault();

 $.ajax({
     type: "POST",
     url: "lib/submit/submit-settings.php",
     async:true,
     crossbrowser:true,
     data: { form: 'add-game', game: '' + game + '', short: '' + short_name + '', slug: '' + slug + '' }
   }).success(function( msg ) {
	   		$('.success').css("display", "");
	   		$(".success").fadeIn(1000, "linear");
	   		$('.success_text').fadeIn("slow");
	   		$('.success_text').html(msg);
	   		setTimeout(function(){location.reload()},3000);
  });
});

/**
 * Edit a game details
 */
$('#editGame').submit(function(e) {
	var game_id			= $("#game-id").val();
		short_name		= $("#game-short-name").val();
		
	 e.preventDefault();

 $.ajax({
     type: "POST",
     url: "lib/submit/submit-settings.php",
     async:true,
     crossbrowser:true,
     data: { form: 'edit-game', game_id: '' + game_id + '', short_name: '' + short_name + '' }
   }).success(function( msg ) {
	   		$('.success').css("display", "");
	   		$(".success").fadeIn(1000, "linear");
	   		$('.success_text').fadeIn("slow");
	   		$('.success_text').html(msg);
	   		setTimeout(function(){location.reload()},3000);
  });
});

$('#createAdmin').submit(function(e) {
	var username	= $("#admin-username").val();
		password	= $("#admin-password").val();
		confirm		= $("#admin-confirm").val();
		email		= $("#admin-email").val();
		
		e.preventDefault();
		
		if(password == confirm && password != '' && password.length >= 6) {
			 $.ajax({
			     type: "POST",
			     url: "lib/submit/submit-settings.php",
			     data: { form: 'create-admin', username: '' + username + '', email: '' + email + '', password: '' + password + '', confirm: '' + confirm + '' }
			   }).success(function( msg ) {
				   		$(".success").css("display", "");
				   		$(".success").fadeIn(1000, "linear");
				   		$(".success_text").fadeIn("slow");
				   		$(".success_text").html(msg);
			 		  setTimeout(function(){location.reload()},3000);
			  });
			} else {
					$(".success").css("display", "");
			   		$(".success").fadeIn(1000, "linear");
			   		$(".success_text").fadeIn("slow");
			   		$(".success_text").html('<strong>Error</strong> Passwords do not match, or is less than 6 characters');
			}

});

/**
 * Delete admin account
 * @param user_id
 */
function deleteAdmin(user_id) {
	
	 $(function() {
		 $( "#delete-admin-confirm" ).dialog({
			 resizable: false,
			 height:175,
			 width:500,
			 modal: true,
			 buttons: {
				 "Delete Admin": function() {
					 $.ajax({
					     type: "POST",
					     url: "lib/submit/submit-settings.php",
					     data: { form: 'delete-admin', user_id: '' + user_id + ''}
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
 * Permanently delete a game
 * @param game_id
 */
function deleteGame(game_id) {
	
	 $(function() {
		 $( "#delete-game-confirm" ).dialog({
			 resizable: false,
			 height:200,
			 width:500,
			 modal: true,
			 buttons: {
				 "Delete Game": function() {
					 $.ajax({
					     type: "POST",
					     url: "lib/submit/submit-settings.php",
					     data: { form: 'delete-game', game_id: '' + game_id + ''}
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
 * Update facebook url
 */
$('#updateFacebook').submit(function(e) {
	var facebook			= $("#facebook").val();
		
	 e.preventDefault();

 $.ajax({
     type: "POST",
     url: "lib/submit/submit-settings.php",
     async:true,
     crossbrowser:true,
     data: { form: 'update-facebook', facebook: '' + facebook + '' }
   }).success(function( msg ) {
	   		$('.success').css("display", "");
	   		$(".success").fadeIn(1000, "linear");
	   		$('.success_text').fadeIn("slow");
	   		$('.success_text').html(msg);
	   		setTimeout(function(){location.reload()},3000);
  });
});

/**
 * Update twitter handle
 */
$('#updateTwitter').submit(function(e) {
	var twitter			= $("#twitter").val();
		
	 e.preventDefault();

 $.ajax({
     type: "POST",
     url: "lib/submit/submit-settings.php",
     async:true,
     crossbrowser:true,
     data: { form: 'update-twitter', twitter: '' + twitter + '' }
   }).success(function( msg ) {
	   		$('.success').css("display", "");
	   		$(".success").fadeIn(1000, "linear");
	   		$('.success_text').fadeIn("slow");
	   		$('.success_text').html(msg);
	   		setTimeout(function(){location.reload()},3000);
  });
});

/**
 * Update youtube link
 */
$('#updateYouTube').submit(function(e) {
	var youtube			= $("#youtube").val();
		
	 e.preventDefault();

 $.ajax({
     type: "POST",
     url: "lib/submit/submit-settings.php",
     async:true,
     crossbrowser:true,
     data: { form: 'update-youtube', youtube: '' + youtube + '' }
   }).success(function( msg ) {
	   		$('.success').css("display", "");
	   		$(".success").fadeIn(1000, "linear");
	   		$('.success_text').fadeIn("slow");
	   		$('.success_text').html(msg);
	   		setTimeout(function(){location.reload()},3000);
  });
});

/**
 * Update google plus link
 */
$('#updateGoogle').submit(function(e) {
	var google			= $("#google").val();
		
	 e.preventDefault();

 $.ajax({
     type: "POST",
     url: "lib/submit/submit-settings.php",
     async:true,
     crossbrowser:true,
     data: { form: 'update-google', google: '' + google + '' }
   }).success(function( msg ) {
	   		$('.success').css("display", "");
	   		$(".success").fadeIn(1000, "linear");
	   		$('.success_text').fadeIn("slow");
	   		$('.success_text').html(msg);
	   		setTimeout(function(){location.reload()},3000);
  });
});

/**
 * Update site name
 */
$('#siteName').submit(function(e) {
	var name			= $("#name").val();
		
	 e.preventDefault();

 $.ajax({
     type: "POST",
     url: "lib/submit/submit-settings.php",
     async:true,
     crossbrowser:true,
     data: { form: 'update-settings', setting: 'name', value: '' + name + '' }
   }).success(function( msg ) {
	   		$('.success').css("display", "");
	   		$(".success").fadeIn(1000, "linear");
	   		$('.success_text').fadeIn("slow");
	   		$('.success_text').html(msg);
	   		setTimeout(function(){location.reload()},3000);
  });
});

/**
 * Update site url
 */
$('#siteURL').submit(function(e) {
	var url			= $("#url").val();
		
	 e.preventDefault();

 $.ajax({
     type: "POST",
     url: "lib/submit/submit-settings.php",
     async:true,
     crossbrowser:true,
     data: { form: 'update-settings', setting: 'url', value: '' + url + '' }
   }).success(function( msg ) {
	   		$('.success').css("display", "");
	   		$(".success").fadeIn(1000, "linear");
	   		$('.success_text').fadeIn("slow");
	   		$('.success_text').html(msg);
	   		setTimeout(function(){location.reload()},3000);
  });
});

/**
 * Update site contact email
 */
$('#siteContact').submit(function(e) {
	var email			= $("#email").val();
		
	 e.preventDefault();

 $.ajax({
     type: "POST",
     url: "lib/submit/submit-settings.php",
     async:true,
     crossbrowser:true,
     data: { form: 'update-settings', setting: 'contact', value: '' + email + '' }
   }).success(function( msg ) {
	   		$('.success').css("display", "");
	   		$(".success").fadeIn(1000, "linear");
	   		$('.success_text').fadeIn("slow");
	   		$('.success_text').html(msg);
	   		setTimeout(function(){location.reload()},3000);
  });
});

/**
 * Update site Mandrill settings
 */
$('#siteMandrill').submit(function(e) {
	var username			= $("#mandrill-username").val();
		password 			= $("#mandrill-password").val();
		
	 e.preventDefault();

 $.ajax({
     type: "POST",
     url: "lib/submit/submit-settings.php",
     async:true,
     crossbrowser:true,
     data: { form: 'update-mandrill', username: '' + username + '', password: '' + password + '' }
   }).success(function( msg ) {
	   		$('.success').css("display", "");
	   		$(".success").fadeIn(1000, "linear");
	   		$('.success_text').fadeIn("slow");
	   		$('.success_text').html(msg);
	   		setTimeout(function(){location.reload()},3000);
  });
});

/**
 * Update site about content
 */
$('#siteAbout').submit(function(e) {
	var about	    = CKEDITOR.instances['content'].getData();
		 e.preventDefault();
		 about	    = str_replace("&#39;", "\'", about);

		 $.ajax({
		     type: "POST",
		     url: "lib/submit/submit-settings.php",
		     data: { form: 'update-settings', setting: 'about', value: '' + about + '' }
		   }).success(function( msg ) {
			   		$('.success').css("display", "");
			   		$(".success").fadeIn(1000, "linear");
			   		$('.success_text').fadeIn("slow");
			   		$('.success_text').html(msg);
			   		setTimeout(function(){location.reload()},3000);
		  });
});

/**
 * Update site timezone
 */
 $('#siteTimezone').submit(function(e) {
	var timezone			= $("#timezone").val();

	 e.preventDefault();

 $.ajax({
     type: "POST",
     url: "lib/submit/submit-settings.php",
     async:true,
     crossbrowser:true,
     data: { form: 'update-settings', setting: 'timezone', value: '' + timezone + '' }
   }).success(function( msg ) {
	   		$('.success').css("display", "");
	   		$(".success").fadeIn(1000, "linear");
	   		$('.success_text').fadeIn("slow");
	   		$('.success_text').html(msg);
	   		setTimeout(function(){location.reload()},3000);
  });
});

$('#updateEmail').submit(function(e) {
	var user_id		= $("#user-id").val();
		email		= $("#admin-email").val();
		e.preventDefault();
		
		 $.ajax({
		     type: "POST",
		     url: "lib/submit/submit-user.php",
		     data: { form: 'update-email', user_id: '' + user_id + '', email: '' + email + '' }
		   }).success(function( msg ) {
			   		$('.success-email').css("display", "");
			   		$(".success-email").fadeIn(1000, "linear");
			   		$('.success_text').fadeIn("slow");
			   		$('.success_text').html(msg);
			   		setTimeout(function(){location.reload()},3000);
		  });
});

$('#updatePassword').submit(function(e) {
	var password	= $("#admin-password").val();
		confirm	    = $("#admin-confirm").val();
		id			= $("#user-id").val();
		errors		= 0;
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
		     url: "lib/submit/submit-user.php",
		     data: { form: 'update-password', user_id: '' + id + '', password: '' + password + ''}
		   }).success(function( msg ) {
					    $(".password").css("display", "");
				   		$(".password").fadeIn(1000, "linear");
				   		$(".success_text").fadeIn("slow");
				   		$(".success").html(msg);
				   		setTimeout(function(){location.reload()},3000);
		  });
		 
	}
});

/**
 * Update twitter app settings
 */
 $('#updateTwitterApp').submit(function(e) {
	var api			 = $("#twitter-api").val();
		secret		 = $("#twitter-secret").val();
		token		 = $("#twitter-token").val();
		token_secret = $("#twitter-token-secret").val();
		handle 		 = $("#twitter-handle").val();
		count 		 = $("#twitter-count").val();
		
	 e.preventDefault();

 $.ajax({
     type: "POST",
     url: "lib/submit/submit-settings.php",
     async:true,
     crossbrowser:true,
     data: { form: 'update-twitter-app', count: '' + count + '', handle: '' + handle + '', api: '' + api + '', secret: '' + secret + '', token: '' + token + '', token_secret: '' + token_secret + '' }
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