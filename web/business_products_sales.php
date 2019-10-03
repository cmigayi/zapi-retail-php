<?php
require_once("vendor/autoload.php");

use App\Middlewares\BusinessProductsSales;
use App\Repositories\ProductSaleRepository;

$businessId = 1;

$productSaleRepo = new ProductSaleRepository();

$businessProductsSales = new BusinessProductsSales($productSaleRepo);
$data = $businessProductsSales->getBusinessProductsSales($businessId);
//print_r($ownerBusinesses); 
// Count records found
$recordCount = 0;	

$main["content"] = array();
$content["info"] = array();
$content["businessProductsSales"] = array();

if($data == null){
	$info["status"] = false;	
}else{
	$info["status"] = true;	
	$recordCount = count($data[0]);
}

$info["records"] = $recordCount;

array_push($content["info"],$info);
array_push($content["businessProductsSales"],$data[0]);
array_push($main["content"],$content);

echo json_encode($main, true);