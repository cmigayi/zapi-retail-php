<?php
require_once("vendor/autoload.php");

use App\Middlewares\CustomerCreditInfo;
use App\Repositories\CustomerCreditRepository;
use App\Data\CustomerCredit;

$customerCreditId = 3;

$customerCreditRepo = new CustomerCreditRepository();

$customerCredit = new CustomerCredit();
$customerCreditInfo = new CustomerCreditInfo($customerCreditRepo);
$customerCredit = $customerCreditInfo->getCustomerCredit($customerCreditId);

if($customerCredit == null){
	$info["status"] = false;
	$info["records"] = 0;	
}else{
	$info["status"] = true;	
	$info["records"] = 1;

	$data = array();
	$data['customer_credit_id'] = $customerCredit->getCustomerCreditId();
	$data['customer_id'] = $customerCredit->getCustomerId();
	$data['business_id'] = $customerCredit->getBusinessId();
	$data['transaction_number'] = $customerCredit->getTransactionNumber();
	$data['amount'] = $customerCredit->getAmount();
	$data['date_time'] = $customerCredit->getDateTime();
}

$main["content"] = array();
$content["info"] = array();
$content["customerCredit"] = array();

array_push($content["info"],$info);
array_push($content["customerCredit"],$data);
array_push($main["content"],$content);

echo json_encode($main, true);