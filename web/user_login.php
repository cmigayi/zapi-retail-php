<?php
require_once("vendor/autoload.php");

use App\Data\User;
use App\Repositories\UserRepository; 
use App\Middlewares\UserLogin;
use App\Common\Username;
use App\Common\Password;

/**
* initialize objects
*/
$user = new User();
$userRepository = new UserRepository();
$username = new Username();
$password = new Password();

/**
* set repository
*/
$userLogin = new UserLogin($userRepository);

/**
* Data validation
*/

// Username validation
$userName = "zap3159";
$username->setUsername($userName);
$userName = $username->validUsername();

// Password validation
$userPassword = "HnNtFtGF";
$password->setPassword($userPassword);
$passWord = $password->validPassword();

/**
* set data
*/
$user->setUsername($userName);
$user->setPassword($userPassword);

if(empty($userName)){
	//Validation failed
}else{	
	//get user	
	$user = $userLogin->userLogin($user);

	// Count records found
	$recordCount = 0;

	$main["content"] = array();
	$content["info"] = array();
	$content["user"] = array();

	$info = array();	
	if($user == null){ 
		$info["status"] = false;
	}else{	
		$info["status"] = true;
		$recordCount++;	

		$data = array();
		$data["user_id"] = $user->getUserId();
		$data["fname"] = $user->getFname();	

		$info["records"] = $recordCount;	
	}
	array_push($content["info"],$info);
	array_push($content["user"],$data);

	array_push($main["content"],$content);

	$json = json_encode($main);
	echo $json;

	$obj = json_decode($json,true);
	echo "<br/>".$obj['content'][0]['info'][0]['status']."<br/>"; 
	//print_r($obj['content'][0]); 
	echo $obj['content'][0]['user'][0]['fname'];	
}