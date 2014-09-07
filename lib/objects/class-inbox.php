<?php 

class ezLeague_Inbox extends DB_Class {
	
	/*
	 * Get a users inbox
	 * 
	 * @return array
	 */
	public function get_inbox($username) {
		
		$data = $this->fetch("SELECT * FROM `" . $this->prefix . "inbox_messages` WHERE (recipient = '$username') OR (sender = '$username')");
		return $data;
	}
	
	/*
	 * Count a users total inbox messages
	 * 
	 * @return int
	 */
	public function count_new_inbox($username) {
		
		$result = $this->link->query("SELECT * FROM `" . $this->prefix . "inbox_messages` WHERE recipient  = '$username'
									AND status = 'unread'
								");
		$total = $this->numRows( $result );
		return $total;
			
	}
	
	/*
	 * Get a specific message based on id
	 * 
	 * @return array
	 */
	public function get_message($message_id) {
		
		$message = array();
		$data = $this->fetch("SELECT * FROM `" . $this->prefix . "inbox_original` WHERE id = '$message_id'");
		$message['id']		= $data['0']['id'];
		$message['sender']	= $data['0']['sender'];
		$message['avatar']  = $this->get_sender_avatar( $data['0']['sender'] );
		$message['subject'] = $data['0']['subject'];
		$message['body']	= $data['0']['message'];
		$message['date']	= $data['0']['date'];
	
		return $message;
		
	}
	
	/*
	 * Check to see if a user is a recipient of a message
	 * 
	 * @return boolean
	 */
	public function check_message_access($message_id, $username) {
	
		$result = $this->link->query("SELECT id FROM `" . $this->prefix . "inbox_messages`
										WHERE msg_id = '$message_id' AND (recipient = '$username' OR sender = '$username')
									");
		$total = $this->numRows( $result );
		if( $total == 0 ) {
			return false;
		} else {
			return true;
		}
		
	}
	
	/*
	 * Get all the responses to a message
	 * 
	 * @return array
	 */
	public function get_message_replies($message_id) {
		
		$replies = array();
		$message_id = $this->sanitize( $message_id );
		$data = $this->fetch("SELECT * FROM `" . $this->prefix . "inbox_replies`
								WHERE msg_id = '$message_id'
								ORDER BY date ASC
							");
		foreach( $data as $reply ) {
			$response['id']		 = $reply['id'];
			$response['sender']  = $reply['sender'];
			$response['message'] = $reply['message'];
			$response['date']	 = $reply['date'];
			$response['avatar']  = $this->get_sender_avatar( $reply['sender'] );
			array_push( $replies, $response );
		}
		return $replies;
		
	}
	
	/*
	 * Send a message to a new list of users
	 * 
	 * @return string
	 */
	public function send_message($subject, $message, $receiver, $sender) {
	
		$message = $this->link->real_escape_string($message);
		//store the original message
		$this->link->query("INSERT INTO `" . $this->prefix . "inbox_original` SET subject = '$subject',
							sender = '$sender', message = '$message'
						");
		//get the msg id
		$data = $this->fetch("SELECT id FROM `" . $this->prefix . "inbox_original`
								ORDER BY id DESC LIMIT 1
							");
		$msg_id = $data['0']['id'];
		$recipients = str_replace(" ", "", $receiver);
		$recipients_list = explode(",",$recipients);
		foreach($recipients_list as $recipient) {
			$this->link->query("INSERT INTO `" . $this->prefix . "inbox_messages`
								SET recipient = '$recipient', msg_id = '$msg_id', subject = '$subject',
								sender = '$sender'
							");
		
		}
		$this->success('Message has been sent');
		return;
		
	}

	/*
	 * Send a response to a message
	 * 
	 * @return string
	 */
	public function send_response($message_id, $message, $sender) {
		
		$message = $this->sanitize( $message );
		$this->link->query("INSERT INTO `" . $this->prefix . "inbox_replies`
							SET sender = '$sender', message = '$message', msg_id = '$message_id'
						");
		$this->link->query("UPDATE `" . $this->prefix . "inbox_messages`
							SET status = 'unread'
							WHERE msg_id = '$message_id'
						");
		$this->success('Reply has been sent');
		return;
	
	}

	/*
	 * Mark a message as read when a user views a message
	 * 
	 * @return
	 */
	public function mark_read($message_id, $recipient) {
	
		$this->link->query("UPDATE `" . $this->prefix . "inbox_messages` SET status = 'read'
							WHERE recipient = '$recipient' AND msg_id = '$message_id'
						");
		return;
			
	}
	
	/*
	 * Get a users avatar
	 * 
	 * @return string
	 */
	public function get_sender_avatar($username) {
		
		$username = $this->sanitize( $username );
		$data = $this->fetch("SELECT avatar FROM `" . $this->prefix . "users` WHERE username = '$username'");
		if( $data ) {
			return $data['0']['avatar'];
		} else {
			return;
		}
		
	}
	
}

?>