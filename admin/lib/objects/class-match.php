<?php 

class ezAdmin_Match extends DB_Class {
	
	/*
	 * Count the total number of matches for a league
	 * 
	 * @return int
	 */
	public function count_league_matches($league_id) {
		
		$league_id		= $this->sanitize( $league_id );
		$data = $this->fetch("SELECT id FROM `" . $this->prefix . "matches` WHERE league = '$league_id'");
		if( $data ) {
			$total_matches = count( $data );
		} else {
			$total_matches = 0;
		}
		return $total_matches;
		
	}
	
	/*
	 * Get matches from a league
	 * 
	 * @return array
	 */
	public function get_matches($league_id) {
		
		$matches = array();
		$data = $this->fetch("SELECT * FROM `" . $this->prefix . "matches` WHERE league = '$league_id' ORDER BY week ASC");
		if( $data ) {
			foreach( $data as $item ) {
				$match['id']		= $item['id'];
				$match['home']		= $item['homeTeam'];
				$match['away']		= $item['awayTeam'];
				$match['home_id']	= $item['homeTeamID'];
				$match['away_id']	= $item['awayTeamID'];
				$match['status']	= $item['completed'];
				$match['winner']	= $item['winner'];
				$match['loser']		= $item['loser'];
				$match['week']		= $item['week'];
				$match['featured']  = $item['featured'];
				array_push( $matches, $match );
			}
			return $matches;
		} else {
			return;
		}
		
	}
	
	/*
	 * Get match details
	 * 
	 * @return array
	 */
	public function get_match($match_id) {
		
		$match_id	= $this->sanitize( $match_id );
		$data = $this->fetch("SELECT " . $this->prefix . "matches.*, " . $this->prefix . "leagues.`league` AS league_name FROM `" . $this->prefix . "matches`, `" . $this->prefix . "leagues` WHERE " . $this->prefix . "matches.`id` = '$match_id' LIMIT 1");
		if( $data ) {
			$match['id']		  = $data['0']['id'];
			$match['league_id']	  = $data['0']['league'];
			$match['league']	  = $data['0']['league_name'];
			$match['home']		  = $data['0']['homeTeam'];
			$match['home_id']	  = $data['0']['homeTeamID'];
			$match['home_score']  = $data['0']['homeScore'];
			$match['home_accept'] = $data['0']['homeTeam_accept'];
			$match['away']		  = $data['0']['awayTeam'];
			$match['away_id']	  = $data['0']['awayTeamID'];
			$match['away_score']  = $data['0']['awayScore'];
			$match['away_accept'] = $data['0']['awayTeam_accept'];
			$match['winner']	  = $data['0']['winner'];
			$match['loser']		  = $data['0']['loser'];
			$match['status']	  = $data['0']['completed'];
			$match['season']	  = $data['0']['season'];
			$match['date']		  = $data['0']['matchDate'];
			$match['time']		  = $data['0']['matchTime'];
			$match['zone']		  = $data['0']['matchZone'];
			$match['chat']		  = $data['0']['chat_log'];
			return $match;
		} else {
			return;
		}
		
	}
	
