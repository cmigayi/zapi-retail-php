<?php
require_once("vendor/autoload.php");

use App\Middlewares\BusinessAgent;
use App\Repositories\BusinessRoleRepository;
use App\Data\BusinessRole;

$businessId = 7;
$userId = 34;

$businessRoleRepo = new BusinessRoleRepository();

$businessAgent = new BusinessAgent($businessRoleRepo);
$data = $businessAgent->getBusinessAgent($businessId,$userId);
//print_r($ownerBusinesses); 
// Count records found
$recordCount = count($data[0]);	

$main["content"] = array();
$content["info"] = array();
$content["businessAgent"] = array();

if($data == null){
	$info["status"] = false;	
}else{
	$info["status"] = true;	
}

$info["records"] = $recordCount;

array_push($content["info"],$info);
array_push($content["businessAgent"],$data[0]);
array_push($main["content"],$content);

echo json_encode($main, true);