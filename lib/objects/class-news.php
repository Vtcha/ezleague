<?php 

/*
 * ezLeague News Object
 */

class ezLeague_News extends DB_Class {
	
	/*
	 * Get all published posts
	 * 
	 * @return array
	 */
	public function get_news($position) {
		
		$position = $this->sanitize( $position );
		$all_news = array();
		$data = $this->fetch("SELECT * FROM `" . $this->prefix . "news` WHERE published = '1' ORDER BY created DESC LIMIT $position, 3");
		if( $data ) {
			foreach( $data as $item ) {
				if( $item['media'] != '' ) {
					$media = $this->get_post_media( $item['media'] );
				} else {
					$media = '';
				}
				$news = array(
						'id'			=> $item['id'],
						'title'			=> $item['title'],
						'body'			=> $item['body'],
						'author'		=> $item['author'],
						'categories'  	=> $item['category'],
						'media'		  	=> $media,
						'created'		=> $item['created']
				);
				array_push( $all_news, $news );
			}
			return $all_news;
		} else {
			return;
		}
		 
	}
	
	/*
	 * Get news post media filename
	 * 
	 * @return string
	 */
	public function get_post_media($media_id) {
		
		$media_id	= $this->sanitize( $media_id );
		$data = $this->fetch("SELECT filename FROM `" . $this->prefix . "news_media` WHERE id = '$media_id'");
		if( $data ) {
			$media = $data['0']['filename'];
			return $media;
		} else {
			return;
		}
		
	}
	
	/*
	 * Get a news post
	 * 
	 * @return array
	 */
	public function get_news_item($id) {
		
		$news = array();
		$data = $this->fetch("SELECT * FROM `" . $this->prefix . "news` WHERE id = '$id'");
		if( $data ) {
			if( $data['0']['media'] != '' ) {
				$media = $this->get_post_media( $data['0']['media'] );
			} else {
				$media = '';
			}
			$news = array(
							'id'			=> $data['0']['id'],
							'title'			=> $data['0']['title'],
							'body'			=> $data['0']['body'],
							'author'		=> $data['0']['author'],
							'categories'	=> $data['0']['category'],
							'media'			=> $media,
							'created'		=> $data['0']['created']
						 );
		}
		return $news;
		
	}
	
	/*
	 * Add news comment
	 * 
	 * @return string
	 */
	public function add_comment($author, $author_id, $comment, $post_id) {
		
		$author    = $this->sanitize( $author );
		$author_id = $this->sanitize( $author_id );
		$comment   = $this->sanitize( $comment );
		$post_id   = $this->sanitize( $post_id );
		
		$this->link->query("INSERT INTO `" . $this->prefix . "comments` SET post_id = '$post_id', author = '$author',
							author_id = '$author_id', comment = '$comment'
						");
		$this->success('Comment has been added');
		return;
		
	}
	
	/*
	 * Get a news posts comments
	 * 
	 * @return array
	 */
	public function get_news_comments($post_id) {
		
		$data = $this->fetch("SELECT * FROM `" . $this->prefix . "comments` WHERE post_id = '$post_id'");
		return $data;
		
	}
}

?>