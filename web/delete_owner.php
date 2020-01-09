<?php
require_once("vendor/autoload.php");

use App\Data\Owner;
use App\Repositories\OwnerRepository; 
use App\Middlewares\OwnerInfo;
use App\Common\Email;
use App\Common\Phone;
use App\Common\InputValidator;

//initialize objects
$owner = new Owner();
$ownerRepository = new OwnerRepository();
$ownerInfo = new OwnerInfo($ownerRepository);

// Data validation

//$ownerId = $_POST['owner_id'];
$ownerId = 4;

$data = $ownerInfo->deleteOwner($ownerId);

if($data == null){
	$info["status"] = false;	
}else{	
	$info["status"] = true;
}

$main["content"] = array();
$content["info"] = array();

array_push($content["info"],$info);
array_push($main["content"],$content);

echo json_encode($main, true);