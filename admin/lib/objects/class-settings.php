<?php 

class ezAdmin_Settings extends DB_Class {
	
	/*
	 * Add a new game to the system
	 * 
	 * @return string
	 */
	public function add_game($game, $short_name, $slug) {
		
		$game		= $this->sanitize( $game );
		$short_name = $this->sanitize( $short_name );
		$slug		= $this->sanitize( $slug );
		$slug = str_replace( ' ', '-', $slug );
		$slug = strtolower( $slug );
		$data = $this->fetch("SELECT game FROM `" . $this->prefix . "games` WHERE (game = '$game') OR (slug = '$slug')");
		if( count( $data )  > 0) {
			$this->error('Game or slug already exists');
		} else {
			$this->link->query("INSERT INTO `" . $this->prefix . "games` SET game = '$game', slug = '$slug', short_name = '$short_name'");
			$this->success('Game has been added...reloading');
		}
		return;
		
	}
	
	/*
	 * Edit a games details
	 * 
	 * @return string
	 */
	public function edit_game( $game_id, $short_name ) {
		
		$game_id  = $this->sanitize( $game_id );
		$short 	  = $this->sanitize( $short_name );
			
		$this->link->query("UPDATE `" . $this->prefix . "games` 
							SET short_name = '$short' 
							WHERE id = '$game_id'
						");
		$this->success('Game has been updated...reloading');
		return;
		
	}
	
	/*
	 * Delete a game from the system
	 */
	public function delete_game($game_id) {
		
		$game_id	= $this->sanitize( $game_id );
		//get the game slug
		$data = $this->fetch("SELECT * FROM `" . $this->prefix . "games` WHERE id = '$game_id'");
		if( $data ) {
			$slug = $data['0']['slug'];
			$league_data = $this->fetch("SELECT * FROM `" . $this->prefix . "leagues` WHERE game = '$slug'");
			if( $league_data ) {
				foreach( $league_data as $league ) {
					$this->link->query("DELETE FROM `" . $this->prefix . "matches` WHERE league = '$league[id]'");
					$this->success('Corresponding matches have been deleted<br>');
				}
				$this->link->query("DELETE FROM `" . $this->prefix . "leagues` WHERE game = '$slug'");
				$this->success('Corresponding leagues have been deleted<br>');
			}
			$this->link->query("DELETE FROM `" . $this->prefix . "games` WHERE id = '$game_id'");
			$this->success('Game has been deleted...reloading');
		}
		return;
		
	}
	
	/*
	 * Delete admin account
	 * 
	 * @return string
	 */
	public function delete_admin($user_id) {
		
		$user_id	= $this->sanitize( $user_id );
		$this->link->query("DELETE FROM `" . $this->prefix . "users` WHERE id = '$user_id'");
		$this->success('Admin has been deleted');
		return;
		
	}
	
	/*
	 * Get all games in the system
	 * 
	 * @return array
	 */
	public function get_settings_game() {
		
		$data = $this->fetch("SELECT * FROM `" . $this->prefix . "games`");
		return $data;
		
	}
	
	/*
	 * Get the details for a game
	 * 
	 * @return array
	 */
	public function get_game($game_id) {
		
		$game_id	= $this->sanitize( $game_id );
		$game = array();
		$data = $this->fetch("SELECT * FROM `" . $this->prefix . "games` WHERE id = '$game_id'");
		if( $data ) {
			$game['id']		= $data['0']['id'];
			$game['game']	= $data['0']['game'];
			$game['short']	= $data['0']['short_name'];
			$game['slug']	= $data['0']['slug'];
			$game['logo']	= $data['0']['logo'];
			return $game;
		} else {
			return;
		}
		
	}

	/*
	 * Update game icon
	 *
	 * @return string
	 */
	public function update_game_icon($game_id, $file) {

		$game_id 	= $this->sanitize( $game_id );
		$file 		= $this->sanitize( $file );
		$this->link->query("UPDATE `" . $this->prefix . "games` SET logo = '$file' WHERE id = '$game_id'");

	}
	
	/*
	 * Create a new admin account
	 * 
	 * @return string
	 */
	public function create_admin($username, $password, $email) {
		
		$username	= $this->sanitize( $username );
		$password	= $this->sanitize( $password );
		$email		= $this->sanitize( $email );
		
		$strength = '5';
		$salt = strtr(base64_encode(mcrypt_create_iv(16, MCRYPT_DEV_URANDOM)), '+', '.');
		//blowfish algorithm
		$salt = sprintf("$2a$%02d$", $strength) . $salt;
		$hash = crypt($password, $salt);
		//check to make sure this username or email does not already exist
		$result = $this->link->query("SELECT * FROM `" . $this->prefix . "users` WHERE (username = '$username') OR (email = '$email')");
		$count = $this->numRows($result);
		if($count > 0) {
			$this->error('Username or E-Mail already exists');
		} else {
			$this->link->query("INSERT INTO `" . $this->prefix . "users` SET username = '$username', email = '$email', salt = '$salt',
					hash = '$hash', role = 'admin'
					");
			$this->success('Admin account has been created');
		}
		
	}
	
	/*
	 * Get admin accounts
	 * 
	 * @return array
	 */
	public function get_admins() {
		
		$admins = array();
		$data = $this->fetch("SELECT * FROM `" . $this->prefix . "users` WHERE role = 'admin'");
		if( $data ) {
			foreach( $data as $item ) {
				$admin['id']		= $item['id'];
				$admin['username']  = $item['username'];
				$admin['email']		= $item['email'];
				array_push( $admins, $admin );
			}
			return $admins;
		} else {
			return;
		}
		
	}
	
	/*
	 * Update site social network
	 * 
	 * @return string
	 */
	public function update_social_network($social_network, $value) {
		
		$social_network		= $this->sanitize( $social_network );
		$value				= $this->sanitize( $value );
		switch( $social_network ) {
			case 'facebook':
				$col = 'site_facebook';
				break;
			case 'twitter':
				$col = 'site_twitter_handle';
				break;
			case 'youtube':
				$col = 'site_youtube';
				break;
			case 'google':
				$col = 'site_google_plus';
				break;
			default:
				break;
		}
		$this->link->query("UPDATE `" . $this->prefix . "settings` SET $col = '$value'");
		$this->success('Social Network has been updated');
		return;
		
	}
	
	/*
	 * Update basic site setting
	 * 
	 * @return string
	 */
	public function update_site_settings($setting, $value) {
		
		$setting = $this->sanitize( $setting );
		$value  = $this->sanitize( $value );
		switch( $setting ) {
			case 'name':
				$setting = 'site_name';
				break;
			case 'url':
				$setting = 'site_url';
				break;
			case 'contact':
				$setting = 'site_email';
				break;
			case 'about':
				$setting = 'site_about';
				break;
			case 'logo':
				$setting = 'site_logo';
				break;
			case 'fav_icon':
				$setting = 'site_icon';
				break;
			default:
				break;
		}
		$this->link->query("UPDATE `" . $this->prefix . "settings` SET $setting = '$value'");
		$this->success('Setting has been updated...reloading');
		return;
		
	}
	
	/*
	 * Get basic site settings
	 * 
	 * @return array
	 */
	public function get_settings() {
		
		$settings = array();
		$data = $this->fetch("SELECT * FROM `" . $this->prefix . "settings` WHERE id = '1'");
		if( $data ) {
			$settings = array(
								'name'  	=> $data['0']['site_name'],
								'url' 		=> $data['0']['site_url'],
								'email' 	=> $data['0']['site_email'],
								'about' 	=> $data['0']['site_about'],
								'logo'  	=> $data['0']['site_logo'],
								'fav_icon'	=> $data['0']['site_icon']
							);
			return $settings;
		} else {
			return;
		}
		
	}

	/*
	 * Get social network information
	 *
	 * @return array
	 */
	public function get_social_networks() {
		
		$settings = array();
				$data = $this->fetch("SELECT * FROM `" . $this->prefix . "settings` WHERE id = '1'");
			 $settings = array(
			 		'facebook'  		=> $data['0']['site_facebook'],
		'twitter-handle' 	=> $data['0']['site_twitter_handle'],
		'twitter-app' 		=> $data['0']['site_twitter_app'],
		'google-plus'		=> $data['0']['site_google_plus'],
		'youtube'			=> $data['0']['site_youtube']
		);
		return $settings;
		
	}

	/*
	 * Get twitter app settings
	 *
	 * @return array
	 */
	public function get_twitter_app_settings() {

		$twitter = array();
		$data = $this->fetch("SELECT twitter_count, twitter_handle, twitter_api, twitter_secret, twitter_token, twitter_token_secret
							  FROM `" . $this->prefix . "settings` WHERE id = '1'
							");
		if( $data ) {
			$twitter['count'] 			= $data['0']['twitter_count'];
			$twitter['handle'] 			= $data['0']['twitter_handle'];
			$twitter['api']				= $data['0']['twitter_api'];
			$twitter['secret']  		= $data['0']['twitter_secret'];
			$twitter['token']   		= $data['0']['twitter_token'];
			$twitter['token_secret']	= $data['0']['twitter_token_secret'];
			return $twitter;
		} else {
			return;
		}

	}

	/*
	 * Update twitter app settings
	 *
	 * @return string
	 */
	public function update_twitter_app_settings($count, $handle, $api, $secret, $token, $token_secret) {

		$handle 	  = $this->sanitize( $handle );
		$api 		  = $this->sanitize( $api );
		$secret 	  = $this->sanitize( $secret );
		$token 		  = $this->sanitize( $token );
		$token_secret = $this->sanitize( $token_secret );
		$this->link->query("UPDATE `" . $this->prefix . "settings`
							SET twitter_count = '$count', twitter_handle = '$handle', twitter_api = '$api', twitter_secret = '$secret', twitter_token = '$token', twitter_token_secret = '$token_secret'
							WHERE id = '1'
						");
		$this->success('Twitter app settings have been updated');
		return;

	}
	
}

?>