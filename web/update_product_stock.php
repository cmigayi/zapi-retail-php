<?php
require_once("vendor/autoload.php");

use App\Data\ProductStock;
use App\Repositories\ProductStockRepository; 
use App\Middlewares\BusinessProductStockInfo;

//initialize objects
$productStock = new ProductStock();
$productStockRepository = new ProductStockRepository();
$businessProductStockInfo = new BusinessProductStockInfo($productStockRepository);

// Data validation

//$productStockId = $_POST['product_stock_id'];
$productStockId = 2;
$quantity = 8;

//set data
$productStock->setStockId($productStockId);
$productStock->setQuantity($quantity);

$productStock = $businessProductStockInfo->updateStock($productStock);

if($productStock == null){
	$info["status"] = false;
	$info["results"] = 0;
}else{	
	$info["status"] = true;	
	$info["records"] = 1;

	$data = array();
	$data['stock_id'] = $productStock->getStockId();
	$data['product_id'] = $productStock->getProductId();
	$data['business_id'] = $productStock->getBusinessId();
	$data['quantity'] = $productStock->getQuantity();
}
$content["info"] = array();
$content["stock"] = array();
$main["content"] = array();

array_push($content["info"], $info);
array_push($content["stock"], $data);
array_push($main["content"], $content);

echo json_encode($main, true);