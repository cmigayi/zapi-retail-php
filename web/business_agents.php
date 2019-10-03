<?php
require_once("vendor/autoload.php");

use App\Middlewares\BusinessAgents;
use App\Repositories\BusinessRoleRepository;
use App\Data\BusinessRole;

$businessId = 7;

$businessRoleRepo = new BusinessRoleRepository();

$businessAgents = new BusinessAgents($businessRoleRepo);
$data = $businessAgents->getBusinessAgents($businessId);
//print_r($ownerBusinesses); 
// Count records found
$recordCount = count($data[0]);	

$main["content"] = array();
$content["info"] = array();
$content["businessAgents"] = array();

if($data == null){
	$info["status"] = false;	
}else{
	$info["status"] = true;	
}

$info["records"] = $recordCount;

array_push($content["info"],$info);
array_push($content["businessAgents"],$data[0]);
array_push($main["content"],$content);

echo json_encode($main, true);