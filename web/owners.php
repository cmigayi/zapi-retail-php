<?php
require_once("vendor/autoload.php");

use App\Data\Owner;
use App\Repositories\OwnerRepository; 
use App\Middlewares\Owners;

//initialize objects
$owner = new Owner();
$ownerRepository = new OwnerRepository();

$owners = new Owners($ownerRepository);
$data = $owners->getOwners();

if($data == null){
	$info["status"] = false;	
}else{
	$recordCount = count($data[0]);	
	$info["status"] = true;
	$info["records"] = $recordCount;	
}

$main["content"] = array();
$content["info"] = array();
$content["owners"] = array();

array_push($content["info"],$info);
array_push($content["owners"],$data[0]);
array_push($main["content"],$content);

echo json_encode($main, true);