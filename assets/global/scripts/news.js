(function( $ ){

	var EZL_News = {

		/**
		 * Initialize basic theme JavaScript
		 */
		init: function() {

			this.cacheElements();
			this.addComment();

		},

		/**
		 * Cache elements to object-level variables
		 */
		cacheElements: function() {

			this.add_comment_form = $('#addComment');

		},
		
		/**
		 * Update user profile
		 */
		addComment: function() {

			this.add_comment_form.submit(function(e) {
				
				var author		= $("#author").val();
					author_id   = $("#author_id").val();
					post_id	    = $("#post_id").val();
					comment		= $("textarea#comment").val();
				 e.preventDefault();
				 
			 $.ajax({
			     type: "POST",
			     url: "lib/submit/submit-news.php",
			     data: { form: 'add-comment', post_id: '' + post_id + '', author: '' + author + '', author_id: '' + author_id + '', comment: '' + comment + ''}
			   }).success(function( msg ) {
						    $(".success").css("display", "");
					   		$(".success").fadeIn(1000, "linear");
					   		$(".success_text").fadeIn("slow");
					   		$(".success").html(msg);
					   		setTimeout(function(){location.reload()},3000);
			  });
			});
			
		}

	};

	/**
	 * Wait until the document is ready before initializing the js
	 */
	$(document).ready(function(){
		
		EZL_News.init();

	});

}( jQuery ) );