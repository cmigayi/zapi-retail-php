<?php
require_once("vendor/autoload.php");

use App\Data\Service;
use App\Repositories\ServiceRepository; 
use App\Middlewares\AddService;
use App\Common\ErrorLogger;

//initialize objects
$service = new Service();
$serviceRepository = new ServiceRepository();
$log = new ErrorLogger("add_service");
$log = $log->initLog();

//Data validation
$serviceCartegoryId = 1;
$serviceName = "Consulting";
$serviceDesc = "";
$fee = 40;
$createdBy = 1;

//set data
$service->setServiceCartegoryId($serviceCartegoryId);
$service->setServiceName($serviceName);
$service->setServiceDesc($serviceDesc);
$service->setFee($fee);
$service->setCreatedBy($createdBy);

//set repository
$addService = new AddService($serviceRepository);

try{
	$service = $addService->createService($service);
	echo $service->getServiceId()." ".$service->getServiceName();

}catch(\Exception $e){
	// logger
	$log->error("Error ".$e->getMessage());
}