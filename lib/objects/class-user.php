<?php 

class ezLeague_User extends DB_Class {
	
	/*
	 * Login the user
	 * 
	 */
	public function login($username, $password) {

		$saltData = $this->fetch("SELECT salt, hash, guild, role, status FROM `" . $this->prefix . "users` WHERE username = '$username'");
		$salt  	  = $saltData['0']['salt'];
		$hash  	  = $saltData['0']['hash'];
		$guild_id = $saltData['0']['guild'];
		$role  	  = $saltData['0']['role'];
		$status   = $saltData['0']['status'];
		$hashCheck = crypt($password, $hash);
			
		if( $hashCheck === $hash ) {
			if( $status == 1 ) {
				print "Account suspended. Please contact the Admins";
				return;
			}
			
			$_SESSION['ez_username'] = trim( $username );
		
			print "Logging in...";
		} else {
			print "Incorrect username or password";
		}

	}
	
	/*
	 * User registration
	 * 
	 * @return string (success or error)
	 */
	public function register($username, $password, $email) {

		$strength = '5';
		$salt = strtr(base64_encode(mcrypt_create_iv(16, MCRYPT_DEV_URANDOM)), '+', '.');
		//blowfish algorithm
		$salt = sprintf("$2a$%02d$", $strength) . $salt;
		$hash = crypt($password, $salt);
		//check to make sure this username or email does not already exist
		$result = $this->link->query("SELECT * FROM `" . $this->prefix . "users` WHERE (username = '$username') OR (email = '$email')");
		$count = $this->numRows($result);
		if($count > 0) {
			$this->error('Username or E-Mail already exists');
		} else {
			$this->link->query("INSERT INTO `" . $this->prefix . "users` SET username = '$username', email = '$email', salt = '$salt',
					hash = '$hash', role = 'user'
					");
			$this->success('Account has been created. You may now login.');
		}
		return;
	
	}
		
	/*
	 * Change user password
	 * 
	 * @return string (success or error)
	 */
	public function update_password($password, $user_id) {
		
		$strength = '5';
		$salt = strtr(base64_encode(mcrypt_create_iv(16, MCRYPT_DEV_URANDOM)), '+', '.');
		//blowfish algorithm
		$salt = sprintf("$2a$%02d$", $strength) . $salt;
		$hash = crypt($password, $salt);
		$this->link->query("UPDATE `" . $this->prefix . "users` SET salt = '$salt', hash = '$hash'
				WHERE id = '$user_id'
				");
		$this->success('Password has been updated');
		return;
		
	}

	/*
	 * Reset user forgotten password
	 *
	 * @return string (success or error)
	 */
	public function forgot_password($username, $email) {

		$username 	= $this->sanitize( $username );
		$email 		= $this->sanitize( $email );
		$reset 		= false;

		$password_string = md5(mt_rand());

		if( ! empty ( $username ) ) {
			$data = $this->fetch(" SELECT email, id FROM `" . $this->prefix . "users` WHERE username = '$username'");
			if( $data ) {
				$user_id 	= $data['0']['id'];
				$email 		= $data['0']['email'];
				$this->link->query("UPDATE `" . $this->prefix . "users` SET forget = '$password_string' WHERE id = '$user_id'");
				$reset = true;
			}
		} elseif( ! empty ( $email ) ) {
			$data = $this->fetch(" SELECT email, username, id FROM `" . $this->prefix . "users` WHERE email = '$email'");
			if( $data ) {
				$user_id 	= $data['0']['id'];
				$email 		= $data['0']['email'];
				$username 	= $data['0']['username'];
				$this->link->query("UPDATE `" . $this->prefix . "users` SET forget = '$password_string' WHERE id = '$user_id'");
				$reset = true;
			}
		} else {
			echo '<strong>Error</strong> No account matched that <em>username</em> or <em>email address</em>';
			return;
		}

		if( $reset ) {
			$data = $this->fetch("SELECT mandrill_username, mandrill_password, site_url, site_name, site_email FROM `" . $this->prefix . "settings` WHERE id = '1'");

			if( $data ) {
				require_once "Mail.php";
				$mandrill_username 	= $data['0']['mandrill_username'];
				$mandrill_password 	= $data['0']['mandrill_password'];
				$site_url 			= $data['0']['site_url'];
				$site_name 			= $data['0']['site_name'];

				$name 		= $site_name . ' Accounts';
				$from 		= $data['0']['site_email'];
				$subject 	= $site_name . ' - Password Reset';
				$to 		= $email;

				$message = '<html><body>';
				$message .= "Greetings <strong>$username</strong>, <p>A <em>reset password</em> request was made for your account. If you did not make the request, please disregard this email. Otherwise, use the link below to reset the password for your account.</p>";
				$message .= 'Reset Password Link: <a href="' . $site_url . '/forgot-password.php?reset=' . $password_string . '">' . $site_url . '/forgot-password.php?reset=' . $password_string . '</a>';
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
						echo("<p>" . $mail->getMessage() . "</p>");  
					} else {   
						echo("<strong>Success!</strong> An email with password reset instructions has been sent.");  
					}
				} else {
					if( mail($to, $subject, $message, $headers) ) {
						$this->success('<strong>Success!</strong> An email with password reset instructions has been sent.');
					} else {
						$this->error('There was a problem sending your password reset email, please try again');
					}
				}
			}
		}

		return;

	}

