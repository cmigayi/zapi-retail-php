<?php
require_once("vendor/autoload.php");
//error_reporting(0);

use App\Data\Service;
use App\Repositories\ServiceRepository; 
use App\Middlewares\AddService;
use App\Common\ErrorLogger;

//initialize objects
$service = new Service();
$serviceRepository = new ServiceRepository();

//Data validation
//$serviceCartegoryId = $_POST['service_cartegory'];
$serviceCartegoryId = 1;
//$employeeId = $_POST['employee_id'];
$employeeId = 1;
//$businessId = $_POST['business_id'];
$businessId = 3;
//$serviceName = $_POST['service_name'];
$serviceName = "Outdoor olar lighting";
//$serviceDesc = $_POST['desc'];
$serviceDesc = "";
//$fee = $_POST['fee'];
$fee = "400";

//set data
$service->setServiceCartegoryId($serviceCartegoryId);
$service->setEmployeeId($employeeId);
$service->setBusinessId($businessId);
$service->setServiceName($serviceName);
$service->setServiceDesc($serviceDesc);
$service->setFee($fee);

//set repository
$addService = new AddService($serviceRepository);

$service = $addService->createService($service);

$main["content"] = array();
$content["info"] = array();
$content["service"] = array();

if($service == null){
	$info["status"] = false;
	$info["records"] = 0;	
}else{
	$info["status"] = true;	
	$info["records"] = 1;
	
	$data['service_id'] = $service->getServiceId(); 
	$data['service_cartegory_id'] = $service->getServiceCartegoryId(); 
	$data['employee_id'] = $service->getEmployeeId(); 
	$data['business_id'] = $service->getBusinessId(); 
	$data['service_name'] = $service->getServiceName(); 
	$data['service_desc'] = $service->getServiceDesc(); 
	$data['fee'] = $service->getFee(); 
	$data['date_time'] = $service->getDateTime(); 
}

array_push($content["info"],$info);
array_push($content["service"],$data);
array_push($main["content"],$content);

echo json_encode($main, true);