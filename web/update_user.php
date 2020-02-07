<?php
require_once("vendor/autoload.php");

use App\Data\User;
use App\Repositories\UserRepository; 
use App\Middlewares\UserInfo;

use App\Common\Email;
use App\Common\Phone;
use App\Common\InputValidator;
use App\Common\Username;
use App\Common\Password;

$verb = $_SERVER['REQUEST_METHOD'];
$url_pieces = explode('/', $_SERVER['PATH_INFO']);
if($url_pieces[1] != "zapi-v1"){	
	return http_response_code(404);
}
$userId = $url_pieces[3];
//$userId = 116; 

//initialize objects
$user = new User();
$userRepository = new UserRepository();
$userInfo = new UserInfo($userRepository);
$email = new Email();
$phone = new Phone();
$inputValidator = new InputValidator();

//Data validation
// Firstname validation
$fname = $_POST['fname'];
//$fname = "Cilo";
$fname = $inputValidator->validateInput($fname);

// Lastname validation
$lname = $_POST['lname'];
//$lname = "Cilo";
$lname = $inputValidator->validateInput($lname);

// Email validation
$userEmail = $_POST['email'];
//$userEmail = "cilo@gmail.com";
$email->setEmail($userEmail); 
$userEmail = $email->validEmail();

// Phone validation
$userPhone = $_POST['phone'];
//$userPhone = "0718485173";
$phone->setPhoneNumber($userPhone);
$userPhone = $phone->validPhoneNumber();

/*
* set data 
*/

$user->setUserId($userId);
$user->setFname($fname);
$user->setLname($lname);
$user->setEmail($userEmail);
$user->setPhone($userPhone);

$main["content"] = array();
$content["info"] = array();
$content["user"] = array();
$info = array();
$data = array();

if(empty($userEmail) || empty($userPhone)){
	//Validation failed 
	$info["status"] = false;
	$info["records"] = 0;	
}else{
	$user = $userInfo->updateUser($user);
	
	if($user != null){
		$info["status"] = true;
		$info["records"] = 1;
		$data['user_id'] = $user->getUserId();
		$data['fname'] = $user->getFname();
		$data['lname'] = $user->getLname();
		$data['email'] = $user->getEmail();
		$data['phone'] = $user->getPhone();
	}
}

array_push($content["info"],$info);
array_push($content["user"],$data);
array_push($main["content"],$content);

echo json_encode($main, true);