	/*
	 * Get user id based on reset password code
	 *
	 * @return array
	 */
	public function get_user_by_reset_code($reset_code) {
		
		$reset_code = $this->sanitize( $reset_code );
		$user = array();
		$data = $this->fetch("SELECT id, username FROM `" . $this->prefix . "users` WHERE forget = '$reset_code'");
		if( $data ) {
			$user_id 	= $data['0']['id'];
			$username 	= $data['0']['username'];
			$user['user_id'] 	= $user_id;
			$user['username'] 	= $username;
			return $user;
		} else {
			return;
		}

	}
	
	/*
	 * Get user profile
	 * 
	 * @return array
	 */	
	public function get_user( $username ) {
		
		$profile = array();
		$team_admin = false;
		$data = $this->fetch("SELECT * FROM `" . $this->prefix . "users` WHERE username = '$username'");
		if( $data ) { 
			if( $data['0']['guild'] != '' ) {
				$admin = $this->get_team_admin( $data['0']['guild'] );
				if( $admin == $username ) {
					$team_admin = true;
				} else {
					$team_admin = false;
				}
			}
			$profile = array(
							'id'		=> $data['0']['id'],
							'username'  => $data['0']['username'],
							'email'		=> $data['0']['email'],
							'guild_id'  => $data['0']['guild'],
							'team_admin'=> $team_admin,
							'role'		=> $data['0']['role'],
							'created'	=> $data['0']['created'],
							'post_count'=> $data['0']['post_count'],
							'signature' => $data['0']['signature'],
							'first'		=> $data['0']['first_name'],
							'last'		=> $data['0']['last_name'],
							'website'	=> $data['0']['website'],
							'bio'		=> $data['0']['bio'],
							'occupation'=> $data['0']['occupation'],
							'hobbies'	=> $data['0']['hobbies'],
							'location'	=> $data['0']['location'],
							'avatar'	=> $data['0']['avatar'],
							'friends'	=> $data['0']['friends']
							);
			
			return $profile;
		} else {
			return;
		}
		
	}
	
	/*
	 * Get team admin
	 * 
	 * @return boolean
	 */
	public function get_team_admin($team_id) {
		
		$data = $this->fetch("SELECT admin FROM `" . $this->prefix . "guilds` WHERE id = '$team_id'");
		if( $data ) { 
			return $data['0']['admin'];
		} else {
			return;
		}
		
	}
	
	/*
	 * Get a user profile by id
	 * 
	 * @return array
	 */
	public function get_user_profile( $user_id ) {
	
		$profile = array();
		$data = $this->fetch("SELECT * FROM `" . $this->prefix . "users` WHERE id = '$user_id'");
	
		$profile = array(
						'id'		=> $data['0']['id'],
						'username'  => $data['0']['username'],
						'email'		=> $data['0']['email'],
						'guild_id'  => $data['0']['guild'],
						'role'		=> $data['0']['role'],
						'created'	=> $data['0']['created'],
						'post_count'=> $data['0']['post_count'],
						'signature' => $data['0']['signature'],
						'first'		=> $data['0']['first_name'],
						'last'		=> $data['0']['last_name'],
						'website'	=> $data['0']['website'],
						'bio'		=> $data['0']['bio'],
						'occupation'=> $data['0']['occupation'],
						'hobbies'	=> $data['0']['hobbies'],
						'location'	=> $data['0']['location'],
						'avatar'	=> $data['0']['avatar']
				);
	
		return $profile;
	
	}
	
