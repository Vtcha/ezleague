<?php 

class ezAdmin_Frontend extends DB_Class {
	
	public function get_recent_users($total) {
		
		$data = $this->fetch("SELECT id, username, email, created FROM `" . $this->prefix . "users` ORDER BY id DESC LIMIT $total");
		return $data;
		
	}
	
	public function get_recent_teams($total) {
		
		$data = $this->fetch("SELECT guild, abbreviation, gm, admin, id FROM `" . $this->prefix . "guilds` ORDER BY id DESC LIMIT $total");
		return $data;
		
	}
	
	public function get_total($table) {
		
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
		}
			
		$result = $this->link->query("SELECT id FROM `" . $this->prefix . "$table`");
		$count = $this->numRows( $result );
		return $count;
		
	}
	
	public function get_page_content($page) {
		
		$data = $this->fetch("SELECT site_" . $page . " FROM `" . $this->prefix . "settings` WHERE id = '1'");
		$content = $data['0']['site_' . $page . ''];
		return $content;
		
	}
	
	public function update_page_content($page, $content) {
		
		$content = $this->sanitize( $content );
		$this->link->query("UPDATE `" . $this->prefix . "settings` SET site_$page = '$content' WHERE id = '1'");
		echo "<strong>Success!</strong> $page content has been updated.";
		
	}
	
}

?>