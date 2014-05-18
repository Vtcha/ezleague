<?php session_start();

//ezLeague v1.6
	class ezLeaguePub extends DB_Class {

/*
 * START LOGIN & REGISTER FUNCTIONALITY
 */
		
		/*
		 * Login User
		 */
		function login($username, $password) {
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
		function register($username, $password, $email) {		
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
		
		function resetPassword($email) {
			$data = $this->fetch("SELECT * FROM `" . $this->prefix . "users` WHERE email = '$email'");
			 if(!empty($data)) {
			 	$password_string = md5(mt_rand());
			 	 $this->link->query("UPDATE `" . $this->prefix . "users` SET forget = '$password_string' WHERE (email = '$email') AND (role = 'admin')");
			 	
			 	$to = $email;
			 	
			 	$subject = 'ezLeague - Password Reset';
			 	
			 	$headers = "From: " . $email . "\r\n";
			 	$headers .= "Reply-To: ". $email . "\r\n";
			 	$headers .= "MIME-Version: 1.0\r\n";
			 	$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
			 	
			 	$message = '<html><body>';
			 	$message .= '<h1>ezLeague Password Reset</h1>';
			 	$message .= '<p>Click the link below (or paste it in your browser) to complete resetting your password.<br>';
			 	$message .= '<a href=\'' . $this->site_url . '/reset.php?f=' . $password_string . '\'>' . $this->site_url . '/reset.php?f=' . $password_string . '</a></p>';
			 	$message .= '<p>If you did not request this password reset, please disregard this email.</p>';
			 	$message .= '</body></html>';
			 	
			 	mail($to, $subject, $message, $headers);
			 	
			 	print "<strong>Success</strong> Password Reset instructions have been sent.";
			 } else {
			 	print "<strong>Error</strong> $email does not match any account";
			 }
		}
		
		function validateCode($code) {
			$data = $this->fetch("SELECT * FROM `" . $this->prefix . "users` WHERE forget = '$code'");
			 if(!empty($data)) {
			  $id = $data['0']['id'];
			 	return $id;
			 } else {
			 	return false;
			 }
		}
		
		function changePassword($id, $password) {
			$strength = '5';
			$salt = strtr(base64_encode(mcrypt_create_iv(16, MCRYPT_DEV_URANDOM)), '+', '.');
			//blowfish algorithm
			$salt = sprintf("$2a$%02d$", $strength) . $salt;
			$hash = crypt($password, $salt);

				$this->link->query("UPDATE `" . $this->prefix . "users` SET salt = '$salt', hash = '$hash'
									WHERE id = '$id'
								   ");
				print "<strong>Success!</strong> Account has been created. You may now login.";
		
		}
		
		function updateEmail($id, $email) {
			$this->link->query("UPDATE `" . $this->prefix . "users` SET email = '$email'
									WHERE id = '$id'
							  ");
				print "<strong>Success!</strong> Account has been created. You may now login.";
		}
			
/*
 * END LOGIN & REGISTER FUNCTIONALITY
 */		
		
/*
 * START GENERAL SITE FUNCTIONALITY
 */	
		function getUsers() {
			$data = $this->fetch("SELECT * FROM `" . $this->prefix . "users`");
			 return $data;	
		}
		
		function getSiteSettings() {
			$settings = array();
			 $data = $this->fetch("SELECT * FROM `" . $this->prefix . "settings` WHERE id = '1'");
			  $settings = array(
			  					'name'  => $data['0']['site_name'], 
			  					'url'   => $data['0']['site_url'],
			  					'about' => $data['0']['site_about'],
			  					'email' => $data['0']['site_email']
			  				   );
			 return $settings;
		}
		
		function getAllGames() {
			$data = $this->fetch("SELECT * FROM `" . $this->prefix . "games`");
			 return $data;
		}
		
		function getGameBySlug($slug) {
			$data = $this->fetch("SELECT game FROM `" . $this->prefix . "games` WHERE slug = '$slug'");
			 $game = $data['0']['game'];
			  return $game;
		}
		
		function setGame($game) {
			$_SESSION['ez_game'] = $game;
		 ?>
		 	<!--  <script type="text/javascript">setTimeout(function(){location.reload()},3000);</script> -->
		 <?php
			 return;
		}

/*
 * END GENERAL SITE FUNCTIONALITY
 */		
		
/*
 * START USER FUNCTIONALITY
 */		
		
		function getUser($id) {
			$data = $this->fetch("SELECT * FROM `" . $this->prefix . "users` WHERE id = '$id'");
			 return $data;
		}
		
		function getUserId($username) {
			$data = $this->fetch("SELECT id FROM `" . $this->prefix . "users` WHERE username = '$username'");
			 $user_id = $data['0']['id'];
			  return $user_id;
		}
		
		function getUserGuild($guild_id) {
			$data = $this->fetch("SELECT * FROM `" . $this->prefix . "guilds` WHERE id = '$guild_id'");
			 return $data;
		}
		
		function getUserGuildId($user) {
			$data = $this->fetch("SELECT guild FROM `" . $this->prefix . "users` WHERE username = '$user'");
			 $guild_id = $data['0']['guild'];
			  return $guild_id;
		}
		
		function getUserSettings($username) {
			$data = $this->fetch("SELECT id, email FROM `" . $this->prefix . "users` WHERE username = '$username'");
			 $user_id 	 = $data['0']['id'];
			 $user_email = $data['0']['email'];
			  $settings = array(
			  					 'id' 	 => $user_id,
			  				     'email' => $user_email
			  				   );
			  return $settings;
		}
		
		function sendTeamInvite($user_id, $team_id) {
			$current_invites = ezLeaguePub::getUserInvites($user_id);
			 $new_invites = $current_invites . "," . $team_id;
			 $this->link->query("UPDATE `" . $this->prefix . "users` SET invites = '$new_invites' WHERE id = '$user_id'");
			print "Invite Sent";
			return;
		}
		
		function getUserInvites($user_id) {
			$data = $this->fetch("SELECT invites FROM `" . $this->prefix . "users` WHERE id = '$user_id'");
			 $invites = $data['0']['invites'];
			  return $invites;	
		}
		
		function getUsernameInvites($username) {
			$data = $this->fetch("SELECT invites FROM `" . $this->prefix . "users` WHERE username = '$username'");
			 $invites = $data['0']['invites'];
			  return $invites;
		}
		
		function joinTeam($team_id, $username) {
			$this->link->query("UPDATE `" . $this->prefix . "users` SET guild = '$team_id', invites = ''
								WHERE username = '$username'
							   ");
			 print "<strong>Success!</strong> You have joined the team";	
		}
		
		function searchUsers($search) {
			$data = $this->fetch("SELECT * FROM `" . $this->prefix . "users` WHERE username LIKE '%$search%'");
			 return $data;
		}
		
		
/*
 * END USER FUNCTIONALITY
 */		
		
/*
 * START INBOX FUNCTIONALITY
 */		
		
		function getInbox($username) {
			$data = $this->fetch("SELECT * FROM `" . $this->prefix . "inbox_messages` WHERE recipient = '$username'
								 ");
			 return $data;
		}
		
		function countNewInbox($username) {
			$result = $this->link->query("SELECT * FROM `" . $this->prefix . "inbox_messages` WHERE recipient  = '$username'
										  AND status = 'unread'
										 ");
			 $total = $this->numRows($result);
			  return $total;
		}
		
		function getMessage($id) {
			$data = $this->fetch("SELECT * FROM `" . $this->prefix . "inbox_original` WHERE id = '$id'");
			 return $data;	
		}
		
		function checkMessageAccess($id, $username) {
			$result = $this->link->query("SELECT id FROM `" . $this->prefix . "inbox_messages`
										  WHERE msg_id = '$id' AND recipient = '$username'
										");
			 $total = $this->numRows($result);
			  if($total == 0) {
			  	return false;
			  } else {
			  	return true;
			  }	
		}
		
		function getMessageReplies($id, $username) {
			$data = $this->fetch("SELECT * FROM `" . $this->prefix . "inbox_replies` 
								  WHERE msg_id = '$id'
								  ORDER BY date ASC
								 ");
			 return $data;
		}
		
		function sendMessage($subject, $message, $receiver, $sender) {
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

			  print "<strong>Success!</strong> Message has been sent";
		}
		
		function sendResponse($message_id, $message, $sender) {
			$message = $this->link->real_escape_string($message);
			   	 $this->link->query("INSERT INTO `" . $this->prefix . "inbox_replies` 
			   	 					 SET sender = '$sender', message = '$message', msg_id = '$message_id'
			     					");
			   	 $this->link->query("UPDATE `" . $this->prefix . "inbox_messages` 
						     		 SET status = 'unread'
			   	 					 WHERE msg_id = '$message_id'
			   	 				   ");
			   
			 print "<strong>Success!</strong> Reply has been sent";
		}
		
		function markRead($message_id, $recipient) {
			$this->link->query("UPDATE `" . $this->prefix . "inbox_messages` SET status = 'read'
								WHERE recipient = '$recipient' AND msg_id = '$message_id'
							  ");	
		}
		
/*
 * END INBOX FUNCTIONALITY
 */		
		
/*  
 * START NEWS FUNCTIONALITY
 */
		
		function getNewsAll() {
			$data = $this->fetch("SELECT * FROM `" . $this->prefix . "news` WHERE published = '1'");
			 if(empty($data)) { 
			 	return false;
			 } else {
				 return $data;
			 }
		}
		
		function getNewsGame($game) {
			$data = $this->fetch("SELECT * FROM `" . $this->prefix . "news` WHERE (published = '1') AND (game = '$game')");
			 return $data;
		}
		
		function getNewsPost($id) {
			$data = $this->fetch("SELECT * FROM `" . $this->prefix . "news` WHERE id = '$id'");
			 return $data;
		}
		
		function getNewsByAuthor($author) {
			$author = $this->link->real_escape_string($author);
			$data = $this->fetch("SELECT * FROM `" . $this->prefix . "news` WHERE author = '$author'");
			 return $data;
		}

/*
 * END NEWS FUNCTIONALITY
 */
		
/*
 * START TEAMS FUNCTIONALITY
 */		
		
		function createTeam($team, $abbr, $game, $admin) {
			$team = $this->link->real_escape_string($team);
			$abbr = $this->link->real_escape_string($abbr);
			 $check = ezLeaguePub::teamCheck($team, $game);
			  if($check == 0) {
				$this->link->query("INSERT INTO `" . $this->prefix . "guilds` SET guild = '$team', abbreviation = '$abbr', admin = '$admin',
									game = '$game', gm = '$admin'
								   ");
				 //now set the admins guild to the new guilds id
				  $latest = $this->fetch("SELECT id FROM `" . $this->prefix . "guilds` ORDER BY id DESC LIMIT 1");
				   $latest_id = $latest['0']['id'];
				    $this->link->query("UPDATE `" . $this->prefix . "users` SET guild = '$latest_id' WHERE username = '$admin'");
				print "<strong>Success!</strong> Team has been created.";
			  } else {
			  	print "<strong>Error</strong> Team Name already exists in this game.";
			  }
		}
		
		function teamCheck($team, $game) {
			$result = $this->fetch("SELECT guild, game FROM `" . $this->prefix . "guilds` WHERE (guild = '$team') AND (game = '$game')");
			 $count = count($result);
			  return $count;	
		}
		
		function getTeamsAll() {
			$data = $this->fetch("SELECT * FROM `" . $this->prefix . "guilds`");
			 return $data;
		}
		
		function getTeams($game) {
			$data = $this->fetch("SELECT * FROM `" . $this->prefix . "guilds` WHERE game = '$game'");
			 return $data;
		}
		
		function getTeam($id) {
			$data = $this->fetch("SELECT * FROM `" . $this->prefix . "guilds` WHERE id = '$id'");
			 return $data;
		}
		
		function getTeamName($id) {
			$data = $this->fetch("SELECT guild FROM `" . $this->prefix . "guilds` WHERE id = '$id'");
			 $guild = $data['0']['guild'];
			  return $guild;
		}
		
		function getTeamMembers($id) {
			$data = $this->fetch("SELECT * FROM `" . $this->prefix . "users` WHERE guild = '$id'");
			 return $data;
		}
		
		function getTeamLeagues($id) {
			$data = $this->fetch("SELECT leagues FROM `" . $this->prefix . "guilds` WHERE id = '$id'");
			 $leagues = $data['0']['leagues'];
			 return $leagues;
		}
		
		function getTeamAdmin($id) {
			$data = $this->fetch("SELECT admin FROM `" . $this->prefix . "guilds` WHERE id = '$id'");
			 $admin = $data['0']['admin'];
			  return $admin;
		}
		
		function updateTeamSettings($id, $gm, $agm, $site, $admin) {
			$site = $this->link->real_escape_string($site);
			 $this->link->query("UPDATE `" . $this->prefix . "guilds` SET gm = '$gm', agm = '$agm', website = '$site', admin = '$admin'
			 			  		 WHERE id = '$id'
			 			 	   ");

			  print "<strong>Success!</strong> Team Settings have been updated.";
		}
		
		function getTeamChallenges($team_id) {
			//$data = $this->fetch("SELECT * FROM `" . $this->prefix . "challenges` WHERE (challenger = '$team_id') OR (challengee = '$team_id') ORDER BY created DESC");
			$data = $this->fetch("SELECT t.id, t.challenger, t.created, t.completed, t. t.g_challenger, t.challengee, g2.guild AS g_challengee
								  FROM (
								    SELECT c1.id, c1.challenger, c1.created, c1.completed, g1.guild AS g_challenger, c1.challengee
								    FROM " . $this->prefix . "guilds g1
								  	JOIN " . $this->prefix . "challenges c1
								  	ON g1.id = c1.challenger
								  ) t 
								  JOIN " . $this->prefix . "guilds g2
								  ON g2.id = t.challengee
								  WHERE challenger = '$team_id' OR challengee = '$team_id' ORDER BY t.id DESC
								");	
			return $data;
		}
		
		function getTeamPendingChallenges($id) {
			$result = $this->link->query("SELECT * FROM `" . $this->prefix . "challenges` WHERE (challenger = '$id' OR challengee = '$id') 
								  		  AND (completed = '0') 
								  		  AND (challenger_accepted != '2' AND challengee_accepted != '2')
										");
			 $count = $this->numRows($result);
			  return $count;
		}
		
		function getTeamRecentMatches($team_id) {
			$data = $this->fetch("SELECT t.id, t.challenger, t.challenger_score, t.league_id, t.match_date, t.created, t.completed, t.challengee_accepted, t.challengee_score, t.challenger_accepted, t.g_challenger, t.challengee, g2.guild AS g_challengee
								  FROM (
								    SELECT c1.id, c1.challenger, c1.challenger_score, c1.created, c1.match_date, c1.league_id, c1.completed, c1.challengee_accepted, c1.challengee_score, c1.challenger_accepted, g1.guild AS g_challenger, c1.challengee
								    FROM `" . $this->prefix . "guilds` g1
								    JOIN `" . $this->prefix . "challenges` c1
								    ON g1.id = c1.challenger
								  ) t 
								  JOIN `" . $this->prefix . "guilds` g2
								  ON g2.id = t.challengee
								  WHERE (t.completed = 1) AND (t.challengee = '$team_id' OR t.challenger = '$team_id')
								  ORDER BY t.created DESC
								");	
				return $data;
		}
		
		function getTeamGame($team_id) {
			$data = $this->fetch("SELECT game FROM `" . $this->prefix . "guilds` WHERE id = '$team_id'");
			 $game = $data['0']['game'];
			  return $game;
		}
		
		
/*
 * END TEAMS FUNCTIONALITY
 */		
		
/*
 * START LEAGUE FUNCTIONALITY
 */
		
		function getLeagues($game) {
			$data = $this->fetch("SELECT * FROM `" . $this->prefix . "leagues` WHERE (game = '$game') AND (open = '1')");
			 return $data;
		}
		
		function getLeague($id) {
			$data = $this->fetch("SELECT * FROM `" . $this->prefix . "leagues` WHERE id = '$id'");
			 return $data;
		}
		
		function getLeagueGuilds($id) {
			$data = $this->fetch("SELECT * FROM `" . $this->prefix . "guilds` WHERE leagues LIKE '%$id%'");
			 return $data;
		}
		
		function joinLeague($guild, $league) {
			$current_leagues = $this->fetch("SELECT `" . $this->prefix . "leagues` FROM `" . $this->prefix . "guilds` WHERE id = '$guild'");
			 $leagues = $current_leagues['0']['leagues'];
			  if($leagues == '') {
			  	$new_leagues = $league . ",";
			  } else {
			  	$new_leagues = $league . "," . $leagues;
			  }
			   //remove the trailing comma
			   $new_leagues = rtrim($new_leagues, ",");
			   
			   $this->link->query("UPDATE `" . $this->prefix . "guilds` SET leagues = '$new_leagues' WHERE id = '$guild'");
			    print "<strong>Success!</strong> Your guild has joined the league.";
			  return;
		}
		
		function leaveLeague($league_id, $team_id) {
			$data = $this->fetch("SELECT leagues FROM `" . $this->prefix . "guilds` WHERE id = '$team_id'");
			 $team_leagues = $data['0']['leagues'];
			  $leagues = explode(",", $team_leagues);
			   $new_leagues = ezLeaguePub::removeArrayValue($league_id, $leagues);
			    $new_leagues = implode(",", $new_leagues);
				 $this->link->query("UPDATE `" . $this->prefix . "guilds` SET leagues = '$new_leagues' WHERE id = '$team_id'");
				 print "<strong>Success!</strong> Your Team has left the League";
		}
		
		function getLeagueStandings($id) {
			$data = $this->fetch("SELECT guild, id, leagues FROM `" . $this->prefix . "guilds` WHERE leagues LIKE '%,$id' OR leagues LIKE '$id,%' OR leagues LIKE '$id' ORDER BY id DESC");
			 foreach($data as $team) {
			 	$team_results = $this->fetch("SELECT * FROM `" . $this->prefix . "results` WHERE guild_id = '$team[id]' AND league_id = '$id'");
			 	
			 	 $team_points = 0;
			 	  if($team_results) {	 //if the guild has any results submitted for this league
				 	 foreach($team_results as $result) {
				 	 	$team_points = $team_points + $result['points_given'];
				 	 }
				 	 $league_results[] = array('guild' => $team['guild'], 'team_id' => $team['id'], 'points' => $team_points);
			 	  } else { //if the guild has no results submitted, set their points to 0
			 	  	$league_results[] = array('guild' => $team['guild'], 'team_id' => $team['id'], 'points' => 0);
			 	  }
			 }
			 
			 foreach ($league_results as $key => $row) {
			 	$guild[$key]  = $row['guild'];
			 	$points[$key] = $row['points'];
			 }
			 
			 // Sort the guild points data with points descending, guild ascending
			 // Add $league_results as the last parameter, to sort by the common key
			 array_multisort($points, SORT_DESC, $guild, SORT_ASC, $league_results);
			  return $league_results;
		}
		
		function getTeamPoints($team_id, $league_id) {
			$team_results = $this->fetch("SELECT * FROM `" . $this->prefix . "results` WHERE guild_id = '$team_id' AND league_id = '$league_id'");
			 $team_points = 0;
			  foreach($team_results as $result) {
			  	$team_points = $team_points + $result['points_given'];
			  }
			  
			   return $team_points;
		}
		
		function getTeamGamePoints($team_id, $game) {
			//first get the leagues for that game
			$data = $this->fetch("SELECT * FROM `" . $this->prefix . "leagues` WHERE game = '$game'");
			 $total_points = 0;
			 foreach($data as $league) {
				$points = $this->fetch("SELECT * FROM `" . $this->prefix . "results` WHERE league_id = '$league[id]' AND guild_id = '$team_id'");
				 $total_points = $total_points + $points['0']['points_given'];
			 }
				 
				return $total_points;	 
		}
		
		function getTotalLeagueTeams($league) {
			$result = $this->link->query("SELECT id FROM `" . $this->prefix . "guilds` WHERE leagues LIKE '%$league%'");
			 $count = $this->numRows($result);
			  return $count;	
		}
		
		function getLeaguesByGame($game) {
			$data = $this->fetch("SELECT * FROM `" . $this->prefix . "leagues` WHERE game = '$game'");
			  return $data;
		}
		
		function getLeagueSchedule($league_id) {
			$data = $this->fetch("SELECT t.id, t.challenger, t.league_id, t.match_date, t.created, t.completed, t.challengee_accepted, t.challenger_accepted, t.g_challenger, t.challengee, g2.guild AS g_challengee
								  FROM (
								    SELECT c1.id, c1.challenger, c1.created, c1.match_date, c1.league_id, c1.completed, c1.challengee_accepted, c1.challenger_accepted, g1.guild AS g_challenger, c1.challengee
								    FROM " . $this->prefix . "guilds g1
								    JOIN " . $this->prefix . "challenges c1
								    ON g1.id = c1.challenger
								  ) t 
								  JOIN " . $this->prefix . "guilds g2
								  ON g2.id = t.challengee
								  WHERE (t.league_id = '$league_id' AND t.completed = 0) AND (t.challengee_accepted != 2 AND t.challenger_accepted != 2)
								  ORDER BY t.created DESC	
								");
				return $data;
		}
		
		function getLeagueResults($league_id) {
			$data = $this->fetch("SELECT t.id, t.challenger, t.league_id, t.match_date, t.created, t.completed, t.challengee_score, t.challenger_score, t.g_challenger, t.challengee, g2.guild AS g_challengee
								  FROM (
									SELECT c1.id, c1.challenger, c1.created, c1.match_date, c1.league_id, c1.completed, c1.challengee_score, c1.challenger_score, g1.guild AS g_challenger, c1.challengee
									FROM " . $this->prefix . "guilds g1
									JOIN " . $this->prefix . "challenges c1
									ON g1.id = c1.challenger
								  ) t
								  JOIN " . $this->prefix . "guilds g2
								  ON g2.id = t.challengee
								  WHERE (t.league_id = '$league_id' AND t.completed = 1)
								  ORDER BY t.created DESC
								");
				return $data;
		}
		
		function getLeagueName($league_id) {
			$data = $this->fetch("SELECT league FROM `" . $this->prefix . "leagues` WHERE id = '$league_id'"); 
			 $league = $data['0']['league'];
			    return $league;
		}
		
		function getLeagueRules($league_id) {
			$data = $this->fetch("SELECT rules FROM `" . $this->prefix . "leagues` WHERE id = '$league_id'");
			 $rules = $data['0']['rules'];
			    return $rules;
		}
		
		function getLeaguePoints($league_id) {
			$data = $this->fetch("SELECT id, win_points, loss_points, tie_points FROM `" . $this->prefix . "leagues` WHERE id = '$league_id'");
			 $points = array(
			 					'id'   => $data['0']['id'],
			 				 	'win'  => $data['0']['win_points'],
			 					'loss' => $data['0']['loss_points'],
			 					'tie'  => $data['0']['tie_points']
			 				);
			 	return $points;
		}
		
		
/*
 * END LEAGUE FUNCTIONALITY
 */		
		
/*
 * START CHALLENGES FUNCTIONALITY
 */		
		function getChallenge($id) {
			$data = $this->fetch("SELECT * FROM `" . $this->prefix . "challenges` WHERE id = '$id'");
			 $league_id		= $data['0']['league_id'];
			 $challenger_id = $data['0']['challenger'];
			 $challengee_id = $data['0']['challengee'];
			 $challenger = ezLeaguePub::getTeamName($challenger_id);
			 $challengee = ezLeaguePub::getTeamName($challengee_id);
			 $challenger_admin = ezLeaguePub::getTeamAdmin($challenger_id);
			 $challengee_admin = ezLeaguePub::getTeamAdmin($challengee_id);
			  if($data['0']['match_date'] != '') { 
			  	$match_date = date('F d, Y h:ia', strtotime($data['0']['match_date']));
			  	 if($data['0']['match_hour'] != 0) { 
			  	 	$match_hour = (strlen($data['0']['match_hour']) == 1 ? '0' . $data['0']['match_hour'] : $data['0']['match_hour']);
			  	 	$match_min  = (strlen($data['0']['match_min']) == 1 ? '0' . $data['0']['match_min'] : $data['0']['match_min']);
			  	 	$match_time = $match_hour . ":" . $match_min . "" . $data['0']['match_pod'] . " " . $data['0']['match_zone'];
			  	 } else {
					$match_time = 'Match Time Not Set';
			  	 }
			  } else {
			  	$match_date = 'Match Date Not Set';
			  	 $match_time = '';
			  }
			  
			  $match_completed = $data['0']['completed'];
			   $match_status = '';
			   if($match_completed == 1) {
					$match_status = 'Completed';
					$match_completed = 1;
			   } else {
			  	   $challenge_status = ezLeaguePub::getChallengeStatus($id);
		 			  switch($challenge_status) {
		 			  	case '0':
		 			  		$match_status = 'Pending';
		 			  		break;
		 			  	case '1':
		 			  		$match_status = 'Accepted';
		 			  		break;
		 			  	case '2':
		 			  		$match_status = 'Rejected';
		 			  		break;
		 			  	default:
		 			  		$match_status = 'Pending';
		 			  		break;
		 			  }
		 			  $match_completed = 0;
			   }
				 
				 $challenge = array(
				 				    'match_created'	      => date('F d, Y', strtotime($data['0']['created'])),
				 					'match_date' 	      => $match_date, 
				 					'match_time'	      => $match_time,
				 					'match_status'	      => $match_status,
				 					'challengee'	      => $challengee,
				 					'challengee_id'       => $challengee_id,
				 					'challengee_admin'    => $challengee_admin,
				 					'challenger'	  	  => $challenger,
				 					'challenger_id'    	  => $challenger_id,
				 					'challenger_admin' 	  => $challenger_admin,
				 					'challenger_accepted' => $data['0']['challenger_accepted'],
				 					'challengee_accepted' => $data['0']['challengee_accepted'],
				 					'match_completed'     => $match_completed,
				 					'league_id'			  => $league_id
				 					);
			 return $challenge;
		}
		
		function getChallengeScore($id) {
			$data = $this->fetch("SELECT challenger, challenger_score, challengee, challengee_score, id
								  FROM `" . $this->prefix . "challenges`
								  WHERE id = '$id'
								");
			 $score = array(
			 				'challenger' 	   => $data['0']['challenger'], 
			 				'challenger_score' => $data['0']['challenger_score'],
			 				'challengee' 	   => $data['0']['challengee'],
			 				'challengee_score' => $data['0']['challengee_score'],
			 				'challenge_id' 	   => $data['0']['id']
			 			   );
			 	return $score;	
		}
		
		function getChallengeDetails($id) {
			$data = $this->fetch("SELECT t.id, t.challenger, t.created, t.completed, t.challengee_accepted, t.challenger_accepted, t.g_challenger, t.challengee, g2.guild AS g_challengee
								  FROM (
								    SELECT c1.id, c1.challenger, c1.created, c1.completed, c1.challengee_accepted, c1.challenger_accepted, g1.guild AS g_challenger, c1.challengee
								    FROM " . $this->prefix . "guilds g1
								    JOIN " . $this->prefix . "challenges c1
								    ON g1.id = c1.challenger
								  ) t 
									JOIN " . $this->prefix . "guilds g2
									ON g2.id = t.challengee
									WHERE t.id = '$id'
								 ");
			 $details = array(
			 					'challenger_name' => $data['0']['g_challenger'],
			 					'challengee_name' => $data['0']['g_challengee']
			 				);
				return $details;
		}
		
		function makeChallenge($challenger, $challengee, $league_id) {
			$result = $this->link->query("SELECT * FROM `" . $this->prefix . "challenges` 
										  WHERE (challenger = '$challenger') AND (challengee = '$challengee')
										  AND (accepted = '0') AND (league_id = '$league_id')
										 ");
			 print "SELECT * FROM `" . $this->prefix . "challenges` 
										  WHERE (challenger = '$challenger') AND (challengee = '$challengee')
										  AND (accepted = '0') AND (league_id = '$league_id')";
			 $count = $this->numRows($result);
			  if($count > 0) { 
			  	print "<strong>Error</strong> A previous challenge to this Guild has not been accepted";
			  } else { 
				$this->link->query("INSERT INTO `" . $this->prefix . "challenges` SET challenger = '$challenger', challengee = '$challengee', 
									league_id = '$league_id'
								   ");
				print "<strong>Success!</strong> Your challenge has been made";
			  }
					return;	
		}
		
		function getTeamMadeLeagueChallenges($team_id, $league_id) {
			$data = $this->fetch("SELECT challengee, league_id, id FROM `" . $this->prefix . "challenges` 
								  WHERE (challenger = '$team_id') AND (league_id = '$league_id') AND (accepted = '0')
								");
				return $data;	
		}
		
		function updateChallengeStatus($id, $team, $status) {
			$col = $team . "_accepted";
			$this->link->query("UPDATE `" . $this->prefix . "challenges` SET $col = '$status' WHERE id = '$id'");
			 print "<strong>Success!</strong> Challenge Status has been updated";
			 	return;
		}
		
		function getChallengeStatus($cid) {
			$challenge = $this->fetch("SELECT challenger_accepted, challengee_accepted FROM `" . $this->prefix . "challenges` WHERE id = '$cid'");
			//get the challenge status of both guilds
			$challenger_status = $challenge['0']['challenger_accepted'];
			$challengee_status = $challenge['0']['challengee_accepted'];
			
			//check if both guilds have accepted the challenge
			if($challenger_status == 1 && $challengee_status == 1) {
				$match_status = 1;
			} elseif($challenger_status == 2 || $challengee_status == 2) {
				$match_status = 2;
			} else {
				$match_status = 0;
			}
			
				return $match_status;
		}
		
		function updateChallenge($challenge_id, $date, $hour, $min, $zone, $pod) {
			$this->link->query("UPDATE `" . $this->prefix . "challenges` SET match_date = '$date', match_hour = '$hour', match_min = '$min',
						  match_zone = '$zone', match_pod = '$pod'
						  WHERE id = '$challenge_id'
						");
			  print "<strong>Success!</strong> Challenge details have been updated";
				return;	
		}
		
		function updateChallengeResponse($challenge_id, $response, $user) {
			$data = $this->fetch("SELECT chat_log FROM `" . $this->prefix . "challenges` WHERE id = '$challenge_id'");
			 $current = $data['0']['chat_log'];
			  $update = $response . "<br>" . $current;
			   $new = $this->link->real_escape_string($update);
			    $this->link->query("UPDATE `" . $this->prefix . "challenges` SET chat_log = '$new' WHERE id = '$challenge_id'");
			     print "<strong>Success!</strong> Response has been added";
			      return;
			
		}
		
		function submitChallengeScore($challenge_id, $challenger, $challengee) {
			$this->link->query("UPDATE `" . $this->prefix . "challenges` SET completed = '1', challenger_score = '$challenger', challengee_score = '$challengee' WHERE id = '$challenge_id'");
			 //get challenge details
			  $challenge_data = ezLeaguePub::getChallenge($challenge_id);
			   $challenger_id = $challenge_data['challenger_id'];
			   $challengee_id = $challenge_data['challengee_id'];
			   $league_id	  = $challenge_data['league_id']; 
			 //get point values based on the league
			  $points = ezLeaguePub::getLeaguePoints($league_id);
			   $points_win  = $points['win'];
			   $points_loss = $points['loss'];
			   $points_tie  = $points['tie'];
			 //insert score details to results table
			  if($challenger > $challengee) { //if challenger won
			  	$this->link->query("INSERT INTO `" . $this->prefix . "results` 
			  					  	SET guild_id = '$challenger_id', league_id = '$league_id', result = 'w', date = 'NOW()',
			  						challenge_id = '$challenge_id', points_given = '$points_win'
			  					  ");
			  	
			  	$this->link->query("INSERT INTO `" . $this->prefix . "results`
						  			SET guild_id = '$challengee_id', league_id = '$league_id', result = 'l', date = 'NOW()',
						  			challenge_id = '$challenge_id', points_given = '$points_loss'
						  		  ");
			  } elseif($challengee > $challenger) { //if challengee won
			  	$this->link->query("INSERT INTO `" . $this->prefix . "results`
						  			SET guild_id = '$challengee_id', league_id = '$league_id', result = 'w', date = 'NOW()',
						  			challenge_id = '$challenge_id', points_given = '$points_win'
						  		  ");
			  	
			  	$this->link->query("INSERT INTO `" . $this->prefix . "results`
						  			SET guild_id = '$challenger_id', league_id = '$league_id', result = 'l', date = 'NOW()',
						  			challenge_id = '$challenge_id', points_given = '$points_loss'
						  		  ");
			  	
			  } else { //must be a tie
			  	$this->link->query("INSERT INTO `" . $this->prefix . "results`
						  			SET guild_id = '$challenger_id', league_id = '$league_id', result = 't', date = 'NOW()',
						  			challenge_id = '$challenge_id', points_given = '$points_tie'
						  		  ");
			  	
			  	$this->link->query("INSERT INTO `" . $this->prefix . "results`
						  			SET guild_id = '$challengee_id', league_id = '$league_id', result = 't', date = 'NOW()',
						  			challenge_id = '$challenge_id', points_given = '$points_tie'
						  		  ");
			  }
			  
			print "<strong>Success!</strong> Challenge score has been submitted";
			  return;
		}
		
		function addDispute($id, $description, $filer) {
			$this->link->query("INSERT INTO `" . $this->prefix . "disputes`
								SET challenge_id = '$id', description = '$description', filed_by = '$filer'
							  ");
			 print "<strong>Success!</strong> Dispute has been filed for Challenge #$id...reloading";
			  return;
		}
		
		function checkForUserDispute($id, $username) {
			$check = $this->fetch("SELECT * FROM `" . $this->prefix . "disputes` 
								   WHERE challenge_id = '$id' AND filed_by = '$username'
								 ");
			 if(empty($check)) {
			 	return false;
			 } else {
			 	return true;
			 }
		}
		
		function getPredictions($challenge_id) {
			$data = $this->fetch("SELECT * FROM `" . $this->prefix . "predictions`
								  WHERE cid = '$challenge_id' 
								  ORDER BY id DESC
								 ");
				return $data;
		}
		
		function countPredictions($challenge_id, $team_id) {
			$result = $this->link->query("SELECT * FROM `" . $this->prefix . "predictions`
								  WHERE cid = '$challenge_id' AND team = '$team_id'
								");
			 $total = $this->numRows($result);
			  return $total;
		}
		
		function makePrediction($username, $challenge_id, $winner, $comment) {
			$comment = $this->link->real_escape_string($comment);
			$this->link->query("INSERT INTO `" . $this->prefix . "predictions` SET cid = '$challenge_id', team = '$winner',
								comment = '$comment', user = '$username'
							  ");
			  print "<strong>Success!</strong> Prediction has been saved";
				return;
		}
		
/*
 * END CHALLENGES FUNCTIONALITY
 */		
		
/*
 * START INSTALLATION FUNCTIONALITY
 */
		
		function runInstaller($site_name) {
		
		 $test_connection = mysqli_connect($this->host,$this->username,$this->password,$this->database) or die("Error " . mysqli_error($link));
		  if($test_connection) {
			$sql = "
			CREATE TABLE IF NOT EXISTS `" . $this->prefix . "challenges` (
			  `id` int(10) NOT NULL AUTO_INCREMENT,
			  `challenger` int(10) DEFAULT NULL,
			  `challengee` int(10) DEFAULT NULL,
			  `league_id` int(10) DEFAULT NULL,
			  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
			  `expire` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
			  `chat_log` blob,
			  `match_date` varchar(100) DEFAULT '',
			  `match_hour` int(10) DEFAULT '0',
			  `match_zone` varchar(3) DEFAULT NULL,
			  `match_min` int(10) DEFAULT '0',
			  `completed` int(1) DEFAULT '0',
			  `challenger_accepted` int(1) DEFAULT '0',
			  `challengee_accepted` int(1) DEFAULT '0',
			  `match_pod` varchar(2) DEFAULT 'PM',
			  `challenger_score` int(10) DEFAULT NULL,
			  `challengee_score` int(10) DEFAULT NULL,
			  PRIMARY KEY (`id`)
			);
			
			CREATE TABLE IF NOT EXISTS `" . $this->prefix . "disputes` (
			  `id` int(10) NOT NULL AUTO_INCREMENT,
			  `challenge_id` int(10) DEFAULT NULL,
			  `description` varchar(2000) DEFAULT NULL,
			  `filed_by` varchar(100) DEFAULT NULL,
			  `status` int(1) DEFAULT '0',
			  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
			  PRIMARY KEY (`id`)
			);
			
			CREATE TABLE IF NOT EXISTS `" . $this->prefix . "forum_answer` (
			  `a_id` int(10) NOT NULL AUTO_INCREMENT,
			  `question_id` int(10) NOT NULL,
			  `a_answer` longtext NOT NULL,
			  `a_datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
			  `a_section` int(10) NOT NULL,
			  `a_username` varchar(55) NOT NULL,
			  `a_user_id` int(10) NOT NULL,
			  PRIMARY KEY (`a_id`)
			);
			
			CREATE TABLE IF NOT EXISTS `" . $this->prefix . "forum_question` (
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
			
			CREATE TABLE IF NOT EXISTS `" . $this->prefix . "forum_section` (
			  `id` int(10) NOT NULL AUTO_INCREMENT,
			  `section_name` varchar(50) NOT NULL,
			  `type` varchar(25) NOT NULL DEFAULT 'public',
			  PRIMARY KEY (`id`)
			);
			
			CREATE TABLE IF NOT EXISTS `" . $this->prefix . "games` (
			  `id` int(10) NOT NULL AUTO_INCREMENT,
			  `game` varchar(100) DEFAULT NULL,
			  `slug` varchar(50) NOT NULL,
			  PRIMARY KEY (`id`)
			);
			
			CREATE TABLE IF NOT EXISTS `" . $this->prefix . "guilds` (
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
			  PRIMARY KEY (`id`,`admin`)
			);
			
			CREATE TABLE IF NOT EXISTS `" . $this->prefix . "leagues` (
			  `id` int(10) NOT NULL AUTO_INCREMENT,
			  `league` varchar(50) DEFAULT NULL,
			  `teams` int(19) DEFAULT '6',
			  `game` varchar(50) DEFAULT NULL,
			  `open` int(1) DEFAULT '1',
			  `start_date` date DEFAULT NULL,
			  `end_date` date DEFAULT NULL,
			  `total_games` int(10) DEFAULT '8',
			  `rules` varchar(10000) DEFAULT NULL,
			  `win_points` int(10) DEFAULT '3',
			  `loss_points` int(10) DEFAULT '1',
			  `tie_points` int(10) DEFAULT '2',
			  PRIMARY KEY (`id`)
			);
			
			CREATE TABLE IF NOT EXISTS `" . $this->prefix . "news` (
			  `id` int(10) NOT NULL AUTO_INCREMENT,
			  `title` varchar(255) DEFAULT NULL,
			  `body` varchar(5000) DEFAULT NULL,
			  `author` varchar(50) DEFAULT NULL,
			  `category` varchar(50) DEFAULT NULL,
			  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
			  `published` int(1) DEFAULT '0',
			  `game` varchar(25) DEFAULT NULL,
			  PRIMARY KEY (`id`)
			);
			
			CREATE TABLE IF NOT EXISTS `" . $this->prefix . "news_category` (
			  `id` int(10) NOT NULL AUTO_INCREMENT,
			  `category` varchar(50) DEFAULT NULL,
			  PRIMARY KEY (`id`)
			);
			
			CREATE TABLE IF NOT EXISTS `" . $this->prefix . "results` (
			  `id` int(10) NOT NULL AUTO_INCREMENT,
			  `guild_id` int(10) NOT NULL,
			  `league_id` int(10) NOT NULL,
			  `result` varchar(1) NOT NULL,
			  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
			  `challenge_id` int(10) DEFAULT NULL,
			  `points_given` int(10) DEFAULT NULL,
			  PRIMARY KEY (`id`)
			);
			
			CREATE TABLE IF NOT EXISTS `" . $this->prefix . "screenshots` (
			  `id` int(10) NOT NULL AUTO_INCREMENT,
			  `filename` varchar(255) NOT NULL,
			  `challenge_id` int(10) NOT NULL,
			  `uploader` varchar(55) NOT NULL,
			  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
			  PRIMARY KEY (`id`)
			);
			
			CREATE TABLE IF NOT EXISTS `" . $this->prefix . "settings` (
			  `id` int(1) NOT NULL DEFAULT '1',
			  `site_name` varchar(100) DEFAULT NULL,
			  `site_url` varchar(255) DEFAULT NULL,
			  `site_about` blob DEFAULT NULL,
			  `site_email` varchar(500) DEFAULT NULL,
			  PRIMARY KEY (`id`)
			);
			
			INSERT INTO `" . $this->prefix . "settings` SET site_name = '$site_name', site_url = '$this->site_url';

			CREATE TABLE IF NOT EXISTS IF NOT EXISTS `" . $this->prefix . "users` (
			  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
			  `username` varchar(50) DEFAULT NULL,
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
			  PRIMARY KEY (`id`)
			);
			
			CREATE TABLE IF NOT EXISTS `" . $this->prefix . "predictions` (
			`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
			`cid` int(10) DEFAULT NULL,
			`team` int(10) DEFAULT NULL,
			`comment` varchar(500) DEFAULT NULL,
			`user` varchar(50) DEFAULT NULL,
			`date` timestamp DEFAULT CURRENT_TIMESTAMP,
			PRIMARY KEY (`id`)
			);
			
			CREATE TABLE IF NOT EXISTS `" . $this->prefix . "inbox_original` (
			`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
			`sender` varchar(50) DEFAULT NULL,
			`subject` varchar(250) DEFAULT NULL,
			`message` blob DEFAULT NULL,
			`date` timestamp DEFAULT CURRENT_TIMESTAMP,
			PRIMARY KEY (`id`)
			);
			
			CREATE TABLE IF NOT EXISTS `" . $this->prefix . "inbox_messages` (
			`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
			`msg_id` int(10) DEFAULT NULL,
			`sender` varchar(50) DEFAULT NULL,
			`recipient` varchar(250) DEFAULT NULL,
			`subject` varchar(250) DEFAULT NULL,
			`status` varchar(250) DEFAULT 'unread',
			`date` timestamp DEFAULT CURRENT_TIMESTAMP,
			PRIMARY KEY (`id`)
			);
			
			CREATE TABLE IF NOT EXISTS `" . $this->prefix . "inbox_replies` (
			`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
			`msg_id` int(10) DEFAULT NULL,
			`sender` varchar(50) DEFAULT NULL,
			`message` blob DEFAULT NULL,
			`date` timestamp DEFAULT CURRENT_TIMESTAMP,
			PRIMARY KEY (`id`)
			) ENGINE=MyISAM AUTO_INCREMENT=104 DEFAULT CHARSET=latin1;
			";
			
			mysqli_multi_query($test_connection, $sql);
			
			print "Installation Completed. Please <a href=\"admin\">Login</a>";
		 } else {
			print "<strong>Error</strong> Please check your connection details and try again";
		 }
		}
		
		
/*
 * END INSTALLATION FUNCTIONALITY
 */
		
/*
 * START GENERAL FUNCTIONALITY
 */		
		
		function removeArrayValue($string, $array) {
			//$array = unserialize($array);
			if(($key = array_search($string, $array)) !== false) {
				unset($array[$key]);
			}
		
			return $array;
		}
		
		function sendEmail($to, $from, $name, $msg) {
			$subject = 'ezLeague - Web Site Message';
				
			$headers = "From: " . $from . "\r\n";
			$headers .= "Reply-To: ". $from . "\r\n";
			$headers .= "MIME-Version: 1.0\r\n";
			$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
				
			$message = '<html><body>';
			$message .= '<h1>ezLeague Message</h1>';
			$message .= '<small>The following message was sent from your ezLeague web site</small>';
			$message .= '<table>';
			$message .= '<tr><td><strong>From</strong></td><td>' . $from . '</td></tr>';
			$message .= '<tr><td><strong>Name</strong></td><td>' . $name . '</td></tr>';
			$message .= '<tr><td><strong>Message</strong></td><td>' . $msg . '</td></tr>';
			$message .= '</table>';
			$message .= '</body></html>';
				
			mail($to, $subject, $message, $headers);
			
			print "<strong>Success!</strong> Your message has been sent";
		}
		
/*
 * END GENERAL FUNCTIONALITY
 */		
		
		
		
		/* READ ME
		 * Understanding the query that makes this script tick
		 * 
		 * The base of the following query is more or less the most important query in the entire script.
		 * Since the Guild Name is only stored in the Guilds table, while every other table references guilds
		 * based on their ID, this query result will give you the guild name for both, instead of having to
		 * grab both of the Guild IDs, then run 2 separate queries/functions to grab their Guild Name
		 * and other Guild Details. The beauty is that you can take this query, and modify it (as is done in numerous
		 * other functions), and grab whatever details you need for either Guild. The Schedule and Result functions
		 * both use the base of this query to grab their data. In general, this was the first time I had ever written
		 * queries using this syntax (making a SELECT within a SELECT). Not only did the base of this query prevent
		 * me from having to write numerous extra lines of code, but more importantly, 1 query is being made rather than
		 * splitting it up into 2-3-4 queries. 
		 * 
		 * LEARN IT, LOVE IT, BECOME A BETTER DEV!!!
		 * 
		 * The Query:
		 SELECT t.id, t.challenger, t.g_challenger, t.challengee, g2.guild as g_challengee
			FROM (
			  SELECT c1.id, c1.challenger, g1.guild as g_challenger, c1.challengee
			  FROM Guilds g1
			  JOIN Challenges c1
			  ON g1.id = c1.challenger
			) t 
			JOIN Guilds g2
			ON g2.id = t.challengee
		 *
		 */
		
	}
?>