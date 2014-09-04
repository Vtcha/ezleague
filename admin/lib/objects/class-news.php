<?php 

class ezAdmin_News extends DB_Class {
	
	/*
	 * Add news post
	 * 
	 * @return string
	 */
	public function add_news($title, $body, $author, $categories, $game, $media) {
		
		$body		= $this->sanitize( $body );
		$title		= $this->sanitize( $title );
		$author 	= $this->sanitize( $author );
		$categories = $this->sanitize( $categories );
		$categories = strtolower( $categories );
		$game		= $this->sanitize( $game );
		$media		= $this->sanitize( $media );
		$this->link->query("INSERT INTO `" . $this->prefix . "news` 
							SET title = '$title', body = '$body', author = '$author',
							category = '$categories', game = '$game', media = '$media', published = '1'
						");
		$this->success('Post has been published...reloading');
		return;
		
	}

	/*
	 * Edit news post
	 * 
	 * @return string
	 */
	public function edit_news($post_id, $title, $body, $author, $categories, $game, $media) {
		
		$body		= $this->sanitize( $body );
		$title		= $this->sanitize( $title );
		$author 	= $this->sanitize( $author );
		$categories = $this->sanitize( $categories );
		$categories = strtolower( $categories );
		$game		= $this->sanitize( $game );
		$media		= $this->sanitize( $media );
		$post_id 	= $this->sanitize( $post_id );
		$this->link->query("UPDATE `" . $this->prefix . "news` 
							SET title = '$title', body = '$body', author = '$author',
							category = '$categories', game = '$game', media = '$media'
							WHERE id = '$post_id'
						");
		$this->success('Post has been edited...reloading');
		return;
		
	}
	
	/*
	 * Save news post as draft
	 * 
	 * @return string
	 */
	public function save_draft($title, $body, $author, $categories, $game, $media) {
	
		$body		= $this->sanitize( $body );
		$title		= $this->sanitize( $title );
		$author 	= $this->sanitize( $author );
		$categories = $this->sanitize( $categories );
		$categories = strtolower( $categories );
		$game		= $this->sanitize( $game );
		$media		= $this->sanitize( $media );
		$this->link->query("INSERT INTO `" . $this->prefix . "news`
							SET title = '$title', body = '$body', author = '$author',
							category = '$categories', game = '$game', media = '$media', published = '0'
						");
		$this->success('Post has been saved...reloading');
		return;
	
	}
	
	/*
	 * Update a draft post
	 * 
	 * @return string
	 */
	public function update_draft($post_id, $title, $body, $author, $categories, $game, $media) {
		
		$post_id	= $this->sanitize( $post_id );
		$body		= $this->sanitize( $body );
		$title		= $this->sanitize( $title );
		$author 	= $this->sanitize( $author );
		$categories = $this->sanitize( $categories );
		$categories = strtolower( $categories );
		$game		= $this->sanitize( $game );
		$media		= $this->sanitize( $media );
		$this->link->query("UPDATE `" . $this->prefix . "news`
							SET title = '$title', body = '$body', author = '$author',
							category = '$categories', game = '$game', media = '$media', published = '0'
							WHERE id = '$post_id'
						");
		$this->success('Post has been updated...reloading');
		return;
		
	}
	
	/*
	 * Publish a post from draft mode
	 * 
	 * @return string
	 */
	public function publish_post($post_id, $title, $body, $author, $categories, $game, $media) {
	
		$post_id	= $this->sanitize( $post_id );
		$body		= $this->sanitize( $body );
		$title		= $this->sanitize( $title );
		$author 	= $this->sanitize( $author );
		$categories = $this->sanitize( $categories );
		$categories = strtolower( $categories );
		$game		= $this->sanitize( $game );
		$media		= $this->sanitize( $media );
		$this->link->query("UPDATE `" . $this->prefix . "news`
							SET title = '$title', body = '$body', author = '$author',
							category = '$categories', game = '$game', media = '$media', published = '1'
							WHERE id = '$post_id'
						");
		$this->success('Post has been published...reloading');
		return;
	
	}
	
	/*
	 * Unpublish a post
	 * 
	 * @return string
	 */
	public function unpublish_post($post_id) {
		
		$post_id	= $this->sanitize( $post_id );
		$this->link->query("UPDATE `" . $this->prefix . "news` SET published = '0' WHERE id = '$post_id'");
		$this->success('Post has been unpublished');
		return;
		
	}
	
	/*
	 * Add news category
	 * 
	 * @return string
	 */
	public function add_category($category) {
		
		$category	= $this->sanitize( $category );
		$result = $this->fetch("SELECT category FROM `" . $this->prefix . "news_category` WHERE category = '$category'");
		$count = count( $result );
		if( $count > 0 ) {
			$this->error('Category already exists');
		} else {
			$this->link->query("INSERT INTO `" . $this->prefix . "news_category` SET category = '$category'");
			$this->success('' . $category . ' Category added...reloading');
		}
		return;
		
	}
	
	/*
	 * Permanently delete a news category
	 * 
	 * @return string
	 */
	public function delete_category($cat_id) {
		
		$cat_id		= $this->sanitize( $cat_id );
		$this->link->query("DELETE FROM `" . $this->prefix . "news_category` WHERE id = '$cat_id'");
		$this->success('Category has been deleted...reloading');
		return;
		
	}
	
	/*
	 * Get all news categories
	 * 
	 * @return array
	 */
	public function get_categories() {
		
		$categories = array();
		$data = $this->fetch("SELECT * FROM `" . $this->prefix . "news_category`");
		if( $data ) {
			foreach( $data as $category ) {
				$cat['id']		 = $category['id'];
				$cat['category'] = $category['category'];
				array_push( $categories, $cat );
			}
			return $categories;
		}
		
	}
	
	/*
	 * Get the list of authors
	 * 
	 * @return array
	 */
	public function get_authors() {
		
		$data = $this->fetch("SELECT * FROM `" . $this->prefix . "users` WHERE role = 'admin'");
		return $data;
		
	}
	
	/*
	 * Get all news
	 * 
	 * @return array
	 */
	public function get_news() {
		
		$all_news = array();
		$data = $this->fetch("SELECT * FROM `" . $this->prefix . "news` ORDER BY id DESC");
		if( $data ) {
			foreach( $data as $item ) {
				$news['id'] 		= $item['id'];
				$news['title']  	= $item['title'];
				$news['body']		= $item['body'];
				$news['author']		= $item['author'];
				$news['cat']		= explode( ',', $item['category'] );
				$news['date']		= $item['created'];
				$news['game']		= $item['game'];
				$news['published']  = $item['published'];
				array_push( $all_news, $news );
			}
			return $all_news;
		} else {
			return;
		}
		
	}
	
	/*
	 * Get an individual post
	 * 
	 * @return array
	 */
	public function get_post($post_id) {
		
		$news	= array();
		$post_id	= $this->sanitize( $post_id );
		$data = $this->fetch("SELECT * FROM `" . $this->prefix . "news` WHERE id = '$post_id'");
		if( $data ) {
			if( $data['0']['media'] != '' ) {
				$media_image = $this->get_media_upload( $data['0']['media'] );
			} else {
				$media_image = '';
			}
			$news['id']			= $data['0']['id'];
			$news['title']		= $data['0']['title'];
			$news['body']		= $data['0']['body'];
			$news['date']		= $data['0']['created'];
			$news['author'] 	= $data['0']['author'];
			$news['cat']		= $data['0']['category'];
			$news['published']  = $data['0']['published'];
			$news['game']		= $data['0']['game'];
			$news['media']		= $data['0']['media'];
			$news['media_image']= $media_image['file'];
			return $news;
		} else {
			return;
		}
		
	}
	
	/*
	 * Upload media for news posts
	 * 
	 * @return string
	 */
	public function upload_media($filename) {
		
		$filename	= $this->sanitize( $filename );
		$this->link->query("INSERT INTO `" . $this->prefix . "news_media` SET filename = '$filename'");
		return;
		
	}
	
	/*
	 * Get all media uploads
	 * 
	 * @return array
	 */
	public function get_media() {
		
		$all_media = array();
		$data = $this->fetch("SELECT * FROM `" . $this->prefix . "news_media` ORDER BY id");
		if( $data ) {
			foreach( $data as $item ) {
				$media['id']	= $item['id'];
				$media['file']  = $item['filename'];
				$media['date']  = $item['created'];
				array_push( $all_media, $media );
			}
			return $all_media;
		} else {
			return;
		}
		
	}
	
	/*
	 * Get individual media item
	 * 
	 * @return array
	 */
	public function get_media_upload($id) {
		
		$id	= $this->sanitize( $id );
		$data = $this->fetch("SELECT * FROM `" . $this->prefix . "news_media` WHERE id = '$id'");
		if( $data ) {
			$media['id']	= $data['0']['id'];
			$media['file']  = $data['0']['filename'];
			$media['date']  = $data['0']['created'];
			return $media;
		} else {
			return;
		}
		
	}
	
	/*
	 * Permanently delete media file
	 * 
	 * @return string
	 */
	public function delete_media($media_id) {
		
		$media_id	= $this->sanitize( $media_id );
		$data = $this->fetch("SELECT filename FROM `". $this->prefix . "news_media` WHERE id = '$media_id'");
		if( $data ) {
			$filename = $data['0']['filename'];
			unlink( '../../../media/' . $filename . '' );
			$this->link->query("DELETE FROM `" . $this->prefix . "news_media` WHERE id = '$media_id'");
			$this->success('Media file has been deleted');
		} 
		return;
		
	}
	
}

?>