<?php
require_once("vendor/autoload.php");

use App\Middlewares\BusinessSuppliers;
use App\Repositories\SupplierRepository;

$businessId = 1;

$supplierRepo = new SupplierRepository();

$businessSuppliers = new BusinessSuppliers($supplierRepo);
$data = $businessSuppliers->getBusinessSuppliers($businessId);
//print_r($ownerBusinesses); 
// Count records found
$recordCount = 0;	

$main["content"] = array();
$content["info"] = array();
$content["businessSuppliers"] = array();

if($data == null){
	$info["status"] = false;	
}else{
	$info["status"] = true;	
	$recordCount = count($data[0]);
}

$info["records"] = $recordCount;

array_push($content["info"],$info);
array_push($content["businessSuppliers"],$data[0]);
array_push($main["content"],$content);

echo json_encode($main, true);