<?php
require_once("vendor/autoload.php");

use App\Data\Service;
use App\Repositories\ServiceRepository; 
use App\Middlewares\BusinessCartegoryService;

//initialize objects
$service = new Service();
$serviceRepository = new ServiceRepository();
$businessCartegoryService = new BusinessCartegoryService($serviceRepository);

// Data validation

//$serviceId = $_POST['service_id'];
$serviceId = 1;

$data = $businessCartegoryService->deleteBusinessService($serviceId);

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