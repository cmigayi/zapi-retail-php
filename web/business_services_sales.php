<?php
require_once("vendor/autoload.php");

use App\Middlewares\BusinessServicesSales;
use App\Repositories\ServiceSaleRepository;

$businessId = 1;

$serviceSaleRepo = new ServiceSaleRepository();

$businessServicesSales = new BusinessServicesSales($serviceSaleRepo);
$data = $businessServicesSales->getBusinessServicesSales($businessId);
//print_r($ownerBusinesses); 
// Count records found
$recordCount = 0;	

$main["content"] = array();
$content["info"] = array();
$content["businessServicesSales"] = array();

if($data == null){
	$info["status"] = false;	
}else{
	$info["status"] = true;	
	$recordCount = count($data[0]);
}

$info["records"] = $recordCount;

array_push($content["info"],$info);
array_push($content["businessServicesSales"],$data[0]);
array_push($main["content"],$content);

echo json_encode($main, true);