<?php
require_once("vendor/autoload.php");

use App\Middlewares\BusinessProductStockInfo;
use App\Repositories\ProductStockRepository;
use App\Data\ProductStock;

//$productStockId = $_POST['stock_id'];
$productStockId = 2;

$productStockRepo = new ProductStockRepository();

$productStock = new ProductStock();
$businessProductStockInfo = new BusinessProductStockInfo($productStockRepo);
$productStock = $businessProductStockInfo->getStock($productStockId);

if($productStock == null){
	$info["status"] = false;
	$info["records"] = 0;	
}else{
	$info["status"] = true;	
	$info["records"] = 1;

	$data = array();
	$data['stock_id'] = $productStock->getStockId();
	$data['product_id'] = $productStock->getProductId();
	$data['business_id'] = $productStock->getBusinessId();
	$data['quantity'] = $productStock->getQuantity();
	$data['date_time'] = $productStock->getDateTime();
}

$main["content"] = array();
$content["info"] = array();
$content["stock"] = array();

array_push($content["info"],$info);
array_push($content["stock"],$data);
array_push($main["content"],$content);

echo json_encode($main, true);