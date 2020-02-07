<?php
require_once("vendor/autoload.php");

use App\Data\Owner;
use App\Repositories\OwnerRepository; 
use App\Middlewares\OwnerInfo;

//initialize objects
$owner = new Owner();
$ownerRepository = new OwnerRepository();

// Validate inputs
//$ownerId = $_POST['owner_id'];
$ownerId = 2;

$ownerInfo = new OwnerInfo($ownerRepository);
$owner = $ownerInfo->getOwner($ownerId);

if($owner == null){
	$info["status"] = false;	
}else{
	$recordCount = 1;	
	$info["status"] = true;
	$data['owner_id'] = $owner->getOwnerId();
	$data['fname'] = $owner->getFname();
	$data['lname'] = $owner->getLname();
	$data['email'] = $owner->getEmail();
	$data['phone'] = $owner->getPhone();
	$data['username'] = $owner->getUsername();
	$data['password'] = $owner->getPassword();
	$data['date_time'] = $owner->getDateTime();	
}

$main["content"] = array();
$content["info"] = array();
$content["owner"] = array();

array_push($content["info"],$info);
array_push($content["owner"],$data);
array_push($main["content"],$content);

echo json_encode($main, true);