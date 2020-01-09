<?php
require_once("vendor/autoload.php");

use App\Middlewares\BusinessCartegoryService;
use App\Repositories\ServiceRepository;

$serviceId = 1;

$serviceRepo = new ServiceRepository();

$businessCartegoryService = new BusinessCartegoryService($serviceRepo);
$data = $businessCartegoryService->getBusinessCartegoryService($serviceId);

$main["content"] = array();
$content["info"] = array();
$content["service"] = array();

if($data == null){
	$info["status"] = false;	
}else{
	$info["status"] = true;	
	$recordCount = count($data[0]);
}

$info["records"] = $recordCount;

array_push($content["info"],$info);
array_push($content["service"],$data[0]);
array_push($main["content"],$content);

echo json_encode($main, true);