<?php
require_once("vendor/autoload.php");

use App\Middlewares\BusinessSalesCreditors;
use App\Repositories\SaleCreditorRepository;

$businessId = 1;

$saleCreditorRepo = new SaleCreditorRepository();

$businessSalesCreditors = new BusinessSalesCreditors($saleCreditorRepo);
$data = $businessSalesCreditors->getBusinessSalesCreditors($businessId);
//print_r($ownerBusinesses); 
// Count records found
$recordCount = 0;	

$main["content"] = array();
$content["info"] = array();
$content["businessSalesCreditors"] = array();

if($data == null){
	$info["status"] = false;	
}else{
	$info["status"] = true;	
	$recordCount = count($data[0]);
}

$info["records"] = $recordCount;

array_push($content["info"],$info);
array_push($content["businessSalesCreditors"],$data[0]);
array_push($main["content"],$content);

echo json_encode($main, true);