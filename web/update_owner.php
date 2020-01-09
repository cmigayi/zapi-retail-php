<?php
require_once("vendor/autoload.php");

use App\Data\Owner;
use App\Repositories\OwnerRepository; 
use App\Middlewares\OwnerInfo;

use App\Common\Email;
use App\Common\Phone;
use App\Common\InputValidator;
use App\Common\Username;
use App\Common\Password;

//initialize objects
$owner = new Owner();
$ownerRepository = new OwnerRepository();
$ownerInfo = new OwnerInfo($ownerRepository);
$email = new Email();
$phone = new Phone();
$inputValidator = new InputValidator();

// Data validation

//$ownerId = $_POST['owner_id'];
$ownerId = 2;

// Firstname validation
//$fname = $_POST['fname'];
$fname = "Cilo23";
$fname = $inputValidator->validateInput($fname);

// Lastname validation
//$lname = $_POST['lname'];
$lname = "Cilo";
$lname = $inputValidator->validateInput($lname);

// Email validation
//$ownerEmail = $_POST['email'];
$ownerEmail = "cilo@gmail.com";
$email->setEmail($ownerEmail); 
$ownerEmail = $email->validEmail();

// Phone validation
//$ownerPhone = $_POST['phone'];
$ownerPhone = "0718485173";
$phone->setPhoneNumber($ownerPhone);
$ownerPhone = $phone->validPhoneNumber();

// set data
$owner->setOwnerId($ownerId);
$owner->setFname($fname);
$owner->setLname($lname);
$owner->setEmail($ownerEmail);
$owner->setPhone($ownerPhone);

if(empty($ownerEmail) || empty($ownerPhone)){
	//Validation failed 
	$info["status"] = false;
	$info["records"] = 0;
}else{
	$owner = $ownerInfo->updateOwner($owner);

	if($owner == null){
		$info["status"] = false;	
		$info["result"] = 0;	
	}else{	
		$info["status"] = true;
		$info["result"] = 1;
		$data['owner_id'] = $owner->getOwnerId();
		$data['fname'] = $owner->getFname();
		$data['lname'] = $owner->getLname();
		$data['email'] = $owner->getEmail();
		$data['phone'] = $owner->getPhone();
		$data['username'] = $owner->getUsername();
		$data['password'] = $owner->getPassword();
		$data['date_time'] = $owner->getDateTime();	
	}
}

$main["content"] = array();
$content["info"] = array();
$content["owner"] = array();

array_push($content["info"],$info);
array_push($content["owner"],$data);
array_push($main["content"],$content);

echo json_encode($main, true);