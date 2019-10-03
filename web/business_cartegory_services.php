<?php
require_once("vendor/autoload.php");

use App\Middlewares\BusinessCartegoryServices;
use App\Repositories\ServiceRepository;

$serviceCartegoryId = 1;

$serviceRepo = new ServiceRepository();

$businessCartegoryServices = new BusinessCartegoryServices($serviceRepo);
$data = $businessCartegoryServices->getBusinessCartegoryServices($serviceCartegoryId);
//print_r($ownerBusinesses); 
// Count records found
$recordCount = 0;	

$main["content"] = array();
$content["info"] = array();
$content["businessCartegoryServices"] = array();

if($data == null){
	$info["status"] = false;	
}else{
	$info["status"] = true;	
	$recordCount = count($data[0]);
}

$info["records"] = $recordCount;

array_push($content["info"],$info);
array_push($content["businessCartegoryServices"],$data[0]);
array_push($main["content"],$content);

echo json_encode($main, true);