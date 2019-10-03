<?php
require_once("vendor/autoload.php");

use App\Data\SuppliedProduct;
use App\Repositories\SuppliedProductRepository; 
use App\Middlewares\AddSuppliedProduct;
use App\Common\ErrorLogger;

//initialize objects
$suppliedProduct = new SuppliedProduct();
$suppliedProductRepository = new SuppliedProductRepository();
$log = new ErrorLogger("add_supplied_product_sale");
$log = $log->initLog();

//Data validation
$productId = 1;
$supplierId = 1;
$businessId = 1;
$quantity = 5;
$unitPrice = 500;
$paymentStatus = "Credit";

//set data
$suppliedProduct->setProductId($productId);
$suppliedProduct->setSupplierId($supplierId);
$suppliedProduct->setBusinessId($businessId);
$suppliedProduct->setQuantity($quantity);
$suppliedProduct->setUnitPrice($unitPrice);
$suppliedProduct->setPaymentStatus($paymentStatus);

//set repository
$addSuppliedProduct = new AddSuppliedProduct($suppliedProductRepository);

try{
	$suppliedProduct = $addSuppliedProduct->createSuppliedProduct($suppliedProduct);
	echo $suppliedProduct->getSuppliedProductId()." ".$suppliedProduct->getProductId();

}catch(\Exception $e){
	// logger
	$log->error("Error ".$e->getMessage());
}