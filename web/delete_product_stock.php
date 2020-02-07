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

$data = $businessProductStockInfo->deleteStock($productStockId);

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