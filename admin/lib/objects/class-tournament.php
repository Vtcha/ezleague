<?php 

class ezAdmin_Tournament extends DB_Class {

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

	public function get_closed_tournaments() {
		
		$data = $this->fetch("SELECT 
								" . $this->prefix . "games.slug, 
								" . $this->prefix . "games.game AS ggame, 
								" . $this->prefix . "tournaments.game AS lgame, 
								" . $this->prefix . "tournaments.id AS tid,
								" . $this->prefix . "tournaments.start_date, 
								" . $this->prefix . "tournaments.tournament,
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
	
	public function create_tournament($tournament, $game, $max_teams, $start_date, $registration, $format, $public) {
		
		$tournament 		= $this->sanitize( $tournament );
		$game 				= $this->sanitize( $game );
		$max_teams			= $this->sanitize( $max_teams );
		$start_date 		= $this->sanitize( $start_date );
		$registration 		= $this->sanitize( $registration );
		$start_date 		= date( 'Y-m-d', $start_date );
		$registration_date 	= date( 'Y-m-d', $registration );
		$format 			= $this->sanitize( $format );
		$result = $this->link->query("SELECT tournament FROM `" . $this->prefix . "tournaments` WHERE (tournament = '$tournament') AND (game = '$game')");
		$count = $this->numRows($result);
		if( $count > 0 ) {
			$this->error('Tournament Name already exists');
		} else {
			$tournament = $this->sanitize( $tournament );
			$this->link->query("INSERT INTO `" . $this->prefix . "tournaments` 
								SET tournament = '$tournament', game = '$game', max_teams = '$max_teams', 
									start_date = '$start_date', registration_date = '$registration_date', 
									format = '$format', public = '$public'
							");
	
			$this->success('' . $tournament . ' Tournament added...reloading');
		}
		return;
		
	}
	
	public function edit_tournament($max_teams, $tournament_id, $tournament, $format, $start_date, $registration) {
		
		$max_teams			= $this->sanitize( $max_teams );
		$format				= $this->sanitize( $format );
		$tournament_id		= $this->sanitize( $tournament_id );
		$start_date 		= $this->sanitize( $start_date );
		$registration 		= $this->sanitize( $registration );
		$start_date 		= date( 'Y-m-d', $start_date );
		$registration_date 	= date( 'Y-m-d', $registration );
		$this->link->query("UPDATE `" . $this->prefix . "tournaments` 
							SET tournament = '$tournament', max_teams = '$max_teams', format = '$format', start_date = '$start_date', registration_date = '$registration_date' 
							WHERE id = '$tournament_id'
						");
		$this->success( 'tournament details updated' );
		return;
		
	}
	
	public function delete_tournament($tournament_id) {
		
		$tournament_id = $this->sanitize( $tournament_id );
		$this->link->query("DELETE FROM `" . $this->prefix . "tournaments` WHERE id = '$tournament_id'");
		$this->link->query("DELETE FROM `" . $this->prefix . "tournament_matches` WHERE tid = '$tournament_id'");
		$teams = $this->get_tournament_teams( $tournament_id );
		foreach( $teams as $team ) {
			$tournaments = $team['tournaments'];
			$explode = explode( ',', $tournaments );
			if( ( $key = array_search( $tournament_id, $explode ) ) !== false ) {
				unset( $explode[$key] );
			}
			$updated = implode( ',', $explode );
			$this->link->query("UPDATE `" . $this->prefix . "guilds` SET tournaments = '$updated' WHERE id = '$team[id]'");
		}
		$this->success( 'Tournament has been deleted and teams updated' );
		return;
		
	}
	
	public function get_rules($tournament_id) {
		
		$tournament_id	= $this->sanitize( $tournament_id );
		$data = $this->fetch("SELECT tournament, rules FROM `" . $this->prefix . "tournaments` WHERE id = '$tournament_id'");
		if( $data ) { 
			$tournament = array(
					'tournament' => $data['0']['tournament'],
					'rules'  => $data['0']['rules']
			);
			return $tournament;
		}
		
	}
	
	public function edit_rules($tournament_id, $rules) {
		
		$tournament_id = $this->sanitize( $tournament_id );
		$rules 	   = $this->sanitize( $rules );
		$this->link->query("UPDATE `" . $this->prefix . "tournaments` SET rules = '$rules' WHERE id = '$tournament_id'");
		$this->success('tournament Rules have been updated...reloading');
		
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
	
	public function get_tournament_teams($tournament_id) {
		
		$data = $this->fetch("SELECT id, guild FROM `" . $this->prefix . "guilds` WHERE tournaments LIKE '%,$tournament_id' OR tournaments LIKE '$tournament_id,%' OR tournaments LIKE '$tournament_id' OR tournaments LIKE '%,$tournament_id,%'");
		return $data;
		
	}

	public function get_available_teams($tournament_id) {
		
		$data = $this->fetch("SELECT id, guild FROM `" . $this->prefix . "guilds` WHERE tournaments NOT LIKE '%$tournament_id%'");
		return $data;
		
	}

	public function kick_team($tournament_id, $team_id) {
		
		$tournament_id 	= $this->sanitize( $tournament_id );
		$team_id 		= $this->sanitize( $team_id );

		$this->quit_tournament( $tournament_id, $team_id );

		$this->success('Team has been kicked from Tournament.');
		return;
		$team_admin_data = $this->fetch("SELECT " . $this->prefix . "users.`email`, " . $this->prefix . "guilds.`admin`, " . $this->prefix . "guilds.`id`, " . $this->prefix . "users.`username`, " . $this->prefix . "guilds.`guild`
											FROM `" . $this->prefix . "users`, `" . $this->prefix . "guilds` 
											WHERE `" . $this->prefix . "guilds`.id = '$team_id' AND `" . $this->prefix . "guilds`.admin = `" . $this->prefix . "users`.username");
		$admin_email = $team_admin_data['0']['email'];
		$team_name   = $team_admin_data['0']['guild'];

		$tournament_details = $this->get_tournament( $tournament_id );
		$tournament_name = $tournament_details['tournament'];
		
		$email_data = $this->fetch("SELECT site_name, site_email, site_url, mandrill_username, mandrill_password FROM `" . $this->prefix . "settings` WHERE id = '1'");

		$to 	 = $admin_email;
		$from    = $email_data['0']['site_email'];
		$site_name = $email_data['0']['site_name'];
		$site_url  = $email_data['0']['site_url'];
		$subject = 'Tournament Team has been kicked';


		$message = '<html><body>';
		$message .= '<h3>' . $site_name . '</h3>';
		$message .= '<p>Sorry, but your team [<em>' . $team_name . '</em>] has been kicked from the <em>' . $tournament_name . ' Tournament</em> for the remainder of the tournament.</p><hr/>';
		$message .= '<p><strong>Reason:</strong><em> ' . $reason . '</em></p>';
		$message .= '<hr/><p>Please <a href="' . $site_url . '/contact-us.php">contact the site admins</a> to discuss the matter further.</p>';
		$message .= '<p>- ' . $site_name . ' Admins</p>';
		$message .= '<small>You are receiving this email because it is marked as the admin contact for a team participating in a ' . $site_name . ' Tournament. If this is incorrect, please respond to this email.</small>';
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

	/*
	 * Remove a team from a tournament
	 *
	 * @return string
	 */
	public function quit_tournament($tournament_id, $team_id) {

		$tournaments = $this->get_team_tournaments( $team_id );
		if( $tournaments ) {
			$tournaments = explode( ',', $tournaments );
			if(($key = array_search($tournament_id, $tournaments)) !== false) {
			    unset($tournaments[$key]);
			    $updated_tournaments = implode( ',', $tournaments );
			    $this->link->query("UPDATE `" . $this->prefix . "guilds` SET tournaments = '$updated_tournaments' WHERE id = '$team_id'");
			} else {
				$this->error('There was a problem removing this team from the tournament');
			}
		} else {
			echo 'fail';
			return;
		}

	}

	/*
	 * Get the list of tournaments a guild is participating in
	 *
	 * @return array
	 */
	public function get_team_tournaments($team_id) {

		$data = $this->fetch("SELECT tournaments FROM `" . $this->prefix . "guilds` WHERE id = '$team_id'");
		if( $data ) {
			$tournaments = $data['0']['tournaments'];
			return $tournaments;
		} else {
			return;
		}

	}

	/*
	 * Check if tournament bracket round 1 has been set
	 *
	 * @return boolean
	 */
	public function check_bracket($tournament_id) {

		$data = $this->fetch("SELECT round, tid FROM `" . $this->prefix . "tournament_matches` WHERE (tid = '$tournament_id') AND (round = '2')");
		if( $data ) {
			return true;
		} else {
			return false;
		}

	}

	/*
	 * Check if a tournament bracket has started
	 *
	 * @return boolean
	 */
	public function check_if_started($tournament_id) {
		$data = $this->fetch("SELECT round, completed, tid FROM `" . $this->prefix . "tournament_matches` WHERE (tid = '$tournament_id') AND (round = '1') AND (completed = '1')");
		if( $data ) {
			return true;
		} else {
			return false;
		}

	}

	/*
	 * Check if a tournament round exists
	 *
	 * @return boolean
	 */
	public function check_if_round_exists($tournament_id, $round) {

		$data = $this->fetch("SELECT round, completed, tid FROM `" . $this->prefix . "tournament_matches` WHERE (tid = '$tournament_id') AND (round = '$round')");
		if( $data ) {
			return true;
		} else {
			return false;
		}
		
	}

	/*
	 * Check if a tournament round has completed
	 *
	 * @return boolean
	 */
	public function check_if_round_completed($tournament_id, $round) {
		$data = $this->fetch("SELECT round, completed, tid FROM `" . $this->prefix . "tournament_matches` WHERE (tid = '$tournament_id') AND (round = '$round') AND (completed = '0')");
		if( $data ) {
			return false;
		} else {
			return true;
		}

	}

	/*
	 * Set tournament matchups
	 *
	 * @return boolean
	 */
	public function set_tournament_matchups($tournament_id, $home_team, $home_team_id, $away_team, $away_team_id, $round) {

		$this->link->query("INSERT INTO `" . $this->prefix . "tournament_matches`
							SET home_team = '$home_team', home_team_id = '$home_team_id', away_team = '$away_team', away_team_id = '$away_team_id', 
								tid = '$tournament_id', round = '$round'
						");
		return;

	}

	/*
	 * Clear tournament matchups, specifically for round 1
	 *
	 * @return boolean
	 */
	public function clear_tournament_matchups($tournament_id) {

		if( $this->link->query("DELETE FROM `" . $this->prefix . "tournament_matches` WHERE tid = '$tournament_id'") ) {
			return true;
		} else {
			return false;
		}

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
		$data = $this->fetch("SELECT * FROM `" . $this->prefix . "tournament_matches` WHERE id = '$match_id'");
		if( $data ) {
			return $data;
		} else {
			return false;
		}

	}

	/*
	 * Edit a tournament match details
	 *
	 * @return boolean
	 */
	public function edit_tournament_match($match_id, $home_id, $home_score, $home_accept, $away_id, $away_score, $away_accept, $match_status, $tournament_id, $max_teams, $round) {

		$match_id 	  	= $this->sanitize( $match_id );
		$home_score   	= $this->sanitize( $home_score );
		$away_score   	= $this->sanitize( $away_score );
		$home_accept  	= $this->sanitize( $home_accept );
		$away_accept  	= $this->sanitize( $away_accept );
		$match_status 	= $this->sanitize( $match_status );
		$winner 		= '';
		$loser 			= '';

		if( is_numeric( $match_id ) && 
			is_numeric( $home_score ) && 
			is_numeric( $away_score ) && 
			is_numeric( $match_status )
		) {
			if( $home_score > $away_score ) {
				$winner = $home_id;
				$loser  = $away_id;
			} else {
				$winner = $away_id;
				$loser  = $home_id;
			}
			$this->link->query("UPDATE `" . $this->prefix . "tournament_matches` 
								SET home_score = '$home_score', away_score = '$away_score', 
									home_accept = '$home_accept', away_accept = '$away_accept',
									winner = '$winner', loser = '$loser',
									completed = '$match_status'
								WHERE id = '$match_id'
							");
			
			switch( $max_teams ) {
				case 4:
					if( $round == 2 ) {
						$this->link->query("UPDATE `" . $this->prefix . "tournaments` SET first_place = '$winner', second_place = '$loser', status = '0' WHERE id = '$tournament_id'");
					}
					break;
				case 8:
					if( $round == 3 ) {
						$this->link->query("UPDATE `" . $this->prefix . "tournaments` SET first_place = '$winner', second_place = '$loser', status = '0' WHERE id = '$tournament_id'");
					}
					break;
				case 16:
					if( $round == 4 ) {
						$this->link->query("UPDATE `" . $this->prefix . "tournaments` SET first_place = '$winner', second_place = '$loser', status = '0' WHERE id = '$tournament_id'");
					}
					break;
				case 32:
					if( $round == 5 ) {
						$this->link->query("UPDATE `" . $this->prefix . "tournaments` SET first_place = '$winner', second_place = '$loser', status = '0' WHERE id = '$tournament_id'");
					}
					break;
				default:
					break;
			}
			return $this->success( 'Match Details have been updated' );
		} else {
			return $this->error( 'All values must be numeric' );
		}

	}

	/*
	 * Get the winners from a given tournament round
	 *
	 * @return array
	 */
	public function get_round_winners($tournament_id, $round) {

		$data = $this->fetch("SELECT 
									`" . $this->prefix . "tournament_matches`.id AS match_id, 
									`" . $this->prefix . "tournament_matches`.tid AS tournament_id, 
									`" . $this->prefix . "tournament_matches`.winner AS winner, 
									`" . $this->prefix . "guilds`.guild AS guild, 
									`" . $this->prefix . "guilds`.id AS guild_id 
							  FROM `" . $this->prefix . "tournament_matches`, `" . $this->prefix . "guilds` 
							  WHERE (`" . $this->prefix . "tournament_matches`.winner = `" . $this->prefix . "guilds`.id) 
							  	AND (`" . $this->prefix . "tournament_matches`.tid = '$tournament_id')
							  	AND (`" . $this->prefix . "tournament_matches`.round = '$round')
							  ORDER BY `" . $this->prefix . "tournament_matches`.id ASC
							");
		if( $data ) {
			return $data;
		} else {
			return false;
		}

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
	 * Get team tournament list
	 *
	 * @return string
	 */
	public function get_team_tournament_list($team_id) {

		$team_id 	= $this->sanitize( $team_id );
		$data = $this->fetch("SELECT tournaments FROM `" . $this->prefix . "guilds` WHERE id = '$team_id'");
		$current_tournaments = '';
		if( $data['0']['tournaments'] != '' ) {
			$current_tournaments = $data['0']['tournaments'];
		} else {
			$current_tournaments = '';
		}
		return $current_tournaments;

	}

	/*
	 * Register team for tournament
	 *
	 * @return string
	 */
	public function register_tournament_team($team_id, $tournament_id) {
		
		$team_id 	= $this->sanitize( $team_id );
		$tournament_id 	= $this->sanitize( $tournament_id );
		$current_tournaments = $this->get_team_tournament_list( $team_id );
		$updated_tournaments = '';
		if( ! empty( $current_tournaments ) ) {
			$updated_tournaments = $current_tournaments . ',' . $tournament_id;
		} else {
			$updated_tournaments = $tournament_id;
		}
		$this->link->query("UPDATE `" . $this->prefix . "guilds` SET tournaments = '$updated_tournaments' WHERE id = '$team_id'");
		return;

	}

}

?>