<?php
require_once("vendor/autoload.php");

use App\Middlewares\BusinessSalesTransactions;
use App\Repositories\SaleTransactionRepository;

$businessId = 1; //$_POST['business_id'];

$saleTransactionRepo = new SaleTransactionRepository();

$businessSalesTransactions = new BusinessSalesTransactions($saleTransactionRepo);
$data = $businessSalesTransactions->getBusinessSalesTransactions($businessId);
//print_r($ownerBusinesses); 
// Count records found
$recordCount = 0;	

$main["content"] = array();
$content["info"] = array();
$content["businessSalesTransactions"] = array();

if($data == null){
	$info["status"] = false;	
}else{
	$info["status"] = true;	
	$recordCount = count($data[0]);
}

$info["records"] = $recordCount;

array_push($content["info"],$info);
array_push($content["businessSalesTransactions"],$data[0]);
array_push($main["content"],$content);

echo json_encode($main, true);