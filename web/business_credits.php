<?php
require_once("vendor/autoload.php");

use App\Middlewares\BusinessCredits;
use App\Repositories\BusinessCreditRepository;
use App\Data\BusinessCredit;

$businessId = 1;

$businessCreditRepo = new BusinessCreditRepository();

$businessCredits = new BusinessCredits($businessCreditRepo);
$data = $businessCredits->getBusinessCredits($businessId);

if($data == null){
	$info["status"] = false;
	$info["records"] = 0;	
}else{
	$info["status"] = true;	
	$info["records"] = count($data[0]);
}

$main["content"] = array();
$content["info"] = array();
$content["businessCredits"] = array();

array_push($content["info"],$info);
array_push($content["businessCredits"],$data[0]);
array_push($main["content"],$content);

echo json_encode($main, true);