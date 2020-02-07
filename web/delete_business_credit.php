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
$businessCreditId = 1;

$data = $businessCreditInfo->deleteBusinessCredit($businessCreditId);

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