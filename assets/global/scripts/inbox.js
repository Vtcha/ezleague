/**
 * Compose a new inbox message
 */
$('#sendMessage').submit(function(e) {
	var from		= $("#from").val();
		to		    = $("#to").val();
		subject		= $("#subject").val();
		message	    = CKEDITOR.instances['inbox_message'].getData();
		 e.preventDefault();
		 message	    = str_replace("&#39;", "\'", message);

		 $.ajax({
		     type: "POST",
		     url: "lib/submit/submit-inbox.php",
		     data: { form: 'send-message', from: '' + from + '', to: '' + to + '', subject: '' + subject + '', message: '' + message + ''}
		   }).success(function( msg ) {
				    $(".success").css("display", "");
			   		$(".success").fadeIn(1000, "linear");
			   		$(".success_text").fadeIn("slow");
			   		$(".success").html(msg);
			   		setTimeout(function(){location.reload()},3000);
		  });
});

/**
 * Send a response to an inbox message
 */
$('#addResponse').submit(function(e) {
	var author		= $("#reply-author").val();
		msg_id	    = $("#reply-id").val();
		message	    = CKEDITOR.instances['inbox_message'].getData();
		 e.preventDefault();
		 message	    = str_replace("&#39;", "\'", message);

		 $.ajax({
		     type: "POST",
		     url: "lib/submit/submit-inbox.php",
		     data: { form: 'add-reply', id: '' + msg_id + '', author: '' + author + '', message: '' + message + ''}
		   }).success(function( msg ) {
				    $(".success").css("display", "");
			   		$(".success").fadeIn(1000, "linear");
			   		$(".success_text").fadeIn("slow");
			   		$(".success").html(msg);
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