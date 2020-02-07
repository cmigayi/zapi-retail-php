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

//$customerId = $_POST['customer_id'];
$customerId = 1;

//$businessId = $_POST['business_id'];
$businessId = 1;

//$transactionNumber = $_POST['transaction_number'];
$transactionNumber = "0189";

//$amount = $_POST['amount'];
$amount = "450";

//set data
$customerCredit->setCustomerCreditId($customerCreditId); 
$customerCredit->setCustomerId($customerId); 
$customerCredit->setBusinessId($businessId); 
$customerCredit->setTransactionNumber($transactionNumber); 
$customerCredit->setAmount($amount);

$customerCredit = $customerCreditInfo->updateCustomerCredit($customerCredit);

if($customerCredit == null){
	$info["status"] = false;
	$info["results"] = 0;
}else{	
	$info["status"] = true;
	$info["results"] = 1;
	$data["customer_credit_id"] = $customerCredit->getCustomerCreditId();  
	$data["customer_id"] = $customerCredit->getCustomerId();  
	$data["business_id"] = $customerCredit->getBusinessId();  
	$data["transaction_number"] = $customerCredit->getTransactionNumber();   
	$data["amount"] = $customerCredit->getAmount();  
}
$content["info"] = array();
$content["customerCredit"] = array();
$main["content"] = array();

array_push($content["info"], $info);
array_push($content["customerCredit"], $data);
array_push($main["content"], $content);

echo json_encode($main, true);
