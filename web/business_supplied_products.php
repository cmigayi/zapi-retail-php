<?php
require_once("vendor/autoload.php");

use App\Middlewares\BusinessSuppliedProducts;
use App\Repositories\SuppliedProductRepository;

$businessId = 3;

$suppliedProductRepo = new SuppliedProductRepository();

$businessSuppliedProducts = new BusinessSuppliedProducts($suppliedProductRepo);
$data = $businessSuppliedProducts->getBusinessSuppliedProducts($businessId);
//print_r($ownerBusinesses); 
// Count records found
$recordCount = 0;	

$main["content"] = array();
$content["info"] = array();
$content["businessSuppliedProducts"] = array();

if($data == null){
	$info["status"] = false;	
}else{
	$info["status"] = true;	
	$recordCount = count($data[0]);
}

$info["records"] = $recordCount;

array_push($content["info"],$info);
array_push($content["businessSuppliedProducts"],$data[0]);
array_push($main["content"],$content);

echo json_encode($main, true);