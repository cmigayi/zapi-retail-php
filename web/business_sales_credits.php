<?php
require_once("vendor/autoload.php");

use App\Middlewares\BusinessSalesCredits;
use App\Repositories\SaleCreditRepository;

$businessId = 1;

$saleCreditRepo = new SaleCreditRepository();

$businessSalesCredits = new BusinessSalesCredits($saleCreditRepo);
$data = $businessSalesCredits->getBusinessSalesCredits($businessId);
//print_r($ownerBusinesses); 
// Count records found
$recordCount = 0;	

$main["content"] = array();
$content["info"] = array();
$content["businessSalesCredits"] = array();

if($data == null){
	$info["status"] = false;	
}else{
	$info["status"] = true;	
	$recordCount = count($data[0]);
}

$info["records"] = $recordCount;

array_push($content["info"],$info);
array_push($content["businessSalesCredits"],$data[0]);
array_push($main["content"],$content);

echo json_encode($main, true);