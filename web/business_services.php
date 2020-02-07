<?php
require_once("vendor/autoload.php");

use App\Middlewares\BusinessServices;
use App\Repositories\ServiceRepository;

$businessId = 3;

$serviceRepo = new ServiceRepository();

$businessServices = new BusinessServices($serviceRepo);
$data = $businessServices->getBusinessServices($businessId);

$main["content"] = array();
$content["info"] = array();
$content["services"] = array();

if($data == null){
	$info["status"] = false;
	$info["records"] = 0;	
}else{
	$info["status"] = true;	
	$info["records"] = count($data[0]);
}

array_push($content["info"],$info);
array_push($content["services"],$data[0]);
array_push($main["content"],$content);

echo json_encode($main, true);