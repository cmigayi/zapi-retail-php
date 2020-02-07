<?php
require_once("vendor/autoload.php");

use App\Middlewares\UserInfo;
use App\Repositories\UserRepository;
use App\Data\User;

$verb = $_SERVER['REQUEST_METHOD'];
$url_pieces = explode('/', $_SERVER['PATH_INFO']);
if($url_pieces[1] != "zapi-v1"){	
	return http_response_code(404);
}

$userId = $url_pieces[3];
//$userId = 116;

$userRepo = new UserRepository();

$user = new User();
$userInfo = new UserInfo($userRepo);
$user = $userInfo->getUser($userId);
//print_r($ownerBusinesses); 
// Count records found
$recordCount = 0;	

$main["content"] = array();
$content["info"] = array();
$content["user"] = array();

if($user == null){
	$info["status"] = false;	
}else{
	$recordCount = 1;

	$info["status"] = true;	

	$data = array();
	$data['user_id'] = $user->getUserId();
	$data['fname'] = $user->getFname();
	$data['lname'] = $user->getLname();
	$data['email'] = $user->getEmail();
	$data['phone'] = $user->getPhone();
	$data['username'] = $user->getUsername();
	$data['password'] = $user->getPassword();
	$data['date_time'] = $user->getDateTime();
}

$info["records"] = $recordCount;

array_push($content["info"],$info);
array_push($content["user"],$data);
array_push($main["content"],$content);

echo json_encode($main, true);