<?php

class ezLeague_Frontend extends DB_Class {
	
	/*
	 * Get all listed games
	 * 
	 * @return array
	 */
	public function get_games() {
		
		$games = $this->fetch("SELECT * FROM `" . $this->prefix . "games`");
		return $games;
		
	}
	
	/*
	 * Get game data
	 *
	 * @return array
	 */
	public function get_game( $slug ) {
	
		$data = $this->fetch("SELECT * FROM `" . $this->prefix . "games` WHERE slug = '$slug'");
		$game = array(
						'id'	=> $data['0']['id'],
						'game'	=> $data['0']['game'],
						'short'	=> $data['0']['short_name'],
						'slug'	=> $data['0']['slug'],
						'logo'	=> $data['0']['logo']
					 );
		return $game;
	}
	
	/*
	 * Get game leagues
	 * 
	 * @return array
	 */
	public function get_game_leagues( $slug ) {
		
		$data = $this->fetch("SELECT * FROM `" . $this->prefix . "leagues` WHERE game = '$slug'");
		return $data;
		
	}
	
	/*
	 * Get league data
	 * 
	 * @return array
	 */
	public function get_league( $league_id ) {
		
		$data = $this->fetch("SELECT * FROM `" . $this->prefix . "leagues` WHERE id = '$league_id'");
		$league = array(
							'id'	=> $data['0']['id'],
							'league'	=> $data['0']['league'],
							'game'		=> $data['0']['game'],
							'teams'		=> $data['0']['teams'],
							'open'		=> $data['0']['open'],
							'start'		=> $data['0']['start_date'],
							'end'		=> $data['0']['end_date'],
							'games'		=> $data['0']['total_games'],
							'rules'		=> $data['0']['rules']
						);
		return $league;
		
	}
	
	/*
	 * Get the league name by id
	 * 
	 * @return string
	 */
	public function get_league_name($league_id) {
		
		$league_id	= $this->sanitize( $league_id );
		$data = $this->fetch("SELECT league FROM `" . $this->prefix . "leagues` WHERE id = '$league_id'");
		if( $data ) {
			return $data['0']['league'];
		}
		
	}
	
	/*
	 * Get league teams
	 */
	public function get_league_teams( $league_id ) {
		
		$data = $this->fetch("SELECT * FROM `" . $this->prefix . "guilds` WHERE leagues LIKE '$league_id' OR leagues LIKE '$league_id,%' OR leagues LIKE '%,$league_id'");
		return $data;
		
	}
	
	/*
	 * Get all footer link
	 * 
	 * @return array
	 */
	public function get_footer_links() {
		
		$links = $this->fetch("SELECT * FROM `" . $this->prefix . "links` ORDER BY id DESC LIMIT 3");
		return $links;
		
	}
	
	/*
	 * Get recent news posts
	 * @return array
	 */
	public function get_recent_news() {
		
		$news = $this->fetch("SELECT * FROM `" . $this->prefix . "news` WHERE published = '1' ORDER BY created DESC LIMIT 3");
		return $news;
		
	}
	
	/*
	 * Get recent forum topics
	 * 
	 * @return array
	 */
	public function get_recent_forum_topics() {
		
		$topics = $this->fetch("SELECT * FROM `" . $this->prefix . "forum_question` ORDER BY datetime DESC LIMIT 3");
		return $topics;
		
	}
	
	/*
	 * Get ticker messages
	 * 
	 * @return array
	 */
	public function get_ticker_messages() {
		
		$data = $this->fetch("SELECT * FROM `" . $this->prefix . "ticker` ORDER BY id");
		return $data;
		
	}
	
	/*
	 * Count total members for pagination
	 * 
	 * @return int
	 */
	public function count_members() {
		
		$data = $this->fetch("SELECT id FROM `" . $this->prefix . "users`");
		$count = count( $data );
		return $count;
		
	}
	
