<?php 

class ezAdmin_Frontend extends DB_Class {
	
	public function get_recent_users($total) {
		
		$total 	= $this->sanitize( $total );
		$data = $this->fetch("SELECT id, username, email, created FROM `" . $this->prefix . "users` ORDER BY id DESC LIMIT $total");
		return $data;
		
	}
	
	public function get_recent_teams($total) {
		
		$total 	= $this->sanitize( $total );
		$data = $this->fetch("SELECT guild, abbreviation, gm, admin, id FROM `" . $this->prefix . "guilds` ORDER BY id DESC LIMIT $total");
		return $data;
		
	}
	
	public function get_total($table) {
		
		$table	= $this->sanitize( $table );
		switch($table) {
			case 'users':
				$table = 'users';
				break;
			case 'teams':
				$table = 'guilds';
				break;
			case 'leagues':
				$table = 'leagues';
				break;
			case 'matches':
				$table = 'matches';
				break;
			case 'games':
				$table = 'games';
				break;
			default:
				break;
		}
			
		$result = $this->link->query("SELECT id FROM `" . $this->prefix . "$table`");
		$count = $this->numRows( $result );
		return $count;
		
	}
	
	public function get_page_content($page) {
		
		$page 	= $this->sanitize( $page );
		$data = $this->fetch("SELECT site_" . $page . " FROM `" . $this->prefix . "settings` WHERE id = '1'");
		$content = $data['0']['site_' . $page . ''];
		return $content;
		
	}
	
	public function update_page_content($page, $content) {
		
		$page 	= $this->sanitize( $page );
		$content = $this->sanitize( $content );
		$this->link->query("UPDATE `" . $this->prefix . "settings` SET site_$page = '$content' WHERE id = '1'");
		$this->success('' . $page . ' content has been updated.');
		
	}

	public function test_connection() {
			
		$test = $this->fetch("SELECT username FROM `" . $this->prefix . "users` WHERE username = 'admin'");
		if( ! $test ) {
		    header("Location: admin/install.php");
		} else {
			return true;
		}
		
	}
	
}

?>