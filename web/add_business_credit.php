<?php
require_once("vendor/autoload.php");

use App\Data\BusinessCredit;
use App\Repositories\BusinessCreditRepository; 
use App\Middlewares\AddBusinessCredit;

//initialize objects
$businessCredit = new BusinessCredit();
$businessCreditRepository = new BusinessCreditRepository();

//Data validation

//$businessId = $_POST['business_id'];
$businessId = 1;

//$owedPersonId = $_POST['owed_person_id'];
$owedPersonId = 1;

//$type = $_POST['type'];
$type = "Customer";

//$amount = $_POST['amount'];
$amount = "400";

$reason = "none";

//set data
$businessCredit->setBusinessId($businessId); 
$businessCredit->setOwedPersonId($owedPersonId); 
$businessCredit->setCreditType($type); 
$businessCredit->setAmount($amount); 
$businessCredit->setReason($reason); 

//set repository
$addBusinessCredit = new AddBusinessCredit($businessCreditRepository);
$businessCredit = $addBusinessCredit->createBusinessCredit($businessCredit);

if($businessCredit == null){
	$info["status"] = false;
	$info["results"] = 0;
}else{	
	$info["status"] = true;
	$info["results"] = 1;
	$data["business_credit_id"] = $businessCredit->getBusinessCreditId();  
	$data["business_id"] = $businessCredit->getBusinessId();  
	$data["owed_person_id"] = $businessCredit->getOwedPersonId();  
	$data["type"] = $businessCredit->getCreditType();  
	$data["amount"] = $businessCredit->getAmount();  
	$data["reason"] = $businessCredit->getReason();  ; 	
}
$content["info"] = array();
$content["businessCredit"] = array();
$main["content"] = array();

array_push($content["info"], $info);
array_push($content["businessCredit"], $data);
array_push($main["content"], $content);

echo json_encode($main, true);
