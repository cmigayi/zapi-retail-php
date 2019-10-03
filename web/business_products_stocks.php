<?php
require_once("vendor/autoload.php");

use App\Middlewares\BusinessProductsStocks;
use App\Repositories\ProductStockRepository;

$businessId = 1;

$productStockRepo = new ProductStockRepository();

$businessProductsStocks = new BusinessProductsStocks($productStockRepo);
$data = $businessProductsStocks->getBusinessProductsStocks($businessId);
//print_r($ownerBusinesses); 
// Count records found
$recordCount = 0;	

$main["content"] = array();
$content["info"] = array();
$content["businessProductsStocks"] = array();

if($data == null){
	$info["status"] = false;	
}else{
	$info["status"] = true;	
	$recordCount = count($data[0]);
}

$info["records"] = $recordCount;

array_push($content["info"],$info);
array_push($content["businessProductsStocks"],$data[0]);
array_push($main["content"],$content);

echo json_encode($main, true);