/**
 * Add news post
 */
$('#addNews').submit(function(e) {
	var title			= $("#title").val();
		body			= CKEDITOR.instances['body'].getData();
		author			= $("#author").val();
		game			= $("#game").val();
		media			= $("#media").val();
		categories = [];
        $('#category:checked').each(function(i){
          categories[i] = $(this).val();
        });
		
	 e.preventDefault();
	 body = str_replace("&#39;", "\'", body);

 $.ajax({
     type: "POST",
     url: "lib/submit/submit-news.php",
     async:true,
     crossbrowser:true,
     data: { form: 'add-news', title: '' + title + '', body: '' + body + '', author: '' + author + '', game: '' + game + '', categories: '' + categories + '', media: '' + media + '' }
   }).success(function( msg ) {
	   		$('.success').css("display", "");
	   		$(".success").fadeIn(1000, "linear");
	   		$('.success_text').fadeIn("slow");
	   		$('.success_text').html(msg);
	   		setTimeout(function(){location.reload()},3000);
  });
});

/**
 * Edit news post
 */
$('#editNews').submit(function(e) {
	var title			= $("#title").val();
		body			= CKEDITOR.instances['body'].getData();
		author			= $("#author").val();
		media			= $("#media").val();
		post_id 		= $("#post-id").val();
		
		game = [];
        $('#game:checked').each(function(i){
          game[i] = $(this).val();
        });
		categories = [];
        $('#category:checked').each(function(i){
          categories[i] = $(this).val();
        });

	 e.preventDefault();
	 body = str_replace("&#39;", "\'", body);

 $.ajax({
     type: "POST",
     url: "lib/submit/submit-news.php",
     async:true,
     crossbrowser:true,
     data: { form: 'edit-news', post_id: '' + post_id + '', title: '' + title + '', body: '' + body + '', author: '' + author + '', game: '' + game + '', categories: '' + categories + '', media: '' + media + '' }
   }).success(function( msg ) {
	   		$('.success').css("display", "");
	   		$(".success").fadeIn(1000, "linear");
	   		$('.success_text').fadeIn("slow");
	   		$('.success_text').html(msg);
	   		setTimeout(function(){location.reload()},3000);
  });
});

/**
 * Save news post as draft
 */
function saveDraft() {

	var post_id			= $("#post-id").val();
		title			= $("#title").val();
		body			= CKEDITOR.instances['body'].getData();
		author			= $("#author").val();
		game			= $("#game").val();
		media			= $("#media").val();
		categories = [];
        $('#category:checked').each(function(i){
          categories[i] = $(this).val();
        });

	 body = str_replace("&#39;", "\'", body);

	 $.ajax({
	     type: "POST",
	 url: "lib/submit/submit-news.php",
	 async:true,
	 crossbrowser:true,
	 data: { form: 'update-draft', post_id: '' + post_id + '', title: '' + title + '', body: '' + body + '', author: '' + author + '', game: '' + game + '', categories: '' + categories + '', media: '' + media + '' }
	   }).success(function( msg ) {
		   		$('.success').css("display", "");
	   		$(".success").fadeIn(1000, "linear");
	   		$('.success_text').fadeIn("slow");
	   		$('.success_text').html(msg);
	   		setTimeout(function(){location.reload()},3000);
	  });
 
}

/**
 * Update a post draft
 */
function updateDraft() {
	
	var post_id			= $("#news_id").val();
		title			= $("#title").val();
		body			= CKEDITOR.instances['body'].getData();
		author			= $("#author").val();
		media			= $("#media").val();
		categories = [];
	    $('#category:checked').each(function(i){
	      categories[i] = $(this).val();
	    });
	    game = [];
	    $('#game:checked').each(function(i){
	      game[i] = $(this).val();
	    });

	    body = str_replace("&#39;", "\'", body);

	$.ajax({
	 type: "POST",
	 url: "lib/submit/submit-news.php",
	 async:true,
	 crossbrowser:true,
	 data: { form: 'update-draft', post_id: '' + post_id + '', title: '' + title + '', body: '' + body + '', author: '' + author + '', game: '' + game + '', categories: '' + categories + '', media: '' + media + '' }
	}).success(function( msg ) {
	   		$('.success').css("display", "");
	   		$(".success").fadeIn(1000, "linear");
	   		$('.success_text').fadeIn("slow");
	   		$('.success_text').html(msg);
	   		setTimeout(function(){window.location='news.php?page=view'},3000);
	});

}

