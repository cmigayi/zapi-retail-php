<?php
require_once("vendor/autoload.php");

use App\Middlewares\BusinessSupplierProducts;
use App\Repositories\SupplierProductRepository;

$businessId = 1;

$supplierProductRepo = new SupplierProductRepository();

$businessSupplierProducts = new BusinessSupplierProducts($supplierProductRepo);
$data = $businessSupplierProducts->getBusinessSupplierProducts($businessId);
//print_r($ownerBusinesses); 
// Count records found
$recordCount = 0;	

$main["content"] = array();
$content["info"] = array();
$content["businessSupplierProducts"] = array();

if($data == null){
	$info["status"] = false;	
}else{
	$info["status"] = true;	
	$recordCount = count($data[0]);
}

$info["records"] = $recordCount;

array_push($content["info"],$info);
array_push($content["businessSupplierProducts"],$data[0]);
array_push($main["content"],$content);

echo json_encode($main, true);