	/*
	 * Get all members
	 * 
	 * @return array
	 */
	public function get_members($position, $order_by, $order) {
		
		$members = array();
		$position = $this->sanitize( $position );
		$order_by = $this->sanitize( $order_by );
		$order	  = $this->sanitize( $order );
		
		$data = $this->fetch("SELECT id, username, email, guild, first_name, last_name, role 
								FROM `" . $this->prefix . "users`
								ORDER BY $order_by $order LIMIT $position, 15");
		foreach( $data as $member ) {
			if( $member['guild'] != '' ) {
				$member['guild_name'] = $this->get_guild_name( $member['guild'] );
			} else {
				$member['guild_name'] = '';
			}
			
			array_push($members, $member);
		}
		
		return $members;
		
	}
	
	/*
	 * Search member list
	 * 
	 * @return array
	 */
	public function members_search($search) {
		
		$search = $this->sanitize( $search );
		$members = array();
		$data = $this->fetch("SELECT id, username, email, guild, first_name, last_name, role
				FROM `" . $this->prefix . "users`
				WHERE username LIKE '%$search%'");

		foreach( $data as $member ) {
			if( $member['guild'] != '' ) {
				$member['guild_name'] = $this->get_guild_name( $member['guild'] );
			}
				
			array_push($members, $member);
		}
		return $members;
		
	}
	
	/*
	 * Get member guild name
	 * 
	 * @return string
	 */
	public function get_guild_name( $guild_id ) {
		
		$data = $this->fetch("SELECT guild FROM `" . $this->prefix . "guilds` WHERE id = '$guild_id'");
		$guild = $data['0']['guild'];
		return $guild;
	}
	
	/*
	 * Get recent matches for the sidebar
	 */
	public function get_recent_matches() {
		
		$recent_matches = array();
		$data = $this->fetch("SELECT id, homeTeam, homeTeamID, homeScore, awayTeam, awayTeamID, awayScore, matchDate, league, winner
								FROM `" . $this->prefix . "matches`
								WHERE completed = '1'
								ORDER BY matchDate DESC
								LIMIT 5
							");
		if( $data ) {
			foreach( $data as $matches ) {
				$match['id']			= $matches['id'];
				$match['home']			= $matches['homeTeam'];
				$match['home_id']		= $matches['homeTeamID'];
				$match['home_score'] 	= $matches['homeScore'];
				$match['away']			= $matches['awayTeam'];
				$match['away_id']		= $matches['awayTeamID'];
				$match['away_score']	= $matches['awayScore'];
				$match['date']			= $matches['matchDate'];
				$match['league_id']		= $matches['league'];
				$match['league']		= $this->get_league_name( $match['league_id'] );
				$match['winner']		= $matches['winner'];
				array_push( $recent_matches, $match );
			}
			return $recent_matches;
		}
		
	}

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
	 * Count total news posts
	 * 
	 * @return int
	 */
	public function count_posts() {
		
		$data = $this->fetch("SELECT id FROM `" . $this->prefix . "news`");
		$count = count( $data );
		return $count;
		
	}

	/*
	 * Get basic site settings
	 *
	 * @return array
	 */
	public function get_site_settings() {

		$settings = array();
		$data = $this->fetch("SELECT * FROM `" . $this->prefix . "settings` WHERE id = '1'
							");
		if( $data ) {
			$settings['logo'] 			= $data['0']['site_logo'];
			$settings['email']			= $data['0']['site_email'];
			$settings['about'] 			= $data['0']['site_about'];
			$settings['name']			= $data['0']['site_name'];
			$settings['count'] 			= $data['0']['twitter_count'];
			$settings['handle'] 		= $data['0']['twitter_handle'];
			$settings['api']			= $data['0']['twitter_api'];
			$settings['secret']  		= $data['0']['twitter_secret'];
			$settings['token']   		= $data['0']['twitter_token'];
			$settings['token_secret']	= $data['0']['twitter_token_secret'];
			return $settings;
		} else {
			return;
		}

	}
	
}