<?php

class ezLeague extends DB_Class {
	
	/**
	 * Set up theme components
	 */
	public function setup_ezleague() {
	
		$this->require_files();

		$this->frontend = new ezLeague_Frontend();
		$this->news 	= new ezLeague_News();
		$this->team 	= new ezLeague_Team();
		$this->league 	= new ezLeague_League();
		$this->inbox	= new ezLeague_Inbox();
		$this->schedule = new ezLeague_Schedule();
	
	}
	
	/**
	 * Require files we need to load
	 */
	public function require_files() {
	
		require_once 'class-frontend.php';
		require_once 'class-schedule.php';
		require_once(dirname(__FILE__) . "/objects/class-news.php");
		require_once(dirname(__FILE__) . "/objects/class-user.php");
		require_once(dirname(__FILE__) . "/objects/class-team.php");
		require_once(dirname(__FILE__) . "/objects/class-inbox.php");
		require_once(dirname(__FILE__) . "/objects/class-league.php");
		
	}
	
	/**
	 * Check for an admin
	 */
	public function check_for_admin() {
		
		$data = $this->fetch("SELECT id FROM `" . $this->prefix . "users` WHERE role = 'admin'");
		if( $data ) {
			return;
		} else {
			header("Location: admin/install.php");
		}
		
	}
	
	/*
	 * Login User
	 */
	public function login($username, $password) {
		$saltData = $this->fetch("SELECT salt, hash, guild, role, status FROM `" . $this->prefix . "users` WHERE username = '$username'");
			$salt  	  = $saltData['0']['salt'];
			$hash  	  = $saltData['0']['hash'];
			$guild_id = $saltData['0']['guild'];
			$role  	  = $saltData['0']['role'];
			$status   = $saltData['0']['status'];
			 $hashCheck = crypt($password, $hash);
				  	
			  if($hashCheck === $hash) {
			  	 if($status == 1) { 
			  	 	print "Account suspended. Please contact the Admins";
			  	 	exit();
			  	 }
			  	$_SESSION['ez_username'] = $username;
			  	 if($role == 'admin') {
			  	 	$_SESSION['ez_admin'] = $username;
			  	 }
			  	 
			  	 if($guild_id != '') {
			  	 	$guild = $this->getUserGuild($guild_id);
			  	 	$_SESSION['ez_guild'] = $guild;
			  	 }
			 	 print "Logging in...";
			  } else {
			  	 print "Incorrect username or password";
			  }
	}
				  
