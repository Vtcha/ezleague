<?php 

class ezAdmin_Tournament extends DB_Class {

	public function get_all_tournaments() {
		
		$data = $this->fetch("SELECT " . $this->prefix . "games.slug, " . $this->prefix . "games.game AS ggame, " . $this->prefix . "tournaments.game AS lgame, " . $this->prefix . "tournaments.id AS tid,
								" . $this->prefix . "tournaments.start_date, " . $this->prefix . "tournaments.tournament
								FROM `" . $this->prefix . "tournaments`, `" . $this->prefix . "games`
								WHERE " . $this->prefix . "games.slug = " . $this->prefix . "tournaments.game
								ORDER BY " . $this->prefix . "tournaments.game DESC, " . $this->prefix . "tournaments.id ASC
							");
		return $data;
		
	}

	public function get_open_tournaments() {
		
		$data = $this->fetch("SELECT " . $this->prefix . "games.slug, " . $this->prefix . "games.game AS ggame, " . $this->prefix . "tournaments.game AS lgame, " . $this->prefix . "tournaments.id AS tid,
								" . $this->prefix . "tournaments.start_date, " . $this->prefix . "tournaments.tournament, " . $this->prefix . "tournaments.max_teams
								FROM `" . $this->prefix . "tournaments`, `" . $this->prefix . "games`
								WHERE (" . $this->prefix . "games.slug = " . $this->prefix . "tournaments.game) 
									AND (" . $this->prefix . "tournaments.status = '1')
								ORDER BY " . $this->prefix . "tournaments.game DESC, " . $this->prefix . "tournaments.id ASC
							");
		return $data;
		
	}

	public function get_closed_tournaments() {
		
		$data = $this->fetch("SELECT " . $this->prefix . "games.slug, " . $this->prefix . "games.game AS ggame, " . $this->prefix . "tournaments.game AS lgame, " . $this->prefix . "tournaments.id AS tid,
								" . $this->prefix . "tournaments.start_date, " . $this->prefix . "tournaments.tournament
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
				'rules'		 	=> $data['0']['rules']
		);
		return $tournament;
		
	}
	
	public function create_tournament($tournament, $game, $max_teams, $start_date, $registration, $format) {
		
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
								SET tournament = '$tournament', game = '$game', max_teams = '$max_teams', start_date = '$start_date', registration_date = '$registration_date', format = '$format'
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
		
		$result = $this->link->query("SELECT guild FROM `" . $this->prefix . "guilds` WHERE tournaments LIKE '%,$tournament_id' OR tournaments LIKE '$tournament_id,%' OR tournaments LIKE '$tournament_id'");
		$count = $this->numRows($result);
		return $count;
		
	}
	
	public function get_tournament_teams($tournament_id) {
		
		$data = $this->fetch("SELECT * FROM `" . $this->prefix . "guilds` WHERE tournaments LIKE '%,$tournament_id' OR tournaments LIKE '$tournament_id,%' OR tournaments LIKE '$tournament_id' OR tournaments LIKE '%,$tournament_id,%'");
		return $data;
		
	}

}

?>