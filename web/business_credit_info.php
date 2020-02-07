<?php
require_once("vendor/autoload.php");

use App\Middlewares\BusinessCreditInfo;
use App\Repositories\BusinessCreditRepository;
use App\Data\BusinessCredit;

$businessId = 1;

$businessCreditRepo = new BusinessCreditRepository();

$businessCredit = new BusinessCredit();
$businessCreditInfo = new BusinessCreditInfo($businessCreditRepo);
$businessCredit = $businessCreditInfo->getBusinessCredit($businessId);

if($businessCredit == null){
	$info["status"] = false;
	$info["records"] = 0;	
}else{
	$info["status"] = true;	
	$info["records"] = 1;

	$data = array();
	$data['business_credit_id'] = $businessCredit->getBusinessCreditId();
	$data['business_id'] = $businessCredit->getBusinessId();
	$data['owed_person_id'] = $businessCredit->getOwedPersonId();
	$data['type'] = $businessCredit->getCreditType();
	$data['amount'] = $businessCredit->getAmount();
	$data['reason'] = $businessCredit->getReason();
	$data['date_time'] = $businessCredit->getDateTime();
}

$main["content"] = array();
$content["info"] = array();
$content["businessCredit"] = array();

array_push($content["info"],$info);
array_push($content["businessCredit"],$data);
array_push($main["content"],$content);

echo json_encode($main, true);