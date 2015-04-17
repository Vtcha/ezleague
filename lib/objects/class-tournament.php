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
		$data = $this->fetch("SELECT * FROM `" . $this->prefix . "tournament_matches` WHERE id = '$match_id'");
		if( $data ) {
			return $data;
		} else {
			return false;
		}

	}

}

?>