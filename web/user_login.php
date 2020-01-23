<?php
require_once("vendor/autoload.php");

//error_reporting(0);

use App\Data\User;
use App\Data\Session;
use App\Repositories\UserRepository; 
use App\Repositories\SessionRepository; 
use App\Middlewares\UserLogin;
use App\Middlewares\AddSession;
use App\Common\Username;
use App\Common\Password;

/* $verb = $_SERVER['REQUEST_METHOD'];
$url_pieces = explode('/', $_SERVER['PATH_INFO']);
if($url_pieces[1] != "zapi-v1"){	
	return http_response_code(404);
} */

/**
* initialize objects
*/
$user = new User();
$session = new Session();
$userRepository = new UserRepository();
$sessionRepository = new SessionRepository();
$username = new Username();
$password = new Password();

/**
* set repository
*/
$userLogin = new UserLogin($userRepository);
$addSession = new AddSession($sessionRepository);

/**
* Data validation
*/

// Username validation
//$userName = $_POST['username'];
$userName = "zap9274";
$username->setUsername($userName);
$userName = $username->validUsername();

// Password validation
//$userPassword = $_POST['password'];
$userPassword = "RI05Sev9";
$password->setPassword($userPassword);
$passWord = $password->validPassword();

/**
* set data
*/
$user->setUsername($userName);
$user->setPassword($passWord);

$main["content"] = array();
$content["info"] = array();
$content["user"] = array();

$info = array();
$data = array();

$info["status"] = false;
$info["records"] = 0;
$info["errors"] = "";

$userSession = null;

//get user	
$user = $userLogin->userLogin($user);	
if($user != null){
	$userSession = $user->getUserSession();
	$userId = $user->getUserId(); 					
}else{
	$info["errors"] .= "Username or password is wrong,";
}
	
if($userSession != null){		
	// Add user session in the database
	$session->setUserId($userId);
	$session->setSessionString($userSession);		
}

$session = $addSession->createSession($session);
if($session != null){
	// Prepare data for json
	$info["status"] = true;
	$info["records"] = 1;
	$info["session"] = $session->getSessionString();
				
	$data["user_id"] = $session->getUserId();
	/* $data["fname"] = $session->getFname();	
	$data["lname"] = $session->getLname(); */
}else{
	$info["errors"] .= "Session not created,";
}

array_push($content["info"],$info);
array_push($content["user"],$data);

array_push($main["content"],$content);

echo json_encode($main);
