<?php 

class ezLeague_Team extends DB_Class {
	
	/*
	 * Create a new team
	 * 
	 * @return string (success or error)
	 */
	public function create_team($name, $abbr, $website, $password, $admin) {
		
		$name 	  = $this->sanitize( $name );
		$abbr 	  = $this->sanitize( $abbr );
		$website  = $this->sanitize( $website );
		$password = $this->sanitize( $password );
		$admin    = $this->sanitize( $admin );
		$md5	  = md5( $password );
		
		$exist = $this->link->query("SELECT guild FROM `" . $this->prefix . "guilds` WHERE guild = '$name'");
		$count = $this->numRows( $exist );
		 if( $count == 0 ) {
		 	$this->link->query("INSERT INTO `" . $this->prefix . "guilds` SET guild = '$name', abbreviation = '$abbr',
		 						website = '$website', password = '$md5', admin = '$admin'
		 					");
		 	$last = $this->fetch("SELECT id FROM `" . $this->prefix . "guilds` ORDER BY id DESC LIMIT 1");
		 	$last_id = $last['0']['id'];
		 	$this->link->query("UPDATE `" . $this->prefix . "users` SET guild = '$last_id' WHERE username = '$admin'");
		 	$_SESSION['ez_guild'] = $last_id;
		 	$this->success('Team has been created');
		 	return;
		 } else {
		 	$this->error('Team Name already exists');
		 	return;
		 }
		
	}
	
	/*
	 * Get a teams profile
	 * 
	 * @return array
	 */
	public function get_team($team_id) {
		
		$data = $this->fetch("SELECT * FROM `" . $this->prefix . "guilds` WHERE id = '$team_id'");
		$team = array(
						'id'		=> $data['0']['id'],
						'team'		=> $data['0']['guild'],
						'abbrev'	=> $data['0']['abbreviation'],
						'leader'	=> $data['0']['gm'],
						'coleader'	=> $data['0']['agm'],
						'website'	=> $data['0']['website'],
						'admin'		=> $data['0']['admin'],
						'leagues'	=> $data['0']['leagues'],
						'logo'		=> $data['0']['logo'],
						'password'	=> $data['0']['password']
					);
		return $team;
		
	}

	/*
	 * Get a teams name
	 * 
	 * @return array
	 */
	public function get_team_name($team_id) {
		
		$data = $this->fetch("SELECT guild, id FROM `" . $this->prefix . "guilds` WHERE id = '$team_id'");
		$team = array(
						'id'		=> $data['0']['id'],
						'team'		=> $data['0']['guild'],
					);
		return $team;
		
	}
	
	/*
	 * Get all team members
	 * 
	 * @return array
	 */
	public function get_team_members($team_id) {
		
		$data = $this->fetch("SELECT * FROM `" . $this->prefix . "users` WHERE guild = '$team_id'");
		return $data;
		
	}
	
	/*
	 * Count total team members
	 * 
	 * @return int
	 */
	public function count_team_members($team_id) {
	
		$data = $this->fetch("SELECT * FROM `" . $this->prefix . "users` WHERE guild = '$team_id'");
		if( $data ) {
			$total = count( $data );
			return $total;
		} else { 
			return;
		}
	
	}
	
	/*
	 * Update team settings
	 * 
	 * @return string (success or error)
	 */
	public function update_team_settings($admin, $leader, $coleader, $website, $team_id) {
		
		$admin 	  = $this->sanitize( $admin );
		$leader   = $this->sanitize( $leader );
		$coleader = $this->sanitize( $coleader );
		$website  = $this->sanitize( $website );
		
		$this->link->query("UPDATE `" . $this->prefix . "guilds` SET admin = '$admin', gm = '$leader', agm = '$coleader',
							website = '$website' WHERE id = '$team_id'
						");
		$this->success('Team settings updated');
		return;
		
	}
	
	/*
	 * Update team join password
	 * 
	 * @return string (success or error)
	 */
	public function update_team_password($password, $team_id) {
		
		$md5 = md5( $password );
		if( $this->link->query("UPDATE `" . $this->prefix . "guilds` SET password = '$md5' WHERE id = '$team_id'") ) {
			$this->success('Team password updated');
		} else {
			$this->error('Team password not successfully updated');
		}
		return;
		
	}
	
	/*
	 * Get the full team roster
	 * 
	 * @return array
	 */
	public function get_full_roster($team_id) {
		
		$team_id	= $this->sanitize( $team_id );
		$roster = array();
		$data = $this->fetch("SELECT id, username FROM `" . $this->prefix . "users` WHERE guild = '$team_id'");
		foreach( $data as $member ) {
			$user['id']		  = $member['id'];
			$user['username'] = $member['username'];
			array_push( $roster, $user );
		}
		return $roster;
		
	}
	
	/*
	 * Get team roster for a league
	 * 
	 * @return array
	 */
	public function get_league_roster($league_id, $team_id) {
		
		$league_id	= $this->sanitize( $league_id );
		$team_id	= $this->sanitize( $team_id );
		$roster = array();
		$data = $this->fetch("SELECT * FROM `" . $this->prefix . "rosters` 
								WHERE league = '$league_id' AND team = '$team_id'
							");
		if( $data ) {
			$members = (array) json_decode( $data['0']['roster'], TRUE );
			foreach( $members as $member ) {
				$details = $this->get_team_member( $member );
				array_push( $roster, $details );
			}
			return $roster;
		}
		
	}
	
	/*
	 * Get team roster ids
	 * 
	 * @return string
	 */
	public function get_league_roster_ids($league_id, $team_id) {
		
		$league_id	= $this->sanitize( $league_id );
		$team_id	= $this->sanitize( $team_id );
		$data = $this->fetch("SELECT * FROM `" . $this->prefix . "rosters`
								WHERE league = '$league_id' AND team = '$team_id'
							");
		if( $data ) {
			$roster = (array) json_decode( $data['0']['roster'], TRUE );
			return $roster;
		} else {
			return;
		}
		
	}
	
	/*
	 * Get roster id for a teams league
	 * 
	 * @return int
	 */
	public function get_roster_id($team_id, $league_id) {
		
		$team_id	= $this->sanitize( $team_id );
		$league_id	= $this->sanitize( $league_id );
		$data = $this->fetch("SELECT id FROM `" . $this->prefix . "rosters` WHERE team = '$team_id' AND league = '$league_id'");
		if( $data ) {
			$roster_id = $data['0']['id'];
			return $roster_id;
		} else {
			return;
		}
		
	}
	
	/*
	 * Add a team member to a league roster
	 * 
	 * @return string
	 */
	public function add_league_member($league_id, $team_id, $roster_id, $user_id) {
		
		$league_id	= $this->sanitize( $league_id );
		$team_id	= $this->sanitize( $team_id );
		$user_id	= $this->sanitize( $user_id );
		$roster_id  = $this->sanitize( $roster_id );
		if( $roster_id != '' ) { 
			$roster = $this->get_league_roster_ids($league_id, $team_id);
			array_push( $roster, $user_id );
			$updated_roster = json_encode( $roster );
			$this->link->query("UPDATE `" . $this->prefix . "rosters` SET roster = '$updated_roster' WHERE id = '$roster_id'");
		} else {
			$league_roster = array( $user_id );
			$updated_roster = json_encode( $league_roster );
			$this->link->query("INSERT INTO `" . $this->prefix . "rosters` SET league = '$league_id', team = '$team_id', roster = '$updated_roster'");
		}
		$this->success('Roster has been updated');
		return;
		
	}

	/*
	 * Remove a team member from a league roster
	 *
	 * @return string
	 */
	public function remove_league_member($league_id, $team_id, $user_id) {

		$roster = $this->get_league_roster_ids( $league_id, $team_id );
		if(($key = array_search($user_id, $roster)) !== false) {
		    unset($roster[$key]);
		    $updated_roster = json_encode( $roster );
		    $this->link->query("UPDATE `" . $this->prefix . "rosters` SET roster = '$updated_roster' WHERE league = '$league_id' AND team = '$team_id'");
		    $this->success('Member has been removed from league roster');
		} else {
			$this->error('There was a problem removing this user from the league roster');
		}
		return;

	}

	/*
	 * Check if member is on the league roster
	 *
	 * @return string
	 */
	public function member_league_check($array, $key, $val) {

	    foreach ($array as $item)
	        if (isset($item[$key]) && $item[$key] == $val)
	            return true;
	    return false;
	    
	}
	
	/*
	 * Get a team members profile
	 * 
	 * @return array
	 */
	public function get_team_member($user_id) {
		
		$user_id	= $this->sanitize( $user_id );
		$profile = array();
		$data = $this->fetch("SELECT id, username FROM `" . $this->prefix . "users` WHERE id = '$user_id'");
		$profile['id'] 		 = $data['0']['id'];
		$profile['username'] = $data['0']['username'];
		return $profile;
		
	}
	
	/*
	 * Kick team member
	 * 
	 * @return string (success or error)
	 */
	public function kick_team_member($member) {
		
		if( $this->link->query("UPDATE `" . $this->prefix . "users` SET guild = '' WHERE username = '$member'") ) {
			$this->success('Member kicked from team');
		} else {
			$this->error('Please try again, member was not kicked');			
		}
		return;
		
	}

/** LEAGUES START **/

	/*
	 * Get team leagues
	 * 
	 * @return array
	 */
	public function get_team_leagues($team_id) {
		
		$team_id	= $this->sanitize( $team_id );
		$team_leagues = array();
		$data = $this->fetch("SELECT leagues FROM `" . $this->prefix . "guilds` WHERE id = '$team_id'");
		if( $data != '' ) {
			if( $data['0']['leagues'] != '' ) {
				$leagues = $data['0']['leagues'];
				$leagues = explode( ',', $leagues );
				foreach( $leagues as $league ) {
					$details = $this->get_league_details( $league );
					array_push( $team_leagues, $details );
				}
				return $team_leagues;
			} else {
				return false;
			}
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
	public function register_league($team_id, $league_id) {
		
		$team_id 	= $this->sanitize( $team_id );
		$league_id 	= $this->sanitize( $league_id );
		$current_leagues = $this->get_team_league_list( $team_id );
		if( ! empty( $current_leagues ) ) {
			$current_leagues = $current_leagues . ',' . $league_id;
		} else {
			$current_leagues = $league_id;
		}
		$this->link->query("UPDATE `" . $this->prefix . "guilds` SET leagues = '$current_leagues' WHERE id = '$team_id'");
		$this->success('Team has been registered');
		return;

	}

	/*
	 * Register team for tournament
	 *
	 * @return string
	 */
	public function register_tournament($team_id, $tournament_id) {
		
		$team_id 	= $this->sanitize( $team_id );
		$tournament_id 	= $this->sanitize( $tournament_id );
		$current_tournaments = $this->get_team_tournament_list( $team_id );
		if( ! empty( $current_tournaments ) ) {
			$current_tournaments = $current_tournaments . ',' . $tournament_id;
		} else {
			$current_tournaments = $tournament_id;
		}
		$this->link->query("UPDATE `" . $this->prefix . "guilds` SET tournaments = '$current_tournaments' WHERE id = '$team_id'");
		$this->success('Team has been registered');
		return;

	}

	/*
	 * Get team tournament list
	 *
	 * @return string
	 */
	public function get_team_tournament_list($team_id) {

		$team_id 	= $this->sanitize( $team_id );
		$data = $this->fetch("SELECT tournaments FROM `" . $this->prefix . "guilds` WHERE id = '$team_id'");
		if( $data['0']['tournaments'] != '' ) {
			$current_tournaments = $data['0']['tournaments'];
		} else {
			$current_tournaments = '';
		}
		return $current_tournaments;

	}
	
	/*
	 * Get details of each participating league
	 * 
	 * @return array
	 */
	public function get_league_details($league_id) {
		
		$details = array();
		$data = $this->fetch("SELECT * FROM `" . $this->prefix . "leagues` WHERE id = '$league_id'");
		$details['league_id']	= $data['0']['id'];
		$details['league']		= $data['0']['league'];
		$details['game']		= $data['0']['game'];
		$details['max_roster'] 	= $data['0']['max_roster'];
		$details['status']		= $data['0']['open'];
		$details['start']		= date( 'F d, Y', strtotime( $data['0']['start_date'] ) );
		$details['rosters']		= $data['0']['rosters'];
		return $details;
		
	}
	
	/*
	 * Get team matches
	 * 
	 * @return array
	 */
	public function get_team_schedule($team_id, $league_id) {
		
		$team_id	= $this->sanitize( $team_id );
		$league		= $this->sanitize( $league_id );
		$schedule = array();
		$data = $this->fetch("SELECT * FROM `" . $this->prefix . "matches`
								WHERE (homeTeamID = '$team_id' OR awayTeamID = '$team_id') 
								AND (league = '$league_id')
								ORDER BY week ASC
							");
		return $data;
		
	}
/** END LEAGUES **/

/** TOURNAMENTS START **/

	/*
	 * Get team tournaments
	 * 
	 * @return array
	 */
	public function get_team_tournaments($team_id) {
		
		$team_id	= $this->sanitize( $team_id );
		$team_tournaments = array();
		$data = $this->fetch("SELECT tournaments FROM `" . $this->prefix . "guilds` WHERE id = '$team_id'");
		if( $data != '' ) {
			if( $data['0']['tournaments'] != '' ) {
				$tournaments = $data['0']['tournaments'];
				$tournaments = explode( ',', $tournaments );
				foreach( $tournaments as $tournament ) {
					$details = $this->get_tournament_details( $tournament );
					array_push( $team_tournaments, $details );
				}
				return $team_tournaments;
			} else {
				return false;
			}
		}
		
	}

	/*
	 * Get details of each participating tournament
	 * 
	 * @return array
	 */
	public function get_tournament_details($tournament_id) {
		
		$details = array();
		$data = $this->fetch("SELECT 
									`" . $this->prefix . "tournaments`.id AS tid,
									`" . $this->prefix . "tournaments`.tournament,
									`" . $this->prefix . "tournaments`.max_teams,
									`" . $this->prefix . "tournaments`.game AS tgame,
									`" . $this->prefix . "tournaments`.format,
									`" . $this->prefix . "tournaments`.status,
									`" . $this->prefix . "games`.slug,
									`" . $this->prefix . "games`.game AS ggame
								FROM `" . $this->prefix . "tournaments`, `" . $this->prefix . "games`
								WHERE `" . $this->prefix . "tournaments`.id = '$tournament_id'
									AND `" . $this->prefix . "games`.slug = `" . $this->prefix . "tournaments`.game
							");

		$details['tournament_id']	= $data['0']['tid'];
		$details['tournament']		= $data['0']['tournament'];
		$details['teams']			= $data['0']['max_teams'];
		$details['game']			= $data['0']['ggame'];
		$details['format'] 			= $data['0']['format'];
		$details['status']			= $data['0']['status'];
		$details['game_slug']		= $data['0']['slug'];
		return $details;
		
	}

	/*
	 * Get tournament matchups for a team
	 *
	 * @return array
	 */
	public function get_team_tournament_matches($tournament_id, $team_id) {

		$data = $this->fetch("SELECT * FROM `" . $this->prefix . "tournament_matches` 
								WHERE tid = '$tournament_id' 
								AND (home_team_id = '$team_id' OR away_team_id = '$team_id') 
								ORDER BY round
							");
		if( $data ) {
			return $data;
		} else {
			return false;
		}

	}


/** END TOURNAMENTS **/
	
	/*
	 * Search for a team by name
	 * 
	 * @return array
	 */
	public function search_teams($team_name) {
		
		$team_name	= $this->sanitize( $team_name );
		$data = $this->fetch("SELECT * FROM `" . $this->prefix . "guilds` WHERE guild LIKE '%$team_name%'");
		return $data;
		
	}
	
	/*
	 * Get team logo
	 * 
	 * @return string
	 */
	public function get_logo($team_id) {
		
		$team_id	= $this->sanitize( $team_id );
		$data = $this->fetch("SELECT logo FROM `" . $this->prefix . "guilds` WHERE id = '$team_id'");
		$logo = $data['0']['logo'];
		return $logo;
		
	}
	
	/*
	 * Update team logo
	 * 
	 * @return
	 */
	public function update_logo($team_id, $filename) {
		
		$team_id	= $this->sanitize( $team_id );
		$filename	= $this->sanitize( $filename );
		$this->link->query("UPDATE `" . $this->prefix . "guilds` SET logo = '$filename' WHERE id = '$team_id'");
		if( $filename == '' ) {
			$this->success('Logo has been removed');
		}
		return;
		
	}
	
}

?>