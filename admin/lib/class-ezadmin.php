<?php
	
class ezAdmin extends DB_Class {
		
	/*
	 * Set up theme components
	 */
	public function setup_ezadmin() {
	
		$this->require_files();
		$this->frontend = new ezAdmin_Frontend();
		$this->news 	= new ezAdmin_News();
		$this->team 	= new ezAdmin_Team();
		$this->league 	= new ezAdmin_League();
		$this->matches	= new ezAdmin_Match();
		$this->settings = new ezAdmin_Settings();
		$this->forum	= new ezAdmin_Forum();
		$this->schedule = new ezAdmin_Schedule();
	
	}
	
	/*
	 * Require files we need to load
	 */
	public function require_files() {
	
		require_once dirname( __FILE__ ) . '/class-frontend.php';
		require_once dirname( __FILE__ ) . '/class-schedule.php';
		require_once dirname( __FILE__ ) . '/objects/class-news.php';
		require_once dirname( __FILE__ ) . '/objects/class-user.php';
		require_once dirname( __FILE__ ) . '/objects/class-team.php';
		require_once dirname( __FILE__ ) . '/objects/class-league.php';
		require_once dirname( __FILE__ ) . '/objects/class-match.php';
		require_once dirname( __FILE__ ) . '/objects/class-settings.php';
		require_once dirname( __FILE__ ) . '/objects/class-forum.php';
		
	}
	
