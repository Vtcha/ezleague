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

	public function get_total_teams($tournament_id) {
		
		$data = $this->fetch("SELECT guild FROM `" . $this->prefix . "guilds` WHERE (tournaments LIKE '%,$tournament_id') OR (tournaments LIKE '$tournament_id,%') OR (tournaments LIKE '$tournament_id') OR (tournaments LIKE '%,$tournament_id,%')");
		if( $data ) {
			$count = count( $data );
		} else {
			$count = 0;
		}
		return $count;
		
	}

}

?>