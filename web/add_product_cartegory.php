<?php
require_once("vendor/autoload.php");

use App\Data\ProductCartegory;
use App\Repositories\ProductCartegoryRepository; 
use App\Middlewares\AddProductCartegory;
use App\Common\ErrorLogger;

//initialize objects
$productCartegory = new ProductCartegory();
$productCartegoryRepository = new ProductCartegoryRepository();
$log = new ErrorLogger("add_product_cartegory");
$log = $log->initLog();

//Data validation
$businessId = 1;
$cartegoryName = "Lab services";
$cartegoryDesc = "";
$createdBy = 1;

//set data
$productCartegory->setBusinessId($businessId);
$productCartegory->setCartegoryName($cartegoryName);
$productCartegory->setCartegoryDesc($cartegoryDesc);
$productCartegory->setCreatedBy($createdBy);

//set repository
$addProductCartegory = new AddProductCartegory($productCartegoryRepository);

try{
	$productCartegory = $addProductCartegory->createProductCartegory($productCartegory);
	echo $productCartegory->getProductCartegoryId()." ".$productCartegory->getCartegoryName();

}catch(\Exception $e){
	// logger
	$log->error("Error ".$e->getMessage());
}