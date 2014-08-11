<?php session_start();
    include('lib/db.class.php');
	include('lib/ezleague.class.php');
    $ez = new ezLeague();
    if(isset($_POST['form'])) {
    	$form = strip_tags($_POST['form']);
    	 switch($form) {
    	 	case 'login':
    	 		$username = $_POST['username'];
    	 		$password = $_POST['password'];
    	 		 $ez->login($username, $password);
    	 	 break;
    	 	 case 'register':
    	 	 	$username	= $_POST['username'];
    	 	 	$password	= $_POST['password'];
    	 	 	$confirm	= $_POST['confirm'];
    	 	 	$email		= $_POST['email'];
    	 	 	 $ez->register($username, $password, $email);
    	 	 	break;
    	 	 case 'new_password':
    	 	 	$id 		= $_POST['user_id'];
    	 	 	$password	= $_POST['password'];
    	 	 	 $ez->changePassword($id, $password);
    	 	 	break;
    	 	 case 'new_email':
    	 	 	$id 		= $_POST['user_id'];
    	 	 	$email		= $_POST['email'];
    	 	 	 $ez->updateEmail($id, $email);
    	 	 	break;
/*
 * START NEWS
 */    	 	 
    	 	case 'addNews':
	    	 	$title     = $_POST['title'];
	    	 	$body      = $_POST['body'];
	    	 	$author    = $_POST['author'];
	    	 	$category  = $_POST['category'];
	    	 	$game	   = $_POST['game'];
	    	 	$published = $_POST['published'];
	    	 	 $ez->addNews($title, $body, $author, $category, $game, $published);
	    	 break;
	    	case 'editNews':
	    		$id		   = $_POST['id'];
	    	 	$title     = $_POST['title'];
	    	 	$body      = $_POST['body'];
	    	 	$author    = $_POST['author'];
	    	 	$category  = $_POST['category'];
	    	 	$game	   = $_POST['game'];
	    	 	$published = $_POST['published'];
	    	 	 $ez->editNews($id, $title, $body, $author, $category, $game, $published);
	    	 break;
	    	case 'deleteNewsPost':
	    		$id			= $_POST['id'];
	    		 $ez->deleteNews($id);
	    	 break;
	    	case 'unpublishPost':
	    		$id		   = $_POST['id'];
	    		 $ez->unpublishPost($id);
	    	 break;
    	 	case 'addNewsCategory':
    	 		$category = $_POST['category'];
    	 		 $ez->addNewsCategory($category);
    	 	 break;
    	 	case 'deleteNewsCategory':
    	 		$category_id = $_POST['id'];
    	 		 $ez->deleteNewsCategory($category_id); 
    	 	 break;
/*
 * END NEWS
 */    	 	
/*
 * START LEAGUES
 */    	 	 
    	 	case 'addNewLeague':
    	 		$league		= $_POST['league'];
    	 		$game 		= $_POST['game'];
    	 		$teams 		= $_POST['teams'];
    	 		$start		= $_POST['start'];
    	 		$end		= $_POST['end'];
    	 		$games		= $_POST['games'];
    	 		$win		= $_POST['win'];
    	 		$loss		= $_POST['loss'];
    	 		$tie		= $_POST['tie'];
    	 		 $ez->addLeague($league, $game, $teams, $start, $end, $games, $win, $loss, $tie);
    	 	 break;
    	 	case 'deleteLeague':
    	 		$league_id	= $_POST['id'];
    	 		 $ez->deleteLeague($league_id);
    	 	 break;
    	 	case 'editRules':
    	 		$league_id  = $_POST['league_id'];
    	 		$rules		= $_POST['rules'];
    	 		 $ez->editLeagueRules($league_id, $rules);
    	 	 break;
    	 	case 'editPoints':
    	 		$league_id	= $_POST['league_id'];
    	 		$win		= $_POST['win'];
    	 		$loss		= $_POST['loss'];
    	 		$tie		= $_POST['tie'];
    	 		 $ez->updateLeaguePoints($league_id, $win, $loss, $tie);
    	 	 break;
    	 	case 'kickTeam':
    	 		$team_id	= $_POST['team_id'];
    	 		$league_id  = $_POST['league_id'];
    	 		$reason		= $_POST['reason'];
    	 		 $ez->kickTeamFromLeague($league_id, $team_id, $reason);
    	 	 break;
/*
 * END LEAGUES
 */    	 	
/*
 * START MATCHES
 */
    	 	case 'editMatch':
    	 		$match_id		   = $_POST['match_id'];
    	 		$league_id		   = $_POST['league_id'];
    	 		$challenger		   = $_POST['challenger'];
    	 		$challenger_score  = $_POST['challenger_score'];
    	 		$challenger_status = $_POST['challenger_status'];
    	 		$challengee		   = $_POST['challengee'];
    	 		$challengee_score  = $_POST['challengee_score'];
    	 		$challengee_status = $_POST['challengee_status'];
    	 		 $ez->editMatch($league_id, $match_id, $challenger, $challenger_score, $challenger_status, $challengee, $challengee_score, $challengee_status);
    	 		break;
    	 	case 'updateDispute':
    	 		$match_id			= $_POST['id'];
    	 		$status				= $_POST['status'];
    	 		 $ez->updateDispute($match_id, $status);
    	 		break;
/*
 * END MATCHES
 */
/*
 * START USERS
 */    	 		
    	 	case 'suspendUser':
    	 		$id 		= $_POST['id'];
    	 		$status		= $_POST['status'];
    	 		 $ez->toggleSuspendUser($id, $status);
    	 		break;
    	 	case 'toggleRoleUser':
    	 		$id			= $_POST['id'];
    	 		$role		= $_POST['role'];
    	 		 $ez->toggleRoleUser($id, $role);
    	 		break;
    	 	case 'deleteUser':
    	 		$id			= $_POST['id'];
    	 		 $ez->deleteUser($id);
    	 		break;
    	 	case 'create-admin':
    	 		$username	= $_POST['username'];
    	 		$password	= $_POST['password'];
    	 		$confirm	= $_POST['confirm'];
    	 		$email		= $_POST['email'];
    	 		 $ez->createAdmin($username, $password, $email);
    	 		break;
/*
 * END USERS
 */    	
/*
 * START FORUM
 */    	 		
    	 	case 'addForum':
    	 		$forum			= $_POST['forum'];
    	 		$type			= $_POST['type'];
    	 		 $ez->addForum($forum, $type);
    	 		break;
    	 	case 'updateForum':
    	 		$section_id		= $_POST['section_id'];
    	 		$status			= $_POST['status'];
    	 		 $ez->updateForumStatus($section_id, $status);
    	 		break;
/*
 * END FORUM
 */    	 		
/*
 * START SETTINGS
 */    	 	 
    	 	 case 'addNewGame':
    	 	 	$game		= $_POST['game'];
    	 	 	$slug		= $_POST['slug'];
    	 	 	 $ez->addSettingsGame($game, $slug);
    	 	  break;
    	 	 case 'deleteGame':
    	 	 	$id			= $_POST['id'];
    	 	 	 $ez->deleteSettingsGame($id);
    	 	  break;
    	 	 case 'siteSettingsName':
    	 	 	$name		= $_POST['name'];
    	 	 	 $ez->siteSettingsName($name);
    	 	  break;
    	 	 case 'siteSettingsURL':
    	 	 	$url		= $_POST['url'];
    	 	 	 $ez->siteSettingsURL($url);
    	 	  break;
    	 	 case 'siteSettingsContact':
    	 	 	$email		= $_POST['email'];
    	 	 	 $ez->siteSettingsContact($email);
    	 	  break;
    	 	 case 'siteSettingsAbout':
    	 	 	$content	= $_POST['content'];
    	 	 	 $ez->siteSettingsAbout($content);
    	 	  break;
    	 	 case 'create-admin':
    	 	 	$username	= $_POST['username'];
    	 	 	$email		= $_POST['email'];
    	 	 	$password   = $_POST['password'];
    	 	 	$confirm	= $_POST['confirm'];
    	 	 	 $ez->createAdmin($username, $password, $email);
    	 	  break;
/*
 * END SETTINGS
 */    	 	 
    	 	default:
    	 		break;
    	 }
    }
?>