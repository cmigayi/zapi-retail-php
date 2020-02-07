<?php
require_once("vendor/autoload.php");

use App\Repositories\SessionRepository; 
use App\Middlewares\UserLogout;

/* $verb = $_SERVER['REQUEST_METHOD'];
$url_pieces = explode('/', $_SERVER['PATH_INFO']);
if($url_pieces[1] != "zapi-v1"){	
	return http_response_code(404);
} */

/**
* initialize objects
*/
$sessionRepository = new SessionRepository();

/**
* set repository
*/
$userLogout = new UserLogout($sessionRepository);
$data = $userLogout->userLogout();

$main["content"] = array();
$content["info"] = array();

$info = array();
	
if($data == false){ 
	$info["status"] = false;
}else{
	// Prepare data for json
	$info["status"] = true;
}
array_push($content["info"],$info);
array_push($main["content"],$content);

echo json_encode($main);