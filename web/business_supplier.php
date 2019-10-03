<?php
require_once("vendor/autoload.php");

use App\Middlewares\BusinessSupplier;
use App\Repositories\SupplierRepository;

$businessId = 1;

$supplierRepo = new SupplierRepository();

$businessSupplier = new BusinessSupplier($supplierRepo);
$data = $businessSupplier->getBusinessSupplier($businessId);
//print_r($ownerBusinesses); 
// Count records found
$recordCount = 0;	

$main["content"] = array();
$content["info"] = array();
$content["businessSupplier"] = array();

if($data == null){
	$info["status"] = false;	
}else{
	$info["status"] = true;	
	$recordCount = count($data[0]);
}

$info["records"] = $recordCount;

array_push($content["info"],$info);
array_push($content["businessSupplier"],$data[0]);
array_push($main["content"],$content);

echo json_encode($main, true);