<?php
require_once("vendor/autoload.php");

use App\Data\SupplierProduct;
use App\Repositories\SupplierProductRepository; 
use App\Middlewares\AddSupplierProduct;
use App\Common\ErrorLogger;

//initialize objects
$supplierProduct = new SupplierProduct();
$supplierProductRepository = new SupplierProductRepository();
$log = new ErrorLogger("add_supplier_product_sale");
$log = $log->initLog();

//Data validation
$productId = 1;
$supplierId = 1;
$businessId = 1;

//set data
$supplierProduct->setProductId($productId);
$supplierProduct->setSupplierId($supplierId);
$supplierProduct->setBusinessId($businessId);

//set repository
$addSupplierProduct = new AddSupplierProduct($supplierProductRepository);

try{
	$supplierProduct = $addSupplierProduct->createSupplierProduct($supplierProduct);
	echo $supplierProduct->getSupplierProductId()." ".$supplierProduct->getProductId();

}catch(\Exception $e){
	// logger
	$log->error("Error ".$e->getMessage());
}