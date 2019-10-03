<?php
require_once("vendor/autoload.php");

use App\Data\ProductStock;
use App\Repositories\ProductStockRepository; 
use App\Middlewares\AddStock;
use App\Common\ErrorLogger;

//initialize objects
$productStock = new ProductStock();
$productStockRepository = new ProductStockRepository();
$log = new ErrorLogger("add_stock");
$log = $log->initLog();

//Data validation
$businessId = 1;
$productId = 1;
$quantity = 5;

//set data
$productStock->setBusinessId($businessId);
$productStock->setProductId($productId);
$productStock->setQuantity($quantity);

//set repository
$addStock = new AddStock($productStockRepository);

try{
	$productStock = $addStock->createProductStock($productStock);
	echo $productStock->getStockId()." ".$productStock->getProductId();

}catch(\Exception $e){
	// logger
	$log->error("Error ".$e->getMessage());
}