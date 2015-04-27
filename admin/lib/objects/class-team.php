<?php 

class ezAdmin_Team extends DB_Class {

	/*
	 * Create a new team
	 *
	 * @return string
	 */
	public function create_team($team_name, $abbreviation, $admin) {

		$team_name 		= $this->sanitize( $team_name );
		$abbreviation 	= $this->sanitize( $abbreviation );
		$admin 			= $this->sanitize( $admin );

		$check_data = $this->fetch("SELECT guild 
									FROM `" . $this->prefix . "guilds` 
									WHERE guild = '$team_name'
								  ");
		if( count( $check_data ) > 0 ) {
			$this->error( 'Team Name is already in use' );
			return;
		} else {
			if( strlen( $abbreviation ) > 5 ) {
				$this->error( 'Team Abbreviation is greater than 5 characters' );
			} else {
				$this->link->query("INSERT INTO `" . $this->prefix . "guilds` 
									SET guild = '$team_name', abbreviation = '$abbreviation', 
										admin = '$admin', gm = '$admin', logo = 'team-logo.png'
								  ");
				$this->success( 'Team has been created' );
			}
			return;
		}
	}

	/*
	 * Count total registered teams
	 * 
	 * @return int
	 */
	public function count_teams() {
		
		$data = $this->fetch("SELECT * FROM `" . $this->prefix . "guilds`");
		if( $data ) {
			$total_teams = count( $data );
			return $total_teams;
		} else {
			return;
		}
		
	}
	
	/*
	 * Get all registered teams
	 * 
	 * @return array
	 */
	public function get_teams($position, $order_by, $order) {
		
		$teams = array();
		$data = $this->fetch("SELECT * FROM `" . $this->prefix . "guilds` ORDER BY $order_by $order LIMIT $position, 15");
		if( $data ) {
			foreach( $data as $item ) {
				$team['id']			= $item['id'];
				$team['team']		= $item['guild'];
				$team['abbr']		= $item['abbreviation'];
				$team['leader']		= $item['gm'];
				$team['coleader']	= $item['agm'];
				$team['website']	= $item['website'];
				$team['admin']		= $item['admin'];
				$team['leagues']	= $item['leagues'];
				$team['logo']		= $item['logo'];
				array_push( $teams, $team );
			}
			return $teams;
		} else {
			return;
		}
		
	}

	/*
	 * Get all registered teams for a menu drop-down
	 * 
	 * @return array
	 */
	public function get_all_teams() {
		
		$teams = array();
		$data = $this->fetch("SELECT * FROM `" . $this->prefix . "guilds` ORDER BY guild ASC");
		if( $data ) {
			foreach( $data as $item ) {
				$team['id']			= $item['id'];
				$team['team']		= $item['guild'];
				$team['abbr']		= $item['abbreviation'];
				array_push( $teams, $team );
			}
			return $teams;
		} else {
			return;
		}
		
	}
	
	/*
	 * Search for a team by name
	 * 
	 * @return array
	 */
	public function search_teams($search) {
		
		$teams = array();
		$data = $this->fetch("SELECT * FROM `" . $this->prefix . "guilds` WHERE guild LIKE '%$search%'");
		if( $data ) {
			foreach( $data as $item ) {
				$team['id']			= $item['id'];
				$team['team']		= $item['guild'];
				$team['abbr']		= $item['abbreviation'];
				$team['leader']		= $item['gm'];
				$team['coleader']	= $item['agm'];
				$team['website']	= $item['website'];
				$team['admin']		= $item['admin'];
				$team['leagues']	= $item['leagues'];
				$team['logo']		= $item['logo'];
				array_push( $teams, $team );
			}
			return $teams;
		} else {
			return;
		}
		
	}
	
	public function get_team($team_id) {
		
		$team_id	= $this->sanitize( $team_id );
		$data = $this->fetch("SELECT * FROM `" . $this->prefix . "guilds` WHERE id = '$team_id'");
		if( $data ) {
			$team = array(
					'id'	  => $data['0']['id'],
					'name'    => $data['0']['guild'],
					'abbr'    => $data['0']['abbreviation'],
					'leader'  => $data['0']['gm'],
					'coleader'=> $data['0']['agm'],
					'site'    => $data['0']['website'],
					'admin'   => $data['0']['admin'],
					'leagues' => $data['0']['leagues'],
					'logo'	  => $data['0']['logo']
			);
			return $team;
		} else {
			return;
		}
		
	}

	public function get_team_name($team_id) {
		
		$team_id	= $this->sanitize( $team_id );
		$data = $this->fetch("SELECT guild FROM `" . $this->prefix . "guilds` WHERE id = '$team_id'");
		if( $data ) {
			return $data[0]['guild'];
		} else {
			return;
		}
		
	}
	
	public function get_team_matches($team_id) {
		
		$team_id	= $this->sanitize( $team_id );
		$matches = array();
		$data = $this->fetch("SELECT * FROM `" . $this->prefix . "matches` WHERE (homeTeamID = '$team_id' OR awayTeamID = '$team_id') AND completed = '1' ORDER BY week ASC");
		if( $data ) {
			foreach( $data as $item ) {
				$match['id']		= $item['id'];
				$match['home']		= $item['homeTeam'];
				$match['away']		= $item['awayTeam'];
				$match['home_id']	= $item['homeTeamID'];
				$match['home_score']= $item['homeScore'];
				$match['away_id']	= $item['awayTeamID'];
				$match['away_score']= $item['awayScore'];
				$match['status']	= $item['completed'];
				$match['winner']	= $item['winner'];
				$match['loser']		= $item['loser'];
				$match['week']		= $item['week'];
				array_push( $matches, $match );
			}
			return $matches;
		} else {
			return;
		}
		
	}
	
	public function get_team_roster($team_id) {
		
		$team_id	= $this->sanitize( $team_id );
		$roster = array();
		$data = $this->fetch("SELECT * FROM `" . $this->prefix . "users` WHERE guild = '$team_id'");
		if( $data ) {
			foreach( $data as $item ) {
				$member['id']		= $item['id'];
				$member['username'] = $item['username'];
				array_push( $roster, $member );
			}
			return $roster;
		} else {
			return;
		}
		
		
	}
	
	public function get_team_admin_email($team_id) {
		
		$data = $this->fetch("SELECT `" . $this->prefix . "users`.*, `" . $this->prefix . "guilds`.* FROM `" . $this->prefix . "users`
				INNER JOIN `" . $this->prefix . "guilds`
				WHERE `" . $this->prefix . "guilds`.id = '$team_id' AND `" . $this->prefix . "guilds`.gm = `" . $this->prefix . "users`.username
				");
		$admin = array(
				'email'		=> $data['0']['email'],
				'team'		=> $data['0']['guild']
		);
		return $admin;
		
	}
	
	public function delete_team($team_id) {
		
		$this->link->query("DELETE FROM `" . $this->prefix . "guilds` WHERE id = '$id'");
		$this->link->query("UPDATE `" . $this->prefix . "users` SET guild = '' WHERE guild = '$id'");
		echo "<strong>Success!</strong> Team has been deleted, and member profiles updated";
		
	}
	
	public function get_team_record($team_id) {
		
		$wins = $this->fetch("SELECT * FROM `" . $this->prefix . "results`
				WHERE guild_id = '$team_id' AND result = 'w'
				");
		$total_wins = count($wins);
	
		$losses = $this->fetch("SELECT * FROM `" . $this->prefix . "results`
				WHERE guild_id = '$team_id' AND result = 'l'
				");
				$total_losses = count($losses);
	
				$record = array(
				'wins' 	 => $total_wins,
				'losses' => $total_losses
				);
				return $record;
				
	}
	
	public function get_team_recent_matches($team_id) {
		
		$data = $this->fetch("SELECT t.id, t.challenger, t.challenger_score, t.league_id, t.match_date, t.created, t.completed, t.challengee_accepted, t.challengee_score, t.challenger_accepted, t.g_challenger, t.challengee, g2.guild AS g_challengee
		FROM (
		SELECT c1.id, c1.challenger, c1.challenger_score, c1.created, c1.match_date, c1.league_id, c1.completed, c1.challengee_accepted, c1.challengee_score, c1.challenger_accepted, g1.guild AS g_challenger, c1.challengee
		FROM `" . $this->prefix . "guilds` g1
		JOIN `" . $this->prefix . "challenges` c1
		ON g1.id = c1.challenger
		) t
		JOIN `" . $this->prefix . "guilds` g2
		ON g2.id = t.challengee
		WHERE (t.completed = 1) AND (t.challengee = '$team_id' OR t.challenger = '$team_id')
		ORDER BY t.created DESC
		");
		return $data;
		
	}

	public function set_team_leader($team_id, $username) {

		$team_id 	= $this->sanitize( $team_id );
		$username 	= $this->sanitize( $username );
		$this->link->query("UPDATE `" . $this->prefix . "guilds` SET gm = '$username' WHERE id = '$team_id'");
		$this->success( 'Team Leader has been set' );
		return;

	}

	public function set_team_coleader($team_id, $username) {

		$team_id 	= $this->sanitize( $team_id );
		$username 	= $this->sanitize( $username );
		$this->link->query("UPDATE `" . $this->prefix . "guilds` SET agm = '$username' WHERE id = '$team_id'");
		$this->success( 'Team Co-Leader has been set' );
		return;
		
	}

	public function set_team_admin($team_id, $username) {

		$team_id 	= $this->sanitize( $team_id );
		$username 	= $this->sanitize( $username );
		$this->link->query("UPDATE `" . $this->prefix . "guilds` SET admin = '$username' WHERE id = '$team_id'");
		$this->success( 'Team Admin has been set' );
		return;
		
	}

	public function change_team_name($team_id, $new_team_name) {

		$team_id 		= $this->sanitize( $team_id );
		$new_team_name 	= $this->sanitize( $new_team_name );

		$this->link->query("UPDATE `" . $this->prefix . "guilds` SET guild = '$new_team_name' WHERE id = '$team_id'");
		$this->link->query("UPDATE `" . $this->prefix . "leaguematches` SET homeTeam = '$new_team_name' WHERE homeTeamID = '$team_id'");
		$this->link->query("UPDATE `" . $this->prefix . "leaguematches` SET awayTeam = '$new_team_name' WHERE awayTeamID = '$team_id'");
		$this->link->query("UPDATE `" . $this->prefix . "tournament_matches` SET home_team = '$new_team_name' WHERE home_team_id = '$team_id'");
		$this->link->query("UPDATE `" . $this->prefix . "tournament_matches` SET away_team = '$new_team_name' WHERE away_team_id = '$team_id'");
		$this->success( 'Team Name has been modified' );
		return;
		
	}
				
}


?>