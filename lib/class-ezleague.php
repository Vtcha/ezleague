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