	/*
	 * Edit a match score and update the winner and loser
	 * 
	 * @return string
	 */
	public function edit_score($match_id, $home, $home_score, $away, $away_score) {
		
		$match_id		= $this->sanitize( $match_id );
		$home			= $this->sanitize( $home );
		$home_score		= $this->sanitize( $home_score );
		$away 			= $this->sanitize( $away );
		$away_score		= $this->sanitize( $away_score );
		if( $home_score > $away_score ) {
			$winner = $home;
			$loser  = $away;
		} else {
			$winner = $away;
			$loser  = $home;
		}
		$this->link->query("UPDATE `" . $this->prefix . "matches` 
							SET homeScore = '$home_score', awayScore = '$away_score', winner = '$winner', loser = '$loser' 
							WHERE id = '$match_id'
						");
		$this->success('Match score has been updated');
		return;
		
	}
	
	/*
	 * Get a list of all match disputes
	 * 
	 * @return array
	 */
	public function get_disputes($status, $category) {
		
		$status	  = $this->sanitize( $status );
		$status_query = "";
		$category = $this->sanitize( $category );
		$category_query = "";
		$disputes = array();
		switch( $status ) {
			case 'open':
				$status_query = "" . $this->prefix . "disputes.status = '0' AND ";
				break;
			case 'closed':
				$status_query = "" . $this->prefix . "disputes.status = '1' AND ";
				break;
			default:
				$status_query = "";
				break;
		}
		
		switch( $category ) {
			case 'cheating':
				$category_query = "" . $this->prefix . "disputes.category = 'cheating' AND ";
				break;
			case 'player':
				$category_query = "" . $this->prefix . "disputes.category = 'player' AND ";
				break;
			case 'other':
				$category_query = "" . $this->prefix . "disputes.category = 'other' AND ";
				break;
			default:
				$category_query = '';
				break;
		}
		
		$data = $this->fetch("SELECT " . $this->prefix . "disputes.*, " . $this->prefix . "matches.league AS mlid, " . $this->prefix . "leagues.league AS league_name
								FROM `" . $this->prefix . "disputes`, `" . $this->prefix . "matches`, `" . $this->prefix . "leagues`
								WHERE $status_query $category_query " . $this->prefix . "matches.id = " . $this->prefix . "disputes.match_id AND " . $this->prefix . "leagues.id = " . $this->prefix . "matches.league
							");
		
		if( $data ) {
			foreach( $data as $item ) {
				$dispute['id']		= $item['id'];
				$dispute['match']	= $item['match_id'];
				$dispute['cat']		= $item['category'];
				$dispute['desc']	= $item['description'];
				$dispute['filed']	= $item['filed_by'];
				$dispute['status']  = $item['status'];
				$dispute['date']	= $item['created'];
				$dispute['league']  = $item['league_name'];
				$dispute['lid']		= $item['mlid'];
				array_push( $disputes, $dispute );
			}
			return $disputes;
		} else {
			return;
		}
		
	}
	
	/*
	 * Get details of a match dispute
	 * 
	 * @return array
	 */
	public function get_dispute($dispute_id) {
		
		$dispute_id	= $this->sanitize( $dispute_id );
		$dispute = array();
		$data = $this->fetch("SELECT " . $this->prefix . "disputes.*, " . $this->prefix . "matches.league AS mlid, " . $this->prefix . "leagues.league AS league_name 
								FROM `" . $this->prefix . "disputes`, `" . $this->prefix . "matches`, `" . $this->prefix . "leagues`
								WHERE " . $this->prefix . "disputes.id = '$dispute_id' AND " . $this->prefix . "matches.id = " . $this->prefix . "disputes.match_id AND " . $this->prefix . "leagues.id = " . $this->prefix . "matches.league
							");
		if( $data ) {
			$dispute['id']		= $data['0']['id'];
			$dispute['match']	= $data['0']['match_id'];
			$dispute['cat']		= $data['0']['category'];
			$dispute['desc']	= $data['0']['description'];
			$dispute['filed']	= $data['0']['filed_by'];
			$dispute['status']	= $data['0']['status'];
			$dispute['date']	= $data['0']['created'];
			$dispute['league']  = $data['0']['league_name'];
			$dispute['lid']		= $data['0']['mlid'];
			return $dispute;	
		} else {
			return;
		}
		
	}
	
	/*
	 * Update a dispute
	 * 
	 * @return string
	 */
	public function update_dispute($dispute_id, $status) {
		
		$dispute_id	= $this->sanitize( $dispute_id );
		$status		= $this->sanitize( $status );
		
		$this->link->query("UPDATE `" . $this->prefix . "disputes` SET status = '$status' WHERE id = '$id'");
		$this->success('Dispute status updated');
		return;
		
	}

	/*
	 * Set featured match
	 *
	 * @return string
	 */
	public function update_featured_match($match_id, $week, $league_id, $method) {

		$match_id 	= $this->sanitize( $match_id );
		$week 		= $this->sanitize( $week );
		$league_id  = $this->sanitize( $league_id );
		$method  	= $this->sanitize( $method );
		$this->link->query("UPDATE `" . $this->prefix . "matches` SET featured = '0' WHERE week = '$week' AND league = '$league_id'");
		if( $method == 'set' ) {
			$this->link->query("UPDATE `" . $this->prefix . "matches` SET featured = '1' WHERE id = '$match_id'");
			$this->success('Featured match has been set for week ' . $week);
		} else {
			$this->success('Featured match has been removed for week ' . $week);
		}
		return;

	}
	
}

?>