	/*
	 * Login User
	 */
	public function login($username, $password) {
		$saltData = $this->fetch("SELECT salt, hash, guild, role, status FROM `" . $this->prefix . "users` 
									WHERE (username = '$username') AND (role = 'admin')
								");
			$salt  	  = $saltData['0']['salt'];
			$hash  	  = $saltData['0']['hash'];
			$guild_id = $saltData['0']['guild'];
			$role  	  = $saltData['0']['role'];
			$status   = $saltData['0']['status'];
			 $hashCheck = crypt($password, $hash);
				  	
			  if( $hashCheck === $hash ) {
			  	 if( $status == 1 ) { 
			  	 	$this->error('Account suspended. Please contact the Admins');
			  	 	exit();
			  	 }

			  	 $_SESSION['ez_admin'] = $username;

			 	 $this->success('Logging in...');
			  } else {
			  	 $this->error('Incorrect username or password');
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
			$this->success('Account has been created. You may now login.');
		}
	
	}
	
	/*
	 * Run the installation and create all necessary tables
	 * 
	 * @return string
	 */
	public function run_installer($site_name) {
		
		$test_connection = mysqli_connect($this->host, $this->username, $this->password, $this->database) or die("Error " . mysqli_error( $test_connection ) );
		if( $test_connection ) {
			$salt = '$2a$05$Bs3HEiQG6G9PZHkY.Ay3Cg==';

			$hash = '$2a$05$Bs3HEiQG6G9PZHkY.Ay3CeE1lBUiLRSiRSl57pmRs61C8GWsKAt6G';
			$sql = "
			DROP TABLE IF EXISTS `" . $this->prefix . "comments`;
			CREATE TABLE `comments` (
			  `id` int(10) NOT NULL AUTO_INCREMENT,
			  `post_id` int(10) DEFAULT NULL,
			  `author` varchar(100) DEFAULT NULL,
			  `author_id` int(10) DEFAULT NULL,
			  `comment` varchar(10000) DEFAULT NULL,
			  `created` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
			  PRIMARY KEY (`id`)
			); 
			DROP TABLE IF EXISTS `" . $this->prefix . "disputes`;
			CREATE TABLE `" . $this->prefix . "disputes` (
			  `id` int(10) NOT NULL AUTO_INCREMENT,
			  `match_id` int(10) DEFAULT NULL,
			  `category` varchar(20) DEFAULT NULL,
			  `description` varchar(2000) DEFAULT NULL,
			  `filed_by` varchar(100) DEFAULT NULL,
			  `status` int(1) DEFAULT '0',
			  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
			  PRIMARY KEY (`id`)
			); 
			DROP TABLE IF EXISTS `" . $this->prefix . "forum_answer`;
			CREATE TABLE `" . $this->prefix . "forum_answer` (
			  `a_id` int(10) NOT NULL AUTO_INCREMENT,
			  `question_id` int(10) NOT NULL,
			  `a_answer` longtext NOT NULL,
			  `a_datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
			  `a_section` int(10) NOT NULL,
			  `a_username` varchar(55) NOT NULL,
			  `a_user_id` int(10) NOT NULL,
			  PRIMARY KEY (`a_id`)
			);
			DROP TABLE IF EXISTS `" . $this->prefix . "forum_question`;
			CREATE TABLE `" . $this->prefix . "forum_question` (
			  `id` int(10) NOT NULL AUTO_INCREMENT,
			  `topic` varchar(255) NOT NULL,
			  `detail` longtext NOT NULL,
			  `datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
			  `view` int(4) NOT NULL DEFAULT '0',
			  `reply` int(4) NOT NULL DEFAULT '0',
			  `section` int(10) NOT NULL,
			  `starter_user_id` int(10) NOT NULL,
			  `starter_username` varchar(55) NOT NULL,
			  `recent_username` varchar(55) NOT NULL,
			  `recent_user_id` int(10) NOT NULL,
			  `recent_modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
			  PRIMARY KEY (`id`)
			);
			DROP TABLE IF EXISTS `" . $this->prefix . "forum_section`;
			CREATE TABLE `" . $this->prefix . "forum_section` (
			  `id` int(10) NOT NULL AUTO_INCREMENT,
			  `section_name` varchar(50) NOT NULL,
			  `type` varchar(25) NOT NULL DEFAULT 'public',
			  `status` varchar(50) DEFAULT 'enabled',
			  PRIMARY KEY (`id`)
			);
			DROP TABLE IF EXISTS `" . $this->prefix . "games`;
			CREATE TABLE `" . $this->prefix . "games` (
			  `id` int(10) NOT NULL AUTO_INCREMENT,
			  `game` varchar(100) DEFAULT NULL,
			  `short_name` varchar(5) DEFAULT NULL,
			  `slug` varchar(50) NOT NULL,
			  `logo` varchar(100) DEFAULT NULL,
			  PRIMARY KEY (`id`)
			);
			DROP TABLE IF EXISTS `" . $this->prefix . "guilds`;
			CREATE TABLE `" . $this->prefix . "guilds` (
			  `id` int(10) NOT NULL AUTO_INCREMENT,
			  `guild` varchar(50) DEFAULT NULL,
			  `abbreviation` varchar(5) DEFAULT NULL,
			  `gm` varchar(50) DEFAULT NULL,
			  `agm` varchar(50) DEFAULT NULL,
			  `website` varchar(100) DEFAULT NULL,
			  `password` varchar(45) DEFAULT NULL,
			  `admin` varchar(50) NOT NULL,
			  `game` varchar(25) DEFAULT NULL,
			  `leagues` varchar(50) DEFAULT NULL,
			  `logo` varchar(250) DEFAULT NULL,
			  PRIMARY KEY (`id`,`admin`)
			);
			DROP TABLE IF EXISTS `" . $this->prefix . "inbox_messages`;
			CREATE TABLE `" . $this->prefix . "inbox_messages` (
			  `id` int(10) NOT NULL AUTO_INCREMENT,
			  `msg_id` int(10) NOT NULL,
			  `sender` varchar(100) DEFAULT NULL,
			  `recipient` varchar(250) DEFAULT NULL,
			  `subject` varchar(250) DEFAULT NULL,
			  `status` varchar(10) DEFAULT 'unread',
			  `date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
			  PRIMARY KEY (`id`)
			);
			DROP TABLE IF EXISTS `" . $this->prefix . "inbox_original`;
			CREATE TABLE `" . $this->prefix . "inbox_original` (
			  `id` int(10) NOT NULL AUTO_INCREMENT,
			  `sender` varchar(50) DEFAULT NULL,
			  `subject` varchar(250) DEFAULT NULL,
			  `message` blob,
			  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
			  PRIMARY KEY (`id`)
			);
			DROP TABLE IF EXISTS `" . $this->prefix . "inbox_replies`;
			CREATE TABLE `" . $this->prefix . "inbox_replies` (
			  `id` int(10) NOT NULL AUTO_INCREMENT,
			  `msg_id` int(10) DEFAULT NULL,
			  `sender` varchar(50) DEFAULT NULL,
			  `message` blob,
			  `date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
			  PRIMARY KEY (`id`)
			);
			DROP TABLE IF EXISTS `" . $this->prefix . "leagues`;
			CREATE TABLE `" . $this->prefix . "leagues` (
			  `id` int(10) NOT NULL AUTO_INCREMENT,
			  `league` varchar(50) DEFAULT NULL,
			  `teams` int(19) DEFAULT '6',
			  `game` varchar(50) DEFAULT NULL,
			  `open` int(1) DEFAULT '1',
			  `start_date` date DEFAULT NULL,
			  `end_date` date DEFAULT NULL,
			  `total_games` int(10) DEFAULT '8',
			  `rules` varchar(10000) DEFAULT NULL,
			  `rosters` int(1) DEFAULT '1',
			  PRIMARY KEY (`id`)
			);
			DROP TABLE IF EXISTS `" . $this->prefix . "links`;
			CREATE TABLE `" . $this->prefix . "links` (
			  `id` int(10) NOT NULL AUTO_INCREMENT,
			  `url` varchar(500) DEFAULT NULL,
			  `text` varchar(250) DEFAULT NULL,
			  PRIMARY KEY (`id`)
			);
			DROP TABLE IF EXISTS `" . $this->prefix . "map_schedule`;
			CREATE TABLE `" . $this->prefix . "map_schedule` (
			  `id` int(10) NOT NULL AUTO_INCREMENT,
			  `map` varchar(250) DEFAULT NULL,
			  `week` int(10) DEFAULT NULL,
			  `league` int(10) DEFAULT NULL,
			  PRIMARY KEY (`id`)
			);
			DROP TABLE IF EXISTS `" . $this->prefix . "maps`;
			CREATE TABLE `" . $this->prefix . "maps` (
			  `id` int(10) NOT NULL AUTO_INCREMENT,
			  `map` varchar(250) DEFAULT NULL,
			  `league` int(10) DEFAULT NULL,
			  PRIMARY KEY (`id`)
			);
			DROP TABLE IF EXISTS `" . $this->prefix . "matches`;
			CREATE TABLE `" . $this->prefix . "matches` (
			  `id` int(10) NOT NULL AUTO_INCREMENT,
			  `league` int(10) DEFAULT NULL,
			  `homeTeam` varchar(50) DEFAULT NULL,
			  `homeTeamID` int(10) DEFAULT NULL,
			  `homeTeam_accept` int(1) DEFAULT '0',
			  `homeScore` int(10) DEFAULT NULL,
			  `awayTeam` varchar(50) DEFAULT NULL,
			  `awayTeamID` int(10) DEFAULT NULL,
			  `awayTeam_accept` int(1) DEFAULT '0',
			  `awayScore` int(10) DEFAULT NULL,
			  `winner` int(10) DEFAULT NULL,
			  `loser` int(10) DEFAULT NULL,
			  `season` varchar(20) DEFAULT NULL,
			  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
			  `chat_log` blob,
			  `matchDate` date DEFAULT NULL,
			  `matchTime` varchar(30) DEFAULT NULL,
			  `matchZone` varchar(5) DEFAULT NULL,
			  `completed` int(1) DEFAULT '0',
			  `week` int(10) DEFAULT NULL,
			  `streamURL` varchar(200) DEFAULT NULL,
			  `featured` int(1) DEFAULT '0',
			  `reporter` varchar(50) DEFAULT NULL,
			  PRIMARY KEY (`id`)
			);
			DROP TABLE IF EXISTS `" . $this->prefix . "news`;
			CREATE TABLE `" . $this->prefix . "news` (
			  `id` int(10) NOT NULL AUTO_INCREMENT,
			  `title` varchar(255) DEFAULT NULL,
			  `body` varchar(5000) DEFAULT NULL,
			  `author` varchar(50) DEFAULT NULL,
			  `category` varchar(50) DEFAULT NULL,
			  `media` int(10) DEFAULT NULL,
			  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
			  `published` int(1) DEFAULT '0',
			  `game` varchar(25) DEFAULT NULL,
			  PRIMARY KEY (`id`)
			);
			DROP TABLE IF EXISTS `" . $this->prefix . "news_category`;
			CREATE TABLE `" . $this->prefix . "news_category` (
			  `id` int(10) NOT NULL AUTO_INCREMENT,
			  `category` varchar(50) DEFAULT NULL,
			  PRIMARY KEY (`id`)
			);
			DROP TABLE IF EXISTS `" . $this->prefix . "news_media`;
			CREATE TABLE `" . $this->prefix . "news_media` (
			  `id` int(10) NOT NULL AUTO_INCREMENT,
			  `filename` varchar(100) DEFAULT NULL,
			  `created` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
			  PRIMARY KEY (`id`)
			);
			DROP TABLE IF EXISTS `" . $this->prefix . "predictions`;
			CREATE TABLE `" . $this->prefix . "predictions` (
			  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
			  `cid` int(10) DEFAULT NULL,
			  `team` int(10) DEFAULT NULL,
			  `comment` varchar(500) DEFAULT NULL,
			  `user` varchar(50) DEFAULT NULL,
			  `date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
			  PRIMARY KEY (`id`)
			);
			DROP TABLE IF EXISTS `" . $this->prefix . "results`;
			CREATE TABLE `" . $this->prefix . "results` (
			  `id` int(10) NOT NULL AUTO_INCREMENT,
			  `guild_id` int(10) NOT NULL,
			  `league_id` int(10) NOT NULL,
			  `result` varchar(1) NOT NULL,
			  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
			  `challenge_id` int(10) DEFAULT NULL,
			  `points_given` int(10) DEFAULT '0',
			  PRIMARY KEY (`id`)
			);
			DROP TABLE IF EXISTS `" . $this->prefix . "rosters`;
			CREATE TABLE `" . $this->prefix . "rosters` (
			  `id` int(10) NOT NULL AUTO_INCREMENT,
			  `league` int(10) DEFAULT NULL,
			  `team` int(10) DEFAULT NULL,
			  `roster` blob,
			  PRIMARY KEY (`id`)
			);
			DROP TABLE IF EXISTS `" . $this->prefix . "screenshots`;
			CREATE TABLE `" . $this->prefix . "screenshots` (
			  `id` int(10) NOT NULL AUTO_INCREMENT,
			  `filename` varchar(255) NOT NULL,
			  `match_id` int(10) NOT NULL,
			  `uploader` varchar(55) NOT NULL,
			  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
			  PRIMARY KEY (`id`)
			);
			DROP TABLE IF EXISTS `" . $this->prefix . "seasons`;
			CREATE TABLE `" . $this->prefix . "seasons` (
			  `id` int(10) NOT NULL AUTO_INCREMENT,
			  `league_id` int(10) DEFAULT NULL,
			  `season` varchar(100) DEFAULT NULL,
			  `teams` blob,
			  `start` date DEFAULT NULL,
			  `end` date DEFAULT NULL,
			  `register_end` date DEFAULT NULL,
			  `created` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
			  PRIMARY KEY (`id`)
			);
			DROP TABLE IF EXISTS `" . $this->prefix . "settings`;
			CREATE TABLE `" . $this->prefix . "settings` (
			  `id` int(1) NOT NULL DEFAULT '1',
			  `site_name` varchar(100) DEFAULT NULL,
			  `site_url` varchar(255) DEFAULT NULL,
			  `site_about` blob,
			  `site_email` varchar(500) DEFAULT NULL,
			  `site_logo` varchar(250) DEFAULT 'logo.png',
			  `site_fav_icon` varchar(250) DEFAULT NULL,
			  `site_games` varchar(10000) DEFAULT NULL,
			  `site_twitter_handle` varchar(100) DEFAULT NULL,
			  `site_twitter_app` varchar(3000) DEFAULT NULL,
			  `site_facebook` varchar(100) DEFAULT NULL,
			  `site_google_plus` varchar(100) DEFAULT NULL,
			  `site_youtube` varchar(200) DEFAULT NULL,
			  `twitter_count` int(10) DEFAULT NULL,
			  `twitter_api` varchar(250) DEFAULT NULL,
			  `twitter_secret` varchar(250) DEFAULT NULL,
			  `twitter_token` varchar(250) DEFAULT NULL,
			  `twitter_token_secret` varchar(250) DEFAULT NULL,
			  `site_fav_icon` varchar(250) DEFAULT NULL,
			  PRIMARY KEY (`id`)
			);
			INSERT INTO `" . $this->prefix . "settings` SET site_name = '$site_name', site_url = '$this->site_url';
			DROP TABLE IF EXISTS `" . $this->prefix . "users`;
			CREATE TABLE `" . $this->prefix . "users` (
			  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
			  `username` varchar(50) DEFAULT NULL,
			  `first_name` varchar(250) DEFAULT NULL,
			  `last_name` varchar(250) DEFAULT NULL,
			  `email` varchar(150) DEFAULT NULL,
			  `guild` varchar(100) DEFAULT NULL,
			  `role` varchar(20) DEFAULT NULL,
			  `created` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
			  `modified` timestamp NULL DEFAULT NULL,
			  `salt` varchar(100) DEFAULT NULL,
			  `hash` varchar(100) DEFAULT NULL,
			  `status` int(1) DEFAULT '0',
			  `forget` varchar(250) DEFAULT NULL,
			  `invites` varchar(100) DEFAULT NULL,
			  `post_count` int(10) DEFAULT '0',
			  `signature` varchar(1000) DEFAULT NULL,
			  `website` varchar(500) DEFAULT NULL,
			  `location` varchar(250) DEFAULT NULL,
			  `occupation` varchar(250) DEFAULT NULL,
			  `hobbies` varchar(1000) DEFAULT NULL,
			  `bio` varchar(50000) DEFAULT NULL,
			  `avatar` varchar(500) DEFAULT NULL,
			  `friends` blob,
			  PRIMARY KEY (`id`)
			); 
			INSERT INTO `" . $this->prefix . "users` SET username = 'admin', salt = '$salt', hash = '$hash', role = 'admin';
			ENGINE=MyISAM DEFAULT CHARSET=latin1;
			";
				
			mysqli_multi_query($test_connection, $sql);
			unlink('install.php');
			$this->success('Installation Completed. Please <a href="admin">Login</a>');
		} else {
			$this->error('Please check your connection details and try again');
		}
		return;
		
	}

	/*
	 * Run the upgrade
	 *
	 * @return string
	 */
	public function run_upgrade() {

		$test_connection = mysqli_connect($this->host, $this->username, $this->password, $this->database) or die("Error " . mysqli_error( $test_connection ) );
		if( $test_connection ) {
			$sql = "
					ALTER TABLE `" . $this->prefix . "settings`
					ADD COLUMN site_fav_icon VARCHAR(250);
					ALTER TABLE `" . $this->prefix . "settings`
					ADD COLUMN twitter_handle VARCHAR(250);
					ALTER TABLE `" . $this->prefix . "settings`
					ADD COLUMN twitter_count INT(10);
					UPDATE `" . $this->prefix . "settings`
					SET twitter_count = '0' WHERE id = '1';
					ALTER TABLE `" . $this->prefix . "settings`
					ADD COLUMN twitter_api VARCHAR(250);
					ALTER TABLE `" . $this->prefix . "settings`
					ADD COLUMN twitter_secret VARCHAR(250);
					ALTER TABLE `" . $this->prefix . "settings`
					ADD COLUMN twitter_token VARCHAR(250);
					ALTER TABLE `" . $this->prefix . "settings`
					ADD COLUMN twitter_token_secret VARCHAR(250);
					";

			mysqli_multi_query($test_connection, $sql);
			$this->success('Upgrade completed. Head <a href="index.php">home</a>');
		} else {
			$this->error('Please check your connection details and try again');
		}
		return;
	}

	/*
	 * ABOUT: Check if a specific key and value exist in an array
	 * USED IN: 
	 * Matches View -> Check if match has an open dispute [status = 0]
	 */	
	public function multidimensional_search($parents, $searched) {
		
		if (empty($searched) || empty($parents)) {
			return false;
		}
	
		foreach ($parents as $key => $value) {
			$exists = true;
			foreach ($searched as $skey => $svalue) {
				$exists = ($exists && IsSet($parents[$key][$skey]) && $parents[$key][$skey] == $svalue);
			}
			if($exists){
				return true;
			}
		}
	
		return false;
		
	}
	
	public function removeArrayValue($string, $array) {
		
		//$array = unserialize($array);
		if(($key = array_search($string, $array)) !== false) {
			unset($array[$key]);
		}
	
		return $array;
		
	}
		
/*
 * END SPECIAL FUNCTIONS
 */		
	}
?>