	/*
	 * Update user profile
	 * 
	 * @return string (success or error)
	 */
	public function update_profile($first_name, $last_name, $email, $website, $bio, $hobbies, $location, $occupation, $signature, $user_id) {
		
		$first_name = $this->sanitize( $first_name );
		$last_name  = $this->sanitize( $last_name );
		$email		= $this->sanitize( $email );
		$website	= $this->sanitize( $website );
		$bio		= $this->sanitize( $bio );
		$hobbies	= $this->sanitize( $hobbies );
		$location	= $this->sanitize( $location );
		$occupation	= $this->sanitize( $occupation );
		$signature	= $this->sanitize( $signature );

		$this->link->query("UPDATE `" . $this->prefix . "users` SET first_name = '$first_name', last_name = '$last_name',
							email = '$email', website = '$website', bio = '$bio', hobbies = '$hobbies', location = '$location',
				 			occupation = '$occupation', signature = '$signature'
							WHERE id = '$user_id'
						");
			$this->success('User profile updated');
		
		return;
		
	}
	
	/*
	 * Update user avatar
	 * 
	 * @return
	 */
	public function update_avatar($filename, $user_id) {
		
		$filename = $this->sanitize( $filename );
		$this->link->query("UPDATE `" . $this->prefix . "users` SET avatar = '$filename' WHERE id = '$user_id'");
		return;
		
	}
	
	/*
	 * Remove the current avatar
	 * 
	 * @return string
	 */
	public function remove_avatar($user_id) {
		
		$this->link->query("UPDATE `" . $this->prefix . "users` SET avatar = '' WHERE id = '$user_id'");
		$this->success('Avatar has been removed');
		return;
		
	}
	
	/*
	 * Get a users avatar
	 * 
	 * @return string
	 */
	public function get_user_avatar($user_id) {
		
		$data = $this->fetch("SELECT avatar FROM `" . $this->prefix . "users` WHERE id = '$user_id'");
		if( $data ) {
			$avatar = $data['0']['avatar'];
			return $avatar;
		} else {
			return false;
		}
		
	}
	
	/*
	 * Get user team invites
	 * 
	 * @return array
	 */
	public function get_team_invites($user_id) {
		
		$invites = array();
		$data = $this->fetch("SELECT invites FROM `" . $this->prefix . "users` WHERE id = '$user_id'");
		if( $data['0']['invites'] != '' ) {
			$teams = explode( ',', $data['0']['invites'] );
			foreach( $teams as $team ) {
				$name = $this->fetch("SELECT guild FROM `" . $this->prefix . "guilds` WHERE id = '$team'");
				$team_profile['id'] = $team;
				$team_profile['team'] = $name['0']['guild'];
				array_push($invites, $team_profile);
			}
			return $invites;
		} else {
			return;
		}
		
	}
	
	public function get_team_invites_id($user_id) {
	
		$invites = array();
		$data = $this->fetch("SELECT invites FROM `" . $this->prefix . "users` WHERE id = '$user_id'");
		if( $data ) {
			return $data['0']['invites'];
		} else {
			return;
		}
	
	}
	
	/*
	 * Send user a team invite
	 *
	 * @return string
	 */
	public function send_team_invite($team_id, $user_id) {
	
		$invites = $this->get_team_invites_id($user_id);
		if( $invites == '' ) {
			$invites = $team_id;
		} else {
			$invites = $team_id . ',' . $invites;
		}
		$this->link->query("UPDATE `" . $this->prefix . "users` SET invites = '$invites' WHERE id = '$user_id'");
		$this->success('Invite has been sent');
		return;
		
	}
	
	/*
	 * Accept a join team invite
	 * 
	 * @return string
	 */
	public function accept_team_invite($team_id, $user_id) {
		
		$team_id = $this->sanitize( $team_id );
		$user_id = $this->sanitize( $user_id );
		$this->link->query("UPDATE `" . $this->prefix . "users` SET guild = '$team_id', invites = '' WHERE id = '$user_id'");
		$this->success('Congratulations, you have joined the team');
		return;
		
	}
	
	/*
	 * Get user team name
	 * 
	 * @return string
	 */
	public function get_user_team($team_id) {
		
		$data = $this->fetch("SELECT guild FROM `" . $this->prefix . "guilds` WHERE id = '$team_id'");
		if( $data ) {
			return $data['0']['guild'];
		} else {
			echo 'No Team';
		}
		
	}
	
	/*
	 * Leave a team
	 * 
	 * @return string
	 */
	public function leave_team($user_id) {
		
		$result = $this->link->query("UPDATE `" . $this->users . "users` SET guild = '' WHERE id = '$user_id'");
		if( $result ) {
			$this->success('You have successfully left the team');
		} else {
			$this->error('There was an error trying to leave the team');
		}
		
		return;
		
	}
	
	/*
	 * Add user as friend
	 * 
	 * @return string
	 */
	public function add_friend($friend_id, $user_id) {
		
		$friend_id = $this->sanitize( $friend_id );
		$user_id   = $this->sanitize( $user_id );
		$friend_list = $this->get_friends( $user_id );
		if( empty( $friend_list ) ) {
			$friend_list[] = $friend_id;
		} else {
			$friend_list = (array) json_decode($friend_list, TRUE);
			array_push($friend_list, $friend_id);
		}

		$friend_list = json_encode($friend_list);

		$this->update_friend_list($friend_list, $user_id);
		$this->success('User has been added to your friend list');
		return;
		
	}
	
	/*
	 * Remove user as friend
	 * 
	 * @return string
	 */
	public function remove_friend($friend_id, $user_id) {
		
		$friend_id = $this->sanitize( $friend_id );
		$user_id   = $this->sanitize( $user_id );
		$friend_list = $this->get_friends( $user_id );
		$friend_list = (array) json_decode($friend_list, TRUE);
		
		if(($key = array_search($friend_id, $friend_list)) !== false) {
			unset($friend_list[$key]);
		}
		
		$updated_list = json_encode($friend_list);
		$this->update_friend_list($updated_list, $user_id);
		$this->success('User has been removed from friend list');
		return;
		
	}
	
	/*
	 * Update users friend list
	 */
	public function update_friend_list($friend_list, $user_id) {
		
		$this->link->query("UPDATE `" . $this->prefix . "users` SET friends = '$friend_list' WHERE id = '$user_id'");
		return;
	}
	
	/*
	 * Get a users friend list
	 * 
	 * @return array
	 */
	public function get_friends($user_id) {
		
		$user_id = $this->sanitize( $user_id );
		$data = $this->fetch("SELECT friends FROM `" . $this->prefix . "users` WHERE id = '$user_id'");
		$friends = $data['0']['friends'];
		return $friends;
		
	}
	
	/*
	 * Get a users friend list for profile settings page
	 * 
	 * @return array
	 */
	public function get_friend_list($user_id) {
	
		$friend_list = array();
		$user_id = $this->sanitize( $user_id );
		$data = $this->fetch("SELECT friends FROM `" . $this->prefix . "users` WHERE id = '$user_id'");
		$friends = $data['0']['friends'];
		$friends = (array) json_decode( $friends, TRUE );
		foreach( $friends as $friend ) {
			$friend_profile = $this->get_user_profile( $friend );
			$profile['username'] = $friend_profile['username'];
			$profile['id']		 = $friend_profile['id'];
			$profile['email']	 = $friend_profile['email'];
			array_push( $friend_list, $profile );
		}
		return $friend_list;
	
	}
	
	/*
	 * Check if friend
	 * 
	 * @return boolean
	 */
	public function check_friend($friend_id, $user_id) {
		
		$friend_id = $this->sanitize( $friend_id );
		$user_id   = $this->sanitize( $user_id );
		$friends   = $this->get_friends( $user_id );
		$friend_list = (array) json_decode($friends, TRUE);
		if( in_array( $friend_id, $friend_list ) ) {
			return true;
		} else {
			return false;
		}
		
	}

	/*
	 * Get a users email name up to @
	 *
	 * @return string
	 */
	public function get_email_name ($email) {

		$email = $this->sanitize( $email );
        return substr($email, 0, strpos($email, '@' ) );

    }
	
}

?>