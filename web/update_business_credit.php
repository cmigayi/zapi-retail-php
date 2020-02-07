<?php
require_once("vendor/autoload.php");

use App\Data\BusinessCredit;
use App\Repositories\BusinessCreditRepository; 
use App\Middlewares\BusinessCreditInfo;

//initialize objects
$businessCredit = new BusinessCredit();
$businessCreditRepository = new BusinessCreditRepository();
$businessCreditInfo = new BusinessCreditInfo($businessCreditRepository);

// Data validation

//$businessCreditId = $_POST['business_credit_id'];
$businessCreditId = 2;

//$businessId = $_POST['business_id'];
$businessId = 1;

//$owedPersonId = $_POST['owed_person_id'];
$owedPersonId = 1;

//$type = $_POST['type'];
$type = "Supplier";

//$amount = $_POST['amount'];
$amount = "450";

$reason = "none";

//set data
$businessCredit->setBusinessCreditId($businessCreditId); 
$businessCredit->setBusinessId($businessId); 
$businessCredit->setOwedPersonId($owedPersonId); 
$businessCredit->setCreditType($type); 
$businessCredit->setAmount($amount); 
$businessCredit->setReason($reason);

$businessCredit = $businessCreditInfo->updateBusinessCredit($businessCredit);

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