	/*
	 * Create User
	 * strength - [1-10] strength of the salt
	 * salt and hash - each user has a unique salt combined with a hash
	 * the password is not stored
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
			print "<strong>Error</strong> Username or E-Mail already exists";
		} else {
			$this->link->query("INSERT INTO `" . $this->prefix . "users` SET username = '$username', email = '$email', salt = '$salt',
					hash = '$hash', role = 'user'
					");
			print "<strong>Success!</strong> Account has been created. You may now login.";
		}
	
	}

	public function forget_password_generator($email, $length) {
		$emailCheck = $this->fetch("SELECT email FROM `" . $this->prefix . "users`
				   				 	WHERE email = '$email'
						   		 ");

		if( count( $emailCheck ) > 0 ) {
		    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		    $randomString = '';
		    for ( $i = 0; $i < $length; $i++ ) {
		        $randomString .= $characters[ rand( 0, strlen( $characters ) - 1 ) ];
		    }
		    
		    $this->query("UPDATE `" . $this->prefix . "users`
		   				  SET forgot = '$randomString'
		   				  WHERE email = '$email'
				   		 ");

		    echo "<p><span style='color:green;font-weight:700;'>Success!</span> An e-mail has been sent with directions on how to reset your password.</p>";
			$from = 'reset@no-reply.net';
			$name = 'ezLeague Password Reset';
			$message = '
			<h3>Password Reset</h3>
			 <p>To complete the password reset process, please go here: <a href="' . $this->site_url . '/forget-password.php?code=' . $randomString . '">' . $this->site_url . '/forget-password.php?code=' . $randomString . '</a></p>
			 <small>If you did not request to have your password reset, please disregard this message.</small>
			';

			$this->frontend->send_message( $email, $from, $subject, $name, $message );

		} else {
			echo "<p><span style='color:red;font-weight:700;'>ERROR</span> The <em>e-mail address</em>, <strong>$email</strong>, does not exist in our records.</p>";
			echo "<a href='forget-password.php' class='btn btn-primary'>Forget Password Form</a>";

		}
	}

	function validate_password_code($code) {
		$validate_check = $this->fetch("SELECT id, email, forgot FROM `" . $this->prefix . "users`
				   				 	   WHERE forgot = '$code'
						   		 ");
		
		 if( count( $validate_check ) > 0 ) {
		 	$valid = array();
		 	$valid['id']	= $validate_check['0']['id'];
		 	$valid['email'] = $validate_check['0']['email'];
		 	$valid['code']	= $validate_check['0']['forgot'];
		 	return $valid;
		 } else {
		 	return false;
		 }
	}

	function reset_password($user_id, $newPassword) {
		$saltData = $this->fetch("SELECT salt, hash_string
								  FROM `" . $this->prefix . "users`
								  WHERE id = '$user_id'
								");

		$salt = $saltData['0']['salt'];
		$hash = $saltData['0']['hash_string'];

			  $cost = 5;
			  $salt = strtr(base64_encode(mcrypt_create_iv(16, MCRYPT_DEV_URANDOM)), '+', '.');
			  $salt = sprintf("$2a$%02d$", $cost) . $salt;
			  $hash = crypt($newPassword, $salt);
			   
			   $this->query("UPDATE `" . $this->prefix . "users`
			   				 SET salt = '$salt', hash_string = '$hash'
			   				 WHERE id = '$user_id'
			   			   ");

			   echo "<p><span style='color:green;font-weight:700;'>Success!</span> Your new password has been applied.</p>";
	}
	
	/*
	 * Get a friendly time difference between 2 dates
	 * 
	 * @return string
	 */
	public function dateDiff($time1, $time2, $precision = 6) {
		// If not numeric then convert texts to unix timestamps
		if (!is_int($time1)) {
			$time1 = strtotime($time1);
		}
		if (!is_int($time2)) {
			$time2 = strtotime($time2);
		}
	
		// If time1 is bigger than time2
		// Then swap time1 and time2
		if ($time1 > $time2) {
			$ttime = $time1;
			$time1 = $time2;
			$time2 = $ttime;
		}
	
		// Set up intervals and diffs arrays
		$intervals = array('year','month','day','hour','minute','second');
		$diffs = array();
	
		// Loop thru all intervals
		foreach ($intervals as $interval) {
			// Create temp time from time1 and interval
			$ttime = strtotime('+1 ' . $interval, $time1);
			// Set initial values
			$add = 1;
			$looped = 0;
			// Loop until temp time is smaller than time2
			while ($time2 >= $ttime) {
				// Create new temp time from time1 and interval
				$add++;
				$ttime = strtotime("+" . $add . " " . $interval, $time1);
				$looped++;
			}
	
			$time1 = strtotime("+" . $looped . " " . $interval, $time1);
			$diffs[$interval] = $looped;
		}
	
		$count = 0;
		$times = array();
		// Loop thru all diffs
		foreach ($diffs as $interval => $value) {
			// Break if we have needed precission
			if ($count >= $precision) {
				break;
			}
			// Add value and interval
			// if value is bigger than 0
			if ($value > 0) {
				// Add s if value is not 1
				if ($value != 1) {
					$interval .= "s";
				}
				// Add value and interval to times array
				$times[] = $value . " " . $interval;
				$count++;
			}
		}
	
		// Return string with times
		return implode(", ", $times);
	}
	
}
	
?>