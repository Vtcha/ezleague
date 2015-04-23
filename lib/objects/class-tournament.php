<?php 

class ezLeague_Tournament extends DB_Class {

	public function get_all_tournaments() {
		
		$data = $this->fetch("SELECT " . $this->prefix . "games.slug, " . $this->prefix . "games.game AS ggame, " . $this->prefix . "tournaments.game AS lgame, " . $this->prefix . "tournaments.id AS tid,
								" . $this->prefix . "tournaments.start_date, " . $this->prefix . "tournaments.tournament, " . $this->prefix . "tournaments.public
								FROM `" . $this->prefix . "tournaments`, `" . $this->prefix . "games`
								WHERE " . $this->prefix . "games.slug = " . $this->prefix . "tournaments.game
								ORDER BY " . $this->prefix . "tournaments.game DESC, " . $this->prefix . "tournaments.id ASC
							");
		return $data;
		
	}

	public function get_open_tournaments() {
		
		$data = $this->fetch("SELECT " . $this->prefix . "games.slug, " . $this->prefix . "games.game AS ggame, " . $this->prefix . "tournaments.game AS lgame, " . $this->prefix . "tournaments.id AS tid,
								" . $this->prefix . "tournaments.start_date, " . $this->prefix . "tournaments.tournament, " . $this->prefix . "tournaments.max_teams, " . $this->prefix . "tournaments.public
								FROM `" . $this->prefix . "tournaments`, `" . $this->prefix . "games`
								WHERE (" . $this->prefix . "games.slug = " . $this->prefix . "tournaments.game) 
									AND (" . $this->prefix . "tournaments.status = '1')
								ORDER BY " . $this->prefix . "tournaments.game DESC, " . $this->prefix . "tournaments.id ASC
							");
		return $data;
		
	}

	/*
	 * Get tournaments that have no matches generated yet
	 *
	 * @return array
	 */
	public function get_open_public_tournaments() {
		
		$data = $this->fetch("SELECT 
								" . $this->prefix . "games.slug, 
								" . $this->prefix . "games.game AS ggame,
								" . $this->prefix . "games.short_name AS gameshort, 
								" . $this->prefix . "tournaments.game AS lgame, 
								" . $this->prefix . "tournaments.id AS tid,
								" . $this->prefix . "tournaments.start_date, " . $this->prefix . "tournaments.tournament, 
								" . $this->prefix . "tournaments.max_teams, 
								" . $this->prefix . "tournaments.format,
								" . $this->prefix . "tournaments.public,
								" . $this->prefix . "tournaments.registration_date
								FROM `" . $this->prefix . "tournaments`, `" . $this->prefix . "games`
								WHERE (" . $this->prefix . "games.slug = " . $this->prefix . "tournaments.game) 
									AND (" . $this->prefix . "tournaments.status = '1')
									AND (" . $this->prefix . "tournaments.public = '1')
								ORDER BY " . $this->prefix . "tournaments.game DESC, " . $this->prefix . "tournaments.id ASC
							");
		return $data;
		
	}

	/*
	 * Get tournaments with generated matches but the tournament has not completed
	 *
	 * @return array
	 */
	public function get_running_tournaments() {
		
		$data = $this->fetch("SELECT DISTINCT
								" . $this->prefix . "games.slug, 
								" . $this->prefix . "games.game AS ggame,
								" . $this->prefix . "games.short_name AS gameshort, 
								" . $this->prefix . "tournaments.game AS lgame, 
								" . $this->prefix . "tournaments.id AS tid,
								" . $this->prefix . "tournaments.start_date, " . $this->prefix . "tournaments.tournament, 
								" . $this->prefix . "tournaments.max_teams, 
								" . $this->prefix . "tournaments.format,
								" . $this->prefix . "tournaments.public,
								" . $this->prefix . "tournaments.registration_date,
								" . $this->prefix . "tournament_matches.tid AS matches_tid,
								" . $this->prefix . "tournament_matches.round
								FROM 
									`" . $this->prefix . "tournaments`, 
									`" . $this->prefix . "games`, 
									`" . $this->prefix . "tournament_matches`
								WHERE (" . $this->prefix . "games.slug = " . $this->prefix . "tournaments.game) 
									AND (" . $this->prefix . "tournaments.status = '1')
									AND (" . $this->prefix . "tournament_matches.tid = " . $this->prefix . "tournaments.id)
									AND (" . $this->prefix . "tournament_matches.round = '1')
								ORDER BY " . $this->prefix . "tournaments.game DESC, " . $this->prefix . "tournaments.id ASC
							");
		return $data;
		
	}

	public function get_private_tournaments() {
		
		$data = $this->fetch("SELECT 
								" . $this->prefix . "games.slug, 
								" . $this->prefix . "games.game AS ggame,
								" . $this->prefix . "games.short_name AS gameshort, 
								" . $this->prefix . "tournaments.game AS lgame, 
								" . $this->prefix . "tournaments.id AS tid,
								" . $this->prefix . "tournaments.start_date, " . $this->prefix . "tournaments.tournament, 
								" . $this->prefix . "tournaments.max_teams, 
								" . $this->prefix . "tournaments.format,
								" . $this->prefix . "tournaments.public								
								FROM `" . $this->prefix . "tournaments`, `" . $this->prefix . "games`
								WHERE (" . $this->prefix . "games.slug = " . $this->prefix . "tournaments.game) 
									AND (" . $this->prefix . "tournaments.status = '1')
									AND (" . $this->prefix . "tournaments.public = '0')
								ORDER BY " . $this->prefix . "tournaments.game DESC, " . $this->prefix . "tournaments.id ASC
							");
		return $data;
		
	}

	public function get_closed_tournaments() {
		
		$data = $this->fetch("SELECT 
								" . $this->prefix . "games.slug, 
								" . $this->prefix . "games.game AS ggame, 
								" . $this->prefix . "games.short_name AS gameshort, 
								" . $this->prefix . "tournaments.game AS lgame, 
								" . $this->prefix . "tournaments.id AS tid,
								" . $this->prefix . "tournaments.start_date, 
								" . $this->prefix . "tournaments.tournament,
								" . $this->prefix . "tournaments.format,
								" . $this->prefix . "tournaments.max_teams,
								" . $this->prefix . "tournaments.first_place,
								" . $this->prefix . "tournaments.second_place
								FROM `" . $this->prefix . "tournaments`, `" . $this->prefix . "games`
								WHERE (" . $this->prefix . "games.slug = " . $this->prefix . "tournaments.game) 
									AND (" . $this->prefix . "tournaments.status = '0')
								ORDER BY " . $this->prefix . "tournaments.game DESC, " . $this->prefix . "tournaments.id ASC
							");
		return $data;
		
	}

	public function get_tournament($tournament_id) {
		
		$data = $this->fetch("SELECT * FROM `" . $this->prefix . "tournaments` WHERE id = '$tournament_id'");
		$tournament = array(
				'id'		 	=> $data['0']['id'],
				'tournament' 	=> $data['0']['tournament'],
				'teams'		 	=> $data['0']['max_teams'],
				'game'		 	=> $data['0']['game'],
				'status'	 	=> $data['0']['status'],
				'start_date' 	=> date( 'Y-m-d', strtotime( $data['0']['start_date'] ) ),
				'registration' 	=> date( 'Y-m-d', strtotime( $data['0']['registration_date'] ) ),
				'format'	 	=> $data['0']['format'],
				'type' 		 	=> $data['0']['type'],
				'rules'		 	=> $data['0']['rules'],
				'public'		=> $data['0']['public']
		);
		return $tournament;
		
	}

	public function get_tournament_name($tournament_id) {

		$data = $this->fetch("SELECT tournament FROM `" . $this->prefix . "tournaments` WHERE id = '$tournament_id'");
		if( $data ) {
			echo $data[0]['tournament'];
			return;
		} else {
			return false;
		}

	}

	public function get_total_teams($tournament_id) {
		
		$data = $this->fetch("SELECT guild FROM `" . $this->prefix . "guilds` WHERE (tournaments LIKE '%,$tournament_id') OR (tournaments LIKE '$tournament_id,%') OR (tournaments LIKE '$tournament_id') OR (tournaments LIKE '%,$tournament_id,%')");
		if( $data ) {
			$count = count( $data );
		} else {
			$count = 0;
		}
		return $count;
		
	}

	/*
	 * Get the tournament winner
	 *
	 * @return string
	 */
	public function get_tournament_champion($tournament_id) {

		$champion = array();
		$data = $this->fetch("SELECT
								`" . $this->prefix . "tournaments`.first_place AS champion,
								`" . $this->prefix . "tournaments`.id AS tid,
								`" . $this->prefix . "guilds`.id AS guild_id,
								`" . $this->prefix . "guilds`.guild AS guild
							  FROM `" . $this->prefix . "guilds`, `" . $this->prefix . "tournaments`
							  WHERE `" . $this->prefix . "tournaments`.id = '$tournament_id'
							  	AND `" . $this->prefix . "tournaments`.first_place = `" . $this->prefix . "guilds`.id
							");
		if( $data ) {
			$champion['guild_id']	= $data[0]['guild_id'];
			$champion['guild'] 		= $data[0]['guild'];
			return $champion;
		} else {
			return false;
		}

	}

	/*
	 * Get the tournament runner up
	 *
	 * @return string
	 */
	public function get_tournament_runner_up($tournament_id) {

		$champion = array();
		$data = $this->fetch("SELECT
								`" . $this->prefix . "tournaments`.second_place AS runner_up,
								`" . $this->prefix . "tournaments`.id AS tid,
								`" . $this->prefix . "guilds`.id AS guild_id,
								`" . $this->prefix . "guilds`.guild AS guild
							  FROM `" . $this->prefix . "guilds`, `" . $this->prefix . "tournaments`
							  WHERE `" . $this->prefix . "tournaments`.id = '$tournament_id'
							  	AND `" . $this->prefix . "tournaments`.second_place = `" . $this->prefix . "guilds`.id
							");
		if( $data ) {
			$champion['guild_id']	= $data[0]['guild_id'];
			$champion['guild'] 		= $data[0]['guild'];
			return $champion;
		} else {
			return false;
		}

	}

	/*
	 * Get teams registered for a tournament
	 *
	 * @return array
	 */
	public function get_tournament_teams($tournament_id) {
		
		$data = $this->fetch("SELECT id, guild FROM `" . $this->prefix . "guilds` WHERE tournaments LIKE '%,$tournament_id' OR tournaments LIKE '$tournament_id,%' OR tournaments LIKE '$tournament_id' OR tournaments LIKE '%,$tournament_id,%'");
		return $data;
		
	}

	/*
	 * Get tournament matchups by round
	 *
	 * @return array
	 */
	public function get_tournament_matchups($tournament_id, $round) {

		$data = $this->fetch("SELECT * FROM `" . $this->prefix . "tournament_matches` WHERE tid = '$tournament_id' AND round = '$round'");
		if( $data ) {
			return $data;
		} else {
			return false;
		}

	}

	/*
	 * Get the details of a tournament match
	 *
	 * @return array
	 */
	public function get_tournament_match($match_id) {

		$match_id = $this->sanitize( $match_id );
		$matchup = array();
		$data = $this->fetch("SELECT * FROM `" . $this->prefix . "tournament_matches` WHERE id = '$match_id'");
		if( $data ) {
			$matchup['id']					= $data['0']['id'];
			$matchup['home_id']				= $data['0']['home_team_id'];
			$matchup['home']				= $data['0']['home_team'];
			$matchup['home_accept']			= $data['0']['home_accept'];
			$matchup['home_score']			= $data['0']['home_score'];
			$matchup['away_id']				= $data['0']['away_team_id'];
			$matchup['away']				= $data['0']['away_team'];
			$matchup['away_accept']			= $data['0']['away_accept'];
			$matchup['away_score']			= $data['0']['away_score'];
			$matchup['date']				= $data['0']['match_date'];
			$matchup['time']				= $data['0']['match_time'];
			$matchup['zone']				= $data['0']['match_zone'];
			$matchup['stream_url']			= $data['0']['stream_url'];
			$matchup['server_ip']			= $data['0']['server_ip'];
			$matchup['server_password'] 	= $data['0']['server_password'];
			$matchup['moderator']			= $data['0']['match_moderator'];
			$matchup['reporter']			= $data['0']['reporter'];
			$matchup['status']				= $data['0']['completed'];
			$matchup['chat']				= $data['0']['match_log'];
			if( $matchup['home_score'] > $matchup['away_score'] ) {
				$matchup['winner'] = $matchup['home_id'];
				$matchup['loser'] = $matchup['away_id'];
			} else {
				$matchup['winner'] = $matchup['away_id'];
				$matchup['loser'] = $matchup['home_id'];
			}
			return $matchup;
		} else {
			return false;
		}

	}

	/*
	 * Check if a team is in a tournament
	 * 
	 * @return boolean
	 */
	public function check_for_team($team_id, $tournament_id) {
		
		$team_id 		= $this->sanitize( $team_id );
		$tournament_id  = $this->sanitize( $tournament_id );
		$exist = false;
		$data = $this->fetch("SELECT tournaments FROM `" . $this->prefix . "guilds` WHERE id = '$team_id'");
		if( $data ) {
			$tournaments = explode( ',', $data['0']['tournaments'] );
			if( in_array( $tournament_id, $tournaments ) ) {
				return true;
			} else {
				return false;
			}
		}
		return;
		
	}

	/*
	 * Report a tournament match score
	 *
	 * @return string
	 */
	public function report_match($match_id, $home_score, $away_score, $reporter) {

		$match_id 	= $this->sanitize( $match_id );
		$home_score = $this->sanitize( $home_score );
		$away_score = $this->sanitize( $away_score );
		$reporter 	= $this->sanitize( $reporter );

		if( is_numeric( $home_score ) && is_numeric( $away_score ) ) {
			$this->link->query("UPDATE `" . $this->prefix . "tournament_matches` 
								SET home_score = '$home_score', away_score = '$away_score', reporter = '$reporter'
								WHERE id = '$match_id'
							   ");
			$this->success( 'Match Score updated' );
			return;
		} else {
			$this->error( 'Scores must be numeric' );
			return false;
		}

	}

	/*
	 * Update tournament match details
	 *
	 * @return string
	 */
	public function update_match_details($match_id, $date, $time, $zone, $stream_url) {

		$match_id 	= $this->sanitize( $match_id );
		$date 		= $this->sanitize( $date );
		$time 		= $this->sanitize( $time );
		$zone 		= $this->sanitize( $zone );
		$stream_url = $this->sanitize( $stream_url );

		$this->link->query("UPDATE `" . $this->prefix . "tournament_matches`
							SET match_date = '$date', match_time = '$time', match_zone = '$zone', stream_url = '$stream_url'
							WHERE id = '$match_id'
						  ");
		$this->success( 'Match Details have been updated' );
		return;

	}

	/*
	 * Update tournament match information
	 *
	 * @return string
	 */
	public function update_match_information($match_id, $ip, $password, $moderator) {

		$match_id 	= $this->sanitize( $match_id );
		$ip 		= $this->sanitize( $ip );
		$moderator  = $this->sanitize( $moderator );

		$this->link->query("UPDATE `" . $this->prefix . "tournament_matches`
							SET server_ip = '$ip', server_password = '$password', match_moderator = '$moderator'
							WHERE id = '$match_id'
						  ");
		$this->success( 'Match Information has been updated' );
		return;

	}

	/*
	 * Get team ids of a tournament match
	 * @return int
	 */
	public function get_match_teams($match_id) {

		$match_id = $this->sanitize( $match_id );
		$match = array();
		$data = $this->fetch("SELECT home_team_id, away_team_id FROM `" . $this->prefix . "tournament_matches` WHERE id = '$match_id'");
		if( $data ) {
			$match['home']	= $data['0']['home_team_id'];
			$match['away']	= $data['0']['away_team_id'];
			return $match;
		} else {
			return;
		}

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
	 * Update tournament match chat log
	 */
	public function update_chat_log($match_id, $username, $message) {
		
		$match_id	= $this->sanitize( $match_id );
		$username	= $this->sanitize( $username );
		$data = $this->fetch("SELECT match_log FROM `" . $this->prefix . "tournament_matches` WHERE id = '$match_id'");
		if( $data ) {
			$current_log = (array) json_decode( $data['0']['match_log'], TRUE );
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
		
		$this->link->query("UPDATE `" . $this->prefix . "tournament_matches` SET match_log = '$updated_chat' WHERE id = '$match_id'");
		$this->success('Message added to chat log');
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
		$match_data = $this->fetch("SELECT `" . $this->prefix . "tournament_matches`.home_team, 
											`" . $this->prefix . "tournament_matches`.away_team,
											`" . $this->prefix . "tournament_matches`.tid,
											`" . $this->prefix . "tournament_matches`.id AS match_id,
											`" . $this->prefix . "tournament_matches`.match_date,
											`" . $this->prefix . "tournament_matches`.match_time,
											`" . $this->prefix . "tournament_matches`.match_zone,
											`" . $this->prefix . "tournaments`.id AS tournament_id,
											`" . $this->prefix . "tournaments`.tournament
									FROM `" . $this->prefix . "tournament_matches`, `" . $this->prefix . "tournaments`
									WHERE `" . $this->prefix . "tournament_matches`.id = '$match_id'
									AND `" . $this->prefix . "tournaments`.id = `" . $this->prefix . "tournament_matches`.tid
								  ");

		$match_home_team 	= $match_data['0']['home_team'];
		$match_away_team 	= $match_data['0']['away_team'];
		$match_tid 			= $match_data['0']['tid'];
		$match_tournament 	= $match_data['0']['tournament'];
		$match_date 		= date( 'F d, Y', strtotime( $match_data['0']['match_date'] ) );
		$match_time 		= $match_data['0']['match_time'];
		$match_zone 		= $match_data['0']['match_zone'];


		$message = '<html><body>';
		$message .= '<table rules="all" style="border-color: #666;" cellpadding="10">';
		$message .= "<tr><td><strong>Matchup</strong> </td><td><em>" . $match_home_team . "<em> vs <em>" . $match_away_team . "</em></td></tr>";
		$message .= "<tr><td><strong>Tournament</strong> </td><td><em>" . $match_tournament . "</em></td></tr>";
		$message .= "<tr><td><strong>Match Date <br/> Match Time</strong> </td><td>" . $match_date . " @ " . $match_time . " <small>TIMEZONE <em>" . $match_zone . "</em></small></td></tr>";
		$message .= "<tr><td><strong>Match ID</strong> </td><td> <a href='" . $this->site_url . "/settings-guild.php?page=tournament_match&view=details&mid=" . $match_id . "'> #" . strip_tags($match) . "</a> (" . strip_tags($teams) . ")</td></tr>";
		$message .= "<tr><td><strong>Message:</strong> </td><td>" . strip_tags($body) . "</td></tr>";
		$message .= "<tr><td></td><td>Go to your <em>View Match Details</em> under <em>My Team > Tournaments > View Schedule</em> and view the Match Details update.</td></tr>";
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
	 * Toggle acceptance or rejection of tournament match details
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
		$this->link->query("UPDATE `" . $this->prefix . "tournament_matches` 
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
	 * Get the acceptance status of a match
	 */
	public function get_acceptance_status($match_id) {

		$match_id 	= $this->sanitize( $match_id );
		$status = array();
		$data = $this->fetch("SELECT home_accept, away_accept FROM `" . $this->prefix . "tournament_matches` WHERE id = '$match_id'");
		if( $data ) {
			$status['home'] = $data['0']['home_accept'];
			$status['away'] = $data['0']['away_accept'];
			return $status;
		} else {
			return;
		}

	}
}

?>