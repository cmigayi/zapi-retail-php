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
//$businessId = $_POST['business_id'];
$businessId = 1;
//$productId = $_POST['prod_id'];
$productId = 1;
//$quantity = $_POST['quantity'];
$quantity = 3;

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