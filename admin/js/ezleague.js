/**
 * ezLeague v3.0
 * Admin JavaScript / jQuery
 * Re-Write began August 11st, 2014
 */

/**
 * Create initial admin account
 */
$('#ezLeagueAdmin').submit(function(e) {
	var username    = $("#admin-username").val();
		email	    = $("#admin-email").val();
		password    = $("#admin-password").val();
		confirm     = $("#admin-confirm").val();

	 e.preventDefault();
if(password == confirm && password != '') {
 $.ajax({
     type: "POST",
     url: "submit.php",
     data: { form: 'create-admin', username: '' + username + '', email: '' + email + '', password: '' + password + '', confirm: '' + confirm + '' }
   }).success(function( msg ) {
	      $('.success').css("display", "");
	      $(".success").fadeIn(1000, "linear");
	      $('.success_text').fadeIn("slow");
	      $('.success_text').html(msg);
 	   if(msg == "Account has been created. You may now login.") {
 		  setTimeout(function(){window.location='index.php'},3000);
 	   }
  });
} else {
		$('.success').css("display", "");
        $(".success").fadeIn(1000, "linear");
        $('.success_text').fadeIn("slow");
        $('.success_text').html('<strong>Error</strong> Passwords do not match');
}
});

$('#ezLeagueInstallation').submit(function(e) {

	var site_name	= $("#site_name").val();
		
	 e.preventDefault();
 $.ajax({
     type: "POST",
     url: "submit.php",
     data: { form: 'install', site_name: '' + site_name + '' }
   }).success(function( msg ) {
	      $('.success').css("display", "");
	      $(".success").fadeIn(1000, "linear");
	      $('.success_text').fadeIn("slow");
	      $('.success_text').html(msg);
	      setTimeout(function(){window.location='login.php'},3000);
  });
});

/**
 * Admin login
 */
$('#ezLeagueLogin').submit(function(e) {
	var username	= $("#username").val();
		password    = $("#password").val();
		
	 e.preventDefault();
 $.ajax({
     type: "POST",
     url: "submit.php",
     data: { form: 'login', username: '' + username + '', password: '' + password + '' }
   }).success(function( msg ) {
	      $('.login_success').css("display", "");
	      $(".login_success").fadeIn(1000, "linear");
	      $('.login_success_text').fadeIn("slow");
	      $('.login_success_text').html(msg);
	      setTimeout(function(){location.reload()},3000);
  });
});

/**
 * Create new admin user
 */	
$('#ezLeagueRegister').submit(function(e) {
	var username    = $("#register-username").val();
		email	    = $("#register-email").val();
		password    = $("#register-password").val();
		confirm     = $("#register-confirm").val();

	 e.preventDefault();
if(password == confirm && password != '') {
 $.ajax({
     type: "POST",
     url: "submit.php",
     data: { form: 'register', username: '' + username + '', email: '' + email + '', password: '' + password + '', confirm: '' + confirm + '' }
   }).success(function( msg ) {
	      $('.success').css("display", "");
	      $(".success").fadeIn(1000, "linear");
	      $('.success_text').fadeIn("slow");
	      $('.success_text').html(msg);
 	   if(msg == "<strong>Success!</strong> Account has been created. You may now login.") {
 		  setTimeout(function(){location.reload()},3000);
 	   }
  });
} else {
		$('.success').css("display", "");
        $(".success").fadeIn(1000, "linear");
        $('.success_text').fadeIn("slow");
        $('.success_text').html('<strong>Error</strong> Passwords do not match');
}
});
	
/*
 * END LOGIN & REGISTRATION FUNCTIONALITY
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