/**
 * Publish a post from draft mode
 */
function publishPost() {
	
	var post_id			= $("#news_id").val();
		title			= $("#title").val();
		body			= CKEDITOR.instances['body'].getData();
		author			= $("#author").val();
		media			= $("#media").val();
		categories = [];
	    $('#category:checked').each(function(i){
	      categories[i] = $(this).val();
	    });
	    game = [];
	    $('#game:checked').each(function(i){
	      game[i] = $(this).val();
	    });
	
	    body = str_replace("&#39;", "\'", body);

	$.ajax({
	 type: "POST",
	 url: "lib/submit/submit-news.php",
	 async:true,
	 crossbrowser:true,
	 data: { form: 'publish-post', post_id: '' + post_id + '', title: '' + title + '', body: '' + body + '', author: '' + author + '', game: '' + game + '', categories: '' + categories + '', media: '' + media + '' }
	}).success(function( msg ) {
	   		$('.success').css("display", "");
	   		$(".success").fadeIn(1000, "linear");
	   		$('.success_text').fadeIn("slow");
	   		$('.success_text').html(msg);
	   		setTimeout(function(){window.location='news.php?page=view'},3000);
	});

}

/**
 * Unpublish a post
 * @param post_id
 */
function unpublishPost(post_id) {
	
	$.ajax({
		 type: "POST",
		 url: "lib/submit/submit-news.php",
		 async:true,
		 crossbrowser:true,
		 data: { form: 'unpublish-post', post_id: '' + post_id + '' }
		}).success(function( msg ) {
		   		$('.success').css("display", "");
		   		$(".success").fadeIn(1000, "linear");
		   		$('.success_text').fadeIn("slow");
		   		$('.success_text').html(msg);
		   		setTimeout(function(){window.location='news.php?page=view'},3000);
		});
	
}

/**
 * Add news category
 */
$('#addCategory').submit(function(e) {
	var category		= $("#category").val();
		
	 e.preventDefault();

 $.ajax({
     type: "POST",
     url: "lib/submit/submit-news.php",
     async:true,
     crossbrowser:true,
     data: { form: 'add-category', category: '' + category + '' }
   }).success(function( msg ) {
	   		$('.success').css("display", "");
	   		$(".success").fadeIn(1000, "linear");
	   		$('.success_text').fadeIn("slow");
	   		$('.success_text').html(msg);
	   		setTimeout(function(){location.reload()},3000);
  });
});

/**
 * Delete news category
 * @param cat_id
 */
function deleteCategory(cat_id) {
	
	 $(function() {
		 $( "#delete-category-confirm" ).dialog({
			 resizable: false,
			 height:200,
			 width:500,
			 modal: true,
			 buttons: {
				 "Delete Category": function() {
					 $.ajax({
					     type: "POST",
					     url: "lib/submit/submit-news.php",
					     data: { form: 'delete-category', cat_id: '' + cat_id + ''}
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
 * Get media item details for modal
 * @param media_id
 */
function getMedia(media_id) {
	
	$.ajax({
	     type: "POST",
	     async: false,
	     url: "get_media.php",
	     data: { id: '' + media_id + '' }
	   }).success(function( msg ) {
		   $('#viewMediaModal').html(msg);
	  });
	
}

/**
 * Open the media explorer modal
 */
function mediaExplorer() {

	$.ajax({
	     type: "POST",
	     async: false,
	     url: "get_media_explorer.php",
	   }).success(function( msg ) {
		   $('#mediaExplorerModal').html(msg);
	  });
	
}

/**
 * Set the media value for a news post
 * @param media_id
 */
function selectMedia(media_id, filename) {
	
	$('#media').val(media_id);
	$('.media-select').html('<img src="../media/' + filename + '" class="img-responsive" />');
	return;
	
}

/**
 * Permanently delete media file
 * @param media_id
 */
function deleteMedia(media_id) {
	
	 $(function() {
		 $( "#delete-media-confirm" ).dialog({
			 resizable: false,
			 height:175,
			 width:375,
			 modal: true,
			 buttons: {
				 "Delete Media": function() {
					 $.ajax({
					     type: "POST",
					     url: "lib/submit/submit-news.php",
					     data: { form: 'delete-media', media_id: '' + media_id + ''}
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