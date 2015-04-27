<?php 

class ezAdmin_User extends DB_Class {

	public function create_user($username, $first_name, $last_name, $email, $role, $team_id, $send_email) {

		$username 	= $this->sanitize( $username );
		$first_name = $this->sanitize( $first_name );
		$last_name  = $this->sanitize( $last_name );
		$role 		= $this->sanitize( $role );
		$team_id 	= $this->sanitize( $team_id );

		$check_data = $this->fetch("SELECT username, email 
									FROM `" . $this->prefix . "users` 
									WHERE (username = '$username') 
										OR (email = '$email')
								  ");
		if( count( $check_data ) > 0 ) {
			$this->error( 'Username or E-Mail is already in use' );
			return;
		} else {
			$random_password = $this->generate_random_password();
			$strength = '5';
			$salt = strtr(base64_encode(mcrypt_create_iv(16, MCRYPT_DEV_URANDOM)), '+', '.');
			$salt = sprintf("$2a$%02d$", $strength) . $salt;
			$hash = crypt($random_password, $salt);

			$this->link->query("INSERT INTO `" . $this->prefix . "users` 
								SET username = '$username', email = '$email', role = '$role', 
									first_name = '$first_name', last_name = '$last_name', 
									guild = '$team_id', salt = '$salt', hash = '$hash'
					");
			if( $send_email == 'yes' ) {
				$this->send_notification($username, $email, $random_password);
			} else {
				$this->success( 'Account has been created' );
			}
			return;
		}

	}

	public function generate_random_password($length = 10) {

		$characters = "abcdefghijklmnopqrstuxyvwzABCDEFGHIJKLMNOPQRSTUXYVWZ@!";
		$total = strlen($characters);

		$password = "";

		for ( $i = 0; $i < $length; $i++ ) {
			$index = mt_rand(0, $total - 1);
			$password .= $characters[$index];
		}

		return $password;

	}

	/*
	 * Send newly created user notification email
	 *
	 * @return string (success or error)
	 */
	public function send_notification($username, $email, $password) {

		$username 	= $this->sanitize( $username );
		$email 		= $this->sanitize( $email );

		$data = $this->fetch("SELECT mandrill_username, mandrill_password, site_url, site_name, site_email FROM `" . $this->prefix . "settings` WHERE id = '1'");

		if( $data ) {
			require_once "Mail.php";
			$mandrill_username 	= $data['0']['mandrill_username'];
			$mandrill_password 	= $data['0']['mandrill_password'];
			$site_url 			= $data['0']['site_url'];
			$site_name 			= $data['0']['site_name'];

			$name 		= $site_name . ' Accounts';
			$from 		= $data['0']['site_email'];
			$subject 	= $site_name . ' - New Account Creation';
			$to 		= $email;

			$message = '<html><body>';
			$message .= "Greetings <strong>$username</strong>, <p>A <em>$site_name account</em> has been created with this email address.</p>";
			$message .= '<table rules="all" style="border-color: #666;" cellpadding="10">';
			$message .= "<tr><td><strong>Username</strong> </td><td>" . $username . "</td></tr>";
			$message .= "<tr><td><strong>Password</strong> </td><td>" . $password . "</td></tr>";
			$message .= "<tr><td></td><td>Head to " . $site_url . " to login, and change your password.</td></tr>";
			$message .= "</table>";
			$message .= "</body></html>";
			if( class_exists( 'Mail' ) && ( $mandrill_username != '' && $mandrill_password != '' ) ) { 
				$host = "smtp.mandrillapp.com"; 
				$username = $mandrill_username; 
				$password = $mandrill_password;
				$headers = array ('From' => $from,   'To' => $to, 'MIME-Version' => '1.0', 'Content-Type' => 'text/html; charset=ISO-8859-1', 'Subject' => $subject); 
				$smtp = Mail::factory(
								'smtp',   
								array (
									'host' => $host,     
									'auth' => true,
									'port' => 587,     
									'username' => $username,     
									'password' => $password
									)
								);  
				$mail = $smtp->send($to, $headers, $message);  
				if (PEAR::isError($mail)) {   
					$this->error($mail->getMessage());  
				} else {   
					$this->success('Account created, and a notification email has been sent');  
				}
			} else {
				if( mail($to, $subject, $message, $headers) ) {
					$this->success('Account created, and a notification email has been sent');
				} else {
					$this->error('Account created, but there was a problem sending the notification email, please try again');
				}
			}
		}

		return;

	}
	
	public function get_user_settings($username) {
		
		$username	= $this->sanitize( $username );
		$data = $this->fetch("SELECT * FROM `" . $this->prefix . "users` WHERE username = '$username'");
		$settings = array(
				'id' 	=> $data['0']['id'],
				'email' => $data['0']['email']
		);
		return $settings;
		
	}
	
	/*
	 * Check if an admin exists
	 * 
	 * @return int
	 */
	public function check_admins() {
		
		$result = $this->link->query("SELECT id FROM `" . $this->prefix . "users` WHERE role = 'admin'");
		$count = 0;
		$count = $this->numRows( $result );
		return $count;
		
	}
	
	public function createAdmin($username, $password, $email) {
		
		$username 	= $this->sanitize( $username );
		$email 		= $this->sanitize( $email );
		$salt = strtr(base64_encode(mcrypt_create_iv(16, MCRYPT_DEV_URANDOM)), '+', '.');
		$salt = sprintf("$2a$%02d$", 5) . $salt;
		$hash = crypt($password, $salt);
	
		$result = $this->link->query("SELECT * FROM `" . $this->prefix . "users` WHERE (username = '$username') AND (role = 'admin')");
		$count = $this->numRows($result);
		if($count > 0) {
			echo "<strong>Error</strong> Username already exists";
		} else {
			$this->link->query("INSERT INTO `" . $this->prefix . "users` SET username = '$username', email = '$email', salt = '$salt',
					hash = '$hash', role = 'admin'
					");
			echo "<strong>Success!</strong> Account has been created. You may now login.";
		}
	
	}
	
	public function update_password($id, $password) {
		
		$id		= $this->sanitize( $id );
		$strength = '5';
		$salt = strtr(base64_encode(mcrypt_create_iv(16, MCRYPT_DEV_URANDOM)), '+', '.');
		//blowfish algorithm
		$salt = sprintf("$2a$%02d$", $strength) . $salt;
		$hash = crypt($password, $salt);

		$this->link->query("UPDATE `" . $this->prefix . "users` SET salt = '$salt', hash = '$hash'
							WHERE id = '$id'
						");
		$this->success('Password has been updated');
		return;

	}

	public function update_email($id, $email) {
		
		$id		= $this->sanitize( $id );
		$email	= $this->sanitize( $email );
		$this->link->query("UPDATE `" . $this->prefix . "users` SET email = '$email'
							WHERE id = '$id'
							");
		$this->success('E-Mail has been updated...reloading');
		return;
		
	}

	/*
	 * Get all site admins
	 * 
	 * @return array
	 */
	public function get_admins() {
		
		$admins = array();
		$data = $this->fetch("SELECT * FROM `" . $this->prefix . "users` WHERE role = 'admin'");
		if( $data ) {
			foreach( $data as $item ) {
				$user['id']			= $item['id'];
				$user['username'] 	= $item['username'];
				$user['email']		= $item['email'];
				$user['role']		= $item['role'];
				$user['date']		= $item['created'];
				array_push( $admins, $user );
			}
			return $admins;
		}
		
	}

	/*
	 * Get a list of all users
	 * 
	 * @return array
	 */
	public function get_users($position, $order_by, $order_text) {
		
		$users = array();
		$data = $this->fetch("SELECT * FROM `" . $this->prefix . "users` ORDER BY $order_by $order_text LIMIT $position, 15");
		if( $data ) {
			foreach( $data as $item ) {
				$user['id']			= $item['id'];
				$user['username'] 	= $item['username'];
				$user['email']		= $item['email'];
				$user['role']		= $item['role'];
				$user['date']		= $item['created'];
				$user['status']		= $item['status'];
				array_push( $users, $user );
			}
			return $users;
		} else {
			return;
		}

	}
	
	/*
	 * Count the total number of site users
	 * 
	 * @return int
	 */
	public function count_users() {
		
		$data = $this->fetch("SELECT id FROM `" . $this->prefix . "users`");
		$total = count( $data );
		return $total;
		
	}
	
	public function get_user($id) {
		
		$data = $this->fetch("SELECT t.id, t.username, t.email, t.guild, t.role, t.created, t.status, t.guild_name, t.guild_admin
					FROM (
					SELECT c1.id, c1.username, c1.email, c1.guild, c1.role, c1.created, c1.status, g1.id AS guild_id, g1.guild AS guild_name, g1.admin AS guild_admin
					FROM " . $this->prefix . "guilds g1
					JOIN " . $this->prefix . "users c1
					ON g1.id = c1.guild
			) t
					WHERE t.id = '$id'
					ORDER BY t.created DESC
					");
			if( empty( $data ) ) {
			$data = $this->fetch("SELECT * FROM `" . $this->prefix . "users` WHERE id = '$id'");
						
			$user = array(
							'id' 	   	 => $data['0']['id'],
							'username'	 => $data['0']['username'],
							'email'	   	 => $data['0']['email'],
							'guild_id'   => '',
							'role'	     => $data['0']['role'],
							'created'    => $data['0']['created'],
							'guild_name' => 'None',
							'status'     => $data['0']['status']
						);
			} else {
			$user = array(
							'id' 	   	  => $data['0']['id'],
							'username'	  => $data['0']['username'],
							'email'	   	  => $data['0']['email'],
							'guild_id'    => $data['0']['guild'],
							'role'	      => $data['0']['role'],
							'created'     => $data['0']['created'],
							'guild_name'  => $data['0']['guild_name'],
							'guild_admin' => $data['0']['guild_admin'],
							'status'      => $data['0']['status']
						);
			}
			return $user;
			
	}
	
	public function toggle_suspend_user($user_id, $status) {
		
		$user_id	= $this->sanitize( $user_id );
		$status		= $this->sanitize( $status );
		$this->link->query("UPDATE `" . $this->prefix . "users` SET status = '$status' WHERE id = '$user_id'");
		$this->success('User status has been updated...reloading');
		return;
		
	}

	public function toggle_user_role($user_id, $role) {
		
		$user_id	= $this->sanitize( $user_id );
		$role		= $this->sanitize( $role );
		$this->link->query("UPDATE `" . $this->prefix . "users` SET role = '$role' WHERE id = '$user_id'");
		$this->success('User role has been updated...reloading');
		return;
		
	}

	public function delete_user($user_id) {
		
		$user_id	= $this->sanitize( $user_id );
		$this->link->query("DELETE FROM `" . $this->prefix . "users` WHERE id = '$user_id'");
		$this->success('User account has been deleted...reloading');
		return;
		
	}
	
	/*
	 * Search based on username
	 * 
	 * @return array
	 */
	public function search_user($username) {
		
		$users = array();
		$username	= $this->sanitize( $username );
		$data = $this->fetch("SELECT * FROM `" . $this->prefix . "users` WHERE username LIKE '%$username%'");
		if( $data ) {
			foreach( $data as $item ) {
				$user['id']			= $item['id'];
				$user['username'] 	= $item['username'];
				$user['email']		= $item['email'];
				$user['role']		= $item['role'];
				$user['date']		= $item['created'];
				$user['status']		= $item['status'];
				array_push( $users, $user );
			}
			return $users;
		} else {
			return;
		}
		
	}
		
}

?>