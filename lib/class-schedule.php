<?php 

class ezLeague_Schedule extends DB_Class {
    
    /*
     * Check for Repeat Matchup
     * @function is called when generate match form is fired
     * @return string
     */
    public function match_exists($home_team, $home_team_id, $away_team, $away_team_id, $league, $season, $week) {
    	
    	$home_team 	  = $this->sanitize( $home_team );
    	$home_team_id = $this->sanitize( $home_team_id );
    	$away_team    = $this->sanitize( $away_team );
    	$away_team_id = $this->sanitize( $away_team_id );
    	$league		  = $this->sanitize( $league );
    	$season		  = $this->sanitize( $season );
    	$week		  = $this->sanitize( $week );
    	
    	$data = $this->fetch("SELECT id FROM `" . $this->prefix . "matches` 
    								WHERE (homeTeamID = '$home_team_id' AND awayTeamID = '$away_team_id') 
    								OR (homeTeamID = '$home_team_id' AND awayTeamID = '$away_team_id') 
    								AND (season = '$season') AND (league = '$league')");
    	
    	$exist = count( $data );
    	
    	if( $exist > 0 ) {
    		$this->error("<span style='color:#B94A48;font-weight:bold;'>WARNING: Matchup already exists</span>");
    	} else {
    		$this->success("<span style='color:green;'>Matchup does not exist</span>");
    	}
    	$this->link->query("INSERT INTO `" . $this->prefix . "matches` 
    						SET homeTeamID = '$home_team_id', homeTeam = '$home_team', awayTeamID = '$away_team_id',
    							awayTeam = '$away_team', league = '$league', season = '$season', week = '$week' 
    					");
    	return;
    	
    }
    
    /*
     * Check if a week has matches scheduled
     * 
     * @return boolean
     */
    public function check_week_matches($league_id, $season, $week) {
    	
    	$league_id = $this->sanitize( $league_id );
    	$season    = $this->sanitize( $season );
    	$week	   = $this->sanitize( $week );
    	
    	$data = $this->fetch("SELECT * FROM `" . $this->prefix . "matches`
    							WHERE league = '$league_id' AND season = '$season' AND week = '$week'
    						");
    	$exist = count( $data );
    	if( $exist > 0 ) {
    		return true;
    	} else {
    		return false;
    	}
    	
    }
    
    /*
     * Delete previously generated matches that are rejected
     * 
     * @return
     */
    public function delete_generated_matches($total_matches) {
    	
    	$total_matches = $this->sanitize( $total_matches );
    	$this->link->query("DELETE FROM `" . $this->prefix . "matches` ORDER BY id DESC LIMIT $total_matches");
    	return;
    	
    }
    
    /*
     * Get league week map
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
     * Get schedule of a league season
     * 
     * @return array
     */
    public function get_schedule($league_id, $season) {
    	
    	$league_id 	= $this->sanitize( $league_id );
    	$season		= $this->sanitize( $season );
    	$matchups = array();
    	$data = $this->fetch("SELECT * FROM `" . $this->prefix . "matches` 
    							WHERE league = '$league_id' AND season = '$season'
    							ORDER BY week ASC
    						");
    	if( $data ) {
    		foreach( $data as $match ) {
    			$matchup['id']		   = $match['id'];
    			$matchup['home_team']  = $match['homeTeam'];
    			$matchup['home_id']    = $match['homeTeamID'];
    			$matchup['away_team']  = $match['awayTeam'];
    			$matchup['away_id']	   = $match['awayTeamID'];
    			$matchup['created']	   = date('F d, Y', strtotime( $match['created'] ) );
    			$matchup['match_date'] = $match['matchDate'];
    			$matchup['match_time'] = $match['matchTime'];
    			$matchup['timezone']   = $match['matchZone'];
    			$matchup['completed']  = $match['completed'];
    			$matchup['week']	   = $match['week'];
    			$matchup['map']		   = $this->get_week_map( $league_id, $matchup['week'] );
    			
    			array_push( $matchups, $matchup );
    		}
    		return $matchups;
    	} else {
    		return false;
    	}
    	
    }
    
    public function get_week_schedule($league_id, $season, $week) {
    	 
    	$league_id 	= $this->sanitize( $league_id );
    	$season		= $this->sanitize( $season );
    	$week		= $this->sanitize( $week );
    	$matchups = array();
    	$data = $this->fetch("SELECT * FROM `" . $this->prefix . "matches` 
    							WHERE league = '$league_id' AND season = '$season'
    							AND week = '$week'
    							ORDER BY week ASC
    						");
    	if( $data ) {
    		foreach( $data as $match ) {
    			$matchup['id']		   = $match['id'];
    			$matchup['home_team']  = $match['homeTeam'];
    			$matchup['home_id']    = $match['homeTeamID'];
    			$matchup['away_team']  = $match['awayTeam'];
    			$matchup['away_id']	   = $match['awayTeamID'];
    			$matchup['created']	   = date('F d, Y', strtotime( $match['created'] ) );
    			$matchup['match_date'] = $match['matchDate'];
    			$matchup['match_time'] = $match['matchTime'];
    			$matchup['timezone']   = $match['matchZone'];
    			$matchup['completed']  = $match['completed'];
    			$matchup['week']	   = $match['week'];
    			$matchup['map']		   = $this->get_week_map( $league_id, $matchup['week'] );
    			 
    			array_push( $matchups, $matchup );
    		}
    		return $matchups;
    	} 
    	 
    }
    
}
?>