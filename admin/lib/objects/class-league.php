<?php 

class ezAdmin_League extends DB_Class {
	
	public function get_all_leagues() {
		
		$data = $this->fetch("SELECT " . $this->prefix . "games.slug, " . $this->prefix . "games.game AS ggame, " . $this->prefix . "leagues.game AS lgame, " . $this->prefix . "leagues.id AS lid,
								" . $this->prefix . "leagues.start_date, " . $this->prefix . "leagues.end_date, " . $this->prefix . "leagues.teams, " . $this->prefix . "leagues.league
								FROM `" . $this->prefix . "leagues`, `" . $this->prefix . "games`
								WHERE " . $this->prefix . "games.slug = " . $this->prefix . "leagues.game
								ORDER BY " . $this->prefix . "leagues.game DESC, " . $this->prefix . "leagues.id ASC
							");
		return $data;
		
	}
	
	public function get_current_season($league_id) {
		
		$league_id = $this->sanitize( $league_id );
		$season = array();
		$data = $this->fetch("SELECT * FROM `" . $this->prefix . "seasons` WHERE league_id = '$league_id' ORDER BY season DESC LIMIT 1");
		if( $data ) {
			$season = array(
							'id'		=> $data['0']['id'],
							'season'	=> $data['0']['season'],
							'start'		=> $data['0']['start'],
							'end'		=> $data['0']['end'],
							'register'	=> $data['0']['register_end']
							);
			return $season;
		} else {
			return false;
		}
		
	}
	
	public function get_past_seasons($league_id) {
		
		$league_id = $this->sanitize( $league_id );
		$seasons = array();
		$data = $this->fetch("SELECT * FROM `" . $this->prefix . "seasons` WHERE league_id = '$league_id' ORDER BY season DESC");
		if( $data ) {
			foreach( $data as $season ) {
				$season['id']			= $season['id'];
				$season['season']		= $season['season'];
				$season['start']		= $season['start'];
				$season['end']			= $season['end'];
				$season['register_end'] = $season['register_end'];
				array_push( $seasons, $season );
			}
			return $seasons;
		} else {
			return;
		}
		
	}
	
	public function create_season($league_id, $start, $end, $register_end) {

		$league_id  	= $this->sanitize( $league_id );
		$start			= $this->sanitize( $start );
			$start = date('Y-m-d', strtotime( $start ) );
		$end			= $this->sanitize( $end );
			$end = date('Y-m-d', strtotime( $end ) );
		$register_end 	= $this->sanitize( $register_end );
			$register_end = date('Y-m-d', strtotime( $register_end ) );

		$data = $this->fetch("SELECT season FROM `" . $this->prefix . "seasons` WHERE league_id = '$league_id' ORDER BY season DESC LIMIT 1");
		if( $data ) {
			$season = $data['0']['season'] + 1;
			$this->link->query("INSERT INTO `" . $this->prefix . "seasons` 
								SET league_id = '$league_id', season = '$season', start = '$start', end = '$end', 
									register_end = '$register_end'
							");
		} else {
			$this->link->query("INSERT INTO `" . $this->prefix . "seasons` 
								SET league_id = '$league_id', season = '1', start = '$start', end = '$end', 
									register_end = '$register_end'
							");
		}
		$this->success('New season has been created');
		return;
			
	}

	public function get_season($season_id) {

		$season_id 	= $this->sanitize( $season_id);
		$data = $this->fetch("SELECT * FROM `" . $this->prefix . "seasons` WHERE id = '$season_id'");
		if( $data ) {
			foreach( $data as $season ) {
				$season['id']			= $season['id'];
				$season['season']		= $season['season'];
				$season['start']		= $season['start'];
				$season['end']			= $season['end'];
				$season['registration'] = $season['register_end'];
			}
			return $season;
		} else {
			return false;
		}

	}

	public function edit_season($season_id, $start_date, $end_date, $register_date) {

		$season_id 		= $this->sanitize( $season_id );
		if( $start_date != '' ) { 
			$start_date 	= date( 'Y-m-d', $start_date );
			$this->link->query("UPDATE `" . $this->prefix . "seasons` SET start = '$start_date' WHERE id = '$season_id'");
		}
		if( $end_date != '' ) {
			$end_date 		= date( 'Y-m-d', $end_date );
			$this->link->query("UPDATE `" . $this->prefix . "seasons` SET end = '$end_date' WHERE id = '$season_id'");
		}
		if( $register_date != '' ) {
			$register_date 	= date( 'Y-m-d', $register_date );
			$this->link->query("UPDATE `" . $this->prefix . "seasons` SET register_end = '$register_date' WHERE id = '$season_id'");
		}
		$this->success('Season date details have been updated');
		return;

	}
	
	public function delete_season($season_id) {
		
		$season_id = $this->sanitize( $season_id );
		$this->link->query("DELETE FROM `" . $this->prefix . "seasons` WHERE id = '$season_id'");
		$this->success('Season has been deleted');
		return;
		
	}
	
	public function get_league($league_id) {
		
		$data = $this->fetch("SELECT * FROM `" . $this->prefix . "leagues` WHERE id = '$league_id'");
		$league = array(
				'id'		 => $data['0']['id'],
				'league'	 => $data['0']['league'],
				'teams'		 => $data['0']['teams'],
				'game'		 => $data['0']['game'],
				'status'	 => $data['0']['open'],
				'start_date' => date('Y-m-d', strtotime($data['0']['start_date'])),
				'end_date' 	 => date('Y-m-d', strtotime($data['0']['end_date'])),
				'games'		 => $data['0']['total_games'],
				'rosters'	 => $data['0']['rosters'],
				'max_roster' => $data['0']['max_roster'],
				'rules'		 => $data['0']['rules']
		);
		return $league;
		
	}
	
	public function create_league($league, $game, $max_teams, $total_games, $max_roster, $start_date, $end_date) {
		
		$league 		= $this->sanitize( $league );
		$game 			= $this->sanitize( $game );
		$max_teams		= $this->sanitize( $max_teams );
		$total_games	= $this->sanitize( $total_games );
		$start_date 	= $this->sanitize( $start_date );
		$end_date 		= $this->sanitize( $end_date );
		$start_date = date( 'Y-m-d', $start_date );
		$end_date = date( 'Y-m-d', $end_date );
		$result = $this->link->query("SELECT league FROM `" . $this->prefix . "leagues` WHERE (league = '$league') AND (game = '$game')");
		$count = $this->numRows($result);
		if( $count > 0 ) {
			$this->error('League Name already exists');
		} else {
			$league = $this->sanitize($league);
			$this->link->query("INSERT INTO `" . $this->prefix . "leagues` 
								SET league = '$league', game = '$game', teams = '$max_teams', total_games = '$total_games', max_roster = '$max_roster', start_date = '$start_date', end_date = '$end_date'
							");
	
			$this->success('' . $league . ' League added...reloading');
		}
		return;
		
	}
	
	public function edit_league($max_teams, $total_games, $league_id, $league, $max_roster, $start_date, $end_date) {
		
		$max_teams		= $this->sanitize( $max_teams );
		$total_games	= $this->sanitize( $total_games );
		$league_id		= $this->sanitize( $league_id );
		$start_date 	= $this->sanitize( $start_date );
		$end_date 		= $this->sanitize( $end_date );
		$start_date = date( 'Y-m-d', $start_date );
		$end_date = date( 'Y-m-d', $end_date );
		$this->link->query("UPDATE `" . $this->prefix . "leagues` 
							SET league = '$league', teams = '$max_teams', total_games = '$total_games', max_roster = '$max_roster', start_date = '$start_date', end_date = '$end_date' 
							WHERE id = '$league_id'
						");
		$this->success('League details updated');
		return;
		
	}
	
	public function delete_league($league_id) {
		
		$this->link->query("DELETE FROM `" . $this->prefix . "leagues` WHERE id = '$league_id'");
		$this->link->query("DELETE FROM `" . $this->prefix . "matches` WHERE id = '$league_id'");
		$teams = $this->get_league_teams( $league_id );
		foreach( $teams as $team ) {
			$leagues = $team['leagues'];
			$explode = explode( ',', $leagues );
			if(($key = array_search($league_id, $explode)) !== false) {
				unset($explode[$key]);
			}
			$updated = implode( ',', $explode );
			$this->link->query("UPDATE `" . $this->prefix . "guilds` SET leagues = '$updated' WHERE id = '$team[id]'");
		}
		$this->success('League has been deleted and teams updated');
		return;
		
	}
	
	public function get_rules($league_id) {
		
		$league_id	= $this->sanitize( $league_id );
		$data = $this->fetch("SELECT league, rules FROM `" . $this->prefix . "leagues` WHERE id = '$league_id'");
		if( $data ) { 
			$league = array(
					'league' => $data['0']['league'],
					'rules'  => $data['0']['rules']
			);
			return $league;
		}
		
	}
	
	public function edit_rules($league_id, $rules) {
		
		$league_id = $this->sanitize( $league_id );
		$rules 	   = $this->sanitize( $rules );
		$this->link->query("UPDATE `" . $this->prefix . "leagues` SET rules = '$rules' WHERE id = '$league_id'");
		$this->success('League Rules have been updated...reloading');
		
	}
	
	public function get_total_teams($league_id) {
		
		$result = $this->link->query("SELECT guild FROM `" . $this->prefix . "guilds` WHERE leagues LIKE '%,$league_id' OR leagues LIKE '$league_id,%' OR leagues LIKE '$league_id'");
		$count = $this->numRows($result);
		return $count;
		
	}
	
	public function get_league_teams($league_id) {
		
		$data = $this->fetch("SELECT * FROM `" . $this->prefix . "guilds` WHERE leagues LIKE '%,$league_id' OR leagues LIKE '$league_id,%' OR leagues LIKE '$league_id' OR leagues LIKE '%,$league_id,%'");
		return $data;
		
	}
	
	public function get_league_random_teams($league_id) {
	
		$data = $this->fetch("SELECT * FROM `" . $this->prefix . "guilds` WHERE leagues LIKE '%,$league_id' OR leagues LIKE '$league_id,%' OR leagues LIKE '$league_id' OR leagues LIKE '%,$league_id,%' ORDER BY RAND()");
		return $data;
	
	}
	
	public function add_map($map, $league_id) {
		
		$map	   = $this->sanitize( $map );
		$league_id = $this->sanitize( $league_id );
		$exist = $this->fetch("SELECT id FROM `" . $this->prefix . "maps` WHERE map = '$map' AND league = '$league_id'");
		if( $exist ) {
			$this->error('Map already exists'); 
		} else {
			$this->link->query("INSERT INTO `" . $this->prefix . "maps` SET map = '$map', league = '$league_id'");
			$this->success('Map has been added');
		}
		return;
		
	}
	
	public function set_map($league_id, $week, $map) {
		
		$league_id		= $this->sanitize( $league_id );
		$week			= $this->sanitize( $week );
		$map 			= $this->sanitize( $map );
		$exist = $this->fetch("SELECT id FROM `" . $this->prefix . "map_schedule` WHERE week = '$week' AND league = '$league_id'");
		if( $exist ) {
			$this->link->query("UPDATE `" . $this->prefix . "map_schedule` SET map = '$map' WHERE week = '$week' AND league = '$league_id'");
			$this->success('Week map has been updated');
		} else {
			$this->link->query("INSERT INTO `". $this->prefix . "map_schedule` SET map = '$map', week = '$week', league = '$league_id'");
			$this->success('Week map has been set');
		}
		return;
		
	}
	
	public function get_week_map($league_id, $week) {
		
		$league_id		= $this->sanitize( $league_id );
		$week			= $this->sanitize( $week );
		$data = $this->fetch("SELECT map FROM `" . $this->prefix . "map_schedule` WHERE week = '$week' AND league = '$league_id'");
		if( $data ) {
			$map = $data['0']['map'];
		} else {
			$map = '';
		}
		return $map;
		
	}
	
	public function get_league_maps($league_id) {
		
		$league_id		= $this->sanitize( $league_id );
		$map_schedule = array();
		$data = $this->fetch("SELECT * FROM `" . $this->prefix . "map_schedule` WHERE league = '$league_id'");
		if( $data ) {
			foreach ( $data as $maps ) {
				$map['week']	= $maps['week'];
				$map['map']		= $maps['map'];
				array_push( $map_schedule, $map );
			}
			return $map_schedule;
		}
		
	}
	
	public function get_maps($league_id) {
		
		$league_id	= $this->sanitize( $league_id );
		$league_maps = array();
		$data = $this->fetch("SELECT * FROM `" . $this->prefix . "maps` WHERE league = '$league_id'");
		if( $data ) {
			foreach( $data as $maps ) {
				$map['id']	= $maps['id'];
				$map['map'] = $maps['map'];
				array_push( $league_maps, $map );
			}
			return $league_maps;
		}
		
	}
	
	public function kick_team($league_id, $team_id, $reason) {
		
		$league_id 	= $this->sanitize( $league_id );
		$team_id 	= $this->sanitize( $team_id );

		$future_matches_data = $this->fetch("SELECT * FROM `" . $this->prefix . "matches`
												WHERE (homeTeamID = '$team_id' OR awayTeamID = '$team_id')
												AND (completed = '0')
										");

		if( $future_matches_data ) {
			foreach( $future_matches_data as $future_match ) {
				if( $future_match['homeTeamID'] == $team_id ) {
					$this->link->query("UPDATE `" . $this->prefix . "matches`
										SET winner = '$future_match[awayTeamID]', loser = '$team_id', completed = '1', 
											homeTeam_accept = '1', awayTeam_accept = '1', awayScore = '1', homeScore = '0',
											reporter = 'admin'
										WHERE id = '$future_match[id]'
									");
				} else {
					$this->link->query("UPDATE `" . $this->prefix . "matches`
										SET winner = '$future_match[homeTeamID]', loser = '$team_id', completed = '1', 
											homeTeam_accept = '1', awayTeam_accept = '1', homeScore = '1', awayScore = '0',
											reporter = 'admin'
										WHERE id = '$future_match[id]'
									");
				}
			}
		}

		$this->suspend_team( $league_id, $team_id );
		$this->success('Team has been kicked from League, and all future matches forfeited.');
		$team_admin_data = $this->fetch("SELECT " . $this->prefix . "users.`email`, " . $this->prefix . "guilds.`admin`, " . $this->prefix . "guilds.`id`, " . $this->prefix . "users.`username`, " . $this->prefix . "guilds.`guild`
											FROM `" . $this->prefix . "users`, `" . $this->prefix . "guilds` 
											WHERE `" . $this->prefix . "guilds`.id = '$team_id' AND `" . $this->prefix . "guilds`.admin = `" . $this->prefix . "users`.username");
		$admin_email = $team_admin_data['0']['email'];
		$team_name   = $team_admin_data['0']['guild'];

		$league_details = $this->get_league( $league_id );
		$league_name = $league_details['league'];
		
		$email_data = $this->fetch("SELECT site_name, site_email, site_url, mandrill_username, mandrill_password FROM `" . $this->prefix . "settings` WHERE id = '1'");

		$to 	 = $admin_email;
		$from    = $email_data['0']['site_email'];
		$site_name = $email_data['0']['site_name'];
		$site_url  = $email_data['0']['site_url'];
		$subject = 'Team has been suspended';


		$message = '<html><body>';
		$message .= '<h3>' . $site_name . '</h3>';
		$message .= '<p>Sorry, but your team [<em>' . $team_name . '</em>] has been suspended from the <em>' . $league_name . ' League</em> for the remainder of the season.</p><hr/>';
		$message .= '<p><strong>Reason:</strong><em> ' . $reason . '</em></p>';
		$message .= '<hr/><p>Please <a href="' . $site_url . '/contact-us.php">contact the site admins</a> to discuss your teams reinstatement into the league for next season.</p>';
		$message .= '<p>- ' . $site_name . ' Admins</p>';
		$message .= '<small>You are receiving this email because it is marked as the admin contact for a team participating in a ' . $site_name . ' League. If this is incorrect, please respond to this email.</small>';
		$message .= "</body></html>";

			require_once "Mail.php";
			$mandrill_username = $email_data['0']['mandrill_username'];
			$mandrill_password = $email_data['0']['mandrill_password']; 
			if( class_exists( 'Mail' ) && ( $mandrill_username != '' && $mandrill_password != '' ) ) { 
				$host = "smtp.mandrillapp.com"; 
				$username = $mandrill_username; 
				$password = $mandrill_password;
				$headers = array ('From' => $from,   'To' => $to, 'MIME-Version' => '1.0', 'Content-Type' => 'text/html; charset=ISO-8859-1', 'Subject' => $subject); 
				$smtp = Mail::factory(
								'smtp',   
								array (
									'host' => $host,     
									'auth' => true,
									'port' => 587,     
									'username' => $username,     
									'password' => $password
									)
								);  
				$mail = $smtp->send($to, $headers, $message);  
				if (PEAR::isError($mail)) {   
					echo("<p>" . $mail->getMessage() . "</p>");  
				} else {   
					echo("<p>Message successfully sent!</p>");  
				}
			} else {
				if( mail($to, $subject, $message, $headers) ) {
					$this->success('Thank you, your message has been sent');
				} else {
					$this->error('There was a problem sending your message, please try again');
				}
			}

		return;

	}
	
	public function lock_rosters($league_id) {
		
		$league_id 	= $this->sanitize( $league_id );
		$this->link->query("UPDATE `" . $this->prefix . "leagues` SET rosters = '0' WHERE id = '$league_id'");
		$this->success('Rosters have been locked');
		return;
		
	}

	public function unlock_rosters($league_id) {
		
		$league_id 	= $this->sanitize( $league_id );
		$this->link->query("UPDATE `" . $this->prefix . "leagues` SET rosters = '1' WHERE id = '$league_id'");
		$this->success('Rosters have been unlocked');
		return;
		
	}

	public function get_suspended_teams($league_id) {

		$league_id 	= $this->sanitize( $league_id );
		$data = $this->fetch("SELECT suspended FROM `" . $this->prefix . "leagues` WHERE id = '$league_id'");
		if( $data ) {
			$teams = (array) json_decode( $data['0']['suspended'], TRUE );
			return $teams;
		} else {
			return;
		}
	}

	public function suspend_team($league_id, $team_id) {

		$league_id	= $this->sanitize( $league_id );
		$team_id 	= $this->sanitize( $team_id );
		$suspended_teams = $this->get_suspended_teams( $league_id );
		array_push( $suspended_teams, $team_id );
		$updated_suspended = json_encode( $suspended_teams );
		$this->link->query("UPDATE `" . $this->prefix . "leagues` SET suspended = '$updated_suspended' WHERE id = '$league_id'");
		return;

	}

	public function unsuspend_team($league_id, $team_id) {

		$suspended_teams = $this->get_suspended_teams( $league_id );
		if(($key = array_search($team_id, $suspended_teams)) !== false) {
			unset($suspended_teams[$key]);
			$updated_suspended = json_encode( $suspended_teams );
			$this->link->query("UPDATE `" . $this->prefix . "leagues` SET suspended = '$updated_suspended' WHERE id = '$league_id'");
			$this->success('Team league suspension lifted');
		} else {
			echo 'no';
			return;
		}

	}

	/*
	 * Get team league list
	 *
	 * @return string
	 */
	public function get_team_league_list($team_id) {

		$team_id 	= $this->sanitize( $team_id );
		$data = $this->fetch("SELECT leagues FROM `" . $this->prefix . "guilds` WHERE id = '$team_id'");
		$current_leagues = '';
		if( $data['0']['leagues'] != '' ) {
			$current_leagues = $data['0']['leagues'];
		} else {
			$current_leagues = '';
		}
		return $current_leagues;

	}

	/*
	 * Register team for league
	 *
	 * @return string
	 */
	public function register_league_team($team_id, $league_id) {
		
		$team_id 	= $this->sanitize( $team_id );
		$league_id 	= $this->sanitize( $league_id );
		$current_leagues = $this->get_team_league_list( $team_id );
		$updated_leagues = '';
		if( ! empty( $current_leagues ) ) {
			$updated_leagues = $current_leagues . ',' . $league_id;
		} else {
			$updated_leagues = $league_id;
		}
		$this->link->query("UPDATE `" . $this->prefix . "guilds` SET leagues = '$updated_leagues' WHERE id = '$team_id'");
		return;

	}

	public function get_available_teams($league_id) {
		
		$data = $this->fetch("SELECT id, guild FROM `" . $this->prefix . "guilds` WHERE leagues NOT LIKE '%$league_id%'");
		return $data;
		
	}
		
}

?>