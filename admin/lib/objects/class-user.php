<?php 

class ezAdmin_User extends DB_Class {
	
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
				array_push( $users, $user );
			}
			return $users;
		} else {
			return;
		}
		
	}
		
}

?>