<?php 

class ezLeague_League extends DB_Class {
	
	/*
	 * Get league information
	 * 
	 * @return array
	 */
	public function get_league($league_id) {
		
		$league_id = $this->sanitize( $league_id );
		$league = array();
		$data = $this->fetch("SELECT * FROM `" . $this->prefix . "leagues` WHERE id = '$league_id'");
		$league = array(
						'id'		=> $data['0']['id'],
						'league'	=> $data['0']['league'],
						'status'	=> $data['0']['open'],
						'start'		=> $data['0']['start_date'],
						'end'		=> $data['0']['end_date'],
						'rules'		=> $data['0']['rules'],
						'rosters'	=> $data['0']['rosters'],
						'game'		=> $this->get_game_by_slug($data['0']['game']),
						'games'		=> $data['0']['total_games'],
						'teams'		=> $data['0']['teams']
						);
		return $league;
		
	}
	
	/*
	 * Get league game name
	 * 
	 * @return string
	 */
	public function get_game_by_slug($slug) {
		
		$data = $this->fetch("SELECT game FROM `" . $this->prefix . "games` WHERE slug = '$slug'");
		if( $data ) {
			return $data['0']['game'];
		} else {
			return;
		}
		
	}
	
	/*
	 * Check if a team is in a league
	 * 
	 * @return boolean
	 */
	public function check_for_team($team_id, $league_id) {
		
		$team_id 	= $this->sanitize( $team_id );
		$league_id  = $this->sanitize( $league_id );
		$exist = false;
		$data = $this->fetch("SELECT leagues FROM `" . $this->prefix . "guilds` WHERE id = '$team_id'");
		if( $data ) {
			$leagues = explode( ',', $data['0']['leagues'] );
			if( in_array( $league_id, $leagues ) ) {
				return true;
			} else {
				return false;
			}
		}
		return;
		
	}
	
	/*
	 * Get a league weeks map
	 * 
	 * @return string
	 */
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
	
	/*
	 * Get match details
	 * 
	 * @return array
	 */
	public function get_match_details($match_id) {
		
		$match_id	= $this->sanitize( $match_id );
		$match = array();
		$data = $this->fetch("SELECT * FROM `" . $this->prefix . "matches` WHERE id = '$match_id'");
		if( $data ) {
			$league_details = $this->get_league( $data['0']['league'] );
			$match['id']	 			= $data['0']['id'];
			$match['league_id'] 		= $data['0']['league'];
			$match['league']			= $league_details['league'];
			$match['home_team'] 		= $data['0']['homeTeam'];
			$match['home_id']			= $data['0']['homeTeamID'];
			$match['home_accept'] 		= $data['0']['homeTeam_accept'];
			$match['home_score']		= $data['0']['homeScore'];
			$match['away_team'] 		= $data['0']['awayTeam'];
			$match['away_id']			= $data['0']['awayTeamID'];
			$match['away_accept']		= $data['0']['awayTeam_accept'];
			$match['away_score']		= $data['0']['awayScore'];
			$match['season']			= $data['0']['season'];
			$match['week']				= $data['0']['week'];
			$match['map'] 				= $this->get_week_map( $match['league_id'], $match['week'] );
			$match['created']			= $data['0']['created'];
			$match['chat']				= $data['0']['chat_log'];
			$match['date']				= $data['0']['matchDate'];
			$match['time']				= $data['0']['matchTime'];
			$match['zone']				= $data['0']['matchZone'];
			$match['status']			= $data['0']['completed'];
			$match['featured']			= $data['0']['featured'];
			$match['reporter']			= $data['0']['reporter'];
			$match['stream_url']		= $data['0']['streamURL'];
			$match['server_ip']			= $data['0']['server_ip'];
			$match['server_password'] 	= $data['0']['server_password'];
			$match['moderator']			= $data['0']['match_moderator'];
			$match['predictions'] = $this->get_predictions( $match['home_id'], $match['away_id'], $match['id'] );
			return $match;
		}
		
	}
	
