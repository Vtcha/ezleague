<?php 
/*
 * *******************************************************************
 * ezLeague Forum Class
 * Author: Michael Loring
 * Started: May 19th 2014
 * About: For use with the ezLeague PHP Online Gaming League Script
 * http://www.mdloring.com - http://www.mdloring.com/ezleague
 * *******************************************************************
 */
class ezForum extends DB_Class {
	
	function getSections() {
		$section_data = $this->fetch("SELECT * FROM `" . $this->prefix . "forum_section` WHERE type = 'public' AND status = 'enabled' ORDER BY type ASC");
		 return $section_data;
	}
	
	function getSectionName($id) {
		$section_data = $this->fetch("SELECT section_name FROM `" . $this->prefix . "forum_section` WHERE id = '$id'");
		 $section_name = $section_data['0']['section_name'];
		 return $section_name;
	}
	
	function getSectionID($section) {
		$section_data = $this->fetch("SELECT id FROM `" . $this->prefix . "forum_section` WHERE section_name = '$section'");
		 $section_id = $section_data['0']['id'];
		  return $section_id;
	}
	
	function getTopics($section_id) {
		$topic_data = $this->fetch("SELECT * FROM `" . $this->prefix . "forum_question` WHERE section = '$section_id' ORDER BY datetime DESC");
		 return $topic_data;
	}
	
	function getTopicMessage($id) {
		$topic_data = $this->fetch("SELECT * FROM `" . $this->prefix . "forum_question` WHERE id='$id'");
		 return $topic_data;
	}
	
	function getTopicResponses($id) {
		$response_data = $this->fetch("SELECT * FROM `" . $this->prefix . "forum_answer` WHERE question_id='$id' ORDER BY a_id DESC");
		 return $response_data;
	}
	
	function createTopic($id, $username, $user_id, $topic, $details) {
		$details = $this->link->real_escape_string($details);
		$this->link->query("INSERT INTO `" . $this->prefix . "forum_question` SET topic = '$topic', detail = '$details', section = '$id',
					  starter_user_id = '$user_id', starter_username = '$username', recent_username = '$username',
					  recent_user_id = '$user_id', recent_modified = 'NOW()'");
		 $topic_id_data = $this->fetch("SELECT id, section FROM `" . $this->prefix . "forum_question` ORDER BY id DESC LIMIT 1");
		  $topic_id = $topic_id_data['0']['id'];
		  $section_id = $topic_id_data['0']['section'];
		 echo "<strong>Success!</strong> Topic created succesfully";
		 $this->link->query("UPDATE `" . $this->prefix . "users` SET post_count = post_count+1 WHERE id = '$user_id'");
	}

	function getUserPostCount($username) {
		$post_count_data = $this->fetch("SELECT post_count FROM `" . $this->prefix . "users` WHERE username = '$username'");
		 $post_count = $post_count_data['0']['post_count'];
		 return $post_count;
	}	
	
	function updateUserPostCount($username, $new_post_count) {
		  $this->link->query("UPDATE `" . $this->prefix . "users` SET post_count = '$new_post_count' WHERE username = '$username'");
	}
	
	function getUserSignature($userID) {
		  $signature = $this->fetch("SELECT signature FROM `" . $this->prefix . "users` WHERE id = '$userID'");
		   $signature = $signature['0']['signature'];
		  	return $signature;
	}
	
	function updateTopicViews($id) {
		$old_view_data = $this->fetch("SELECT view FROM `" . $this->prefix . "forum_question` WHERE id = '$id'");
		 $old_view = $old_view_data['0']['view'];
		 $new_view = $old_view + 1;
		  $this->link->query("UPDATE `" . $this->prefix . "forum_question` SET view = '$new_view' WHERE id = '$id'");
	}
	
	function addResponse($id, $a_answer, $a_section, $a_username, $a_user_id) {
		$modified = date('Y-m-d h:i:s', strtotime(now));
		$a_answer = addslashes($a_answer);
		$new_answer = ezForum::BBCode($a_answer);
		$this->link->query("INSERT INTO `" . $this->prefix . "forum_answer` SET question_id = '$id', a_answer = '$new_answer', 
					 a_section = '$a_section', a_username = '$a_username', a_user_id = '$a_user_id'");
		 //increase the topics replies + 1
		    $this->link->query("UPDATE `" . $this->prefix . "forum_question` SET reply = reply+1, recent_username = '$a_username', 
		    			  recent_user_id = '$a_user_id', recent_modified = '$modified' WHERE id = '$id'");
		echo "<strong>Success!</strong> Your response has been posted.";
		
			$this->link->query("UPDATE `" . $this->prefix . "users` SET post_count = post_count+1 WHERE id = '$a_user_id'");
	}
	
	function BBCode($content) {
		$search = array (
				'/(\[b\])(.*?)(\[\/b\])/',
				'/(\[i\])(.*?)(\[\/i\])/',
				'/(\[u\])(.*?)(\[\/u\])/',
				'/(\[ul\])(.*?)(\[\/ul\])/',
				'/(\[li\])(.*?)(\[\/li\])/',
				'/(\[url=)(.*?)(\])(.*?)(\[\/url\])/',
				'/(\[url\])(.*?)(\[\/url\])/'
		);
	
		$replace = array (
				'<strong>$2</strong>',
				'<em>$2</em>',
				'<u>$2</u>',
				'<ul>$2</ul>',
				'<li>$2</li>',
				'<a href="$2" target="_blank" style="color:black;">$4</a>',
				'<a href="$2" target="_blank" style="color:black;">$2</a>'
		);
	
		return preg_replace($search, $replace, $content);
	}
	
	
}

?>