<?php
require_once("vendor/autoload.php");

use App\Middlewares\CustomerCredits;
use App\Repositories\CustomerCreditRepository;
use App\Data\CustomerCredit;

$customerId = 1;

$customerCreditRepo = new CustomerCreditRepository();

$customerCredits = new CustomerCredits($customerCreditRepo);
$data = $customerCredits->getCustomerCredits($customerId);

if($data == null){
	$info["status"] = false;
	$info["records"] = 0;	
}else{
	$info["status"] = true;	
	$info["records"] = count($data[0]);
}

$main["content"] = array();
$content["info"] = array();
$content["customerCredits"] = array();

array_push($content["info"],$info);
array_push($content["customerCredits"],$data[0]);
array_push($main["content"],$content);

echo json_encode($main, true);