	/*
	 * Update match details
	 * 
	 * @return
	 */
	public function update_match_details($match_id, $date, $time, $zone, $stream_url) {
		
		$match_id		= $this->sanitize( $match_id );
		$date			= $this->sanitize( $date );
			$date = date('Y-m-d', strtotime( $date ) );
		$time			= $this->sanitize( $time );
		$zone			= $this->sanitize( $zone );
		$stream_url 	= $this->sanitize( $stream_url );
		$this->link->query("UPDATE `" . $this->prefix . "matches`
							SET matchDate = '$date', matchTime = '$time', matchZone = '$zone', streamURL = '$stream_url'
							WHERE id = '$match_id'
						");
		$this->success('Match details have been updated');
		return;
		
	}

	/*
	 * Update match information
	 *
	 * @return string
	 */
	public function update_match_information($match_id, $ip, $password, $moderator) {

		$match_id 	= $this->sanitize( $match_id );
		$ip 		= $this->sanitize( $ip );
		$password 	= $this->sanitize( $password );
		$moderator  = $this->sanitize( $moderator );
		$this->link->query("UPDATE `" . $this->prefix . "matches` SET server_ip = '$ip', server_password = '$password', match_moderator = '$moderator' WHERE id = '$match_id'");
		$this->success('Match information has been updated');
		return;

	}

	/*
	 * Get team rosters for a match
	 *
	 * @return array
	 */
	public function get_match_rosters($league_id, $home_team, $away_team) {

		$league_id 	= $this->sanitize( $league_id );
		$home_team  = $this->sanitize( $home_team );
		$away_team  = $this->sanitize( $away_team );
		$rosters = array();
		$home_data = $this->fetch("SELECT * FROM `" . $this->prefix . "rosters` WHERE league = '$league_id' AND team = '$home_team'");
		if( $home_data ) {
			$home_roster = (array) json_decode( $home_data['0']['roster'] );
			foreach( $home_roster as $home_user ) {
				$user_data = $this->fetch("SELECT username FROM `" . $this->prefix . "users` WHERE id = '$home_user'");
				$roster['username'] = $user_data['0']['username'];
				array_push( $rosters, $roster );
			}
		}

		$away_data = $this->fetch("SELECT * FROM `" . $this->prefix . "rosters` WHERE league = '$league_id' AND team = '$away_team'");
		if( $away_data ) {
			$away_roster = (array) json_decode( $away_data['0']['roster'] );
			foreach( $away_roster as $away_user ) {
				$user_data = $this->fetch("SELECT username FROM `" . $this->prefix . "users` WHERE id = '$away_user'");
				$roster['username'] = $user_data['0']['username'];
				array_push( $rosters, $roster );
			}
		}

		return $rosters;

	}

	/*
	 * Get the acceptance status of a match
	 */
	public function get_acceptance_status($match_id) {

		$match_id 	= $this->sanitize( $match_id );
		$status = array();
		$data = $this->fetch("SELECT homeTeam_accept, awayTeam_accept FROM `" . $this->prefix . "matches` WHERE id = '$match_id'");
		if( $data ) {
			$status['home'] = $data['0']['homeTeam_accept'];
			$status['away'] = $data['0']['awayTeam_accept'];
			return $status;
		} else {
			return;
		}

	}
	
	/*
	 * Toggle acceptance or rejection of match details
	 */
	public function toggle_match_details($match_id, $match_side, $update) {
		
		$match_id	= $this->sanitize( $match_id );
		$match_side = $this->sanitize( $match_side );
		$update		= $this->sanitize( $update );
			switch( $update ) {
				case 'accept':
					$update = '1';
					break;
				case 'reject':
					$update = '0';
					break;
				default:
					$update = '0';
				break;
			}
		$this->link->query("UPDATE `" . $this->prefix . "matches` 
							SET $match_side = '$update' 
							WHERE id = '$match_id'
						");
		$status = $this->get_acceptance_status( $match_id );
		$teams = $this->get_match_teams( $match_id );
		$home_team_admin = $this->get_team_admin( $teams['home'] );
		$away_team_admin = $this->get_team_admin( $teams['away'] );
		$teams = $home_team_admin['team'] . ' vs ' . $away_team_admin['team'];
		$emails = $away_team_admin['email'] . ',' . $home_team_admin['email'];
		if( $status['home'] == 1 && $status['away'] == 1 ) {
			$this->send_match_update_message( $emails, 'ezLeagueMatchUpdates@no-reply.com', '[ezleague] Match Details Updated', $match_id, $teams, 'Both Teams have Accepted the match details. Please notify your team of the match.');
		} else {
			$this->send_match_update_message( $emails, 'ezLeagueMatchUpdates@no-reply.com', '[ezleague] Match Details Updated', $match_id, $teams, 'Match Acceptance has been updated');
		}
		

		$this->success('Acceptance status has been updated');
		return;
		
	}

	/*
	 * Trigger message send
	 *
	 * @return string
	 */
	public function send_match_update_message( $to, $from, $subject, $match_id, $teams, $message ) {

		$to 	 = $this->sanitize( $to );
		$from    = $this->sanitize( $from );
		$subject = $this->sanitize( $subject );
		$match 	 = $this->sanitize( $match_id );
		$body 	 = $message;

		$data = $this->fetch("SELECT mandrill_username, mandrill_password FROM `" . $this->prefix . "settings` WHERE id = '1'");

		$message = '<html><body>';
		$message .= '<table rules="all" style="border-color: #666;" cellpadding="10">';
		$message .= "<tr><td><strong>Match ID</strong> </td><td> <a href='" . $this->site_url . "/settings-guild.php?page=match&view=details&mid=106'> #" . strip_tags($match) . "</a> (" . strip_tags($teams) . ")</td></tr>";
		$message .= "<tr><td><strong>Message:</strong> </td><td>" . strip_tags($body) . "</td></tr>";
		$message .= "<tr><td></td><td>Go to your <em>View Match Details</em> under <em>My Team > Leagues > View Schedule</em> and view the Match Details update.</td></tr>";
		$message .= "</table>";
		$message .= "</body></html>";
		if( $data ) {
			require_once "Mail.php";
			$mandrill_username = $data['0']['mandrill_username'];
			$mandrill_password = $data['0']['mandrill_password']; 
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
					echo("<p>A Match Details Update email has been sent to team admins.</p>");  
				}
			} else {
				if( mail($to, $subject, $message, $headers) ) {
					$this->success('Thank you, your message has been sent');
				} else {
					$this->error('There was a problem sending your message, please try again');
				}
			}
		}
		return;

	}

