<?php
require_once("vendor/autoload.php");

use App\Data\CustomerCredit;
use App\Repositories\CustomerCreditRepository; 
use App\Middlewares\CustomerCreditInfo;

//initialize objects
$customerCredit = new CustomerCredit();
$customerCreditRepository = new CustomerCreditRepository();
$customerCreditInfo = new CustomerCreditInfo($customerCreditRepository);

// Data validation

//$customerCreditId = $_POST['customer_credit_id'];
$customerCreditId = 3;

$data = $customerCreditInfo->deleteCustomerCredit($customerCreditId);

if($data == null){
	$info["status"] = false;	
}else{	
	$info["status"] = true;
}

$main["content"] = array();
$content["info"] = array();

array_push($content["info"],$info);
array_push($main["content"],$content);

echo json_encode($main, true);