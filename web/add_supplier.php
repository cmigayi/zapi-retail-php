<?php
require_once("vendor/autoload.php");

use App\Data\Supplier;
use App\Repositories\SupplierRepository; 
use App\Middlewares\AddSupplier;
use App\Common\ErrorLogger;

//initialize objects
$supplier = new Supplier();
$supplierRepository = new SupplierRepository();
$log = new ErrorLogger("add_supplier");
$log = $log->initLog();

//Data validation
$businessId = 1;
$supplierName = "Ibrahim logistics";
$phone = "0734567890";
$email = "ibra@gmail.com";

//set data
$supplier->setBusinessId($businessId);
$supplier->setSupplierName($supplierName);
$supplier->setPhone($phone);
$supplier->setEmail($email);

//set repository
$addSupplier = new AddSupplier($supplierRepository);

try{
	$supplier = $addSupplier->createSupplier($supplier);
	echo $supplier->getSupplierId()." ".$supplier->getBusinessId();

}catch(\Exception $e){
	// logger
	$log->error("Error ".$e->getMessage());
}