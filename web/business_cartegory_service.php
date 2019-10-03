<?php
require_once("vendor/autoload.php");

use App\Middlewares\BusinessCartegoryService;
use App\Repositories\ServiceRepository;

$serviceId = 1;

$serviceRepo = new ServiceRepository();

$businessCartegoryService = new BusinessCartegoryService($serviceRepo);
$data = $businessCartegoryService->getBusinessCartegoryService($serviceId);
//print_r($ownerBusinesses); 
// Count records found
$recordCount = 0;	

$main["content"] = array();
$content["info"] = array();
$content["businessCartegoryService"] = array();

if($data == null){
	$info["status"] = false;	
}else{
	$info["status"] = true;	
	$recordCount = count($data[0]);
}

$info["records"] = $recordCount;

array_push($content["info"],$info);
array_push($content["businessCartegoryService"],$data[0]);
array_push($main["content"],$content);

echo json_encode($main, true);