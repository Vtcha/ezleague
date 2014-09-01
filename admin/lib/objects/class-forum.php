<?php 

class ezAdmin_Forum extends DB_Class {
	
	public function getForumSections() {
		
		$data = $this->fetch("SELECT * FROM `" . $this->prefix . "forum_section` ORDER BY type DESC");
		return $data;
		
	}
	
	public function addForum($forum, $type) {
		
		$result = $this->link->query("SELECT section_name FROM `" . $this->prefix . "forum_section`
				WHERE section_name = '$forum' AND type = '$type'
				");
		$count = $this->numRows($result);
		if($count > 0) {
		echo "<strong>Error</strong> Section Name and Type already exists";
		} else {
		$this->link->query("INSERT INTO `" . $this->prefix . "forum_section` SET section_name = '$forum',
		type = '$type'
		");
		echo "<strong>Success!</strong> New Forum Section created";
		
		}
	}
	
	public function updateForumStatus($section_id, $status) {
		
		$this->link->query("UPDATE `" . $this->prefix . "forum_section` SET status = '$status' WHERE id = '$section_id'");
		echo "<strong>Success!</strong> Forum status updated";
	
	}
		
}

?>