	/*
	 * Get team admin email
	 * @return string
	 */
	public function get_team_admin($team_id) {

		$team_id 	= $this->sanitize( $team_id );
		$data = $this->fetch("SELECT " . $this->prefix . "users.username, " . $this->prefix . "users.email, 
									 " . $this->prefix . "guilds.admin, " . $this->prefix . "guilds.id,  " . $this->prefix . "guilds.guild 
							  FROM `" . $this->prefix . "users`, `" . $this->prefix . "guilds` 
							  WHERE (" . $this->prefix . "guilds.admin = " . $this->prefix . "users.username) AND " . $this->prefix . "guilds.id = '$team_id'
							");
		if( $data ) {
			$admin['username'] = $data['0']['username'];
			$admin['admin']	   = $data['0']['admin'];
			$admin['email']	   = $data['0']['email'];
			$admin['team_id']  = $data['0']['id'];
			$admin['team']	   = $data['0']['guild'];
			return $admin;
		} else {
			return;
		}

	}

	/*
	 * Get team ids of match
	 * @return int
	 */
	public function get_match_teams($match_id) {

		$match_id = $this->sanitize( $match_id );
		$match = array();
		$data = $this->fetch("SELECT homeTeamID, awayTeamID FROM `" . $this->prefix . "matches` WHERE id = '$match_id'");
		if( $data ) {
			$match['home']	= $data['0']['homeTeamID'];
			$match['away']	= $data['0']['awayTeamID'];
			return $match;
		} else {
			return;
		}

	}
	
	/*
	 * Update match chat log
	 */
	public function update_chat_log($match_id, $username, $message) {
		
		$match_id	= $this->sanitize( $match_id );
		$username	= $this->sanitize( $username );
		$data = $this->fetch("SELECT chat_log FROM `" . $this->prefix . "matches` WHERE id = '$match_id'");
		if( $data ) {
			$current_log = (array) json_decode( $data['0']['chat_log'], TRUE );
			$chat['username'] = $username;
			$chat['message']  = $message;
			$chat['date']	  = date( 'F d, Y h:ia', strtotime( 'now' ) );
			array_push( $current_log, $chat );
			$updated_chat = json_encode( $current_log );
			$updated_chat = $this->sanitize( $updated_chat );
		} else {
			$updated_chat = json_encode( $message );
			$updated_chat = $this->sanitize( $updated_chat );
		}

		$teams = $this->get_match_teams( $match_id );
		$home_team_admin = $this->get_team_admin( $teams['home'] );
		$away_team_admin = $this->get_team_admin( $teams['away'] );
		$teams = $home_team_admin['team'] . ' vs ' . $away_team_admin['team'];
		$emails = $away_team_admin['email'] . ',' . $home_team_admin['email'];

		$this->send_match_update_message( $emails, 'ezLeagueMatchUpdates@no-reply.com', '[ezleague] Match Details Updated', $match_id, $teams, 'A new message has been posted in the <em>Chat Log</em> regarding the match.');
		
		$this->link->query("UPDATE `" . $this->prefix . "matches` SET chat_log = '$updated_chat' WHERE id = '$match_id'");
		$this->success('Message added to chat log');
		return;
		
	}
	
	/*
	 * Report match score
	 * 
	 * @return string
	 */
	public function report_match($match_id, $home_score, $home_team, $away_score, $away_team, $reporter) {
		
		$match_id		= $this->sanitize( $match_id );
		$home_score		= $this->sanitize( $home_score );
		$away_score		= $this->sanitize( $away_score );
		$reporter		= $this->sanitize( $reporter );
		if( $home_score > $away_score ) {
			$winner = $home_team;
			$loser  = $away_team;
		} else {
			$winner = $away_team;
			$loser  = $home_team;
		}
		$this->link->query("UPDATE `" . $this->prefix . "matches` 
							SET homeScore = '$home_score', awayScore = '$away_score', winner = '$winner',
							loser = '$loser', completed = '1', reporter = '$reporter'
							WHERE id = '$match_id' 
						");
		$this->success('Match score reported');
		return;
		
	}
	
	/*
	 * Add match screenshot details
	 * 
	 * @return string
	 */
	public function add_match_screenshot($match_id, $uploader, $filename) {
		
		$match_id		= $this->sanitize( $match_id );
		$uploader		= $this->sanitize( $uploader );
		$filename		= $this->sanitize( $filename );
		$this->link->query("INSERT INTO `" . $this->prefix . "screenshots` 
							SET match_id = '$match_id', uploader = '$uploader', filename = '$filename'
						");
		return;
		
	}
	
	/*
	 * Get match screen shots
	 * 
	 * @return array
	 */
	public function get_match_screenshots($match_id) {
		
		$match_id 	= $this->sanitize( $match_id );
		$screens = array();
		$data = $this->fetch("SELECT * FROM `" . $this->prefix . "screenshots` WHERE match_id = '$match_id'");
		if( $data ) {
			foreach( $data as $screenshot ) {
				$screen['id']		= $screenshot['id'];
				$screen['match_id'] = $screenshot['match_id'];
				$screen['uploader']	= $screenshot['uploader'];
				$screen['file']		= $screenshot['filename'];
				$screen['added']	= date('F d, Y', strtotime( $screenshot['created'] ) );
				array_push( $screens, $screen );
			}
			return $screens;
		}
	}
	
	/*
	 * Delete match screenshot
	 * 
	 * @return
	 */
	public function delete_screenshot($screenshot_id) {
		
		$screenshot_id = $this->sanitize( $screenshot_id );
		$this->link->query("DELETE FROM `" . $this->prefix . "screenshots` WHERE id = '$screenshot_id'");
		$this->success('Screenshot has been deleted');
		return;
		
	}
	
	/*
	 * Submit match dispute
	 * 
	 * @return string
	 */
	public function dispute_match($match_id, $category, $dispute, $reporter) {
		
		$match_id		= $this->sanitize( $match_id );
		$category		= $this->sanitize( $category );
		$dispute		= $this->sanitize( $dispute );
		$reporter		= $this->sanitize( $reporter );
		$this->link->query("INSERT INTO `" . $this->prefix . "disputes` 
							SET match_id = '$match_id', category = '$category', description = '$dispute', filed_by = '$reporter'
						");
		$this->success('Match dispute submitted');
		return;
		
	}
	
	/*
	 * Get the current season of a league
	 * 
	 * @return array
	 */
	public function get_current_season($league_id) {
	
		$league_id = $this->sanitize( $league_id );
		$season = array();
		$data = $this->fetch("SELECT * FROM `" . $this->prefix . "seasons` WHERE league_id = '$league_id' ORDER BY season DESC LIMIT 1");
		if( $data ) {
			$season = array(
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
	
	/*
	 * Get all teams in a league
	 * 
	 * @return array
	 */
	public function get_league_teams($league_id) {
	
		$data = $this->fetch("SELECT * FROM `" . $this->prefix . "guilds` WHERE leagues LIKE '%,$league_id' OR leagues LIKE '$league_id,%' OR leagues LIKE '$league_id' OR leagues LIKE '%,$league_id,%'");
		return $data;
	
	}
	
	/*
	 * Get league standings
	 * 
	 * @return array
	 */
	public function get_standings($league_id) {
		
		$league_id	= $this->sanitize( $league_id );
		$teams = $this->get_league_teams( $league_id );
		$standings = array();
		$final_standings = array();
		foreach( $teams as $team ) {
			$details = array();
			$losses = 0;
			$wins   = 0;
			$team_matches = $this->fetch("SELECT * FROM `" . $this->prefix . "matches` WHERE (league = '$league_id') AND (winner = '$team[id]' OR loser = '$team[id]')");
			foreach( $team_matches as $match ) {
				if( $match['winner'] == $team['id'] ) {
					$wins++;
				} else {
					$losses++;
				}
			}
			$details['guild_id'] = $team['id'];
			$details['guild']    = $team['guild'];
			$details['wins']	 = $wins;
			$details['losses']   = $losses;
			array_push( $standings, $details );
		}
		foreach ( $standings as $key => $row ) {
		    $final_standings[$key]  = $row['wins']; 
		    // of course, replace 0 with whatever is the date field's index
		}
		
		array_multisort($final_standings, SORT_DESC, $standings);
		return $standings;
	}
	
	/*
	 * Get match results
	 * 
	 * @return array
	 */
	public function get_results($league_id, $week) {
		
		$league_id	= $this->sanitize( $league_id );
		$week		= $this->sanitize( $week );
		$match_results = array();
		if( is_numeric( $week ) ) {
			$data = $this->fetch("SELECT * FROM `" . $this->prefix . "matches` WHERE (league = '$league_id') AND (completed = '1') AND (week = '$week') ORDER BY week DESC");
		} else {
			$data = $this->fetch("SELECT * FROM `" . $this->prefix . "matches` WHERE (league = '$league_id') AND (completed = '1') ORDER BY week DESC");
		}
		foreach( $data as $result ) {
			$results['id'] 			= $result['id'];
			$results['league'] 		= $result['league'];
			$results['home']   		= $result['homeTeam'];
			$results['home_id'] 	= $result['homeTeamID'];
			$results['home_score']  = $result['homeScore'];
			$results['away']		= $result['awayTeam'];
			$results['away_id'] 	= $result['awayTeamID'];
			$results['away_score']  = $result['awayScore'];
			$results['winner']		= $result['winner'];
			$results['loser']		= $result['loser'];
			$results['match_date']	= date( 'F d, Y', strtotime( $result['matchDate'] ) );
			$results['week']		= $result['week'];
			$results['map']			= $this->get_week_map( $league_id, $results['week'] );
			array_push( $match_results, $results );
		}
		return $match_results;
		
	}
	
	/*
	 * Get details of a match result
	 * 
	 * @return array
	 */
	public function get_result($match_id) {
		
		$match_id	= $this->sanitize( $match_id );
		$results = array();
		$data = $this->fetch("SELECT * FROM `" . $this->prefix . "matches` WHERE (id = '$match_id') AND (completed = '1')");
		if( $data ) {
			$results['home']		= $data['0']['homeTeam'];
			$results['home_id'] 	= $data['0']['homeTeamID'];
			$results['home_score']  = $data['0']['homeScore'];
			$results['away']		= $data['0']['awayTeam'];
			$results['away_id']		= $data['0']['awayTeamID'];
			$results['away_score']	= $data['0']['awayScore'];
			$results['winner']		= $data['0']['winner'];
			$results['loser']		= $data['0']['loser'];
			$results['date']		= $data['0']['matchDate'];
			$results['time']		= $data['0']['matchTime'];
			$results['zone']		= $data['0']['matchZone'];
			$results['week']		= $data['0']['week'];
			$results['stream_url']  = $data['0']['streamURL'];
		}
		return $results;
		
	}
	
	/*
	 * Get screenshots of a match result
	 * 
	 * @return array
	 */
	public function get_screenshots($match_id) {
		
		$match_id	= $this->sanitize( $match_id );
		$screens = array();
		$data = $this->fetch("SELECT * FROM `" . $this->prefix . "screenshots` WHERE match_id = '$match_id'");
		if( $data ) {
			foreach( $data as $image ) {
				$screen['image'] = $image['filename'];
				array_push( $screens, $screen );
			}
			return $screens;
		}
		
	}
	
	/*
	 * Get rules of a league
	 * 
	 * @return string
	 */
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

	/*
	 * Get featured match
	 *
	 * @return array
	 */
	public function get_featured_match($week, $league_id) {

		$match = array();
		$week 		= $this->sanitize( $week );
		$league_id 	= $this->sanitize( $league_id );
		if( is_numeric( $week ) ) {
			$data = $this->fetch("SELECT `" . $this->prefix . "matches`.*, `" . $this->prefix . "map_schedule`.* 
									FROM `" . $this->prefix . "matches`, ezlmap_schedule 
									WHERE `" . $this->prefix . "matches`.`featured` = '1' AND `" . $this->prefix . "matches`.`week` = '$week' 
									AND `" . $this->prefix . "matches`.`week` = `" . $this->prefix . "map_schedule`.`week`
									AND `" . $this->prefix . "matches`.`league` = '$league_id'
								");

			if( $data ) {
				$match['id']		  = $data['0']['id'];
				$match['league_id']	  = $data['0']['league'];
				$match['home']		  = $data['0']['homeTeam'];
				$match['home_id']	  = $data['0']['homeTeamID'];
				$match['home_logo']   = $this->get_team_logo( $match['home_id'] );
				$match['away']		  = $data['0']['awayTeam'];
				$match['away_id']	  = $data['0']['awayTeamID'];
				$match['away_logo']   = $this->get_team_logo( $match['away_id'] );
				$match['season']	  = $data['0']['season'];
				$match['date']		  = $data['0']['matchDate'];
				$match['time']		  = $data['0']['matchTime'];
				$match['zone']		  = $data['0']['matchZone'];
				$match['map']		  = $data['0']['map'];
				$match['stream_url']  = $data['0']['streamURL'];
				$match['status'] 	  = $data['0']['completed'];
				$match['predictions'] = $this->get_predictions( $match['home_id'], $match['away_id'], $match['id'] );
				return $match;
			} else {
				return;
			}
		} else {
			$data = $this->fetch("SELECT `" . $this->prefix . "matches`.*, `" . $this->prefix . "map_schedule`.* 
									FROM `" . $this->prefix . "matches`, ezlmap_schedule 
									WHERE (`" . $this->prefix . "matches`.`featured` = '1') AND (`" . $this->prefix . "matches`.`league` = '$league_id' AND `" . $this->prefix . "map_schedule`.`week` = `" . $this->prefix . "matches`.`week`)
									ORDER BY RAND() LIMIT 1
								");
			if( $data ) {
				$match['id']		  = $data['0']['id'];
				$match['league_id']	  = $data['0']['league'];
				$match['home']		  = $data['0']['homeTeam'];
				$match['home_id']	  = $data['0']['homeTeamID'];
				$match['home_logo']   = $this->get_team_logo( $match['home_id'] );
				$match['away']		  = $data['0']['awayTeam'];
				$match['away_id']	  = $data['0']['awayTeamID'];
				$match['away_logo']   = $this->get_team_logo( $match['away_id'] );
				$match['season']	  = $data['0']['season'];
				$match['date']		  = $data['0']['matchDate'];
				$match['time']		  = $data['0']['matchTime'];
				$match['zone']		  = $data['0']['matchZone'];
				$match['map']		  = $data['0']['map'];
				$match['week'] 		  = $data['0']['week'];
				$match['stream_url']  = $data['0']['streamURL'];
				$match['status'] 	  = $data['0']['completed'];
				$match['predictions'] = $this->get_predictions( $match['home_id'], $match['away_id'], $match['id'] );
				return $match;
			} else {
				return;
			}
		}


	}

	/*
	 * Get a teams' logo
	 *
	 * @return string
	 */
	public function get_team_logo($team_id) {

		$team_id 	= $this->sanitize( $team_id );
		$data = $this->fetch("SELECT logo FROM `" . $this->prefix . "guilds` WHERE id = '$team_id'");
		if( $data ) {
			$logo = $data['0']['logo'];
			return $logo;
		} else {
			return;
		}

	}

	/*
	 * Save prediction vote
	 *
	 * @return string
	 */
	public function make_prediction($team_id, $match_id, $username) {

		$team_id 	= $this->sanitize( $team_id );
		$match_id 	= $this->sanitize( $match_id );
		$username 	= $this->sanitize( $username );
		$this->link->query("INSERT INTO `" . $this->prefix . "predictions` SET team = '$team_id', match_id = '$match_id', user = '$username'");
		$this->success('Your prediction has been submitted');
		return;

	}

	/*
	 * Check if a user has predicted a match
	 *
	 * @return string
	 */
	public function check_if_predicted($username, $match_id) {

		$username 	= $this->sanitize( $username );
		$match_id 	= $this->sanitize( $match_id );
		$data = $this->fetch("SELECT id FROM `" . $this->prefix . "predictions` WHERE match_id = '$match_id' AND user = '$username'");
		if( $data ) {
			return true;
		} else {
			return false;
		}

	}

	/*
	 * Get predictions for a match
	 *
	 * @return array
	 */
	public function get_predictions($home_team, $away_team, $match_id) {

		$home_team 	= $this->sanitize( $home_team );
		$away_team 	= $this->sanitize( $away_team );
		$match_id 	= $this->sanitize( $match_id );
		$prediction = array();
		$total_data = $this->fetch("SELECT * FROM `" . $this->prefix . "predictions` WHERE match_id = '$match_id'");
		$home_data  = $this->fetch("SELECT * FROM `" . $this->prefix . "predictions` WHERE team = '$home_team' AND match_id = '$match_id'");
		$away_data  = $this->fetch("SELECT * FROM `" . $this->prefix . "predictions` WHERE team = '$away_team' AND match_id = '$match_id'");
		
		$prediction['total'] 	= count( $total_data );
		$prediction['home'] 	= count( $home_data );
		if( $prediction['home'] != 0 ) {
			$home_percent	= ( $prediction['home'] / $prediction['total'] );
			$prediction['home_percent'] = sprintf("%.2f%%", $home_percent * 100);
		} else {
			$prediction['home_percent'] = 0;
		}
		$prediction['away'] 	= count( $away_data );
		if( $prediction['away'] != 0 ) {
			$away_percent	= ( $prediction['away'] / $prediction['total'] );
			$prediction['away_percent'] = sprintf("%.2f%%", $away_percent * 100);
		} else {
			$prediction['away_percent'] = 0;
		}
		return $prediction;

	}
	
}


?>